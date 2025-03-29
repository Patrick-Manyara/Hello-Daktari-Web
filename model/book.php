<?php
include_once 'create.php';
include_once 'create_meeting.php';
foreach ($_POST as $key => $val) {
    $_POST[$key] = security($key);
}

$con_id = $_POST['con_id'];
$sql = "SELECT * FROM consultation WHERE consultation_id = '$_POST[con_id]'";
$row = select_rows($sql);

if (!empty($row)) {
    unset($_POST['con_id']);
    $row = $row[0];
    
    $sql = "SELECT * FROM doctor WHERE doctor_id = '$row[doctor_id]'";
    $doc = select_rows($sql)[0];
    
    $sql = "SELECT * FROM user WHERE user_id = '$row[user_id]'";
    $user = select_rows($sql)[0];
   $message = "Hello,<br>
   Your booking has been recieved. Please wait for a few hours for your booking to be approved
   ";
    email($user['user_email'], "NEW SESSION", "LUNA", $message);
    build_sql_edit("consultation", $_POST, $row['consultation_id'], 'consultation_id');
    header("location:../consult/prescription_success?cid=".$con_id);
} else {
    echo "here";
    var_dump($_POST);
}
