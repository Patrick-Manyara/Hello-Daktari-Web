<?php
$page        = 'order';
$header_name = 'Order List';

require_once '../path.php';
require_once  'header.php';

$bg_color = $_GET['color'];

if (!isset($_GET['id'])) redirect_header(admin_url . 'view_orders');

$id = security('id', 'GET');

session_assignment(array(
    'edit' => $id
), false);

$ordered_products = select_rows("SELECT * FROM sub_orders WHERE order_id = ".$id);
$delivery_date    = get_single_order($id);
$shipping_detail  = get_shipping_details(security('uid', 'GET'), $id);

$user = select_rows('SELECT * FROM user WHERE user_id = '. json_encode($order["user_id"]))[0];
$hub = select_rows("SELECT * FROM hub WHERE hub_id = ". json_encode($order["hub_id"]))[0];
$picker = select_rows("SELECT * FROM sysusers WHERE userID = ". json_encode($order["assignedTo"]));
?>
<div class="container">
    <div class="p-2 mb-5">
        <button type="button" class="btn btn-<?= $bg_color ?> text-light ml-2 mb-2" data-toggle="modal" data-target="#exampleModal">
            Change Shipping Status
        </button>
        <span class="h4 p3 float-right">Order Number: <?= $id ?></span><br />
        <span class="h4 p3 float-right">Deliver By: <?= date('d-M-Y', strtotime($_GET['deliver_by'])) ?></span>
    </div>
<!--Create a modal for updating product submission-->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= model_url ?>order" method="POST">
                    <div class="modal-header bg-<?= $bg_color ?>">
                        <h5 class="modal-title" id="exampleModalLabel">Change Shipping Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="date">expected delivery date</label>
                        <input type="date" id="date" value="<?= $delivery_date['deliveryDate'] ?>" class="input-group date form-control mb-2" name="deliveryDate">
                        <select class="form-control" name="shipped" id="exampleFormControlSelect1" required>
                            <option value="" disabled selected>Shipping Status</option>
                            <option value="In Process">In Process</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-<?= $bg_color ?>">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="connectedSortable">
        <div class="card card-<?= $bg_color ?>">
            <div class="card-header">
                <h3 class="card-title">View Orders</h3>
            </div>
            <div class="card-body">
                <table class="table" id="tb1">
                    <thead>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Submitted</th>
                        <th>Vendor</th>
                        <th>End Submission Date</th>
                    </thead>
                    <?php
                    $cnt = 1;
                    foreach ($ordered_products as $order_product) {
                        $query = "SELECT * FROM product 
                              JOIN product_image ON product.product_id = product_image.product_id 
                              WHERE product.product_id = " . json_encode($order_product["product_id"]);

                        $ordered_product = select_rows($query)[0];
                        
                        $shipped_color = $ordered_product['productSubmitted'] == 'No' ? 'warning' : ($ordered_product['productSubmitted'] == 'Yes' ? 'success' : 'info');
                    ?>
                        <tr>
                            <td>
                                <?= $cnt ?>.        
                                <button style="border: none;all: unset" type="button" class="text-primary" data-toggle="modal" data-target="#exampleModal<?= $cnt ?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </td>
                            <td>
                                <img alt="product image" src="<?= file_url . $ordered_product['product_image_one'] ?>" width="120" height="100">
                            </td>
                            <td><?= $ordered_product['product_name'] ?></td>
                            <td><?= number_format($ordered_product['product_offer_price'] ? $ordered_product['product_price'] : $ordered_product['product_offer_price'], 2) ?></td>
                            <td><?= $order_product['quantity'] ?></td>
                            <td><?= number_format($order_product['total_price'], 2) ?></td>
                            <td class="text-<?= $shipped_color ?>"><?= $ordered_product['productSubmitted'] ?></td>
                           <td> 
                                <a href="<?= admin_url ?>customer?id=<?= encrypt($ordered_product['userId']) ?>&vendor=true&deliverBy=<?= $_GET['deliver_by'] ?>&orderNumber=<?= $_GET['order'] ?>&color=<?= $_GET['color'] ?>&orderId=<?= $_GET['id'] ?>">
                                    <?= get_customer_profile($ordered_product['userId'])['userName'] ?>
                                </a>
                            </td>
                            <td><?= $ordered_product['date_created'] ?></td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?= $cnt ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="<?= model_url ?>ordered_product&id=<?= encrypt($ordered_product['orderedProductId']) ?>" method="POST">
                                        <div class="modal-header bg-<?= $bg_color ?>">
                                            <h5 class="modal-title" id="exampleModalLabel">Change Submission Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php input_select('Submitted Status', 'productSubmitted', array(), true, array('No', 'Yes', 'In Transit')) ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-<?= $bg_color ?>">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php $cnt++;
                    } ?>
                </table>
            </div>
        </div>
    </section>
    <section class="connectedSortable">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Shipment Details</h3>
            </div>
            <div class="card-body">
                <table class="table" id="tb1">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Convinience Fee</th>
                    </thead>
                    <tr>
                        <td><?= $shipping_detail['shippingFirstName'] ?></td>
                        <td><?= $shipping_detail['shippingLastName'] ?></td>
                        <td><?= $shipping_detail['shippingPhoneNumber'] ?></td>
                        <td><?= $shipping_detail['shippingEmail'] ?></td>
                        <td><?= $shipping_detail['place'] ?></td>
                        <td><?= $shipping_detail['cost'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</div>
<?php require_once 'footer.php';