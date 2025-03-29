<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function rand_str($length  = 7, $embed_str = UPPERCASE) {
    $str        =  LOWERCASE_NUMBER . $embed_str;
    return substr(str_shuffle($str), 0, $length);
}

function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function space()
{
    return '&nbsp;';
}
