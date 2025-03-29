<?php
$page        = 'view_categories';
$header_name = 'categories';

require_once '../path.php';
require_once 'header.php';

$categories = get_all('category');

$num_columns = 4;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'S.no'),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'category_name', 'title' => 'Name'),
        array('data' => '', 'title' => 'Action')
    );
}

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> categories</h4>

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
                    foreach ($categories as $category) {
                        $category_id = encrypt($category['category_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $category['category_name'] ?> </td>
                            
                            <td>
                                <a class='btn btn-info' href="">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <a class="btn btn-danger" href="<?= delete_url ?>id=<?= $category_id ?>&table=<?= encrypt('category') ?>&page=<?= encrypt('view_categories') ?>&method=simple_admin" title="Delete" onclick="return confirm('Are you sure you want to delete this ?');">
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