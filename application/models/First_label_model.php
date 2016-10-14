<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 13:55
 */
class First_label extends CI_Model
{
    /**
     * 获得所有一级标签
     *
     * 查找所有一级标签，返回所有一级标签的一个数组；
     *
     * @return null OR array $data
     */
    public function get_first_label()
    {
        return $this->db->get('first_label')->result_array();
    }

    /**
     * 获得指定一级标签
     *
     * 通过一级标签ID查找标签。函数接受一个参数标签ID，如果合法（id>0），返回该一级标签；
     *
     * @param int $id
     * @return null OR $data
     */
    public function get_first_label_by_id($id=-1)
    {
        if($id<0)
            return null;
        else
            return $this->db->get_where('first_label',array('id'=>$id));
    }

}