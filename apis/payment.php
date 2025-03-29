<?php
include_once "../path.php";
include_once "create.php";


include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';

$id         = security('table_id');
$from       = security('from');
$user_id    = security('user_id');

if ($from == 'records') {
    $table  = 'upload';
    $status = 'upload_payment_status';
    $column = 'upload_id';
    $method = 'payment_method';

    $arr = array(
        $method     => security('payment_method'),
        $status     => 'paid'
    );

    if (!build_sql_edit($table, $arr, $id, $column)) {
        $m['message'] = 'failed';
    }

    $name       = APP_NAME;
    $subject    = APP_NAME . " Medical Records";


    $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
    $body       .= 'Your documents have been successfully stored.  <br>';
    $body       .= ' <b>SERVICE: </b> Medical Records Storage <br> ';
    $body       .= ' <b>PAYMENT ID: </b> ' . $id . ' <br> ';

    if ($user['user_upload'] == 'yes') {
        $body       .= 'You had already paid for your subscription.';
    } else {
        $body       .= 'Your payment has also been received.';
    }


    $body       .= '</p>';
    $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';


    $body2      .= '<p style="font-family:Poppins, sans-serif; ">A documents have been successfully stored.  <br>';
    $body2      .= ' <b>SERVICE: </b> Medical Records Storage <br> ';
    $body2      .= ' <b>PAYMENT ID: </b> ' . $id . ' <br> ';
    $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
    $body2      .= '</p>';

    email($user['user_email'], $subject, $name, $body);
    email('pmanyara97@gmail.com', $subject, $name, $body2);
}

if ($from == 'lab') {
    $_POST;
    $m['message'] = "success";

    if (isset($_POST['labs'])) {
        $labsArray = json_decode($_POST['labs'], true);

        if ($labsArray !== null) {
            $_POST['labs']  = $labsArray;
            $order_id  = 'LABS-' . generateRandomString();
            foreach ($labsArray as $item) {
                $arr['suborder_id'] = create_id('lab_suborder', 'suborder_id');
                $arr['main_order_id'] = $order_id;
                $arr['main_order_amount'] += $item['lab_amount'];
                $arr['suborder_item_id'] = $item['lab_id'];
                $arr['suborder_payment_status'] = 'paid';
                $arr['suborder_payment_method'] = security('payment_method');
                if (!build_sql_insert('lab_suborder', $arr)) {
                    $m['message'] = "no";
                }
            }

            $user           = get_by_id('user', security('user_id'));
            $name       = APP_NAME;
            $subject    = APP_NAME . " Lab Services";


            $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
            $body       .= 'Your lab service has been successfully logged.  <br>';
            foreach ($labsArray as $item2) {
                $body       .= ' <b>SERVICE: </b> ' . $item2['lab_care_name'] . ' <br> ';
            }
            $body       .= ' <b>PAYMENT ID: </b> ' . security('payment_method') . ' <br> ';
            $body       .= '</p>';
            $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';


            $body2      .= '<p style="font-family:Poppins, sans-serif; ">A lab service has been successfully logged.  <br>';
            foreach ($labsArray as $item2) {
                $body2          .= ' <b>SERVICE: </b> ' . $item2['lab_care_name'] . ' <br> ';
            }
            $body2      .= ' <b>PAYMENT ID: </b> ' . security('payment_method') . ' <br> ';
            $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
            $body2      .= '</p>';

            email($user['user_email'], $subject, $name, $body);
            email('pmanyara97@gmail.com', $subject, $name, $body2);
        } else {
            $m['labs'] = "Error decoding labs JSON.";
        }
    } else {
        $m['labs'] = "Labs key not found in the post data.";
    }
}


$m['data'] = true;

http_response_code(200);
$m['status'] = 1;
echo json_encode($m);
