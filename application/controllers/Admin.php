<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/1/27
 * Time: 17:20
 */
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('Admin_model');
    }

    public function login()
    {
        if ($this->session->has_userdata('admin_id')) {
            redirect('admin/main');
            return;
        }
        if ($this->form_process() == null) {
            $admin_id = $this->Admin_model->get_admin_id_by_user_name(set_value('_user_name'));

            $this->session->set_userdata(array(
                'admin_id' => $admin_id,
            ));
            redirect('admin/main');
            return;
        }
        $this->load->view('admin/admin_login');
    }

    public function main()
    {
        $this->load->view('admin/admin_main');
    }


    public function check()
    {
        $this->load->view('admin/check_page');
    }

    function form_process()
    {
        $this->form_validation->set_rules('_user_name', 'User name', 'trim|htmlspecialchars|required',
            array('required' => 'Please provide your user name!'));
        $this->form_validation->set_rules('_password', 'Password', 'trim|htmlspecialchars|required',
            array('required' => 'Please provide your password!'));

        if ($this->form_validation->run() == false)
            return "Invalid";
        else if ($this->Admin_model->validate_admin(set_value('_user_name'), set_value('_password')) === false)
            return "Wrong";
        else
            return null;
    }
}