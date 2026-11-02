<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminHeader
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

  public function header(){
    $header = [
        'Users' => [
            ['name' => 'All Users','url' =>'admin-all-users'],
            ['name' => 'Paid Users','url' =>'admin-paid-users']

        ],
        'Login' => [
            ['name' => 'Login','url' =>'login']
        ]

    ];
    return $header;
  }

}
