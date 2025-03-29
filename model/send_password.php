<?php
require_once "operations.php";

$email = security("email");
$sql = "select * from user where email = '$email'";
$row = select_rows($sql);
if(!empty($row)){
    $row = $row[0];
    $password = rand(1000,9000);
    $arr['password'] = md5($password);
    build_sql_edit("user",$arr,$row['id']);
    email($email, "CREDENTIALS", "PSYCHX", 
    "Hello,
    This is your new password".$password);
    header("location:../login.php?check_email");
}else{
 header("location:../verify_email.php?false2");   
}