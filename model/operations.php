<?php
define('auth', true);
define('CORE_PATH', realpath(dirname(__FILE__)) . '/');

require_once 'helper/logs.php';
require_once 'constants.php';
require_once 'app_header.php';

if (session_status() == PHP_SESSION_NONE) {

    session_name('JSESSIONID');

    session_start();
    // session_regenerate_id(true);

    if (isset($_SESSION['session_ip']) === false) {
        $_SESSION['session_ip'] = $_SERVER['REMOTE_ADDR'];
    }
    
    writing_system_logs("Session started for: [ " . json_encode($_SESSION) . ' ]');
}

$error      = array();
$success    = array();
$warning    = array();

require_once 'user_data/index.php';
require_once 'helper/index.php';

if ((($_SESSION['session_ip'] !== $_SERVER['REMOTE_ADDR']) ||
    (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))))) {
    writing_system_logs("Inactivity time allowed exceeded, logging out user: [ " . json_encode($_SESSION) . ' ]');
    logout();
}

function getAccessToken($clientId, $clientSecret, $authEndpoint)
{
    $postData = 'grant_type=client_credentials&client_id=' . urlencode($clientId) . '&client_secret=' . urlencode($clientSecret);
    $headers = array('Content-Type: application/x-www-form-urlencoded');
  
    $response = makeCurlRequest('POST', $authEndpoint, $postData, $headers);
  
    if ($response['statusCode'] === 200) {
        $accessToken = json_decode($response['response'])->access_token;
        return $accessToken;
    } else {
        return null;
    }
}

function send_sms($number, $message)
{
    $authEndpoint = 'https://accounts.jambopay.com/auth/token';
    $smsEndpoint = 'https://swift.jambopay.co.ke/api/public/send';
    $clientId = 'PiBcI5+58I7OA193g+ViPI+e9SNOfrjbBXmYocYvAUs=';
    $clientSecret = '796b2b80-bc94-45bc-9546-14ee2e7cc7bebJg5ZlK2U3F3kMg0EXv3xpH+M/bEz1NSvgDxTgNuIdY=';

    // Get access token
    $authToken = getAccessToken($clientId, $clientSecret, $authEndpoint);

    if ($authToken !== null) {
        // Send SMS
        $smsData = array(
          'contact' => $number,
          'message' => $message,
          'callback' => 'https://sokomkopo.veseninternal.co.ke/api/callback.php',
          'sender_name' => 'jambopay'
        );

        $smsHeaders = array(
          'Authorization: Bearer ' . $authToken,
          'Content-Type: application/json'
        );

        $smsResponse = makeCurlRequest(
            'POST',
            $smsEndpoint,
            json_encode($smsData),
            $smsHeaders
        );
        $smsStatusCode = $smsResponse['statusCode'];
        $smsResult = $smsResponse['response'];

        return array(
          'response' => $smsResult,
          'status_code' => $smsStatusCode
        );
    } else {
        return array(
          'response' => null,
          'status_code' => 401
        );
    }
}

function makeCurlRequest($method, $url, $postFields = null, $headers = array())
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => $postFields,
      CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    return array(
      'statusCode' => $statusCode,
      'response' => $response
    );
}


function create_id4($table, $id)
{
	$date_today = date('Ymd');

	$table_prifix = array(
		'admin'             => 'ADM' . $date_today,
		'story'             => 'STO' . $date_today,
		'banner'            => 'BNR' . $date_today,
		'inquiry'           => 'INQ' . $date_today,
		'statistic'         => 'STT' . $date_today,
		'therapist'         => 'THP' . $date_today,
		'speciality'        => 'SPE' . $date_today,
		'prescription'      => 'PRE' . $date_today,
		'bookmark'          => 'BKM' . $date_today,
		'user'              => 'USR' . $date_today,
		'post'              => 'PST' . $date_today,
		'comment'           => 'CMT' . $date_today,
		'reply'             => 'REP' . $date_today,
		'service'           => 'SRV' . $date_today,
		'board'             => 'BRD' . $date_today,
		'therapist_move'    => 'TPM' . $date_today,
		'likes'             => 'LIK' . $date_today,
		'subscription'      => 'SUB' . $date_today,
		'session'           => 'SES' . $date_today,
		'voucher'           => 'VOC' . $date_today,
		'subscriber'        => 'SUB' . $date_today,
		'banner'            => 'BNR' . $date_today,

	);

	$random_str = $table_prifix[$table] . rand_str();

	$get_id     = get_ids($table, $id, $random_str);

	while ($get_id == true) {
		$random_str = $table_prifix[$table] . rand_str();
		$get_id     = get_ids($table, $id, $random_str);
	}
	return $random_str;
}

require_once 'read/index.php';
require_once 'email/email.php';
?>