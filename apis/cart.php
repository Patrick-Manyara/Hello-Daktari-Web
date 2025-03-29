<?php
include_once "create.php";


$action = $_GET['action'];

http_response_code(400);

switch ($action) {
    case 'add':
        $m = api_add_to_cart();
        break;
    case 'fetch':
        $m = api_fetch_cart();
        break;
    case 'remove':
        $m = api_remove_cart_product();
        break;
    case 'empty':
        $m = api_empty_cart();
        break;
    case 'confirm':
        $m = api_confirm_cart();
        break;
    case 'lab_add':
        $m = api_add_to_labcart();
        break;
    case 'lab_fetch':
        $m = api_fetch_labcart();
        break;
    case 'lab_remove':
        $m = api_remove_labcart();
        break;
    case 'lab_confirm':
        $m = api_lab_confirm_cart();
        break;
    case 'lab_empty':
        $m = api_lab_empty_cart();
        break;
}
//PRODUCTS

function api_add_to_cart()
{
    $productJson    = $_POST['product'];
    $product        = json_decode($productJson, true);
    $pid            = $product['product_id'];
    $uid            = security('user');
    $qty            =  security('quantity');
    $cart_price     = $product['product_price'] * $qty;

    $sql1 = "SELECT * FROM cart WHERE user_id = '$uid' AND cart_approved = 'no' ";
    $row1  = select_rows($sql1)[0];

    if (empty($row1)) {
        $code = 'CART-' . generateRandomString('5');
    } else {
        $code = $row1['cart_code'];
    }



    $sql  = "SELECT * FROM cart WHERE product_id = '$pid' AND user_id = '$uid' AND cart_approved = 'no' ";
    $row  = select_rows($sql)[0];

    if (empty($row)) {
        $id = create_id('cart', 'cart_id');

        $arr = array(
            'cart_id'           => $id,
            'cart_code'         => $code,
            'product_id'        => $pid,
            'product_price'     => $product['product_price'],
            'cart_quantity'     => $qty,
            'cart_price'        => $cart_price,
            'user_id'           => $uid,
            'cart_approved'     => 'yes'
        );


        if (!build_sql_insert('cart', $arr)) {
            $m['message']   = "Something went wrong";
            $m['data']      = false;
        }
    } else {
        $arr = array(
            'cart_quantity'     => $qty,
            'cart_price'        => $cart_price,
        );

        if (!build_sql_edit('cart', $arr, $row['cart_id'], 'cart_id')) {
            $m['message']   = "Something went wrong";
            $m['data']      = false;
        }
    }

    $m['data']      = true;
    return $m;
}

function api_fetch_cart()
{

    $sql = "SELECT cart.*,product.product_name, product.product_price, product.product_image FROM cart JOIN product on cart.product_id = product.product_id WHERE cart.user_id = '$_GET[user_id]' ";
    $sql .= isset($_GET['approved']) ? " AND cart_approved = 'yes' " : " ";
    $sql .= " ORDER BY cart_date_created DESC";

    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status']    = 1;
        $m['products']  = $row;
    } else {
        $m['message']   = "Something went wrong";
    }
    return $m;
}

function api_remove_cart_product()
{
    $product_id = security('product_id');
    $user_id    = security('user_id');

    $sql        = "SELECT * FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id' AND cart_approved = 'no'  ";
    $row        = select_rows($sql)[0];

    if (!delete('cart', 'cart_id', $row['cart_id'])) {
        $m['message'] = "Something went wrong";
    }
    $m['data']      = true;
    return $m;
}

function api_empty_cart()
{
    $user_id    = security('user_id');

    $sql    = "SELECT * FROM cart WHERE user_id = '$user_id' AND cart_approved = 'no'  ";
    $rows   = select_rows($sql);

    if (!empty($rows)) {
        foreach ($rows as $row) {
            delete('cart', 'cart_id', $row['cart_id']);
        }
    }

    $m['data']      = true;
    return $m;
}

function api_confirm_cart()
{
    $uid    = security('user_id');

    $user   = get_by_id('user', $uid);

    $name       = APP_NAME;
    $subject    = APP_NAME . " Pharmacy Prescription";
    //EMAIL USER
    $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
    $body       .= 'Thank you for your recent order on our app. We have received your prescription or product selection and are currently reviewing it for approval.  <br>';
    $body       .= 'Please note that some of the items you have selected require a prescription and cannot be sold over-the-counter. Our admin team will review your order and approve it shortly.  <br>';
    $body       .= 'We appreciate your patience and will notify you once your order has been approved.  <br>';
    $body       .= '</p>';
    $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';

    //EMAIL ADMIN
    $body2      = '<p style="font-family:Poppins, sans-serif; ">A user has uploaded a pharmacy prescription on Hello Daktari.  <br>';
    $body2      .= ' <b>SERVICE: </b>Pharmacy <br> ';
    $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
    $body2      .= ' <br> ';
    $body2      .= ' <br> ';
    $body2      .= ' <b>Process for Admin: </b> <br> ';
    $body2      .= '1. Log into cooperate_url. <br> ';
    $body2      .= '2. Use credentials: <br> ';
    $body2      .= '   - Email: dashboard@hellodaktari.com <br> ';
    $body2      .= '   - Password: 1234 <br> ';
    $body2      .= '3. Go to the sidebar shop request and view the request .<br> ';
    $body2      .= '4. Approve the products. <br> ';
    $body2      .= ' <br> ';
    $body2      .= 'An email will be sent to the user upon approval. <br> ';
    $body2      .= '</p>';

    email($user['user_email'], $subject, $name, $body);
    email('draukaoyieko@gmail.com', $subject, $name, $body2);


    $m['data']      = true;
    return $m;
}


//LAB
function api_add_to_labcart()
{
    $labJson        = $_POST['lab'];
    $lab            = json_decode($labJson, true);
    $lid            = $lab['lab_id'];
    $uid            = security('user');
    $cart_price     = $lab['lab_price'];

    $sql1 = "SELECT * FROM cart WHERE user_id = '$uid' AND cart_approved = 'no' ";
    $row1  = select_rows($sql1)[0];

    if (empty($row1)) {
        $code = 'CART-' . generateRandomString('5');
    } else {
        $code = $row1['cart_code'];
    }

    $sql  = "SELECT * FROM lab_cart WHERE lab_id = '$lid' AND user_id = '$uid' AND cart_approved = 'no' ";
    $row  = select_rows($sql)[0];

    if (empty($row)) {
        $id = create_id('lab_cart', 'lab_cart_id');

        $arr = array(
            'lab_cart_id'   => $id,
            'cart_code'     => $code,
            'lab_id'        => $lid,
            'lab_price'     => $lab['lab_price'],
            'cart_price'    => $cart_price,
            'user_id'       => $uid,
            'cart_approved' => 'yes'
        );

        if (!build_sql_insert('lab_cart', $arr)) {
            $m['message']   = "Something went wrong";
            $m['data']      = false;
        }
    } else {
        $m['data']      = true;
    }


    $m['data']      = true;
    return $m;
}

function api_fetch_labcart()
{
    $sql = "SELECT * FROM lab_cart JOIN labs on lab_cart.lab_id = labs.lab_id WHERE lab_cart.user_id = '$_GET[user_id]' ";
    $sql .= isset($_GET['approved']) ? " AND cart_approved = 'yes' " : " ";
    $sql .= " ORDER BY lab_cart_date_created DESC";

    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status']    = 1;
        $m['products']  = $row;
    } else {
        $m['message']   = "Something went wrong";
    }
    return $m;
}

function api_remove_labcart()
{
    $lab_id     = security('lab_id');
    $user_id    = security('user_id');

    $sql        = "SELECT * FROM lab_cart WHERE lab_id = '$lab_id' AND user_id = '$user_id' AND cart_approved = 'no'  ";
    $row        = select_rows($sql)[0];

    if (!delete('lab_cart', 'lab_cart_id', $row['lab_cart_id'])) {
        $m['message'] = "Something went wrong";
    }
    $m['data']      = true;
    return $m;
}


function api_lab_empty_cart()
{
    $user_id    = security('user_id');

    $sql    = "SELECT * FROM lab_cart WHERE user_id = '$user_id' AND cart_approved = 'no'  ";
    $rows   = select_rows($sql);

    if (!empty($rows)) {
        foreach ($rows as $row) {
            delete('lab_cart', 'lab_cart_id', $row['lab_cart_id']);
        }
    }

    $m['data']      = true;
    return $m;
}

function api_lab_confirm_cart()
{
    $uid    = security('user_id');

    $user   = get_by_id('user', $uid);

    $name       = APP_NAME;
    $subject    = APP_NAME . " Lab Test Request";
    //EMAIL USER
    $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
    $body       .= 'Thank you for your recent order on our app. We have received your prescription or product selection and are currently reviewing it for approval.  <br>';
    $body       .= 'Please note that some of the items you have selected require a prescription and cannot be sold over-the-counter. Our admin team will review your order and approve it shortly.  <br>';
    $body       .= 'We appreciate your patience and will notify you once your order has been approved.  <br>';
    $body       .= '</p>';
    $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';

    //EMAIL ADMIN
    $body2      = '<p style="font-family:Poppins, sans-serif; ">A user has uploaded a pharmacy prescription on Hello Daktari.  <br>';
    $body2      .= ' <b>SERVICE: </b>Pharmacy <br> ';
    $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
    $body2      .= '</p>';

    email($user['user_email'], $subject, $name, $body);
    email('michael1998march@gmail.com', $subject, $name, $body2);

    $m['data']      = true;
    return $m;
}

http_response_code(200);

echo json_encode($m);
