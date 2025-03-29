<?php
$page = 'all_products';
require_once '../path.php';
include_once 'header.php';

$num_columns = 10;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'Code', 'title' => 'Code'),
        array('data' => 'User Name', 'title' => 'User Name'),
        array('data' => 'Payment Status', 'title' => 'Payment Status'),
        array('data' => 'Delivery Status', 'title' => 'Delivery Status'),
        array('data' => 'Amount', 'title' => 'Amount'),
        array('data' => 'Sub Items', 'title' => 'Sub Items'),
        array('data' => 'Date Created', 'title' => 'Date Created'),
        array('data' => '', 'title' => 'Action')
    );
}

$orders = get_all_orders();
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> orders</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>id</th>
                        <th>Code</th>
                        <th>User Name</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>amount</th>
                        <th>sub items</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($orders as $order) {
                        if ($order['status'] == 'paid') {
                            $shipped_color = 'success';
                        } else {
                            $shipped_color = 'warning';
                        }

                        if ($order['payment_status'] == 'paid') {
                            $payment_color = 'success';
                        } else {
                            $payment_color = 'warning';
                        }
                        $user = select_rows('SELECT * FROM user WHERE user_id = '. json_encode($order["user_id"]))[0];
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td><?= $order['order_code'] ?></td>  
                            <td><?= $user["user_name"] ?></td>
                            <td>
                                <p class="btn btn-<?= $payment_color ?>"><?= ucwords($order['payment_status'])?></p>
                            </td>
                            
                            <td>
                                <p class="btn btn-<?= $shipped_color ?>"><?= ucwords($order['delivery_status']) ?></p>
                            </td>
                            <td><?= $order['order_amount'] ?></td>  
                            <td>
                                <a href="view_sub_items?id=<?= encrypt($order['orders_id']) ?>" class="btn btn-primary">
                                    View
                                </a>
                            </td>
                            
                            <td><?= $order['date_created'] ?></td>
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