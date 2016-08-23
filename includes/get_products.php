<?php
require_once '../init.php';

$sql = 'SELECT * FROM products';
$products = $DB->query_as_objects('Product',$sql);

foreach ($products as $index => $product) {
    //echo 'data.orders_array()[' . $index . '].order_id(' . json_encode($order->order_id) . ');';
?>      product = new Product();
        product.product_id(<?= json_encode($product->product_id) ?>);
        product.product_name(<?= json_encode($product->name) ?>);
        product.product_price(<?= json_encode($product->price) ?>);
        product.product_inventory(<?= json_encode($product->inventory) ?>);
        product.product_img_url(<?= json_encode($product->img_url) ?>);
        for (i=1;i<=<?= json_encode($product->inventory)?>;i++) {
            product.dropdown.push(i);
        }
        
        data.products_array.push(product);
    

<?php } ?>

ko.applyBindings(data);

