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
        return $this->db->get_where('admin', array('user_name' => $user_name));
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
}