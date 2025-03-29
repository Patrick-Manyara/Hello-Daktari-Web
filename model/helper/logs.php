<?php

function writing_system_logs($log, $code = null, $message = null) {
    return true;
}

function log_file_name() {
    $get_latest_file = get_latest_file();
    $log_path       = str_replace("\\", "\\\\", LOG_DIR);
    $file_name      = preg_replace('/\s+/', '_', APP_NAME . date(' Y m d'));
    
    $exploded_file_name = explode("_", $get_latest_file);
    
    if($exploded_file_name[4] !== date('d')) return $log_path . $file_name . '_1.log';

    if(array_key_last($exploded_file_name) == 4) return $log_path . $file_name . '_1.log';
    
    $last_item_in_exploded_file_name = explode(".",$exploded_file_name[array_key_last($exploded_file_name)]);
    
    $file_size = filesize($log_path . $get_latest_file);
    
    if($file_size > 900000) $last_item_in_exploded_file_name[0] += 1;
    
    return $log_path . $file_name . '_' . $last_item_in_exploded_file_name[0] . '.log';
}

function get_latest_file() {
    $path = LOG_DIR;

    $latest_ctime = 0;
    $latest_filename = '';    
    
    $d = dir($path);
    
    while (false !== ($entry = $d->read())) {
      $filepath = "{$path}/{$entry}";
      // could do also other checks than just checking whether the entry is a file
      if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
        $latest_ctime = filectime($filepath);
        $latest_filename = $entry;
      }
    }
    
    return $latest_filename;
}

require_once CORE_PATH . 'helper/string_formatter.php';