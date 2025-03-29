<?php
$page = 'home';
include_once 'header.php';


$sql = "SELECT * FROM session WHERE client_id = '$_SESSION[user_id]' ORDER BY session_date_created DESC ";
$row = select_rows($sql)[0];

if (isset($_GET['did'])) {
    $did = $_GET['did'];
} else {
    $did = $row['doctor_id'];
}

$arr['doctor_id'] = $did;

$arr['session_payment_method']  = 'JamboPay';
$arr['session_payment_status']  = 'paid';

if (!build_sql_edit('session', $arr, $row['session_id'], 'session_id')) {
    $error['session'] = 133;
    error_checker($return_url);
}

$user       = get_by_id('user', $row['client_id']);
$doctor     = get_by_id('doctor', $did);



if ($row['session_channel'] == 'message') {
    $message    = 'The user chose to have a chat with you. At the specified <b>SESSION DATE</b> and <b>START TIME</b>';
    $message    .= 'click <a href="' . base_url . 'chat?sender_token=' . $did . '&reciever_token=' . $row['client_id'] . '"> HERE </a> ';

    $message1   = 'You chose to have a chat with the specialist. At the specified <b>SESSION DATE</b> and <b>START TIME</b>';
    $message1   .= 'click <a href="' . base_url . 'chat?reciever_token=' . $did . '&sender_token=' . $row['client_id'] . '"> HERE </a> ';
}




$name       = APP_NAME;
$subject    = APP_NAME . " Session Booking";


$body       = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $user['user_name'] . '  <br>';
$body       .= 'Your session has been successfully logged.  <br>';
$body       .= ' <b>CODE: </b> ' . $row['session_code'] . ' <br> ';
$body       .= ' <b>DOCTOR: </b> ' . $doctor['doctor_name'] . ' <br> ';
$body       .= ' <b>DATE: </b> ' . $row['session_date'] . ' <br> ';
$body       .= ' <b>START TIME: </b> ' . $row['session_start_time'] . ' <br> ';
$body       .= ' <b>END TIME: </b> ' . $row['session_end_time'] . ' <br> ';
$body       .= ' <b>MODE: </b> ' . ucwords($row['session_mode']) . ' <br> ';
$body       .= $message1;
$body       .= '<br><br>You may log in to your account <a href="' . $login_url . '" style="cursor:pointer;"><b> BY CLICKING HERE </b></a>';
$body       .= '</p>';
$body       .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';


$body2      = '<p style="font-family:Poppins, sans-serif; ">Hello, ' . $doctor['doctor_name'] . '  <br>';
$body2      .= 'You have a new session.  <br>';
$body2      .= ' <b>CODE: </b> ' . $row['session_code'] . ' <br> ';
$body2      .= ' <b>CLIENT: </b> ' . $user['user_name'] . ' <br> ';
$body2      .= ' <b>DATE: </b> ' . $row['session_date'] . ' <br> ';
$body2      .= ' <b>START TIME: </b> ' . $row['session_start_time'] . ' <br> ';
$body2      .= ' <b>END TIME: </b> ' . $row['session_end_time'] . ' <br> ';
$body2      .= ' <b>MODE: </b> ' . ucwords($row['session_mode']) . ' <br> ';
$body2       .= $message;
$body2      .= '<br><br>You may log in to your account <a href="' . $doc_url . '" style="cursor:pointer;"><b> BY CLICKING HERE </b></a>';
$body2      .= '</p>';
$body2      .= '<p style="font-family:Poppins, sans-serif; ">Yours,<br> ' . APP_NAME . ' Management</p>';

email($user['user_email'], $subject, $name, $body);
email($doctor['doctor_email'], $subject, $name, $body2);

$msg = "Your session was successfully booked. Check your email for more details";
send_sms($user['user_phone'],$msg);
?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home</a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Session Success</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div class="row">
            <p>Hello, <?php echo $user['user_name']; ?><br>
    Your session has been successfully logged.</p>
    
    <table>
        <tr>
            <th>Detail</th>
            <th>Information</th>
        </tr>
        <tr>
            <td><b>CODE:</b></td>
            <td><?php echo $row['session_code']; ?></td>
        </tr>
        <tr>
            <td><b>DOCTOR:</b></td>
            <td><?php echo $doctor['doctor_name']; ?></td>
        </tr>
        <tr>
            <td><b>DATE:</b></td>
            <td><?php echo $row['session_date']; ?></td>
        </tr>
        <tr>
            <td><b>START TIME:</b></td>
            <td><?php echo $row['session_start_time']; ?></td>
        </tr>
        <tr>
            <td><b>END TIME:</b></td>
            <td><?php echo $row['session_end_time']; ?></td>
        </tr>
        <tr>
            <td><b>MODE:</b></td>
            <td><?php echo ucwords($row['session_mode']); ?></td>
        </tr>
    </table>
    

</section>
<!--====== Contact Info Section End ======-->

<style>
    .form-check-input {
        height: 1em;
        position: inherit;
        width: auto;
        margin: 0em 1em;
    }

    .ShippingArea {}

    .SingleShipping {
        margin: 2em 0em;
        border-radius: 2px;
        border-bottom: 1px solid #D1D1D8;
    }

    .TransInput {
        border: none;
    }

    .MySpan {
        font-size: 0.8em;
        font-style: normal;
        font-weight: 200;
    }

    .Remove {
        color: #E14B4B;
    }
    
    
    
    table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
</style>

<?php
include_once 'footer.php';
?>