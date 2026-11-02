<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['pre_controller'][] = array(
    'class'    => 'RouteGuard',
    'function' => 'check',
    'filename' => 'RouteGuard.php',
    'filepath' => 'hooks'
);