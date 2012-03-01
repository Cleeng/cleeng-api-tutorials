<?php
/**
 *
 * Configuration file
 *
 * This file sets some common configuration variables used by your purchase file
 * and ajax.php files. It also creates Cleeng API client object.
 */

// Create your offer ID with create_item_offer.php (See Tutorial 1 on Cleeng.com) or use ID 177890266 for demo purposes.
// Note: the demo item (177890266) is for free, so you are only need to confirm. In order to see the checkout screens you need to set-up an item with a real price.
$itemOfferId = '177890266';
 
// $itemToProtect contains the html-content that you are selling. Default it is protected and only appears after the user has purchased.
 $itemToProtect = '<img src="img/wait-screen.jpg" alt="Pre-booking successfull" width="750" />';

// In case you are using livestream, grap you embed code from there and plug it in here!
// Please be aware: restrict your stream only to your domain!
//$livestreamChannel = "deanguitars
$itemToProtect = '<iframe width="748" height="450" src="http://cdn.livestream.com/embed/'.$livestreamChannel.'?layout=4&color=0xe7e7e7&autoPlay=true&mute=false&iconColorOver=0x888888&iconColor=0x777777&allowchat=false&height=450&width=748" style="border:0;outline:0" frameborder="0" scrolling="no"></iframe>';

//-----------------------------------
// You don't need to change anything below...

// Load and Create Cleeng API client

include_once('../cleeng-php-sdk/cleeng_api.php');

$cleengApi = new Cleeng_Api(array('platformUrl' => 'cleeng.com'));