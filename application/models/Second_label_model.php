<?php

/**
 * Created by PhpStorm.
 * User: 10040
 * Date: 2016/10/13
 * Time: 14:00
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
    public function get_second_label_by_id($id=-1)
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
    public function get_second_label_by_activity_id($activity_id=-1)
    {
        $this->load->model('activity_model');
        $activity=$this->activity_model->get_activity_by_id($activity_id);
        if($activity==null)
            return null;
        else
        {
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
    public function get_second_label_by_first_id($first_label_id=-1)
    {
        if ($first_label_id < 0)
            return null;
        else
            return $this->db->get_where('second_label', array('first_label_id' => $first_label_id))->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_by_id($second_label_id=-1)
    {
        if($second_label_id<=0)
            return null;
        else
        {
            $this->load->model('user_and_second_label');
            if($this->user_and_second_label->remove_by_second_label_id($second_label_id)==false)
                return false;

            if($this->db->delete('second_label',array('id'=>$second_label_id))==false)
                return false;
            return true;
        }
    }

    public function remove_second_label_by_first_id($first_label_id=-1)
    {
        $second_label_to_be_delete=$this->get_second_label_by_first_id($first_label_id);
        foreach ($second_label_to_be_delete as $second_label_item_to_be_delete)
        {
            $result=$this->remove_by_id($second_label_item_to_be_delete['id'])==false;
            if($result==null||$result==false)
                return $result;
        }
    }
}