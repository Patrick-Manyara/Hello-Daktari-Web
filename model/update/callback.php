<?php
require_once 'create.php';


function logToFile($message)
{
    $logFile = fopen("log.txt", "a");
    fwrite($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n");
    fclose($logFile);
}

function isJson($string)
{
    logToFile("Computing: Checking if string is JSON");
    json_decode($string);
    $isJson = json_last_error() === JSON_ERROR_NONE;
    logToFile("Result: " . ($isJson ? "true" : "false"));
    return $isJson;
}

function getRequestBody()
{
    logToFile("Computing: Getting request body");
    $requestData = [];
    $requestBody = file_get_contents('php://input');
    logToFile("Request body: " . $requestBody);
    if (!empty($requestBody) && isJson($requestBody)) {
        $requestData = json_decode($requestBody, true);
    } elseif (!empty($requestBody) && !isJson($requestBody)) {
        $requestData = $_POST;
    } elseif (!empty($_FILES)) {
        $requestData = $_FILES;
    } else {
        $requestData = [];
    }
    logToFile("Request data: " . print_r($requestData, true));
    return $requestData;
}


function verify_checksum($ref, $amount, $verifyChecksum)
{
    logToFile("Starting checksum verification");
    logToFile("Reference: " . $ref);
    logToFile("Amount: " . $amount);
    logToFile("Original Checksum: " . $verifyChecksum);

    $client_id = "5048fa5944999e8439667382c8689ca388fb717f73a4b32d7348e47a23f5196b";
    $client_secret = "NDJjNy00NDk0LTljNTA0OGZhNTk0NDk5OWU4NDM5NjY3MzgyYzg2ODlHT0xJVkVjYTM4OGZiNzE3ZjczYTRiMzJkNzkxZDRjNjdkS0lNQU5JLTM0OGU0RE9DN2EyM2Y1MTk2YmQ4LWI5NTI3M2EwNWFjMA==";

    logToFile("Formatting amount to 2 decimal places");
    $amount = number_format((float)$amount, 2, '.', '');

    logToFile("Computing SHA-256 hash");
    $checksum = hash('sha256', $ref . $amount . $client_id . $client_secret);

    logToFile("Computed Checksum: " . $checksum);

    $isVerified = $checksum === $verifyChecksum ? true : false;

    logToFile("Checksum verification result: " . ($isVerified ? "true" : "false"));

    return $isVerified;
}

function msg($status, $code, $message, $data = [])
{
    logToFile("Computing: Sending message");
    http_response_code($code);
    $response = [
        'status' => $status,
        'code' => $code,
        'message' => $message,
        'data' => $data
    ];
    logToFile("Response: " . print_r($response, true));
    echo json_encode($response);
    exit;
}

logToFile("Setting Content-Type to application/json");
header('Content-Type: application/json');

logToFile("Getting request body");
$requestBody = getRequestBody();

if (empty($requestBody)) {
    logToFile("Request body is empty");
    msg(false, 400, 'The request body is empty!');
}

$arr2 = array();
$id = $requestBody['orderId'];
$ref = $requestBody['ref'];

$arr2['amount_paid'] = $requestBody['status'] === "SUCCESS" ? $requestBody['amount'] : 0;

logToFile("Selecting rows from temp_data and bookings");


$sql = "SELECT * FROM policy WHERE device_id = '$_COOKIE[device]' ORDER BY policy_date_created DESC ";
$policy = select_rows($sql)[0];

if (!isset($policy) || empty($policy)) {
    logToFile("Order id does not exist");
    msg(false, 400, 'Order id does not exist');
}


$bid = $policy['policy_id'];
$amount = '1';


logToFile("Building SQL edit for bookings");

$verifyChecksum = $requestBody['checksum'];

if (verify_checksum($ref, $amount, $verifyChecksum) !== true) {
    logToFile("Checksum verification failed");
    msg(false, 403, 'Checksum verification failed');
} else {
    if ($requestBody['status'] !== "SUCCESS") {
        logToFile("An error occurred or the transaction was cancelled");
        msg(false, 403, 'An error occurred or the transaction was cancelled');
    }
    if ($requestBody['status'] === "SUCCESS") {
        logToFile("Checksum verification passed, building SQL edits");

       
        msg(true, 200, 'Checksum is valid');
    }
}
