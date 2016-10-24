<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/23
 * Time: 20:38
 */
class Login extends CI_Controller
{
    var $count = 0;

    public function index()
    {
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library("form_validation");
        $this->load->model('User_model');
        $data['title'] = "登录";
        $data['error'] = "";

        /* 此处应区别是第一次加载还是误按登录键  并未实现*/
        if (isset($_POST['_email'])) {
            $data['error'] = $this->form_process();
            if ($data['error'] == null) {
                setcookie('email', set_value('_email'));
                setcookie('password', set_value('_password'));
                $this->load->view('template/header', $data);
                $this->load->view('template/nav');
                $this->load->view('index_page/index', $data);
                $this->load->view('template/footer');
                return;
            }
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
            return "数据不合法！";
        else if ($this->User_model->validate_user(set_value('_email'), set_value('_password')) === false)
            return "用户名或密码错误！";
        else
            return null;
    }
}