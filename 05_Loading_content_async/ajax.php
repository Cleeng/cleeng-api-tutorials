<?php
/**
 * Cleeng API Example 5 - Loading content asynchronously
 *
 * This file is supposed to by loaded by jQuery's AJAX routines,
 * and shouldn't be opened directly in browser.
 */

// include configuration file
include 'config.php';

// Check if visitor has access to protected content
if ($cleengApi->isAccessGranted($offerId)) {
    // usually this will be loaded from database - in order to make this example
    // simpler, we'll just echo variable from configuration file
    echo 'Your content without page reloading: '.$contentToProtect;
}