<?php
/**
 * Cleeng API Example 1 - Getting started with Cleeng
 *
 * Open this file in browser or run it from command line in order
 * to create item offer
 */

// define PHP SDK configuration
$platformUrl = 'cleeng.local';
$publisherToken = 'aHaFMTynO59PK0xEL9v9Rz6X4wYk4VM7JpHIMxCbcbsnukQ-';

// define item offer properties (for more details see reference of createItemOffer())
$itemOfferSetup = array(
    'url' => 'http://your-site.com/view-item-here',
    'description' => 'Buy this item for just $0.49. You will love it!',
    'price' => 0.49
);

// --------------------------------------------------------------------
// you don't need to touch everying below :-)

// include PHP SDK
include_once('../../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api(array(
    'platformUrl' => $platformUrl,
    'publisherToken' => $publisherToken
));

// create item offer on Cleeng Platform
$itemOffer = $cleengApi->createItemOffer($itemOfferSetup);

// echo ID of new item
echo 'Created item offer with id = ' . $itemOffer->id . "\n";
