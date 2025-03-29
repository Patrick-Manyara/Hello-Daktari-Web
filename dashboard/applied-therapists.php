<?php
$page        = 'applied-doctors';

require_once '../path.php';
require_once 'header.php';

$doctors = get_all_applied_doctors();

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'S.no'),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'doctor_image', 'title' => 'Image'),
        array('data' => 'doctor_name', 'title' => 'Name'),
        array('data' => 'doctor_email', 'title' => 'Email'),
        array('data' => 'doctor_phone', 'title' => 'Phone'),
        array('data' => 'doctor_address', 'title' => 'Address'),
        array('data' => '', 'title' => 'Action')
    );
}

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Applied</span> doctors</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>S.no</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($doctors as $doctor) {
                        $doctor_id = encrypt($doctor['doctor_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td>
                                <img alt="doctor image" src="<?= file_url . $doctor['doctor_image'] ?>" style="width:100px; height:auto; border-radius:5px;" title="<?= $doctor['doctor_name'] ?>">
                            </td>
                            <td> <?= $doctor['doctor_name'] ?> </td>
                            <td> <?= $doctor['doctor_email'] ?> </td>
                            <td> <?= $doctor['doctor_phone'] ?> </td>
                            <td> <?= $doctor['doctor_address'] ?> </td>
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
<!-- container-fluid -->

<!-- End of Main Content -->
<?php include_once 'footer.php'; ?>