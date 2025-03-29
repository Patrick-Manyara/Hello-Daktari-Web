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
$ses_id = $row2['session_id'];

$date = $row2['session_date'];
$st = $row2['session_start_time'];
$et = $row2['session_end_time'];

$session_mode = 'virtual';

// cout($ses_id);

$arr = array();
$arr2 = array();

$arr['subscription_name'] = $_POST['name'];
$arr['subscription_email'] = $_POST['email'];
$arr['subscription_phone'] = $_POST['phone_number'];

$arr2['client_id'] = $_SESSION['user_id'];
$arr2['session_payment_status'] = 'paid';

if ($session_mode == "virtual") {
    $time = $date . "T" . $time;
    $link = create_meeting($time, $row2['session_code'])->join_url;
    $host_key = "229980";
    // $p .= "<p>Your meeting link is <a href = '" . $link . "'>" . $link . "</a>
    // <br> and the host key is " . $host_key . "
    // </p>";
    build_sql_edit("session", array(
        "session_link" => $link
    ), $row2['session_id'], 'session_id');
}

// cout($link);

build_sql_edit("subscription", $arr, $sub_id, 'subscription_id');
build_sql_edit("session", $arr2, $ses_id, 'session_id');

header('location:../../success.php');
