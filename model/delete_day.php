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
    $sql = "delete from weekly_schedule where day = '$_POST[day]' and calendar_info_id = '$_POST[calendar_info_id]'";
    insert_delete_edit($sql);
    $m['status'] = 1;
}
}
echo json_encode($m);