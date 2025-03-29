<?php
include_once "../path.php";
include_once "create.php";

http_response_code(403);
$type = security('type');
if ($type == 'user') {
    $table = 'user';
    $column = 'user_email';
    $row_col = 'user_password';
    $password = $_POST['password'];
} else {
    $table = 'doctor';
    $column = 'doctor_email';
    $row_col = 'doctor_password';
    $password = $_POST['password'];
}
$email = security('email');
$sql = "select * from $table where $column = '$email' ";
$row = select_rows($sql);
$m['post'] = $_POST;

if (!empty($row)) {
    $row = $row[0];

    foreach ($row as $key => $value) {
        if ($value === null) {
            $row[$key] = ''; 
        }
    }

    $m['status'] = 0;
    if ($type == 'user') {
        $row_col = $row['user_password'];
    } else {
        $row_col = $row['doctor_password'];
    }
    $m['query'] = $row_col;
    $m['query2'] = $password;
    if (!password_hashing_hybrid_maker_checker($password, $row_col)) {
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
