<?php
$page = 'lab_payments';
require_once '../path.php';
include_once 'header.php';

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'Test', 'title' => 'User'),
        array('data' => 'Description', 'title' => 'Service'),
        array('data' => 'Amount', 'title' => 'Service Amount'),
        array('data' => 'Date Created', 'title' => 'Date Created'),
        array('data' => '', 'title' => 'Action')
    );
}

$labs = get_lab_payments();
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> orders</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Service Amount</th>
                        
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($labs as $lab) {
                       $lab_id = encrypt($lab['lab_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td><?= $lab['user_name'] ?></td>  
                            <td><?= $lab['lab_test'] ?></td>  
                            <td><?= $lab['lab_amount'] ?></td>  
                            <td><?= $lab['lab_payment_date_created'] ?></td>
                            <td>
                                <a href="<?= delete_url ?>id=<?= $lab_id ?>&table=<?= encrypt('lab') ?>&page=<?= encrypt('view_labs') ?>&method=simple_admin" class="btn btn-danger">
                                    <i class='bx bx-trash'></i>
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