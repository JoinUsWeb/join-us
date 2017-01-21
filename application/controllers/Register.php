<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/23
 * Time: 20:38
 */
class Register extends CI_Controller
{
    public function index()
    {
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library(array("form_validation", "session"));
        $this->load->model('User_model');
        $data['title'] = '注册';
        $data['page_name'] = "register";
        $user_id = -1;

        /* 此处应区别是第一次加载还是误按注册键  并未实现*/
        if ($this->form_process($user_id) == null) {
            setcookie('email', set_value('_email'));
            setcookie('password', set_value('_password'));
            $this->session->set_userdata('user_id', $user_id);
            redirect('home');
            return;
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('login_and_register/register', $data);
        $this->load->view('template/footer');

    }

    function form_process(&$user_id)
    {
        $this->form_validation->set_rules('_email', 'Email',
            'trim|htmlspecialchars|is_unique[user.email]|required|valid_email',
            array(
                'required' => 'Please provide your email address!',
                'valid_email' => 'Email address is invalid!',
                'is_unique' => 'This email address is used'
            ));

        $this->form_validation->set_rules('_password', 'Password',
            'trim|htmlspecialchars|required',
            array(
                'required' => 'Please provide your password!'
            ));

        $this->form_validation->set_rules('_password2', "Password",
            'trim|htmlspecialchars|required|matches[_password]',
            array(
                'required' => 'Please type your password again!',
                'matches' => "Fail to match!"
            ));

        $this->form_validation->set_rules('_phoneNumber', 'Phone number',
            'trim|htmlspecialchars|required|is_natural|min_length[11]|max_length[11]',
            array(
                'required' => 'Please provide your phone number!',
                'is_natural' => 'Invalid phone number!',
                'min_length' => 'Invalid phone number!',
                'max_length' => 'Invalid phone number!'
            ));

        $this->form_validation->set_rules('_nickName', 'Nickname',
            'trim|htmlspecialchars|required|is_unique[user.nick_name]',
            array(
                'required' => 'Please provide your nickname!',
                'is_unique' => '%s is used!'
            ));

        if ($this->form_validation->run() == false)
            return "数据不合法！";
        else {
            $user_data = array(
                'email' => set_value('_email'),
                'password' => set_value('_password'),
                'phone_number' => set_value('_phoneNumber'),
                'nick_name' => set_value('_nickName')
            );
            if ($this->User_model->insert_new_user_info($user_data, $user_id) == true)
                return null;
        }
    }
}