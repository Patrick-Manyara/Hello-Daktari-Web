<?php
include_once "../path.php";
include_once "create.php";


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'all':
        $m = get_api_addresses();
        break;
    case 'update':
        $m = update_api_addresses();
        break;
    case 'add':
        $m = add_api_addresses();
        break;
    case 'delete':
        $m = delete_api_address();
        break;
}

function get_api_addresses()
{
    $sql = "SELECT * FROM address WHERE user_id = '$_GET[user_id]' ";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['addresses'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    $m['status'] = 1;
    return $m;
}

function update_api_addresses()
{
    $address_id         = security('address_id');
    $address_label      = security('address_label');
    $address_location   = security('address_location');
    $address_name       = security('address_name');
    $address_phone      = security('address_phone');


    $sql = "SELECT * FROM address WHERE address_id = '$address_id' ";
    $row = select_rows($sql);
    if (!empty($row)) {
        $row = $row[0];
        $arr = array(
            'address_label'     => $address_label,
            'address_location'  => $address_location,
            'address_name'      => $address_name,
            'address_phone'     => $address_phone
        );
        if (!build_sql_edit('address', $arr, $address_id, 'address_id')) {
            $m['message'] = "Something went wrong";
        }
        $m['status'] = 1;
    }
    $m['data'] = $_POST;
    return $m;
}

function add_api_addresses()
{
    $address_id         = create_id('address', 'address_id');
    $address_label      = security('address_label');
    $address_location   = security('address_location');
    $address_name       = security('address_name');
    $address_phone      = security('address_phone');
    $user_id            = security('user_id');

    $arr = array(
        'address_label'     => $address_label,
        'address_location'  => $address_location,
        'address_name'      => $address_name,
        'address_phone'     => $address_phone,
        'address_id'        => $address_id,
        'user_id'           => $user_id
    );

    if (!build_sql_insert('address', $arr)) {
        $m['message'] = "Something went wrong";
    }

    $m['data'] = $_POST;
    return $m;
}

function delete_api_address()
{
    $address_id = security('address_id');

    if (!delete('address', 'address_id', $address_id)) {
        $m['message'] = "Something went wrong";
    }

    $m['data'] = $_POST;
    return $m;
}

http_response_code(200);

echo json_encode($m);
