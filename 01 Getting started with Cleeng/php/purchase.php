<?php
// Create your offer ID with create_item_offer.php or use ID 930339322 for demo purposes.
$itemOfferId = '930339322';

// include PHP SDK
include_once('../../cleeng-php-sdk/cleeng_api.php');
//$cleengApi = new Cleeng_Api(array('platformUrl' => 'staging.cleeng.com'));
$cleengApi = new Cleeng_Api(array('platformUrl' => 'cleeng.local'));

?>
<script type="text/javascript" src="https://cleeng.local/js-api/2.0/api.js"></script>
<script type="text/javascript">
    CleengApi.countItemOfferImpression("<?php echo $itemOfferId ?>");
    function cleengPurchase() {
        CleengApi.purchase("<?php echo $itemOfferId ?>", function (result) {
            // reload page after purchase to reveal protected item
            window.location.reload();
        });
    }
</script>

<?php

if ($cleengApi->isAccessGranted($itemOfferId)) {
    echo 'This content is accessible when you purchase it! Place here the stuff you want to sell.';
} else {
    echo 'Content not accessible. <a href="javascript:cleengPurchase()">Buy</a>';
}