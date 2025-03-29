<?php
$page = 'all_doctors';
require_once '../path.php';
include_once 'header.php';
$doctors = get_client_doctor($profile['doctor_id']);

$num_columns = 6;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_image', 'title' => 'Image'),
        array('data' => 'doctor_name', 'title' => 'Name'),
        array('data' => 'doctor_gender', 'title' => 'Gender'),
        array('data' => '', 'title' => 'Action')
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($doctors as $doctor) {
                        $doctor_id       = encrypt($doctor['doctor_id']);
                        $doctor_name     = get_by_id('doctor', $doctor['doctor_id'])['doctor_name'];
                        $doctor_image    = get_by_id('doctor', $doctor['doctor_id'])['doctor_image'];
                        $doctor_gender   = get_by_id('doctor', $doctor['doctor_id'])['doctor_gender'];
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td>
                                <img alt="doctor image" src="<?= file_url . $doctor_image ?>" style="width:100px; height:auto; border-radius:5px;" title="<?= $doctor_name ?>">
                            </td>
                            <td> <?= $doctor_name ?> </td>
                            <td> <?= $doctor_gender ?> </td>
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