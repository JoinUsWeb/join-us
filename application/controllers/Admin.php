<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/1/27
 * Time: 17:20
 */
class Admin extends CI_Controller
{
    var $admin_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('Admin_model');
        $this->load->model('Admin_first_label_model');
    }

    private function check_status()
    {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            return 1;
        } else {
            return 0;
        }
    }

    public function login()
    {
        if ($this->session->has_userdata('admin_id')) {
            redirect('admin/main');
            return;
        }
        if ($this->form_process() == null) {
            $this->admin_id = $this->Admin_model->get_admin_id_by_user_name(set_value('_user_name'));

            $this->session->set_userdata(array(
                'admin_id' => $this->admin_id,
            ));
            redirect('admin/main');
            return;
        }
        $this->load->view('admin/admin_login');
    }

    public function main()
    {
        if ($this->check_status() == 0) {
            redirect('admin/login');
            return;
        }
        $data['to_verify'] = $this->Admin_model->get_activity_by_admin_id($this->admin_id);
        $this->load->view('admin/admin_main',$data);
    }


    public function check($activity_id = -1)
    {
        $this->load->model('Activity_model');
        $this->load->model('First_label_model');
        $this->load->model('Second_label_model');
        if ($activity_id == -1) {
            redirect('admin/main');
            return;
        }
        if ($this->check_status() == 0) {
            redirect('admin/login');
            return;
        }
        $data['activity_info'] = $this->Admin_model->get_activity_detail_by_activity_id($activity_id);
        $data['activity_info']['first_label_id'] = $this->First_label_model->get_first_label_by_id($data['activity_info']['first_label_id'])['name'];
        $this->load->view('admin/check_page',$data);
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

    public function is_approved($id = -1)
    {
        $this->load->model('Activity_model');
        $this->load->model('Message_model');
        if ($id == -1)
            return;
        if (isset($_POST['approve'])){
            $this->Activity_model->update_activity_by_id($id,array('isVerified' => 1));
            header('location: '.$_SERVER['HTTP_REFERER']);
        }elseif (isset($_POST['disapprove'])){
            $this->Activity_model->update_activity_by_id($id,array('isVerified' => 2));
            header('location: '.$_SERVER['HTTP_REFERER']);
        }
    }

}