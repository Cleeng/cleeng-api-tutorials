<?php
/**
 * Cleeng API Example 1 - Getting started with Cleeng
 *
 * Open this file in browser or run it from command line in order
 * to create an offer.
 
 * In order to sell offers you need to set-up and define your it
 * in advance via the Cleeng API. This way Cleeng ensures a secure 
 * transaction and offers unique features like social commissions 
 * and a personal library for your visitors. This file does all that for you.
 
 */
 
// IMPORTANT: Once you have created an offer, don't leave this file on the server!

// get your token from http://cleeng.com/us/dev/api-keys
$publisherToken = 'SET_YOUR_PUBLISHER_TOKEN';

// define offer properties (for more details see reference of createRentalOffer())
// 
$offerSetup = array(
    'title' => 'Bip Bip and Coyote Live at MSG',
    'price' => 19.00,
    'url' => 'http://your-site.com/watch/bipbip_12/',
    'description' => 'See how Bip Bip and Coyote are chasing each other. Watch it live from MSG New York directly from your browser.',
    'startTime' => '1353453600',
    'endTime' => '1420048461',
    'videoOnDemand' => 'restricted',
    'videoOnDemandRentalPeriod' => 48
);


// --------------------------------------------------------------------
// you don't need to touch anything below :-)

// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api();
$cleengApi->enableSandbox();
$cleengApi->setPublisherToken($publisherToken);

// create offer on Cleeng Platform
$offer = $cleengApi->createEventOffer($offerSetup);

// echo ID of new offer
if ($offer->id) {
	echo 'Successfully created a new Event offer with id = <strong>' . $offer->id . '</strong><br/><br/>';
	echo 'Store this id for future reference (use this in your config.php)<br/>';
	echo "Don't reload (it will create a new offer), and don't leave this file on a public available server!";
} else {
	echo 'Something went wrong... check the tutorials on Cleeng Open.';
}
