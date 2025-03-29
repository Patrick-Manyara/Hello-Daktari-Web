<?php
include_once 'update/create.php';
$_POST['message'] = encryptmessage($_POST['message'],"123!@#");
foreach($_POST as $key=>$val){
    $_POST[$key] = security($key);
}
$_POST['date_created'] = date("Y-m-d H:i:s");
build_sql_insert("messages",$_POST);