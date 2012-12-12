<?php
/**
 *
 * Configuration file
 *
 * This file sets some common configuration variables used by your purchase file
 * and ajax.php files. It also creates Cleeng API client object.
 */

// Create your offer ID with create_offer.php (See Tutorial 2 on Cleeng.com/open) or use ID R435427708_US for demo purposes.
// Note: the demo offer (R733029903_US) if created using Cleeng Sandbox (Tutorial 3). Thanks to that you are able to test payment process with fake credit cart data
$offerId = 'R733029903_US';
 
// $contentToProtect contains the html-content that you are selling. Default it is protected and only appears after the user has purchased.
 $contentToProtect = '<img src="img/wait-screen.jpg" alt="Pre-booking successfull" width="750" />';

// In case you are using livestream, grap you embed code from there and plug it in here!
// Please be aware: restrict your stream only to your domain!

//-----------------------------------
// Load and Create Cleeng API client

include_once('../cleeng-php-sdk/cleeng_api.php');

$cleengApi = new Cleeng_Api();
$cleengApi->enableSandbox();// We are using Sandbox, thanks to that you're able to get through payment process
