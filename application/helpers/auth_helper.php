<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('is_logged_in')) {

    function is_logged_in()
    {
        $CI = &get_instance();
        if (!$CI->session) {
            $CI->load->library('session');
        }
        if ($CI->session->userdata('logged_in') !== TRUE) {
            return FALSE;
        }
        $loginTime = (int) $CI->session->userdata('login_time');
        if (!$loginTime) {
            return FALSE;
        }

        $user_id = $CI->session->userdata('user_id');
        if (!$user_id) {
            return FALSE;
        }

        $role = $CI->session->userdata('role');
        if (!$role &&  $role != "USER") {
            return FALSE;
        }


        $maxSessionTime = 3600;
        if ((time() - $loginTime) > $maxSessionTime) {
            $CI->session->sess_destroy();
            return FALSE;
        }
        $sessionIp = $CI->session->userdata('login_ip');
        if (
            $sessionIp &&
            $sessionIp !== $CI->input->ip_address()
        ) {
            $CI->session->sess_destroy();
            return FALSE;
        }
        $sessionAgent = $CI->session->userdata('user_agent');
        $currentAgent = substr(
            $CI->input->user_agent(),
            0,
            255
        );
        if (
            $sessionAgent &&
            $sessionAgent !== $currentAgent
        ) {
            $CI->session->sess_destroy();
            return FALSE;
        }
        return TRUE;
    }
}
if (!function_exists('require_login')) {

    function require_login()
    {
        if (!is_logged_in()) {

            $CI = &get_instance();

            $CI->session->set_flashdata(
                'error',
                'Please login to continue.'
            );

            redirect('login');
            exit;
        }
    }
}

if (!function_exists('redirect_if_logged_in')) {

    function redirect_if_logged_in($url = 'dashboard')
    {
        if (is_logged_in()) {
            redirect($url);
            exit;
        }
    }
}
if (!function_exists('auth_logout')) {
    function auth_logout()
    {
        $CI = &get_instance();
        // $CI->session->sess_destroy();
        $CI->session->unset_userdata([
            'user_id',
            'role',
            'logged_in',
            'login_time',
            'last_activity',
            'login_ip',
            'user_agent'
        ]);
        redirect('login');
        exit;
    }
}


if (!function_exists('loginuser')) {
    function loginuser()
    {
        $CI = &get_instance();

        $data =  db_add()
            ->select('*')
            ->where_in('user_id', $CI->session->userdata['user_id'])
            ->get('users')->row_array();
        return $data;
    }
}


if (!function_exists('user_id')) {
    function user_id()
    {
        $CI = &get_instance();

        $data =  db_add()
            ->select('user_id')
            ->where_in('user_id', $CI->session->userdata['user_id'])
            ->get('users')->row_array();
        return $data['user_id'];
    }
}
