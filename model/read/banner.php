<?php

function get_all_banners(){
    $sql = "
        SELECT 
            *
        FROM 
            banner
        
        ORDER BY
            banner_date_created 
        DESC
    ";
    
    return select_rows($sql);
}

function get_banner_by_id($id)
{
    $sql = "
        SELECT
           *
        FROM 
            banner 
        WHERE 
            banner_id='$id' 
    ";
    
    return select_rows($sql)[0];
}