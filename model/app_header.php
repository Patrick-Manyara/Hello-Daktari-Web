<?php

if(!defined('auth')) {
    http_response_code(401);
    exit();
}

ini_set('session.cookie_secure',     true);
ini_set('session.cookie_httponly',   true);
ini_set('session.use_only_cookies',  true);
ini_set('session.user_strict_mode',  true);
ini_set('session.cookie_samesite',  'Lax');
ini_set('session.gc_maxlifetime',    LIFE);
ini_set('session.cookie_lifetime',   LIFE);
ini_set('session.use_trans_sid',    false);
ini_set('session.cookie_domain',    cookie_domain);

header("Access-Control-Allow-Origin:" . admin_uri);

header("Access-Control-MAX-Age: 86400");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Cache-Control: private, no-cache");
header("Access-Control-Allow-Credentials: true");
header("Content-Security-Policy: frame-ancestors 'self'");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Strict-Transport-Security: max-age=31592000; includeSubDomains");
header("Permissions-Policy: geolocation=(self " . admin_url . "), microphone=()");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Authorization, Content-Type, X-Requested-With, X-Debug");