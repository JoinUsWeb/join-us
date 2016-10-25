<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/22
 * Time: 20:01
 */
class Home  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->model('First_label_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = "个人主页";
        $hot_activity=$this->Activity_model->get_activity_order_by_score(3);

        if(!empty($this->session->user_id))
        {
            $user_id=$this->session->user_id;
            $recommended_activity=$this->get_recommended_activity($user_id);
        }
        else
        {
            $recommended_activity=null;
        }

        $data['title']='Home';
        $data['hot_activity']=$hot_activity;
        $data['recommended_activity']=$recommended_activity;

        $this->load->view('template/header',$data);
        $this->load->view('template/nav');
        $this->load->view('home/home',$data);
        $this->load->view('template/footer');
    }

    public function get_recommended_activity($user_id)
    {
        $activity=array();
        $first_label=$this->User_and_first_label_model->get_first_label_by_user_id($user_id);
        foreach ($first_label as $first_label_item)
        {
            $activity_part=$this->Activity_model->get_activity_by_first_label_id($first_label_item['id']);
            $activity=array_merge($activity,$activity_part);
        }
        return $activity;
    }
}