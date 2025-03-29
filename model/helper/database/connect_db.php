<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function connect($db_username = DB_USERNAME, $db_password = DB_PASSWORD, $db_host = DB_HOST, $db_name = DB_NAME)
{
    writing_system_logs('Trying Database connection...');

    $connection =  mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if (mysqli_connect_errno()) {
        $db_rror_msg = 'Database responded with [ ' . mysqli_connect_errno()  . ' ]';
        writing_system_logs($db_rror_msg, "500", "Internal Server Error");
    }

    writing_system_logs('Database connection successfull');
    return $connection;
}