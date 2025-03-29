<?php
include_once "create.php";

http_response_code(400);

$query = security('query');

$doc_query  = "SELECT * FROM doctor WHERE doctor_name LIKE '%$query%'  ";
$doctors    = select_rows($doc_query);
$m['doctors'] = $doctors;

$lab_query = "SELECT * FROM labs WHERE lab_name LIKE  '%$query%' LIMIT 5";
$labs = select_rows($lab_query);
$m['labs'] = $labs;

$shop_query = "SELECT * FROM product WHERE product_name LIKE  '%$query%' LIMIT 5";
$products = select_rows($shop_query);
$m['products'] = $products;

$m['data'] = true;

http_response_code(200);

echo json_encode($m);