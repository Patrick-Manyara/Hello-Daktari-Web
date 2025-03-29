<?php
include_once "../path.php";
include_once "create.php";

include_once('../model/vendor/autoload.php');
include_once '../meeting/create_meeting.php';

http_response_code(400);
$m['status'] = 0;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pageSize = isset($_GET['pageSize']) ? intval($_GET['pageSize']) : 5;

$sql = "SELECT * FROM labs ORDER BY lab_name ASC LIMIT " . ($currentPage - 1) * $pageSize . ", " . $pageSize;
$rows = select_rows($sql);

$m['labs'] = $rows;

http_response_code(200);
$m['status'] = 1;
echo json_encode($m);

    
