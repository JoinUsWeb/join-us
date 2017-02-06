<?php

class Group_model extends CI_Model
{
    public function get_group_by_id(){
        return $this->db->get("group");
    }

    public function get_group_by_activity_id($activity_id=-1){
        if($activity_id<=0)
            return null;
        else
            return $this->db->get_where("group",array("activity_id"=>$activity_id))->result_array();
    }

    public function get_group_by_creator_id($creator_id=-1){
        if($creator_id<=0)
            return null;
        else
            return $this->db->get_where("group",array("creator_id"=>$creator_id))->result_array();
    }

    public function remove_group_by_id($group_id){
        if ($group_id <= 0)
            return null;
        else {
            $this->load->model('Member_and_group_model');

            if ($this->Member_and_group_model->remove_by_group_id($group_id) == false)
                return false;
            if ($this->db->delete('group', array('id' => $group_id)) == false)
                return false;
            return true;
        }
    }

    /**
     * group_info: leader_id、name、activity_id
     * @param $group_info
     * @return boolean
     */
    public function insert_new_group($group_info){
        if(isset($group_info['leader_id'])&&isset($group_info['name'])&&isset($group_info['activity_id'])){
            $data=array();
            $data['leader_id']=$group_info['leader_id'];
            $data['name']=$group_info['name'];
            $data['activity_id']=$group_info['activity_id'];
            return $this->db->insert('group',$data)==false;
        }
        else
            return false;
    }

}