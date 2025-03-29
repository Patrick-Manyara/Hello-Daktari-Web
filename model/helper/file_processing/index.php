<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

// check for malware in the file

function upload($file_name, $relatedname = null, $type = 'img', $file_size = null)
{
    global $error;

    // if (!isset($_FILES[$file_name]["name"]) || $_FILES[$file_name]["name"] == '') return $error['file_isset'] = 110;
    writing_system_logs('Processing an upload.');

    $rand       = rand_str(8, '');
    $tmp_name    = $_FILES[$file_name]["tmp_name"];

    $uploaded_file_size         = $_FILES[$file_name]["size"];

    $folder     = "images/";
    $file_size  = isset($file_size) ? $file_size : 8;

    $unwanted_names = array(".htaccess", ".htpasswd", "crossdomain.xml", "clientaccesspolicy.xml");
    $name_array     = array("Health", "Psych", "Mental", "Therapy");

    $random_keys    =   array_rand($name_array);
    $file_value     =   $name_array[$random_keys];

    if (in_array($_FILES[$file_name]["name"], $unwanted_names)) {
        writing_system_logs('Upload rejected because file name is unaccepted. [ ' . $error[106] . ' ]');
        return $error['file_name'] = 106;
    }

    if (isset($relatedname)) {
        $file_value = ucfirst($relatedname) . $file_value;
        writing_system_logs("Upload assigned [ $file_value ] name");
    }

    if ($type == 'vid') {
        $folder     = "videos/";
        $file_size  = isset($file_size) ? $file_size : 30;
    }

    if ($uploaded_file_size > ($file_size * BYTES_EQUIVALENT_TO_HALF_MB)) {
        writing_system_logs("Upload rejected because of [ " . $error[107] . ' ]');
        return $error['file_size'] = 107;
    }

    $name       = basename($_FILES[$file_name]["name"]);
    $extention  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $filename = $file_value . ($type == 'vid' ? 'Video' : 'Image') . date('Ymd') . 'at' . date('hisa') . $rand;

    $image_path = TARGET_DIR . $folder . $filename . "." . $extention;

    $check = $type == 'vid' ? check_ext_vid($extention) : check_ext($extention);

    if (!$check) {
        writing_system_logs("Upload rejected because of [ " . $error[108] . ' ]');
        return $error['file_type'] = 108;
    } 

    if ($uploaded_file_size <= BYTES_EQUIVALENT_TO_HALF_MB) {
        if (!move_uploaded_file($tmp_name, $image_path)) {
            writing_system_logs("Upload rejected because of [ " . $error[109] . ' ]');
            return $error['file_push'] = 109;
        }

        writing_system_logs("Upload successful, file assigned [ $filename . $extention ] name");
        return $filename . "." . $extention;
    }

    //compress file greater tha 0.5 mb

    $img_info = getimagesize($tmp_name);
    $data_mine = $img_info['mime'];

    switch ($data_mine) {
        case 'image/png':
            $new_file_tmp_name = imagecreatefrompng($tmp_name);
            break;
        case 'image/jpg':
            $new_file_tmp_name = imagecreatefromgif($tmp_name);
            break;
        case 'image/jpeg':
            $new_file_tmp_name = imagecreatefromjpeg($tmp_name);
            break;
        default:
            writing_system_logs("Upload rejected because of [ " . $error[108] . ' ]');
            return $error['file_type'] = 108;
    }

    if (!imagejpeg($new_file_tmp_name, $image_path)) {
        writing_system_logs("Upload rejected because of [ " . $error[109] . ' ]');
        return $error['file_push'] = 109;
    }

    writing_system_logs("Upload successful, file assigned [ $filename . $extention ] name");
    return $filename . "." . $extention;
}

function upload_docs($file_name, $relatedname = null, $type = 'doc', $file_size = null)
{
    global $error;

    // if (!isset($_FILES[$file_name]["name"]) || $_FILES[$file_name]["name"] == '') return $error['file_isset'] = 110;
    writing_system_logs('Processing an upload.');

    $rand       = rand_str(8, '');
    $tmp_name    = $_FILES[$file_name]["tmp_name"];

    $uploaded_file_size         = $_FILES[$file_name]["size"];

    $folder     = "files/";
    $file_size  = isset($file_size) ? $file_size : 8;

    $unwanted_names = array(".htaccess", ".htpasswd", "crossdomain.xml", "clientaccesspolicy.xml");
    $name_array     = array("Product", "Ecommerce", "Shop", "Hello", "Vendor", "Market");

    $random_keys    =   array_rand($name_array);
    $file_value     =   $name_array[$random_keys];

    if (in_array($_FILES[$file_name]["name"], $unwanted_names)) {
        writing_system_logs('Upload rejected because file name is unaccepted. [ ' . $error[106] . ' ]');
        return $error['file_name'] = 106;
    }

    if (isset($relatedname)) {
        $file_value = ucfirst($relatedname) . $file_value;
        writing_system_logs("Upload assigned [ $file_value ] name");
    }

    if ($type == 'vid') {
        $folder     = "videos/";
        $file_size  = isset($file_size) ? $file_size : 30;
    }


    $name       = basename($_FILES[$file_name]["name"]);
    $extention  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $filename = $file_value . ($type == 'vid' ? 'Video' : 'Document') . date('Ymd') . 'at' . date('hisa') . $rand;

    $image_path = TARGET_DIR . $folder . $filename . "." . $extention;

    $check = $type == 'vid' ? check_ext_vid($extention) : check_ext_doc($extention);

    if (!$check) {
        writing_system_logs("Format error. Upload rejected because of [ " . $error[108] . ' ]');
        return $error['file_type'] = 108;
    }

    if ($uploaded_file_size <= BYTES_EQUIVALENT_TO_HALF_MB) {
        if (!move_uploaded_file($tmp_name, $image_path)) {
            writing_system_logs("Size error. Upload rejected because of [ " . $error[109] . ' ]');
            return $error['file_push'] = 109;
        }

        writing_system_logs("Upload successful, file assigned [ $filename . $extention ] name");
        return $filename . "." . $extention;
    }


    writing_system_logs("Upload successful, file assigned [ $filename . $extention ] name");
    return $filename . "." . $extention;
}


function check_ext_doc($ext)
{
    return true;
}

function check_ext($ext)
{
    if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") return true;
    return false;
}

function check_ext_vid($ext)
{
    if ($ext == "mkv" || $ext == "m4v" || $ext == "mp4") return true;
    return false;
}
