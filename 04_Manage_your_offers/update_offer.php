<?php
/**
 * Cleeng API Example 4 - Creating offer in Sandbox
 */

/***
 * PUBLISHER TOKEN
 * get your token from http://sandbox.cleeng.com/dev/api-keys
 */
$publisherToken = 'YOUR_PUBLISHER_TOKEN';


$offerId = R495315693_PL;

$offerSetup = array(
    'title' => 'Super Cool article for just $0.49 with longer access!',
    'period' => '72',
    'description' => 'This is my first Rental Offer, after buying this, you will get 72 hours of accesss to my Super Cool article.'
);

include_once('../cleeng-php-sdk/cleeng_api.php');

$cleengApi = new Cleeng_Api();
$cleengApi->enableSandbox();
$cleengApi->setPublisherToken($publisherToken);

try {

$offer = $cleengApi->updateRentalOffer($offerId, $offerSetup);

echo 'You\'ve just updated offer with id = ' . $offer->id . "<br/><br/>";

?>

Some params:<br/>

ID - <?php echo $offer->id ?><br/>
Title - <?php echo $offer->title ?><br/>
Period - <?php echo $offer->period ?><br/>

<?php
}
catch(Exception $e) {
    echo $e->getMessage();
}
?>

<hr/>
Read more in updateRentalOffer Reference!

<hr />
<p>&copy; Safe & secure content protection and monetization by <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank"><img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" /></a>.</p>
