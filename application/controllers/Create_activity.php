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
        $this->load->model('activity_model');
        $this->load->model('first_label_model');

        $config['upload_path'] = FCPATH . '/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('date_start', 'date_start', 'required');
        $this->form_validation->set_rules('time_start', 'time_start', 'required');
        $this->form_validation->set_rules('date_expire', 'date_expire', 'required');
        $this->form_validation->set_rules('time_expire', 'time_expire', 'required');
        $this->form_validation->set_rules('place', 'place', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('first_label_id', 'first_label_id', 'required');
        $this->form_validation->set_rules('brief', 'brief', 'required');


        if (!$this->form_validation->run()) {
            $data = array('error' => '', 'title' => 'create activity');
            $data['first_label'] = $this->first_label_model->get_first_label();
            $data['page_name']="create";
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('activity_related/create_activity', $data);
            $this->load->view('template/footer');
        } else if (!$this->upload->do_upload('poster')) {
            if ($this->upload->error_msg[0] != 'You did not select a file to upload.') {
                $data = array('error' => $this->upload->display_errors(), 'title' => 'create activity');
                $data['first_label'] = $this->first_label_model->get_first_label();
                $data['page_name']="create";
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
                    $data['creator_id'] = $this->session['user_id'];
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
                $this->create_activity($data, $this->upload->data()['full_path']);
            }
        }
    }


    public function create_activity($data, $poster_path)
    {
        $data['poster'] = $poster_path;
        $this->activity_model->insert_new_activity($data);
        redirect(site_url('activity_detail/index/' . $this->db->insert_id()));
    }

    public function create_activity_no_poster($data)
    {
        $poster_path = 'img/first_label_' . $data['first_label_id'] . '.jpg';
        $this->create_activity($data, $poster_path);
    }
}