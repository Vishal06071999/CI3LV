<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();

$CI->load->helper('notify');
$CI->load->helper('model');
$CI->load->helper('form');


function db_add()
{
    static $CI;

    if (!$CI) {
        $CI = &get_instance();
        $CI->load->database();
    }

    return $CI->db;
}


if (!function_exists('format')) {
    function format($number, $decimals = 2)
    {
        return number_format((float) $number, $decimals, '.', ',');
    }
}



if (!function_exists('pr')) {
    function pr($data, $die = false)
    {
        echo '<pre style="
            background:#1e1e1e;
            color:#d4d4d4;
            padding:20px;
            margin:0;
            box-sizing:border-box;
            font-family:monospace;
            font-size:11px;
            line-height:1.5;
        ">';
        print_r($data);
        echo '</pre>';
        if ($die === true) {
            die;
        }
    }
}



if (!function_exists('badge')) {
    function badge($status, $text = '')
    {
       return  '<span class="badge bg-'.$status.'"> ' . $text . ' </span>';
    }
}




if (!function_exists('json_response')) {
    function json_response($status = false, $message = '', $redirect = '',$target = '_self')
    {
        $response = [
            'status'   => (bool) $status,
            'message'  => $message,
            'redirect' => $redirect,
            'target' => $target
        ];
        echo  json_encode($response);
        exit;
    }
}


if (!function_exists('error_404')) {
    function error_404()
    {
        http_response_code(404);

        echo '<!DOCTYPE html>
            <html>
            <head>
                <title>404 - Page Not Found</title>
                <style>
                    body {
                        margin: 0;
                        font-family: Arial, sans-serif;
                        background: #f5f5f5;
                    }

                    .error {
                        height: 100vh;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        text-align: center;
                    }

                    .box {
                        background: #fff;
                        padding: 50px;
                        border-radius: 12px;
                        box-shadow: 0 5px 25px rgba(0,0,0,.10);
                    }

                    h1 {
                        font-size: 80px;
                        margin: 0;
                    }

                    h2 {
                        margin: 10px 0;
                    }

                    p {
                        color: #777;
                    }
                </style>
            </head>

            <body>

            <div class="error">
                <div class="box">
                    <h1>404</h1>
                    <h2>Page Not Found</h2>
                    <p>The requested route does not exist.</p>
                </div>
            </div>

            </body>
            </html>';

        exit;
    }
}



if (!function_exists('post_permission')) {
    function post_permission($fields = [])
    {
        $CI = &get_instance();

        // Only POST method allowed
        if (strtolower($CI->input->method()) !== 'post') {
            error_404();
        }

        $post_data = $CI->input->post();

        // Check extra fields
        $extra_fields = array_diff(
            array_keys($post_data ?? []),
            $fields
        );

        if (!empty($extra_fields)) {
            json_response(
                false,
                'Invalid field(s): ' . implode(', ', $extra_fields)
            );
        }

        // Check required fields
        foreach ($fields as $field) {
            $value = $CI->input->post($field);

            if (
                $value === null ||
                (is_string($value) && trim($value) === '') ||
                (is_array($value) && empty($value))
            ) {
                json_response(
                    false,
                    ucfirst(str_replace('_', ' ', $field))
                    . ' field is required'
                );
            }
        }

        return true;
    }
}





if (!function_exists('incomeProccess')) {
    function incomeProccess($user_id, $amount)
    {
        $db = db_add();

        $amount = (float) $amount;

        if (empty($user_id) || $amount <= 0) {
            return 0;
        }
        // Get user details
        $user = $db->select('paid_status, total_limit, pending_limit')
            ->where('user_id', $user_id)
            ->limit(1)
            ->get('users')
            ->row_array();

        if (empty($user) || (int) $user['paid_status'] !== 1) {
            return 0;
        }

        $totalLimit   = (float) $user['total_limit'];
        $pendingLimit = (float) $user['pending_limit'];

        $remainingLimit = $totalLimit - $pendingLimit;

        if ($remainingLimit <= 0) {
            return 0;
        }

        $income = min($amount, $remainingLimit);
        $newPendingLimit = $pendingLimit + $income;

        // Update pending limit
        $db->where('user_id', $user_id)
            ->update('users', [
                'pending_limit' => $newPendingLimit
            ]);

        if ($db->affected_rows() >= 0) {
            return $income;
        }

        return 0;
    }
}
