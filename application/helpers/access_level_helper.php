<?php

function is_admin()
{

    $CI =& get_instance();

    if ($CI->session->userdata('access_level') == 'Admin') {
        return true;
    } else {
        return false;
    }
}

function is_manager()
{
    $CI =& get_instance();
    if ($CI->session->userdata('access_level') == 'Manager') {
        return true;
    } else {
        return false;
    }
}

function is_user()
{
    $CI =& get_instance();
    if ($CI->session->userdata('access_level') == 'User') {
        return true;
    } else {
        return false;
    }
}

function is_sale()
{
    $CI =& get_instance();
    if ($CI->session->userdata('access_level') == 'Sales') {
        return true;
    } else {
        return false;
    }
}

function user_access_level()
{
    $CI =& get_instance();
    return $CI->session->userdata('access_level');
}

function logged_user_name()
{
    $CI =& get_instance();
    return $CI->session->userdata('user_name');

}

function user_company()
{
    $CI =& get_instance();
    return $CI->session->userdata('company_id');
}

function logged_user_id(){
    $CI =& get_instance();
    return $CI->session->userdata('user_id');
}

function user_name()
{
    $CI =& get_instance();
    return $CI->session->userdata('user_name');
}

function generate_password($password)
{
    return md5('gil' . $password);
}