<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/13
 * Time: 22:07
 */
class Member_and_activity_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('user_model');
        $this->load->model('activity_model');
    }

    /**
     * 获得活动成员数组
     *
     * 通过活动ID查找其成员。函数接受一个参数活动ID，如果合法（id>0），返回其成员的一个数组
     *
     * @param int $activity_id
     * @return null OR array $data
     */
    public function get_member_by_activity_id($activity_id = -1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            $data = array();
            $member = $this->db->get_where('relation_activity_members', array('activity_id' => $activity_id))->result_array();
            foreach ($member as $member_item) {
                $data[] = $this->user_model->get_user_by_id($member_item['member_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户参与的活动
     *
     * 通过用户ID查找其参与的活动。函数接受一个参数活用户ID，如果合法（id>0），返回其参与活动的一个数组
     *
     * @param int $member_id
     * @return null OR array $data
     */
    public function get_activity_by_member_id($member_id = -1)
    {
        if ($member_id <= 0)
            return null;
        else {
            $data = array();
            $activity = $this->db->get_where('relation_activity_members', array('member_id' => $member_id))->result_array();
            foreach ($activity as $activity_item) {
                $data[] = $this->activity_model->get_activity_by_id($activity_item['activity_id']);
            }
            return $data;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_member_from_activity_by_id($activity_id = -1, $member_id = -1)
    {
        if ($activity_id <= 0 || $member_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_activity_members', array('activity_id' => $activity_id, 'member_id' => $member_id)) == false)
                return false;
            return ture;
        }
    }


    public function remove_by_activity_id($activity_id = -1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_activity_members', array('activity_id' => $activity_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_by_user_id($user_id)
    {
        if ($user_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_activity_members', array('member_id' => $user_id)) == false)
                return false;
            return true;
        }
    }

    /**
     *
     * 获取用户ID以及活动ID
     *
     * 如果两个ID不合法， 返回null，
     *
     * 如果合法插入 （user_id，activity_id） 关系，失败返回false     *
     *
     * @param $user_id
     * @param $activity_id
     * @return bool|null
     */
    public function insert_new_relation($user_id = -1, $activity_id = -1)
    {
        if ($user_id <= 0 || $activity_id <= 0)
            return null;
        else {
            $data = array(
                'member_id' => $user_id,
                'activity_id' => $activity_id
            );
            if ($this->db->insert('relation_activity_meambers', $data) == false)
                return false;
            return true;
        }
    }
}
