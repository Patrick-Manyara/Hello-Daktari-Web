<?php
include_once "../path.php";


// Validate the user's input
$data = array(
    "doctor_id" => $_POST['doctor_id'],
    "date_date" => $_POST['date_date'],
    "time_date" => $_POST['time_date'],
    "session_visit" => $_POST['session_visit'],
    "session_channel" => $_POST['session_channel']
);
// Check if the email address is well-formed
if (!filter_var($data['doctor_id'], FILTER_VALIDATE_EMAIL)) {
    $response = array(
        'status' => 0,
        'message' => 'Invalid email format'
    );
    echo json_encode($response);
    exit;
}

// Get the doctor and user details
$doctor = get_by_id('doctor', $data['doctor_id']);
$user = get_by_id('user', $_SESSION['user_id']);

// Initialize Google Calendar API class 
$GoogleCalendarApi = new GoogleCalendarApi();

// Get the access token 
$access_token_sess = $_SESSION['google_access_token'];
if (!empty($access_token_sess)) {
    $access_token = $access_token_sess;
} else {
    $data = $GoogleCalendarApi->GetAccessToken(GOOGLE_CLIENT_ID, REDIRECT_URI, GOOGLE_CLIENT_SECRET, $_GET['code']);
    $access_token = $data['access_token'];
    $_SESSION['google_access_token'] = $access_token;
}

// Get the user's calendar timezone 
$user_timezone = $GoogleCalendarApi->GetUserCalendarTimezone($access_token);

// Create an event on the primary calendar 
$google_event = $GoogleCalendarApi->CreateCalendarEvent($access_token, 'primary', array(
    'summary' => 'Meeting with ' . $doctor['doctor_name'],
    'location' => 'Online Meeting',
    'description' => 'Online Meeting',
    'start' => array(
        'dateTime' => $data['date_date'] . 'T' . $data['time_date'],
        'timeZone' => $user_timezone,
    ),
    'end' => array(
        'dateTime' => $data['date_date'] . 'T' . date('H:i', strtotime($data['time_date']) + 60*60),
        'timeZone' => $user_timezone,
    ),
    'attendees' => array(
        array('email' => $doctor['doctor_email']),
        array('email' => $user['user_email']),
    ),
    'conferenceData' => array(
        'createRequest' => array(
            'requestId' => 'sample123',
            'conferenceSolutionKey' => array(
                'type' => 'hangoutsMeet'
            )
        )
    )
), $doctor["doctor_email"], array(
    'event_date' => $data['date_date'],
    'start_time' => $data['time_date'],
    'end_time' => date('H:i', strtotime($data['time_date']) + 60*60)
), $user_timezone);

// Get Google Meet link
$google_meet_link = $google_event["hangoutLink"];

// Send the Google Meet link to both the doctor and the user via email
email($doctor['doctor_email'], $google_meet_link);
email($user['user_email'], $google_meet_link);

$response = array(
    'status' => 1,
    'message' => 'Meeting scheduled successfully',
    'google_meet_link' => $google_meet_link
);

echo json_encode($response);

// If there was an error, send the error message
// } else if (isset($statusMsg)) {
//     echo json_encode(array('status' => $status, 'message' => $statusMsg));
// }
?>


