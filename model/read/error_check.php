<?php

function check_error($col, $col_val, $table = 'USER')
{
    $sql = "
        SELECT 
            $col 
        FROM 
            $table 
        WHERE 
            $col='$col_val'
    ";
    
    return select_rows($sql);
}