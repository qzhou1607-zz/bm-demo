<?php
require_once '../init.php';

$sql = 'SELECT * FROM orders WHERE customer_id = 1 ';
$orders = $DB->query_as_objects('Order',$sql);

foreach ($orders as $index => $order) {
    $product = new Product($DB, $order->product_id);
    //echo 'data.orders_array()[' . $index . '].order_id(' . json_encode($order->order_id) . ');';
?>
    order = new Order();
    order.product_id(<?= json_encode($order->product_id) ?>);
    order.customer_id(<?= json_encode($order->customer_id) ?>);
    order.quantity(<?= json_encode($order->quantity) ?>);
    order.paid(<?= json_encode($order->paid) ?>);
    order.product_name(<?= json_encode($product->name) ?>);
    order.product_price(<?= json_encode($product->price) ?>);
    order.product_inventory(<?= json_encode($product->inventory) ?>);
    order.product_img_url(<?= json_encode($product->img_url) ?>);
    
    data.orders_array.push(order);
    

<?php } ?>
ko.applyBindings(data);
