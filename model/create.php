<?php
include_once '../path.php';
include_once 'operations.php';
$arr = array();
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'property':
        create_property($arr);
        break;
    case 'fundraiser':
        create_fundraiser($arr);
        break;
    case 'login':
        get_user_login();
        break;
    case 'falsy':
        login_fallback(decrypt($_GET['email']));
        break;
    case 'inquiry':
        post_inquiry($arr);
        break;
    case 'reset':
        post_password_reset($arr);
        break;
}

function create_property(){
    $property_image = upload('property_image');
    if (!empty($property_image)) {
        isset($_SESSION['edit']) ? delete_file('property_image', 'property') : '';
        $arr['property_image'] = $property_image;
    }
    
   
    foreach ($_POST as $key => $value) {
        $arr[$key] = security($key);
    }

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        if (!build_sql_edit("property", $arr, decrypt($_SESSION['edit']))) {
            header('Location:../backoffice/view_properties?error');
            exit();
        }

        unset($_SESSION['edit']);
        header('Location:../backoffice/view_properties?suc');
        exit();
    } else {
        $arr['id'] = create_id('property', 'property_id');

        if (!build_sql_insert('property', $arr)) {
            header('Location:../backoffice/view_properties?error');
            exit();
        }
        
        
        header('Location:../backoffice/view_properties?success');
    }
}


function create_id($table, $id)
{
    $date_today = date('Ymd');

    $table_prifix = array(
        'USER'              => 'USR' . $date_today,
        'CART'              => 'CRT' . $date_today,
        'ADMIN'             => 'ADM' . $date_today,
        'ORDERS'            => 'ODR' . $date_today,
        'IMAGES'            => 'IMG' . $date_today,
        'BANNER'            => 'BNR' . $date_today,
        'INQUIRY'           => 'INQ' . $date_today,
        'COMMENT'           => 'CMT' . $date_today,
        'CATEGORY'          => 'CAT' . $date_today,
        'PRODUCT'           => 'PRD' . $date_today,
        'DELIVERY'          => 'DRY' . $date_today,
        'SUBORDER'          => 'SDR' . $date_today,
        'SUBCATEGORY'       => 'SBY' . $date_today,
        'SHIPPINGDETAIL'    => 'SDT' . $date_today,
        'ORDEREDPRODUCT'    => 'ODP' . $date_today,
        
        'property'           => 'APP' . $date_today,
    );

    $random_str = $table_prifix[$table] . rand_str();

    $get_id     = get_ids($table, $id, $random_str);

    while ($get_id == true) {
        $random_str = $table_prifix[$table] . rand_str();
        $get_id     = get_ids($table, $id, $random_str);
    }
    return $random_str;
}



function post_inquiry($arr)
{
    foreach ($_POST as $key => $value) {
        $arr[$key] = security($key);
    }

    if (!build_sql_insert('inquiry', $arr)) {
        header('Location:' . base_url . 'contact.php?error');
    } else {
        header('Location:' . base_url . 'contact.php?msg&name=' . $arr['name']);
    }
}

function create_user($arr){
     foreach ($_POST as $key => $value) {
        if ($key == 'email') {
            if (!empty(check_error('email', security($key)))) {
                header("location:../register?email");
                exit();
            }
        }

        if ($key == 'confirm_password') {
            unset($arr['confirm_password']);
        } elseif ($key == 'password') {
            $arr['password'] =  md5(security($key));
        } else {
            $arr[$key] = security($key);
        }
    }
     
    if(isset($_GET['user_type'])){
        $arr['user_type'] = 'fundraiser';
    }else{
        $arr['user_type'] = 'regular';
    }
    
    $arr['id']    = create_id('user', 'id');
    $new_id =  $arr['id'];
    
    if (!build_sql_insert('user', $arr)) { //IF NOT FUNCTION MEANS RUN THE FUNCTION FIRST THEN CHECK IF IT WAS SUCCESSFUL. IF IT WASNT, THROW AN ERROR
        header('Location:../register?error');
        exit();
    } 
    
    $name = "Tajiri Fundraiser";
    $htmlContent = file_get_contents("../email/uzuri.html");
    $subject = "Tajiri Fundraiser Sign Up";

  
    $body .= '<p style="font-family:Poppins, sans-serif; ">Success. Your account was created successfully.</p>';
    $body .= $htmlContent;

    email($arr['email'], $subject, $name, $body);
    
    $_SESSION['id']         = $arr['id'];
    $_SESSION['email']      = $arr['email'];
    $_SESSION['phone']      = $arr['phone_number'];
    $_SESSION['login']      = true;
    
    header("location:../register_success.php");
}

function post_password_reset($arr)
{
    $selector   = $arr['pwdResetSelector'] = bin2hex(random_bytes(8));
    $token      = random_bytes(32);

    $arr['pwdResetEmail']   = $email = security('email');
    $arr['pwdResetExpires'] = date("U") + 600;

    $url = base_url . "change-password?selector=" . $selector . "&validator=" . bin2hex($token);
    $failed_redirect = base_url . "forgot-password?reset=failed";

    if (empty(get_user_by_attribute('email', $email))) {
        header("Location:" . base_url . "forgot-password?reset=fail");
        exit();
    }
    
    if (!insert_delete_edit("delete from pwd_reset where pwdResetEmail = '$email'")) {
        header("Location: " . $failed_redirect);
        exit();
    }
    
    $arr['passwordResetId'] = create_id('pwd_reset', 'passwordResetId');
    $arr['pwdResetToken']   = password_hash($token, PASSWORD_DEFAULT);

    if (!build_sql_insert('pwd_reset', $arr)) {
        header("Location: " . $failed_redirect);
        exit();
    }

    $subject = "Hyghlyte V.I. reset password link";

    $reset = 'Reset Password';

    $message = '<p> We received a password reset request from your account. Use the link below to reset your password. 
                You can ignore this email if you did not make the request</p>';
    $message .= '<p>Click <a href="' . $url . '">Hyghlyte V.I. website</a> to reset your password.</p>';
    $message .= '</br><p> Thank you for your business. </br> Hyghlyte V.I. Management Team.</p>';

    $outcome = email($email, $subject, $reset, $message, true);
    
    if ($outcome == 'failed') {
        header("Location: " . $failed_redirect);
        exit();
    } 
    
    header("Location:" . base_url . "forgot-password?reset=success");
}

function delete_file($image, $table, $type = 'img')
{
    $path = file_url;

    $id = $_SESSION['edit'];
    $sql = "select $image from $table where id = '$id'";
    $row = select_rows($sql)[0];

    return unlink($path . $row[$image]);
}