<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function encrypt_ip() {
    global $get_ip;
    return encrypt_decrypt_string($get_ip, 'encrypt');
}

function encrypt($id, $ip = null) {
    $get_ip = $ip == null ? encrypt_ip() : $ip;
    return crypt_id($id, $get_ip);
}

function decrypt($encrypt_id, $ip = null) {
    $get_ip = $ip == null ? encrypt_ip() : $ip;
    return crypt_id($encrypt_id, $get_ip, 'decrypt');
}

function crypt_id($string, $get_ip = '', $action = 'encrypt') {
    return encrypt_decrypt_string($string, $action, $get_ip);
}

function encrypt_decrypt_string($string, $action, $encrypted_ip = '') {
    global $flag;
    
    $output = false;
    $extra_key = ENCRYPT_DECRYPT_KEY;

    $action_log = $action == 'encrypt' ? 'Encryption' : 'Decryption';
    
    writing_system_logs("Starting $action_log... [ $string ]");
    $encrypt_method = "AES-256-CBC";
    $secret_key = $flag['2nd-encrypt-key'] . $encrypted_ip . '-' . $extra_key;
    $secret_iv = $flag['2nd-encrypt-secret'] . $encrypted_ip . '-' . $extra_key;
    
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
    if ($action == 'encrypt') {
        $openssl_output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $encoded_output = base64UrlEncode($openssl_output);
        //replace equal signs with char that hopefully won't show up
        $output = str_replace('=', '[equal]', $encoded_output);
    } else if ($action == 'decrypt') {
        //put back equal signs where your custom var is
        $set_string = str_replace('[equal]', '=', $string);
        $output = openssl_decrypt(base64UrlDecode($set_string), $encrypt_method, $key, 0, $iv);
    }
    
    writing_system_logs("$action_log complete: [ $output ]");
    return $output;
}