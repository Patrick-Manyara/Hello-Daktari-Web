<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zoom.us/oauth/token?grant_type=account_credentials&account_id=9eNZF65tSSeF67O101gZNQ',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic UmQxNUVmY3NTVzZrcFZaeDBKSDhtUTp1NHBUMzVpWWYzTkNDOXRKWE91dGd3M3duSFRkc3hrbQ==',
    'Cookie: TS018dd1ba=017656dd8ea2b917494673dce732eb45678633e998b1b33b5a98f28a93bd2ba668800a876906c5f2adb21e0f4ccbd3f92209a03e25; TS01f92dc5=017656dd8e2b66f5a1360ac13b55b4a646fcacec6437a0b2dbf91b80c2343467656f9ce386181c12ec3b1294edc169de0c8bd972ed; __cf_bm=t1yPx33UU0JDQJMqBIuoLfzCig9WkiAW7Qjm0Wq7UmY-1673446713-0-AR5Ae5yiRm7uiZ9MsW3DK5HT7akAnA+2qN3XVoQMM0EI2Iw4JvXMiVg7mKg3j93naEJHezZL32P6pnebOEQoRAY=; _zm_chtaid=529; _zm_ctaid=QUFo91PeRoKy1BIzZyT2dA.1673447359541.77ca620eefbe9289c2f36eba91299085; _zm_mtk_guid=3fe60b980c26403e9d7323728ad0aa03; _zm_page_auth=us04_c_inHIEn6FQgOOomed9WsIqA; _zm_ssid=us04_c_2B5qWLtwR_2ECyGNLnNxdg; cred=A07586340085D32E2A2367CF87DBE1A9'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$token = json_decode($response)->access_token;