<?php
/**
 * Cleeng API Example 1 - Getting started with Cleeng
 *
 * Open this file in browser or run it from command line in order
 * to create item offer.
 
 * In order to sell items you need to set-up and define your offer 
 * in advance via the Cleeng API. This way Cleeng ensures a secure 
 * transaction and offers unique features like social commissions 
 * and a personal library for your visitors. This file does all that for you.
 
 */
 
// IMPORTANT: Once you have created an itemOffer, don't leave this file on the server!


// define PHP SDK configuration - you can test on sandbox.cleeg.com
$platformUrl = 'cleeng.com';

// get your token from http://cleeng.com/us/dev/api-keys
$publisherToken = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

// define item offer properties (for more details see reference of createItemOffer())
// 
$itemOfferSetup = array(
    'url' => 'http://your-url.com/page-where-item-is-offered',
    'pageTitle' => 'Streaming HD Event of [name] - [date]',
    'description' => 'Virtual ticket for [event]',
    'price' => 7.95
);

// --------------------------------------------------------------------
// you don't need to touch anything below :-)

// include PHP SDK
include_once('cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api(array(
    'platformUrl' => $platformUrl,
    'publisherToken' => $publisherToken
));

// create item offer on Cleeng Platform
$itemOffer = $cleengApi->createItemOffer($itemOfferSetup);

// echo ID of new item
if ($itemOffer->id!=0) {
	echo 'Successfully created a new item offer with id = <strong>' . $itemOffer->id . '</strong><br /><br />';
	echo 'Store this id for future reference (use this in your config.php)<br />';
	echo "Don't reload (it will create a new offer item), and don't leave this file on a public available server!";
} else {
	echo 'Something went wrong... check the tutorials on Cleeng Open.';
}
