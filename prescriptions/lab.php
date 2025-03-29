<?php
include_once "../path.php";
include_once "create.php";
require_once MODEL_PATH . "operations.php";

include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';


$action = $_GET['action'];

http_response_code(400);
$m['status'] = 0;

    $sql        = "SELECT * FROM lab ORDER BY lab_date_created DESC LIMIT 20";
    $rows    = select_rows($sql);

    $m['labs'] = $rows;
    
http_response_code(200);
$m['status'] = 1;
echo json_encode($m);
