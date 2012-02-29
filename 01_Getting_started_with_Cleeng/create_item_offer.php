<?php
/**
 * Cleeng API Example 1 - Getting started with Cleeng
 *
 * Open this file in browser or run it from command line in order
 * to create item offer
 */

// define PHP SDK configuration
$platformUrl = 'cleeng.com';
$publisherToken = 'YOUR_PUBLISHER_TOKEN'; // get it from http://cleeng.com/dev/api-keys

// define item offer properties (for more details see reference of createItemOffer())
$itemOfferSetup = array(
    'url' => 'http://your-site.com/view-item-here',
    'description' => 'Buy this item for just $0.49. You will love it!',
    'price' => 0.49
);

// --------------------------------------------------------------------
// you don't need to touch everying below :-)

// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api(array(
    'platformUrl' => $platformUrl,
    'publisherToken' => $publisherToken
));

// create item offer on Cleeng Platform
$itemOffer = $cleengApi->createItemOffer($itemOfferSetup);

// echo ID of new item
echo 'Created item offer with id = ' . $itemOffer->id . "\n";

?>
<hr />
<p>&copy; Safe & secure content protection and monetization by <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank"><img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" /></a>.</p>
