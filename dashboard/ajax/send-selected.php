<?php
require_once '../../init.php';
require_once '../../lib/Shippo/Shippo.php';

Shippo::setApiKey("40a6cc70e6267430d2668758601c467523d6d45f");


// Purchase the desired rate
$transaction = Shippo_Transaction::create(array(
    'rate'=> $_REQUEST['object_id'],
    'async'=> false
));

if ($transaction["object_status"] == "SUCCESS") {
//update customer table
    $customer = new Customer($DB, $_REQUEST['customer_id']);
    $customer->update(array(
        'tracking_num' => $transaction["tracking_number"],
        'tracking_url' => $transaction["tracking_url_provider"],
        'label_url'    => $transaction["label_url"]
    ));
?>

<div class="panel-heading">
    Tracking #: <?= $transaction["tracking_number"] ?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="table-responsive" id="payment-details">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
                <tr>
                    <td colspan="2">
                        <a target="_blank" href="<?= $transaction["label_url"] ?>" class="btn done">Print Label</a>
                        <a target="_blank" href="<?= $transaction["tracking_url_provider"] ?>" class="btn done">Track Package</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.table-responsive -->
</div>
<!-- /.panel-body -->
<?php } else { ?>
<div class="panel-heading">
    Failed to Purchase this Label
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="table-responsive" id="payment-details">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
                <tr>
                    <td>
                    <?php foreach ($transaction["messages"] as $message) {
                        echo $message['text'];
                    }?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.table-responsive -->
</div>
<!-- /.panel-body -->
<?php } ?>