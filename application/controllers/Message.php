<?php

/**
 * Class for message operation between users
 * @author <sei_jx2014@126.com>
 *
 * load view(person_related/personal_mymessages)
 * public function personal_mymessages()
 *
 * 根据用户 id  获取显示在我的消息页面的多维数组
 * public function get_message_by_user_id($user_id)
 *
 * 根据提供的用户 id 获取其参加的三天内活动提醒
 * private function get_activity_in_three_day_by_member_id($user_id)
 *
 * 根据提供的用户 id   获取其组织的七天内活动提醒
 * private function get_activity_in_a_week_by_creator_id($user_id)
 *
 * 根据提供的用户 id   获取其参与的有新公告的活动提醒
 * private function get_activity_announcement_by_member_id($user_id)
 *
 * 根据提供的用户 id 和 获取其未评论的已结束的活动提醒
 * private function get_unfinished_comment_by_member_id($user_id)
 *
 * 根据提供的用户 id 和 获取其未读的活动邀请消息
 * private function get_unread_invitation_by_recipient_id($user_id)
 *
 * 根据提供的邀请者 id 和 被邀请者 id 和活动 id 往数据库中插入一条邀请消息
 * public function invite($sender_id,$recipient_id,$activity_id)
 */
class Message extends CI_Controller
{
    var $personal_nav;
    var $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('message_model','message');
        $this->load->model('member_and_activity_model','member_and_activity');
        $this->load->model('Activity_model');
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
        } else {
            redirect('login');
        }
    }

    function load_header_view($tag_selected='info'){
        $header['title'] = "个人中心";
        $header['page_name'] = 'personal';
        $this->load->view('template/header', $header);
        $this->load->view('template/nav');

        $this->load->model('User_model');
        $user_data=$this->User_model->get_user_by_id($this->user_id);
        $user_data['tag']=$tag_selected;
        $this->load->view('template/personal_nav',$user_data);
    }

    /**
     *load view(person_related/personal_mymessages);
     */
    public function personal_mymessages(){
        $this->load_header_view('message');
        $data=$this->get_message_by_user_id($this->session->user_id);
        $data['title'] = "个人中心";
        $data['page_name'] = 'message';

        $this->load->view('person_related/personal_mymessages',$data);
        $this->load->view('template/footer');
    }

    /**
     *get personal messages by user's id
     *@param int    $user_id    user's id
     *@return array     $data   messages' array
     *precondition: $user_id exits in TABLE user
     *postcondition: return personal messages by user's id,messages includes as follows:
        1.reminder of activity:
            a.for participant
                i)activities start in three days
                ii)comment on finished activities
                iii)announcement from the participated activity
            b.for organizer
                i)activities start in a week
                ii)number of participant that changed
        2.remider from the participated group
            a.new announcement
            b.new permission changed
            c.new member changed
        3.invitation
        4.activities have been verified
     */
    public function get_message_by_user_id($user_id){
        $data['activity_in_three_days']=$this->get_activity_in_three_day_by_member_id($user_id);
        $data['activity_in_a_week']=$this->get_activity_in_a_week_by_creator_id($user_id);
        $data['activity_announcement']=$this->get_activity_announcement_by_member_id($user_id);
        $data['unfinished_comment']=$this->get_unfinished_comment_by_member_id($user_id);
        $data['invitation']=$this->get_unread_invitation_by_recipient_id($user_id);
        $data['verified_activity']=$this->get_verified_activity_by_creator_id($user_id);
        return $data;
    }

    /**
     *get verified activity  by user's id
     *@param int    $user_id    user's id
     *@return array     $verified_activity   verified activity' array
     *precondition: $user_id exits in TABLE user
     *postcondition: return verified activity by user's id order by activity's id
     */
    private function get_verified_activity_by_creator_id($user_id){
        $verified_activity=$this->Activity_model->get_activity_by_where_string("creator_id = ".$user_id);
        return $verified_activity;
    }

    /**
     *get participated activity in three days by user's id
     *@param int    $user_id    user's id
     *@return array     $activity_in_three_days   participated activity' array
     *precondition: $user_id exits in TABLE user
     *postcondition: return participated activity in three days by user's id order by activity's id
     */
    private function get_activity_in_three_day_by_member_id($user_id){
        $result=$this->member_and_activity->get_activity_by_member_id($user_id);
        $activity_in_three_days=array();
        foreach ($result as $activity_item) {
            if(strtotime($activity_item['activity_start'])-time()<3*24*60*60){
                $activity_in_three_days[]=$activity_item;
            }
        }
        return $activity_in_three_days;
    }

    /**
     *get organized activity in a week by user's id
     *@param int    $user_id    user's id
     *@return array     $activity_in_a_week   organized activity' array
     *precondition: $user_id exits in TABLE user
     *postcondition: return organized activity in a week by user's id order by activity's id
     */
    private function get_activity_in_a_week_by_creator_id($user_id){
        $result=$this->Activity_model->get_activity_by_creator_id($user_id);
        $activity_in_a_week=array();
        foreach ($result as $activity_item) {
            $time=strtotime($activity_item['activity_start'])-strtotime(date("Y-m-d H:i:s"),time());
            if($time>=0&&$time<7*24*60*60){
                $activity_in_a_week[]=$activity_item;
            }
        }
        return $activity_in_a_week;
    }

    /**
     *get unread activity announcement by user's id
     *@param int    $user_id    user's id
     *@return array     $activity_announcement  unread activity announcement's array
     *precondition: $user_id exits in TABLE user
     *postcondition: return unread activity announcement by user's id order by activity's id
     */
    private function get_activity_announcement_by_member_id($user_id){
        $activity_announcement=array();

        /* unfinished */

        return $activity_announcement;
    }

    /**
     *get unfinished activity comment by user's id
     *@param int    $user_id    user's id
     *@return array     $activity_comment  unfinished activity comment's array
     *precondition: $user_id exits in TABLE user
     *postcondition: return unfinished activity comment by user's id order by activity's id
     */
    private function get_unfinished_comment_by_member_id($user_id){
        $activity_comment=array();

        /* unfinished */

        return $activity_comment;
    }

    /**
     *get unread invitation by recipient's id
     *@param int    $user_id    recipient's id
     *@return array     $result  unread invitation' array
     *precondition: $recipient exits in TABLE user
     *postcondition: return unread invitation by recipient's id order by createtime
     */
    private function get_unread_invitation_by_recipient_id($user_id){
        $result=$this->message->get_unread_invitation_by_recipient_id($user_id);
        return $result;
    }

    /**
     * invite
     * @param int   sender_id   sender's id
     * @param int   recipient_id    recipient's id
     * @param int   activity_id     activity's id
     * @return true on success,false on failure
     * precondition：sender_id、recipient_id exits in TABLE user；activity_id exits in TABLE activity
     * postcondition：insert a new invitation message into TABLE message
     */
    public function invite($sender_id,$recipient_id,$activity_id){
        $data['sender_id']=$sender_id;
        $data['recipient_id']=$recipient_id;
        $data['activity_id']=$activity_id;
        $data['status']=UNREAD;
        $data['type']=INVITATION;
        $data['createtime']=date('Y-m-d H:i:s',time());
        return $this->message->insert($data);
    }
}