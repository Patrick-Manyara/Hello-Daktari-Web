<?php
function get_all_users($type = '')
{
    $sql = "SELECT * FROM user ";
    $type != '' ? $sql .= " WHERE user_type = '$type' " : '';
    $sql .= " ORDER BY user_date_created DESC";
    return select_rows($sql);
}

function get_user_by_id($id)
{
    $sql = "SELECT * FROM user WHERE user_id = '$id' ";
    return select_rows($sql)[0];
}


function get_user($attr, $col = 'user_email')
{
    $sql = "SELECT * 
        FROM 
            user 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_user_profile()
{
    $sql = "
        SELECT
            *
        FROM user
    ";

    return select_rows($sql);
}

function get_login()
{
    global $error;
    $email      = security('user_email');

    writing_system_logs("Logging user of email: [ $email ] in, session: [ " . json_encode($_SESSION) . ' ]');

    if(isset($_GET['page'])){
        $page = security('page', 'GET');
        $failed_url = base_url . 'login';
    }else{
        $page = base_url;
        $failed_url = base_url . 'login';
    }

    $login = get_user($email);

    if (empty($login)) {
        $error['login'] = 135;
        writing_system_logs("Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker($failed_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['user_password'], $login['user_password'])) {
        $error['login'] = 135;
        writing_system_logs("Password_Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker($failed_url);
    }

    $session_login  = array(
        'user_login'    => true,
        'user_email'    => $email,
        'user_id'       => $login['user_id'],
        'user_name'     => $login['user_name'],
        'success'       => array('login' => 204),
        'user_phone'    => $login['user_phone']
    );

    session_assignment($session_login);
    writing_system_logs("Login successful session created: [ " . json_encode($_SESSION) . ' ]');
    redirect_header($page);
}

function get_patients($id)
{
    $sql = "SELECT * FROM user WHERE doctor_id = '$id' ORDER BY user_date_created DESC";
    return select_rows($sql);
}

function get_all_uploads($id='')
{
    $sql = "SELECT * FROM upload ";
    $id != '' ? $sql .= " WHERE user_id  = '$id' " : "";
    $sql .= "  ORDER BY upload_date_created DESC";
    return select_rows($sql);
}

?>