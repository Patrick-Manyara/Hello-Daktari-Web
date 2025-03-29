<?php
$page = 'all_products';
require_once '../path.php';
include_once 'header.php';

$orders = get_sub_orders(security('id','GET'));

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'product_email', 'title' => 'Order Code'),
        array('data' => 'product_image', 'title' => 'Image'),
        array('data' => 'product_name', 'title' => 'Product Name'),
        array('data' => 'product_address', 'title' => 'Quantity'),
        array('data' => 'product_phone', 'title' => 'Amount')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> products</h4>

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
                        $order_id = encrypt($order['product_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= get_by_id('orders',$order['order_id'])['order_code'] ?> </td>
                            <td>
                                <img alt="product image" src="<?= file_url . $order['product_image'] ?>" style="width:100px; height:auto; border-radius:5px;" title="<?= $order['product_name'] ?>">
                            </td>
                            <td> <?= $order['product_name'] ?> </td>
                            
                            <td> <?= $order['quantity'] ?> </td>
                            <td> <?= $order['total_price'] ?> </td>
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