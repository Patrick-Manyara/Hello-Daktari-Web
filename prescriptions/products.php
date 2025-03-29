<?php
include_once "../path.php";
include_once "create.php";
require_once MODEL_PATH . "operations.php";

$action = $_GET['action'];

http_response_code(400);

switch ($action) {
    case 'all':
        $m = get_api_products();
        break;
    case 'single':
        get_single_productsss();
        break;
    case 'categories':
        $m = get_api_categories();
        break;
    case 'product_by_category':
        $m = get_api_products_by_category($_GET['cat_id']);
        break;
}

function get_api_products()
{
    $sql = "SELECT product.*, category.category_name FROM product JOIN category on product.category_id = category.category_id ORDER BY product.product_date_created ASC LIMIT 24";
    $row = select_rows($sql);
    
    if(!empty($row)){
        $m['status'] = 1;
        $m['products'] = $row;
    }else{
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function get_api_categories()
{
    $sql = "SELECT * FROM category";
    $row = select_rows($sql);
    
    if(!empty($row)){
        $m['status'] = 1;
        $m['categories'] = $row;
    }else{
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function get_api_products_by_category($id)
{
    $sql = "SELECT * FROM product WHERE category_id = '$id' ORDER BY product_date_created ASC LIMIT 6";
    $row = select_rows($sql);
    
    if(!empty($row)){
        $m['status'] = 1;
        $m['products'] = $row;
    }else{
        $m['message'] = "Something went wrong";
    }
    return $m;
}

http_response_code(200);

echo json_encode($m);