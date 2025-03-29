<?php
$page = 'view-doctors';
require_once '../path.php';
include_once 'header.php';
$doctors = get_all_banners();

$num_columns = 5;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'doctor_image', 'title' => 'Image'),
        array('data' => '', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Banners</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>S.no</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (!empty($banners)) {
                        foreach ($banners as $banner) {
                            $banner_id      = encrypt($banner['banner_id']);
                    ?>
                            <tr>
                                <td></td>
                                <td><?= $i++; ?></td>
                                <td><?= $banner['banner_title']; ?></td>
                                <td><img alt="image" src="<?= file_url . $banner['banner_poster'] ?>" style="width:150px; height:auto; border-radius:5px;"></td>
                                <td>
                                    <a class='btn btn-info' href="<?= admin_url ?>banner?id=<?= $banner_id ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger" href="<?= base_url ?>model/delete/index?id=<?= $banner_id ?>&table=<?= encrypt('banner') ?>&page=<?= encrypt('view_banners') ?>&method=simple_admin" title="Delete" onclick="return confirm('Are you sure you want to delete this banner??');">
                                        <i style="color: #ffffff" class="fas fa-trash"></i>
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