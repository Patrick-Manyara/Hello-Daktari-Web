<?php
include_once "../path.php";

include_once('vendor/autoload.php');
include_once '../meeting/create_meeting.php';
$m['post']=$_POST;
cout($_POST);
$user         = get_by_id('user', $_SESSION['user_id']);
cout($user);
// input_select_array("Select A Specialist", "doc_category_id", $row, true, $categories);
// cout(input_select_array("Select A Specialist", "doc_category_id", $row, true, $categories));