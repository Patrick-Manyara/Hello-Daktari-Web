<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

date_default_timezone_set('Africa/Nairobi');
writing_system_logs("Timezone set to: [  Africa/Nairobi ]");

$date = date('Y-m-d H:i:s');

$time = time();
$minutesBeforeSessionExpire=30;

$_SESSION['LAST_ACTIVITY'] = $time;
writing_system_logs("Last activity time: [ $time ]");

function time_difference($time1, $time2) {
    
    $time1 = strtotime($time1);
    $time2 = strtotime($time2);
    
    $timediff = abs($time2 - $time1);
    
    if(floor($timediff) < 60){
        return floor($timediff) .' sec';
    }elseif(floor($timediff/(60)) < 60){
        return floor($timediff/(60)) . ' min(s)';
    }elseif(floor($timediff/(60*60)) < 24){
        return floor($timediff/(60*60)) . ' hr(s)';
    }elseif(floor($timediff/(60*60*24)) < 30){
        return floor($timediff/(60*60*24)) . ' day(s)';
    }elseif(floor($timediff/(60*60*24*30) < 12)){
        return floor($timediff/(60*60*24*30)) . ' month(s)';
    }else{
        return floor($timediff/(60*60*24*30*365)) . ' year(s)';
    }
}

function days_calculator($first_date, $other_date = "today") {
    $timezone   = new DateTimeZone('Africa/Nairobi');
    $date1      = new DateTime($first_date, $timezone);
    $date2      = new DateTime($other_date, $timezone);
    $date       = $date1->diff($date2);
    return $date->format('%R%a days') + 0;
}