<?php

class Group_model extends CI_Model
{
    public function get_group(){
        return $this->db->get("group")->row_array();
    }

    public function get_group_by_id($group_id=-1){
        if($group_id<=0)
            return null;
        else
            return $this->db->get_where('group',array('id'=>$group_id))->row_array();
    }

    public function get_group_by_activity_id($activity_id=-1){
        if($activity_id<=0)
            return null;
        else
            return $this->db->get_where("group",array("activity_id"=>$activity_id))->row_array();
    }

    public function get_groups_by_leader_id($leader_id=-1){
        if($leader_id<=0)
            return null;
        else
            return $this->db->get_where("group",array("leader_id"=>$leader_id))->result_array();
    }

    public function remove_group_by_id($group_id=-1){
        if ($group_id <= 0)
            return null;
        else {
            $this->load->model('Member_and_group_model');

            if ($this->Member_and_group_model->remove_by_group_id($group_id) == false)
                return false;
            return $this->db->delete('group', array('id' => $group_id));
        }
    }

    /**
     * group_info: leader_id、name、activity_id
     * @param $group_info
     * @return boolean
     */
    public function insert_new_group($group_info=null){
        if(isset($group_info['leader_id'])&&isset($group_info['name'])&&isset($group_info['activity_id'])){
            $data=array();
            $data['leader_id']=$group_info['leader_id'];
            $data['name']=$group_info['name'];
            $data['announcement']='';
            $data['member_number']=0;
            $data['activity_id']=$group_info['activity_id'];
            return $this->db->insert('group',$data)==false;
        }
        else
            return false;
    }

    /**
     * data:leader_id、name、activity_id、announcement、member_number
     * @param $data
     * @return bool|array
     */
    public function update($data=null){
        if(isset($data['id'])&&isset($data['leader_id'])&&isset($data['name'])&&isset($data['activity_id'])
            &&isset($data['announcement'])&&isset($data['member_number'])){
            $new_data=array();
            $new_data['id']=$data['id'];
            $new_data['leader_id']=$data['leader_id'];
            $new_data['name']=$data['name'];
            $new_data['activity_id']=$data['activity_id'];
            $new_data['announcement']=$data['announcement'];
            $new_data['member_number']=$data['member_number'];
            return $this->db->updata('group',$new_data);
        }
        else
            return false;
    }

    public function update_announcement_by_group_id($group_id=-1,$announcement=''){
        $data=$this->get_group_by_id($group_id);
        if(empty($data))
            return false;
        $data['announcement']=$announcement;
        return $this->db->update('group',$data);
    }

}