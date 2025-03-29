<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function select_rows($sql) {
    
    $conn = connect();
    
    $res = mysqli_query($conn, $sql);

    if(!$res) {
        mysqli_close($conn);
        return null;
    }

    $result = array();
    
    while ($row = $res->fetch_assoc()) {
        $result[] = $row;
    }


    mysqli_free_result($res);

    
    mysqli_close($conn);
    
    return $result;
}