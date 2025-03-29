<?php
$page = 'edit_profile';
require_once '../path.php';
require_once MODEL_PATH . "operations.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents('php://input'), true);
    $signatureData = $postData['signatureData'];
    $doctorId = $_SESSION['doctor_id'];
    $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
    $decodedSignature = base64_decode($signatureData);
    $signatureImagePath = 'signatures/' . $doctorId . '.png';
    file_put_contents($signatureImagePath, $decodedSignature);

    $db = new PDO('mysql:host=localhost;dbname=angacinemas_hello', 'angacinemas_hello', '6wVCtmoa2CoI');
    $query = "UPDATE doctor SET doctor_signature = :signaturePath WHERE doctor_id = :doctorId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':signaturePath', $signatureImagePath);
    $stmt->bindParam(':doctorId', $doctorId);
    $stmt->execute();


    $response = ['message' => 'Signature saved successfully'];
    echo json_encode($response);
}
