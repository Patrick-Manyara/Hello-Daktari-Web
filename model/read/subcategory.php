<?php

function get_subcategories($category_id='')
{
    $sql = "SELECT * FROM  subcategory  ";
    $category_id != '' ? $sql .= " WHERE category_id = '$category_id' " : " " ;
    $sql .= " ORDER BY subcategory_date_created DESC";
    return select_rows($sql);
}

function get_single_sub_category($subcategory_id)
{
    $sql = "
        SELECT 
            *
        FROM 
            subcategory
        WHERE
            subcategory_id = '$subcategory_id'
    ";

    return select_rows($sql)[0];
}