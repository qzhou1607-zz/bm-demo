<?php
require_once 'init.php';
include 'includes/header.php';
$sql = 'SELECT * FROM orders WHERE customer_id = 1 ';
$orders = $DB->query_as_objects('Order',$sql);
//prd($orders);
?>

<div class="cart-main">
    <div class="catalog col-md-12 col-sm-12">
        <h3>Here's What You're Getting!</h3>
        <hr>
        <span>You Have 3 items in your order.</span>
        <table>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>#</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php foreach ($orders as $order) { 
                $product = new Product($DB, $order->product_id);
                ?>
            <tr class="cart-item">
                <td><img src="<?= 'includes/images' . $product->img_url ?>"></td>
                <td><?= $product->name ?></td>
                <td>$<?= $product->price ?></td>
                <td><?= $order->quantity ?></td>
                <td>$<?= $product->price * $order->quantity ?></td>
                <td><button class="btn delete-from-cart">Delete</button></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php include 'includes/footer.php';?>