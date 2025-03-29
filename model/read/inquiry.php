<?php

function get_inquiry($date = null)
{
    $sql = "
        SELECT 
            name,
            email,
            message,
            feedback,
            inquiryId,
            inquiryStatus
        FROM 
            INQUIRY
        WHERE
            inquiryStatus != 'deleted'
    ";

    if ($date != null) $sql .= "AND dateCreated >= '$date'";

    $sql .= "
        ORDER BY
            dateCreated
        DESC
    ";

    return select_rows($sql);
}


function get_specific_inquiry($inquiry_id)
{
    $sql = "
        SELECT 
            email,
            message,
            feedback,
            inquiryId
        FROM 
            INQUIRY
        WHERE
            inquiryId = '$inquiry_id'
        AND
            inquiryStatus != 'deleted'
    ";

    return select_rows($sql)[0];
}