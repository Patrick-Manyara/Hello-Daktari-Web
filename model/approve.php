<?php
require_once '../path.php';
require_once MODEL_PATH . "operations.php";

$id         = security('id', 'GET');
$table      = security('table', 'GET');
$column     = $table . '_id';
$status     = $table . '_activation';
$return_url = admin_url . security('page', 'GET');

$sql = "SELECT $status FROM $table WHERE $column = '$id' ";
$row = select_rows($sql)[0];

if ($row[$status] == 'activated') {
	$arr[$status] = 'deactivated';
} else {
	$arr[$status] = 'activated';
}

if (!build_sql_edit($table, $arr, $id, $column)) {
	$error[$table] = 149;
	error_checker($return_url);
}
$success[$table] = 221;
render_success($return_url);
