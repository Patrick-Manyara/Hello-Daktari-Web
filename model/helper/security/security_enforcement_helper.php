<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function validate_verification_code($verification)
{
    global $error;

    if (empty($verification)) {
        writing_system_logs('Verification code error: [' . $error[113] . ' ]');
        return $error['verificationCode'] = 113;
    }

    return password_hashing_hybrid_maker_checker($verification);
}

function validate_password($password)
{
    global $error;

    $regex = preg_match(PASSWORD_REGEX, $password);

    if (!$regex) {
        writing_system_logs('Password formulation error: [' . $error[114] . ' ]');
        return $error['password'] = 114;
    }

    return password_hashing_hybrid_maker_checker($password);
}

function validate_email($email)
{
    global $error;

    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!$sanitized_email) {
        writing_system_logs('Email error: [' . $error[118] . ' ]');
        return $error['email'] = 118;
    }

    $validated_email = filter_var($sanitized_email, FILTER_VALIDATE_EMAIL);

    if (!$validated_email) {
        writing_system_logs('Email error: [' . $error[119] . ' ]');
        return $error['email'] = 119;
    }

    $domain = substr($validated_email, strpos($validated_email, '@') + 1);

    if (!checkdnsrr($domain, 'MX')) {
        writing_system_logs('Email error: [' . $error[115] . ' ]');
        return $error['email'] = 115;
    }

    return $validated_email;
}

function input_validation_and_sanitization($value, $name)
{
    global $error;

    if ($name == 'password') {
        $string = validate_password($value);
    }

    if ($name == 'verificationCode') {
        $string = validate_verification_code($value);
    }

    if ($name == 'email') {
        $string = validate_email($value);
    }

    if ($name == 'url') {
        $url = filter_var($value, FILTER_SANITIZE_URL);

        if (!$url) {
            writing_system_logs('Url error: [' . $error[116] . ' ]');
            return $error[$name] = 116;
        }

        $string = filter_var($url, FILTER_VALIDATE_URL);

        if (!$string) {
            writing_system_logs('Url error: [' . $error[117] . ' ]');
            return $error[$name] = 117;
        }
    }

    return $string;
}

function xss_protection($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function security($name, $method_post = 'POST')
{
    global $error;

    if ($method_post == 'POST') {
        $input = $_POST[$name];
    } elseif ($method_post == 'GET') {
        $input = $name != 'action' ? decrypt($_GET[$name]) : $_GET[$name];
    }

    
    $value = trim($input);

    $protected_string = xss_protection($value);

    $validated_input = $protected_string;
    
     if ($name == 'password') {
        if (!empty($error)) return;

        $validated_input = input_validation_and_sanitization($protected_string, $name);
        writing_system_logs('Validated input: [ ' . $validated_input . ' ]');
    }

   
    $conn = connect();

    $result = mysqli_real_escape_string($conn, $validated_input);

    mysqli_close($conn);
    writing_system_logs('DB connection closed');

    return $result;
}
