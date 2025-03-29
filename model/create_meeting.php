<?php
function create_meeting($time,$name = "new_meeting"){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zoom.us/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=account_credentials&account_id=7gydF_2PRGypUorYMUMC8Q',
  CURLOPT_HTTPHEADER => array(
    'Host: zoom.us',
    'Authorization: Basic RFFEUkVPWUpRSW1DNTJXSEJhbE9tUTp6S3NxUFZITWNLUjI5RUdLMFczaXB0V1NiR0FON2thMg==',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: __cf_bm=N5LySpBTM_26Q0SMTAQhOznZRrNHo0K7JmyPnbaQUOM-1676904961-0-Acl1iNL1ypF2PaFbSnFVP5G4Jg7DJ3Z596iO7WwN8EuMu9c9DWKBneua3zP74WIR95+ROHPJSBG0hiaJn3tFzX4=; _zm_chtaid=407; _zm_ctaid=Ru47Oa55RU6xe1_Q6kxOUw.1676904961360.1e619ab4b8f98229d9732fd699c6321e; _zm_mtk_guid=3fe60b980c26403e9d7323728ad0aa03; _zm_page_auth=us05_c_9WAp_p4JQZizgWZruckStw; _zm_ssid=us05_c_VfLLWvqEQrq1gt2onLLJ3A; cred=37B9966E84953D2B26AE099F7A0DF097'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$token = json_decode($response)->access_token;



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.zoom.us/v2/users/me/meetings',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "agenda": "My Meeting",
  "default_password": false,
  "duration": 60,
  "password": "123456",
  "pre_schedule": false,
  "schedule_for": "luna4africa@gmail.com",
  "settings": {
    "additional_data_center_regions": [],
    "allow_multiple_devices": true,
    "alternative_hosts": "",
    "alternative_hosts_email_notification": true,
    "approval_type": 2,
    "approved_or_denied_countries_or_regions": {
      "approved_list": [
        "CX"
      ],
      "denied_list": [
        "CA"
      ],
      "enable": false,
      "method": "approve"
    },
    "audio": "both",
    "authentication_domains": "gmail.com",
    "authentication_exception": [],
    "authentication_option": "signIn_D8cJuqWVQ623CI4Q8yQK0Q",
    "auto_recording": "cloud",
    "breakout_room": {
      "enable": true,
      "rooms": [
        {
          "name": "room1",
          "participants": [
            "luna4africa@gmail.com"
          ]
        }
      ]
    },
    "calendar_type": 1,
    "close_registration": false,
    "cn_meeting": false,
    "contact_email": "luna4africa@gmail.com",
    "contact_name": "Michael",
    "email_notification": true,
    "encryption_type": "enhanced_encryption",
    "focus_mode": true,
    "global_dial_in_countries": [],
    "host_video": true,
    "in_meeting": false,
    "jbh_time": 0,
    "join_before_host": true,
    "language_interpretation": {
      "enable": true,
      "interpreters": []
    },
    "meeting_authentication": false,
    "meeting_invitees": [],
    "mute_upon_entry": false,
    "participant_video": false,
    "private_meeting": false,
    "registrants_confirmation_email": true,
    "registrants_email_notification": true,
    "registration_type": 1,
    "show_share_button": true,
    "use_pmi": 2,
    "waiting_room": false,
    "watermark": false,
    "host_save_video_order": true,
    "alternative_host_update_polls": true
  },
  "start_time": "'.$time.'",
  "template_id": "Dv4YdINdTk+Z5RToadh5ug==",
  "timezone": "Africa/Nairobi",
  "topic": "'.$name.'",
  "tracking_fields": [
    {
      "field": "field1",
      "value": "value1"
    }
  ],
  "type": 2
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
return  json_decode($response);
}

