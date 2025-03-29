<?php
$page = 'prescriptions';
require_once '../path.php';
include_once 'header.php';
$prescriptions = get_all_prescriptions('',$_SESSION['user_id']);

$num_columns = 6;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Doctor'),
        array('data' => 'prescription_mode', 'title' => 'Code'),
        array('data' => 'a', 'title' => 'Meds'),
        array('data' => 'b', 'title' => 'PDF')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Your Prescriptions</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>Doctor</th>
                        <th>Code</th>
                        <th>Meds</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($prescriptions as $prescription) {
                        $prescription_id = encrypt($prescription['prescription_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= get_by_id('doctor', $prescription['doctor_id'])['doctor_name'] ?> </td>
                            <td> <?= $prescription['prescription_code'] ?> </td>
                            <td>
                                <a href="view_meds?id=<?= $prescription_id ?>" class="btn btn-primary">
                                    View
                                </a>
                            </td>
                            <td>
                                <a href="<?= pdf_uri ?>?id=<?= $prescription_id ?>" class="btn btn-primary">
                                    Download
                                </a>
                            </td>
                        </tr>
                    <?php
                        $cnt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- / Content -->


<?php
include_once 'footer.php';
?>