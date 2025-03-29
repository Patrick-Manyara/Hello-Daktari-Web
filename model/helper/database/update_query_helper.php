<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function build_sql_edit($table, $elements, $id, $col = "id") {
    $sql = "
        UPDATE 
            `$table` 
        SET 
    ";
    
    $i = sizeof($elements);
    $j = 0;
    
    foreach ($elements as $key => $value) {
        $j++;
        if ($i != $j) {
            $sql .= "`$key`" . " = " . "'$value',";
        } else {
            $sql .=  "`$key`" . " = " . "'$value'";
        }
    }

    $sql .= "
        WHERE 
            `$col` = '$id'
    ";

    writing_system_logs('Updating data with single column dependancy..., SQL: [ ' . single_line_single_space_formatter($sql) . ' ]');
    return insert_delete_edit($sql);
}

function build_multiple_sql_edit($table, $elements, $id, $ids, $col = "id", $cols="") {
    $sql = "
        UPDATE 
            `$table` 
        SET 
    ";
    
    $i = sizeof($elements);
    $j = 0;
    
    foreach ($elements as $key => $value) {
        $j++;
        if ($i != $j) {
            $sql .= "`$key`" . " = " . "'$value',";
        } else {
            $sql .=  "`$key`" . " = " . "'$value'";
        }
    }

    $sql .= "
        WHERE 
            `$col` = '$id' 
        AND 
            `$cols` = '$ids'
    ";
    
    writing_system_logs('Updating data with multi column dependancy ..., SQL: [ ' . single_line_single_space_formatter($sql) . ' ]');
    return insert_delete_edit($sql);
}