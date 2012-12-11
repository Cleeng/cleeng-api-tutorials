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

// Sandbox default offer ID, you can create you own, read more in Tutorial 3..
$offerId = 'R733029903_US';

// This will appear after user
$contentToProtect = 'This content is accessible when you purchase it! Place here the stuff you want to sell.';

// Create Cleeng API client
$cleengApi = new Cleeng_Api();
$cleengApi->enableSandbox();
