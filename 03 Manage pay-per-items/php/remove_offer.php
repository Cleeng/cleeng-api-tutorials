<?php
/**
 * Cleeng API Example 3 - Manage pay-per-items
 *
 * Open this file in browser or run it from command line in order
 * to remove item offer
 */

// include PHP SDK
include_once('../../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api(array(
    'platformUrl' => 'cleeng.local',
    'publisherToken' => 'aHaFMTynO59PK0xEL9v9Rz6X4wYk4VM7JpHIMxCbcbsnukQ-'
));

// update item offer
$cleengApi->removeItemOffer(707221016);

$itemOffer = $cleengApi->getItemOffer(707221016);

echo "Item offer is now marked as 'removed':\n";
print_r($itemOffer->toArray());

