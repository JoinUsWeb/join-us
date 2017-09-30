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
        return array('p' => $TP / $TP_plus_FP, 'r' => $TP / $TP_plus_FN);
    }

    public function get_transfer_rate($user_id = -1)
    {
        $join_recommended_activities = $this->Member_and_activity_model->get_recommended_activity_amount_by_user_id($user_id);;
        $join_activities_amount = $this->Member_and_activity_model->get_joined_activity_amount_by_user_id($user_id);
        $browse_recommended_activities = $this->Browser_and_trace_model->get_recommended_trace_amount_by_user_id($user_id);
        $browse_activities_amount = $this->Browser_and_trace_model->get_trace_amount_by_user_id($user_id);
        return ($join_recommended_activities / $join_activities_amount) / ($browse_recommended_activities / $browse_activities_amount);
    }
}