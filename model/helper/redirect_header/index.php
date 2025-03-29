<?php

if(!defined('auth')){
    http_response_code(401);
    exit();
}

function redirect_header($redirect){
    if(!headers_sent()) {
        writing_system_logs("redirect header url [ $redirect ]");
        header("Location: " . $redirect);
    }

    writing_system_logs("Header already sent. redirect header url [ $redirect ]");
    // echo "<script>window.location='$redirect';</script>";
    header("Location: " . $redirect);
    exit();
}