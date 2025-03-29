<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function textarea_input($label, $name, $row = array(), $required = true,$readonly = false)
{
?>
    <div class="form-group">
        <label for="<?= $name ?>"><?= $label ?><?= $required ? '<span class="text-danger">*</span>' : null ?></label>
        <textarea for="<?= $name ?>" class="form-control" style="min-width: 100%; max-width: 100%;" <?= $readonly == true ? 'readonly="readonly" ' : null ?> name="<?= $name ?>" id="<?= $name ?>" rows="5" <?= $required ? 'required' : '' ?>><?= !empty($row) ? $row[$name] : '' ?></textarea>
    </div>
<?php
}
