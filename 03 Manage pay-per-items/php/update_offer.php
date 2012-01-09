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
    'platformUrl' => 'cleeng.local',
    'publisherToken' => 'aHaFMTynO59PK0xEL9v9Rz6X4wYk4VM7JpHIMxCbcbsnukQ-'
));

// update item offer
$itemOffer = $cleengApi->updateItemOffer(707221016, array(
    'price' => 0.99    // change price
 ));

if ($itemOffer->hasErrors()) {
    echo "Unable to update item offer:\n";
    print_r($itemOffer->getError());
}

echo "Updated item offer:\n";
print_r($itemOffer->toArray());

