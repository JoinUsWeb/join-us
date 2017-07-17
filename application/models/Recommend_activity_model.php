<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2017/7/17
 * Time: 17:20
 */
class Recommend_activity_model extends CI_Model
{

    var $activities_num_total = 9;//推荐活动总数
    var $activities_num_group = 6;//推荐组推荐活动数量
    var $activities_num_random = 2;//随机推荐活动数量

    /**
     * @param $user_id(用户id)
     * @return array(推荐的活动数组)
     */
    public function get_recommend_activity($user_id)
    {
        //获取用户所在推荐组id
        $recommend_group_id = $this->get_recommend_group_id($user_id);

        //确定推荐组状态可用
        $this->db->trans_begin();
        $this->confirm_recommend_group($recommend_group_id);
        $this->db->trans_complete();

        //获取推荐
        $activity_ids = $this->db->get_where('recommend_group_activity', ['group_id' => $recommend_group_id])->result_array();
        $activities = array();
        $this->load->model("Activity_model");
        foreach ($activity_ids as $activity_id) {
            $activities[] = $this->Activity_model->get_activity_by_id($activity_id['activity_id']);
        }
        return $activities;

    }

    private function get_recommend_group_id($user_id)
    {
        $user_labels = $this->db->get_where('relation_user_firstlabel', ['user_id' => $user_id])->result_array();
        $recommend_group_id = 0;
        foreach ($user_labels as $user_label) {
            $recommend_group_id += (1 << ($user_label['first_label_id'] - 1));
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
        if ($current_date > $recommend_group['update_date']) {//如果组需要更新
            $this->update_recommend_group($recommend_group_id);
            $this->db->set('update_date', $current_date)->update('recommend_group');
        }

    }

    private function create_recommend_group($recommend_group_id)
    {
        $this->db->insert('recommend_group', ['id' => $recommend_group_id, 'update_date' => '0000-00-00']);
    }

    //核心算法部分：测试为10个活动（因为目前活动数量不足）,6个为根据推荐组推荐，3个为热门推荐，2个为随机推荐。
    private function update_recommend_group($recommend_group_id)
    {
        //获取推荐组推荐活动：
        $activity_ids = array();//推荐活动id数组
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
        }

        //获取随机推荐
        //随机获取有一个蛋疼的问题，如果运气不好，一直随机不到想要的没重复的活动，会卡住；不过讲道理应该活动多了以后就不会这样了
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
            $activity_ids[] = $random_activity_id;
        }

        //剩余部分用热门活动顺序补足
        $hot_activities = $this->db->select('id')->where('isVerified', 1)
            ->limit($this->activities_num_total)->order_by('score')->get('activity')->result_array();
        for ($key = 0; count($activity_ids) < $this->activities_num_total; $key++) {
            if (!in_array($hot_activities[$key]['id'], $activity_ids))
                $activity_ids[] = $hot_activities[$key]['id'];
        }

        //更新表数据
        //删除原来的数据
        $this->db->where('group_id', $recommend_group_id)->delete('recommend_group_activity');
        //插入新数据
        foreach ($activity_ids as $activity_id) {
            $this->db->insert('recommend_group_activity', ['group_id' => $recommend_group_id, 'activity_id' => $activity_id]);
        }
    }
}