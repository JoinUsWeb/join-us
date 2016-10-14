<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 22:56
 */
class Creator_to_activity
{
    public function __construct(){
        $this->load->model('user_model');
        $this->load->model('activity_model');
    }

    /**
     * 获得活动的创建者
     *
     * 通过活动ID查找它的创建者。函数接受一个参数活动ID，如果合法（id>0），返回它的创建者；
     *
     * @param int $activity_id
     * @return null OR $data
     */
    public function get_creator_by_activity_id($activity_id=-1)
    {
        $activity=$this->activity_model->get_activity_by_id($activity_id);
        if($activity==null)
            return null;
        else
        {
            return $this->user_model->get_creator_by_id($activity['creator_id'])->row_array();
        }
    }

    /**
     * 获得用户创建的活动
     *
     * 通过用户ID查找他创建的活动。函数接受一个参数用户ID，如果合法（id>0），返回他创建的活动的一个数组；
     *
     * @param int $first_label_id
     * @return null OR array $data
     */
    public function get_activity_by_creator_id($creator_id=-1)
    {
        if ($creator_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('creator_id' => $creator_id))->result_array();
    }
}