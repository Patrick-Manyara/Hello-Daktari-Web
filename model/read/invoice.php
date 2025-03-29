<?php
function get_invoice_items($invoice_id)
{
    $sql = "SELECT * FROM invoice_item WHERE invoice_id = '$invoice_id' ";
    return select_rows($sql);
}
?>