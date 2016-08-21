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
    <div class="catalog col-md-12 col-sm-12">
        <h3>Products</h3>
        <hr>
        <?php foreach ($products as $product) { ?>
        <div class="col-md-4 col-sm-4">
            <div class="display-box">
                <img src= <?= 'includes/images' . $product->img_url ?>>
                <span class="product-name"><?= $product->name ?></span>
                <span class="product-price">$<?= $product->price ?>/ <?= $product->inventory ?> left</span>
                <div class="input-group">
                    <select name="quantity" id="<?= $product->product_id ?>" class="form-control product-quantity" placeholder="Quantity">
                        <?php for ($i = 1; $i <= $product->inventory; $i++ ) { ?>
                        <option value=<?= $i ?>><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn add-to-cart">Add to card</button>
                    </span>
                </div>
            </div>
        </div> 
        <?php } ?>
    </div>
</div>



<script>
    $('.add-to-cart').on('click', function() {
        that = $(this);
        $.post('includes/ajax/add-to-cart.php', 
            {
                product_id:that.closest('.input-group-btn').siblings('.product-quantity').attr('id'),
                quantity: that.closest('.input-group-btn').siblings('.product-quantity').val(),
                customer_id:<?= $customer_id ?>
            }, 
            function(response) {
                if (response.success) {
                    that.html('Added');
                    that.closest('.display-box').addClass('added');
                    that.attr('disabled','disabled');
                    that.closest('.input-group-btn').siblings('.product-quantity').attr('disabled', 'disabled');
                }
            }, 'json');
    });
</script>

<?php include 'includes/footer.php'; ?>

