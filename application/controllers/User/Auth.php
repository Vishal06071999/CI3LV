<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth');
    }
    public function index()
    {
        if (is_logged_in() === TRUE) {
            redirect('dashboard');
        }
        $res['header'] = 'Login';

        $this->view->user('login', $res, false);
    }

    public function loginPost()
    {

        $allowPost = ['user_id','password'];
        post_permission($allowPost);
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
            json_response(false, (strip_tags(validation_errors())));
        }

        $user_id = (trim($this->input->post('user_id', TRUE)));
        $password = $this->input->post('password', FALSE);
        $attemptKey = 'login_attempt_' . md5($user_id . '|' . $this->input->ip_address());
        $attempts = (int) $this->session->userdata($attemptKey);
        if ($attempts >= 5) {
            json_response(false, 'Too many login attempts. Please try again later.');
        }
        $user = get_single_record(
            'users',
            [
                'user_id' => $user_id,
                'password' => $password
            ],
            '*'
        );
        if (!$user) {
            $attempts++;
            $this->session->set_userdata(
                $attemptKey,
                $attempts
            );
            json_response(false, 'Invalid User ID or password.');
        }

        if (strcasecmp($user['user_id'], $user_id) !== 0 || strcasecmp($user['password'], $password) !== 0) {
            json_response(false, 'Invalid User ID or password.');
        }
        if ((int) $user['status'] !== 0) {
            json_response(false, 'Your account has been blocked. Please contact support.');
        }
        $this->session->sess_regenerate(TRUE);
        $this->session->unset_userdata($attemptKey);
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
        json_response(true, 'Login Successfully.', base_url('dashboard'));
    }



    public function logout()
    {
        // $this->session->sess_destroy();
        $this->session->unset_userdata([
            'user_id',
            'role',
            'logged_in',
            'login_time',
            'last_activity',
            'login_ip',
            'user_agent'
        ]);
        $this->session->sess_regenerate(TRUE);
        redirect('login');
    }

    
}
