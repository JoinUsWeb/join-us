<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/31
 * Time: 14:39
 */
class Separated_info extends CI_Controller
{

    function json_for_second_label($first_label_id = -1)
    {
        $this->load->model("Second_label_model");
        if ($first_label_id == -1)
            return json_encode('');
        $return_info = $this->Second_label_model->get_second_label_by_first_label_id($first_label_id);
        if ($return_info == null)
            return json_encode('');
        echo json_encode($return_info);
    }

    function select_first_label()
    {
        if ($_POST['first_label'] == null || $_POST['user_id'] <= 0)
            return "";
        $this->load->model("User_and_first_label_model");
        foreach ($_POST['first_label'] as $single_1st_label) {
            $this->User_and_first_label_model->insert_new_relation(intval($_POST['user_id']), $single_1st_label);
        }
        echo json_encode('success');
    }


    function register_info_check($field = null)
    {
        if ($field == null) return;
        $this->load->helper("form");
        $this->load->library("form_validation");
        switch ($field) {
            case "email":
                $this->form_validation->set_rules('_email', 'Email',
                    'trim|htmlspecialchars|is_unique[user.email]|required', null);
                if ($this->form_validation->run() == true) {
                    echo "true";
                } else {
                    echo "false";
                }
                break;
            case "nickname":
                $this->form_validation->set_rules('_nickName', 'Nickname',
                    'trim|htmlspecialchars|required|is_unique[user.nick_name]', null);
                if ($this->form_validation->run() == true) {
                    echo "true";
                } else {
                    echo "false";
                }
                break;
        }
    }

    function comment_activity($activity_id, $rate)
    {
        $this->load->model("Member_and_activity_model");
        $this->Member_and_activity_model->update_rate($_SESSION['user_id'], $activity_id, $rate);
    }

    function change_user_info($type)
    {
        $this->load->model('User_model');
        $this->load->helper(array("url", "form"));
        $this->load->library("form_validation");
        $CHANGE_BASIC = 0;
        $CHANGE_PWD = 1;
        $CHANGE_AVATAR = 2;
        $data = array();
        switch ($type) {
            case $CHANGE_BASIC:
                if (!empty($_POST['nickname'])) {
                    $this->form_validation->set_rules('nickname', "Nickname",
                        'trim|htmlspecialchars|required|is_unique[user.nick_name]',
                        array(
                            'required' => 'Please provide your nickname!',
                            'is_unique' => '%s is used!'
                        ));
                    if ($this->form_validation->run() == true)
                        $data['nick_name'] = $_POST['nickname'];

                }
                if (!empty($_POST['phone_number'])) {
                    $this->form_validation->set_rules('phone_number', "Phone number",
                        'trim|htmlspecialchars|required|min_length[11]|max_length[11]|numeric',
                        array(
                            'required' => 'Please provide your phone number!',
                            'is_natural' => 'Invalid phone number!',
                            'min_length' => 'Invalid phone number!',
                            'max_length' => 'Invalid phone number!'
                        ));
                    if ($this->form_validation->run() == true)
                        $data['phone_number'] = $_POST['phone_number'];
                }
                break;
            case $CHANGE_PWD:
                if (!empty($_POST['password'])) {
                    if (!empty($_POST['password2'])) {
                        $this->form_validation->set_rules('password', 'Password',
                            'trim|htmlspecialchars|required',
                            array(
                                'required' => 'Please provide your password!'
                            ));
                        $this->form_validation->set_rules('password2', "Password",
                            'trim|htmlspecialchars|required|matches[password]',
                            array(
                                'required' => 'Please type your password again!',
                                'matches' => "Fail to match!"
                            ));
                        if ($this->form_validation->run() == true)
                            $data['password'] = $_POST['password'];
                    }
                }
                break;
            case $CHANGE_AVATAR:
                break;
        }
        if (!empty($data)) {
            $this->User_model->update_user_info_by_id($_SESSION['user_id'], $data);
        }
        redirect('user/info');
    }
}