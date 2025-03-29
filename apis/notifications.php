<?php
include_once "../path.php";
include_once "create.php";

$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'all':
        $m = get_api_notification();
        break;
    // case 'update':
    //     $m = update_api_addresses();
    //     break;
    // case 'add':
    //     $m = add_api_addresses();
    //     break;
    // case 'delete':
    //     $m = delete_api_address();
    //     break;
}

function get_api_notification()
{
    $sql = "SELECT * FROM notification WHERE user_id = '$_GET[user_id]' ";
    $row = select_rows($sql);
    
    $num = 1;

    $m['status'] = 1;
    $m['notifs'] = $row;
    $m['num'] = $num;
    
    return $m;
}



http_response_code(200);

echo json_encode($m);
