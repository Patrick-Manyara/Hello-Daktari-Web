<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function checkbox_input($label, $name) {
?>
    <div class="form-group">
        <label><?php echo $label ?></label>
        <input type="text" class="form-control" name="<?php echo $name ?>[]"> 
    </div>
<?php
}
