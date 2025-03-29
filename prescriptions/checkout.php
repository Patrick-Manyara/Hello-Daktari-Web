<?php
include_once "../path.php";
include_once "create.php";
require_once MODEL_PATH . "operations.php";



if (isset($_POST['cart_data'])) {

    $cart_data  = json_decode($_POST['cart_data'], true);
    $user_id    = security('user_id');
    $order_id   = create_id('orders', 'orders_id');

    if (isset($_POST['address_id'])) {
        $address_id = security('address_id');
    } else {
        $address_id         = create_id('address', 'address_id');
        $address_label      = security('address_label');
        $address_location   = security('address_location');
        $address_name       = security('address_name');
        $address_phone      = security('address_phone');

        $arr = array(
            'address_label'     => $address_label,
            'address_location'  => $address_location,
            'address_name'      => $address_name,
            'address_phone'     => $address_phone,
            'address_id'        => $address_id,
            'user_id'           => $user_id
        );

        if (!build_sql_insert('address', $arr)) {
            $response['message'] = "Something went wrong";
        }
    }

    //FOR TABLE ORDERS
    $order['order_code']      = 'HELLO-' . generateRandomString();

    //FOR TABLE SUBORDERS

    foreach ($cart_data as &$item) {
        $quantity = $item['quantity'];
        $product_price = floatval($item['product']['product_price']); // Convert product_price to a float
        $total = $quantity * $product_price;
        $item['total'] = $total;

        $suborder['id']             = create_id('sub_orders', 'id');
        $suborder['order_id']       = $order_id;
        $suborder['product_id']     = $item['product']['product_id'];
        $suborder['quantity']       = $quantity;
        $suborder['total_price']    = $total;
        $suborder['user_id']        = $user_id;


        // Add the total for this item to the total for the whole cart
        $totalForWholeCart += $total;
        if (!build_sql_insert('sub_orders', $suborder)) {
            $response['message'] = "Could not upload";
        }
    }

    $order['order_amount'] = $totalForWholeCart;
    $order['payment_method'] = security('payment_method');
    $order['user_id'] = $user_id;
    $order['address_id'] = $address_id;
    $order['orders_id'] = $order_id;
    

    if (!build_sql_insert('orders', $order)) {
        $response['message'] = "Could not uploads";
    }


    http_response_code(200);
    $response['data'] = "success";

    echo json_encode($response);
} else {

    http_response_code(400);
    $response = array(
        'status' => 1,
        'message' => 'Missing cart_data'
    );

    echo json_encode($response);
}
