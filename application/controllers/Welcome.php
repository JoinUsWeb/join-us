<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        /*$this->load->model('Recommend_activity_model');
        $activities=$this->Recommend_activity_model->get_recommend_activity(1);
        if(empty($activities)){
            echo ' EEEEempty';
        }else
            foreach ($activities as $activity){
                echo $activity['name'].$activity['id'].'</br>';
            }*/
//        $this->load->view('welcome_message');
        $this->load->model('Evaluate_model');
        $this->load->model('Recommend_activity_model');
        $result = $this->Evaluate_model->get_precision_and_recall_rate(14);
        $result = $this->Evaluate_model->get_transfer_rate(14);
        print_r($result);
    }

}
