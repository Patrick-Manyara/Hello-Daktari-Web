<?php
/** 
 * 
 * This Google Calendar API handler class is a custom PHP library to handle the Google Calendar API calls. 
 * 
 * @class        GoogleCalendarApi 
 * @author        CodexWorld 
 * @link        http://www.codexworld.com 
 * @version        1.0 
 */
require 'vendor/autoload.php';
class GoogleCalendarApi
{
    const OAUTH2_TOKEN_URI = 'https://accounts.google.com/o/oauth2/token';
    const CALENDAR_TIMEZONE_URI = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';
    const CALENDAR_LIST = 'https://www.googleapis.com/calendar/v3/users/me/calendarList';
    const CALENDAR_EVENT = 'https://www.googleapis.com/calendar/v3/calendars/';

    function __construct($params = array())
    {
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }

    function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code)
    {
        $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code=' . $code . '&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::OAUTH2_TOKEN_URI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code != 200) {
            $error_msg = 'Failed to receieve access token';
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
            }
            throw new Exception('Error ' . $http_code . ': ' . $error_msg);
        }

        return $data;
    }

    public function GetUserCalendarTimezone($access_token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::CALENDAR_TIMEZONE_URI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code != 200) {
            $error_msg = 'Failed to fetch timezone';
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
            }
            throw new Exception('Error ' . $http_code . ': ' . $error_msg);
        }

        return $data['value'];
    }

    public function GetCalendarsList($access_token)
    {
        $url_parameters = array();

        $url_parameters['fields'] = 'items(id,summary,timeZone)';
        $url_parameters['minAccessRole'] = 'owner';

        $url_calendars = self::CALENDAR_LIST . '?' . http_build_query($url_parameters);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_calendars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code != 200) {
            $error_msg = 'Failed to get calendars list';
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
            }
            throw new Exception('Error ' . $http_code . ': ' . $error_msg);
        }

        return $data['items'];
    }

    private function getClient($access_token)
    {
        $client = new Google_Client();
        $client->setApplicationName('Hello Daktari');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAccessToken($access_token);

        return $client;
    }

    public function CreateCalendarEvent($access_token, $calendar_id, $event_data, $attendees, $event_datetime, $event_timezone)
    {
        if (!empty($event_data['summary'])) {
            $curlPost['summary'] = $event_data['summary'];
        }

        if (!empty($event_data['location'])) {
            $curlPost['location'] = $event_data['location'];
        }

        if (!empty($event_data['description'])) {
            $curlPost['description'] = $event_data['description'];
        }

        $timezone_offset = $this->getTimezoneOffset($event_timezone);

        $event_date = !empty($event_datetime['event_date']) ? $event_datetime['event_date'] : date("Y-m-d");
        $start_time = !empty($event_datetime['start_time']) ? $event_datetime['start_time'] : date("H:i:s");
        $end_time = !empty($event_datetime['end_time']) ? $event_datetime['end_time'] : date("H:i:s");

        $dateTime_start = $event_date . 'T' . $start_time . $timezone_offset;
        $dateTime_end = $event_date . 'T' . $end_time . $timezone_offset;
        $event_timezone = 'Africa/Nairobi';


        $apiURL = self::CALENDAR_EVENT . $calendar_id . '/events';

        $client = $this->getClient($access_token);
        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event();
        $event->setSummary($event_data['summary']);
        $event->setLocation($event_data['location']);
        $event->setDescription($event_data['description']);

        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDateTime($dateTime_start);
        $start->setTimeZone($event_timezone);
        $event->setStart($start);

        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDateTime($dateTime_end);
        $end->setTimeZone($event_timezone);
        $event->setEnd($end);

        $attendee1 = new Google_Service_Calendar_EventAttendee();
        $attendee1->setEmail($attendees);
        $attendees = array($attendee1);
        $event->attendees = $attendees;

        $reminders = new Google_Service_Calendar_EventReminders();
        $overrides = array();
        $overrides[0] = new Google_Service_Calendar_EventReminder();
        $overrides[0]->setMethod('email');
        $overrides[0]->setMinutes(30);
        $reminders->setUseDefault(false);
        $reminders->setOverrides($overrides);
        $event->setReminders($reminders);

        // set video conferencing
        $conference = new Google_Service_Calendar_ConferenceData();
        $conferenceRequest = new Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId('randomString' . time());
        $solutionKey = new Google_Service_Calendar_ConferenceSolutionKey();
        $solutionKey->setType("hangoutsMeet");
        $conferenceRequest->setConferenceSolutionKey($solutionKey);
        // $conferenceRequest->setStartTime($event_datetime['start']);

        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData($conference);

        $event = $service->events->insert($calendar_id, $event, ['conferenceDataVersion' => 1]);
        return $event;
    }

    private function getTimezoneOffset($timezone = 'Africa/Nairobi')
    {
        $current   = timezone_open($timezone);
        $utcTime  = new \DateTime('now', new \DateTimeZone('UTC'));
        $offsetInSecs =  timezone_offset_get($current, $utcTime);
        $hoursAndSec = gmdate('H:i', abs($offsetInSecs));
        return stripos($offsetInSecs, '-') === false ? "+{$hoursAndSec}" : "-{$hoursAndSec}";
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
