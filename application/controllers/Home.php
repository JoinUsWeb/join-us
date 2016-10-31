<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/22
 * Time: 20:01
 */
class Home extends CI_Controller
{
    var $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->model('First_label_model');
        $this->load->model("User_and_first_label_model");
        $this->load->helper('url');
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
        } else {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = "个人主页";
        $hot_activity = $this->Activity_model->get_activity_order_by_score(3);

        $recommended_activity = $this->get_recommended_activity();

        $data['title'] = 'Home';
        $data['page_name']="home";
        $data['hot_activity'] = $hot_activity;
        $data['recommended_activity'] = $recommended_activity;

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('home/home', $data);
        $this->load->view('template/footer');
    }

    public function get_recommended_activity()
    {
        $activity = array();
        $first_label = $this->User_and_first_label_model->get_first_label_by_user_id($this->user_id);
        foreach ($first_label as $first_label_item) {
            $activity_part = $this->Activity_model->get_activity_by_first_label_id($first_label_item['id']);
            $activity = array_merge($activity, $activity_part);
        }
        return $activity;
    }
}