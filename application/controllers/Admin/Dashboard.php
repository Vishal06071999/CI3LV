<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('adminauth');

        adminrequire_login();
    }

    public function index()
    {
        $res['header'] = "Admin Dashboard";
        $res['total_users'] = count_record('users', []);
        $res['paid_users'] = count_record('users', ['paid_status' => 1]);
        $res['e_wallet'] = sum_record('e_wallet', []);
        // $res['user'] = loginuser();
        $this->view->admin('dashboard', $res);
    }

    public function userLogin()
    {

        $allowPost = ['user_id'];
        post_permission($allowPost);
        $this->form_validation->set_rules(
            'user_id',
            'User ID',
            'required|trim'
        );
        if ($this->form_validation->run() === FALSE) {
            json_response(false, (strip_tags(validation_errors())));
        }

        $user_id = (trim($this->input->post('user_id', TRUE)));
        $user = get_single_record(
            'users',
            [
                'user_id' => $user_id
            ],
            '*'
        );
        if (!$user) {
            json_response(false, 'Invalid User ID ');
        }

        if (strcasecmp($user['user_id'], $user_id) !== 0) {
            json_response(false, 'Invalid User ID');
        }

        $this->session->sess_regenerate(TRUE);
        $sessionData = [
            'user_id' => $user['user_id'],
            'role'   => "USER",
            'logged_in'     => TRUE,
            'login_time'    => time(),
            'last_activity' => time(),
            'login_ip'      => $this->input->ip_address(),
            'user_agent'    => substr(
                $this->input->user_agent(),
                0,
                255
            )
        ];
        $this->session->set_userdata($sessionData);

        json_response(true, 'User Login Successfully.', base_url('dashboard'), '_blank');
    }



    public function blockUsers()
    {

        $allowPost = ['user_id'];
        post_permission($allowPost);
        $this->form_validation->set_rules(
            'user_id',
            'User ID',
            'required|trim'
        );
        if ($this->form_validation->run() === FALSE) {
            json_response(false, (strip_tags(validation_errors())));
        }

        $user_id = (trim($this->input->post('user_id', TRUE)));
        $user = get_single_record(
            'users',
            [
                'user_id' => $user_id
            ],
            '*'
        );

        if (!$user) {
            json_response(false, 'Invalid User ID ');
        }

        if (strcasecmp($user['user_id'], $user_id) !== 0) {
            json_response(false, 'Invalid User ID');
        }

        if ($user['status'] == 0) {
            $update_status = 1;
            $name = 'Blocked';
        } else {
            $update_status = 0;
            $name = 'Un-block';
        }
        update('users', ['user_id' => $user['user_id']],['status' => $update_status]);

        json_response(true, 'User ' . $name);
    }



    public function allUsers()
    {
        $res['header'] = "All User";
        $res['th'] = ['#', 'User ID', 'Name', 'Status', 'Action'];
        $users = get_records('users', [], 'user_id,name,paid_status,status');
        $td = [];
        foreach ($users as $key => $user) {
            extract($user);
            $paidstatus = ($paid_status == 0) ? badge('danger', 'In-active') : badge('success', 'Active');
            $blockstatus = ($status == 0) ? badge('success', 'Now Un-Block') : badge('danger', 'Now Block');
            $blockbtn = post_block_unlock_button($user_id, $blockstatus);
            $link = post_login_button($user_id) . ' | ' . $blockbtn;
            $td[$key] = [$user_id, $name, $paidstatus, $link];
        }
        $res['td'] = $td;
        $res['export'] = true;
        $this->view->admin('reports', $res);
    }


    public function paidUsers()
    {
        $res['header'] = "Paid Users";
        $res['th'] = ['#', 'User ID', 'Name', 'Status', 'Action'];
        $users = get_records('users', ['paid_status' => 1], 'user_id,name,paid_status');
        $td = [];
        foreach ($users as $key => $user) {
            extract($user);
            $status = ($paid_status == 0) ? badge('danger', 'In-active') : badge('success', 'Active');
            $link = post_login_button($user_id);

            $td[$key] = [$user_id, $name, $status, $link];
        }
        $res['td'] = $td;
        $res['export'] = true;
        $this->view->admin('reports', $res);
    }
}
