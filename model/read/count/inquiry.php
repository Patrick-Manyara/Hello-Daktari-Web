<?php

function get_inquiry_count($date = null)
{
    $sql = "
        SELECT
            inquiryId
        FROM 
            INQUIRY 
        WHERE
            inquiryStatus = 'active' 
    ";

    if($date != null) $sql .= "AND dateCreated >= '$date'";

    return sql_counter($sql);
}