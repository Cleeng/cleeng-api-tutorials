Cleeng Open Tutorial 2 - Load purchased item async
==========================================================

This tutorial shows how to reveal purchased content using AJAX. To understand the full tutorial, basic knowledge of
jQuery and PHP is required. At this point we assume that you are familiar with [Tutorial 1 - Getting started](), and you already created an itemOffer in Tutorial 1. 

1. See it in action
2. Loading async
3. Async delivery of your content: ajax.php
4. Purchase page
5. Summary


1. See it in action
-------------------

Click here to see (or unfold) a working demo: [Example 2 - Load purchased item async]()


2. Loading async
---------------

### 2.1. Why loading async
In [Tutorial 1](), after the visitor made the purchase, we simply refreshed the full page to reveal the item. This works well for a simple, almost empty HTML document. However, usually your page will contain a lot of HTML code, images, flash animations etc. Refreshing the full page will give a delay which we can avoid. By loading asynchronously (with AJAX) the user experience is improved a lot as we only reload to get the purchased content from the server.

### 2.2. Configure the files for this example: config.php
Get the files for example 2 [load purchased item async from Github](). You can re-use the itemOfferId from example 1. In this example, in order to load async there is a second file that takes care of the ajax handling: ajax.php. To simpilfy the configuration we have defined config.php. In here you need to define the itemOfferId and the actual itemToProtect.

NOTE TO FINALIZE DONALD: we define it the content to sell with parameter and x, but normally you will load it from a databse

3. Async delivery of your content: ajax.php
---------------------
When the page is delivered an initial validation with isAccessGranted() is done like in tutorial 1.  To load the content asynchronously after it is purchased we call `ajax.php` to verify access again. When the content is accessible it will return the content, otherwise be empty.

PHP script responsible for loading data should be as light as possible - usually it will only call isAccessGranted() API,
load some content from database and return it. 


	include 'config.php';

	if ($cleengApi->isAccessGranted($itemOfferId)) {
    	// usually this will be loaded from database
    	echo $contentToProtect;
	} 


4. Purchase page
-----------------------

This example is based on jQuery library, which can be loaded from the Google servers. Next to that we load the Cleeng Javascript SDK. In tutorial 1, after the purchase the full page was reloaded with document.reload(). This part is now replaced with the async call to ajax.php.

This example follows jQuery conventions. It uses jQuery's `click()` to trigger the purchase function similar to example 1. The whole JavaScript block is surrounded by `$('document').ready()` to ensure it executes only after DOM tree is loaded.

  	<?php
	include 'config.php';
	?>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cleeng.local/js-api/2.0/api.js"></script>
	<script type="text/javascript">
	$('document').ready(function() {
   		$('#purchase').click(function() {
       	CleengApi.purchase("<?php echo $itemOfferId ?>", function(result) {
           $.post('ajax.php', function(text) {
               if (text) {
                   $('#protected_content').html(text).show();
                   $('#prompt').hide();
               }
           });
       	});
       	return false;
   		});
	});
	</script>
	
	<?php

	if ($cleengApi->isAccessGranted($itemOfferId)) {
   		echo '<div id="protected_content">' . $itemToProtect . '</div>';
	} else {
  		echo '
   		<div id="prompt">Content not accessible. <a href="#" id="purchase">Buy</a></div>
   		<div id="protected_content" style="display:none"></div>
   		';
	}

5. Summary
--------------------

Get the package with all files [Tutorial 2 - Load purchased item async](http://github.com/cleeng/) from Github and do the following:

* Ensure you are registered as publisher and created an offerItem already - see [tutorial 1]()
* Open config.php and fill in your details
* 
* Fill in the sales parameters in [create_offer.php](http://github.com/cleeng) and open the file in your browser - this generates your item offer ID
* Put your item offer ID in [purchase.php](http://github.com/cleeng)
* Within your browser - Log out from Cleeng (as you can't purchase your own offer) and run [purchase.php](http://github.com/cleeng) in your browser. 
* Enjoy the purchase process!