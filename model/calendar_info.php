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
        $r = $r[0];
        $_POST['tid'] = $r['doctor_id'];
        $sql = "select * from calendar_info where tid = '$_POST[tid]' order by id desc";
        $r = select_rows($sql);
        if(!empty($r)){
            $_POST['id'] = $r[0]['id'];
        }
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        unset($_POST['id']);
        build_sql_edit("calendar_info",$_POST,$id);
    }else{
        build_sql_insert("calendar_info",$_POST);
    }
    $m['status'] = 1;
}
}
echo json_encode($m);