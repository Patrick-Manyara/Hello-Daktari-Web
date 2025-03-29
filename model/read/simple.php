<?php

function get_all($table)
{
    $sql = "
       SELECT 
            *
        FROM 
            $table
     
        ORDER BY
            ".$table."_date_created
        DESC
    ";

    return select_rows($sql);
}

function get_by_id($table,$item_id)
{
    $sql = "
       SELECT 
            *
        FROM 
            $table
     
       WHERE ".$table."_id = '$item_id'
    ";

    return select_rows($sql)[0];
    // echo $sql;
}