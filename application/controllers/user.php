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

    private function get_user_id()
    {

    }

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->user_id = $this->get_user_id();
        $this->user_id = 1;
    }

    public function applied()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";

        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('person_related/personal_applied', $data);
    }

    public function comments()
    {
        $data['title'] = "个人中心";

        $this->load->view('person_related/personal_comments', $data);
    }

    public function info()
    {
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_info', $data);
    }

    public function favorites()
    {
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_favorites', $data);
    }

    public function joined()
    {
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_joined', $data);
    }
}