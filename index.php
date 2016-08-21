<?php
require_once 'init.php';
//echo 'hello';
//prd($DB);
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
    <div class="catalog col-md-12 col-sm-12">
        <h3>Products</h3>
        <hr>
        <?php foreach ($products as $product) { ?>
        <div class="col-md-4 col-sm-4">
            <div class="display-box">
                <img src= <?= 'includes/images' . $product->img_url ?>>
                <span class="product-name"><?= $product->name ?></span>
            </div>
        </div> 
        <?php } ?>
    </div>
</div>



<script>
    $('.navbar-nav').children('li').on('click', function() {
        $(this).find('a').addClass('active');
        return false;
    });
</script>

<?php include 'includes/footer.php'; ?>

