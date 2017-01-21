<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/22
 * Time: 18:09
 */
class Search_activity_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('Activity_model');
    }

    public function search_activity($first_label_id, $city, $time)
    {
        $quiry = array();
        if ($first_label_id != 0)
            $quiry['first_label_id'] = $first_label_id;
        if ($city != 0)
            $quiry['city'] = $city;
        if ($time != 0) {
            if ($time == 1)
                $earlier_than = date('y-m-d', strtotime('+1 month'));
            if ($time == 2)
                $earlier_than = date('y-m-d', strtotime('+2 month'));
            if ($time == 3)
                $earlier_than = date('y-m-d', strtotime('+3 month'));
            $quiry['date_start <'] = $earlier_than;
        }
        if (empty($quiry))
            $activity = $this->db->get('activity')->result_array();
        else {
            $activity = $this->db->where($quiry)->get('activity')->result_array();
        }

        return $activity;

    }
}