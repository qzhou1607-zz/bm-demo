<?php

require_once '../../init.php';

$customer_id = $_REQUEST['customer_id'];
$customer = new Customer($DB, $customer_id);
$orders = $customer->get_orders();
?>
<?php //include '../pages/header.php' ?>
<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 15px;">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Order Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive" id="order-details">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 300px;">Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Inventory</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($orders as $order) { ?>
                                    <?php $product_id = $order->product_id; 
                                          $product = new Product($DB, $product_id);  
                                    ?>
                                    <tr>
                                        <td><?= $product->name ?></td>
                                        <td>$<?= $product->price ?></td>
                                        <td><?= $order->quantity ?></td>
                                        <td><?= $product->inventory ?></td>
                                        <td><?= $order->total ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td colspan="4">$<?= Order::get_total_by_customer_id($customer->customer_id) ?></td>   
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <div class="row">
        <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Payment Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive" id="payment-details">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td><b>Name</b></td>
                                    <td colspan="3"><?= $customer->cc_last_name . ', ' .$customer->cc_first_name?></td>
                                </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td colspan="3">
                                                <?= $customer->address_1 
                                                    . (is_null($customer->address_2) ? '' : ', ' . $customer->address_2)
                                                    . ', ' . $customer->state
                                                    . ', ' . $customer->postal_code
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Card Number</b></td>
                                            <td colspan="3"><?= $customer->cc_num ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Month/Year</b></td>
                                            <td colspan="3"><?= $customer->cc_month . '/' . $customer->cc_year ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>CVV</b></td>
                                            <td colspan="3"><?= $customer->cc_cvv ?></td>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
</div>
<?php //include '../pages/footer.php'; ?>