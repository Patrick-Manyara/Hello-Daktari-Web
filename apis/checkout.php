<?php
include_once "../path.php";
include_once "create.php";
include_once "email.php";

$action = $_GET['action'];

http_response_code(400);

switch ($action) {
    case 'cart':
        $response = api_checkout_cart();
        break;
    case 'lab':
        $response = api_checkout_lab();
        break;
}

// Send the response as JSON
header('Content-Type: application/json');


function api_checkout_cart()
{
    $response = array();

    if (isset($_POST['user_id'])) {
        $uid = security('user_id');

        $sql = "SELECT cart.*,product.product_name, product.product_price, product.product_image 
                FROM cart 
                JOIN product on cart.product_id = product.product_id 
                WHERE cart.user_id = '$uid' 
                AND cart_approved = 'yes'  
                ORDER BY cart_date_created DESC";

        $row = select_rows($sql);

        $cart_data  = $row;
        $order_id   = create_id('orders', 'orders_id');

        if (isset($_POST['address_id'])) {
            $address_id = security('address_id');
        } else {
            $address_id = create_id('address', 'address_id');
            $address_label = security('address_label');
            $address_location = security('address_location');
            $address_name = security('address_name');
            $address_phone = security('address_phone');

            $arr = array(
                'address_label' => $address_label,
                'address_location' => $address_location,
                'address_name' => $address_name,
                'address_phone' => $address_phone,
                'address_id' => $address_id,
                'user_id' => $uid
            );

            if (!build_sql_insert('address', $arr)) {
                $response['message'] = "Something went wrong";
                http_response_code(400);
                return $response;
            }
        }

        // FOR TABLE ORDERS
        $order['order_code'] = 'HELLO-' . generateRandomString();

        // FOR TABLE SUBORDERS
        $totalForWholeCart = 0;
        foreach ($cart_data as $item) {
            $quantity = $item['cart_quantity'];
            $product_price = $item['product_price'];
            $total = $item['cart_price'];
            $pid = $item['product_id'];

            $suborder = array(
                'id' => create_id('sub_orders', 'id'),
                'order_id' => $order_id,
                'product_id' => $pid,
                'quantity' => $quantity,
                'total_price' => $total,
                'user_id' => $uid
            );

            // Add the total for this item to the total for the whole cart
            $totalForWholeCart += $item['cart_price'];
            if (!build_sql_insert('sub_orders', $suborder)) {
                $response['message'] = "Could not upload";
                http_response_code(400);
                return $response;
            }
        }

        $order['order_amount'] = $totalForWholeCart;
        $order['payment_method'] = 'JamboPay';
        $order['user_id'] = $uid;
        $order['address_id'] = $address_id;
        $order['orders_id'] = $order_id;

        if (!build_sql_insert('orders', $order)) {
            $response['message'] = "Could not uploads";
            http_response_code(400);
            return $response;
        }

        $body = '<p style="font-family:Poppins, sans-serif;">';
        $body .= 'New order on ' . APP_NAME;
        $body .= '';
        $body .= '</p>';
        $body .= checkoutEmail($cart_data);

        $subject = APP_NAME . ' Order';
        $name = APP_NAME;

        $email = get_by_id('user', $uid)['user_email'];

        email($email, $subject, $name, $body);

        http_response_code(200);
        $response['data'] = "success";
    } else {
        http_response_code(400);
        $response = array(
            'status' => 1,
            'message' => 'Missing cart_data'
        );
    }

    return $response;
}



function api_checkout_lab()
{
    $response = array();

    if (isset($_POST['user_id'])) {
        $uid = security('user_id');

        $sql = "SELECT lab_cart.*,labs.lab_name, labs.lab_price 
                FROM lab_cart 
                JOIN labs on lab_cart.lab_id = labs.lab_id 
                WHERE lab_cart.user_id = '$uid' 
                AND cart_approved = 'yes'  
                ORDER BY lab_cart_date_created DESC";

        $row = select_rows($sql);

        $cart_data  = $row;
        $order_id   = create_id('lab_orders', 'orders_id');

        if (isset($_POST['address_id'])) {
            $address_id = security('address_id');
        } else {
            $address_id = create_id('address', 'address_id');
            $address_label = security('address_label');
            $address_location = security('address_location');
            $address_name = security('address_name');
            $address_phone = security('address_phone');

            $arr = array(
                'address_label' => $address_label,
                'address_location' => $address_location,
                'address_name' => $address_name,
                'address_phone' => $address_phone,
                'address_id' => $address_id,
                'user_id' => $uid
            );

            if (!build_sql_insert('address', $arr)) {
                $response['message'] = "Something went wrong";
                http_response_code(400);
                return $response;
            }
        }

        // FOR TABLE ORDERS
        $order['order_code'] = 'HELLO-' . generateRandomString();

        // FOR TABLE SUBORDERS
        $totalForWholeCart = 0;
        foreach ($cart_data as $item) {
            $quantity = $item['cart_quantity'];
            $lab_price = $item['lab_price'];
            $total = $item['cart_price'];
            $lid = $item['lab_id'];

            $suborder = array(
                'id' => create_id('lab_sub_orders', 'id'),
                'order_id' => $order_id,
                'lab_id' => $lid,
                'total_price' => $total,
                'user_id' => $uid
            );

            // Add the total for this item to the total for the whole cart
            $totalForWholeCart += $item['cart_price'];
            if (!build_sql_insert('lab_sub_orders', $suborder)) {
                $response['message'] = "Could not upload";
                http_response_code(400);
                return $response;
            }
        }

        $order['order_amount'] = $totalForWholeCart;
        $order['payment_method'] = 'JamboPay';
        $order['user_id'] = $uid;
        $order['address_id'] = $address_id;
        $order['orders_id'] = $order_id;

        if (!build_sql_insert('lab_orders', $order)) {
            $response['message'] = "Could not uploads";
            http_response_code(400);
            return $response;
        }

        $body = '<p style="font-family:Poppins, sans-serif;">';
        $body .= 'New order on ' . APP_NAME;
        $body .= '';
        $body .= '</p>';
        $body .= checkoutEmail($cart_data, 'no');

        $subject = APP_NAME . ' Order';
        $name = APP_NAME;

        $email = get_by_id('user', $uid)['user_email'];

        email($email, $subject, $name, $body);

        http_response_code(200);
        $response['data'] = "success";
    } else {
        http_response_code(400);
        $response = array(
            'status' => 1,
            'message' => 'Missing cart_data'
        );
    }

    return $response;
}
http_response_code(200);
$response['status'] = 1;
echo json_encode($response);