<?php
include_once "../path.php";
include_once "create.php";


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
    case 'upload':
        $m = upload_pharmacy_prescription();
        break;
}

function get_api_products()
{
    $sql = "SELECT product.*, category.category_name FROM product JOIN category on product.category_id = category.category_id ORDER BY RAND() ASC LIMIT 50";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['products'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function get_api_categories()
{
    $sql = "SELECT * FROM category";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['categories'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function upload_pharmacy_prescription()
{
    $id = create_id('pharmacy_prescription', 'pharmacy_prescription_id');
    $arr = array(
        'pharmacy_prescription_id'  => $id,
        'prescription_code'         => 'FILE-' . generateRandomString('5'),
        'user_id'                   => security('user_id')
    );
    
    if (!empty($_FILES['upload_file']['name'])) $arr['prescription_file']   = upload_docs('upload_file');
    if (!build_sql_insert('pharmacy_prescription', $arr)) {
        $m['message']   = "Something went wrong";
        $m['data']      = false;
    }
    
    $user = get_by_id('user', security('user_id'));

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
    $body2      .= ' <b>SERVICE: </b> Medical Records Storage <br> ';
    $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
    $body2      .= '</p>';

    email($user['user_email'], $subject, $name, $body);
    email('michael1998march@gmail.com', $subject, $name, $body2);

    return $m;
}

http_response_code(200);

echo json_encode($m);
