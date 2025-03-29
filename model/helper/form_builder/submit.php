<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function submit($submit = "submit", $btn_color = 'warning', $position = "text-left", $class = "")
{
    unset_session_error();
    unset_session_success();
    unset_session_warning();
?>
    <input type="hidden" name="csrf_token" value="<?= csrf_generate() ?>">

    <div class="<?= $position ?>">
        <button id="add" class="btn btn-<?= $btn_color ?> <?= $class ?>"><?= $submit ?></button>
    </div>
<?php
}

