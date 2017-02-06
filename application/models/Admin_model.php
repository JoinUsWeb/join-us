<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/1/28
 * Time: 11:57
 */
class Admin_model extends CI_Model
{

    public function get_admin_by_id($id = -1)
    {
        if ($id < 0)
            return null;
        return $this->db->get_where('admin', array('id' => $id));
    }

    public function get_admin_by_user_name($user_name = null)
    {
        if ($user_name == null)
            return null;
        return $this->db->get_where('admin', array('user_name' => $user_name))->row_array();
    }

    public function get_admin_id_by_user_name($user_name = null)
    {
        if ($user_name == null)
            return;
        $info = $this->get_admin_by_user_name($user_name);
        if ($info == false)
            return false;
        return $info['id'];
    }

    public function validate_admin($user_name = null, $password = null)
    {
        if ($user_name == null || $password == null)
            return null;
        $info = $this->get_admin_by_user_name($user_name);
        if ($info['password'] == $password)
            return true;
        return false;
    }

    public function get_activity_by_admin_id($id = -1)
    {
        $this->load->model('User_model');
        $info = $this->db
            ->join('relation_admin_firstlabel', 'relation_admin_firstlabel.admin_id = ' . $id)
            ->where('activity.first_label_id = relation_admin_firstlabel.first_label_id')
            ->get('activity')
            ->result_array();
        $length = count($info);
        for ($index = 0; $index < $length; $index++) {
            $info[$index]['creator_name'] = $this->User_model->get_user_by_id($info[$index]['creator_id'], 'nick_name');
        }
        return $info;
    }

    public function get_activity_detail_by_activity_id($id = -1){
        if ($id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('id' => $id))->row_array();
    }
}
