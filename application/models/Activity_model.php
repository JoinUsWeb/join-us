<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 13:37
 */
class Activity_model extends CI_Model
{
    /**
     * 获得所有活动
     *
     * 查找所有活动。函数接受一个参数标签ID，如果合法（id>0），返回所有活动的一个数组；
     *
     * @return null OR array $data
     */
    public function get_activity()
    {
        return $this->db->get('activity')->result_array();
    }

    /**
     * 获得指定活动
     *
     * 通过活动ID查找活动。函数接受一个参数活动ID，如果合法（id>0），返回该活动；
     *
     * @param int $id
     * @return null OR $data
     */
    public function get_activity_by_id($id = -1)
    {
        if ($id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('id' => $id))->row_array();
    }

    /**
     * 获得用户创建的活动
     *
     * 通过用户ID查找他创建的活动。函数接受一个参数用户ID，如果合法（id>0），返回他创建的活动的一个数组；
     *
     * @param int $creator_id
     * @return null OR array $data
     */
    public function get_activity_by_creator_id($creator_id = -1)
    {
        if ($creator_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('creator_id' => $creator_id))->result_array();
    }

    /**
     * 获得一级标签下的活动
     *
     * 通过一级标签ID查找属于它的活动。函数接受一个参数标签ID，如果合法（id>0），返回属于它的活动的一个数组；
     *
     * @param int $first_label_id
     * @return null OR array $data
     */
    public function get_activity_by_first_label_id($first_label_id = -1)
    {
        if ($first_label_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('first_label_id' => $first_label_id))->result_array();
    }

    /**
     * 获得二级标签下的活动
     *
     * 通过二级标签ID查找属于它的活动。函数接受一个参数标签ID，如果合法（id>0），返回属于它的活动的一个数组；
     *
     * @param int $second_label_id
     * @return null OR array $data
     */
    public function get_activity_by_second_label_id($second_label_id = -1)
    {
        if ($second_label_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('second_label_id' => $second_label_id))->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_by_id($activity_id=-1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            $this->load->model('Member_and_activity_model');
            $this->load->model('Browser_and_trace_model');

            if ($this->Member_and_activity_model->remove_by_activity_id($activity_id) == false)
                return false;
            if ($this->Browser_and_trace_model->remove_by_activity_id($activity_id) == false)
                return false;
            if ($this->db->delete('activity', array('id' => $activity_id)) == false)
                return false;
            return false;
        }
    }

    public function remove_activity_by_creator_id($creator_id = -1)
    {
        $activity_to_be_delete = $this->get_activity_by_creator_id($creator_id);
        foreach ($activity_to_be_delete as $activity_item_to_be_delete) {
            $result = $this->remove_by_id($activity_item_to_be_delete['id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    public function remove_activity_by_first_label_id($first_label_id = -1)
    {
        $activity_to_be_delete = $this->get_activity_by_first_label_id($first_label_id);
        foreach ($activity_to_be_delete as $activity_item_to_be_delete) {
            $result = $this->remove_by_id($activity_item_to_be_delete['id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    public function remove_activity_by_second_label_id($second_label_id = -1)
    {
        $activity_to_be_delete = $this->get_activity_by_second_label_id($second_label_id);
        foreach ($activity_to_be_delete as $activity_item_to_be_delete) {
            $result = $this->remove_by_id($activity_item_to_be_delete['id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    /**
     *
     * data = array(
     *      name  time_expire  time_start  place  brief  amount_max  creator_id  first_label_id
     *      second_label_id  score)
     *
     * @param $activity_info
     * @return bool|null
     */
    public function insert_new_activity($activity_info = null)
    {
        if ($activity_info == null)
            return null;
        if ($this->db->insert('activity', $activity_info) == false)
            return false;
        return true;
    }

    /**
     *
     * array_for_update = array(
     *      name  time_expire  time_start  place  brief  amount_max  creator_id  first_label_id
     *      second_label_id  score)
     *
     * @param int $activity_id
     * @param $array_for_update
     * @return bool|null
     */
    public function update_activity_by_id($activity_id = -1, $array_for_update = null)
    {
        if ($array_for_update == null|| $activity_id <= 0)
            return null;
        $this->db->where('id', $activity_id);
        if ($this->db->update('activity', $array_for_update) == false)
            return false;
        return true;
    }
}