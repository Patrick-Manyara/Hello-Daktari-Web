<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://accounts.jambopay.com/v2/auth/token?grant_type=client_credentials&client_id=5048fa5944999e8439667382c8689ca388fb717f73a4b32d7348e47a23f5196b&client_secret=NDJjNy00NDk0LTljNTA0OGZhNTk0NDk5OWU4NDM5NjY3MzgyYzg2ODlHT0xJVkVjYTM4OGZiNzE3ZjczYTRiMzJkNzkxZDRjNjdkS0lNQU5JLTM0OGU0RE9DN2EyM2Y1MTk2YmQ4LWI5NTI3M2EwNWFjMA%3D%3D',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'client_id=5048fa5944999e8439667382c8689ca388fb717f73a4b32d7348e47a23f5196b&client_secret=NDJjNy00NDk0LTljNTA0OGZhNTk0NDk5OWU4NDM5NjY3MzgyYzg2ODlHT0xJVkVjYTM4OGZiNzE3ZjczYTRiMzJkNzkxZDRjNjdkS0lNQU5JLTM0OGU0RE9DN2EyM2Y1MTk2YmQ4LWI5NTI3M2EwNWFjMA%3D%3D&grant_type=client_credentials',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
