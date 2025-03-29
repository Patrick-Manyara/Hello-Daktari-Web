<?php
function get_doctor($attr, $col = 'doctor_email', $login = false)
{
    $sql = "SELECT * FROM  doctor WHERE  $col='$attr' ";
    return select_rows($sql)[0];
}

function get_doctor_profile()
{
    $sql = "
        SELECT
            *
        FROM doctor
    ";

    return select_rows($sql);
}

function get_doctor_login()
{
    global $error;
    $email      = $_POST['doctor_email'];

    writing_system_logs("Logging user of email: [ $email ] in, session: [ " . json_encode($_SESSION) . ' ]');

    error_checker(doctor_url);

    $login = get_doctor($email, 'doctor_email', true);

    if (empty($login)) {
        $error['login'] = 135;
        writing_system_logs("Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker(doctor_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['doctor_password'], $login['doctor_password'])) {
        $error['login'] = 135;
        writing_system_logs("Password_Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker(doctor_url);
    }

    $session_login  = array(
        'doctor_login'       => true,
        'doctor_email'       => $email,
        'doctor_name'        => $login['doctor_name'],
        'doctor_id'          => $login['doctor_id'],
        'success'               => array('doctor_login' => 204)
    );

    session_assignment($session_login);
    writing_system_logs("Login successful session created: [ " . json_encode($_SESSION) . ' ]');
    redirect_header(doctor_url);
}

function get_all_doctors($status = '', $limit = '')
{
    $sql = "SELECT * FROM doctor ";
    $status != '' ? $sql .= " WHERE doctor_activation = '$status' " : " " ;
    $sql .= "ORDER BY rand()";
    $limit != '' ? $sql .= " LIMIT $limit " : " " ;
    return select_rows($sql);
}

function get_doctor_by_category($id)
{
    $sql = "SELECT * FROM doctor WHERE category_id LIKE '%$id%'  ORDER BY rand() ";
    return select_rows($sql);
}

function get_saved_doctors($column,$value)
{
    $sql = "SELECT * FROM bookmark WHERE $column = '$value' ";
    return select_rows($sql);
}

function get_client_doctor($value)
{
    $sql = "SELECT * FROM doctor WHERE doctor_id = '$value' ";
    return select_rows($sql);
}

function get_rebook_doctor($value)
{
    $sql = "SELECT * FROM doctor WHERE doctor_id = '$value' ";
    return select_rows($sql);
}

function get_all_groups()
{
    $sql = "SELECT * FROM company ";
    $sql .= "ORDER BY rand()";
    return select_rows($sql);
}

function get_locations()
{
    $sql = "SELECT doctor_location FROM doctor GROUP BY doctor_location ORDER BY doctor_location ASC";
    return select_rows($sql);
}

