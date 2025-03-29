<?php
include_once "../path.php";
include_once "create.php";


$action = $_GET['action'];

http_response_code(400);

switch ($action) {
    case 'login':
        $m = api_doctor_login();
        break;
    case 'register':
        $m = api_doctor_register();
        break;
    case 'patients':
        $m = get_api_patients();
        break;
    case 'profile':
        $m = api_doctor_profile();
        break;
    case 'categories':
        $m = get_api_doc_categories();
        break;
    case 'update_specialties':
        $m = api_update_doc_categories();
        break;
    case 'create_schedule':
        $m = api_create_schedule();
        break;
    case 'fetch_schedule':
        $m = api_fetch_schedule();
        break;
    case 'update':
        $m = api_update_doctor();
        break;
    case 'all_docs':
        $m = api_get_all_docs();
        break;
}


function api_doctor_login()
{
    $email = security('doctor_email');

    $sql = "select * from doctor where doctor_email = '$email' ";
    $row = select_rows($sql);

    if (!empty($row)) {
        $row = $row[0];

        // Replace null values with empty strings
        foreach ($row as $key => $value) {
            if ($value === null) {
                $row[$key] = ''; // Replace null with an empty string
            }
        }

        $m['status'] = 0;

        if (!password_hashing_hybrid_maker_checker(security('doctor_password'), $row['doctor_password'])) {
            $m['message'] = "Access denied: Incorrect password";
        } else {
            $m['status'] = 1;
            $m['data'] = $row;
            http_response_code(200);
        }
    } else {
        $m['message'] = "Access denied: email not found";
    }

    return $m;
}

function api_doctor_register()
{
    global $arr;
    global $error;
    global $success;
    
    $id             = create_id('doctor', 'doctor_id');
    $doctor_email     = security('doctor_email');
    $doctor_password  = security('doctor_password');
    $password       = password_hashing_hybrid_maker_checker($doctor_password);
    
    for_loop();
    
    $sql = "SELECT * FROM doctor WHERE doctor_email ='$doctor_email' ";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 0;
        $m['message'] = "Doctor Already Exists";
    } else {
        $arr['doctor_id'] = $id;
        $arr['doctor_password'] = $password;
        $arr['user_type'] = 'doctor';
    

        if (!build_sql_insert('doctor', $arr)) {
            $m['status'] = 0;
            $m['message'] = "Something went wrong";
        }

        $m['status'] = 1;
        $m['data'] = $arr;

        // Send an email to the doctor
        $subject = APP_NAME . ' Account Creation';
        $name = APP_NAME;
        $body = '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= 'Hello, <b> ' . $doctor_name . ' </b> <br>';
        $body .= 'Your account has been successfully created.';
        $body .= '<br>';
        $body .= 'You may log in to your account in the future with these credentials';
        $body .= '<br>';
        $body .= '<b>EMAIL:</b> ' . $doctor_email . ' <br>';
        $body .= '<br>';
        $body .= '<b>PASSWORD:</b> ' . security('doctor_password') . ' <br>';
        $body .= '<br>';

        // email($doctor_email, $subject, $name, $body);
    }
    return $m;
}

function get_api_patients()
{

    $sql = "SELECT * FROM user WHERE doctor_id = '$_GET[doctor_id]'";
    $users = select_rows($sql);

    $addresses = [];
    $sessions = [];
    $prescriptions = [];
    $uploads = [];

    foreach ($users as $user) {
        $userId = $user['user_id'];

        // Fetch addresses for the user
        $addressSql = "SELECT * FROM address WHERE user_id = '$userId'";
        $userAddresses = select_rows($addressSql);
        $addresses[$userId] = $userAddresses;

        // Fetch sessions for the user
        $sessionSql = "SELECT * FROM session WHERE client_id = '$userId'";
        $userSessions = select_rows($sessionSql);
        $sessions[$userId] = $userSessions;

        // Fetch prescriptions for the user
        $prescriptionSql = "SELECT l.*,p.* FROM lab l JOIN prescription p ON FIND_IN_SET(l.lab_id, REPLACE(p.prescription_tests, '|', ',')) > 0 ";
        $prescriptionSql .= "  WHERE p.user_id = '$userId' GROUP BY l.lab_id ORDER BY `p`.`prescription_id` ASC ";
        $userPrescriptions = select_rows($prescriptionSql);
        $prescriptions[$userId] = $userPrescriptions;

        // Fetch uploads for the user
        $uploadSql = "SELECT * FROM upload WHERE user_id = '$userId'";
        $userUploads = select_rows($uploadSql);
        $uploads[$userId] = $userUploads;
    }

    if (!empty($users)) {
        $m['status'] = 1;
        $m['patients'] = $users;
        $m['uploads'] = $uploads;
        $m['addresses'] = $addresses;
        $m['sessions'] = $sessions;
        $m['prescriptions'] = $prescriptions;
    } else {
        $m['message'] = "Something went wrong";
    }
    $m['query'] = $sql;
    return $m;
}

function get_api_doc_categories()
{
    $sql = "SELECT * FROM doc_category ORDER BY doc_category_id ";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['categories'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function api_doctor_profile()
{
    $sql = "SELECT * FROM doctor WHERE doctor_id = '$_GET[doctor_id]' ";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['data'] = $row[0];
    } else {
        $m['message'] = "Something went wrong";
    }
    return $m;
}

function api_update_doctor()
{
    $id     = security('doctor_id');
    $arr = array(
        'doctor_name'       => security('doctor_name'),
        'doctor_phone'      => security('doctor_phone'),
        'doctor_passport'   => security('doctor_passport'),
        'doctor_bio'        => security('doctor_bio'),
        'doctor_location'   => security('doctor_location'),
        'doctor_license'    => security('doctor_license'),
        'doctor_rate'       => security('doctor_rate'),
        'doctor_experience' => security('doctor_experience'),
        'doctor_qualifications'    => security('doctor_qualifications'),
        'doctor_statement'  => security('doctor_statement'),
        'doctor_dob'        => '1993-01-01',
        'doctor_id'         => $id
    );

    if (!empty($_FILES['doctor_image']['name']))    $arr['doctor_image']   = upload('doctor_image');

    
    if (!build_sql_edit('doctor', $arr, $id, 'doctor_id')) {
        $m['message'] = 'failed';
    }

   

    $sql    = "SELECT * FROM doctor WHERE doctor_id = '$id' ";
    $row    = select_rows($sql)[0];

    $m['token'] = $row;
    return $m;
}

function api_update_doc_categories()
{

    $m['data'] = $_POST;
    $categoriesArray = explode(',', security('categories'));

    $outputString = implode('|', $categoriesArray);
    $arr['category_id'] = $outputString;
    if (!build_sql_edit('doctor', $arr, security('doctor_id'), 'doctor_id')) {
        $m['message'] = 'failed';
    }
    return $m;
}

function api_create_schedule()
{
    $m['post']  = $_POST;
    $m['data']  = true;
    $openingTime = security('startTime');
    $closingTime = security('endTime');
    $duration   = security('interval');
    $break      = security('break');
    $id         = security('doctor_id');
    $option     = security('option');

    $calendar_array                 = array();
    $calendar_array['start_time']   = $openingTime;
    $calendar_array['slot_minutes'] = $duration;
    $calendar_array['tid']          = $id;
    $cid =  $calendar_array['id']   = create_id('calendar_info', 'id');

    if (!build_sql_insert('calendar_info', $calendar_array)) {
        $m['message'] = "Something went wrong";
    }

    if ($option == 'daily') {
        $daysOfWeek = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

        foreach ($daysOfWeek as $day) {
            $startTime = $openingTime;
            $daySlots = [];

            // Generate slots for the current day
            while (true) {
                $endTime = date('H:i', strtotime("$startTime + $duration minutes"));

                // Break out of the loop if the end time exceeds the closing time
                if ($endTime > $closingTime) {
                    break;
                }

                $daySlots[] = [
                    'start_time' => $startTime,
                    'end_time'   => $endTime,
                    'calendar_info_id' => $cid,
                    'day' => $day,
                ];

                // Move to the next slot
                $startTime = date('H:i', strtotime("$endTime + $break minutes"));
            }


            foreach ($daySlots as $slot) {
                if (!build_sql_insert('weekly_schedule', $slot)) {
                    $m['message'] = "Something went wrong";
                }
            }
        }
    }

    return $m;
}


function api_fetch_schedule()
{
    $sql = "select weekly_schedule.* from weekly_schedule
    join calendar_info on calendar_info.id = weekly_schedule.calendar_info_id
    where calendar_info.tid = '$_GET[doctor_id]'
    ";


    $data = select_rows($sql);

    $sql = "select * from session where doctor_id = '$_GET[doctor_id]' and session_payment_status = 'paid' ";
    $dt = select_rows($sql);

    foreach ($dt as $key => $item) {
        $time = $item['session_start_time'];
        $dt[$key]['time'] = $time;
    }

    function timeslots($data, $dt = array())
    {
        $days = array();
        $start_date = new DateTime();
        $interval = new DateInterval('P1D'); // 1 day interval
        for ($i = 0; $i < 7; $i++) {
            $day = $start_date->format('D');
            $date = $start_date->format('Y-m-d');
            $day_data = array('day' => $day, 'date' => $date, 'times' => array());

            foreach ($data as $entry) {
                if ($entry['day'] === strtolower($day)) {
                    $day_data['times'][] = array('start_time' => $entry['start_time'], 'end_time' => $entry['end_time']);
                }
            }

            if (!empty($day_data['times'])) {
                $days[] = $day_data;
            }

            $start_date->add($interval);
        }

        foreach ($dt as $item) {

            foreach ($days as $key => $item2) {

                if ($item['session_date'] == $item2['date']) {

                    foreach ($item2['times'] as $key2 => $item3) {
                        // cout($item3);
                        if (strtotime($item3['start_time']) == strtotime($item['time'])) {
                            // echo $item['time'];
                            unset($days[$key]['times'][$key2]);
                        }
                    }
                }
            }
        }

        return $days;
    }
    
    $sql2       = "select * from doctor where doctor_id = '$_GET[doctor_id]'";
    $row_doc    = select_rows($sql2)[0];    

    $m['status'] = 1;
    $m['schedule'] = timeslots($data, $dt);
    $m['new'] = true;
    $m['doctor'] = $row_doc;
    return $m;
}

function api_get_all_docs()
{
    $sql        = "SELECT * FROM doctor WHERE doctor_status = 'active' AND doctor_id != '$_GET[doctor_id]' ORDER BY RAND()";
    $doctors    = select_rows($sql);

    if (!empty($doctors)) {
        $m['doctors'] = $doctors;
        $m['data'] = true;
    } else {
        $m['data'] = false;
    }

    return $m;
}

function for_loop()
{
    global $arr;

    foreach ($_POST as $key => $value) {
        $arr[$key] = security($key);
    }
}


http_response_code(200);

echo json_encode($m);
