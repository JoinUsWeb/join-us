<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/31
 * Time: 14:39
 */

class Separated_info extends CI_Controller {

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
}