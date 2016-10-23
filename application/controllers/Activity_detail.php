<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/17
 * Time: 21:31
 */
class Activity_detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('post','url');
        $this->load->model('activity_model');
    }

    public function index($activity_id)
    {
        $data['title']='活动详情';
        $data['activity']=$activity=$this->activity_model->get_activity_by_id($activity_id);
        if($activity==null)
            show_404();
        if(empty($activity))
            show_error('活动不存在，可能已经被取消');

        $this->load->view('template/header',$activity);
        $this->load->view('template/nav');
        $this->load->view('activity_related/activity_detail',$activity);
        $this->load->view('template/footer');
    }
}