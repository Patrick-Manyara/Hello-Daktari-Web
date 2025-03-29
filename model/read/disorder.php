<?php
function get_all_conditions($limit = '')
{
    $sql = "SELECT * FROM disorder ORDER BY disorder_date_created DESC";
    $limit != '' ? $sql .= " LIMIT $limit " : '' ;
    return select_rows($sql);
}



?>