<?php
$page = 'all_products';
require_once '../path.php';
include_once 'header.php';

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'Code', 'title' => 'Code'),
        array('data' => 'User Name', 'title' => 'User Name'),
        array('data' => 'Amount', 'title' => 'Amount'),
        array('data' => 'Sub Items', 'title' => 'Sub Items'),
        array('data' => 'Date Created', 'title' => 'Date Created')
    );
}

$orders = select_rows("SELECT * FROM lab_cart GROUP BY cart_code ORDER BY lab_cart_date_created DESC");

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
      
                        <th>amount</th>
                        <th>sub items</th>
                        <th>Date Created</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($orders as $order) {
                        $user = get_by_id('user',$order['user_id']);
                        $sql = "SELECT cart_code, SUM(cart_price) AS total_cart_price FROM lab_cart WHERE cart_code = '$order[cart_code]' GROUP BY cart_code ";
                        $row = select_rows($sql)[0];
                        $price = $row['total_cart_price'];
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td><?= $order['cart_code'] ?></td>  
                            <td><?= $user["user_name"] ?></td>
                     
                            <td><?= 'Ksh. ' . $price ?></td>  
                            <td>
                                <a href="lab_items?id=<?= encrypt($order['cart_code']) ?>" class="btn btn-primary">
                                    View
                                </a>
                            </td>
                            
                            <td><?= $order['cart_date_created'] ?></td>
                   
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