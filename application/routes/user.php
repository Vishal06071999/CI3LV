<?php
// REGISTER
$route['register'] = 'User/Register';
$route['registerAjax'] = 'User/Register/registerPost';
$route['success'] = 'User/Register/success';
$route['get-user'] = 'User/Register/get_user';


// AUTH
$route['login'] = 'User/Auth';
$route['loginAjax'] = 'User/Auth/loginPost';
$route['logout'] = 'User/Auth/logout';

// DASHBOARD
$route['dashboard'] = 'User/Dashboard';

//ACTIVATION 
$route['activation'] = 'User/Activation';
$route['activationAjax'] = 'User/Activation/activationPost';

