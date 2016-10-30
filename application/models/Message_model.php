<?php
define('UNREAD',0);
define('READ',1);
define('INVITATION',0);
/**
 * Class Message_model
 *
 * message table：id  sender_id  recipent_id  type  detail  time  status  activity_id
 *
 * insert new message
 * public function insert($message = null)
 *
 * get message by recipient_id
 * public function get_message_by_recipient_id($recipient_id=-1)
 */
class Message_model extends CI_Model
{
    /**
     * insert new message
     * $message = array(id  sender_id  recipent_id  type  detail  time  status  activity_id)
     * @param array $message message
     * @return bool    TRUE on success,FALSE on failure
     */
    public function insert($message = null)
    {
        return $this->db->insert('message',$message);
    }

    /**
     * get message by recipient_id
     * @param int   recipient_id    recipient's id
     * @return array $message on success,bool false on failure
     * precondition：recipient_id exits in TABLE user；
     * postcondition：return message array order by time desc
     */
    public function get_message_by_recipient_id($recipient_id = -1){
        $result=$this->db->get('message')->where('recipient_id',$recipient_id)->order_by('time','DESC')->result_array();
        return $result;
    }

    /**
     * get message by sender_id
     * @param int   sender_id    recipient's id
     * @return array $message on success,bool false on failure
     * precondition：sender_id exits in TABLE user；
     * postcondition：return message array order by time desc
     */
    public function get_message_by_sender_id($sender_id = -1){
        $result=$this->db->get('message')->where('sender_id',$sender_id)->order_by('time','DESC')->result_array();
        return $result;
    }

    /**
     * get message by sender_id and recipient_id
     * @param int   sender_id    sender's id
     * @param int   recipient_id    recipient's id
     * @return array $message on success,bool false on failure
     * precondition：sender_id and recipient_id exits in TABLE user；
     * postcondition：return message array order by time desc
     */
    public function get_message_by_sender_id_and_recipient_id($sender_id = -1,$recipient_id = -1){
        $result=$this->db->get('message')
        ->where('sender_id',$sender_id)
        ->where('recipient_id',$recipient_id)
        ->order_by('time','DESC')->result_array();
        return $result;
    }


    /**
     * get unread message by recipient_id
     * @param int   recipient_id    recipient's id
     * @param int   type    message's type
     * @return array $message on success,bool false on failure
     * precondition：recipient_id exits in TABLE user；
     * postcondition：return unread message array order by time desc
     */
    public function get_unread_message_by_recipient_id_and_type($recipient_id = -1,$type=-1){
        $result=$this->db->get('message')
        ->where('recipient_id',$recipient_id)
        ->where('status',UNREAD)
        ->where('type',$type)
        ->order_by('time','DESC')->result_array();
        return $result;
    }

}