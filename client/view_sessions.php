<?php
$page = 'sessions';
require_once '../path.php';
include_once 'header.php';
$sessions = get_all_sessions($_SESSION['user_id']);

$num_columns = 8;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Name'),
        array('data' => 'session_mode', 'title' => 'Mode'),
        array('data' => 'session_code', 'title' => 'code'),
        array('data' => 'session_date', 'title' => 'Date'),
        array('data' => 'session_start_time', 'title' => 'Start Time'),
        array('data' => 'session_end_time', 'title' => 'End Time')
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
                        <th>Mode</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($sessions as $session) {
                        $session_id = encrypt($session['session_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $session['doctor_name'] ?> </td>
                            <td> <?= $session['session_mode'] ?> </td>
                            <td> <?= $session['session_code'] ?> </td>
                            <td> <?= $session['session_date'] ?> </td>
                            <td> <?= $session['session_start_time'] ?> </td>
                            <td> <?= $session['session_end_time'] ?> </td>
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