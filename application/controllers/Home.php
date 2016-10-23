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
        $this->load->model('activity_model');
    }

    public function index()
    {
        $hot_activity=$this->activity_model->get_activity_order_by_score(3);
    }
}