<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function limit_text($content, $limit = 10) {
    $text   = $content;
    
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    
    return $text;
}

function limit_text_small($content, $limit = 3) {
    $text   = $content;
    
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    
    return $text;
}

function limit_text_medium($content, $limit = 20) {
    $text   = $content;
    
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    
    return $text;
}

function limit_text_large($content, $limit = 40) {
    $text   = $content;
    
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    
    return $text;
}

function text_char_count($text, $length = 20) {
    if(strlen($text) <= $length) return $text;

    return substr($text,0,$length) . '...';
}