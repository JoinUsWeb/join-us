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
        $query = array();
        $earlier_than = null;
        if ($first_label_id != 0)
            $query['first_label_id'] = $first_label_id;
        if ($city != 0)
            $query['city'] = $city;
        if ($time != 0) {
            if ($time == 1)
                $earlier_than = date('Y-m-d H:i:s', strtotime('+1 month'));
            else if ($time == 2)
                $earlier_than = date('Y-m-d H:i:s', strtotime('+2 month'));
            else if ($time == 3)
                $earlier_than = date('Y-m-d H:i:s', strtotime('+3 month'));
            $query['date_time_start < '] = $earlier_than;
        }
        if (empty($query))
            $activity = $this->Activity_model->get_activity();
        else {
            $query['isVerified'] = 1;
            $activity = $this->Activity_model->get_activity_by_where_string($query);
        }

        return $activity;

    }
}