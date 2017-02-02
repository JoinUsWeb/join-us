<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2017/1/30
 * Time: 23:04
 */
class Group extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Group_model');
        $this->load->model('Member_and_group_model');
    }
}