<?php
error_reporting(E_ALL ^ E_WARNING);
include_once 'path.php';
require_once MODEL_PATH . 'operations.php';

if (!empty($_POST["email"])) {
    echo available('user_email', 'Email');
}


function available($attr, $text)
{
    $sql = "SELECT * FROM user WHERE user_email = '$_POST[email]' ";
    $attribute_availability = select_rows($sql)[0];

    if (!empty($attribute_availability)) {
        echo "<span style='color:red'> " . $text . " already exists .</span>";
        echo "<script>$('#progress-next').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> " . $text . " available for Registration .</span>";
        echo "<script>$('#progress-next').prop('disabled',false);</script>";
    }
}

if (!empty(security("doctor_email"))) {
    echo doctor_available('doctor_email', 'Email');
}


function doctor_available($attr, $text)
{
    $attribute_availability = get_doctor(security("doctor_email"));

    if (!empty($attribute_availability)) {
        echo "<span style='color:red'> " . $text . " already exists .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> " . $text . " available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}