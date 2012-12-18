Tutorial 5 - Load purchased offer async
=======================================

At Cleeng, we care about your Customers! That's why we present you solution how to improve UX, by loading purchased offer asynchronously using AJAX.
Thank to this solution, after purchase, user won't see page reloading.

To understand the full tutorial, basic knowledge of jQuery and PHP is required. At this point we assume that you are familiar with [Tutorial 1 - Protect you content](Tutorials/01_Protect_your_content),
and you already created an offer using sandbox in [Tutorial 3](Tutorials/03_Cleeng_Sandbox).

**Table of contents**

1. See it in action
2. Loading async
3. Async delivery of your content: ajax.php
4. Purchase page
5. Summary

---

##1. See it in action

Click here to see a working demo: [Example 5 - Load purchased offer async](example/05/purchase.php)


##2. Loading async

### 2.1. Why loading async
In [Tutorial 1](Tutorials/01_Protect_your_content), after the visitor made the purchase, we simply refreshed the full page to reveal the offer. This
works well for a simple,
almost empty HTML document. However, usually your page will contain a lot of HTML code, images, flash animations etc. Refreshing the full page will give an unneccesary delay. Obviously this should be avoided. By
loading asynchronously (with AJAX) the user experience is improved signifcantly as we only load the purchased content from the server.

### 2.2. Configure the files for this example: config.php
Get the [example files](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github. You can re-use the default `offerId` from [example 3](Tutorials/03_Cleeng_Sandbox) or create a new one.
 In this example, in order to load async there is a second file: [ajax.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/05_Loading_content_async/ajax.php). To
simplify the configuration we have defined [config.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/05_Loading_content_async/config.php). In here you need to
define the `offerId` and the actual content that you protect and sell. Obviously when you would sell multiple offers from your website, you won't define it in this config file,
but you would load the revealed content from a database.


##3. Async delivery of your content: ajax.php

When the page is delivered an initial validation with `isAccessGranted` is done like in [tutorial 1](Tutorials/01_Protect_your_content).  To load the content asynchronously after
it is purchased we call `ajax.php` to verify access again. When the content is accessible it will return the content, otherwise be empty.

PHP script responsible for loading data should be as light as possible - usually it will only call isAccessGranted() API,
load some content from database and return it.


	include 'config.php';

	if ($cleengApi->isAccessGranted($offerId)) {
    	// usually this will be loaded from database
    	echo $contentToProtect;
	}


##4. Purchase page

This example is based on jQuery library, which can be loaded from the Google servers. Next to that we load the Cleeng Javascript SDK. In tutorial 1, after the purchase the full page was reloaded with document.reload(). This part is now replaced with the async call to [ajax.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Loading_content_async/ajax.php).

This example follows jQuery conventions. It uses jQuery's `click()` to trigger the purchase function similar to example 1. The whole JavaScript block is surrounded by `$('document').ready()` to ensure it executes only after DOM tree is loaded.


    ```php
  	<?php
	include 'config.php';
	?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $cleengApi->getJsApiUrl() ?>"></script>
	<script type="text/javascript">
	$('document').ready(function() {
   		$('#purchase').click(function() {
       	CleengApi.purchase("<?php echo $offerId ?>", function(result) {
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

	if ($cleengApi->isAccessGranted($offerId)) {
   		echo '<div id="protected_content">' . $contentToProtect . '</div>';
	} else {
  		echo '
   		<div id="prompt">Content not accessible. <a href="#" id="purchase">Buy</a></div>
   		<div id="protected_content" style="display:none"></div>
   		';
	}
	```

**Anything unclear or wrong?**

Let us know on [Github](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/05_Loading_content_async.md) and indicate any suggestions or changes! Highly appreciated.


---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Loading Content Async';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
