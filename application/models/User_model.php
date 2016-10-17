<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 13:14
 */
class User_model extends CI_Model
{
    /**
     * 获得所有用户
     *
     * 查找所有用户，返回所有用户的一个数组；
     *
     * @return null OR array $data
     */
    public function get_user()
    {
        return $this->db->get('user')->result_array();
    }

    /**
     * 获得指定用户
     *
     * 通过用户ID查找用户。函数接受一个参数用户ID，如果合法（id>0），返回该用户；
     *
     * @param int $id
     * @return null OR $data
     */
    public function get_user_by_id($id=-1){
        if($id<0)
            return null;
        else
            return $this->db->get_where('user',array('id'=>$id))->row_array();
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
        $this->load->model('activity_model');
        $activity=$this->activity_model->get_activity_by_id($activity_id);
        if($activity==null)
            return null;
        else
        {
            return $this->get_user_by_id($activity['creator_id']);
        }
    }

    public function get_user_by_email($email=-1){
        return $this->db->get_where('user',array('email'=>$email))->row_array();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_by_id($user_id=-1)
    {
        if($user_id<=0)
            return null;
        else
        {
            $this->load->model('member_and_activity_model');
            $this->load->model('browser_and_trace');
            $this->load->model('user_and_first_label');
            $this->load->model('user_and_second_label');

            if($this->member_and_activity_model->remove_by_user_id($user_id)==false)
                return false;
            if($this->browser_and_trace->remove_by_browser_id($user_id)==false)
                return false;
            if($this->user_and_first_label->remove_by_user_id($user_id)==false)
                return false;
            if($this->user_and_second_label->remove_by_user_id($user_id)==false)
                return false;

            if($this->db->delete('user',array('id'=>$user_id))==false)
                return false;
            return true;
        }
    }

    /**
     *
     * array_for_user_info = array(
     *      email  nick_name  password  phone_number )
     *
     * @param null $array_for_user_info
     * @return bool|null
     */
    public function insert_new_user_info($array_for_user_info = null){
        if ($array_for_user_info == null)
            return null;
        if ($this->db->insert('first_label',array('name' => $array_for_user_info)) == false)
            return false;
        return true;
    }

    /**
     *
     * array_for_user_info = array(
     *      email  nick_name  password  phone_number )
     *
     * @param int $user_id
     * @param null $array_for_user_info
     * @return bool|null
     */
    public function update_user_info_by_id($user_id = -1, $array_for_user_info = null){
        if ($user_id <= 0 || $array_for_user_info == null)
            return null;
        $this->db->where('id',$user_id);
        if ($this->db->updat('user',$array_for_user_info) == false)
            return false;
        return true;
    }
}