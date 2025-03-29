<?php

function get_ids($table, $id, $random_str)
{
    $sql = "
        SELECT 
            $id 
        FROM 
            `$table`
    ";
    
    $result = select_rows($sql);
    
    foreach ($result as $existing_id) {
        $id_exists = false;
        
        if ($existing_id[$id] == $random_str) {
            $id_exists = true;
            break;
        }
    }
    
    return $id_exists;
}