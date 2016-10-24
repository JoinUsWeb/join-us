<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/17
 * Time: 21:04
 */
class User extends CI_Controller
{

    var $user_id = -1;

    /**
     * 使用检查cookie来实现
     */
    private function get_user_id()
    {

    }

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->user_id = $this->get_user_id();
        // For Test
        $this->user_id = 1;
    }

    /**
     * 需要根据活动参加实践和现在的时间进行比较 再做筛选  以下实现并没有起到实际效果
     */
    public function applied()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";

        $row_activities_info = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);
        $current_date = date("Y-m-d");
        foreach ($row_activities_info as $single_activity_info) {
            $activity_date = date_create($single_activity_info['time_expire'])->format("Y-m-d");
            if (strtotime($current_date) > strtotime($activity_date)) {
                $data['activities_info'][] = $single_activity_info;
            }
        }

        $this->load->view('person_related/personal_applied', $data);
    }

    public function comments()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";

        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('person_related/personal_comments', $data);
    }

    public function info()
    {
        $data['title'] = "个人中心";
        $this->load->model('User_model');
        $data['user_info'] = $this->User_model->get_user_by_id($this->user_id);

        $this->load->view('person_related/personal_info', $data);
    }


    /**
     * 需要根据活动是否被收藏进行筛选  以下实现并没有起到实际效果
     */
    public function favorites()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";

        //需修改
        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('person_related/personal_favorites', $data);
    }

    public function joined()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";

        $row_activities_info = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);
        $current_date = date("Y-m-d");
        foreach ($row_activities_info as $single_activity_info) {
            $activity_date = date_create($single_activity_info['time_expire'])->format("Y-m-d");
            if (strtotime($current_date) <= strtotime($activity_date)) {
                $data['activities_info'][] = $single_activity_info;
            }
        }

        $this->load->view('person_related/personal_joined', $data);
    }
}