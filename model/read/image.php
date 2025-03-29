<?php

function get_product_images($product_id){
    $sql = "
        SELECT 
            *
        FROM 
            product_image
        WHERE
            product_id = '$product_id'
    ";

return select_rows($sql)[0];
}

function get_user_image($image){
    if($image !=''){
        $result = $image;
    }else{
        $result = 'default.png';
    }
    return $result;
}