Tutorial 2 - Load purchased item async
==================================================

This tutorial shows how to reveal purchased content using AJAX. To understand the full tutorial, basic knowledge of
jQuery and PHP is required. At this point we assume that you are familiar with [Tutorial 1 - Getting started](Tutorials/01_Getting_started_with_Cleeng), and you already created an itemOffer in Tutorial 1. 

**Table of contents**

1. See it in action
2. Loading async
3. Async delivery of your content: ajax.php
4. Purchase page
5. Summary

---

##1. See it in action

Click here to see (or unfold) a working demo: [Example 2 - Load purchased item async](example/02/purchase.php)


##2. Loading async

### 2.1. Why loading async
In [Tutorial 1](Tutorials/01_Getting_started_with_Cleeng), after the visitor made the purchase, we simply refreshed the full page to reveal the item. This works well for a simple, almost empty HTML document. However, usually your page will contain a lot of HTML code, images, flash animations etc. Refreshing the full page will give an unneccesary delay. Obviously this should be avoided. By loading asynchronously (with AJAX) the user experience is improved signifcantly as we only load the purchased content from the server.

### 2.2. Configure the files for this example: config.php
Get the [example files](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github. You can re-use the `itemOfferId` from example 1 or create a new one. In this example, in order to load async there is a second file: [ajax.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Loading_content_async/ajax.php). To simplify the configuration we have defined [config.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Loading_content_async/config.php). In here you need to define the `itemOfferId` and the actual content that you protect and sell. Obviously when you would sell multiple items from your website, you won't define it in this config file, but you would load the revealed content from a database.


##3. Async delivery of your content: ajax.php

When the page is delivered an initial validation with `isAccessGranted` is done like in tutorial 1.  To load the content asynchronously after it is purchased we call `ajax.php` to verify access again. When the content is accessible it will return the content, otherwise be empty.

PHP script responsible for loading data should be as light as possible - usually it will only call isAccessGranted() API,
load some content from database and return it. 


	include 'config.php';

	if ($cleengApi->isAccessGranted($itemOfferId)) {
    	// usually this will be loaded from database
    	echo $contentToProtect;
	} 


##4. Purchase page

This example is based on jQuery library, which can be loaded from the Google servers. Next to that we load the Cleeng Javascript SDK. In tutorial 1, after the purchase the full page was reloaded with document.reload(). This part is now replaced with the async call to [ajax.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Loading_content_async/ajax.php).

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

##5. Summary

This tutorial explains in details the [Loading content async example](example/02/purchase.php).
Get the package with all [example files](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github and do the following:

* Ensure you are registered as publisher and have defined an offer, resulting in a `itemOfferId` - see [tutorial 1](Tutorials/01_Getting_started_with_Cleeng)
* Edit [config.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Loading_content_async/config.php) and fill in the `itemOfferId` and define the content you want to protect
* Within your browser - Log out from Cleeng (as you can't purchase your own offer) and run [purchase.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Loading_content_async/purchase.php) from your own server. 
* Enjoy the great purchase experience!