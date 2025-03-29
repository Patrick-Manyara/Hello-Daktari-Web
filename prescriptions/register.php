<?php
include_once "../path.php";
require_once MODEL_PATH . "operations.php";

http_response_code(403);
$m['post'] = $_POST;

$id             = create_id('user', 'user_id');
$user_name      = security('user_name');
$user_email     = security('user_email');
$user_phone     = security('user_phone');
$user_password  = security('user_password');
$password       = password_hashing_hybrid_maker_checker($user_password);

$sql = "SELECT * FROM user WHERE user_email ='$user_email' ";
$row = select_rows($sql);

if (!empty($row)) {
    $m['message'] = "User Already Exists";
} else {
    $m['status'] = 0;
    $arr = array(
        'user_id' => $id,
        'user_name' => $user_name,
        'user_email' => $user_email,
        'user_phone' => $user_phone,
        'user_password' => $password
    );

    if (!build_sql_insert('user', $arr)) {
        $m['message'] = "Something went wrong";
    }

    $m['status'] = 1;
    $m['data'] = $arr;
    http_response_code(200);

    // Send an email to the user
    $subject = APP_NAME . ' Account Creation';
    $name = APP_NAME;
    $body = '<p style="font-family:Poppins, sans-serif;"> ';
    $body .= 'Hello, <b> ' . $user_name . ' </b> <br>';
    $body .= 'Your account has been successfully created.';
    $body .= '<br>';
    $body .= 'You may log in to your account in the future with these credentials';
    $body .= '<br>';
    $body .= '<b>EMAIL:</b> ' . $user_email . ' <br>';
    $body .= '<br>';
    $body .= '<b>PASSWORD:</b> ' . security('user_password') . ' <br>';
    $body .= '<br>';

    email($user_email, $subject, $name, $body);
}


echo json_encode($m);

function create_id($table, $id)
{
    $date_today = date('Ymd');
    $table_prifix = array(
        'address'           => 'ADD' . $date_today,
        'admin'             => 'ADM' . $date_today,
        'banner'            => 'BNR' . $date_today,
        'brand'             => 'BRD' . $date_today,
        'company'           => 'CMP' . $date_today,
        'category'          => 'CAT' . $date_today,
        'doctor'            => 'DOC' . $date_today,
        'doctor_move'       => 'DCM' . $date_today,
        'doc_category'      => 'DCC' . $date_today,
        'inquiry'           => 'INQ' . $date_today,
        'lab'               => 'LAB' . $date_today,
        'lab_payment'       => 'LBP' . $date_today,
        'medication'        => 'MED' . $date_today,
        'orders'            => 'ORD' . $date_today,
        'product'           => 'PRD' . $date_today,
        'product_image'     => 'IMG' . $date_today,
        'session'           => 'SES' . $date_today,
        'statistic'         => 'STT' . $date_today,
        'subcategory'       => 'SUB' . $date_today,
        'subscription'      => 'SUB' . $date_today,
        'sub_orders'        => 'SUB' . $date_today,
        'tag'               => 'TAG' . $date_today,
        'unit'              => 'UNT' . $date_today,
        'prescription'      => 'PRE' . $date_today,
        'user'              => 'USR' . $date_today,
        'upload'            => 'UPD' . $date_today,
        'voucher'           => 'VOC' . $date_today,
        'events'            => 'EVE' . $date_today
    );

    $random_str = $table_prifix[$table] . rand_str();
    $get_id     = get_ids($table, $id, $random_str);

    while ($get_id == true) {
        $random_str = $table_prifix[$table] . rand_str();
        $get_id     = get_ids($table, $id, $random_str);
    }
    return $random_str;
}
