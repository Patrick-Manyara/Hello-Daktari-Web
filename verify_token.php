<?php
require 'google/vendor/autoload.php';

$clientID = '477685653482-ve99eiatavqcqjhbuc8i7kt681fk8qgu.apps.googleusercontent.com';

$client = new Google_Client(['client_id' => $clientID]);
$id_token = $_POST['idtoken'];
$payload = $client->verifyIdToken($id_token);

if ($payload) {
    $userid = $payload['sub'];
    echo 'User ID: ' . $userid;
    // Redirect to login or sign up process
    header('Location: https://hellodaktari.org/login.php?code=' . $id_token);
} else {
    // Invalid ID token
    echo 'Invalid ID token';
}
?>