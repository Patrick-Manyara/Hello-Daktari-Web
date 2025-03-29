<?php
$page        = 'transfer-requests';
$header_name = 'Transfers';

require_once '../path.php';
require_once 'header.php';

//$doctors = get_all_transfer_requests();

$num_columns = 6;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'S.no'),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'user_name', 'title' => 'Name of Client'),
        array('data' => 'doctor_name', 'title' => 'doctor From'),
        array('data' => 'doctor_name', 'title' => 'doctor to'),
        array('data' => '', 'title' => 'Action')
    );
}

?>
<div class="content-wrapper"><!-- Begin Page Content -->

    <div class="container">
        <section class="connectedSortable">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Transfer Requests</h3>
                </div>
                <div class="card-body">
                    <table class="table" id="tb1">
                        <thead>
                            <tr>
                                <th></th>

                                <th>S.no</th>
                                <th>Name of Client</th>
                                <th>doctor From</th>
                                <th>doctor to</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- container-fluid -->

    <!-- End of Main Content -->

    <?php include_once 'footer.php'; ?>