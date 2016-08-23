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
<div class="cart-main col-md-12 col-sm-12">
    <div class="catalog col-md-12 col-sm-12">
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
                <td colspan="4" style="text-align:left;padding:20px;border-bottom: none;" data-bind="click:function() {$('#shipping').show();$(location).attr('href','#shipping');}">
                    <button class="btn check-out">Check Out</button></td>
                <td style="padding:20px;border-bottom: none;">Subtotal:</td>
                <td style="padding:20px;border-bottom: none;">$<span data-bind="html:data.subtotal"></span></td>
            </tr>
        </table>
    </div>
</div>
<!-- /ko -->

<div class="checkout-main col-md-12 col-sm-12" id="shipping">
        <div class="col-md-6 col-sm-6">
            <div class="address">
                <h3>Shipping Address</h3>
                <hr>
                <div class="block col-md-6 col-md-6">
                    <label>First Name</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Last Name</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Email Address</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Address 1</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-md-12">
                    <label>Address 2</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>State</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Postal Code</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-md-12">
                    <input type="checkbox">
                    <label>Use this address for billing</label>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6">
            <div class="review-order">
                <h3>Review Your Order</h3>
                <hr>
                <div class="block col-md-12 col-md-12">
                    <table style="width:100%;">
                        <tr>
                            <th style="width:30%;">Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                        <!-- ko foreach:data.orders_array -->
                        <tr>
                            <td><span data-bind="html:$parent.get_product_by_id($data.product_id()).product_name()"></span></td>
                            <td><span data-bind="html:$data.quantity"></span></td>
                            <td>$<span data-bind="html:$parent.get_product_by_id($data.product_id()).product_price()"></span></td>
                            <td>$<span data-bind="html:$data.total"></span></td>
                        </tr>
                        <!-- /ko -->
                        <tr>
                            <td colspan="2"></td>
                            <td><b>Total</b></td>
                            <td><b>$<span data-bind="html:data.subtotal"></span></b></td>
                        </tr>
                    </table>

                </div>
            </div>
            <button class="btn to-billing" style="with:100%;" data-bind="click:function() {$('#billing').show();$(location).attr('href','#billing')}">Proceed</button>
        </div>
</div>
<div class="checkout-main col-md-12 col-sm-12" id="billing">
        <div class="col-md-6 col-sm-6">
            <div class="payment-info">
                <h3>Payment Information</h3>
                <hr>
                <div class="block col-md-6 col-md-6">
                    <label>First Name</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Last Name</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Card Number</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-4 col-sm-4">
                    <label>Month</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-4 col-md-4">
                    <label>Year</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-4 col-md-4">
                    <label>CVV</label>
                    <input class="form-control">
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6">
            <div class="address">
                <h3>Billing Address</h3>
                <hr>
                <div class="block col-md-6 col-md-6">
                    <label>First Name</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Last Name</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Email Address</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Address 1</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-12 col-md-12">
                    <label>Address 2</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>State</label>
                    <input class="form-control">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Postal Code</label>
                    <input class="form-control">
                </div>
            </div>
        </div> 
</div>



<?php include 'includes/footer.php'; ?>

