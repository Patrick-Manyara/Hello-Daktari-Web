<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }
$row = array();
$required = true;
function input_select($text, $name, $row, $required, $array, $class = '')
{
?>
    <div class="form-group <?= $class ?>">
        <label for="<?= $name ?>"><?= ucfirst($text) ?><?= !empty($row) ? ' : ' . ucfirst($row[$name]) : '' ?><?= $required ? '<span class="text-danger">*</span>' : null ?></label>
        <Select id="<?= $name ?>" <?= $required ? 'required' : '' ?> class="form-control" name="<?= $name ?>">
            <?= empty($row) || $row[$name] === null ? '<option value="" hidden selected disabled>' . $text . '</option>' : '' ?>
            <?php foreach ($array as $value) {
                $selected = false;
                if (!empty($row) && ($row[$name] === $value)) {
                    $selected = true;
                } ?>
                <option <?= $selected ? 'selected disabled' : '' ?> value="<?= $value ?>"><?= ucfirst($value) ?></option>
            <?php } ?>
        </Select>
    </div>
<?php
}

function input_select_array($text, $name, $row, $required, $array, $class = '')
{
?>
    <div class="form-group <?= $class ?>">
        <label for="<?= $name ?>"><?= ucfirst($text) ?><?= !empty($row) ?  ' : ' . ucfirst($array[$row[$name]]) : '' ?><?= $required ? '<span class="text-danger">*</span>' : null ?></label>
        <Select id="<?= $name ?>" <?= $required ? 'required' : '' ?> class="form-control" name="<?= $name ?>">
            <?= empty($row) || $row[$name] === null ? '<option value="" hidden selected disabled>' . $text . '</option>' : '' ?>
            <?php foreach ($array as $key => $value) {
                $selected = false;
                if (!empty($row) && ($row[$name] === $key)) {
                    $selected = true;
                } ?>
                <option <?= $selected ? 'selected disabled' : '' ?> value="<?= $key ?>"><?= ucfirst($value) ?></option>
            <?php } ?>
        </Select>
    </div>
<?php
}

function get_dropdown_data($dropdown_data_array, $name, $id)
{
    $dropdown_array = array();

    foreach ($dropdown_data_array as $dropdown_data) {
        $dropdown_data_id    = $dropdown_data[$id];
        $dropdown_data_name  = $dropdown_data[$name];

        $dropdown_array[$dropdown_data_id] = $dropdown_data_name;
    }

    return $dropdown_array;
}
