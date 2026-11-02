<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('admin_logged_in')) {

    function admin_logged_in()
    {
        $CI = &get_instance();
        if (!$CI->session) {
            $CI->load->library('session');
        }
        if ($CI->session->userdata('admin_logged_in') !== TRUE) {
            return FALSE;
        }
        $loginTime = (int) $CI->session->userdata('admin_login_time');
        if (!$loginTime) {
            return FALSE;
        }

        $user_id = $CI->session->userdata('admin_user_id');
        if (!$user_id) {
            return FALSE;
        }

        $role = $CI->session->userdata('admin_role');
        if (!$role &&  $role != "VADMINGS") {
            return FALSE;
        }


        $maxSessionTime = 3600;
        if ((time() - $loginTime) > $maxSessionTime) {
            $CI->session->sess_destroy();
            return FALSE;
        }
        $sessionIp = $CI->session->userdata('admin_login_ip');
        if (
            $sessionIp &&
            $sessionIp !== $CI->input->ip_address()
        ) {
            $CI->session->sess_destroy();
            return FALSE;
        }
        $sessionAgent = $CI->session->userdata('admin_user_agent');
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
if (!function_exists('adminrequire_login')) {

    function adminrequire_login()
    {
        if (!admin_logged_in()) {

            $CI = &get_instance();

            $CI->session->set_flashdata(
                'error',
                'Please login to continue.'
            );

            redirect('admin-login');
            exit;
        }
    }
}

if (!function_exists('adminredirect_if_logged_in')) {

    function adminredirect_if_logged_in($url = 'admin-dashboard')
    {
        if (admin_logged_in()) {
            redirect($url);
            exit;
        }
    }
}
if (!function_exists('adminauth_logout')) {
    function adminauth_logout()
    {
        $CI = &get_instance();
        // $CI->session->sess_destroy();
        $CI->session->unset_userdata([
            'admin_user_id',
            'admin_role',
            'admin_logged_in',
            'admin_login_time',
            'admin_last_activity',
            'admin_login_ip',
            'admin_user_agent'
        ]);
        redirect('admin-login');
        exit;
    }
}



if (!function_exists('admin_header')) {
    function admin_header()
    {
        $CI = &get_instance();
        // $CI->session->sess_destroy();
        $CI->load->library('AdminHeader');
       return $CI->adminheader->header();
    }
}
