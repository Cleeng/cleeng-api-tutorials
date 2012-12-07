<?php
/**
 * Cleeng API Example 5 - Loading content asynchronously
 *
 * Configuration file
 *
 * This file sets some common configuration variables used by purchase.php
 * and ajax.php files. It also creates Cleeng API client object.
 */

include_once('../cleeng-php-sdk/cleeng_api.php');

// Create your offer ID with create_item_offer.php (from Example 1) or use ID 791033324 for demo purposes.
$offerId = 'R435427708_US';

// This will appear after user
$contentToProtect = 'This content is accessible when you purchase it! Place here the stuff you want to sell.';

// Create Cleeng API client
$cleengApi = new Cleeng_Api();
//$cleengApi->enableSandbox();
print_r($_COOKIE['CleengClientAccessToken']);
//echo $cleengApi->getCustomerToken();die;