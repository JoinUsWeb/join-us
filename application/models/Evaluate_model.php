<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017-09-29
 * Time: 13:22
 */

class Evaluate_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('Member_and_activity_model');
        $this->load->model('Recommend_activity_model');
        $this->load->model('Browser_and_trace_model');
    }

    public function get_precision_and_recall_rate($user_id = -1)
    {
        if ($user_id == -1) return null;
        $TP = $this->Member_and_activity_model->get_recommended_activity_amount_by_user_id($user_id);
        $TP_plus_FP = $this->Recommend_activity_model->get_recommended_activity_amount_by_user_id($user_id);
        $TP_plus_FN = $this->Member_and_activity_model->get_joined_activity_amount_by_user_id($user_id);
        $p=0;
        $r=0;
        if($TP_plus_FP>0)
            $p=$TP / $TP_plus_FP;
        if($TP_plus_FN>0)
            $r=$TP / $TP_plus_FN;
        return array('p' => $p, 'r' => $r);
    }

    public function get_transfer_rate($user_id = -1)
    {
        $join_recommended_activities = $this->Member_and_activity_model->get_recommended_activity_amount_by_user_id($user_id);;
        $join_activities_amount = $this->Member_and_activity_model->get_joined_activity_amount_by_user_id($user_id);
        $browse_recommended_activities = $this->Browser_and_trace_model->get_recommended_trace_amount_by_user_id($user_id);
        $browse_activities_amount = $this->Browser_and_trace_model->get_trace_amount_by_user_id($user_id);
        if($join_activities_amount==0||$browse_recommended_activities==0||$browse_activities_amount==0)
            return 0;
        return ($join_recommended_activities / $join_activities_amount) / ($browse_recommended_activities / $browse_activities_amount);
    }

    public function save_evaluate_record($user_id=-1){
        $p_r=$this->get_precision_and_recall_rate($user_id);
        $transfer_rate=$this->get_transfer_rate($user_id);
        $this->db->insert('evaluate_record',['user_id'=>$user_id,'p'=>$p_r['p'],'r'=>$p_r['r'],'transfer_rate'=>$transfer_rate]);
    }
}