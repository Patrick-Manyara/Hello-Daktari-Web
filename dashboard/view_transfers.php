<?php
$page = 'view_transfers';
require_once '../path.php';
include_once 'header.php';
$doctors = get_all('doctor_move');

$num_columns = 6;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
   $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'From'),
        array('data' => 'doctor_name', 'title' => 'To'),
        array('data' => 'user_name', 'title' => 'Client'),
        array('data' => 'date', 'title' => 'Date')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> doctors</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>Name</th>
                        <th>Name</th>
                        <th>Name</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($doctors as $doctor) {
                        $doctor_name1    = get_by_id('doctor',$doctor['doctor_from_id'])['doctor_name'];
                        $doctor_name2    = get_by_id('doctor',$doctor['doctor_to_id'])['doctor_name'];
                        $user_name          = get_by_id('user',$doctor['user_id'])['user_name'];
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                           
                            <td> <?= $doctor_name1 ?> </td>
                            <td> <?= $doctor_name2 ?> </td>
                            <td> <?= $user_name ?> </td>
                            <td> <?= $doctor['doctor_move_date_created'] ?> </td>
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