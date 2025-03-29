<?php
$page        = 'view_groups';
$header_name = 'Groups';

require_once '../path.php';
require_once 'header.php';

$groups = get_all_groups();

$num_columns = 4;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'S.no'),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'company_name', 'title' => 'Name'),
        array('data' => '', 'title' => 'Action')
    );
}

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> groups</h4>

    <!--  -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                    <thead>
                        <tr>
                        <th></th>

                            <th>S.no</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($groups as $group) {
                        $company_id = encrypt($group['company_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $group['company_name'] ?> </td>
                            
                            <td>
                                <a class='btn btn-info' href="">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <a class="btn btn-danger" href="" title="Delete" onclick="return confirm('Are you sure you want to delete Patriciah Kamau?');">
                                    <i style="color: #ffffff" class="fas fa-trash"></i>
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
    </section>
</div>
<!-- container-fluid -->

<!-- End of Main Content -->
<?php include_once 'footer.php'; ?>