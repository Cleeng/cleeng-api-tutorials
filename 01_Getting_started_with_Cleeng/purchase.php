<?php
/**
 * Cleeng API Example 1 - Getting started with Cleeng
 *
 * This file should be opened in browser.
 */

// Create your offer ID with create_item_offer.php or use any of these IDs for demo purposes:
// ID 904025583 for sandbox.cleeng.com
// ID 863127249 for cleeng.com (production server)
$itemOfferId = '863127249';

// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

$cleengApi = new Cleeng_Api();
//the SDK communicates by default to cleeng.com (production server). Uncomment below to change this to sanbox.
//$cleengApi = new Cleeng_Api(array('platformUrl' => 'sandbox.cleeng.com'));

?>
<script type="text/javascript" src="http://cdn.cleeng.com/js-api/2.0/api.js"></script>
<script type="text/javascript">
    CleengApi.countItemOfferImpression("<?php echo $itemOfferId ?>");
    function cleengPurchase() {
        CleengApi.purchase("<?php echo $itemOfferId ?>", function (result) {
            // reload page after purchase to reveal protected ite
            // improve the user experience - learn how to load with AJAX in tutorial 2
            window.location.reload();
        });
    }
</script>

<?php

// Check if visitor has access to protected content
if ($cleengApi->isAccessGranted($itemOfferId)) {
    echo 'This content is accessible when you purchase it! Place here the stuff you want to sell.';
} else {
    echo 'Content not accessible. <a href="javascript:cleengPurchase()">Buy</a>';
}

?>
<hr />
<p>&copy; Safe & secure content protection and monetization by <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank"><img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" /></a>.</p>
