<?php

/**
 * Class First_label_model
 *
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败   一级标签信息： id name
 *
 * 获取所有一级标签  返回所有一级标签信息组成的多维数组
 * public function get_first_label()
 *
 * 根据提供的 id 查找指定一级标签  返回一级标签信息的单行数组
 * public function get_first_label_by_id($id=-1)
 *
 * 根据提供的活动 id 查找对应的一级标签  返回一级标签信息的单行数组
 * public function get_first_label_by_activity_id($activity_id=-1)
 *
 * 根据提供的二级标签 id 查找对应的一级标签  返回一级标签信息的多维数组
 * public function get_first_label_by_second_id($second_label_id=-1)
 *
 * 提供一级标签名字 创建新一级标签插入数据库中
 * public function insert_new_first_label($first_label_name = null)
 */
class First_label_model extends CI_Model
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
    public function get_first_label_by_id($id = -1)
    {
        if ($id < 0)
            return null;
        else
            return $this->db->get_where('first_label', array('id' => $id))->row_array();
    }

    /**
     * 获得活动的一级标签
     *
     * 通过活动ID查找它的一级标签。函数接受一个参数活动ID，如果合法（id>0），返回它的一级标签；
     *
     * @param int $activity_id
     * @return null OR $data
     */
    public function get_first_label_by_activity_id($activity_id = -1)
    {
        $this->load->model('activity_model');
        $activity = $this->activity_model->get_activity_by_id($activity_id);
        if ($activity == null)
            return null;
        else {
            return $this->get_first_label_by_id($activity['first_label_id']);
        }
    }

    /**
     * 获得二级标签所属一级标签
     *
     * 通过二级标签ID查找它的一级标签。函数接受一个参数二级标签ID，如果合法（id>0），返回它的一级标签；
     *
     * @param int $second_label_id
     * @return null OR $data
     */
    public function get_first_label_by_second_id($second_label_id = -1)
    {
        $this->load->model('Second_label_model');
        $second_label = $this->Second_label_model->get_second_label_by_id($second_label_id);
        if ($second_label == null)
            return null;
        else {
            return $this->get_first_label_by_id($second_label['first_label_id']);
        }
    }

    public function insert_new_first_label($first_label_name = null)
    {
        if ($first_label_name == null)
            return null;
        if ($this->db->insert('first_label', array('name' => $first_label_name)) == false)
            return false;
        return true;
    }
}