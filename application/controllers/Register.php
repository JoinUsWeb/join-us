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
        $this->load->library("form_validation");
        $this->load->model('User_model');
        $data['title'] = '注册';
        $data['error'] = "";

        /* 此处应区别是第一次加载还是误按注册键  并未实现*/
        if (isset($_POST['_email'])) {
            $data['error'] = $this->form_process();
            if ($data['error'] == null) {
                setcookie('email', set_value('_email'));
                setcookie('password', set_value('_password'));
                redirect('home');
                return;
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('login_and_register/register', $data);
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

        $this->form_validation->set_rules('_password2', "Password",
            'trim|htmlspecialchars|required|matches[_password]', array(
                'required' => 'Please type your password again!',
                'matches' => "Fail to match!"
            ));

        $this->form_validation->set_rules('_phoneNumber', 'Phone number',
            'trim|htmlspecialchars|required|is_natural',
            array(
                'required' => 'Please provide your phone number!',
                'is_natural' => 'Invalid phone number!'
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
            if ($this->User_model->insert_new_user_info($user_data) == true)
                return null;
        }
    }
}