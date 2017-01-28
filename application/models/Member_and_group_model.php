<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2017/1/28
 * Time: 18:58
 */
class Member_and_group_model extends CI_Model
{
    public function get_members_by_group_id($group_id=-1){
        if($group_id <=0)
            return null;
        else{

        }
    }

    public function get_groups_by_user_id($use_id=-1){
        if($use_id<=0)
            return null;
        else{
            
        }
    }


    public function remove_member_from_group_by_id($group_id=-1,$member_id=-1){

    }

    public function remove_by_group_id($group_id){

    }

}