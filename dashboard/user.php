<?php
$page        = 'user';

require_once '../path.php';
require_once 'header.php';

$current_year   = date("Y");

$user = get_by_id('user', security('id', 'GET'));

if (!empty($user)) {
    session_assignment(array(
        'edit' => $user['user_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Add users </h3>
            </div>
            <div class="mt-4">
                <form enctype="multipart/form-data" action="<?= model_url ?>user" method="POST">
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            input_hybrid('Name', 'user_name', $user, $require);
                            ?>
                            <div class="form-group">
                                <label for='email'>Email</label>
                                <div class="input-group">
                                    <input autocomplete="on" type="text" class="form-control" name="user_email" id="email" placeholder="Email" value="<?php echo isset($user['user_email']) ? $user['user_email'] : ''; ?>" onBlur="checkAvailabilityEmailid()" required>
                                </div>
                                <span id="emailid-availability" style="font-size:12px;"></span>
                            </div>


                            <?php
                            input_hybrid('Phone Number', 'user_phone', $user, $require);

                            if (empty($user)) {
                                input_hybrid('password', 'user_password', $user, $require);
                            }

                            input_hybrid('ID/Passport Number (optional)', 'user_passport', $user, false);
                            input_hybrid('address', 'user_address', $user, $require);
                            input_hybrid('Date of Birth (optional)', 'user_age', $user, false, 'date');



                            if (!empty($user['user_image'])) :
                                $require = false;
                                $image = $user['user_image'];
                            else :
                                $require = true;
                                $image = 'white_bg_image.png';
                            endif;
                            input_hybrid("user Image", "user_image", $user, $require, "file", 'my_img', '', 'img');
                            ?>
                            <img alt="image" src="<?= file_url . $image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">

                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<script>
    function checkAvailabilityEmailid() {
        jQuery.ajax({
            url: "../check_available.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#emailid-availability").html(data);
            },
            error: function() {}
        });
    }
</script>

<?php include_once 'footer.php'; ?>