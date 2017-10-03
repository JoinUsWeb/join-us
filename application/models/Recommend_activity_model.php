<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2017/7/17
 * Time: 17:20
 */
class Recommend_activity_model extends CI_Model
{
    var $random_limit=10;//随机次数限制为10次，避免无限循环
    var $activities_num_total = 9;//推荐活动数量
    var $activities_num_label = 3;//标签推荐活动数量
    var $activities_num_group = 5;//推荐组推荐活动数量

    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model("Activity_model");
        $this->load->model("Member_and_activity_model");
        $this->load->model("Second_label_recommend_value_model");
        $this->load->model("Evaluate_model");
    }

    /**
     * @param $user_id (用户id)
     * @return array(推荐的活动数组)
     */
    public function get_recommend_activity($user_id)
    {
        //确定用户推荐已经完成
        $this->confirm_user_recommend($user_id);

        //根据id获取活动
        $activities=[]; //活动列表
        $activity_ids = $this->db->select('activity_id')
            ->get_where('recommend_user_activity',['user_id'=>$user_id,'recommend_date'=>date('Y-m-d')])->result_array();
        foreach ($activity_ids as $activity_id) {
            $activity=$this->Activity_model->get_activity_by_id($activity_id['activity_id']);
            if(!empty($activity))
                $activities[] = $activity;
        }
        return $activities;
    }

    //确认用户推荐已经更新，如果没更新则进行更新
    private function confirm_user_recommend($user_id){
        $user=$this->User_model->get_user_by_id($user_id);
        $current_date = date('Y-m-d');
        if ($current_date != $user['recommend_date']) {//如果用户推荐需要更新
            $this->update_recommend_activities($user_id);
        }
    }

    private function update_recommend_activities($user_id){
        $activity_ids = [];//推荐活动id
        srand(time());//随机种子
        //获取标签推荐
        $this->get_label_recommend($activity_ids,$user_id);
        //获取推荐组推荐
        $this->get_group_recommend($activity_ids,$user_id);
        //获取填充推荐活动（包括随机和热门）
        $this->get_random_recommend($activity_ids,$user_id);

        //更新推荐表
        $current_date = date('Y-m-d');
        foreach ($activity_ids as $activity_id) {
            $this->db->insert('recommend_user_activity',
                ['user_id' => $user_id, 'activity_id' => $activity_id, 'recommend_date' => $current_date]);
        }
        //更新组更新时间
        $this->db->set('recommend_date', $current_date)
            ->where('id',$user_id)
            ->update('user');
    }

    //标签推荐
    private function get_label_recommend(&$activity_ids,$user_id){
        $labels = $this->Second_label_recommend_value_model->get_value_desc_by_user_id($user_id);
        $label_count = count($labels) < $this->activities_num_label ? count($labels) : $this->activities_num_label;
        for ($i = 0; $i < $label_count; $i++) {
            //获取对应二级标签下该用户没参与过的活动
            $sql = 'SELECT id as activity_id
                    FROM activity as a
                    WHERE a.second_label_id='.$labels[$i]['second_label_id'].'
                        AND a.isVerified=1
                        AND a.id not in(
                            SELECT activity_id
                            FROM relation_activity_members as ram
                            WHERE member_id=' . $user_id.')
                        AND a.id not in(
                            SELECT activity_id
                            FROM recommend_user_activity as rua
                            WHERE user_id=' . $user_id.')';
            $raw_activity_ids = $this->db->query($sql)->result_array();
            $label_activity_count=count($raw_activity_ids);
            if($label_activity_count>0){
                $rand_index = rand(0, $label_activity_count-1);
                $activity_ids[]=$raw_activity_ids[$rand_index]['activity_id'];
            }
        }
    }

    //组推荐
    private function get_group_recommend(&$activity_ids,$user_id){
        //获取用户所在推荐组id
        $recommend_group_id = $this->get_recommend_group_id($user_id);
        if ($recommend_group_id != 0){
            $group_members=$this->db->select('id')
                ->get_where('user',['recommend_group_id'=>$recommend_group_id,'id<>'=>$user_id])->result_array();
            $group_members_count=count($group_members);
            $group_recommend_count=$this->activities_num_group>$group_members_count?$group_members_count:$this->activities_num_group;
            $recommended_member=[];
            for($i=0;$i<$group_recommend_count;$i++){
                $member_rand_index=rand(0,$group_members_count-1);
                for($random_limit=0;$random_limit<=$this->random_limit&&in_array($group_members[$member_rand_index]['id'],$recommended_member);$random_limit++){
                    $member_rand_index=rand(0, $group_members_count-1);
                }
                if(in_array($group_members[$member_rand_index]['id'],$recommended_member)){
                    continue;
                }
                $recommended_member[]=$group_members[$member_rand_index]['id'];

                $sql = 'SELECT a.id as activity_id
                        FROM activity as a JOIN relation_activity_members as ram
                        WHERE a.id=ram.activity_id
                            AND ram.member_id=' . $group_members[$member_rand_index]['id'].'
                            AND a.isVerified=1
                            AND a.id not in(
                                SELECT activity_id
                                FROM relation_activity_members as ram
                                WHERE member_id=' . $user_id.')
                            AND a.id not in(
                                SELECT activity_id
                                FROM recommend_user_activity as rua
                                WHERE user_id=' . $user_id.')';
                $raw_activity_ids = $this->db->query($sql)->result_array();
                $member_activity_count=count($raw_activity_ids);
                if($member_activity_count>0){
                    $rand_index = rand(0, $member_activity_count-1);
                    for($random_limit=0;$random_limit<=$this->random_limit&&in_array($raw_activity_ids[$rand_index]['activity_id'],$activity_ids);$random_limit++){
                        $rand_index=rand(0, $member_activity_count-1);
                    }
                    if(!in_array($raw_activity_ids[$rand_index]['activity_id'],$activity_ids)){
                        $activity_ids[]=$raw_activity_ids[$rand_index]['activity_id'];
                    }
                }
            }
        }
    }

    //随机推荐,剩余部分用热门活动填充
    private function get_random_recommend(&$activity_ids,$user_id){
        //获取所有能参与的活动
        $sql = 'SELECT a.id as activity_id
                        FROM activity as a 
                        WHERE a.isVerified=1
                            AND a.id not in(
                                SELECT activity_id
                                FROM relation_activity_members as ram
                                WHERE member_id=' . $user_id.')
                            AND a.id not in(
                                SELECT activity_id
                                FROM recommend_user_activity as rua
                                WHERE user_id=' . $user_id.')';
        $raw_activity_ids = $this->db->query($sql)->result_array();
        $remain_num=$this->activities_num_total-count($activity_ids);//需填充数量
        $total_activity_num=count($raw_activity_ids);//所有可填充活动总数
        $remain_num=$remain_num>$total_activity_num?$total_activity_num:$remain_num;
        //随机推荐填充
        $random_num=floor($remain_num/2+0.5);//一半用随机填充
        for($i=0;$i<$random_num;$i++){
            $rand_index = rand(0, $total_activity_num-1);
            for($random_limit=0;$random_limit<=$this->random_limit&&in_array($raw_activity_ids[$rand_index]['activity_id'],$activity_ids);$random_limit++){
                $rand_index=rand(0, $total_activity_num-1);
            }
            if(!in_array($raw_activity_ids[$rand_index]['activity_id'],$activity_ids)){
                $activity_ids[]=$raw_activity_ids[$rand_index]['activity_id'];
            }
        }
        //顺序填充
        for($i=0;$i<$total_activity_num&&count($activity_ids)<$this->activities_num_total;$i++){
            if(!in_array($raw_activity_ids[$i]['activity_id'],$activity_ids)){
                $activity_ids[]=$raw_activity_ids[$i]['activity_id'];
            }
        }
    }

    //获取用户所在推荐组，如果用户推荐组还没设置（第一次使用），则设置推荐组
    private function get_recommend_group_id($user_id)
    {
        $recommend_group_id = 0;
        $user = $this->User_model->get_user_by_id($user_id);
        if (!empty($user)) {
            $recommend_group_id = $user['recommend_group_id'];
        }
        if ($recommend_group_id == 0) {
            $user_labels = $this->db->get_where('relation_user_firstlabel', ['user_id' => $user_id])->result_array();
            foreach ($user_labels as $user_label) {
                $recommend_group_id += (1 << ($user_label['first_label_id'] - 1));
            }
            $this->User_model->update_user_recommend_group_id($user_id, $recommend_group_id);
        }
        return $recommend_group_id;
    }

    //为了测试阶段方便刷新,调用后模拟刷新一次小组推荐
    public function refresh_recommend_activity_for_test($user_id)
    {
        //测试阶段，需要记录每次更新小组推荐时推荐的效率
        $this->Evaluate_model->save_evaluate_record($user_id);

        //为了测试，将活动推荐时间和用户推荐世界都设置为0000-00-00
        $this->db->set('recommend_date','0000-00-00')
            ->where(['user_id'=>$user_id,'recommend_date'=>date('Y-m-d')])
            ->update('recommend_user_activity');
        $this->db->set('recommend_date','0000-00-00')
            ->where(['id'=>$user_id,'recommend_date'=>date('Y-m-d')])
            ->update('user');
    }


    public function get_recommended_activity_amount_by_user_id($user_id = -1)
    {
        if ($user_id < 0) return null;
        return $this->db
            ->select('count(*)')
            ->get_where('recommend_user_activity', array('user_id' => $user_id))
            ->row_array()['count(*)'];
    }
}