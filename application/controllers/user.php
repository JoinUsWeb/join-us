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

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
        } else {
            redirect('login');
        }
    }

    /**
     * 需要根据活动参加实践和现在的时间进行比较 再做筛选  以下实现并没有起到实际效果
     */
    public function applied()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "applied";

        $row_activities_info = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);
        $current_date = date("Y-m-d");
        $data['activities_info'] = array();
        foreach ($row_activities_info as $single_activity_info) {
            $activity_date = date_create($single_activity_info['time_expire'])->format("Y-m-d");
            // 查看活动是否已经结束 结束代表已经参加过
            if (strtotime($current_date) > strtotime($activity_date)) {
                $data['activities_info'][] = $single_activity_info;
            }
        }
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_applied', $data);
        $this->load->view('template/footer');
    }

    public function comments()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "comments";

        $data['activities_info'] = null;
        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_comments', $data);
        $this->load->view('template/footer');
    }

    public function info()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = "info";
        $this->load->model('User_model');
        $this->load->model('User_and_first_label_model');

        $data['user_info'] = $this->User_model->get_user_by_id($this->user_id);
        $data['user_info']['interest'] = $this->User_and_first_label_model->get_first_label_by_user_id($this->user_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_info', $data);
        $this->load->view('template/footer');
    }


    /**
     * 需要根据活动是否被收藏进行筛选  以下实现并没有起到实际效果
     */
    public function favorites()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "favorites";

        //需修改  没有判断是否是收藏了
        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_favorites', $data);
        $this->load->view('template/footer');
    }

    public function joined()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "joined";

        $row_activities_info = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);
        $current_date = date("Y-m-d");
        $data['activities_info'] = array();
        foreach ($row_activities_info as $single_activity_info) {
            $activity_date = date_create($single_activity_info['time_expire'])->format("Y-m-d");
            if (strtotime($current_date) <= strtotime($activity_date)) {
                $data['activities_info'][] = $single_activity_info;
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_joined', $data);
        $this->load->view('template/footer');
    }

    public function group()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = 'group';

    }

    public function detail()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = 'group_detail';

    }

    public function edit()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = 'edit';

    }
}