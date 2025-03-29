<?php
require_once '../../path.php';
require_once MODEL_PATH . "operations.php";
$action = (isset($_GET['action']) && $_GET['action'] != '') ? security('action', 'GET') : '';

switch ($action) {
    case 'add':
        if (!csrf_verify(security('csrf_token'))) render_warning(base_url);
        if (isset($_POST['csrf_token'])) unset($_POST['csrf_token']);
        add_to_cart();
        break;
    case 'remove':
        remove_from_cart();
        break;
    case 'empty':
        empty_cart();
        break;
}

function add_to_cart()
{
    global $success;
    $success[]  = 208;

    $product_price = $_POST['cart_quantity'] * $_POST['current_price'];
    $full_price = $product_price;

    $product  = get_single_product($_POST['product_id']);

    $itemArray = array(
        $product["product_id"]  => array(
            'product_name'          => $product["product_name"],
            'product_image'         => $product["product_image"],
            'product_price'         => $_POST["current_price"],
            'product_total_price'   => $product_price,
            'product_description'   => $product["product_description"],
            'cart_quantity'         => $_POST["cart_quantity"],
            'cart_price'            => $full_price,
            'product_id'            => $product["product_id"]
        )
    );

    if (empty($_SESSION["cart"])) {
        $_SESSION["cart"] = $itemArray;
        header('location:' . $_POST['page']);
    }

    if (in_array($product, array_keys($_SESSION["cart"]))) {
        foreach ($_SESSION["cart"] as $key => $value) {
            if (!empty($product['product_id'])) {
                if ($product["product_id"] == $key) {
                    if (empty($_SESSION["cart"][$key]["cart_quantity"])) {
                        $_SESSION["cart"][$key]["cart_quantity"] = 0;
                    }
                    $_SESSION["cart"][$key]["cart_quantity"] += security("cart_quantity");
                    echo security("cart_quantity");
                }
            }
        }
    }

    $_SESSION["cart"] = array_merge($_SESSION["cart"], $itemArray);
    
    render_success($_POST['page']);
}

function remove_from_cart()
{
    global $success;
    $success[]  = 209;

    if (!empty($_SESSION["cart"]) && (count($_SESSION["cart"]) > 1)) {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($_GET['id'] == $key) unset($_SESSION["cart"][$key]);
            if (empty($_SESSION["cart"])) unset($_SESSION["cart"]);
        }
    } else {
        $_SESSION["cart"] = array();
    }
    
    render_success(base_url . 'cart');
}

function empty_cart()
{
    global $success;
    $success[]  = 210;

    $_SESSION["cart"] = array();
    render_success(base_url . 'cart');
}
