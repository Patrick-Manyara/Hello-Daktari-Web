<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function cookie_assignment($cookie_array) {
    foreach($cookie_array as $cookie_name => $cookie_value) {
        writing_system_logs("Setting Cookie :  . [ $cookie_name : $cookie_value ]");
        setcookie($cookie_name, $cookie_value, EXPIRE, PATH, cookie_domain, true, true);
    }
}