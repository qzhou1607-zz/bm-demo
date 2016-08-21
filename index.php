<?php
require_once 'init.php';
//echo 'hello';
//prd($DB);
$sql = 'SELECT * 
        FROM products 
';

$row = $DB->query_as_objects('Product', $sql);
//print_r($row[0]->name);
//prd($row);
include 'includes/header.php';
?>

<div class="shop-main">
    <div class="jumbotron">
        <h1>Everything You Need.</h1>
    </div>
    <div class="catalog col-md-12 col-sm-12">
        <h3>Products</h3>
        <hr>
        <div class="col-md-4 col-sm-4">
            <img src='includes/images/3d-vr-set.jpg'>
        </div>
        <div class="col-md-4 col-sm-4">
            <img src='includes/images/3d-vr-set.jpg'>
        </div>
        <div class="col-md-4 col-sm-4">
            <img src='includes/images/3d-vr-set.jpg'>
        </div>
        
        <div class="col-md-4 col-sm-4">
            <img src='includes/images/3d-vr-set.jpg'>
        </div>
        <div class="col-md-4 col-sm-4">
            <img src='includes/images/3d-vr-set.jpg'>
        </div>
        <div class="col-md-4 col-sm-4">
            <img src='includes/images/3d-vr-set.jpg'>
        </div>
    </div>
</div>



<script>
    $('.navbar-nav').children('li').on('click', function() {
        $(this).find('a').addClass('active');
        return false;
    });
</script>

<?php include 'includes/footer.php'; ?>

