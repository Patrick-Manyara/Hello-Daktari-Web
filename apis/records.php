<?php
include_once "../path.php";
include_once "create.php";


include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';

http_response_code(400);
$m['status'] = 0;
$id = create_id('upload', 'upload_id');
$arr = array(
    'upload_id'     => $id,
    'upload_code'   => 'FILE-' . generateRandomString('5'),
    'upload_name'   => security('upload_name'),
    'user_id'       => security('user_id')
);

if (!empty($_FILES['upload_file']['name'])) $arr['upload_file']   = upload_docs('upload_file');
if (!build_sql_insert('upload', $arr)) {
    $m['message']   = "Something went wrong";
    $m['data']      = false;
}
$user = get_by_id('user', security('user_id'));
if ($user['user_upload'] == 'yes') {
    $m['data']      = 2;

    $name       = APP_NAME;
    $subject    = APP_NAME . " Medical Records";

    $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
    $body       .= 'Your documents have been successfully stored.  <br>';
    $body       .= ' <b>SERVICE: </b> Medical Records Storage <br> ';
    $body       .= ' <b>PAYMENT ID: </b> ' . $id . ' <br> ';

    if ($user['user_upload'] == 'yes') {
        $body       .= 'You had already paid for your subscription.';
    } else {
        $body       .= 'Your payment has also been received.';
    }

    $body       .= '</p>';
    $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';


    $body2      .= '<p style="font-family:Poppins, sans-serif; ">A documents have been successfully stored.  <br>';
    $body2      .= ' <b>SERVICE: </b> Medical Records Storage <br> ';
    $body2      .= ' <b>PAYMENT ID: </b> ' . $id . ' <br> ';
    $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
    $body2      .= '</p>';

    email($user['user_email'], $subject, $name, $body);
} else {
    $m['data']      = 1;
    $m['from']      = 'records';
    $m['table_id']  = $id;
}


http_response_code(200);
$m['status'] = 1;
echo json_encode($m);
