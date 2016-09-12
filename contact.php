<?php
require_once 'init.php';
include 'includes/header.php';
$shop_id = 1;
$shop = new Shop($DB,$shop_id);
$lat = $shop->lat;
$long = $shop->long;

?>
<div class="shop-main">
    <div class="col-lg-6">
        <div id="map">
        </div>
    </div>
    <div class="col-lg-6 message">
        <div>
            <h3>Address</h3>
            <hr>
            <div class="col-lg-12" style="margin-bottom:15px">
                <span><?= $shop->address_1?></span><br>
                <?php if ($shop->address_2) { ?>
                    <span><?= $shop->address_2 ?></span><br>
                <?php } ?>
                <span><?= $shop-> city ?>, <?= $shop->state ?>, <?= $shop->postal_code ?><br></span>
                <span><?= $shop->email ?></span>,
                <span><?= $shop->phone ?></span>
            </div>
        </div>
        <div>
            <h3>Leave A Message</h3>
            <hr>
            <div class="col-lg-6">
                <input class="form-control half" placeholder="Name" name="name">
            </div>
            <div class="col-lg-6">
                <input class="form-control half" placeholder="Email" name="email">
            </div>
            <div class="col-lg-12">
                <textarea class="form-control" name="content"></textarea>
            </div>
            <div class="col-lg-12">
                <button class="btn" onclick="send_message()">Send Message</button>
            </div>
            <input name="shop_id" value="<?= $shop_id ?>" hidden="">
        </div>
    </div>
</div>

<script>
    function createMap() {
        var myCenter = {lat:<?= $lat ?>,lng:<?= $long ?>};
        var mapCanvas = document.getElementById("map");
        var mapSettings = {
                center: myCenter,
                zoom:8
            }
        var map = new google.maps.Map(mapCanvas,mapSettings);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $google_map_key ?>&callback=createMap"></script>






<?php include 'includes/footer.php'; ?>

