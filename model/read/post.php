<?php
function get_all_posts($mid = '')
{
    $sql = "SELECT * FROM post ";
    $mid != '' ? $sql .= " WHERE manager_id = '$mid' " : '';
    $sql .= " ORDER BY post_date_created DESC";
    return select_rows($sql);
}

function get_all_posts_front_end($mid = '',$limit = '')
{
    $sql = "SELECT * FROM post ";
    $mid != '' ? $sql .= " WHERE manager_id = '$mid' " : '';
    $sql .= " ORDER BY post_date_created DESC ";
    $limit != '' ? $sql .= "  LIMIT $limit " : " LIMIT 3";

    return select_rows($sql);
}

function get_all_posts_page($mid = '')
{
    $sql = "SELECT * FROM post ";
    $sql .= " ORDER BY post_date_created DESC";

    return select_rows($sql);
}

function get_posts_by_category($cid)
{
    $sql = "SELECT post.*, category.category_name AS cname FROM post  
            JOIN category ON category.category_id = post.category_id 
            WHERE category.category_id = '$cid' LIMIT 3";
    return select_rows($sql);
}

function get_post_by_id($id)
{
    $sql = "SELECT * FROM post WHERE post_id = '$id' ";
    return select_rows($sql)[0];
}

function get_post_comments($id)
{
    $sql = "SELECT comment.*, post.manager_id FROM comment ";
    $sql .= " JOIN post on post.post_id = comment.post_id ";
    $sql .= " WHERE comment.post_id  = '$id' ORDER BY comment.comment_date_created DESC";
    return select_rows($sql);
}

function get_comment_likes($cid, $uid = '')
{
    $sql = "SELECT * FROM likes WHERE comment_id = '$cid' ";
    $uid != '' ? $sql .= " AND user_id = '$uid' "  : '';
    return select_rows($sql);
}

function get_reply_from_comments($cid)
{
    $sql = "SELECT * FROM reply WHERE comment_id = '$cid'";
    return select_rows($sql);
}


function get_post_comments_count($id)
{
    $sql = "SELECT comment.*, post.manager_id FROM comment ";
    $sql .= " JOIN post on post.post_id = comment.post_id ";
    $sql .= " WHERE comment.post_id  = '$id' ORDER BY comment.comment_date_created DESC";
    return sql_counter($sql);
}

function get_reading_list()
{
    $sql = "SELECT post.* , comment.comment_text , COUNT(*) as count
FROM comment
JOIN post ON post.post_id = comment.post_id
JOIN likes ON likes.comment_id = comment.comment_id
GROUP BY comment.post_id 
ORDER BY count DESC
LIMIT 3
";
    return select_rows($sql);
}

function get_reading_list2()
{
    $sql = "SELECT * FROM post  ";
    $sql .= " ORDER BY post_date_created DESC  LIMIT 3 ";
    return select_rows($sql);
}
