<?php
$page = 'statistic';
require_once '../path.php';
include_once 'header.php';

$statistic = array();
if (isset($_GET['id'])) $statistic = get_by_id('statistic', security('id', 'GET'));


$require = true;

if (!empty($statistic)) {
    $require = false;
    session_assignment(array(
        'edit' => $statistic['statistic_id']
    ), false);
}
// cout(TARGET_DIR);
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">statistics /</span> Create An statistic</h4>

    <div class="row">
        <div class="col-md-10 col-lg-10 col-sm-12">
            <div class="card mb-4">
                <h5 class="card-header">Statistic</h5>

                <form method="post" id="quickForm" enctype="multipart/form-data" action="<?= model_url ?>simple&table=statistic&url=view_statistics">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                input_hybrid("Name", "statistic_name", $statistic, $require);
                                input_hybrid("Number", "statistic_number", $statistic, $require);

                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?= submit('Submit', 'dark', 'text-center'); ?>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<?php include_once 'footer.php'; ?>