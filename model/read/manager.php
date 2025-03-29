<?php

function get_manager($attr, $col = 'user_email', $login = false)
{
    $sql = "SELECT 
        *
        FROM 
            user 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_manager_profile()
{
    $sql = "
        SELECT
            *
        FROM admin
    ";

    return select_rows($sql);
}

function get_manager_login()
{
    global $error;
    $email      = $_POST['user_email'];

    // cout($_POST);
    writing_system_logs("Logging user of email: [ $email ] in, session: [ " . json_encode($_SESSION) . ' ]');

    error_checker(manager_url);

    $login = get_manager($email, 'user_email', true);

    if (empty($login)) {
        $error['login'] = 135;
        writing_system_logs("Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker(manager_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['user_password'], $login['user_password'])) {
        $error['login'] = 135;
        writing_system_logs("Password_Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker(manager_url);
    }

    $session_login  = array(
        'manager_login'       => true,
        'manager_email'       => $email,
        'manager_name'        => $login['user_name'],
        'manager_id'          => $login['user_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);
    writing_system_logs("Login successful session created: [ " . json_encode($_SESSION) . ' ]');
    redirect_header(manager_url . 'dashboard');
}
