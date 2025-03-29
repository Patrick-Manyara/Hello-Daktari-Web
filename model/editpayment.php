<?php
include_once 'update/create.php';
include_once 'create_meeting.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$arr['payment_status'] = 'paid';

	if (!build_sql_edit('consultation', $arr, $id, 'consultation_id')) {
		$error['consultation'] = 133;
		error_checker($return_url);
	}


	$sql = "SELECT * FROM consultation WHERE consultation_id = '$_GET[id]'";
	$row = select_rows($sql);

	if (!empty($row)) {
		
		$row = $row[0];

		$sql = "SELECT * FROM doctor WHERE doctor_id = '$row[doctor_id]'";
		$doc = select_rows($sql)[0];

		$sql = "SELECT * FROM user WHERE user_id = '$row[user_id]'";
		$user = select_rows($sql)[0];
		if (strpos($row['price_chosen'], "video") !== false) {
			
			$time = $row['date'] . "T" . $row['time'] . "Z";
			$name = $doc['doctor_name'] . " and " . $user['user_name'];

			$link = create_meeting($time, $name)->join_url;
			$link = "<a href = '" . $link . "'>
    " . $link . "
    </a>";


			$message = "
    <p style='font-family:Poppins, sans-serif;'>
    Hello, <br><br>You have succesfully scheduled a session with doctor " . $doc['doctor_name'] . ", These are your details </p>
    <br>
    <ul>
    <li><b>Date: </b>" . $row['date'] . "</li>
    <li><b>Time: </b>" . $row['time'] . "</li>
    <li><b>Link: </b>" . $link . "</li>
    <ul>
    ";
    $m = "";
    if($row['consultation_urgent'] == "yes"){
        $m = "<h4 style = 'color:red'>This is an urgent request</h4>";
    }
			$message2 = "
    <p style='font-family:Poppins, sans-serif;'>
    ".$m."
    Hello, <br><br>You have a new session with a client : " . $user['user_name'] . ", These are your details </p>
    <br>
    <ul>
    <li><b>Date: " . $row['date'] . "</li>
    <li><b>Time: " . $row['time'] . "</li>
    <li><b>Link: " . $link . "</li>
    <ul>
    ";


			email($user['user_email'], "NEW SESSION", "LUNA", $message);
			email($doc['doctor_email'], "NEW SESSION", "LUNA", $message2);
		}
		if (strpos($row['price_chosen'], "chat") !== false) {
			
			$linka = "<a href = 'https://lunahealth.co/consult/chat_send.php?sender_token=" . $user['user_id'] . "&reciever_token=" . $doc['doctor_id'] . "'>
    https://lunahealth.co/consult/chat_send.php?sender_token=" . $user['user_id'] . "&reciever_token=" . $doc['doctor_id'] . "
    </a>";
			$linkb = "<a href = 'https://lunahealth.co/consult/chat_send.php?sender_token=" . $doc['doctor_id'] . "&reciever_token=" . $user['user_id'] . "'>
    https://lunahealth.co/consult/chat_send.php?sender_token=" . $doc['doctor_id'] . "&reciever_token=" . $user['user_id'] . "
    </a>";

			$message = "<p style='font-family:Poppins, sans-serif; '>
    Hello, <br><br>You have succesfully scheduled a session with doctor " . $doc['doctor_name'] . ", These are your details </p>
    <br>
    <ul>
    <li><b>Date: </b>" . $row['date'] . "</li>
    <li><b>Time: </b>" . $row['time'] . "</li>
    <li><b>Link: </b>" . $linka . "</li>
    <ul>
    ";
    $m = "";
    if($row['consultation_urgent'] == "yes"){
        $m = "<h4 style = 'color:red'>This is an urgent request</h4>";
    }
			$message2 = "<p style='font-family:Poppins, sans-serif;'>
			".$m."
    Hello, <br><br>You have a new chat session with a client : " . $user['user_name'] . ", These are your details </p>
    <br>
    <ul>
    <li><b>Date: </b>" . $row['date'] . "</li>
    <li><b>Time: </b>" . $row['time'] . "</li>
    <li><b>Link: </b>" . $linkb . "</li>
    <ul>
    ";

			email($user['user_email'], "NEW SESSION", "LUNA", $message);
			email($doc['doctor_email'], "NEW SESSION", "LUNA", $message2);
		}
		else{
		    $message = "
		    <p>
		    hello, <br>
		    You have a call with Dr. ".$doc['doctor_name']."
		    <br>
		    The doctor will call you at ".$user['user_phone']."
		    </p>
		    ";
		    $m = "";
    if($row['consultation_urgent'] == "yes"){
        $m = "<h4 style = 'color:red'>This is an urgent request</h4>";
    }
		    $message2 = "
		    <p>
		    ".$m."
		    Hello,<br> you have a call with client ".$user['user_name']."
		    <br>Please call him/her at ".$user['user_phone']."
		    </p>
		    <p>Other details</p>
		    <ul>
    <li><b>Date: " . $row['date'] . "</li>
    <li><b>Time: " . $row['time'] . "</li>
    <ul>
		    ";
		    
		    email($user['user_email'], "NEW SESSION", "LUNA", $message);
			email($doc['doctor_email'], "NEW SESSION", "LUNA", $message2);
		}

		
		header("location:../backoffice/view_bookings.php");
	} else {
		echo "here";
		var_dump($_POST);
	}
}
