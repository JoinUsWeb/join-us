<?php

/**
 * Class for message operation between users
 * @author <sei_jx2014@126.com>
 */
class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('message_model','message');
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
        $data['time']=time();
        return $this->message->insert($data);
    }

    /**
     * get message by recipient_id
     * @param int   recipient_id    recipient's id
     * @return array $message on success,bool false on failure
     * precondition：recipient_id exits in TABLE user；
     * postcondition：return message array order by time desc
     */
    public function get_message_by_recipient_id($recipient_id){
        return $this->message->get_message_by_recipient_id($recipient_id);
    }

    /**
     * get message by sender_id
     * @param int   sender_id    sender's id
     * @return array $message on success,bool false on failure
     * precondition：sender_id exits in TABLE user；
     * postcondition：return message array order by time desc
     */
    public function get_message_by_sender_id($sender_id){
        return $this->message->get_message_by_sender_id($sender_id);
    }

    /**
     * get message by sender_id and recipient_id
     * @param int   sender_id    sender's id
     * @param int   recipient_id    recipient's id
     * @return array $message on success,bool false on failure
     * precondition：sender_id and recipient_id exits in TABLE user；
     * postcondition：return message array order by time desc
     */ 
    public function get_message_by_sender_id_and_recipient_id($sender_id,$recipient_id){
        return $this->message->get_message_by_sender_id_and_recipient_id($sender_id,$recipient_id);
    }

    /**
     * get unread message by recipient_id
     * @param int   recipient_id    recipient's id
     * @return array $message on success,bool false on failure
     * precondition：recipient_id exits in TABLE user；
     * postcondition：return unread message array order by time desc
     */
    public function get_unread_message_by_recipient_id($recipient_id){
        return $this->message->get_unread_message_by_recipient_id($recipient_id);
    }

    /**
     * get the number of activity messages by recipient_id
     * For participant:activity messages include reminder of activities in three days ,reminder of comment on participated activities and announcement from organizer of the participated activity.
     * For organizer:activity messages include remider of activities in a week and number of participant that changed.
     * @param int   recipient_id    recipient's id
     * @return int count    number of activity messages
     * precondition：recipient_id exits in TABLE user；
     * postcondition：return number of activity messages
     */
    public function get_activity_message_count_by_recipient_id($recipient_id){
        $count=0;
        /*reminder of comment on participated activities*/
        //建议评论信息存储在relation_activity_members表中并添加是否评论的状态位
        /*
            在表activity join relation_activity_members查询符合下列条件的数组A：
                member_id=recipient_id;
                data_expire+time_expire<system_time;
                is_comment=0;
            count=count+count(数组A);
        */
        /*announcement from organizer of the participated activity*/
        /*reminder of activities in a week for organizer and in three days for participant*/
        /*
            在表activity中查询符合下列条件的数组A：
                creator_id=recipient_id;
                data_start+time_start-system_time< 7 days;
            在表activity join relation_activity_members中查询符合下列条件的数组B：
                member_id=recipient_id;
                data_start+time_start-system_time< 3 days;
            合并数组A与数组B，并去除重复部分得到数组C；
            count=count+count(数组C);
         */
        /*number of participant that changed*/
        return $count;
    }

    /**
     * get the number of unread invitation messages by recipient_id
     * @param int   recipient_id    recipient's id
     * @return int count    number of unread invitation messages
     * precondition：recipient_id exits in TABLE user；
     * postcondition：return number of unread invitation messages
     */
    public function get_invitation_message_count_by_recipient_id($recipient_id){
        $count=0;
        $count=count($this->message->get_unread_message_by_recipient_id_and_type($recipient_id,INVITATION));
        return $count;
    }
}