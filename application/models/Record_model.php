<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017-05-12
 * Time: 19:12
 */
class Record_model extends CI_Model
{
    public function insert_new_page_record($page_name = null){
        if ($page_name == null) return null;
        $this->db->insert("page_record",array("page_name"=>$page_name,"browse_date_time"=>date("Y-m-d H:i:s")));
    }
}