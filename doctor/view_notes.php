<?php
$page = 'notes';
require_once '../path.php';
include_once 'header.php';
$notes = get_all_notes($_SESSION['doctor_id']);

$num_columns = 8;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_name', 'title' => 'Client'),
        array('data' => 'note_mode', 'title' => 'Notes Code'),
        array('data' => 'note_code', 'title' => 'Session Code'),
        array('data' => 'note_date', 'title' => 'Session Date And Time'),
        array('data' => 'note_start_time', 'title' => 'Notes Date Created'),
        array('data' => '', 'title' => 'Action'),
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> notes</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>Client</th>
                        <th>Notes Code</th>
                        <th>Session Code</th>
                        <th>Session Date And Time</th>
                        <th>Notes Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($notes as $note) {
                        $note_id = encrypt($note['note_id']);
                        $session = get_by_id('session',$note['session_id']);
                        $client  = get_by_id('user',$session['client_id'])['user_name'];
                        
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $client ?> </td>
                            <td> <?= $note['note_code'] ?> </td>
                            <td> <?= $session['session_code'] ?> </td>
                            <td> <?= $session['session_date'] ?> </td>
                            <td> <?= $note['note_date_created'] ?> </td>
                            <td>
                                <a href="note?id=<?= $note_id ?>" class="btn btn-success">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="<?= delete_url ?>id=<?= $note_id ?>&table=<?= encrypt('note') ?>&page=<?= encrypt('view_notes') ?>&method=simple_doctor" class="btn btn-danger">
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