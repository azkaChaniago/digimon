<?php

function is_logged_in()
{
    $CI =& get_instance();
    $user = $CI->session->userdata('login');
    
    if (!isset($user))
    {
        return redirect(base_url('index.php/login'));
    }
}