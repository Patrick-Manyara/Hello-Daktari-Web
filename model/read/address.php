<?php
function get_all_addresses($col,$value){
    $sql = "SELECT * FROM address WHERE $col = '$value' ORDER BY address_date_created ASC ";
    return select_rows($sql);
}
?>