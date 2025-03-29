<?php
$page = 'all_products';
require_once '../path.php';
include_once 'header.php';
$id = security('id', 'GET');
$sql = "SELECT * FROM lab_cart WHERE cart_code =  '$id' ";
$orders = select_rows($sql);

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'Code', 'title' => 'Code'),
        array('data' => 'Image', 'title' => 'Image'),
        array('data' => 'Product Name', 'title' => ' Name'),
        array('data' => 'Amount', 'title' => 'Amount'),
        array('data' => 'Action', 'title' => 'Action'),
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Lab Tests</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>id</th>
                        <th>Order Code</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($orders as $order) {
                        // $order_id = encrypt($order['product_id']);
                        $lab = get_by_id("lab", $order['lab_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td><?= $order['cart_code'] ?></td>  
                            <td>
                                <img alt="lab image" src="<?= file_url . 'flask.png' ?>" style="width:100px; height:auto; border-radius:5px;" title="<?= $lab['lab_name'] ?>">
                            </td>
                            <td> <?= $lab['lab_name'] ?> </td>

                            <td> <?= $order['cart_price'] ?> </td>
                            <td>
                                <select id="defaultSelect" class="form-select" onchange="window.location.href='<?= model_url ?>status&return=lab_items&column=cart_approved&columnv='+this.value+'&id=<?= encrypt($order['lab_cart_id']) ?>&table=<?= encrypt("lab_cart") ?>&code=<?= $_GET['id'] ?>'">
                                    <option value="no" <?= $order['cart_approved'] == 'no' ? 'selected' : '' ?>>Pending</option>
                                    <option value="yes" <?= $order['cart_approved'] == 'yes' ? 'selected' : '' ?>>Approved</option>
                                </select>
                            </td>
                        </tr>
                    <?php
                        $cnt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="<?= model_url ?>confirm_cart&id=<?= $id ?>" class="btn rounded-pill btn-outline-primary">Confirm Client's Cart</a>
    </div>

</div>
<!-- / Content -->


<?php
include_once 'footer.php';
?>