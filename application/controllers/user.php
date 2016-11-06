<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/17
 * Time: 21:04
 */
class User extends CI_Controller
{

    var $user_id = -1;
    var $personal_nav;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        if (isset($_SESSION['user_id'])) {
            $this->user_id = (int)$_SESSION['user_id'];
        } else {
            redirect('login');
        }
        $this->personal_nav = "<nav class=\"dr-menu\">
<div class=\"dr-trigger\"><span class=\"dr-icon dr-icon-menu\"></span><a class=\"dr-label\">我的主页</a></div>
<ul>
<li><a class=\"dr-icon dr-icon-user\" href=\"" . site_url('user/info') . "\">个人信息</a></li>
<li><a class=\"dr-icon dr-icon-camera\" href=\"" . site_url('user/joined') . "\">已参加活动</a></li>
<li><a class=\"dr-icon dr-icon-heart\" href=\"" . site_url('user/applied') . "\">已报名活动</a></li>
<li><a class=\"dr-icon dr-icon-bullhorn\" href=\"" . site_url('user/comments') . "\">评价活动</a>
</li>
<li><a class=\"dr-icon dr-icon-download\" href=\"" . site_url('message/personal_mymessages') . "\">我的消息</a></li>
<li><a class=\"dr-icon dr-icon-settings\" href=\"" . site_url('user/group') . "\">我的小组</a></li>
</ul>
</nav>";
    }

    /**
     * 需要根据活动参加实践和现在的时间进行比较 再做筛选  以下实现并没有起到实际效果
     */
    public function applied()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "applied";
        $data['nav'] = $this->personal_nav;

        $row_activities_info = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);
        $current_date = date("Y-m-d");
        $data['activities_info'] = array();
        foreach ($row_activities_info as $single_activity_info) {
            $activity_date = date_create($single_activity_info['time_expire'])->format("Y-m-d");
            // 查看活动是否已经结束 结束代表已经参加过
            if (strtotime($current_date) > strtotime($activity_date)) {
                $data['activities_info'][] = $single_activity_info;
            }
        }
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_applied', $data);
        $this->load->view('template/footer');
    }

    public function comments()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "comments";
        $data['nav'] = $this->personal_nav;

        $data['activities_info'] = null;
        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_comments', $data);
        $this->load->view('template/footer');
    }

    public function info()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = "info";
        $this->load->model('User_model');
        $this->load->model('User_and_first_label_model');
        $data['nav'] = $this->personal_nav;

        $data['user_info'] = $this->User_model->get_user_by_id($this->user_id);
        $data['user_info']['interest'] = $this->User_and_first_label_model->get_first_label_by_user_id($this->user_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_info', $data);
        $this->load->view('template/footer');
    }


    /**
     * 需要根据活动是否被收藏进行筛选  以下实现并没有起到实际效果
     */
    public function favorites()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "favorites";

        //需修改  没有判断是否是收藏了
        $data['activities_info'] = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_favorites', $data);
        $this->load->view('template/footer');
    }

    public function joined()
    {
        $this->load->model('Member_and_activity_model');
        $data['title'] = "个人中心";
        $data['page_name'] = "joined";
        $data['nav'] = $this->personal_nav;

        $row_activities_info = $this->Member_and_activity_model
            ->get_activity_by_member_id($this->user_id);
        $current_date = date("Y-m-d");
        $data['activities_info'] = array();
        foreach ($row_activities_info as $single_activity_info) {
            $activity_date = date_create($single_activity_info['time_expire'])->format("Y-m-d");
            if (strtotime($current_date) <= strtotime($activity_date)) {
                $data['activities_info'][] = $single_activity_info;
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_joined', $data);
        $this->load->view('template/footer');
    }

    public function group()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = 'group';
        $data['nav'] = $this->personal_nav;

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_group', $data);
        $this->load->view('template/footer');
    }

    public function detail()
    {
        $data['title'] = "个人中心";
        $data['page_name'] = 'group_detail';
        $data['nav'] = $this->personal_nav;

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/group_detail', $data);
        $this->load->view('template/footer');

    }

    public function edit()
    {
        $data['title'] = "个人中心";
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $data['page_name'] = 'edit';
        $data['user_info'] = $this->User_model->get_user_by_id($this->user_id);


        if (isset($_POST))
            $this->update_user_info();

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('person_related/personal_edit', $data);
        $this->load->view('template/footer');

    }

    public function update_user_info()
    {
        $this->load->model('User_model');
        $user_info = array();
        if (!empty($_POST['_password'])) {
            $this->form_validation->set_rules('password', 'Password',
                'trim|htmlspecialchars|required');
            $this->form_validation->set_rules('password2', 'Password',
                'trim|htmlspecialchars|required|matches[_password]',
                array(
                    'required' => 'Please type your password again!',
                    'matches' => "Fail to match!"
                ));
            if ($this->form_validation->run() == false) {
                return;
            }
            $user_info['password'] = $_POST['password'];
        }
        if (!empty($_POST['nick_name'])) {
            if ($_POST['nick_name'] != $this->User_model->get_user_by_id($this->user_id, 'nick_name')) {
                $this->form_validation->set_rules('nick_name', 'Nickname',
                    'trim|htmlspecialchars|required|is_unique[user.nick_name]',
                    array(
                        'required' => 'Please provide your nickname!',
                        'is_unique' => '%s is used!'
                    ));
                if ($this->form_validation->run() == false) {
                    return;
                }
                $user_info['nick_name'] = $_POST['nick_name'];
            }
        }
        if (!empty($_POST['phone_number'])) {
            $this->form_validation->set_rules('phone_number', 'Phone number',
                'trim|htmlspecialchars|required|is_natural',
                array(
                    'required' => 'Please provide your phone number!',
                    'is_natural' => 'Invalid phone number!'
                ));
            if ($this->form_validation->run() == false) {
                return;
            }
            $user_info['phone_number'] = $_POST['phone_number'];
        }
        if ($this->User_model->update_user_info_by_id($this->user_id, $user_info) == true)
            redirect('user/info');
    }
}
