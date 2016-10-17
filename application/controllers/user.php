<?php

/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2016/10/17
 * Time: 21:04
 */
class User extends CI_Controller
{
    public function applied(){
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_applied',$data);
    }
    public function comments(){
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_comments',$data);
    }
    public function info(){
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_data',$data);
    }
    public function favorites(){
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_favorites',$data);
    }
    public function joined(){
        $data['title'] = "个人中心";


        $this->load->view('person_related/personal_joined',$data);
    }
}