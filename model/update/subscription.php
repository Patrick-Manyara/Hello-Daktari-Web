<?php

use FontLib\Table\Type\head;

if (!empty($_GET['dets'])) {
    $_POST = json_decode($_GET['dets'], true);
}
include_once 'create.php';
include_once '../../meeting/create_meeting.php';

// cout($_POST);

$sql = "SELECT * FROM subscription WHERE device_id = '$_COOKIE[device]' ORDER BY subscription_date_created DESC ";
$row = select_rows($sql)[0];
$sub_id = $row['subscription_id'];

$sql2 = "SELECT * FROM session WHERE device_id = '$_COOKIE[device]' ORDER BY session_date_created DESC ";
$row2 = select_rows($sql2)[0];
$doctor_id = $row2['doctor_id'];

$doctor_email = get_by_id('doctor', $doctor_id)['doctor_email'];

// cout($doctor_email);

$ses_id = $row2['session_id'];

$date = $row2['session_date'];
$st = $row2['session_start_time'];
$et = $row2['session_end_time'];

$session_mode = security('session_mode');

// cout($ses_id);

$arr = array();
$arr2 = array();

if (empty($row['subscription_email'])) {
    $arr['subscription_name'] = security('name');
    $arr['subscription_email'] = security('email');
    $arr['subscription_phone'] = security('phone_number');
}

if (empty($row2['client_id'])) {
    $arr2['client_id'] = $_SESSION['user_id'];
}
$arr2['session_payment_status'] = 'paid';
$arr2['session_mode'] = $session_mode;

$body       = '<p style="font-family:Poppins, sans-serif;"> ';
$body       .= 'Hello, <b>' . $arr['subscription_name'] . '</b> <br>';
$body       .= 'Your session has been successfully booked <br>';

$content   = '<p style="font-family:Poppins, sans-serif;"> ';
$content       .= 'Hello, you have a session with <b>' . $arr['subscription_name'] . '</b> <br>';
$content       .= 'The session has been successfully booked for:  <br>';
$content        .= '<br> <b> START TIME: </b> ' . $st;
$content        .= '<br> <b> START TIME: </b> ' . $et;
$content        .= '<br> <b> SESSION DATE: </b> ' . $date;


if ($session_mode == "virtual") {
    $time = $date . "T" . $time;
    $link = create_meeting($time, $row2['session_code'])->join_url;
    $host_key = "229980";
    $body .= "<p>Your meeting link is <a href = '" . $link . "'>" . $link . "</a>
		<br> and the host key is " . $host_key . "
		";

    $content .= "<p>Your meeting link is <a href = '" . $link . "'>" . $link . "</a>
		<br> and the host key is " . $host_key . "
		";

    build_sql_edit("session", array(
        "session_link" => $link
    ), $row2['session_id'], 'session_id');
}

$body       .= '</p>';

build_sql_edit("subscription", $arr, $sub_id, 'subscription_id');
build_sql_edit("session", $arr2, $ses_id, 'session_id');

email($arr['subscription_email'], APP_NAME . " Booking", APP_NAME, $body);
email($doctor_email, APP_NAME . " Booking", APP_NAME, $content);

header('location:../../success.php');
