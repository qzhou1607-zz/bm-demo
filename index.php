<?php
require_once 'init.php';
$sql = 'SELECT * 
        FROM products 
';

$products = $DB->query_as_objects('Product', $sql);
//print_r($row[0]->name);
//prd($products);
include 'includes/header.php';
$customer_id = 1;
?>

<div class="shop-main">
    <div class="jumbotron">
        <h1>Everything You Need.</h1>
    </div>
    <div class="catalog col-md-12 col-sm-12" id="shop">
        <h3>Products</h3>
        <hr>
        <!-- ko foreach:data.products_array -->
        <div class="col-md-4 col-sm-4">
            <div class="display-box" data-bind="css:{'added':$data.added() == 1}">       
                <img data-bind="attr: {src:'includes/images' + $data.product_img_url()}">
                <span class="product-name" data-bind="html:$data.product_name"></span>
                <span class="product-price">$<span data-bind="html:$data.product_price"></span>/ <span data-bind="html:$data.product_inventory"></span> left</span>
                <div class="input-group">
                    <select name="quantity" class="form-control product-quantity" placeholder="Quantity" data-bind="attr:{id:$data.product_id}, options:$data.dropdown, value: $data.quantity">
                    </select>
                    <span class="input-group-btn">
                        <button id = "test" class="btn add-to-cart" data-bind="click:function(){$data.added(1); $parent.add_item($data.product_id(), $data.quantity(), <?= $customer_id ?>); }, text: $data.added() == 1 ? 'Added' : 'Add To Cart'"></button>
                    </span>
                        
                </div>
            </div>
        </div> 
        <!-- /ko -->
    </div>
</div>


<!-- ko if: data.orders_array().length > 0 -->
<div class="cart-main">
    <div class="catalog col-md-12 col-sm-12" id="cart">
        <h3>Here's What You're Getting!</h3>
        <hr>
        <span>You Have <span data-bind="html: data.orders_array().length"></span> items in your order.</span>
        <table>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>#</th>
                <th>Total</th>
                <th></th>
            </tr>
            <!-- ko foreach: data.orders_array -->
            <tr class="cart-item">
                <td><img data-bind="attr: {src:'includes/images'+$parent.get_product_by_id($data.product_id()).product_img_url()}"></td>
                <td><span data-bind="html:$parent.get_product_by_id($data.product_id()).product_name()"></span></td>
                <td><span data-bind="html:$parent.get_product_by_id($data.product_id()).product_price()"></span></td>
                <td><input data-bind="value:$data.quantity"></td>
                <td>$<span data-bind="html:$data.total"></span></td>
                <td><button class="btn delete-from-cart" data-bind="click:$parent.remove_item">Delete</button></td>
            </tr>
            <!--/ko  -->
            <tr>
                <td colspan="4" style="text-align:left;padding:20px;border-bottom: none;"><button class="btn check-out">Check Out</button></td>
                <td style="padding:20px;border-bottom: none;">Subtotal:</td>
                <td style="padding:20px;border-bottom: none;">$<span data-bind="html:data.subtotal"></span></td>
            </tr>
        </table>
    </div>
</div>
<!-- /ko -->




<?php include 'includes/footer.php'; ?>

