<?php
$page = 'prescriptions';
require_once '../path.php';
include_once 'header.php';
$meds = get_medication(security('id','GET'));

$num_columns = 9;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Code'),
        array('data' => 'medication_mode', 'title' => 'Name'),
        array('data' => 'medication_date', 'title' => 'Dose'),
        array('data' => 'medication_date', 'title' => 'Route'),
        array('data' => 'medication_date', 'title' => 'Frequency'),
        array('data' => 'medication_date', 'title' => 'Duration'),
        array('data' => 'medication_end_time', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Sessions</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Dose</th>
                        <th>Route</th>
                        <th>Frequency</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($meds as $med) {
                        $med_id = encrypt($med['medication_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= get_by_id('prescription', $med['prescription_id'])['prescription_code'] ?> </td>
                            <td> <?= $med['medication_name'] ?> </td>
                            <td> <?= $med['medication_dose'] ?> </td>
                            <td> <?= $med['medication_route'] ?> </td>
                            <td> <?= $med['medication_frequency'] ?> </td>
                            <td> <?= $med['medication_duration'] ?> </td>
                            <td>

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