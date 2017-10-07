<?php

/**
 * Class Member_and_activity_model
 *
 * 预定义返回null代表参数不合法 返回false代表数据库操作失败   关系结构  member_id  activity_id
 *
 * 根据提供的活动 id  返回该活动的所有参与者信息的多维数组
 * public function get_member_by_activity_id($activity_id = -1)
 *
 * 根据提供的参与者 id  返回其所参与的所有活动信息的多维数组
 * public function get_activity_by_member_id($member_id = -1)
 *
 * 根据提供的活动 id 和 参与者 id 删除对应活动
 * public function remove_member_from_activity_by_id($activity_id = -1, $member_id = -1)
 *
 * 根据提供的活动 id   删除所有包含该活动的条目
 * public function remove_by_activity_id($activity_id = -1)
 *
 * 更具提供的用户 id   删除所有包含该用户的条目
 * public function remove_by_user_id($user_id)
 *
 * 根据提供的用户 id 和 活动 id   创建新的条目并插入数据库
 * public function insert_new_relation($user_id = -1, $activity_id = -1, $isRecommended = 0)
 *
 */
class Member_and_activity_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('Activity_model');
    }

    /**
     * 获得活动成员数组
     *
     * 通过活动ID查找其成员。函数接受一个参数活动ID，如果合法（id>0），返回其成员的一个数组
     *
     * @param int $activity_id
     * @return null OR array $data
     */
    public function get_member_by_activity_id($activity_id = -1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            $data = array();
            $member = $this->db->get_where('relation_activity_members', array('activity_id' => $activity_id))->result_array();
            foreach ($member as $member_item) {
                $data[] = $this->User_model->get_user_by_id($member_item['member_id']);
            }
            return $data;
        }
    }

    /**
     * 获得用户参与的活动
     *
     * 通过用户ID查找其参与的活动。函数接受一个参数活用户ID，如果合法（id>0），返回其参与活动的一个数组
     *
     * @param int $member_id
     * @return null OR array $data
     */
    public function get_activity_by_member_id($member_id = -1)
    {
        if ($member_id <= 0)
            return null;
        else {
            $data = array();
            $activity = $this->db->get_where('relation_activity_members', array('member_id' => $member_id))->result_array();
            foreach ($activity as $activity_item) {
                $temp = $this->Activity_model->get_activity_by_id($activity_item['activity_id']);
                if ($temp !== null){
                    $temp['rate'] = $activity_item['rate'];
                    $data[] = $temp;
                }
            }
            return $data;
        }
    }

    /**
     * 获得用户参与的随机的活动,数量由number控制
     *
     * 通过用户ID查找其参与的活动。函数接受一个参数活用户ID，如果合法（id>0），返回其参与活动的一个数组
     *
     * @param int $member_id
     * @return array
     */
    public function get_random_activity_id_by_member_id($member_id)
    {
        $sql = 'SELECT count(*) AS activity_count 
          FROM relation_activity_members AS ram JOIN activity AS a
          WHERE a.isVerified=1 
          && ram.activity_id=a.id 
          && ram.member_id=' . $member_id;
        $activity_count = $this->db->query($sql)
                ->row_array()['activity_count'] - 1;
        srand(time());
        $rand = rand(0, $activity_count);
        return $this->db->select('activity_id')
            ->limit(1, $rand)
            ->get_where('relation_activity_members', array('member_id' => $member_id))->row_array();
    }

    /**
     * 获得用户参与的随机的活动,数量由number控制
     *
     * 通过用户ID查找其参与的活动。函数接受一个参数活用户ID，如果合法（id>0），返回其参与活动的一个数组
     *
     * @param int $number
     * @return array
     */
    public function get_random_activity_id($number = 1)
    {
        return $this->db->select('activity_id')
            ->order_by(time(), 'RANDOM')
            ->limit($number)
            ->get('relation_activity_members')->result_array();
    }

    public function is_exist($member_id, $activity_id)
    {
        if ($member_id <= 0 || $activity_id <= 0)
            return null;
        else {
            if (empty($this->db->get_where('relation_activity_members', array('member_id' => $member_id, 'activity_id' => $activity_id))->result_array()))
                return false;
            else
                return true;
        }
    }


    public function get_recommended_activity_amount_by_user_id($member_id = -1)
    {
        if ($member_id < 0)
            return null;
        return $this->db
            ->select('count(*)')
            ->get_where('relation_activity_members', array('member_id' => $member_id, 'isRecommended' => 1))
            ->row_array()['count(*)'];
    }

    public function get_joined_activity_amount_by_user_id($member_id = -1)
    {
        if ($member_id < 0)
            return null;
        return $this->db
            ->select('count(*)')
            ->get_where('relation_activity_members', array('member_id' => $member_id))
            ->row_array()['count(*)'];
    }

    /*    public function get_activity_rate_by_member_id($member_id){
            if ($member_id <= 0)
                return null;
            else {
                $data = $this->db->get_where('relation_activity_members', array('member_id' => $member_id))->select("rate")->result_array();
                return $data;
            }
        }*/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function remove_member_from_activity_by_id($activity_id = -1, $member_id = -1)
    {
        if ($activity_id <= 0 || $member_id <= 0)
            return null;
        else if ($this->is_exist($member_id, $activity_id)) {
            $activity = $this->Activity_model->get_activity_by_id($activity_id);
            $activity['member_number']--;
            if ($activity['member_number'] < 0)
                return false;
            unset($activity['id']);
            if ($this->Activity_model->update_activity_by_id($activity_id, $activity) == false)
                return false;

            if ($this->db->delete('relation_activity_members', array('activity_id' => $activity_id, 'member_id' => $member_id)) == false)
                return false;
            return true;
        }
    }


    public function remove_by_activity_id($activity_id = -1)
    {
        if ($activity_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_activity_members', array('activity_id' => $activity_id)) == false)
                return false;
            return true;
        }
    }

    public function remove_by_user_id($user_id)
    {
        $activity = $this->get_activity_by_member_id($user_id);
        foreach ($activity as $activity_item) {
            $activity_to_delete = $this->Activity_model->get_activity_by_id($activity_item['id']);
            $activity_to_delete['member_number']--;
            if ($activity_to_delete['member_number'] < 0)
                return false;
            unset($activity_to_delete['id']);
            if ($this->Activity_model->update_activity_by_id($activity_item['id'], $activity_to_delete) == false)
                return false;
        }
        if ($user_id <= 0)
            return null;
        else {
            if ($this->db->delete('relation_activity_members', array('member_id' => $user_id)) == false)
                return false;
            return true;
        }
    }

    /**
     *
     * 为一个活动添加一个新成员
     *
     * 如果两个ID不合法， 返回null，
     *
     * 如果合法插入 （user_id，activity_id） 关系，失败返回false     *
     *
     * @param int $user_id
     * @param int $activity_id
     * @param int $isRecommended
     * @return bool|null
     */
    public function insert_new_relation($user_id = -1, $activity_id = -1, $isRecommended = 0)
    {
        if ($user_id <= 0 || $activity_id <= 0)
            return null;
        if (empty($this->db->get_where('relation_activity_members', array('member_id' => $user_id, 'activity_id' => $activity_id))->result_array())) {
            if ($this->is_exist($user_id, $activity_id))
                return false;

            $activity = $this->Activity_model->get_activity_by_id($activity_id);
            $activity['member_number']++;
            unset($activity['id']);
            if ($this->Activity_model->update_activity_by_id($activity_id, $activity) == false)
                return false;

            $data = array(
                'member_id' => $user_id,
                'activity_id' => $activity_id,
                'isRecommended' => $isRecommended
            );
            if ($this->db->insert('relation_activity_members', $data) == false)
                return false;
            return true;
        } else
            return false;
    }

    public function update_rate($user_id, $activity_id, $rate)
    {
        if ($user_id <= 0 || $activity_id <= 0 || $rate <= 0)
            return null;
        if ($this->is_exist($user_id, $activity_id)) {
            if ($this->db->update("relation_activity_members", array('rate' => $rate), array('member_id' => $user_id, 'activity_id' => $activity_id)) == false)
                return false;
            return true;
        } else
            return false;
    }
}