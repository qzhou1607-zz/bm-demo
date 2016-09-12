<?php
require_once '../../init.php';
//require_once '../../lib/Shippo/Shippo.php';

$customer_id = $_REQUEST['customer_id'];
$shop_id = $_REQUEST['shop_id'];
$customer = new Customer($DB, $customer_id);
//$shop = new Shop($DB,$shop_id);
?>
<?php //include '../pages/header.php' ?>
<script>
    function get_shipping_options() {
        $('.get-options-btn').html("Loading Options...");
        $.post('../ajax/shippingoptions.php',
        {
            'to_name': '<?= $customer->first_name ?> <?= $customer->last_name ?>',
            'to_address_1':'<?= $customer->address_1 ?>',
            'to_city':'<?= $customer->city ?>',
            'to_state':'<?= $customer->state ?>',
            'to_country':'<?= $customer->country ?>',
            'to_phone': '<?= $customer->phone ?>',
            'to_email': '<?= $customer->email ?>',
            'customer_id':'<?= $customer_id ?>',
            'shop_id':'<?= $shop_id ?>'

        }
        ,function(response) {
            $('.ship-options').html(response);
            $('.ship-options').slideDown(750);
            $('.confirm-label-btn').show();
            $('.get-options-btn').hide();
        });  
    }
    function send_selected_option() {
        $('.confirm-label-btn').html("Loading...");
        $.post('../ajax/send-selected.php',
        {
            'object_id': $('input[name=selected-option]:checked').val(),
            'customer_id':<?= $customer_id ?>
        }
        ,function(response) {
            $('.selected-option').html(response);
            $('.ship-options').slideUp();
            $('.selected-option').slideDown();
            $('.confirm-label-btn').hide();
        });  
    }
</script>
<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 15px;">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Shipping Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive" id="payment-details">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td><b>Name</b></td>
                                    <td colspan="3"><?= $customer->last_name . ', ' .$customer->first_name?></td>
                                </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td colspan="3">
                                                <?= $customer->address_1 
                                                    . (is_null($customer->address_2) ? '' : ', ' . $customer->address_2)
                                                    . ', ' . $customer->state
                                                    . ', ' . $customer->postal_code
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td colspan="3"><?= $customer->phone ?></td>
                                        </tr>
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

<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 15px;">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
            <?php if (is_null($customer->tracking_num)) { ?>
            <div class="if-not-shipped">
                <button class="btn not-yet get-options-btn" style="width: 100%;" onclick="get_shipping_options()">Shipping Options</button>
                <div class="panel panel-default ship-options" style="display:none">
                </div>
                <div class="panel panel-default selected-option" style="display: none">
                </div>
                <button class="btn not-yet confirm-label-btn" onclick="send_selected_option()" style="display: none;">Print Label</button>
            </div>
            <?php } else { ?>
            <div class="if-shipped">
                <div class="panel panel-default selected-option">
                    <div class="panel-heading">
                        Tracking #: <?= $customer->tracking_num ?>
                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive" id="payment-details">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <a target="_blank" href="<?= $customer->label_url ?>" class="btn done">Print Label</a>
                                        <a target="_blank" href="<?= $customer->tracking_url ?>" class="btn done">Track Package</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.panel -->
            <?php } ?>
        </div>
        <!-- /.col-lg-6 -->
    </div>
</div>
<?php //include '../pages/footer.php'; ?>

