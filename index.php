<?php
require_once 'init.php';
//$product = new Product($DB);
//prd(count($product->data));
$sql = 'SELECT * 
        FROM products 
';

$products = $DB->query_as_objects('Product', $sql);
//print_r($row[0]->name);
//prd($products);
include 'includes/header.php';

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
                        <button id = "test" class="btn add-to-cart" data-bind="click:function(){$data.added(1); $parent.add_item($data.product_id(), $data.quantity()); }, text: $data.added() == 1 ? 'Added' : 'Add To Cart'"></button>
                    </span>
                        
                </div>
            </div>
        </div> 
        <!-- /ko -->
    </div>
</div>


<!-- ko if: data.orders_array().length > 0 -->
<div class="cart-main col-md-12 col-sm-12" id="cart">
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
                <th>Subtotal</th>
                <th></th>
            </tr>
            <!-- ko foreach: data.orders_array -->
            <tr class="cart-item">
                <td><img data-bind="attr: {src:'includes/images'+$parent.get_product_by_id($data.product_id()).product_img_url()}"></td>
                <td><span data-bind="html:$parent.get_product_by_id($data.product_id()).product_name()"></span></td>
                <td>$<span data-bind="html:$parent.get_product_by_id($data.product_id()).product_price()"></span></td>
                <td><input data-bind="value:$data.quantity"></td>
                <td>$<span data-bind="html:$data.total"></span></td>
                <td><button class="btn delete-from-cart" data-bind="click:$parent.remove_item">Delete</button></td>
            </tr>
            <!--/ko  -->
            <tr>
                <td colspan="4" style="text-align:left;padding:20px;border-bottom: none;" data-bind="click:function() {$('#shipping').show();$(location).attr('href','#shipping');}">
                    <button class="btn color-button">Check Out</button></td>
                <td style="padding:20px;border-bottom: none;">Total:</td>
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
                    <input class="form-control" data-bind="value:data.customer().first_name">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Last Name</label>
                    <input class="form-control" data-bind="value:data.customer().last_name">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Email Address</label>
                    <input class="form-control" data-bind="value:data.customer().email">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Phone</label>
                    <input class="form-control" data-bind="value:data.customer().phone">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Address 1</label>
                    <input class="form-control" data-bind="value:data.customer().address_1">
                </div>
                <div class="block col-md-12 col-md-12">
                    <label>Address 2</label>
                    <input class="form-control" data-bind="value:data.customer().address_2">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>City</label>
                    <input class="form-control" data-bind="value:data.customer().city">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>State</label>
                    <input class="form-control" data-bind="value:data.customer().state">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Country</label>
                    <input class="form-control" data-bind="value:data.customer().country">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Postal Code</label>
                    <input class="form-control" data-bind="value:data.customer().postal_code">
                </div>
                <div class="block col-md-12 col-md-12">
                    <input type="checkbox" data-bind="checked:data.customer().same_address">
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
            <button class="btn color-button" style="with:100%;" data-bind="click:function() {$('#billing').show(); $('#submit').show();$(location).attr('href','#billing')}">To Billing</button>
            <button class="btn color-button" data-bind="click: data.generate_mock_data" style="float: right;">Generate Customer Information</button>
        </div>
</div>
<div class="checkout-main col-md-12 col-sm-12" id="billing">
        <div class="col-md-6 col-sm-6">
            <div class="payment-info">
                <h3>Payment Information</h3>
                <hr>
                <div class="block col-md-6 col-md-6">
                    <label>First Name</label>
                    <input class="form-control" data-bind="value:data.customer().cc_first_name">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>Last Name</label>
                    <input class="form-control" data-bind="value:data.customer().cc_last_name">
                </div>
                <div class="block col-md-12 col-sm-12">
                    <label>Card Number</label>
                    <input class="form-control" data-bind="value:data.customer().cc_num">
                </div>
                <div class="block col-md-4 col-sm-4">
                    <label>Month</label>
                    <input class="form-control" data-bind="value:data.customer().cc_month">
                </div>
                <div class="block col-md-4 col-md-4">
                    <label>Year</label>
                    <input class="form-control" data-bind="value:data.customer().cc_year">
                </div>
                <div class="block col-md-4 col-md-4">
                    <label>CVV</label>
                    <input class="form-control" data-bind="value:data.customer().cc_cvv">
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6">
            <div class="address">
                <h3>Billing Address</h3>
                <hr>
                <div class="block col-md-12 col-sm-12">
                    <label>Address 1</label>
                    <input class="form-control" data-bind="value:data.customer().billing_address_1">
                </div>
                <div class="block col-md-12 col-md-12">
                    <label>Address 2</label>
                    <input class="form-control" data-bind="value:data.customer().billing_address_2">
                </div>
                <div class="block col-md-12 col-md-12">
                    <label>City</label>
                    <input class="form-control" data-bind="value:data.customer().billing_city">
                </div>
                <div class="block col-md-6 col-md-6">
                    <label>State</label>
                    <input class="form-control" data-bind="value:data.customer().billing_state">
                </div>
                <div class="block col-md-12 col-md-12">
                    <label>Country</label>
                    <input class="form-control" data-bind="value:data.customer().billing_country">
                </div>                
                <div class="block col-md-6 col-md-6">
                    <label>Postal Code</label>
                    <input class="form-control" data-bind="value:data.customer().billing_postal_code">
                </div>
            </div>
        </div> 
</div>
<div class="col-md-12 col-sm-12" id="submit" style="display: none;text-align: right" onclick="send_data(data)">
    <div class="col-md-12 col-sm-12" style="text-align:left">
         <button class="btn color-button">Submit</button>
    </div>
</div>


<?php include 'includes/footer.php'; ?>

