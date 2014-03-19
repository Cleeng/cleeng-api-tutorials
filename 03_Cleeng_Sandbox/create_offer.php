<?php
/**
 * Cleeng API Example 3 - Creating offer in Sandbox
 *
 * Open this file in browser or run it from command line in order to create rental offer
 */

/***
 * PUBLISHER TOKEN
 * get your token from http://sandbox.cleeng.com/dev/api-keys
 */
$publisherToken = 'YOUR_PUBLISHER_TOKEN';


/**
 * DESCRIBE YOUR OFFER
 */
$offerSetup = array(
    'title' => 'Super Cool article for just $0.49. You will love it!',
    'period' => '48',
    'price' => 0.49,
    'url' => 'http://your-site.com/view-offer-here',
    'description' => 'This is my first Rental Offer, after buying this, you will get 48 hours of accesss to my Super Cool article.'
);

/* --------------------------------------------------------------------
 *
 *  you don't need to touch everything below :-)
 * 
 -----------------------------------------------------------------------*/

// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api(array(
    'endpoint' => 'https://sandbox.cleeng.com/api/2.1/json-rpc',//to delete
    'publisherToken' => $publisherToken
));
// create rental offer on Cleeng Platform
$offer = $cleengApi->createRentalOffer($offerSetup);

// print ID of new offer
echo 'Created rental offer with id = ' . $offer->id . "\n";

//you can always get and 
?>
<hr />
<p>&copy; Safe & secure content protection and monetization by <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank"><img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" /></a>.</p>
