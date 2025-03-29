<?php
function get_all_orders($id='')
{
    $sql    = "SELECT * FROM orders JOIN user ON orders.user_id = user.user_id JOIN address ON orders.address_id = address.address_id ";
    $id != '' ? $sql .= " WHERE orders.user_id = '$id' " : "" ;
    $sql    .= " ORDER BY orders.date_created DESC";
    return select_rows($sql);
}

function get_sub_orders($oid)
{
    $sql = "SELECT * FROM sub_orders JOIN product ON sub_orders.product_id = product.product_id WHERE sub_orders.order_id = '$oid' ";
    return select_rows($sql);
}

function get_lab_payments()
{
    $sql = "SELECT * FROM lab_payment JOIN lab ON lab_payment.lab_id = lab.lab_id JOIN user ON lab_payment.user_id = user.user_id ORDER BY lab_payment.lab_payment_date_created ";
    return select_rows($sql);
}