<?php
include_once "../path.php";
include_once "create.php";
require_once MODEL_PATH . "operations.php";

http_response_code(400);

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

$m['status'] = 1;
$m['data'] = timeslots($data,$dt);
http_response_code(200);

echo json_encode($m);
