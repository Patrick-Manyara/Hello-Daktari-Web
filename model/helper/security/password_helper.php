<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function password_hashing_hybrid_maker_checker($password, $password_hashed = '') {
    $pepper                 = PASSWORD_PEPPER;
    $double_md5_password    = md5(md5($password));
    $password_peppered      = hash_hmac("sha256", $double_md5_password, $pepper);
    $md5_password_peppered  = md5($password_peppered);
    
    if($password_hashed != '') {
        writing_system_logs('Verifying password...');
        return password_verify($md5_password_peppered, $password_hashed);
    } 
    
    writing_system_logs('Hashing password...');
    return password_hash($md5_password_peppered, PASSWORD_DEFAULT, ['cost' => 11]);
}