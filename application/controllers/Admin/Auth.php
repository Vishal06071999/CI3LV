<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('adminauth');
    }

    public function index()
    {
        if (admin_logged_in() === TRUE) {
            redirect('admin-dashboard');
        }

        $this->view->admin('login', [], false);
    }
    public function loginPost()
    {
        $response = [
            'status'  => false,
            'message' => ''
        ];
        if ($this->input->method() !== 'post') {
            $response['message'] = 'Invalid request method.';
            echo json_encode($response);
            exit;
        }
        $this->form_validation->set_rules(
            'user_id',
            'User ID',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim'
        );
        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status'  => false,
                'message' => (strip_tags(validation_errors()))
            ];
            echo json_encode($response);
            exit;
        }

        $AdminUser = "admin";
        $AdminPassword = "admin";

        $user_id = (trim($this->input->post('user_id', TRUE)));
        $password = $this->input->post('password', FALSE);
        $attemptKey = 'login_attempt_' . md5($user_id . '|' . $this->input->ip_address());
        $attempts = (int) $this->session->userdata($attemptKey);
        if ($attempts >= 5) {
            $response = [
                'status'  => false,
                'message' => ('Too many login attempts. Please try again later.'),
            ];
            echo json_encode($response);
            exit;
        }

        if (strcasecmp($user_id, $AdminUser) !== 0 || strcasecmp($password, $AdminPassword) !== 0) {
            $attempts++;
            $this->session->set_userdata(
                $attemptKey,
                $attempts
            );
            $response = [
                'status'  => false,
                'message' => ('Invalid User ID or password')
            ];
            echo json_encode($response);
            exit;
        }
        $this->session->sess_regenerate(TRUE);
        $this->session->unset_userdata($attemptKey);
        $sessionData = [
            'admin_user_id' => $AdminUser,
            'admin_role'   => "VADMINGS",
            'admin_logged_in'     => TRUE,
            'admin_login_time'    => time(),
            'admin_last_activity' => time(),
            'admin_login_ip'      => $this->input->ip_address(),
            'admin_user_agent'    => substr(
                $this->input->user_agent(),
                0,
                255
            )
        ];
        $this->session->set_userdata($sessionData);
        $response = [
            'status'  => true,
            'message' => ('Admin Login Successfully'),
            'redirect' => base_url('admin-dashboard')
        ];
        echo json_encode($response);
        exit;
    }
    public function logout()
    {

        $this->session->unset_userdata([
            'admin_user_id',
            'admin_role',
            'admin_logged_in',
            'admin_login_time',
            'admin_last_activity',
            'admin_login_ip',
            'admin_user_agent'
        ]);
        // $this->session->sess_destroy();
        $this->session->sess_regenerate(TRUE);
        redirect('admin-login');
    }
}
