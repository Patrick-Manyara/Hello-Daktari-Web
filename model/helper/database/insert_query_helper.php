<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function build_sql_insert($table, $elements, $last_insert_id = false) {
    $sql = "
        INSERT 
        INTO 
            `$table` 
        ( 
    ";
    
    $i = sizeof($elements);
    $j = 0;
    
    foreach ($elements as $key => $value) {
        $j++;
        if ($i != $j) {
            $sql .= "`$key`" . ",";
        } else {
            $sql .=  "`$key`";
        }
    }
    
    $j = 0;
    
    $sql .= "
        ) 
            VALUES 
        (
    ";
    
    foreach ($elements as $value) {
        $j++;
        if ($i != $j) {
            $sql .= "'$value'" . ",";
        } else {
            $sql .= "'$value'";
        }
    }
    
    $sql .= ")";

    writing_system_logs('Prepairing insert query, SQL: [ ' . single_line_single_space_formatter($sql) . ' ]');
    
    if($last_insert_id) {
        writing_system_logs('Insert ID requested');
        return last_insert_id($sql);
    }
    
    return insert_delete_edit($sql);
}