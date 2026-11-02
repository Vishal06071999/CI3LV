<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('adminauth');

        adminrequire_login();
    }

    // public function allUsers()
    // {
    //     $res['header'] = "All User";
    //     $res['th'] = ['#', 'User ID', 'Name'];
    //     $users = get_records('users', [], 'user_id,name');
    //     $res['td'] = $users;
    //     $res['export'] = true;
    //     $this->view->admin('reports', $res);
    // }



}
