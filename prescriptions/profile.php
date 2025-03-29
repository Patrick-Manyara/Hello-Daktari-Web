<?php
include_once "../path.php";
include_once "create.php";
require_once MODEL_PATH . "operations.php";

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
    $m['data'] = $_POST;
    return $m;
}

function api_get_orders()
{
    $sql = "SELECT orders.*, sub_orders.*, product.product_name, product.product_image";
    $sql .= " FROM orders JOIN sub_orders ON orders.orders_id = sub_orders.order_id ";
    $sql .= " JOIN product ON sub_orders.product_id = product.product_id WHERE orders.user_id = '$_GET[user_id]'";
    $row = select_rows($sql);
    if(!empty($row)){
        $m['orders'] = $row;
        
    }
    $m['sql'] = $sql;
    return $m;
}

http_response_code(200);
$m['status'] = 1;
echo json_encode($m);