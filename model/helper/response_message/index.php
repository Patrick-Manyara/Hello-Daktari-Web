<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function success_message($msg)
{
    message('success', 'Success', $msg);
}

function error_message($msg)
{
    message('danger', 'Failed', $msg);
}

function warning_message($msg, $warning = 'Warning')
{
    message('warning', $warning, $msg);
}

function message($color, $content, $my_message)
{
?>
    <div class="alert alert-<?= $color ?> alert-dismissible text-center">
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?= $content ?>!</strong> <?= ucwords($my_message) ?>
    </div>
<?php
}


// thinking of displaying multiple errors at once

require_once 'message.php';