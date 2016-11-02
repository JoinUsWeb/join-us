<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/23
 * Time: 20:38
 */
class Login extends CI_Controller
{

    public function index()
    {
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library(array("form_validation", "session"));
        $this->load->model('User_model');
        $data['title'] = "登录";
        $data['page_name']="login";

        if ($this->session->has_userdata('user_id')){
            redirect('home');
            return;
        }
        if ($this->form_process() == null) {
            setcookie('email', set_value('_email'));
            setcookie('password', set_value('_password'));
            $user_id = $this->User_model->get_user_id_by_email(set_value('_email'));

            $this->session->set_userdata(array(
                'user_id' => $user_id,
            ));
            redirect('home');
            return;
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('login_and_register/login', $data);
        $this->load->view('template/footer');
    }


    function form_process()
    {
        $this->form_validation->set_rules('_email', 'Email',
            'trim|htmlspecialchars|required|valid_email',
            array(
                'required' => 'Please provide your email address!',
                'valid_email' => 'Email address is invalid!'
            ));

        $this->form_validation->set_rules('_password', 'Password',
            'trim|htmlspecialchars|required',
            array(
                'required' => 'Please provide your password!'
            ));

        if ($this->form_validation->run() == false)
            return "Invalid";
        else if ($this->User_model->validate_user(set_value('_email'), set_value('_password')) === false)
            return "Wrong";
        else
            return null;
    }
}