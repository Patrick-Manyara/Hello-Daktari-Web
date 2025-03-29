<?php

if (!defined('auth')) {
    http_response_code(401);
    exit();
}

const APP_NAME =  'Hello Daktari';

const NO_SPECIAL_CHAR =  '/^[\w]+$/';

// database connection 

$isOnline = true; // Set this to true for online, false for offline

if ($isOnline) {
    // ONLINE
    define('DB_HOST', 'localhost');
    define('DB_PASSWORD', '6wVCtmoa2CoI');
    define('DB_NAME', 'daktarik_db');
    define('DB_USERNAME', 'daktarik_user');
} else {
    // OFFLINE
    define('DB_HOST', 'localhost');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'hellodaktari');
    define('DB_USERNAME', 'root');
}

// cookie

const PATH = '/';
const LIFE = 43200;

// string

const UPPERCASE        = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const LOWERCASE_NUMBER = '1234567890abcdefghijklmnopqrstuvwxyz';

// social media

const FB_ID     = '492544432365286';
const FB_SECRET = '4982b192417c909d084d165d7b4c3d8a';
const G_SECRET  = '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';
const G_ID      = '417342897536-hdgu26doqa7su6q2tjnoic5djgo23o00.apps.googleusercontent.com';

// csrf key

const CSRF_KEY  = 'T8EeWVHc9RDszmAcu3XEBgm7tj2b24uuLhW';

// encryption

const ENCRYPT_DECRYPT_KEY = 'DLUbj4VWAszgDv7qcvGqabTnuXiDnNZN66KvnaLCxPdEtC9LPJ2yTwnLgY6';

//password pepper

const PASSWORD_PEPPER     = 'M3Sq6YrZv6sJqa3LvWdurRvNnh78B7DyP97TAnaz7KdCBm98mDvbDUUjd2LW4';

// mail

const MAIL_PATH      = 'PHPMailer/vendor/';
const MAIL_HOST      = 'mail.psychx.io';
const MAIL_SENDER    = 'system@psychx.io';
const MAIL_PASS      = 'Pass4SystemPsychX11!!';
const MAIL_SRC       = MAIL_PATH . 'phpmailer/phpmailer/src/';



// database id length integer

const LOGINATTEMPTID_LENGTH_ID_INT      =  3;
const PASSWORDRESETID_LENGTH_ID_INT     =  3;

// file size

const BYTES_EQUIVALENT_TO_HALF_MB       = 524288;



// cookie definition

define('EXPIRE', time() + 2592000);
define('EXPIRE_IN_A_YEAR', time() + 62208000);

//password regex
define('PASSWORD_REGEX', '/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.{6,})/');

// Google API configuration 
define('GOOGLE_CLIENT_ID', '113071508359-sprbuvpiv8ad8k7f00nn1v0cue2dll99.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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'); //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
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar');
define('REDIRECT_URI', 'https://hello.angacinemas.com/google_calendar_event_sync.php');

// Google OAuth URL 
$oauthurl  = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online';
$GOOGLE_OAUTH_URL = $oauthurl;
require_once MODEL_PATH . 'error.php';
