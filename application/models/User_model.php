<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 13:14
 */
class User extends CI_Model
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
}