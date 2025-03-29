<?php
include_once "../path.php";
include_once "create.php";


include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'update':
        $m = api_update_user();
        break;
    case 'orders':
        $m = api_get_orders();
        break;
}

function api_update_user()
{
    $arr = array(
        'user_name'     => security('user_name'),
        'user_phone'    => security('user_phone'),
        'user_phone'    => security('user_phone'),
        'user_dob'      => security('user_dob'),
        'user_height'   => security('user_height'),
        'user_weight'   => security('user_weight'),
        'user_blood_group' => security('user_blood_group'),
        'user_id'       => security('user_id')
    );

    if (!empty($_FILES['user_image']['name']))    $arr['user_image']   = upload('user_image');
    if (!build_sql_edit('user', $arr, security('user_id'), 'user_id')) {
        $m['message'] = 'failed';
    }

    $id     = security('user_id');

    $sql    = "SELECT * FROM user WHERE user_id = '$id' ";
    $row    = select_rows($sql)[0];

    $m['token'] = $row;
    return $m;
}

function api_get_orders()
{
    $sql = "SELECT orders.*, sub_orders.*, product.product_name, product.product_image";
    $sql .= " FROM orders JOIN sub_orders ON orders.orders_id = sub_orders.order_id ";
    $sql .= " JOIN product ON sub_orders.product_id = product.product_id WHERE orders.user_id = '$_GET[user_id]'";
    $row = select_rows($sql);
    if (!empty($row)) {
        $m['orders'] = $row;
    }
    $m['sql'] = $sql;
    return $m;
}

http_response_code(200);
$m['status'] = 1;
echo json_encode($m);
