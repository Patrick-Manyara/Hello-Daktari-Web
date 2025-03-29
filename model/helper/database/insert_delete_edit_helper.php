<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function insert_delete_edit($sql, $alt_connection = false) {
    global $error;

    if(!$alt_connection) {
        $conn = connect();
    } else {
        writing_system_logs('Connecting DB with more priviledged user');
        $conn = connect();
    }     
    
    if (mysqli_query($conn, $sql)) {

        writing_system_logs('Number of affected rows: [ ' . mysqli_affected_rows($conn) . ' ]');
        mysqli_close($conn);
        writing_system_logs('DB connection closed');
    
        return true;
    }
    
    echo mysqli_error($conn);
    
    writing_system_logs('DB operation returned an error: [ ' . mysqli_error($conn) . ' ]');

    mysqli_close($conn);
    writing_system_logs('DB connection closed with after script returned error: [ ' . $error[104] . ' ]');
    
    return $error[] = 104;
}