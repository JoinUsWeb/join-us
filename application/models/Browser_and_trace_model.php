<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 14:23
 */
class Browser_and_trace extends CI_Model
{
    public function __construct()
    {
        $this->load->model('user_model');
        $this->load->model('trace_model');
    }

    /**
     * 获得浏览过活动的用户
     *
     * 通过活动ID查找浏览过它的用户。函数接受一个参数活动ID，如果合法（id>0），返回其浏览者的一个数组
     *
     * @param int $activity_id
     * @return null OR array $data
     */
    public function get_browser_by_activity_id($activity_id=-1)
    {
        $browser=$this->get_browser_by_activity_id($activity_id);
        if ($browser==null)
            return null;
        else
        {
            $data=array();
            foreach($browser as $browser_item)
            {
                $data[]=$this->user_model->get_user_by_id($browser_item['user_id']);
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
    public function get_activity_by_browser_id($browser_id=-1)
    {
        $trace=$this->get_trace_by_browser_id($browser_id);
        if ($trace==null)
            return null;
        else
        {
            $data=array();
            foreach($trace as $trace_item)
            {
                $data[]=$this->trace_model->get_trace_by_id($trace_item['browsed_activity_id']);
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
    public function get_trace_by_browser_id($browser_id=-1)
    {
        if($browser_id<=0)
        {
            return null;
        }
        else
        {
            return $this->db->order_by('browsed_time','DESC')
                ->get_where('relation_trace',array('user_id'=>$browser_id))
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
    public function get_trace_by_activity_id($activity_id=-1)
    {
        if($activity_id<=0)
        {
            return null;
        }
        else
        {
            return $this->db->order_by('browsed_time','DESC')
                ->get_where('relation_trace',array('browser_activity_id'=>$activity_id))
                ->result_array();
        }
    }
}