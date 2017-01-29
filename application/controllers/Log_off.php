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
        $this->load->helper('url');
    }

    public function index($type = null)
    {
        if ($type == null)
            return null;
        switch ($type){
            case 'u':
                unset($_SESSION['user_id']);
                redirect('login');
                break;
            case 'a':
                unset($_SESSION['admin_id']);
                redirect('admin/login');
                break;
        }
    }
}