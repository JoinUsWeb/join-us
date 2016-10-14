<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 22:06
 */
class User_and_second_label extends CI_Model
{

    public function __construct()
    {
        $this->load->model('user_model');
        $this->load->model('second_label_model');
    }

    /**
     * 获得二级标签下的用户
     *
     * 通过二级标签ID查找其成员。函数接受一个参数标签ID，如果合法（id>0），返回此标签下用户的一个数组
     *
     * @param int $second_label_id
     * @return null OR array $data
     */
    public function get_user_by_second_label_id($second_label_id=-1)
    {
        if ($second_label_id <= 0)
            return null;
        else
        {
            $data=array();
            $user=$this->db->get_where('relation_second_label_users',array('second_label_id'=>$second_label_id))->result_array();
            foreach($user as $user_item)
            {
                $data[]=$this->user_model->get_user_by_id($user_item['user_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户的二级标签
     *
     * 通过用户ID查找其二级标签。函数接受一个参数用户ID，如果合法（id>0），返回该用户标签的一个数组
     *
     * @param int $user_id
     * @return null OR array $data
     */
    public function get_second_label_by_user_id($user_id=-1)
    {
        if ($user_id <= 0)
            return null;
        else
        {
            $data=array();
            $second_label=$this->db->get_where('relation_second_label_users',array('user_id'=>$user_id))->result_array();
            foreach($second_label as $second_label_item)
            {
                $data[]=$this->second_label_model->get_second_label_by_id($second_label_item['second_label_id']);
            }
            return $data;
        }
    }
}