<?php
include_once "../path.php";

include_once('vendor/autoload.php');
include_once '../meeting/create_meeting.php';
$sql="select * from doc_category";
$row=select_rows($sql);
$m['category']=$row;
http_response_code(200);
echo json_encode($m);