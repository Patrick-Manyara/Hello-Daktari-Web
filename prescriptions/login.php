<?php
include_once "../path.php";
require_once MODEL_PATH . "operations.php";
http_response_code(403);
$email = security('user_email');
$sql = "select * from user where user_email = '$email' ";
$row = select_rows($sql);
$m['post'] = $_POST;
if (!empty($row)) {
    $row = $row[0];
    $m['status'] = 0;
    if (!password_hashing_hybrid_maker_checker($_POST['user_password'], $row['user_password'])) {
        $m['message'] = "Access denied: Incorrect password";
    } else {
        $m['status'] = 1;
        $m['data'] = $row;
        http_response_code(200);
    }
} else {
    $m['message'] = "Access denied : email not found";
}
echo json_encode($m);
