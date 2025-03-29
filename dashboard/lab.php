<?php
$page        = 'lab';

require_once '../path.php';
require_once 'header.php';


$lab = get_by_id('lab', security('id', 'GET'));

if (!empty($lab)) {
    session_assignment(array(
        'edit' => $lab['lab_id']
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
                    Add lab services </h3>
            </div>
            <div class="mt-4">
                <form enctype="multipart/form-data" action="<?= model_url ?>simple&table=lab&url=view_labs" method="POST">
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            input_hybrid('Name', 'lab_test', $lab, $require);

                            textarea_input('bio', 'lab_description', $lab, $require);
                            input_hybrid('Amount', 'lab_amount', $lab, $require,'number');

                            ?>

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



<?php include_once 'footer.php'; ?>