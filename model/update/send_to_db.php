<?php
require_once 'create.php';


$conn   = connect();
$data   = 0;

// cout($_POST);
$Email  = mysqli_real_escape_string($conn, $_POST['email']);
$Phone  = mysqli_real_escape_string($conn, $_POST['phone']);
$Name   = mysqli_real_escape_string($conn, $_POST['full_name']);
$Kra    = mysqli_real_escape_string($conn, $_POST['user_kra']);
$Dob    = mysqli_real_escape_string($conn, $_POST['user_dob']);
$Gender = mysqli_real_escape_string($conn, $_POST['user_gender']);

$sql    = "SELECT * FROM policy WHERE device_id = '$_COOKIE[device]' ORDER BY policy_date_created DESC ";
$policy = select_rows($sql)[0];

$sql    = "SELECT * FROM user WHERE user_email = '$Email' ";
$row    = select_rows($sql)[0];
if (!empty($row)) {
    $user_id = $row['user_id'];
} else {
    $array  = array(
        'user_email'        => $Email,
        'user_name'         => $Name,
        'user_kra'          => $Kra,
        'user_phone'        => $Phone,
        'user_gender'       => $Gender,
        'user_dob'          => $Dob,
    );
    if (!empty($_FILES['national']['name'])) $array['user_passport']   = upload_docs('national');

    $user_id = $array['user_id']   = create_id('user', 'user_id');
    $array['user_password']   = password_hashing_hybrid_maker_checker('1234');

    if (!build_sql_insert('user', $array)) {
        $error['user'] = 139;
        error_checker($return_url);
    }
    
    $name       = APP_NAME;
    $subject    = APP_NAME . " Sign Up";


    $body       = '<p style="font-family:Poppins, sans-serif; ">Welcome to ' . APP_NAME . ' ' . $array['user_name'] . '  <br>';
    $body       .= 'We are so happy you have signed up.  <br>';
    $body       .= '<br><br>You may log in to your account <a href="' . base_url . '" style="cursor:pointer;"><b> BY CLICKING HERE </b></a>';
    $body       .= '</p>';
    $body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> JamboSure Management</p>';

    $body2      = '<p style="font-family:Poppins, sans-serif; ">A new user has signed up to ' . APP_NAME . ' with the details: <br> <b>USERNAME: </b> ' . $array['user_name'] . ' <br>';
    $body2      .= ' <b>EMAIL: </b> ' . $array['user_email'] . ' <br> ';
    $body2      .= '</p>';

    email($array['user_email'], $subject, $name, $body);

    $session_login  = array(
        'user_login'        => true,
        'user_email'        => $Email,
        'user_name'         => $array['user_name'],
        'user_id'           => $array['user_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);
}



$arr['vehicle_reg']     = mysqli_real_escape_string($conn, $_POST['vehicle_reg']);
$arr['vehicle_make']    = mysqli_real_escape_string($conn, $_POST['vehicle_make']);
$arr['vehicle_model']   = mysqli_real_escape_string($conn, $_POST['vehicle_model']);
$arr['vehicle_year']    = mysqli_real_escape_string($conn, $_POST['vehicle_year']);
$arr['vehicle_value']   = $policy['policy_value'];
$arr['vehicle_chasis']  = mysqli_real_escape_string($conn, $_POST['vehicle_chasis']);


if (!empty($_FILES['logbook']['name'])) $arr['vehicle_logbook']   = upload_docs('logbook');


$arr['vehicle_id']  = create_id('vehicle', 'vehicle_id');
$arr['user_id']     = $user_id;

build_sql_insert('vehicle', $arr);


$arr2['policy_price']   = mysqli_real_escape_string($conn, $_POST['newPrice']);;
$arr2['user_id']        = $user_id;
build_sql_edit('policy', $arr2, $policy['policy_id'], 'policy_id');

$data = 1;

$rand = rand(100000, 999999);

$arr = array(
    "data"      => $data,
    "rand"      => $rand,
    "email"     => $Email,
    "amount"    => '1',
    "phone"     => $Phone,
    "bid"       => encrypt($policy['policy_id'])
);

echo json_encode($arr);
