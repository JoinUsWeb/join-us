<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2017/1/28
 * Time: 18:58
 */
class Member_and_group_model extends CI_Model
{
    public function __construct(){
        $this->load->model('Group_model');
        $this->load->model('User_model');
    }

    public function get_members_by_group_id($group_id=-1){
        if($group_id <=0)
            return null;
        else{
            $data = array();
            $relation = $this->db->get_where('relation_group_members', array('group_id' => $group_id))->result_array();
            foreach ($relation as $relation_item) {
                $data[] = $this->User_model->get_user_by_id($relation_item['user_id']);
            }
            return $data;
        }
    }

    /**
     * 返回小组的成员和组长，返回一个user的数组
     * @param int $group_id
     * @return array|null
     */
    public function get_all_members_by_group_id($group_id=-1){
        if($group_id<=0)
            return null;
        else{
            $this->load->model('Group_model');
            $data=$this->get_members_by_group_id($group_id);
            $group=$this->Group_model->get_group_by_id($group_id);
            if(!empty($group))
                $data[]=$this->User_model->get_user_by_id($group['leader_id']);
        }
        return $data;
    }

    public function get_groups_by_user_id($user_id=-1){
        if($user_id<=0)
            return null;
        else{
            $data = array();
            $relation = $this->db->get_where('relation_group_members', array('user_id' => $user_id))->result_array();
            foreach ($relation as $relation_item) {
                $data[] = $this->Group_model->get_group_by_id($relation_item['group_id']);
            }
            return $data;
        }
    }

    public function get_members_of_all_group_joined_by_user_id($user_id = -1, $group_id_as_leader = -1)
    {
        $groups = array_merge($this->get_groups_by_user_id($user_id), $group_id_as_leader);
        if (empty($groups))
            return null;
        $all_member = array();
        foreach ($groups as $group){
            $all_member = array_merge($all_member,$this->get_all_members_by_group_id($group['id']));
        }
        if (empty($all_member))
            return null;
        $distinct_member = array();
        foreach ($all_member as $member){
            $distinct_member[$member['id']] = $member;
        }
        if (empty($distinct_member))
            return null;
        unset($distinct_member["$user_id"]);
        return $distinct_member;
    }

    public function remove_member_from_group_by_id($group_id=-1,$member_id=-1){
        if($group_id<=0|$member_id<=0)
            return false;
        else{
            return $this->db->delete('relation_group_members',array('group_id'=>$group_id,'user_id'=>$member_id));
        }
    }

    public function remove_by_group_id($group_id=-1){
        if($group_id<=0)
            return false;
        else{
            return $this->db->delete('group',array('group_id'=>$group_id));
        }
    }

    public function insert_new_member_to_group($user_id,$group_id){
        //如果返回的不为空，则已有记录，返回插入失败
        if(!empty($this->db->get_where('relation_group_members',array('user_id'=>$user_id,'group_id'=>$group_id))->row_array()))
            return false;
        else{
            $this->db->insert('relation_group_members',array('user_id'=>$user_id,'group_id'=>$group_id));
            $group=$this->Group_model->get_group_by_id($group_id);
            $group['member_number']++;
            $this->db->set('member_number',$group['member_number']+1)->update('group');
            return true;
        }
    }
}