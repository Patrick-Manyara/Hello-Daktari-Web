<?php
include_once "../path.php";
include_once "create.php";
require_once MODEL_PATH . "operations.php";

include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'auto':
        $m = create_api_auto_sessions();
        break;
    case 'manual':
        $m = create_api_manual_session();
        break;
    case 'update':
        $m = update_api_session();
        break;
    case 'complete':
        $m = complete_api_session();
        break;
}

function create_api_auto_sessions()
{
    $m['data'] = $_POST;
    return $m;
}

function create_api_manual_session()
{
    $id             = create_id('session', 'session_id');
    $code           = 'SESS-' . generateRandomString('5');
    $prescription   = security('prescription');
    $records        = security('records');
    $visitType      = security('visitTpe');
    $user_id        = security('user_id');

    if (!empty($_FILES['prescription']['name'])) $prescription   = upload_docs('prescription');
    if (!empty($_FILES['records']['name'])) $records             = upload_docs('records');



    if ($visitType   == 'online') {
        $mode    = 'virtual';
    } else {
        $mode    = 'live';
    }


    $arr = array(
        'session_id' => $id,
        'session_code' => $code,
        'session_prescription' => $prescription,
        'session_records' => $records,
        'client_id' => $user_id,
        'session_visit' => $visitType,
        'session_mode' => $mode,
    );



    if (!build_sql_insert('session', $arr)) {
        $m['message'] = "Something went wrong";
    }

    $sql        = "SELECT * FROM doctor WHERE doctor_status = 'active' ORDER BY rand()";
    $doctors    = select_rows($sql);

    $m['session_data'] = $arr;
    $m['doctors'] = $doctors;
    return $m;
}

function update_api_session()
{
    $date = security('date');
    $start_time = security('start_time');
    $end_time = security('end_time');
    $id = security('session');
    $doc_id = security('doctor');
    $channel = security('channel');

    $sql = "SELECT * FROM session WHERE session_id = '$id'";
    $row = select_rows($sql);
    if (!empty($row)) {
        $row        = $row[0];
        $user_id    = $row['client_id'];
    }


    $arr2['doctor_id'] = $doc_id;
    build_sql_edit('user', $arr2, $user_id, 'user_id');


    $arr = array(
        'session_date' => $date,
        'session_start_time' => $start_time,
        'session_end_time' => $end_time,
        'session_channel' => $channel,
        'doctor_id' => $doc_id
    );


    if (!build_sql_edit('session', $arr, $id, 'session_id')) {
        $m['message'] = "Something went wrong";
    }

    $sql2 = "SELECT * FROM session WHERE session_id = '$id'";
    $row2 = select_rows($sql2);

    if (!empty($row2)) {
        $row2        = $row2[0];

        $user       = get_by_id('user', $row2['client_id']);
        $doctor     = get_by_id('doctor', $row2['doctor_id']);

        if ($channel == 'video') {
            $uploadData["doctor"] = $doctor;
            $uploadData["user"] = $user;

            $uploadData["start"] = $row2['session_start_time'];
            $uploadData["date"] = $row2['session_date'];
            $uploadData["end"] = $row2['session_end_time'];

            $response = addEvent($uploadData);

            if (isset($response["success"])) {
                $m["last_event_id"] = $response["data"]["event_id"];
            } else {
                $error['session'] = 133;
                error_checker($return_url);
            }
        }
    }
    return $m;
}

function complete_api_session()
{
    $id         = security('session_id');
    $address    = security('address');

    $arr = array(
        'session_payment_status'    => 'paid',
        'address_id'                => $address
    );


    if (!build_sql_edit('session', $arr, $id, 'session_id')) {
        $m['message'] = "Something went wrong";
    }
    return $m;
}


http_response_code(200);
$m['status'] = 1;
echo json_encode($m);
