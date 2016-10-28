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
        $data['type']=Invitation;
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


}