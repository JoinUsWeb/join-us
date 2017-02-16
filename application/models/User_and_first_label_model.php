<?php

/**
 * Class User_and_first_label_model
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败  关系结构  user_id   first_label_id
 *
 * 根据提供的一级标签 id  获得所有有这个标签的用户信息的多维数组
 * public function get_user_by_first_label_id($first_label_id = -1)
 *
 * 根据提供的用户 id   获取该用户的所有一级标签的多维数组
 * public function get_first_label_by_user_id($user_id = -1)
 *
 * 根据提供的用户 id 和一级标签 id  删除对应用用户下的选定一级标签
 * public function remove_first_label_from_user_by_id($user_id = -1, $first_label_id = -1)
 *
 * 根据提供的用户 id   删除该用户的所有的一级标签
 * public function remove_by_user_id($user_id = -1)
 *
 * 根据提供的用户 id 和 一级标签 id   创建新的并插入数据库
 * public function insert_new_relation($user_id = -1, $first_label = -1)
 */
class User_and_first_label_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('First_label_model');
    }

    /**
     * 获得一级标签下的用户
     *
     * 通过一级标签ID查找其成员。函数接受一个参数标签ID，如果合法（id>0），返回此标签下用户的一个数组
     *
     * @param int $first_label_id
     * @return null OR array $data
     */
    public function get_user_by_first_label_id($first_label_id = -1)
    {
        if ($first_label_id <= 0)
            return null;
        else {
            $data = array();
            $user = $this->db->get_where('relation_user_firstlabel', array('first_label_id' => $first_label_id))->result_array();
            foreach ($user as $user_item) {
                $data[] = $this->User_model->get_user_by_id($user_item['user_id']);
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
    public function get_first_label_by_user_id($user_id = -1)
    {
        if ($user_id <= 0)
            return null;
        else {
            $data = array();
            $first_label = $this->db->get_where('relation_user_firstlabel', array('user_id' => $user_id))->result_array();
            foreach ($first_label as $first_label_item) {
                $data[] = $this->First_label_model->get_first_label_by_id($first_label_item['first_label_id']);
            }
            return $data;
        }
    }

    public function query_exist($user_id = -1, $first_label_id = -1){
        if ($user_id == -1 || $first_label_id == -1)
            return null;
        return $this->db->get_where("relation_user_firstlabel",array('user_id' => $user_id, 'first_label_id' => $first_label_id))->row_array();
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_first_label_from_user_by_id($user_id = -1, $first_label_id = -1)
    {
        $this->load->model('second_label_model');
        $this->load->model('user_and_second_label_model');
        if ($user_id <= 0 || $first_label_id <= 0)
            return null;
        else {
            $second_label = $this->Second_label_model->get_second_label_by_first_id($first_label_id);
            if ($second_label == null)
                return null;
            foreach ($second_label as $second_label_item)
                if ($this->User_and_second_label_model->remove_second_label_from_user_by_id($user_id, $second_label_item['id']) == false)
                    return false;

            if ($this->db->delete('relation_user_firstlabel', array('user_id' => $user_id, 'first_label_id' => $first_label_id)) == false)
                return false;
            return true;

        }
    }

    public function remove_by_user_id($user_id = -1)
    {
        if ($relation_to_be_delete = $this->get_first_label_by_user_id($user_id))
            return null;
        foreach ($relation_to_be_delete as $item) {
            $result = $this->remove_first_label_from_user_by_id($user_id, $item['first_label_id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    /**
     *
     * 获取用户ID和一级标签ID
     *
     * 两个ID如果不合法，返回null
     *
     * 如果合法，插入 （user_id, first_label_id） ，如果失败返回false
     *
     * @param int $user_id
     * @param int $first_label
     * @return bool|null
     */

    public function insert_new_relation($user_id = -1, $first_label = -1)
    {
        if ($user_id <= 0 || $first_label <= 0)
            return null;
        else {
            $data = array(
                'first_label_id' => $first_label,
                'user_id' => $user_id);
            if (($result = $this->db->get_where("relation_user_firstlabel",$data)->result_array()) == null){
                if ($this->db->insert("relation_user_firstlabel", $data) == false)
                    return false;
                return true;
            }
            return false;
        }
    }
}