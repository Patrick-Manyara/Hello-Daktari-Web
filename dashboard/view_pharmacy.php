<?php
$page = 'pharmacies';
require_once '../path.php';
include_once 'header.php';
$items = get_all('pharmacy_prescription');

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_image', 'title' => 'User Name'),
        array('data' => 'doctor_name', 'title' => 'File'),
        array('data' => 'doctor_email', 'title' => 'Uploaded On'),
        array('data' => 'doctor_phone', 'title' => 'Status'),
        array('data' => '', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"> Pharmacy Subscriptions </h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>User Name</th>
                        <th>File</th>
                        <th>Uploaded On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($items as $item) {
                        $user = get_by_id('user', $item['user_id']);

                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $user['user_name'] ?> </td>
                            <td>
                                <a target="_blank" href="<?= doc_url ?><?= $item['prescription_file'] ?>" class="btn btn-dark">
                                    <i class='bx bx-download'></i>
                                </a>
                            </td>
                            <td> <?= $item['pharmacy_prescription_date_created'] ?> </td>
                            <td> <?= $item['status'] ?> </td>
                            <td>
                                <a href="#" class="btn btn-success">
                                    Approve <i class='bx bx-check-square'></i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    Deny<i class='bx bx-x-circle'></i>
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