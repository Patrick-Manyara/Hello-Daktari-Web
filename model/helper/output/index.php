<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function cout($val, $type = 'p') {
    echo '<pre>';
    
    if(!is_array($val)) {
        echo $val;
    } else {
        $type == 'p' ? print_r($val) : var_dump($val); 
    }

    echo '</pre>';
}

function set_value($name) {
    $value = '';
    $post_value = $_POST[$name];

    if(isset($post_value)){
        $value = $post_value;
    }
    
    return $value;
}