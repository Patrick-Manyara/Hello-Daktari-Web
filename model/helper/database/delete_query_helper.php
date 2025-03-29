<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function delete($table, $id, $id_val) {
    global $error;
    
    $sql = "
        DELETE 
        FROM 
            `$table` 
        WHERE 
            $id = '$id_val'
    ";

    writing_system_logs('Prepairing delete query, SQL: [ ' . single_line_single_space_formatter($sql) . ' ]');
    
    $alt_connection = false;
    
    if (!insert_delete_edit($sql, $alt_connection)) {
        writing_system_logs('Error: [ ' . $error[103] . ' ]');
        return $error[] = 103;
    }
    
    writing_system_logs('Deletion done successfully');
    return true;
}