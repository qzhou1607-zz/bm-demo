<?php
require_once '../../init.php';
require_once '../assets/dictionary.php';
include 'header.php';
$shop_id = 1;
$shop = new Shop($DB,$shop_id);

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
                <a class="navbar-brand" href="index.html">Qing's Shop</a>
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
                                <li>
                                    <a href="payment.php">Payment</a>
                                </li>
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
                    <h1 class="page-header">Address</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form method="POST">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Please Fill in Your Mailing Address Information 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input class="form-control" name="first_name" value="<?= $shop->first_name ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input class="form-control" name="last_name" value="<?= $shop->last_name ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" name="email" value="<?= $shop->email ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="form-control" name="phone" value="<?= $shop->phone ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address 1</label>
                                                <input class="form-control" name="address_1" value="<?= $shop->address_1 ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address 2</label>
                                                <input class="form-control" name="address_2" value="<?= $shop->address_2 ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input class="form-control" name="city" value="<?= $shop->city ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control"name="state">
                                                       <?php foreach ($states as $code => $state) { ?>
                                                            <option value="<?= $code?>"<?= $shop->state == $code ? 'selected' : ''?>><?= $state ?></option>
                                                       <?php }?>     
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control" name="country" value="<?= $shop->country ?>">
                                                    <?php foreach ($countries as $code => $country) { ?>
                                                    <option value="<?= $code ?>" <?= $shop->country == $code ? 'selected' : ''?>><?= $country ?></option> 
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input class="form-control" name="postal_code" value="<?= $shop->postal_code ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Distance Unit</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="distance_unit" value="in" <?= $shop->distance_unit == 'in' ? 'checked':''?>>inch
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="distance_unit" value="cm" <?= $shop->distance_unit == 'cm' ? 'checked':''?>>cm
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Weight Unit</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="weight_unit" value="lb" <?= $shop->weight_unit == 'lb' ? 'checked':''?>>lb
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="weight_unit" value="kg" <?= $shop->weight_unit == 'kg' ? 'checked':''?>>kg
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                                
                                <!-- /.col-lg-12 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-default" value="SAVE">Submit Button</button> 
                    </div>
            </div> 
            </form>
            
            
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
