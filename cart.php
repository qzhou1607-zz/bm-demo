<?php
require_once 'init.php';
include 'includes/header.php';
//$sql = 'SELECT * FROM orders WHERE customer_id = 1 ';
//$orders = $DB->query_as_objects('Order',$sql);
//prd($orders);
?>
<script src="includes/shop.js"></script>
<div class="cart-main">
    <div class="catalog col-md-12 col-sm-12">
        <h3>Here's What You're Getting!</h3>
        <hr>
        <span>You Have <span data-bind="html: orders_array().length"></span> items in your order.</span>
        <table>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>#</th>
                <th>Total</th>
                <th></th>
            </tr>
            <!-- ko foreach: data.orders_array() -->
            <tr class="cart-item">
                <td><img data-bind="attr: {src:'includes/images'+$data.product_img_url()}"></td>
                <td><span data-bind="html:$data.product_name"></span></td>
                <td><span data-bind="html:$data.product_price"></span></td>
                <td><input data-bind="value:$data.quantity"></td>
                <td>$<span data-bind="html:$data.total"></span></td>
                <td><button class="btn delete-from-cart" data-bind="click:$parent.remove_item">Delete</button></td>
            </tr>
            <!--/ko  -->
            <tr>
                <td colspan="4"></td>
                <td>Subtotal:</td>
                <td style="padding:20px;">$<span data-bind="html:data.subtotal"></span></td>
            </tr>
        </table>
    </div>
</div>

<?php include 'includes/footer.php';?>