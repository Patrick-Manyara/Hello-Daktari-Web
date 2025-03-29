<?php

function get_brands($category_id='')
{
    $sql = "SELECT * FROM  brand  ";
    $category_id != '' ? $sql .= " WHERE category_id = '$category_id' " : " " ;
    $sql .= " ORDER BY brand_date_created DESC";
    return select_rows($sql);
}

function get_single_brand($brand_id)
{
    $sql = "
        SELECT 
            *
        FROM 
            brand
        WHERE
            brand_id = '$brand_id'
    ";

    return select_rows($sql)[0];
}