<?php

// if(!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function session_assignment($session_array, $regenerate = true) {
    if ($regenerate) session_regenerate_id(true);
    foreach($session_array as $session_name => $session_value) {
        writing_system_logs("Setting Session : $session_name : [ " . json_encode($session_value) . ' ]');
        $_SESSION[$session_name] = $session_value;
    }
    
    session_write_close();
}