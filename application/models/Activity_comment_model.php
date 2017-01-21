<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/11/20
 * Time: 9:59
 */
class Activity_comment_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('user_model');
        $this->load->model('Activity_model');
    }

    public function get_comment_by_activity_id($activity_id = -1)
    {
        if($activity_id<0)
            return null;
        else
        {
            return $this->db->get_where('activity_comment',array('activity_id'=>$activity_id))->result_array();
        }
    }

    public function get_comment_by_creator_id($creator_id = -1)
    {
        if($creator_id<0)
            return null;
        else
        {
            return $this->db->get_where('activity_comment',array('creator_id'=>$creator_id))->result_array();
        }
    }

    public function get_completed_comment_by_activity_id($activity_id =-1)
    {
        if($activity_id<0)
            return null;
        else
        {
            $comment=$this->get_comment_by_activity_id($activity_id);
            foreach($comment as $key => $comment_item)
            {
                $comment[$key]['creator'] = $this->User_model->get_user_by_id($comment_item['creator_id']);
            }
            return $comment;
        }
    }

    ////////////////////////////////////////////////////////////////

    public function insert_new_comment($activity_info = null)
    {
        $this->load->helper('date');
        if ($activity_info == null)
            return null;
        $date = mdate('%Y-%m-%d',time());
        $time = mdate('%H:%i:%s',time());
        $activity_info['date'] = $date;
        $activity_info['time'] = $time;
        if((!isset($activity_info['activity_id']))||(!isset($activity_info['creator_id'])))
            return false;
        if ($this->db->insert('activity_comment', $activity_info) == false)
            return false;
        return true;
    }
}