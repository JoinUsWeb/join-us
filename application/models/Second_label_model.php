<?php

/**
 * Class Second_label_model
 *
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败   二级标签信息： id  name  first_label_id
 *
 * 获取所有二级标签   返回所有二级标签信息组成的的多维数组
 * public function get_second_label()
 *
 * 根据提供的 id 查找指定二级标签  返回二级标签信息的单行数组
 * public function get_second_label_by_id($id = -1)
 *
 * 根据提供的活动 id 查找对应的二级标签  返回而级标签信息的单行数组
 * public function get_second_label_by_activity_id($activity_id = -1)
 *
 * 根据提供的一级标签 id 查找对应的二级标签  返回二级标签信息的数组
 * public function get_second_label_by_first_id($first_label_id = -1)
 *
 * 根据提供的二级标签 id 删除对应的二级标签、用户与二级标签关联表中二级标签id为提供id的条目
 * public function remove_by_id($second_label_id = -1)
 *
 * 根据提供的一级标签 id 删除对应的所有二级标签
 * public function remove_second_label_by_first_id($first_label_id = -1)
 *
 * 根据提供的二级标签名字和一级标签 id 创建新的二级标签并且插入数据库中
 * public function insert_new_second_label($second_label_name = null, $first_label_id = -1)
 *
 * 根据提供的二级标签 id 和 新的该二级标签信息的数组  修改对应二级标签信息
 * public function update_second_label_by_id($second_label_id = -1, $array_for_second_label = null)
 */
class Second_label_model extends CI_Model
{
    /**
     * 获得所有二级标签
     *
     * 查找所有二级标签，返回所有二级标签的一个数组；
     *
     * @return null OR array $data
     */
    public function get_second_label()
    {
        return $this->db->get('second_label')->result_array();
    }

    /**
     * 获得指定二级标签
     *
     * 通过二级标签ID查找标签。函数接受一个参数标签ID，如果合法（id>0），返回该二级标签；
     *
     * @param int $id
     * @return null OR $data
     */
    public function get_second_label_by_id($id = -1)
    {
        if ($id < 0)
            return null;
        else
            return $this->db->get_where('second_label', array('id' => $id))->row_array();
    }

    /**
     * 获得活动的二级标签
     *
     * 通过活动ID查找它的二级标签。函数接受一个参数活动ID，如果合法（id>0），返回它的二级标签；
     *
     * @param int $activity_id
     * @return null OR $data
     */
    public function get_second_label_by_activity_id($activity_id = -1)
    {
        $this->load->model('Activity_model');
        $activity = $this->Activity_model->get_activity_by_id($activity_id);
        if ($activity == null)
            return null;
        else {
            return $this->get_second_label_by_id($activity['second_label_id']);
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
    public function get_second_label_by_first_label_id($first_label_id = -1)
    {
        if ($first_label_id < 0)
            return null;
        else
            return $this->db->get_where('second_label', array('first_label_id' => $first_label_id))->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_by_id($second_label_id = -1)
    {
        if ($second_label_id <= 0)
            return null;
        else {
            $this->load->model('User_and_second_label_model');
            if ($this->User_and_second_label_model->remove_by_second_label_id($second_label_id) == false)
                return false;

            if ($this->db->delete('second_label', array('id' => $second_label_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_second_label_by_first_id($first_label_id = -1)
    {
        $second_label_to_be_delete = $this->get_second_label_by_first_label_id($first_label_id);
        foreach ($second_label_to_be_delete as $second_label_item_to_be_delete) {
            $result = $this->remove_by_id($second_label_item_to_be_delete['id']) == false;
            if ($result == null || $result == false)
                return $result;
        }
    }

    public function insert_new_second_label($second_label_name = null, $first_label_id = -1)
    {
        if ($second_label_name == null || $first_label_id <= 0)
            return null;
        $data = array(
            'name' => $second_label_name,
            'first_label_id' => $first_label_id
        );
        if ($this->db->insert('first_label', $data) == false)
            return false;
        return true;
    }

    /**
     *
     * array_for_second_label = array(
     *      name  first_label_id )
     *
     * @param int $second_label_id
     * @param null $array_for_second_label
     * @return bool|null
     */
    public function update_second_label_by_id($second_label_id = -1, $array_for_second_label = null)
    {
        if ($second_label_id <= 0 || $array_for_second_label == null)
            return null;
        $this->db->where('id', $second_label_id);
        if ($this->db->update('second_label', $array_for_second_label) == false)
            return false;
        return true;
    }
}