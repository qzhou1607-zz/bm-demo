<?php
require_once '../../init.php';
$customers = Customer::get_all_customers();
include 'header.php';
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


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Orders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" id="orders">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Confirmation #</th>
                                            <th>Purchased On</th>
                                            <th>Payment Status</th>
                                            <th>Bill to Name</th>
                                            <th>Ship to Name</th>
                                            <th>Total</th>
                                            <th>Shipping Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($customers as $customer) { ?>
                                        <tr>
                                            <td><?= $customer->confirmation_code ?></td>
                                            <td><?= date('Y-m-d', strtotime($customer->updated)) ?></td>
                                            <td><?= $customer->paid?></td>
                                            <td><?= $customer->cc_first_name . ' ' . $customer->cc_last_name ?></td>
                                            <td><?= $customer->first_name . ' ' . $customer->last_name ?></td>
                                            <td>$<?= Order::get_total_by_customer_id($customer->customer_id)?></td>
                                            <td></td>
                                            <td><span><a href="#" id=<?= $customer->customer_id ?> class="toDetails">Details</a></span></td>
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
    
    <div class="details white-popup mfp-hide" id="details"style="overflow:auto;">
</div>
    


<?php include 'footer.php' ?>