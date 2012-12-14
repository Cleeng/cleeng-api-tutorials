<?php
/**
 * Cleeng API Example 2 - Creating offer
 * learn more about all kinds of Cleeng offers in http://cleeng.com/open/Tutorials/02_Creating_Offers
 */

/***
 * PUBLISHER TOKEN
 * get your token from http://cleeng.com/dev/api-keys
 */
$publisherToken = 'YOUR_PUBLISHER_TOKEN';


/**
 * Describe your offer, available parameters you can find in API Reference: http://cleeng.com/open/Reference/Rental_Offer_API/Functions/createRentalOffer
 */
$offerSetup = array(
    'title' => 'Super Cool article for just $0.49. You will love it!',
    'period' => '48',
    'price' => 0.49,
    'url' => 'http://your-site.com/view-offer-here',
    'description' => 'This is my first Rental Offer, after buying this, you will get 48 hours of accesss to my Super Cool article.',
    'tags' => array('sport', 'hockey')
);

/* --------------------------------------------------------------------
 *
 *  you don't need to touch everything below :-)
 * 
 -----------------------------------------------------------------------*/

// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object
$cleengApi = new Cleeng_Api();
$cleengApi->setPublisherToken($publisherToken);
// createRentalOffer Reference you can easily find here
// http://cleeng.com/open/Reference/Rental_Offer_API/Functions/createRentalOffer
$offer = $cleengApi->createRentalOffer($offerSetup);
// print ID of new offer
echo 'Created rental offer with id = ' . $offer->id . "\n";

//you can always get and 
?>
<hr />
<p>&copy; Safe & secure content protection and monetization by <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank"><img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" /></a>.</p>
