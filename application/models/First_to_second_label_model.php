<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/13
 * Time: 23:08
 */
class First_to_second_label
{
    public function __construct(){
        $this->load->model('first_label_model');
        $this->load->model('second_label_model');
    }

    /**
     * 获得二级标签所属一级标签
     *
     * 通过二级标签ID查找它的一级标签。函数接受一个参数二级标签ID，如果合法（id>0），返回它的一级标签；
     *
     * @param int $second_label_id
     * @return null OR $data
     */
    public function get_first_label_by_second_id($second_label_id=-1)
    {
        $second_label=$this->second_label_model->get_second_label_by_id($second_label_id);
        if($second_label==null)
            return null;
        else
        {
            return $this->user_model->get_first_label_by_id($second_label['first_label_id'])->row_array();
        }
    }

    /**
     * 获得一级标签下的二级标签
     *
     * 通过一级标签ID查找属于它的二级标签。函数接受一个参数一级标签ID，如果合法（id>0），返回属于它的二级标签的一个数组；
     *
     * @param int $first_label_id
     * @return null OR array $data
     */
    public function get_second_label_by_first_id($first_label_id=-1)
    {
        if ($first_label_id < 0)
            return null;
        else
            return $this->db->get_where('second_label', array('first_label_id' => $first_label_id))->result_array();
    }
}