<?php
include_once "../path.php";
include_once "create.php";


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

switch ($action) {
    case 'all':
        $m = get_api_forums();
        break;
    case 'comments':
        $m = get_api_comments();
        break;
    case 'add_comment':
        $m = api_add_comment();
        break;
    case 'add_forum':
        $m = api_add_forum();
        break;
}

function get_api_forums()
{
    $sql = "
      SELECT
        forum.*,
        user.user_name,
        user.user_id,
        user.user_image,
        COUNT(comment.forum_id) AS comment_count
      FROM
        forum
      JOIN
        user ON user.user_id = forum.user_id
      LEFT JOIN
        comment ON comment.forum_id = forum.forum_id
      WHERE
        forum.forum_status = 'active'
      GROUP BY
        forum.forum_id
      ORDER BY
        forum.forum_date_created DESC;
    ";

    $row = select_rows($sql);
    
    
    $sql2        = "SELECT * FROM doctor WHERE doctor_status = 'active' ORDER BY RAND()";
    $doctors    = select_rows($sql2);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['forums'] = $row;
        $m['doctors'] = $doctors;
    } else {
        $m['message'] = "Something went wrong";
    }

    return $m;
}

function get_api_comments()
{
    $sql = "SELECT comment.*,  user.user_name, user.user_id, user.user_image FROM comment JOIN user ON user.user_id = comment.user_id WHERE comment.comment_status = 'active' AND comment.forum_id = '$_GET[forum_id]'  ORDER BY comment.comment_date_created DESC;";
    $row = select_rows($sql);

    if (!empty($row)) {
        $m['status'] = 1;
        $m['comments'] = $row;
    } else {
        $m['message'] = "Something went wrong";
    }
    $m['status'] = 1;
    return $m;
}

function api_add_comment()
{
    // $m['POST'] = $_POST;
    $arr = array(
        'comment_id'    => create_id('comment', 'comment_id'),
        'comment_code'  => 'COMMENT-' . generateRandomString('5'),
        'comment_text'  => security('comment_text'),
        'forum_id'      => security('forum_id'),
        'user_id'       => security('user_id')
    );
    
      if(isset($_POST['tagged_doctor'])){
        $arr['tagged_doctor'] = security('tagged_doctor');
        $arr['doctor_name'] = security('doctor_name');
    }
    
    
    if (!build_sql_insert('comment', $arr)) {
        $m['message']   = "Something went wrong";
        $m['data']      = false;
    }

    $user = get_by_id('user', security('commenter'));

    if ($user['user_id'] != security('commenter')) {
        $name       = APP_NAME;
        $subject    = APP_NAME . " Patient Forum";

        $body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
        $body       .= 'You have a new comment on your post on the Hello Daktari Patient Forum.  <br>';

        $body       .= '</p>';
        $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';


        email($user['user_email'], $subject, $name, $body);
    }

    $m['status'] = 1;
    return $m;
}

function api_add_forum()
{
    // $m['POST'] = $_POST;
    $arr = array(
        'forum_id'      => create_id('forum', 'forum_id'),
        'forum_code'    => 'HELLOFORUM-' . generateRandomString('5'),
        'forum_text'    => security('forum_text'),
        'forum_title'   => security('forum_title'),
        'user_id'       => security('user_id')
    );
    
    if(isset($_POST['tagged_doctor'])){
        $arr['tagged_doctor'] = security('tagged_doctor');
        $arr['doctor_name'] = security('doctor_name');
    }
    
    if (!build_sql_insert('forum', $arr)) {
        $m['message']   = "Something went wrong";
        $m['data']      = false;
    }



    $m['status'] = 1;
    return $m;
}


http_response_code(200);

echo json_encode($m);
