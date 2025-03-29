<?php
include_once "../path.php";

include_once 'vendor/autoload.php';

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

// Create Google Calendar client
$client = new Google_Client();
$client->setApplicationName('Google Calendar API');
$client->setScopes(Google_Service_Calendar::CALENDAR);
$client->setAuthConfig('path/to/credentials.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');

$service = new Google_Service_Calendar($client);

// Create event
$event = new Google_Service_Calendar_Event(array(
    'summary' => 'Meeting with ' . $doctor['doctor_name'],
    'location' => 'Online Meeting',
    'description' => 'Online Meeting',
    'start' => array(
        'dateTime' => $data['date_date'] . 'T' . $data['time_date'],
        'timeZone' => 'America/Los_Angeles',
    ),
    'end' => array(
        'dateTime' => $data['date_date'] . 'T' . date('H:i', strtotime($data['time_date']) + 60*60),
        'timeZone' => 'America/Los_Angeles',
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
));

$event = $service->events->insert('primary', $event, array(
    'conferenceDataVersion' => 1,
));

// Get Google Meet link
$google_meet_link = $event->hangoutLink;

// Send the Google Meet link to both the doctor and the user via email
send_email($doctor['doctor_email'], $google_meet_link);
send_email($user['user_email'], $google_meet_link);

$response = array(
    'status' => 1,
    'message' => 'Meeting scheduled successfully',
    'google_meet_link' => $google_meet_link
);

echo json_encode($response);
?>
