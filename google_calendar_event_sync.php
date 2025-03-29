<?php
// Include Google calendar api handler class 
require_once 'path.php';
require_once MODEL_PATH . "operations.php";


$statusMsg = '';
$status = 'danger';
if (isset($_GET['code'])) {
    // Initialize Google Calendar API class 
    $GoogleCalendarApi = new GoogleCalendarApi();

    // Get event ID from session 
    $event_id = $_SESSION['last_event_id'];

    if (!empty($event_id)) {

        $eventData = select_rows("SELECT * FROM events WHERE event_id = '$event_id'")[0];

        if (isset($eventData) && !empty($eventData)) {
            $calendar_event = array(
                'summary' => $eventData['title'],
                'location' => $eventData['location'],
                'description' => $eventData['description']
            );

            $event_datetime = array(
                'event_date' => $eventData['date'],
                'start_time' => $eventData['time_from'],
                'end_time' => $eventData['time_to']
            );

            // Get the access token 
            $access_token_sess = $_SESSION['google_access_token'];
            if (!empty($access_token_sess)) {
                $access_token = $access_token_sess;
            } else {
                $data = $GoogleCalendarApi->GetAccessToken(GOOGLE_CLIENT_ID, REDIRECT_URI, GOOGLE_CLIENT_SECRET, $_GET['code']);
                $access_token = $data['access_token'];
                $_SESSION['google_access_token'] = $access_token;
            }

            if (!empty($access_token)) {
                try {
                    // Get the user's calendar timezone 
                    $user_timezone = $GoogleCalendarApi->GetUserCalendarTimezone($access_token);
                    
                     $sql = "SELECT * FROM session WHERE client_id = '$_SESSION[user_id]' ORDER BY session_date_created DESC ";
                    $row = select_rows($sql)[0];
                    
                        $user       = get_by_id('user', $row['client_id']);
                    $doctor     = get_by_id('doctor', $row['doctor_id']);

                    // Create an event on the primary calendar 
                    $google_event = $GoogleCalendarApi->CreateCalendarEvent($access_token, 'primary', $calendar_event, $doctor["doctor_email"], $event_datetime, $user_timezone);

                    //echo json_encode([ 'event_id' => $event_id ]); 


                    if (isset($google_event) && isset($google_event["id"])) {
                        $google_event_id = $google_event["id"];
                        // Update google event reference in the database 
                        $build_edit = build_sql_edit('events', array('google_calendar_event_id' => $google_event_id), $event_id, "event_id");

                        if ($build_edit !== true) {
                            $statusMsg = $build_edit;
                        }else{

                        unset($_SESSION['last_event_id']);
                        unset($_SESSION['google_access_token']);

                        // $status = 'success';
                        // $statusMsg = '<p>Event #' . $event_id . ' has been added to Google Calendar successfully!</p>';
                        // $statusMsg .= '<p><a href="https://calendar.google.com/calendar/" target="_blank">Open Calendar</a>';
                        // $statusMsg .= json_encode($google_event);
                        
                        $name       = APP_NAME;
                        $subject    = APP_NAME . " Sign Up";
                
                
                        $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
                        $body       .= 'Your session has been successfully logged.  <br>';
                        $body       .= ' <b>CODE: </b> ' . $row['session_code'] . ' <br> ';
                        $body       .= ' <b>DOCTOR: </b> ' . $doctor['doctor_name'] . ' <br> ';
                        $body       .= ' <b>DATE: </b> ' . $row['session_date'] . ' <br> ';
                        $body       .= ' <b>START TIME: </b> ' . $row['session_start_time'] . ' <br> ';
                        $body       .= ' <b>END TIME: </b> ' . $row['session_end_time'] . ' <br> ';
                        $body       .= ' <b>MODE: </b> ' . ucwords($row['session_mode']) . ' <br> ';
                         $body      .= ' <b>Meet Link: </b> ' . $google_event["hangoutLink"] . ' <br> ';
                        $body       .= $message1;
                        $body       .= '<br><br>You may log in to your account <a href="' . $login_url . '" style="cursor:pointer;"><b> BY CLICKING HERE </b></a>';
                        $body       .= '</p>';
                        $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';
                
                
                        $body2      = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $doctor['doctor_name'] . '  <br>';
                        $body2      .= 'You have a new session.  <br>';
                        $body2      .= ' <b>CODE: </b> ' . $row['session_code'] . ' <br> ';
                        $body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
                        $body2      .= ' <b>DATE: </b> ' . $row['session_date'] . ' <br> ';
                        $body2      .= ' <b>START TIME: </b> ' . $row['session_start_time'] . ' <br> ';
                        $body2      .= ' <b>END TIME: </b> ' . $row['session_end_time'] . ' <br> ';
                        $body2      .= ' <b>MODE: </b> ' . ucwords($row['session_mode']) . ' <br> ';
                        $body2     .= ' <b>Meet Link: </b> ' . $google_event["hangoutLink"] . ' <br> ';
                        $body2       .= $message;
                        $body2      .= '<br><br>You may log in to your account <a href="' . $doc_url . '" style="cursor:pointer;"><b> BY CLICKING HERE </b></a>';
                        $body2      .= '</p>';
                        $body2      .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';
                
                        email($user['user_email'], $subject, $name, $body);
                        email($doctor['doctor_email'], $subject, $name, $body2);
                        
                        $_SESSION['status_response'] = array('status' => true, 'status_msg' => "Successfully created the calendar link");
                        $return_url = base_url . 'index';
                        header("Location: $return_url");
                        exit();
                        }
                    }
                } catch (Exception $e) {
                    //header('Bad Request', true, 400); 
                    //echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() )); 
                    $statusMsg = $e->getMessage();
                }
            } else {
                $statusMsg = 'Failed to fetch access token!';
            }
        } else {
            $statusMsg = 'Event data not found!';
        }
    } else {
        $statusMsg = 'Event reference not found!';
    }

    $_SESSION['status_response'] = array('status' => $status, 'status_msg' => $statusMsg);
    
    $return_url = base_url . 'specialists';

    header("Location: $return_url");
    exit();
}
