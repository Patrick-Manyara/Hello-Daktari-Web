<?php
function create_meeting($time,$name = "new_meeting"){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://zoom.us/oauth/token?grant_type=account_credentials&account_id=XU916QPdT-aIwyJYnkqh0Q',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic YVdRSm1OT3NTODJOME1HTnVEZ0l5QTpSeExhSVJtSTRLVkNoWnM4ckVuUzBsWVhrVjdRWVE3eQ==',
    'Cookie: TS018dd1ba=0135c3e7cecddf1e0fb36196f7c8de926fa4cc048faade7f5ad664423bf7e603542b2c9b607ef4ef2759d24a38669f61f312ec0012; TS01f92dc5=0135c3e7cecddf1e0fb36196f7c8de926fa4cc048faade7f5ad664423bf7e603542b2c9b607ef4ef2759d24a38669f61f312ec0012; __cf_bm=WPYgL35xIKLUQybOsC0ZapyZVbi7jFXMeVTx7njOq.E-1673454762-0-AaeFirvUjKVtQAKx/wdrxMRraoq3GD7Fs5kxlNdwcfBrxVHiUu6N208GWo7+Ds9I7lfsfWrl/EFs5U38U/n6+KI=; _zm_mtk_guid=3fe60b980c26403e9d7323728ad0aa03; _zm_page_auth=us06_c_uV8W2CqfSs60RDSaYSjXdA; _zm_ssid=us04_c_2B5qWLtwR_2ECyGNLnNxdg; cred=A539BD1C1E745228FD10A87C159299A4'
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
  "schedule_for": "psychxglobal@gmail.com",
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
            "psychxglobal@gmail.com"
          ]
        }
      ]
    },
    "calendar_type": 1,
    "close_registration": false,
    "cn_meeting": false,
    "contact_email": "psychxglobal@gmail.com",
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

