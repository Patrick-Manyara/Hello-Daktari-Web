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
    $id = $_POST['id'];
    unset($_POST['id']);
    delete("weekly_schedule",$id);
    $m['status'] = $_POST;
}
}
echo json_encode($m);