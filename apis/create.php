<?php
require_once '../path.php';
require_once MODEL_PATH . "operations.php";

function create_id($table, $id)
{
    $date_today = date('Ymd');
    $table_prifix = array(
        'address'           => 'ADD' . $date_today,
        'admin'             => 'ADM' . $date_today,
        'banner'            => 'BNR' . $date_today,
        'brand'             => 'BRD' . $date_today,
        'company'           => 'CMP' . $date_today,
        'category'          => 'CAT' . $date_today,
        'doctor'            => 'DOC' . $date_today,
        'doctor_move'       => 'DCM' . $date_today,
        'doc_category'      => 'DCC' . $date_today,
        'inquiry'           => 'INQ' . $date_today,
        'lab'               => 'LAB' . $date_today,
        'lab_payment'       => 'LBP' . $date_today,
        'medication'        => 'MED' . $date_today,
        'orders'            => 'ORD' . $date_today,
        'lab_orders'        => 'ORD' . $date_today,
        'product'           => 'PRD' . $date_today,
        'product_image'     => 'IMG' . $date_today,
        'session'           => 'SES' . $date_today,
        'statistic'         => 'STT' . $date_today,
        'subcategory'       => 'SUB' . $date_today,
        'subscription'      => 'SUB' . $date_today,
        'sub_orders'        => 'SUB' . $date_today,
        'lab_sub_orders'    => 'SUB' . $date_today,
        'tag'               => 'TAG' . $date_today,
        'unit'              => 'UNT' . $date_today,
        'prescription'      => 'PRE' . $date_today,
        'user'              => 'USR' . $date_today,
        'upload'            => 'UPD' . $date_today,
        'voucher'           => 'VOC' . $date_today,
        'forum'             => 'FOR' . $date_today,
        'comment'           => 'COM' . $date_today,
        'pharmacy_prescription' => 'PHA' . $date_today,
        'cart'              => 'CART' . $date_today,
        'events'            => 'EVE' . $date_today,
        'lab_suborder'      => 'LSO' . $date_today,
        'lab_cart'          => 'CART' . $date_today,
        'calendar_info'     => 'CIF' . $date_today
    );

    $random_str = $table_prifix[$table] . rand_str();
    $get_id     = get_ids($table, $id, $random_str);

    while ($get_id == true) {
        $random_str = $table_prifix[$table] . rand_str();
        $get_id     = get_ids($table, $id, $random_str);
    }
    return $random_str;
}

function addEvent($data)
{

    $doctor = $data["doctor"];
    $user = $data["user"];
    $title = "Video Session Meet With Doctor " . $doctor["doctor_name"];
    $description = 'Meeting between Client ' . ucwords($user["user_name"]) . ' and Doctor ' . ucwords($doctor["doctor_name"]);
    $location = 'Virtual';


    $date = $data['date'];
    $time_from = $data['start'];
    $time_to = $data['end'];

    $values = array(
        'event_id' => create_id('events', 'event_id'),
        'user_id' => $user["user_id"],
        'title' => $title,
        'description' => $description,
        'location' => $location,
        'date' => $date,
        'time_from' => $time_from,
        'time_to' => $time_to,
        'created' => date('Y-m-d H:i:s')
    );


    $buildEvent = build_sql_insert('events', $values);


    if ($buildEvent === true) {
        return ["success" => true, "data" => $values];
    } else {
        $statusMsg = 'Something went wrong, please try again after some time.';
    }


    return $statusMsg;
}

