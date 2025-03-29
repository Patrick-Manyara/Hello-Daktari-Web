<?php
function get_all_sessions($user_id = '', $doctor_id = '')
{
    $sql = "SELECT * FROM session JOIN doctor ON session.doctor_id = doctor.doctor_id ";
    $sql .= " JOIN user ON session.client_id  = user.user_id WHERE session.session_payment_status = 'paid' ";
    $user_id != '' ? $sql .= " AND session.client_id = '$user_id' " : " ";
    $doctor_id != '' ? $sql .= " AND session.doctor_id = '$doctor_id' " : " ";
    $sql .= " ORDER BY session.session_date_created DESC ";
    return select_rows($sql);
}

function get_session_today($user_id = '', $doctor_id = '')
{
    $today          = date('Y-m-d');
    $sql = "SELECT * FROM session JOIN doctor ON session.doctor_id = doctor.doctor_id WHERE session.session_payment_status = 'paid' ";
    $user_id != '' ? $sql .= " AND session.client_id = '$user_id' " : " ";
    $doctor_id != '' ? $sql .= " AND session.doctor_id = '$doctor_id' " : " ";
    $sql .= " AND session.session_date = '$today'   ";
    return select_rows($sql)[0];
}

function get_past_sessions($user_id = '', $doctor_id = '')
{
    $today          = date('Y-m-d');
    $sql = "SELECT * FROM session JOIN doctor ON session.doctor_id = doctor.doctor_id  WHERE session.session_payment_status = 'paid'";
    $user_id != '' ? $sql .= " AND session.client_id = '$user_id' " : " ";
    $doctor_id != '' ? $sql .= " AND session.doctor_id = '$doctor_id' " : " ";
    $sql .= " AND session.session_date <= '$today'  LIMIT 10 ";
    return select_rows($sql);
}

function get_upcoming_sessions($user_id = '', $doctor_id = '')
{
    $today          = date('Y-m-d');
    $sql = "SELECT * FROM session JOIN doctor ON session.doctor_id = doctor.doctor_id WHERE session.session_payment_status = 'paid' ";
    $user_id != '' ? $sql .= " AND session.client_id = '$user_id' " : " ";
    $doctor_id != '' ? $sql .= " AND session.doctor_id = '$doctor_id' " : " ";
    $sql .= " AND session.session_date > '$today'  LIMIT 10 ";
    return select_rows($sql);
}
