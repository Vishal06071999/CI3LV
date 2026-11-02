<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * Render a view
     */
    public function render($view, $data = [], $return = false)
    {
        return $this->CI->load->view($view, $data, $return);
    }

    /**
     * Render view with header + content + footer
     */
    public function simple_view($view, $data = [])
    {
        $this->CI->load->view($view, $data);
    }

    /**
     * Render view with header + sidebar + content + footer
     */
    public function user($view, $data = [], $header = true)
    {
        if ($header == true) {
        $this->CI->load->view('User/header', $data);
        }
        $this->CI->load->view('User/' . $view, $data);
         if ($header == true) {
        $this->CI->load->view('User/footer', $data);
        }
    }



    public function admin($view, $data = [], $header = true)
    {
        if ($header == true) {
            $this->CI->load->view('Admin/header', $data);
        }
        $this->CI->load->view('Admin/' . $view, $data);
        if ($header == true) {

            $this->CI->load->view('Admin/footer', $data);
        }
    }
}
