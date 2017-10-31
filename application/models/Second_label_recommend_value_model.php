<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/16
 * Time: 11:05
 */
class Second_label_recommend_value_model extends CI_Model
{
    var $browse_base = 1.2;
    var $enter_base = 2.2;

    /**
     *
     * 提供 user_id，返回表中含该 user_id 的条目
     * 拟用于计算推荐值的一部分
     *
     * @param int $user_id
     * @return array|null
     */
    public function get_value_by_user_id($user_id = -1)
    {
        if ($user_id == -1)
            return null;
        return $this->db->get_where("second_label_recommend_value", array("user_id" => $user_id))->result_array();
    }

    public function query_value($user_id = -1, $second_label_id = -1)
    {
        if ($user_id == -1 || $second_label_id == -1)
            return null;
        return $this->db->select("value")->get_where("second_label_recommend_value", array("user_id" => $user_id, "second_label_id" => $second_label_id))->row_array();
    }

    /**
     *
     * 提供 user_id，返回表中含该 user_id 的条目，并以 value 降序排列
     * 拟用于推荐
     *
     * @param int $user_id
     * @return array|null
     */
    public function get_value_desc_by_user_id($user_id = -1)
    {
        $this->load->model("Second_label_recommend_value_model");
        $this->load->model("Second_label_model");
        $this->load->model("User_and_first_label_model");
        if ($user_id == -1)
            return null;
        $origin_value = $this->db->order_by("value", "DESC")
            ->get_where("second_label_recommend_value", array("user_id" => $user_id))
            ->result_array();
        $second_label_value = array();
        foreach ($origin_value as $value){
            $second_label_id = $value['second_label_id'];
            $second_label_value["$second_label_id"] = $value['value'];
        }
        $all_value = $this->db->select('isJoin, second_label_id')
            ->join('activity', 'activity.id = relation_trace.browsed_activity_id')
            ->where(array('browser_id ' => $user_id))
            ->limit(50)
            ->get('relation_trace')
            ->result_array();
        $part_second_value = array();
        foreach ($all_value as $value) {
            $second_label_id = $value['second_label_id'];
            $isJoin = $value['isJoin'];
            $origin = array_key_exists($second_label_id, $part_second_value);
            if ($isJoin == 0) {
                $to_insert = $this->calculate_second_label_value($user_id, $second_label_id, $this->browse_base, $origin);
            } else {
                $to_insert = $this->calculate_second_label_value($user_id, $second_label_id, $this->enter_base, $origin);
            }
            $part_second_value["$second_label_id"] = $to_insert;
        }
        $sum = array_sum($part_second_value) + 10 * (count($part_second_value) - count($origin_value));
        foreach ($second_label_value as $second_label_id => $value){
            if (array_key_exists($second_label_id,$part_second_value)){
                $to_update = $value * ($part_second_value[$second_label_id] / $sum);
                $this->update_value($user_id,$second_label_id,$second_label_value[$second_label_id]);
            }else{
                $to_update = $value * (10 / $sum);
                $this->update_value($user_id,$second_label_id,$second_label_value[$second_label_id]);
            }
        }
        $result =  $this->db->order_by("value", "DESC")
            ->get_where("second_label_recommend_value", array("user_id" => $user_id))
            ->result_array();
        return $result;
    }

    private function calculate_second_label_value($user_id = -1, $second_label_id = -1, $base = -1, $origin)
    {
        if ($user_id == -1 || $second_label_id == -1 || $base == -1)
            return null;
        $times = $this->get_times($user_id, $second_label_id);
        if ($times == null)
            return null;
        if ($origin == null)
            $origin = 10;
        $to_insert = $origin + $base * $times;
        return $to_insert;
    }

    private function get_times($user_id = -1, $second_label_id = -1)
    {
        if ($user_id == -1 || $second_label_id == -1)
            return null;
        $temp = $this->Second_label_model->get_second_label_by_id($second_label_id);
        if (empty($temp)) // second_label_id is invalid
            return null;
        $is_selected = $this->User_and_first_label_model->query_exist($user_id, $temp['first_label_id']);

        // 返回推荐乘数，可以修改
        if ($is_selected == null) // 一级标签未选中
            return 1;
        return 2;
    }

    public function update_value($user_id = -1, $second_label_id = -1, $value = -1)
    {
        if ($user_id == -1 || $second_label_id == -1 || $value == -1)
            return null;
        if ($this->db->update("second_label_recommend_value", array("value" => $value), array("user_id" => $user_id, "second_label_id" => $second_label_id)) == true)
            return true;
        return false;
    }

    /**
     * @param int $user_id
     * @param int $second_label_id
     * @param int $value
     * @return bool|null
     */
    public function insert_new_value($user_id = -1, $second_label_id = -1, $value = -1)
    {
        if ($user_id == -1 || $second_label_id == -1 || $value == -1)
            return null;
        if ($this->db->insert("second_label_recommend_value", array("user_id" => $user_id, "second_label_id" => $second_label_id, "value" => $value)) == true)
            return true;
        return false;
    }
}