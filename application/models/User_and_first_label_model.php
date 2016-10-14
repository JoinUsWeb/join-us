<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 22:05
 */
class User_and_first_label extends CI_Model
{
    public function __construct()
    {
        $this->load->model('user_model');
        $this->load->model('first_label_model');
    }

    /**
     * 获得一级标签下的用户
     *
     * 通过一级标签ID查找其成员。函数接受一个参数标签ID，如果合法（id>0），返回此标签下用户的一个数组
     *
     * @param int $first_label_id
     * @return null OR array $data
     */
    public function get_user_by_first_label_id($first_label_id=-1)
    {
        if ($first_label_id <= 0)
            return null;
        else
        {
            $data=array();
            $user=$this->db->get_where('relation_first_label_users',array('first_label_id'=>$first_label_id))->result_array();
            foreach($user as $user_item)
            {
                $data[]=$this->user_model->get_user_by_id($user_item['user_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户的一级标签
     *
     * 通过用户ID查找其一级标签。函数接受一个参数用户ID，如果合法（id>0），返回该用户标签的一个数组
     *
     * @param int $user_id
     * @return null OR array $data
     */
    public function get_first_label_by_user_id($user_id=-1)
    {
        if ($user_id <= 0)
            return null;
        else
        {
            $data=array();
            $first_label=$this->db->get_where('relation_first_label_users',array('user_id'=>$user_id))->result_array();
            foreach($first_label as $first_label_item)
            {
                $data[]=$this->first_label_model->get_first_label_by_id($first_label_item['first_label_id']);
            }
            return $data;
        }
    }
}