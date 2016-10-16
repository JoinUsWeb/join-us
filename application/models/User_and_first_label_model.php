<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 22:05
 */
class User_and_first_label_model extends CI_Model
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
            $user=$this->db->get_where('relation_user_firstlabel',array('first_label_id'=>$first_label_id))->result_array();
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
            $first_label=$this->db->get_where('relation_user_firstlabel',array('user_id'=>$user_id))->result_array();
            foreach($first_label as $first_label_item)
            {
                $data[]=$this->first_label_model->get_first_label_by_id($first_label_item['first_label_id']);
            }
            return $data;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_first_label_from_user_by_id($user_id=-1,$first_label_id=-1)
    {
        $this->load->model('second_label_model');
        $this->load->model('user_and_second_label_model');
        if($user_id<=0||$first_label_id<=0)
            return null;
        else
        {
            $second_label=$this->second_label_model->get_second_label_by_first_id($first_label_id);
            if($second_label==null)
                return null;
            foreach ($second_label as $second_label_item)
                if($this->user_and_second_label_model->remove_second_label_from_user_by_id($user_id,$second_label_item['id'])==false)
                    return false;

            if($this->db->delete('relation_uer_firstlabel',array('user_id'=>$user_id,'first_label_id'=>$first_label_id))==false)
                return false;
            return true;

        }
    }

    public function remove_by_user_id($user_id=-1)
    {
        if($relation_to_be_delete=$this->get_first_label_by_user_id($user_id))
            return null;
        foreach ($relation_to_be_delete as $item)
        {
            $result=$this->remove_first_label_from_user_by_id($user_id,$item['first_label_id']);
            if($result==null||$result==false)
                return $result;
        }
    }
}