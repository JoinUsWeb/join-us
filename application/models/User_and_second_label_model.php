<?php

/**
 * Class User_and_second_label_model
 *
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败  关系结构  user_id   second_label_id
 *
 * 根据提供的二级标签 id   返回有这个标签的所有用户的信息的多维数组
 * public function get_user_by_second_label_id($second_label_id = -1)
 *
 * 根据提供的用户 id   返回这个用户下所有二级标签的多维数组
 * public function get_second_label_by_user_id($user_id = -1)
 *
 * 根据提供的用户 id 和 二级标签 id   删除该用户下的选定二级标签
 * public function remove_second_label_from_user_by_id($user_id = -1, $second_label_id = -1)
 *
 * 根据提供的二级标签 id   删除含有该二级标签的所有用户
 * public function remove_by_second_label_id($second_label_id = -1)
 *
 * 根据提供的用户 id   删除该用户下的所有二级标签
 * public function remove_by_user_id($user_id = -1)
 *
 * 根据提供的用户 id 和 二级标签 id   创建新的条目并插入数据库
 * public function insert_new_relation($user_id = -1, $second_label_id = -1)
 */
class User_and_second_label_model extends CI_Model
{

    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('Second_label_model');
    }

    /**
     * 获得二级标签下的用户
     *
     * 通过二级标签ID查找其成员。函数接受一个参数标签ID，如果合法（id>0），返回此标签下用户的一个数组
     *
     * @param int $second_label_id
     * @return null OR array $data
     */
    public function get_user_by_second_label_id($second_label_id = -1)
    {
        if ($second_label_id <= 0)
            return null;
        else {
            $data = array();
            $user = $this->db->get_where('relation_user_secondlabel', array('second_label_id' => $second_label_id))->result_array();
            foreach ($user as $user_item) {
                $data[] = $this->User_model->get_user_by_id($user_item['user_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户的二级标签
     *
     * 通过用户ID查找其二级标签。函数接受一个参数用户ID，如果合法（id>0），返回该用户标签的一个数组
     *
     * @param int $user_id
     * @return null OR array $data
     */
    public function get_second_label_by_user_id($user_id = -1)
    {
        if ($user_id <= 0)
            return null;
        else {
            $data = array();
            $second_label = $this->db->get_where('relation_user_secondlabel', array('user_id' => $user_id))->result_array();
            foreach ($second_label as $second_label_item) {
                $data[] = $this->Second_label_model->get_second_label_by_id($second_label_item['second_label_id']);
            }
            return $data;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_second_label_from_user_by_id($user_id = -1, $second_label_id = -1)
    {
        if ($user_id <= 0 || $second_label_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_user_secondlabel', array('user_id' => $user_id, 'second_label_id' => $second_label_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_by_second_label_id($second_label_id = -1)
    {
        if ($second_label_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_user_secondlabel', array('second_label_id' => $second_label_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_by_user_id($user_id = -1)
    {
        if ($user_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_user_secondlabel', array('user_id' => $user_id)) == false)
                return false;
            return true;
        }
    }

    /**
     *
     * 获取用户ID，二级标签ID
     *
     * 如果两个ID不合法，返回null
     *
     * 如果合法，插入 （user_id，second_label_id） 关系，失败返回false
     *
     * @param int $user_id
     * @param int $second_label_id
     * @return bool|null
     */
    public function insert_new_relation($user_id = -1, $second_label_id = -1)
    {
        if ($user_id <= 0 || $second_label_id <= 0)
            return null;
        else {
            $data = array(
                'user_id' => $user_id,
                'second_label_id' => $second_label_id);
            if ($this->db->insert('relation_user_secondlabel', $data) == false)
                return false;
            return true;
        }

    }
}