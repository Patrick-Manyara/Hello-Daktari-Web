<?php
$page = 'sessions';
require_once '../path.php';
include_once 'header.php';
$sessions = get_all_sessions('', $_SESSION['doctor_id']);

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Name'),
        array('data' => 'session_mode', 'title' => 'Mode'),
        array('data' => 'session_code', 'title' => 'Code'),
        array('data' => 'session_date', 'title' => 'Date & Time'),
        array('data' => 'session_end_time', 'title' => 'Notes')
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
                        <th>Client</th>
                        <th>Mode</th>
                        <th>Code</th>
                        <th>Date & Time</th>
                        <th>Action</th>
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
                            <td> <?= get_by_id('user', $session['client_id'])['user_name'] ?> </td>
                            <td> <?= $session['session_mode'] ?> </td>
                            <td> <?= $session['session_code'] ?> </td>
                            <td> <?= get_ordinal_month_year($session['session_date']) . " at " . get_hours_mins($session['session_start_time'])  . " to " . get_hours_mins($session['session_end_time']) ?> </td>
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