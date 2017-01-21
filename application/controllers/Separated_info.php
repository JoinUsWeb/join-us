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
        $return_info = $this->Second_label_model->get_second_label_by_first_id($first_label_id);
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


    public function register_info_check($field = null)
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
}