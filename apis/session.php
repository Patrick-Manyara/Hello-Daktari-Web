<?php
include_once "../path.php";
include_once "create.php";


include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'specialties':
        $m = get_api_auto_specialties();
        break;
    case 'auto':
        $m = create_api_auto_session();
        break;
    case 'manual':
        $m = create_api_manual_session();
        break;
    case 'rebook':
        $m = create_api_rebook_session();
        break;
    case 'home':
        $m = create_api_home_session();
        break;
    case 'house':
        $m = create_api_house_session();
        break;
    case 'update':
        $m = update_api_session();
        break;
    case 'complete':
        $m = complete_api_session();
        break;
    case 'all':
        $m = get_api_user_sessions();
        break;
    case 'docall':
        $m = get_api_doctor_sessions();
        break;
}

function get_api_auto_specialties()
{
    $sql = "SELECT dc.* FROM doc_category dc JOIN doctor d ON FIND_IN_SET(dc.doc_category_id, REPLACE(d.category_id, '|', ',')) > 0 GROUP BY dc.doc_category_id;";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['specialties'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function create_api_auto_session()
{
    $time = $_POST['time'];
    $time_parts = explode(' - ', $time);
    $clipped_time = $time_parts[0];


    $date = $_POST['date'];
    $dayName = date('D', strtotime($date));
    $shortDayName = strtolower($dayName);

    if (isset($_POST['channel'])) {
        $col = "doctor.doctor_" . security('channel');
        $channel = " AND $col = 'yes' ";
    }


    $sql = "SELECT weekly_schedule.*, calendar_info.tid FROM weekly_schedule join calendar_info ON calendar_info.id = weekly_schedule.calendar_info_id JOIN doctor ON calendar_info.tid = doctor.doctor_id ";
    $sql .= " WHERE weekly_schedule.start_time = '$clipped_time' AND weekly_schedule.day = '$shortDayName' " . $channel;
    $row = select_rows($sql);
    $m['sql'] = $sql;
    if (!empty($row)) {
        $allDoctorIds = array();

        // Create an array to store unique $item['tid'] values
        $uniqueTids = array();

        foreach ($row as $item) {
            $uniqueTids[$item['tid']] = true;
            $sst = $clipped_time . ":00";
            $sql2 = "SELECT doctor_id FROM session WHERE doctor_id = '$item[tid]' AND session_start_time != '$sst' AND session_date != '$date' AND session_payment_status != 'paid' ";
            $secondQueryResult = select_rows($sql2);

            // Store the doctor_id values in the $allDoctorIds array
            foreach ($secondQueryResult as $result) {
                $allDoctorIds[] = $result['doctor_id'];
            }
        }

        // Fetch doctors who may not have records in the session table
        // Iterate through unique $item['tid'] values and add them to $allDoctorIds if they don't exist
        foreach ($uniqueTids as $tid => $value) {
            if (!in_array($tid, $allDoctorIds)) {
                $allDoctorIds[] = $tid;
            }
        }

        // Check if there are any doctors in the $allDoctorIds array
        if (!empty($allDoctorIds)) {
            // Pick one doctor_id at random from the $allDoctorIds array
            $randomDoctorId = $allDoctorIds[array_rand($allDoctorIds)];
        }

        // Check if $randomDoctorId is not null before using it
        if ($randomDoctorId !== null) {
            $id             = create_id('session', 'session_id');
            $code           = 'SESS-' . generateRandomString('5');
            $visitType      = 'online';
            $channel        = security('channel');
            $user_id        = security('user_id');
            $mode           = 'virtual';
            $start_time     = $time_parts[0];
            $end_time       = $time_parts[1];

            $arr = array(
                'session_id'    => $id,
                'session_code'  => $code,
                'client_id'     => $user_id,
                'session_visit' => $visitType,
                'session_mode'  => $mode,
                'session_channel' => $channel,
                'doctor_id'     => $randomDoctorId,
                'session_date'  => $date,
                'session_start_time'    => $start_time . ":00",
                'session_end_time'      => $end_time . ":00",
                'session_consultation'  => 'general'
            );

            if (!build_sql_insert('session', $arr)) {
                $m['message'] = "Something went wrong";
            }

            $sql3 = "SELECT * FROM doctor WHERE doctor_id = '$randomDoctorId' ";
            $row3 = select_rows($sql3)[0];

            $m['data']          = true;
            $m['doctor']        = $row3;
            $m['session_data']  = $arr;
        } else {
            $m['message']       = 'No doctor found';
            $m['data']          = false;
        }
    } else {
        $m['message'] = 'No schedule found';
    }

    return $m;
}

function create_api_manual_session()
{
    $id             = create_id('session', 'session_id');
    $code           = 'SESS-' . generateRandomString('5');
    $visitType      = security('visitType');
    $user_id        = security('user_id');
    $specialty      = security('specialty');

    if ($visitType   == 'online') {
        $mode    = 'virtual';
    } else {
        $mode    = 'live';
    }

    if ($visitType   == 'home') {
        $channel    = 'home';
    } else {
        $channel    = security('channel');
    }




    $arr = array(
        'session_id' => $id,
        'session_code' => $code,
        'client_id' => $user_id,
        'session_visit' => $visitType,
        'session_mode' => $mode,
        'session_channel' => $channel,
        'session_consultation' => 'specialist'
    );



    if (!build_sql_insert('session', $arr)) {
        $m['message'] = "Something went wrong";
        $m['data'] = false;
    }

    $sql        = "SELECT * FROM doctor WHERE doctor_status = 'active' AND category_id LIKE '%$specialty%' ORDER BY RAND()";
    $doctors    = select_rows($sql);

    if (!empty($doctors)) {
        $m['session_data'] = $arr;
        $m['doctors'] = $doctors;
        $m['type'] = 'new';
    } else {
        $m['type'] = 'nothing';
    }

    return $m;
}

function create_api_rebook_session()
{
    $id             = create_id('session', 'session_id');
    $code           = 'SESS-' . generateRandomString('5');
    $visitType      = security('visitType');
    $user_id        = security('user_id');
    $channel        = security('channel');

    if ($visitType   == 'online') {
        $mode    = 'virtual';
    } else {
        $mode    = 'live';
    }

    if ($visitType   == 'home') {
        $channel    = 'home';
    } else {
        $channel    = security('channel');
    }



    $arr = array(
        'session_id' => $id,
        'session_code' => $code,
        'client_id' => $user_id,
        'session_visit' => $visitType,
        'session_mode' => $mode,
        'session_channel' => $channel,
        'session_consultation' => 'specialist'
    );



    if (!build_sql_insert('session', $arr)) {
        $m['message'] = "Something went wrong";
        $m['data'] = false;
    }

    $doc_id     = get_by_id('user', $user_id)['doctor_id'];

    $sql        = "SELECT * FROM doctor WHERE doctor_id = '$doc_id'";
    $doctor     = select_rows($sql);

    if (!empty($doctor)) {
        $doctor         = $doctor[0];
        $m['doctor']    = $doctor;
        $m['session_data'] = $arr;

        $m['type'] = 'rebook';
    }


    return $m;
}

function create_api_home_session()
{
    $id             = create_id('session', 'session_id');
    $code           = 'SESS-' . generateRandomString('5');
    $visitType      = 'home';
    $user_id        = security('user_id');
    $channel        = 'home';
    $specialty      = security('specialty');
    $urgency        = security('urgency');
    $mode           = 'live';

    $time = $_POST['time'];
    $time_parts = explode(' - ', $time);
    $clipped_time = $time_parts[0];
    $start_time     = $time_parts[0];
    $end_time       = $time_parts[1];

    $date = $_POST['date'];


    $arr = array(
        'session_id'    => $id,
        'session_code'  => $code,
        'client_id'     => $user_id,
        'session_visit' => $visitType,
        'session_mode'  => $mode,
        'session_channel' => $channel,
        'session_consultation' => 'specialist',
        'session_urgency' => $urgency,
        'session_date'  => $date,
        'session_start_time'    => $start_time . ":00",
        'session_end_time'      => $end_time . ":00",
    );


    if (!build_sql_insert('session', $arr)) {
        $m['message'] = "Something went wrong";
        $m['data'] = false;
    }

    $sql        = "SELECT * FROM doctor WHERE doctor_status = 'active' AND category_id = '$specialty' ORDER BY RAND()";
    $doctors    = select_rows($sql);

    $m['session_data']  = $arr;
    $m['doctors']       = $doctors;
    $m['data']          = true;
    return $m;
}

function create_api_house_session()
{
    $m['post'] = $_POST;

    $id             = create_id('session', 'session_id');
    $code           = 'SESS-' . generateRandomString('5');
    $visitType      = 'home';
    $user_id        = security('user_id');
    $channel        = 'home';
    $urgency        = security('urgency');
    $mode           = 'live';
    $address        = security('address');
    $search         = security('search');
    $user           = get_by_id('user', $user_id);


    if ($urgency == 'urgent') {
        $session_date   = date("Y-m-d"); // Set $session_date to the current date in "YYYY-MM-DD" format
        $start_time     = date("H:i:s", time()); // Set $start_time to the current time in "HH:MM:SS" format
        $currentTime    = time(); // Get the current timestamp
        $end_time       = date("H:i:s", $currentTime + 7200); // Add 2 hours (7200 seconds) to the current time and format it as "HH:MM:SS"

    } else {
        $time           = $_POST['time'];
        $time_parts     = explode(' - ', $time);
        $clipped_time   = $time_parts[0];
        $start_time     = $time_parts[0] . ":00";
        $end_time       = $time_parts[1] . ":00";
        $session_date   = $_POST['date'];
    }



    $arr = array(
        'session_id'            => $id,
        'session_code'          => $code,
        'client_id'             => $user_id,
        'session_visit'         => $visitType,
        'session_mode'          => $mode,
        'session_channel'       => $channel,
        'session_consultation'  => 'specialist',
        'session_urgency'       => $urgency,
        'session_date'          => $session_date,
        'session_start_time'    => $start_time,
        'session_end_time'      => $end_time,
        'address_id'            => $address,
        'session_house'         => 'yes'
    );

    if (isset($_POST['details'])) {
        $arr['session_details'] = security('details');
    }


    if ($search == 'assign') {
        if (!empty($user['doctor_id'])) {
            $sql3 = "SELECT * FROM doctor WHERE doctor_id = '$user[doctor_id]' ";
            $row3 = select_rows($sql3)[0];
        } else {
            $sql3 = "SELECT * FROM doctor ORDER BY RAND() LIMIT 1";
            $row3 = select_rows($sql3)[0];
        }

        if (!empty($row3)) {
            $m['data']          = true;
            $m['doctor']        = $row3;
            $m['session_data']  = $arr;
            $m['search']        = "assign";
            $arr['doctor_id']   = $row3['doctor_id'];
        } else {
            $m['data']          = false;
        }
    } else {
        $sql        = "SELECT * FROM doctor WHERE doctor_status = 'active' ORDER BY RAND()";
        $doctors    = select_rows($sql);

        $m['session_data']  = $arr;
        $m['doctors']       = $doctors;
        $m['data']          = true;
        $m['search']        = "myself";
    }

    if (!build_sql_insert('session', $arr)) {
        $m['message'] = "Something went wrong";
        $m['data'] = false;
    }

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
        'doctor_id' => $doc_id
    );


    if (!build_sql_edit('session', $arr, $id, 'session_id')) {
        $m['message'] = "Something went wrong";
    }

    $sql2 = "SELECT * FROM session WHERE session_id = '$id'";
    $row2 = select_rows($sql2);

    if (!empty($row2)) {
        $row2       = $row2[0];

        $user       = get_by_id('user', $row2['client_id']);
        $doctor     = get_by_id('doctor', $row2['doctor_id']);

        if ($channel == 'video') {
            $uploadData["doctor"]   = $doctor;
            $uploadData["user"]     = $user;

            $uploadData["start"]    = $row2['session_start_time'];
            $uploadData["date"]     = $row2['session_date'];
            $uploadData["end"]      = $row2['session_end_time'];

            $response = addEvent($uploadData);

            if (isset($response["success"])) {
                $m["last_event_id"] = $response["data"]["event_id"];
            } else {
                $error['session'] = 133;
                error_checker($return_url);
            }
        }
    }

    $sql2 = "SELECT * FROM session WHERE session_id = '$id' ";
    $row2 = select_rows($sql2)[0];
    if ($row2['session_visit'] == 'home') {
        if ($row2['session_house'] == 'yes') {
            $m['vt'] = 'online';
        } else {
            $m['vt'] = 'home';
        }
    } else {
        $m['vt'] = 'online';
    }
    $m['session_data'] = $row2;
    $m['data'] = true;
    return $m;
}

function complete_api_session()
{
    $id         = security('session_id');
    if (!empty($_POST['address'])) {
        $address    = security('address');
        $arr['address_id'] = $address;
    }


    $arr = array(
        'session_payment_status'    => 'paid',
        'session_payment_method'    => security('payment_method')
    );

    if (!build_sql_edit('session', $arr, $id, 'session_id')) {
        $m['message'] = "Something went wrong";
    }

    $user_id        = get_by_id('session', $id)['client_id'];
    $doctor_id      = get_by_id('session', $id)['doctor_id'];
    $session        = get_by_id('session', $id);

    $user           = get_by_id('user', $user_id);
    $doctor         = get_by_id('doctor', $doctor_id);

    if (empty($user) || empty($doctor) || empty($session)) {
        $m['message'] = "Something went wrong";
    } else {
        if ($session['session_channel'] == 'message') {
            $message    = 'The user chose to have a chat with you. At the specified <b>SESSION DATE</b> and <b>START TIME</b>';

            $message1   = 'You chose to have a chat with the specialist. At the specified <b>SESSION DATE</b> and <b>START TIME</b>';
        }

        if ($session['session_channel'] == 'video') {
            $uploadData["doctor"] = $doctor;
            $uploadData["user"] = $user;

            $uploadData["start"] = $session['session_start_time'];
            $uploadData["date"] = $session['session_date'];
            $uploadData["end"] = $session['session_end_time'];

            $response = addEvent($uploadData);
            // echo json_encode($response);
            // exit;
            if (isset($response["success"])) {
                $_SESSION["last_event_id"] = $response["data"]["event_id"];
            } else {
                $error['session'] = 133;
            }
        }
        $name       = APP_NAME;
        $subject    = APP_NAME . " Session Booking";


        $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
        $body       .= 'Your session has been successfully logged.  <br>';
        $body       .= ' <b>CODE: </b> ' . $session['session_code'] . ' <br> ';
        $body       .= ' <b>DOCTOR: </b> ' . $doctor['doctor_name'] . ' <br> ';
        $body       .= ' <b>DATE: </b> ' . $session['session_date'] . ' <br> ';
        $body       .= ' <b>START TIME: </b> ' . $session['session_start_time'] . ' <br> ';
        $body       .= ' <b>END TIME: </b> ' . $session['session_end_time'] . ' <br> ';
        $body       .= ' <b>MODE: </b> ' . ucwords($session['session_mode']) . ' <br> ';
        $body       .= $message1;
        $body       .= $response;

        $body       .= '</p>';
        $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';


        $body2      = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $doctor['doctor_name'] . '  <br>';
        $body2      .= 'You have a new session.  <br>';
        $body2      .= ' <b>CODE: </b> ' . $session['session_code'] . ' <br> ';
        $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
        $body2      .= ' <b>DATE: </b> ' . $session['session_date'] . ' <br> ';
        $body2      .= ' <b>START TIME: </b> ' . $session['session_start_time'] . ' <br> ';
        $body2      .= ' <b>END TIME: </b> ' . $session['session_end_time'] . ' <br> ';
        $body2      .= ' <b>MODE: </b> ' . ucwords($session['session_mode']) . ' <br> ';
        $body2       .= $message;
        $body2       .= $response;

        $body2      .= '</p>';
        $body2      .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';

        email($user['user_email'], $subject, $name, $body);
        email($doctor['doctor_email'], $subject, $name, $body2);
        $msg = 'Hello. A '. $user['user_name'] .' A session has been scheduled for you on Hello Daktari. Check your email to proceed';
        send_sms($user['user_phone'],$msg);
        send_sms('0777359530','Hello. A session between Patrick and Fatima Sahabo has been scheduled on your platform.');
        $m['message'] = "success";
    }
    return $m;
}

function get_api_user_sessions()
{

    $sql = "SELECT session.*, doctor.doctor_name, doctor.doctor_image FROM session JOIN doctor ON session.doctor_id = doctor.doctor_id";
    $sql .= "  WHERE session.client_id = '$_GET[user_id]' ORDER BY session.session_date_created DESC ";

    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['sessions'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function get_api_doctor_sessions()
{

    $sql = "SELECT session.*, user.user_name, user.user_image, user.user_dob, user.user_email, user.user_phone ";
    $sql .= "  FROM session JOIN user ON session.client_id = user.user_id WHERE session.doctor_id = '$_GET[doctor_id]' ";
    $sql .= "  ORDER BY session.session_date_created DESC";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['sessions'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    $m['sql'] = $sql;
    return $m;
}


http_response_code(200);
$m['status'] = 1;
echo json_encode($m);
