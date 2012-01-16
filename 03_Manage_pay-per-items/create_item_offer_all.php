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

// create item offer
$itemOffer = $cleengApi->createItemOffer(array(
    'price' => 0.49,
    'url' => 'http://your-site.com/view-item-here',
    'description' => 'Buy this item for just $0.49. You will love it!',
    'pageTitle' => 'My Awsome Blog',
    'socialCommisionEnabled',
    'socialCommisionRate',

    'myId' => '',
    'myData' => '',
 ));

echo 'Created item offer with id = ' . $itemOffer->id . "\n";