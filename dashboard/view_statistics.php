<?php
$page = 'statistics';
require_once '../path.php';
include_once 'header.php';
$statistics = get_all('statistic');

$num_columns = 5;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'name', 'title' => 'name'),
        array('data' => 'number', 'title' => 'number'),
        array('data' => '', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> statistics</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>S.no</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (!empty($statistics)) {
                        foreach ($statistics as $stat) {
                            $id             = encrypt($stat['statistic_id']);
                            $name           = $stat['statistic_name'];
                            $number         = $stat['statistic_number'];

                    ?>
                            <tr>
                                <td> </td>
                                <td><?= $i++; ?></td>
                                <td><?= $name;       ?></td>
                                <td><?= $number;   ?></td>
                                <td>
                                    <a href="statistic?id=<?= $id ?>" class="btn btn-success">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                </td>
                            </tr>
                    <?php }
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