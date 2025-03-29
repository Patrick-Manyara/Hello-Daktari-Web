<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function sql_counter($sql)
{
    $conn = connect();

    writing_system_logs('Counter, SQL: [ ' . single_line_single_space_formatter($sql) . ' ]');

    $result = mysqli_num_rows(mysqli_query($conn, $sql));
    mysqli_close($conn);
    writing_system_logs('DB connection closed');

    writing_system_logs('Count complete with count result: [ ' . $result . ' ]');

    return $result;
}