<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2017/7/17
 * Time: 17:20
 */
class Recommend_activity_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model("Activity_model");
        $this->load->model("Member_and_activity_model");
        $this->load->model("Second_label_recommend_value_model");
    }

    var $activities_num_total = 9;//推荐活动数量
    var $activities_num_label=3;//标签推荐活动数量
    var $activities_num_group = 5;//推荐组推荐活动数量
    var $activities_num_random = 3;//随机推荐活动数量，还剩下的

    /**
     * @param $user_id(用户id)
     * @return array(推荐的活动数组)
     */
    public function get_recommend_activity($user_id)
    {
        //获取用户所在推荐组id
        $recommend_group_id = $this->get_recommend_group_id($user_id);
        if($recommend_group_id==0)
            return [];

        //确定推荐组状态可用
        $this->db->trans_begin();
        $this->confirm_recommend_group($recommend_group_id);
        $this->db->trans_complete();

        //获取标签推荐
        $activity_ids=[];
        $labels=$this->Second_label_recommend_value_model->get_value_desc_by_user_id($user_id);
        $count=count($labels)<$this->activities_num_label?count($labels):$this->activities_num_label;
        for ($i=0;$i<$count;$i++) {
            $sql='SELECT count(*) as activity_count FROM activity WHERE second_label_id='.$labels[$i]['second_label_id'];
            $activity_count=$this->db->query($sql)->row_array()['activity_count']-2;
            $rand=rand(0,$activity_count);
            $activity_id=$this->db ->limit(1,$rand)
                ->get_where('activity',['second_label_id'=>$labels[$i]['second_label_id'],'isVerified'=>1])->row_array();
            if(!empty($activity_id))
                $activity_ids[]=$activity_id['id'];
        }
        //获取推荐组推荐
        $activity_ids_group = $this->db->get_where('recommend_group_activity',
            ['group_id' => $recommend_group_id, 'update_date'=>date('Y-m-d')])->result_array();
        foreach ($activity_ids_group as $activity_id){
            $id=$activity_id['activity_id'];
            if(!in_array($id,$activity_ids))
                $activity_ids[]=$id;
        }
        //根据id获取活动
        $activities = array();
        foreach ($activity_ids as $activity_id) {
            if(!$this->is_activity_joined($user_id,$activity_id))
                $activities[] = $this->Activity_model->get_activity_by_id($activity_id);
        }
        return $activities;
    }

    public function refresh_recommend_activity_for_test($user_id){
        $recommend_group_id = $this->get_recommend_group_id($user_id);
        if($recommend_group_id==0)
            return;
        //确定推荐组状态可用
        $this->db->trans_begin();
        //组是否存在
        $recommend_group = $this->db->get_where('recommend_group', ['id' => $recommend_group_id])->row_array();
        if (empty($recommend_group)) {//如果组不存在
            $this->create_recommend_group($recommend_group_id);
        }
        $this->db->where('group_id',$recommend_group_id)->delete('recommend_group_activity');
        $this->update_recommend_group($recommend_group_id);
        $this->db->trans_complete();
    }

    //如果用户没有参加（并且不是他创建）这个活动，则返回false
    private function is_activity_joined($user_id,$activity_id){
        $record1=$this->db->get_where('relation_activity_members',['member_id'=>$user_id,'activity_id'=>$activity_id])->row_array();
        $record2=$this->db->get_where('activity',['creator_id'=>$user_id,'id'=>$activity_id])->row_array();
        return !(empty($record1)&&empty($record2));//全为空返回false
    }

    //获取用户的推荐组id，如果用户第一次使用推荐则更新推荐组id
    private function get_recommend_group_id($user_id)
    {
        $recommend_group_id=0;
        $user=$this->User_model->get_user_by_id($user_id);
        if(!empty($user)){
            $recommend_group_id=$user['recommend_group_id'];
        }
        if($recommend_group_id==0){
            $user_labels = $this->db->get_where('relation_user_firstlabel', ['user_id' => $user_id])->result_array();
            foreach ($user_labels as $user_label) {
                $recommend_group_id += (1 << ($user_label['first_label_id'] - 1));
            }
            $this->User_model->update_user_recommend_group_id($user_id,$recommend_group_id);
        }
        return $recommend_group_id;
    }

    private function confirm_recommend_group($recommend_group_id)
    {
        //组是否存在
        $recommend_group = $this->db->get_where('recommend_group', ['id' => $recommend_group_id])->row_array();
        if (empty($recommend_group)) {//如果组不存在
            $this->create_recommend_group($recommend_group_id);
            $recommend_group = $this->db->get_where('recommend_group', ['id' => $recommend_group_id])->row_array();
        }
        //组是否更新
        $current_date = date('Y-m-d');
        if ($current_date != $recommend_group['update_date']) {//如果组需要更新
            $this->update_recommend_group($recommend_group_id);
        }

    }

    private function create_recommend_group($recommend_group_id)
    {
        $this->db->insert('recommend_group', ['id' => $recommend_group_id, 'update_date' => '0000-00-00']);
    }

    //如果已经被推荐，则返回true,否则返回false
    private function is_activity_recommended($group_id=-1,$activity_id=-1){
        $activity=$this->db->get_where('recommend_group_activity',['group_id'=>$group_id,'activity_id'=>$activity_id])->row_array();
        return !empty($activity);
    }

    //核心算法部分：测试为10个活动（因为目前活动数量不足）,6个为根据推荐组推荐，3个为热门推荐，2个为随机推荐。
    private function update_recommend_group($recommend_group_id)
    {
        //获取推荐组推荐活动：
        $activity_ids = array();//推荐活动id数组
        //查找推荐组内的成员
        $activity_number=0;
        for ($limit_times=0;$limit_times<=5&&$activity_number<$this->activities_num_group; $limit_times++){
            $group_members=$this->User_model->get_random_users_by_recommend_group_id($recommend_group_id,$this->activities_num_group-$activity_number);
            foreach ($group_members as $group_member){
                $activity_id_to_insert=$this->Member_and_activity_model->get_random_activity_id_by_member_id($group_member['id']);
                if(!empty($activity_id_to_insert)) {
                    $id = $activity_id_to_insert['activity_id'];
                    if (!in_array($id, $activity_ids) && !$this->is_activity_recommended($recommend_group_id, $id)) {
                        $activity_ids[] = $id;//如果未被推荐则加入推荐列表
                        $activity_number++;
                    }
                }
            }
        }

        /*下面是根据一级标签的推荐，开始算法理解错误的痕迹。。。
        //根据推荐组id拆分出推荐组对应的标签id
        $recommend_group_id_2 = $recommend_group_id;
        $label_ids = array();
        $label_tmp_id = 1;
        while ($recommend_group_id_2 != 0) {
            $bit = $recommend_group_id_2 & 1;
            if ($bit == 1) {
                $label_ids[] = $label_tmp_id;
            }
            $recommend_group_id_2 = $recommend_group_id_2 >> 1;
            $label_tmp_id++;
        }
        //根据标签id获取推荐活动
        //这里存在问题：获取的推荐活动数量可能远少于目标数量；原因是用了整数除法，以及部分标签可能活动数量不足
        //整数除法问题可以考虑用四舍五入法，但是可能需要比较多的动态的热门活动数量来补足了。
        $each_label_count = $this->activities_num_group / count($label_ids);
        foreach ($label_ids as $label_id) {
            $label_activities = $this->db->select('id')->where(['first_label_id' => $label_id, 'isVerified' => 1])
                ->limit($each_label_count)->order_by('score')->get('activity')->result_array();
            foreach ($label_activities as $label_activity) {
                $activity_ids[] = $label_activity['id'];
            }
        }*/

        //获取随机推荐
        //随机获取有一个蛋疼的问题，如果运气不好，一直随机不到想要的没重复的活动，会卡住；不过讲道理应该活动多了以后就不会这样了
        //现在通过限制随即推荐的次数保证了不会卡死，但是数量不能保证
        $activity_count = $this->db->query('SELECT count(*) as activity_count FROM activity WHERE isVerified=1')
            ->row_array()['activity_count']-1;
        for ($i = 0; $i < $this->activities_num_random; $i++) {
            $random_id = rand(0, $activity_count);
            $random_activity_id = $this->db->select('id')->where('isVerified', 1)->
            limit($random_id, $random_id)->get('activity')->row_array()['id'];
            while (in_array($random_activity_id, $activity_ids)) {
                $random_id = rand(0, $activity_count);
                $random_activity_id = $this->db->select('id')->where('isVerified', 1)->
                limit($random_id, $random_id)->get('activity')->row_array()['id'];
            }
            if (!$this->is_activity_recommended($recommend_group_id, $random_activity_id))
                $activity_ids[] = $random_activity_id;//如果未被推荐则加入推荐列表
        }

        //剩余部分用热门活动顺序补足
        //这里要考虑推荐多了以后，热门活动被全部推荐的坑爹情况
        $hot_activities = $this->db->select('id')->where('isVerified', 1)
            ->limit($this->activities_num_total)->order_by('score')->get('activity')->result_array();
        for ($key = 0;$key<$this->activities_num_total && count($activity_ids) < $this->activities_num_total; $key++) {
            $id = $hot_activities[$key]['id'];
            if (!in_array($id, $activity_ids) && !$this->is_activity_recommended($recommend_group_id, $id)) {
                $activity_ids[] = $id;//如果未被推荐则加入推荐列表
            }
        }

        //插入新的推荐活动数据数据
        //插入新数据
        $current_date = date('Y-m-d');
        foreach ($activity_ids as $activity_id) {
            $this->db->insert('recommend_group_activity',
                ['group_id' => $recommend_group_id, 'activity_id' => $activity_id,'update_date'=>$current_date]);
        }
        //更新组更新时间
        $this->db->set('update_date', $current_date)->update('recommend_group');
    }
}