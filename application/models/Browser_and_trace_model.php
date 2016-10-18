<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 14:23
 */
class Browser_and_trace_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('Activity_model');
    }

    /**
     * 获得浏览过活动的用户
     *
     * 通过活动ID查找浏览过它的用户。函数接受一个参数活动ID，如果合法（id>0），返回其浏览者的一个数组
     *
     * @param int $activity_id
     * @return null OR array $data
     */
    public function get_browser_by_activity_id($activity_id = -1)
    {
        $trace = $this->get_trace_by_activity_id($activity_id);
        if ($trace == null)
            return null;
        else {
            $data = array();
            foreach ($trace as $trace_item) {
                $data[] = $this->User_model->get_user_by_id($trace_item['user_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户浏览过的活动
     *
     * 通过用户ID查找其浏览过的活动。函数接受一个参数用户ID，如果合法（id>0），返回其浏览过活动的一个数组
     *
     * @param int $browser_id
     * @return null OR array $data
     */
    public function get_activity_by_browser_id($browser_id = -1)
    {
        $trace = $this->get_trace_by_browser_id($browser_id);
        if ($trace == null)
            return null;
        else {
            $data = array();
            foreach ($trace as $trace_item) {
                $data[] = $this->Activity_model->get_activity_by_id($trace_item['browsed_activity_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户浏览记录
     *
     * 通过用户ID查找其浏览记录。函数接受一个参数用户ID，如果合法（id>0），返回其浏览记录的一个数组
     *
     * @param int $browser_id
     * @return null OR array $data
     */
    public function get_trace_by_browser_id($browser_id = -1)
    {
        if ($browser_id <= 0) {
            return null;
        } else {
            return $this->db->order_by('browsed_time', 'DESC')
                ->get_where('relation_trace', array('user_id' => $browser_id))
                ->result_array();
        }
    }

    /**
     * 获得活动被浏览记录
     *
     * 通过活动ID查找其浏览记录。函数接受一个参数活动ID，如果合法（id>0），返回其被浏览记录的一个数组
     *
     * @param int $activity_id
     * @return null OR array $data
     */
    public function get_trace_by_activity_id($activity_id = -1)
    {
        if ($activity_id <= 0) {
            return null;
        } else {
            return $this->db->order_by('browsed_time', 'DESC')
                ->get_where('relation_trace', array('browsed_activity_id' => $activity_id))
                ->result_array();
        }
    }

    public function remove_trace_by_id($browser_id = -1, $activity_id = -1)
    {
        if ($browser_id <= 0 || $activity_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_activity_members', array('browser_id' => $browser_id, 'activity_id' => $activity_id)) == false)
                return false;
            return true;
        }
    }


    public function remove_by_browser_id($browser_id = -1)
    {
        if ($browser_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_trace', array('browser_id' => $browser_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_by_activity_id($activity_id = -1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_trace', array('browsed_activity_id' => $activity_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_by_time($browsed_time = -1)
    {
        if ($browsed_time === -1)
            return null;
        if ($this->db->where('browsed_time<', $browsed_time)->delete('relation_trace') == false)
            return false;
        return true;
    }


    /**
     * 获取用户ID、活动ID和浏览时间
     *
     * 三个参数如果不合法，返回null
     *
     * 如果合法，插入 （user_id, browsed_time，browsed_activity_id） ，如果失败返回false
     *
     * @param int $browser_id
     * @param int $browser_time
     * @param int $activity_id
     * @return bool|null
     */
    public function insert_new_relation($browser_id = -1, $browser_time = -1, $activity_id = -1)
    {
        if ($browser_id <= 0 || $browser_time < 0 || $activity_id <= 0)
            return null;
        else {
            $data = array(
                'browsed_activity_id' => $activity_id,
                'browsed_time' => $browser_time,
                'user_id' => $browser_id);
            if ($this->db->insert('relation_trace', $data) == false)
                return false;
            return true;
        }
    }
}