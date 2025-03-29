<?php 
function get_all_groups()
{
    $sql = "SELECT * FROM company ";
    $sql .= "ORDER BY rand()";
    return select_rows($sql);
}
?>