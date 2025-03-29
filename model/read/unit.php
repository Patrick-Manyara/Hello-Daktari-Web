<?php

function get_units()
{
    $sql = "
        SELECT 
            *
        FROM 
            unit
        ORDER BY
            unit_date_created
        DESC
    ";

    return select_rows($sql);
}

function get_single_unit($unit_id)
{
    $sql = "
        SELECT 
            *
        FROM 
            unit
        WHERE
            unit_id =  '$unit_id'
        
    ";

    return select_rows($sql)[0];
}