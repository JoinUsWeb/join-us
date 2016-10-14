<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 13:37
 */
class Activity extends CI_Model
{
    /**
     * 获得所有活动
     *
     * 查找所有活动。函数接受一个参数标签ID，如果合法（id>0），返回所有活动的一个数组；
     *
     * @return null OR array $data
     */
    public function get_activity()
    {
        return $this->db->get('activity')->result_array();
    }

    /**
     * 获得指定活动
     *
     * 通过活动ID查找活动。函数接受一个参数活动ID，如果合法（id>0），返回该活动；
     *
     * @param int $id
     * @return null OR $data
     */
    public function get_activity_by_id($id=-1)
    {
        if($id<0)
            return null;
        else
            return $this->db->get_where('activity',array('id'=>$id))->row_array();
    }
}