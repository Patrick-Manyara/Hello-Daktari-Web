<?php
$page = 'patients';
require_once '../path.php';
include_once 'header.php';
$patients = get_patients($_SESSION['doctor_id']);

$num_columns = 6;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Name'),
        array('data' => 'user_mode', 'title' => 'Email'),
        array('data' => 'a', 'title' => 'Phone'),
        array('data' => 'b', 'title' => 'Profile')
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($patients as $patient) {
                        $user_id = encrypt($patient['user_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $patient['user_name'] ?> </td>
                            <td> <?= $patient['user_email'] ?> </td>
                            <td> <?= $patient['user_phone'] ?> </td>
                            <td>
                                <a href="patient?id=<?= $user_id ?>" class="btn btn-primary">
                                    View
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