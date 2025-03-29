<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function strip_id_string($string) {
    $s = explode(" ", $string);
    return $s[1];
}