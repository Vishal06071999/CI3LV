<?php
if (!function_exists('post_login_button')) {
    function post_login_button($user_id)
    {
        $action = base_url('user-login');
        $CI = &get_instance();


        return '<form id="UserLogin" action="' . $action . '" method="post" style="display:inline;" data-ajax="true"  target="_blank">
        <input
            type="hidden"
            name="' . $CI->security->get_csrf_token_name() . '"
            value="' . $CI->security->get_csrf_hash() . '">
            <input type="hidden" name="user_id" value="' . htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') . '">
            <button type="submit" id="UserLoginBtn" class="btn btn-sm btn-info" target="_blank"  data-confirm="Are you sure you want to login?">Login</button>
        </form>';
    }
}



if (!function_exists('post_block_unlock_button')) {
    function post_block_unlock_button($user_id,$name)
    {

        $action = base_url('block-users');
        $CI = &get_instance();
        return '<form id="blockUsers" action="' . $action . '" method="post" style="display:inline;" data-ajax="true"  target="_blank">
        <input
            type="hidden"
            name="' . $CI->security->get_csrf_token_name() . '"
            value="' . $CI->security->get_csrf_hash() . '">
            <input type="hidden" name="user_id" value="' . htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') . '">
            <button type="submit" id="blockLoginBtn" data-confirm="Are you sure you want to '.((strip_tags($name) == strip_tags("Now Block") ) ? 'Un-Block' : 'Block').'?" class="btn btn-sm" target="_blank">'.$name.'</button>
        </form>';
    }
}