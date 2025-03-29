<?php
require_once "operations2.php";
$m = array("status"=>0);
if(isset($_POST['token'])){
    foreach($_POST as $key=>$value){
        $_POST[$key] = security($key);
    }
    $token = $_POST['token'];
    $sql = "select * from doctor where doctor_id = '$token'";
    $r = select_rows($sql);
    unset($_POST['token']);
    if(!empty($r)){
    build_sql_insert("weekly_schedule",$_POST);
    $sql = "select * from weekly_schedule order by id desc";
    $no = select_rows($sql)[0]['id'];
    echo $no;
}
}
