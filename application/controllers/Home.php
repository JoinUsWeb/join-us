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
        $this->load->model('Recommend_activity_model');
        $this->load->helper(array('url', 'form'));
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
        $rolling_activity = $this->Activity_model->get_rolling_activity();

        $recommended_activity = $this->get_recommended_activity();

        $data['all_first_label'] = $this->First_label_model->get_first_label();
        $data['title'] = '主页';
        $data['page_name'] = "home";
        $data['rolling_activity'] = $rolling_activity;
        $data['hot_activity'] = $hot_activity;
        $data['recommended_activity'] = $recommended_activity;
        $data['need_first_label'] = $this->User_and_first_label_model->get_first_label_by_user_id($this->user_id) == null ? true : false;

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('home/home', $data);
        $this->load->view('template/footer');
    }

    public function get_recommended_activity(){
        return $this->Recommend_activity_model->get_recommend_activity($this->user_id);
    }

    public function refresh_recommend_activity(){
        $this->Recommend_activity_model->refresh_recommend_activity_for_test($this->user_id);
        redirect('home/index');
    }
}
