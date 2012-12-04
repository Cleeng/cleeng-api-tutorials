Tutorial 1 - Protect your content with PHP SDK
==============================================

This basic tutorial shows you how to protect an offer on your website. You will learn the basics of the Cleeng API. All in just 5 minutes. This tutorial is for websites that can execute [PHP](http://php.net).

After this tutorial you can sell anything digital: a few lines of code, a video embed (with domain restrictions), access to a form, or ... be creative!


1. What is Cleeng PHP SDK for ?
2. Get prepared & protect your content.
3. Testing payment


---

##1. What is Cleeng PHP SDK ?

Cleeng SDK for PHP developers provides a rich set of server-side functionality for accessing Cleeng server-side API calls. Using it you can easily integrate your website with out platform.

##2. Protect your content.

Download the [example files](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github, this includes the Cleeng PHP SDK. Place them on your server.

**Very important!**

In this tutorial, we gonna use default offer. How to create offers on your own you can read in [Tutorial 2](Tutorials/02_Creating_Offers)

### 2.1 How it all works

* Integrate your website with Cleeng PHP SDK
* Choose the part of content you want to protect
* Create offer, describe your content ([next tutorial](Tutorials/02_Creating_Offers))
* Check if customer has access to particular offer
* If yes, show it to him
* If not, show Cleeng payment frame and earn money


### 2.2. Finally, let's start with some coding

Click to see a working demo: [Example 1 - Protect your content](example/01/purchase.php).

and

Open file purchase.php from [github](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/01_Protect_your_content/purchase.php)

`purchase.php` :

    ```php
    <?php

    $offerId = 'R123123123_FR'; // Default offer Id - for tests

    // include PHP SDK
    include_once('../cleeng-php-sdk/cleeng_api.php');
    $cleengApi = new Cleeng_Api();
    ?>
    <script type="text/javascript" src="http://cdn.cleeng.com/js-api/3.0/api.js"></script>
    <script type="text/javascript">
    CleengApi.countItemOfferImpression("<?php echo $offerId ?>");

    function cleengPurchase() {
        CleengApi.purchase("<?php echo $offerId ?>", function(result) {
            if (result.purchased) {
            	// improve the user experience - learn how to load with AJAX in tutorial 6
                window.location.reload();
            }
        });
    }
    </script>

    ... place the following within your HTML.
    if ($cleengApi->isAccessGranted($offerId)) {
        echo 'This content is accessible when you purchase it! Place here the stuff you want to sell.';
    } else {
        echo 'Content not accessible. <a href="javascript:cleengPurchase()">Buy</a>';
    }
	.....remainder of your webpage.
	```



#### 2.2.1. Basics

* Include API

    `include_once('../cleeng-php-sdk/cleeng_api.php')` - make sure that path is correct

* Create API object

    `$cleengApi = new Cleeng_Api()` - from now on you can use every method in API using `$cleengApi` variable

* Offer Id

    `$offerId = 'R123123123_FR'` - this is Cleeng default offer Id, which you can use to test the code. In [Tutorial 2 - Creating Offers](Tutorials/02_Creating_Offers), you can read
how to create an offer and get Id from it.


#### 2.2.2. Authorization

Defining the part of your content that you want to protect is the core of using Cleeng PHP SDK. Use `$cleengApi->isAccessGranted()` to validate if the visitor is authorized and if the offer should be revealed. You can place any piece of HTML between the tags.

    ```php
    if ($cleengApi->isAccessGranted($offerId)) {
        echo 'This content is accessible when you purchase it! Place here the stuff you want to sell.';
    } else {
        echo 'Content not accessible. <a href="javascript:cleengPurchase()">Buy</a>';
    }
    ```

If the user is not logged in or hasn't purchased our content, `<a href="javascript:cleengPurchase()">Buy</a>` you gonna display *Buy* button, which starts `cleengPurchase()` method.


#### 2.2.3. Java Script

In the `<head>...</head>` of your HTML page put this code:

    ```php
    <script type="text/javascript" src="http://cleeng.com/js-api/3.0/api.js"></script>
    <script type="text/javascript">
        CleengApi.trackOfferImpression("<?php echo $offerId ?>");
        function cleengPurchase() {
            CleengApi.purchase("<?php echo $offerId ?>", function (result) {
                // reload page after purchase to reveal protected ite
                // improve the user experience - learn how to load with AJAX in tutorial 2
                window.location.reload();
            });
        }
    </script>
    ```

As you can see, we've just included `api.js` file. From now on we can use:

*   `CleengApi.countItemOfferImpression()` which is necessary to make statistics, count impression.

*   `CleengApi.purchase()` using that method, we create `cleengPurchase()` method

    which will be started after clicking on *Buy* `<a href="javascript:cleengPurchase()">Buy</a>`

####Hurray!

You are now almost ready to protect and sell digital content from your own website!

The last important thing you should know is how to create offers,

<a class="btn btn-primary" href="./Tutorials/02_Creating_Offers">Go to Creating Offers tutorial &raquo;</a>

##3. Testing payment


During testing, as you probably can see, you can't complete you purchase unless you pay with real money. In Tutorial [How to use Cleeng sandbox](Tutorials/05_Sandbox_testing), you can read how to use Sandbox to test payment and be able to finish the purchase process.

<!--
##6. Summary

This tutorial explains in detail the [Protect your content example](/example/01/purchase.php). Grab the [examples files, including the PHP SDK](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github and do the following:

* Register as a publisher on [Cleeng](http://cleeng.com/publisher-registration)
* Grab your [API token](http://cleeng.com/dev/api-keys).
* Put default offer ID in [purchase.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/01_Protect_your_content/purchase.php)
* Within your browser - Log out from Cleeng (as you can't purchase your own offer) and run [purchase.php](https://github.com/Cleeng/cleeng-open/blob/master/public/example/01/purchase.php) in your browser.
* Enjoy the simple purchase process!

**Anything unclear or wrong?**

Let us know on [Github](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/01_Protect_your_content.md) and indicate any suggestions or changes! Highly appreciated.

-->

---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Protect your content';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>


