<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/31
 * Time: 21:28
 */
class Log_off extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        unset($_SESSION['user_id']);
        redirect(site_url('home'));
    }
}