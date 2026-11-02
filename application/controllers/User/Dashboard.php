<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth');
        require_login();
    }

    public function index()
    {
        $res['header'] = "Dashboard";
        $res['user'] = loginuser();
        $this->view->user('dashboard',$res);
    }
}