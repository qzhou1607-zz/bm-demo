<?php
require_once '../../init.php';
require_once '../assets/dictionary.php';
include 'header.php';
$shop_id = 1;
$shop = new Shop($DB,$shop_id);
$products = $shop->get_products();
//prd($products);

if(sizeof($_REQUEST) > 0) {
    if ($shop->update($_REQUEST)) { 
       $msg = '"Success!","Your Address was Saved!","success"';
    } else {
        $msg = '"Sorry!","Something is Wrong!","warning"';
    }
}



?>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php">Qing's Shop</a>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="products.php"><i class="fa fa-cubes fa-fw"></i> Products </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="address.php">Address</a>
                                </li>
<!--                                <li>
                                    <a href="payment.php">Payment</a>
                                </li>-->
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current List of Products 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" id="orders">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Inventory</th>
                                            <th>Length(<?= $shop->distance_unit ?>)</th>
                                            <th>Height (<?= $shop->distance_unit ?>)</th>
                                            <th>Weight (<?= $shop-> weight_unit ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?= $product->name ?></td>
                                            <td><?= $product->price ?></td>
                                            <td><?= $product->inventory ?></td>
                                            <td><?= $product->length ?></td>
                                            <td><?= $product->height ?></td>
                                            <td><?= $product->weight ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <div class="shipping-details white-popup mfp-hide" id="shipping-details" style="overflow:auto"></div>
    <div class="details white-popup mfp-hide" id="details"style="overflow:auto;">
</div>
    
<?php 
    if (isset($msg)) {
        echo '<script>swal(' . $msg . ')</script>';
    }
?>


<?php include 'footer.php' ?>
