<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/16
 * Time: 11:05
 */
class Second_label_recommend_value_model extends CI_Model
{
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
        if ($user_id == -1)
            return null;
        return $this->db->get_where("second_label_recommend_value", array("user_id" => $user_id))
            ->order_by("value", "DESC")->result_array();
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