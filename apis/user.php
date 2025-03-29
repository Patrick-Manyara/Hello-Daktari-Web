<?php
include_once "../path.php";
include_once "create.php";


include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'register':
        $m = api_user_register();
        break;
}

function api_user_register()
{
    global $arr;
    global $error;
    global $success;
    
    $id = create_id('user', 'user_id');
    $user_email = security('user_email');
    $user_password = security('user_password');
    $password = password_hashing_hybrid_maker_checker($user_password);

    for_loop();

    $sql = "SELECT * FROM user WHERE user_email ='$user_email' ";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 0;
        $m['message'] = "User Already Exists";
    } else {
        $arr['user_id'] = $id;
        $arr['user_password'] = $password;
        $arr['user_type'] = 'user';
        if (!build_sql_insert('user', $arr)) {
            $m['status'] = 0;
            $m['message'] = "Something went wrong";
        } else {
            $m['status'] = 1;
            $m['data'] = $arr;
            $m['message'] = "User registered successfully";
        }
    }

    return $m;
}

function for_loop()
{
    global $arr;

    foreach ($_POST as $key => $value) {
        $arr[$key] = security($key);
    }
}

http_response_code(200);
echo json_encode($m);
