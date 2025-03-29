<?php
require_once '../../path.php';
require_once MODEL_PATH . "operations.php";

$id         = security('id', 'GET');
$table      = security('table', 'GET');
$column     = $table . '_id';
$method     = $_GET['method'];

if ($method == 'simple_admin') {
    $return_url = admin_url . security('page', 'GET');
    if (!delete($table, $column,  $id)) {
        $error['delete'] = 144;
        error_checker($return_url);
    }
    $success['delete'] = 212;
    render_success($return_url);
}

if ($method == 'simple_doctor') {
    $return_url = doctor_url . security('page', 'GET');
    if (!delete($table, $column,  $id)) {
        $error['delete'] = 144;
        error_checker($return_url);
    }
    $success['delete'] = 212;
    render_success($return_url);
}


if ($method == 'doctor') {
    $return_url = admin_url . security('page', 'GET');
	delete_files('doctor_image', 'doctor', 'doctor_id', $id);
	if (!delete($table, $column,  $id)) {
		$error['delete'] = 144;
		error_checker($return_url);
	}

	$success['delete'] = 212;
	render_success($return_url);
}

if ($method == 'user') {
    $return_url = admin_url . security('page', 'GET');
	delete_files('user_image', 'user', 'user_id', $id);
	if (!delete($table, $column,  $id)) {
		$error['delete'] = 144;
		error_checker($return_url);
	}

	$success['delete'] = 212;
	render_success($return_url);
}


function delete_files($image, $table, $id_name, $id_value)
{

	$sql = "select $image from $table where $id_name = '$id_value'";
	$row = select_rows($sql)[0];

	return unlink(TARGET_DIR  . 'images/' . $row[$image]);
}