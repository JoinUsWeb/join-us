<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/22
 * Time: 21:19
 */
class Recommend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Second_label_recommend_value_model");
        $this->load->model("Second_label_model");
        $this->load->model("User_and_first_label_model");
    }

    public function calculate_second_label_value($user_id = -1, $second_label_id = -1, $base = -1)
    {
        if ($user_id == -1 || $second_label_id == -1 || $base == -1)
            return null;
        $times = $this->get_times($user_id, $second_label_id);
        if ($times == null)
            return null;
        $origin = 60; // 每个二级标签推荐值的初始值
        $value = $this->Second_label_recommend_value_model->query_value($user_id, $second_label_id);
        if ($value == null) {// value is empty or second_label_id is not found
            $to_insert = $origin * $base * $times;
            $this->Second_label_recommend_value_model
                ->insert_new_value($user_id, $second_label_id, $to_insert);
        } else {
            $origin = $value["value"];
            $to_update = $origin * $base * $times;
            $this->Second_label_recommend_value_model
                ->update_value($user_id, $second_label_id, $to_update);
        }
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

    /*private function deep_in_array($value, $array)
    {
        foreach ($array as $item) {
            if (!is_array($item)) {
                if ($item == $value) {
                    return true;
                } else {
                    continue;
                }
            }
            if (in_array($value, $item)) {
                return true;
            } else if ($this->deep_in_array($value, $item)) {
                return true;
            }
        }
        return false;
    }*/
}