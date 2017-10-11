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
        $sql = 'select * from activity where apply_expire < "2017-11-01 00:00:00" or isVerified = 3';
        $data = $this->db->query($sql)->result_array();
        foreach ($data as $datum){
            $datum['apply_expire'][3] = '8';
            $datum['activity_start'][3] = '8';
            $datum['activity_expire'][3] = '8';
            $this->db
                ->set(['isVerified'=>1,'apply_expire'=>$datum['apply_expire'],'activity_start'=>$datum['activity_start'],'activity_expire'=>$datum['activity_expire']])
                ->where('id',$datum['id'])
                ->update('activity');
        }
    }

}
