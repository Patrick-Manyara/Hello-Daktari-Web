<?php
$page = 'all_products';
require_once '../path.php';
include_once 'header.php';
$products = get_all_products();

$num_columns = 9;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'product_image', 'title' => 'Image'),
        array('data' => 'product_name', 'title' => 'Name'),
        array('data' => 'product_email', 'title' => 'Email'),
        array('data' => 'product_phone', 'title' => 'Phone'),
        array('data' => 'product_address', 'title' => 'Address'),
        array('data' => 'product_gender', 'title' => 'Gender'),
        array('data' => '', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> products</h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
        Upload Using Excel
    </button>
    <!-- Upload Excel Modal -->
    <div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="uploadExcelForm" method="POST" enctype="multipart/form-data" action="<?= model_url ?>product2">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadExcelModalLabel">Upload Products Using Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6 text-center">

                            <a type="button" class="btn btn-info" href="price_list.xlsx">
                                Download Example Excel Format
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <label for="excel_file" class="form-label">Select Excel File</label>
                            <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx, .xls">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">

                            <?php
                            $categories     = get_dropdown_data(get_all_categories(), 'category_name', 'category_id');
                            $units          = get_dropdown_data(get_units(), 'unit_name', 'unit_id');
                            $brands         = get_dropdown_data(get_brands(), 'brand_name', 'brand_id');
                            $tags           = get_dropdown_data(get_all('tag'), 'tag_title', 'tag_id');
                            $subcategories  = get_dropdown_data(get_subcategories(), 'subcategory_name', 'subcategory_id');
                            input_select_array("Category", "category_id", $product, $require, $categories);
                            ?>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_select_array("Subcategory", "subcategory_id", $product, false, $subcategories);
                            ?>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_select_array("Brands", "brand_id", $product, false, $brands);
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_select_array("Product Tags", "tag_id", $product, false, $tags);
                            ?>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_select('In Stock?', 'product_in_stock', $product, $require, array('yes', 'no'));
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_hybrid("Quantity/Stock", "product_quantity", $product,
                            $require, 'number');
                            ?>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_select_array("Unit", "unit_id", $product, false, $units);
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_select('Featured?', 'product_group', $product, $require, array('featured', 'no'));
                            ?>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            textarea_input("Description", "product_description", $product, $require);
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php

                            if (!empty($product['product_image'])) {
                                $require = false;
                                $product_image = $product['product_image'];
                            } else {
                                $require = true;
                                $product_image = 'white_bg_image.png';
                            }
                            input_hybrid("Product Image", "product_image", $product,
                            $require, "file", 'my_img', '', 'img');
                            ?>
                            <div class="text-center">
                                <i>accepetd image types are: .png, .jpg, .jpeg</i>
                            </div>
                            <img alt="image" src="<?= file_url . $product_image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:100px; width: 100px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($products as $product) {
                        $product_id = encrypt($product['product_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td>
                                <img alt="product image" src="<?= file_url . $product['product_image'] ?>" style="width:100px; height:auto; border-radius:5px;" title="<?= $product['product_name'] ?>">
                            </td>
                            <td> <?= $product['product_name'] ?> </td>
                            <td> <?= $product['product_email'] ?> </td>
                            <td> <?= $product['product_phone'] ?> </td>
                            <td> <?= $product['product_address'] ?> </td>
                            <td> <?= $product['product_gender'] ?> </td>
                            <td>
                                <a href="<?= admin_url ?>product?id=<?= $product_id ?>" class="btn btn-success">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="<?= delete_url ?>id=<?= $product_id ?>&table=<?= encrypt('product') ?>&page=<?= encrypt('view_products') ?>&method=product" class="btn btn-danger">
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