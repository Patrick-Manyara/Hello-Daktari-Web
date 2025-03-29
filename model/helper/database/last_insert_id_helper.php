<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function last_insert_id($sql) {
    global $error;
    
    $conn = connect();
    
    if (mysqli_query($conn, $sql)) {
        
        $result = mysqli_insert_id($conn);
        
        mysqli_close($conn);
        writing_system_logs('DB connection closed');
        writing_system_logs('ID returned: [ ' . $result . ' ]');
    
        return $result;
    }

    writing_system_logs('DB operation returned an error: [ ' . mysqli_error($conn) . ' ]');
    mysqli_close($conn);
    writing_system_logs('DB connection closed with after script returned error: [ ' . $error[105] . ' ]');
    
    return $error[] = 105;
}