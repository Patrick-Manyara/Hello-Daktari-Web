<?php

function single_line_single_space_formatter($string) {
    $converted_multi_line_to_single_line = str_replace("\r\n", "", $string);
    $converted_space_to_single_space     = preg_replace('!\s+!', ' ',  $converted_multi_line_to_single_line);

    return $converted_space_to_single_space;
}