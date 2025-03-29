<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function input($label, $name, $row = array(), $required = false, $type = "text", $readonly = false)
{
?>
    <div class="form-group">
        <label><?= $label ?><?= $required ? '<span class="text-danger">*</span>' : null ?></label>
        <input type="<?= $type ?>" required class="form-control" <?= $required ? 'required' : null ?> value='<?= !empty($row) ? $row[$name] : null ?>' name="<?= $name ?>" <?= $readonly == true ? 'readonly="readonly" ' : null ?>>
    </div>
<?php
}

function input_hybrid($label, $name, $row = array(), $required = true, $type = "text", $input_id = null, $class = null, $extra = null, $readonly = false, $placehoolder = null, $onBlur = null)
{
    $form_id        = !empty($input_id) ? $input_id : $name;
    $placehoolder   = !empty($placehoolder) ? $placehoolder : $label;
?>
    <div class="form-group <?= $class ?>">
        <label for="<?= $form_id ?>"><?= $label ?><?= $required ? '<span class="text-danger">*</span>' : null ?></label>
        <input type="<?= $type ?>" <?= $required ? 'required' : null ?> <?= isset($extra) ? ($extra == 'img' ? 'accept=".png, .jpg, .jpeg"' : (($extra == 'vid') ? 'accept=".mp4, .mkv, .m4v"' : (($extra == 'doc') ? 'accept=".pdf, .docx"' : (($extra == 'lib') ? 'accept=".pdf"' : null)))) : null; ?> id="<?= $form_id ?>" value='<?= !empty($row) ? $row[$name] : null ?>' class="form-control" name="<?= $name ?>" placeholder="<?= $placehoolder ?>" <?= $type == 'password' ? "minlength='6'" : null ?> autocomplete="on" onBlur='<?= $onBlur ?>' <?= $readonly == true ? 'readonly="readonly" ' : null ?>>
    </div>
<?php
}
