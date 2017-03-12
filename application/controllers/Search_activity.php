<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/17
 * Time: 21:31
 */
class Search_activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Activity_model');
        $this->load->model('Search_activity_model');
        $this->load->model('First_label_model');
        $this->load->model('User_model');
        $this->load->model('Second_label_model');
    }

    public function index()
    {
        $select = $this->input->get();
        $data['title'] = "search activity";
        $data['page_name']="search";

        $data['first_label'] = $this->First_label_model->get_first_label();

            $select['second_label_id'] = isset($select['second_label_id']) ? $select['second_label_id']: 0;
            //$select['city'] = 0;
            $select['order'] = isset($select['order']) ? $select['order']: 0;
            $select['time'] = isset($select['time']) ? $select['time']: 0;
            if (isset($select['second_label_id']))
                $select['first_label_id'] = $this->First_label_model->get_first_label_by_second_id($select['second_label_id'])['id'];

        $activity = $this->Search_activity_model->search_activity($select['second_label_id'], /*$select['city']*/ 0 , $select['time'], $select['order']);
        foreach ($activity as $key => $activity_item) {
            $activity[$key]['creator_name'] = $this->User_model->get_user_by_id($activity_item['creator_id'])['nick_name'];
            $activity[$key]['first_label_name'] = $this->First_label_model->get_first_label_by_id($activity_item['second_label_id'])['name'];
        }

        foreach ($data['first_label'] as $item){
            $id = $item['id'];
            $data['second_label'][$id] = $this->Second_label_model->get_second_label_by_first_label_id($item['id']);
            $data['second_label'][$id]['id'] = $id;
        }

        $data['activity'] = $activity;
        $data['select'] = $select;

        $data['hot_activity'] = $this->Activity_model->get_activity_order_by_score(3);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('activity_related/search_activity', $data);
        $this->load->view('template/footer');

    }
}