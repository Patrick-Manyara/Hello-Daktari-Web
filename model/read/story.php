<?php
function get_stories()
{
    $sql = " SELECT  * FROM  story WHERE story_is_reply = 'no' " ;
    $sql .= " ORDER BY story_date_created DESC ";
    return select_rows($sql);
}

function get_story_replies($id)
{
    $sql = " SELECT  * FROM  story WHERE story_is_reply = 'yes' AND story_original_id = '$id' " ;
    $sql .= " ORDER BY story_date_created ASC ";
    return select_rows($sql);
}

function get_stories_ajax($start='', $limit = '')
{
    $sql = " SELECT  * FROM  story WHERE story_is_reply = 'no' " ;
    $sql .= " ORDER BY story_date_created DESC ";
    $limit != '' ? $sql .= " LIMIT $limit OFFSET $start " : " ";
    return select_rows($sql);
}

function get_single_story($id)
{
    $sql = " SELECT  * FROM  story WHERE story_id = '$id' " ;
    return select_rows($sql)[0];
}

function get_total_likes($id)
{
    $sql = " SELECT  * FROM  story_likes WHERE story_id = '$id' " ;
    return sql_counter($sql);
}

function get_my_likes($id)
{
    $sql = "SELECT  * FROM  story_likes WHERE story_id = '$id' AND user_id = '$_SESSION[user_id]' " ;
    return select_rows($sql);
}