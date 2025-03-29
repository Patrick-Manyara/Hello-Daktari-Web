<?php
include_once 'create.php';
foreach ($_POST as $key => $val) {
    $_POST[$key] = security($key);
}
build_sql_edit("payment_instructions",$_POST,"1","id");
header("location:../backoffice/edit_instruction.php");