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

    public function allUsers()
    {
        $res['header'] = "All User";

        $res['th'] = ['#','User ID','Name'];
        $users = get_records('users',[],'user_id,name');
        $res['td'] = $users;
    $res['export'] = true;

        $this->view->admin('reports', $res);
    }


    //  public function allUsers()
    // {
    //     $res['header'] = "All User";
    //     $res['th'] = ['#','User ID','Name','Action'];
    //     $users = get_records('users',[],'user_id,name');
    //     $td =[];
    //     foreach ($users as $key => $user) {
    //         extract($user);
    //         $link ="<a href='dasdasd'>test</a>";
    //         $td[$key] = [$user_id,$name,$link];
    //     }
    //     $res['td'] = $td;
    //     $res['export'] = true;
    //     $this->view->admin('reports', $res);
    // }
}
