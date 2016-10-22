<?php

/**
 * Class Activity_model
 *
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败
 * 活动信息： name  time_expire  time_start  place  brief  amount_max  creator_id  first_label_id
 *            second_label_id  score
 *
 * 获取所有活动  返回活动信息组成的多维数组
 * public function get_activity()
 *
 * 根据提供的活动 id   返回对应活动信息的单行数组
 * public function get_activity_by_id($id = -1)
 *
 * 根据提供的创建者的 id   返回Ta所创建 所有的活动信息的多维数组
 * public function get_activity_by_creator_id($creator_id = -1)
 *
 * 根据提供的一级标签 id   返回该标签下所有活动信息的多维数组
 * public function get_activity_by_first_label_id($first_label_id = -1)
 *
 * 根据提供的二级标签 id   返回该标签下所有活动信息的多维数组
 * public function get_activity_by_second_label_id($second_label_id = -1)
 *
 * 根据活动id 删除对应活动
 * public function remove_by_id($activity_id=-1)
 *
 * 根据创建者id  删除该创建者创建的所有活动
 * public function remove_activity_by_creator_id($creator_id = -1)
 *
 * 根据一级标签id   删除该一级标签下所有活动
 * public function remove_activity_by_first_label_id($first_label_id = -1)
 *
 * 根据二级标签id   删除该而级标签下所有活动
 * public function remove_activity_by_second_label_id($second_label_id = -1)
 *
 * 根据提供活动信息   创建新活动条目并插入数据库
 * public function insert_new_activity($activity_info = null)
 *
 * 根据提供活动 id 和 新的该活动信息的数组  修改对应活动条目
 * public function update_activity_by_id($activity_id = -1, $array_for_update = null)
 */
class Activity_model extends CI_Model
{
    /**
     * 获得所有活动
     *
     * 查找所有活动。返回所有活动的一个数组；
     *
     * @return null OR array $data
     */
    public function get_activity()
    {
        return $this->db->get('activity')->result_array();
    }

    public function get_activity_order_by_score($limit=-1)
    {
        if($limit<=0)
            return $this->db->get('activity')->order_by('score','DESC')->result_array();
        else
            return $this->db->limit($limit)->get('activity')->order_by('score','DESC')->result_array();
    }

    /**
     * 获得指定活动
     *
     * 通过活动ID查找活动。函数接受一个参数活动ID，如果合法（id>0），返回该活动；
     *
     * @param int $id
     * @return null OR $data
     */
    public function get_activity_by_id($id = -1)
    {
        if ($id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('id' => $id))->row_array();
    }

    /**
     * 获得用户创建的活动
     *
     * 通过用户ID查找他创建的活动。函数接受一个参数用户ID，如果合法（id>0），返回他创建的活动的一个数组；
     *
     * @param int $creator_id
     * @return null OR array $data
     */
    public function get_activity_by_creator_id($creator_id = -1)
    {
        if ($creator_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('creator_id' => $creator_id))->result_array();
    }

    /**
     * 获得一级标签下的活动
     *
     * 通过一级标签ID查找属于它的活动。函数接受一个参数标签ID，如果合法（id>0），返回属于它的活动的一个数组；
     *
     * @param int $first_label_id
     * @return null OR array $data
     */
    public function get_activity_by_first_label_id($first_label_id = -1)
    {
        if ($first_label_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('first_label_id' => $first_label_id))->result_array();
    }

    /**
     * 获得二级标签下的活动
     *
     * 通过二级标签ID查找属于它的活动。函数接受一个参数标签ID，如果合法（id>0），返回属于它的活动的一个数组；
     *
     * @param int $second_label_id
     * @return null OR array $data
     */
    public function get_activity_by_second_label_id($second_label_id = -1)
    {
        if ($second_label_id < 0)
            return null;
        else
            return $this->db->get_where('activity', array('second_label_id' => $second_label_id))->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_by_id($activity_id = -1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            $this->load->model('Member_and_activity_model');
            $this->load->model('Browser_and_trace_model');

            if ($this->Member_and_activity_model->remove_by_activity_id($activity_id) == false)
                return false;
            if ($this->Browser_and_trace_model->remove_by_activity_id($activity_id) == false)
                return false;
            if ($this->db->delete('activity', array('id' => $activity_id)) == false)
                return false;
            return false;
        }
    }

    public function remove_activity_by_creator_id($creator_id = -1)
    {
        $activity_to_be_delete = $this->get_activity_by_creator_id($creator_id);
        foreach ($activity_to_be_delete as $activity_item_to_be_delete) {
            $result = $this->remove_by_id($activity_item_to_be_delete['id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    public function remove_activity_by_first_label_id($first_label_id = -1)
    {
        $activity_to_be_delete = $this->get_activity_by_first_label_id($first_label_id);
        foreach ($activity_to_be_delete as $activity_item_to_be_delete) {
            $result = $this->remove_by_id($activity_item_to_be_delete['id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    public function remove_activity_by_second_label_id($second_label_id = -1)
    {
        $activity_to_be_delete = $this->get_activity_by_second_label_id($second_label_id);
        foreach ($activity_to_be_delete as $activity_item_to_be_delete) {
            $result = $this->remove_by_id($activity_item_to_be_delete['id']);
            if ($result == null || $result == false)
                return $result;
        }
    }

    /**
     *
     * data = array(
     *      name  time_expire  time_start  place  brief  amount_max  creator_id  first_label_id
     *      second_label_id  score poster)
     *
     * @param $activity_info
     * @return bool|null
     */
    public function insert_new_activity($activity_info = null)
    {
        if ($activity_info == null)
            return null;
        $activity_info['member_number']=0;
        if ($this->db->insert('activity', $activity_info) == false)
            return false;
        return true;
    }

    /**
     *
     * activity_info_array_for_update = array(
     *      name  time_expire  time_start  place  brief  amount_max  creator_id  first_label_id
     *      second_label_id  score)
     *
     * @param int $activity_id
     * @param $array_for_update
     * @return bool|null
     */
    public function update_activity_by_id($activity_id = -1, $array_for_update = null)
    {
        if ($array_for_update == null || $activity_id <= 0)
            return null;
        $this->db->where('id', $activity_id);
        if ($this->db->update('activity', $array_for_update) == false)
            return false;
        return true;
    }
}