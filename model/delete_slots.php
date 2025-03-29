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
        $arr = ["mon","tue","wed","thu","fri","sat","sun"];
        foreach($arr as $day){
    $sql = "select * from weekly_schedule where day = '$day' and calendar_info_id = '$_POST[calendar_info_id]'"; 
    $row = select_rows($sql);
    if(!empty($row)){
        $i = 0;
        foreach($row as $key=>$value){
            if($i!=0){
                delete("weekly_schedule",$value['id']);
            }
        $i++;
        }
    }
        }
    
    $m['status'] = $_POST;
}
}
echo json_encode($m);