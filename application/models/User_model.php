<?php

/**
 * Class User_model
 *
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败
 * 用户信息： email  nick_name  password  phone_number avatar
 *
 * 获取所有的用户信息  返回所有用户信息的多维数组
 * public function get_user()
 *
 * 根据提供的用户 id  返回该用户信息的单行数组
 * public function get_user_by_id($id=-1)
 *
 * 根据提供的活动 id  返回该活动的创建者信息的单行数组
 * public function get_creator_by_activity_id($activity_id=-1)
 *
 * 根据提供的 email   返回该用户信息的单行数组
 * public function get_user_by_email($email=-1)
 *
 * 根据提供的 email   返回该用户的 id
 * public function get_user_id_by_email($email = null)
 *
 * 根据提供的用户 id  删除对应用户
 * public function remove_by_id($user_id=-1)
 *
 * 根据提供的用户信息数组   创建新的用户条目并插入数据库
 * public function insert_new_user_info($array_for_user_info = null)
 *
 * 根据提供的用户 id 和 新的该用户信息的数组   修改对应用户的信息
 * public function update_user_info_by_id($user_id = -1, $array_for_user_info = null)
 */
class User_model extends CI_Model
{
    /**
     * @var array
     */
    var $user_info_available = array('email', 'nick_name','password','phone_number','avatar');

    public function validate_user($user_email = null, $user_password = null)
    {
        if ($user_email == null && $user_password == null)
            return null;
        $user_info = $this->get_user_by_email("$user_email");
        if ($user_info['password'] == $user_password)
            return true;
        else
            return false;
    }

    /**
     * 获得所有用户
     *
     * 查找所有用户，返回所有用户的一个数组；
     *
     * @return null OR array $data
     */
    public function get_user()
    {
        return $this->db->get('user')->result_array();
    }

    /**
     * 获得指定用户
     *
     * 通过用户ID查找用户。函数接受一个参数用户ID，如果合法（id>0），返回该用户；
     * 也可以提供需要查询的条目名称返回对应单条数据
     *
     * @param int $id
     * @param null $info_selected
     * @return array|null
     */
    public function get_user_by_id($id = -1,$info_selected = null)
    {
        if ($id < 0)
            return null;
        else{
            $result = $this->db->get_where('user', array('id' => $id))->row_array();
            if ($info_selected == null)
                return $result;
            else if (in_array($info_selected,$this->user_info_available) == true)
                return $result[$info_selected];
        }
    }

    /**
     * 随机获得对应推荐组成员，数量由limit确定
     * @param $recommend_group_id
     * @param int $limit
     * @return array $data
     */
    public function get_random_users_by_recommend_group_id($recommend_group_id,$limit=10){
        $data=array();
        $sql='SELECT count(*) as user_count FROM user WHERE recommend_group_id='.$recommend_group_id;
        $user_count=$this->db->query($sql)->row_array()['user_count']-1;
        for($i=0;$i<$limit;$i++){
            $rand=rand(0,$user_count);
            $data[]=$this->db ->limit(1,$rand)
                ->get_where('user',['recommend_group_id'=>$recommend_group_id])->row_array();

        }
        return $data;
    }

    /**
     * 获得活动的创建者
     *
     * 通过活动ID查找它的创建者。函数接受一个参数活动ID，如果合法（id>0），返回它的创建者；
     *
     * @param int $activity_id
     * @return null OR $data
     */
    public function get_creator_by_activity_id($activity_id = -1)
    {
        $this->load->model('Activity_model');
        $activity = $this->Activity_model->get_activity_by_id($activity_id);
        if ($activity == null)
            return null;
        else {
            return $this->get_user_by_id($activity['creator_id']);
        }
    }

    public function get_user_by_email($email = -1)
    {
        return $this->db->get_where('user', array('email' => $email))->row_array();
    }

    public function get_user_id_by_email($email = null)
    {
        if ($email == null)
            return null;
        $user_info = $this->db->get_where('user', array('email' => $email))->row_array();
        if ($user_info == false)
            return false;
        return $user_info['id'];
    }

    public function remove_by_id($user_id = -1)
    {
        if ($user_id <= 0)
            return null;
        else {
            $this->load->model('Member_and_activity_model');
            $this->load->model('Browser_and_trace');
            $this->load->model('User_and_first_label');
            $this->load->model('User_and_second_label');

            if ($this->Member_and_activity_model->remove_by_user_id($user_id) == false)
                return false;
            if ($this->Browser_and_trace_model->remove_by_browser_id($user_id) == false)
                return false;
            if ($this->User_and_first_label_model->remove_by_user_id($user_id) == false)
                return false;
            if ($this->User_and_second_label_model->remove_by_user_id($user_id) == false)
                return false;

            if ($this->db->delete('user', array('id' => $user_id)) == false)
                return false;
            return true;
        }
    }

    /**
     *
     * 提交注册表单时已完成是否重复检验
     *
     * array_for_user_info = array(
     *      email  nick_name  password  phone_number )
     *
     * @param null $array_for_user_info
     * @return bool|null
     */
    public function insert_new_user_info($array_for_user_info = null, &$user_id = null)
    {
        if ($array_for_user_info == null)
            return null;
        if ($this->db->insert('user', $array_for_user_info) == false)
            return false;
        $user_id = $this->get_user_id_by_email($array_for_user_info['email']);
        return true;
    }

    /**
     *
     * array_for_user_info = array(
     *      email  nick_name  password  phone_number )
     *
     * @param int $user_id
     * @param null $array_for_user_info
     * @return bool|null
     */
    public function update_user_info_by_id($user_id = -1, $array_for_user_info = null)
    {
        if ($user_id <= 0 || $array_for_user_info == null)
            return null;
        $this->db->where('id', $user_id);
        if ($this->db->update('user', $array_for_user_info) == false)
            return false;
        return true;
    }

    public function update_user_recommend_group_id($user_id,$recommend_group_id){
        if ($this->db->where('id',$user_id)
                ->set('recommend_group_id',$recommend_group_id)
                ->update('user') == false)
            return false;
        return true;
    }
}