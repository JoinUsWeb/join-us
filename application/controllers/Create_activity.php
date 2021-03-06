<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/17
 * Time: 15:05
 */
class Create_activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Activity_model');
        $this->load->model('First_label_model');

        $config['upload_path'] = FCPATH . '/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 4096;
        $config['max_width'] = 3000;
        $config['max_height'] = 3000;
        $this->load->library('upload', $config);
    }

    public function index()
    {
        if (!isset($this->session->user_id))
            redirect('login/index');

        $this->form_validation->set_rules('name', 'name', 'trim|required', array('required' => '请输入活动名称'));
        $this->form_validation->set_rules('date_start', 'date_start', 'callback_check_date_2|required', array('required' => '请输入活动开始日期'));
        $this->form_validation->set_rules('time_start', 'time_start', 'required', array('required' => '请输入活动开始时间'));
        $this->form_validation->set_rules('end_date', 'end_date', 'required', array('required' => '请输入活动结束日期'));
        $this->form_validation->set_rules('end_hour', 'end_hour', 'required', array('required' => '请输入活动结束时间'));
        $this->form_validation->set_rules('date_expire', 'date_expire', 'callback_check_date_1|required', array('required' => '请输入报名截止日期'));
        $this->form_validation->set_rules('time_expire', 'time_expire', 'required', array('required' => '请输入报名截止时间'));
        $this->form_validation->set_rules('place', 'place', 'trim|required', array('required' => '请输入活动地点'));
        $this->form_validation->set_rules('city', 'city', 'required', array('required' => '请选择活动城市'));
        $this->form_validation->set_rules('first_label_id', 'first_label_id', 'required', array('required' => '请输入活动标签'));
        $this->form_validation->set_rules('brief', 'brief', 'required', array('required' => '请输入活动简介'));


        if (!$this->form_validation->run()) {
            $data['isQuoted'] = false;
            $data['error'] = '';
            $data['first_label'] = $this->First_label_model->get_first_label();
            $data['page_name'] = "create";
            $data['title'] = '创建活动';
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('activity_related/create_activity', $data);
            $this->load->view('template/footer');
        } else if (!$this->upload->do_upload('poster')) {
            if ($this->upload->error_msg[0] != 'You did not select a file to upload.') {
                $data['isQuoted'] = false;
                $data['error'] = $this->upload->display_errors();
                $data['first_label'] = $this->First_label_model->get_first_label();
                $data['page_name'] = "create";
                $data['title'] = '创建活动';
                $this->load->view('template/header', $data);
                $this->load->view('template/nav');
                $this->load->view('activity_related/create_activity', $data);
                $this->load->view('template/footer');
            } else {
                $data = $this->input->post();
                if ($data['second_label_id'] == 0) {

                } else {
                    //为了测试
                    unset($data['new_label']);
                    $data['creator_id'] = $this->session->user_id;
                    $this->create_activity_no_poster($data);
                }
            }
        } else {
            $data = $this->input->post();
            if ($data['second_label_id'] == 0) {

            } else {
                //为了测试
                unset($data['new_label']);
                $data['creator_id'] = $this->session->user_id;
                $this->create_activity($data, 'img/' . $this->upload->data()['file_name']);
            }
        }
    }

    public function quote($quote_activity_id = -1){
        if (!isset($this->session->user_id))
            redirect('login/index');
        if ($quote_activity_id != -1){
            $data['error'] = '';
            $data['first_label'] = $this->First_label_model->get_first_label();
            $data['page_name'] = "create";
            $data['title'] = '创建活动';
            $data['isQuoted'] = true;
            $data['quoted'] = $this->Activity_model->get_activity_by_id($quote_activity_id);
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('activity_related/create_activity', $data);
            $this->load->view('template/footer');
            return;
        }
    }


    private function create_activity($data, $poster_path)
    {
        $data['activity_start'] = $data['date_start'] . ' ' . $data['time_start'];
        $data['apply_expire'] = $data['date_expire'] . ' ' . $data['time_expire'];
        $data['activity_expire'] = $data['end_date'] . ' ' . $data['end_hour'];
        unset($data['date_start'], $data['time_start'], $data['date_expire'], $data['time_expire'], $data['end_date'], $data['end_hour']);
        $data['poster'] = $poster_path;
        $this->Activity_model->insert_new_activity($data);
        redirect('activity_detail/verifying/' . $this->db->insert_id());
    }

    private function create_activity_no_poster($data)
    {
        $poster_path = 'img/first_label_' . $data['first_label_id'] . '.jpg';
        $this->create_activity($data, $poster_path);
    }

    public function check_date_1($date_expire)
    {
        $date_start = $this->input->post()['date_start'];
        if (empty($date_start) | $date_expire <= $date_start)
            return true;
        else {
            $this->form_validation->set_message('check_date_1', '活动报名截止日期必须早于活动开始日期');
            return false;
        }
    }

    public function check_date_2($date_start)
    {
        $end_date = $this->input->post()['end_date'];
        if (empty($end_date) | $date_start <= $end_date)
            return true;
        else {
            $this->form_validation->set_message('check_date_2', '活动开始日期必须早于活动结束日期');
            return false;
        }
    }

}