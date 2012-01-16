<?php
/**
 * Cleeng API Example 3 - Manage pay-per-items
 *
 * Open this file in browser or run it from command line in order
 * to create item offer
 */

// include PHP SDK
include_once('../../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api(array(
    'platformUrl' => 'cleeng.local'
));

$itemOffer1 = $cleengApi->getItemOffer(930339322);
$itemOffer2 = $cleengApi->getItemOffer(108640889);
$itemOffer3 = $cleengApi->getItemOffer(427318025);

echo "Item Offer 1:<br />\n";
print_r($itemOffer1->toArray());

echo "\nItem Offer 2:<br />\n";
print_r($itemOffer2->toArray());

echo "\nItem Offer 3:<br />\n";
print_r($itemOffer3->toArray());
