<?php
require_once '../../init.php';
require_once '../../lib/Shippo/Shippo.php';

Shippo::setApiKey("40a6cc70e6267430d2668758601c467523d6d45f");


// Purchase the desired rate
$transaction = Shippo_Transaction::create(array(
    'rate'=> $_REQUEST['object_id'],
    'async'=> false
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

