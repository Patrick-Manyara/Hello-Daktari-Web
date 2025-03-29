<?php

const ERROR_DEFINITION = array(
    103 => 'deletion unsuccessful',
    104 => 'operation failed',
    105 => 'last insert id not returned',
    106 => 'filename not allowed',
    107 => 'file size exceeds the maximum allowed',
    108 => 'unaccepted file format',
    109 => 'unknown internal error during file upload',
    110 => 'file required but not set',
    111 => 'fraud alert, request blocked',
    112 => 'request blocked because of expired token',
    113 => 'invalid verification code passed',
    114 => 'password should have a minimum of 6 characters, atleast 1 digit and atleast 1 letter',
    115 => 'Invalid email passed, the email domain is invalid',
    116 => 'invalid url passed',
    117 => 'invalid url passed',
    118 => 'invalid email passed',
    119 => 'invalid email passed',
    120 => 'all fields are required',
    121 => 'input expects numeric',
    122 => 'input length exceeded',
    123 => 'unexpected float value',
    124 => 'input validation failed',
    127 => 'email not sent',
    128 => 'ID length less or greater than required',
    129 => 'ID expects numeric',
    130 => 'Special character not allowed in ID',
    131 => 'User addition unsuccessful',
    132 => 'Images update unsuccessful',
    133 => 'Post update unsuccessful',
    134 => 'Images Addition unsuccessful',
    135 => 'Wrong Email or Password',
    136 => 'Email already exist',
    137 => 'Phone number already exist',
    138 => 'User update unsuccessful',
    139 => 'Post addition unsuccessful',
    140 => 'admin addition unsuccessful',
    141 => 'admin update unsuccessful',
    142 => 'Message update unsuccessful',
    143 => 'category update unsuccessful',
    144 => 'Item deletion unsuccessful',
    145 => 'Your new passwords did not match. Kindly try again',
    146 => 'update cannot be done, wrong channel used',
    147 => 'Doctor update unsuccessful',
    148 => 'Doctor addition unsuccessful',
    149 => 'data edit was unsuccessful. please try again',
    150 => 'data addition was unsuccessful. please try again',
    151 => 'Manager details update was unsuccessful.',
    152 => 'Manager creation was unsuccessful.',
    153 => 'banner edit was unsuccessful',
    154 => 'banner creation was unsuccessful',
    155 => 'User not found',
    156 => 'Your new password is the same as your current password. Kindly try again',
    157 => 'The password you entered didnt match your current password. Please try again.',
    158 => 'Feedback couldn\'t be posted. Kindly try again.',
    159 => 'Comment couldn\'t be posted. Kindly try again.',
    160 => 'Error encountered. Please try again',
    161 => 'You are already subscribed',
    162 => 'Something went wrong. Please try again'
);

function error_checker($location)
{
    global $error;

    if (!empty($error)) {
        $session_error = array('error' => array_filter(array_unique($error)));
        session_assignment($session_error, false);
        redirect_header($location);
    }

    return null;
}

function unset_session_error()
{
    if (isset($_SESSION['error'])) unset($_SESSION['error']);
}

require_once MODEL_PATH . 'success.php';
