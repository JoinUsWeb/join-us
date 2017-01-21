<?php

/**
 * Created by PhpStorm.
 * User: huge
 * Date: 2016/10/17
 * Time: 21:31
 */
class Activity_detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Activity_model');
        $this->load->model('Member_and_activity_model');
        $this->load->model('Activity_comment_model');
    }

    public function index($activity_id)
    {
        $data['title'] = '活动详情';
        $data['page_name']="detail";
        $data['activity'] = $this->Activity_model->get_activity_by_id($activity_id);
        if ($data['activity'] == null)
            show_error('活动不存在，可能已经被取消');
        if (empty($data['activity']))
            show_error('活动不存在，可能已经被取消');
        $data['member'] = $this->Member_and_activity_model->get_member_by_activity_id($activity_id);
        $data['hot_activity'] = $this->Activity_model->get_activity_order_by_score(3);
        $data['is_joined'] = $this->Member_and_activity_model->is_exist($this->session->user_id,$activity_id);

        $data['comment']=$this->Activity_comment_model->get_completed_comment_by_activity_id($activity_id);

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('activity_related/activity_detail', $data);
        $this->load->view('template/footer');
    }

    public function enter($activity_id)
    {
        $user_id=$this->session->user_id;
        $activity=$this->Activity_model->get_activity_by_id($activity_id);
        if(isset($user_id)&&($activity['member_number']<$activity['amount_max']))
        {
            $this->Member_and_activity_model->insert_new_relation($user_id,$activity_id);
        }

        redirect('activity_detail/index/'.$activity_id);
    }

    public function quit($activity_id)
    {
        $user_id=$this->session->user_id;
        if(isset($user_id))
        {
            $this->Member_and_activity_model->remove_member_from_activity_by_id($activity_id,$user_id);
        }

        redirect('activity_detail/index/'.$activity_id);
    }

    function comment_check(){
        $this->form_validation->set_rules('comment', 'comment', 'trim|required',array('required'=>'请输入评论再发表'));
        if(isset($this->session->user_id)&&$this->form_validation->run())
        {
            $comment=array();
            $comment['activity_id']=$_POST["activity_id"];
            $comment['creator_id']=$this->session->user_id;
            $comment['content']=$this->input->post()['comment'];
            $this->Activity_comment_model->insert_new_comment($comment);
        }
    }
}