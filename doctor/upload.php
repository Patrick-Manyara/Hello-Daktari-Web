<?php
$page        = 'upload';

require_once '../path.php';
require_once 'header.php';

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body card-secondary">
            <div class="card-header">
                <h3 class="card-title">Upload Medical Record </h3>
            </div>
            <div class="mt-4">
                <form enctype="multipart/form-data" action="<?= model_url ?>upload&d" method="POST">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <?= input_hybrid('File Name', 'upload_name', $row, true); ?>

                            <?= input_hybrid('Upload Here', 'upload_file', $row, true, 'file'); ?>
                        </div>
                        
                        <input hidden name="user_id" value="<?= $_GET['id'] ?>" />

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
            data: 'doctor_email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#emailid-availability").html(data);
            },
            error: function() {}
        });
    }
</script>

<?php include_once 'footer.php'; ?>