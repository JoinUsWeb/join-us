<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/13
 * Time: 23:01
 */
class Second_label_to_activity extends CI_Model 
{
    public function __construct(){
        $this->load->model('second_label_model');
        $this->load->model('activity_model');
    }

    /**
     * 获得活动的二级标签
     *
     * 通过活动ID查找它的二级标签。函数接受一个参数活动ID，如果合法（id>0），返回它的二级标签；
     *
     * @param int $activity_id
     * @return null OR $data
     */
    public function get_second_label_by_activity_id($activity_id=-1)
    {
        $activity=$this->activity_model->get_activity_by_id($activity_id);
        if($activity==null)
            return null;
        else
        {
            return $this->user_model->get_second_label_by_id($activity['second_label_id'])->row_array();
        }
    }

    /**
     * 获得二级标签下的活动
     *
     * 通过二级标签ID查找属于它的活动。函数接受一个参数标签ID，如果合法（id>0），返回属于它的活动的一个数组；
     *
     * @param int $second_label_id
     * @return null OR array $data
     */
    public function get_activity_by_second_label_id($second_label_id=-1)
    {
        if ($second_label_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('second_label_id' => $second_label_id))->result_array();
    }
}