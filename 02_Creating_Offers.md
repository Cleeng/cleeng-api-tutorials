Tutorial 2 - Creating Offers
============================

In previous tutorial [Protect your content](/Tutorials/01_Protect_your_content), you learned how to implement PHP SDK and how protect your content. In this tutorial, you will take the last basic step to sell your content.

If you want to sell anything with Cleeng, you have to describe it, give it a name, price etc. You have to create an offer.

---



1. What is Cleeng offer ?
2. Get Offer Id
3. Combine everything
5. Testing payment


---

##1. What is Cleeng offer?

Every user before purchasing your content, has to know precisely what this is about. So if you want to sell with Cleeng, you have to describe it, give a name, set a price, choose type of an offer etc. More info about parameters connected with the offer that we allow to change you can find in [Offer API](/v3/Reference/Rental_Offer_API).

Below, you can read about all types of Cleeng offers:

<table class="table table-bordered table-striped">
    <colgroup>
        <col class="span1">
        <col class="span1">
        <col class="span2">
        <col class="span5">
    </colgroup>
    <thead>
        <tr>
            <th>Offer type</th>
            <th>Payment recurring?</th>
            <th>Access period</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Rental</td>
            <td>1 time payment</td>
            <td>1h, 3h, 12h, publisher defines in hours</td>
            <td>Rental offers have specific period when user has access to content.<br/>Example: "Rent this video now for 48h"</td>
        </tr>
        <tr>
            <td>Live Event</td>
            <td>1 time payment</td>
            <td>Publisher set when it starts and ends</td>
            <td>In Live Event offers, you can set when exactly offer is able to access. Also there is possibility to send reminder to user who purchased the offer earlier. Choose what you want to do with the stream after the event.</td>
        </tr>
        <tr>
            <td>Single</td>
            <td>1 time payment</td>
            <td>Anytime</td>
            <td>After purchasing, user has access to content anytime and anywhere.</td>
        </tr>
        <tr>
            <td>Subscription</td>
            <td>multiple payments</td>
            <td>day, week, month, quarter, year, it is a publisher choice</td>
            <td>After purchasing user has access to every offer with tag included in <code>accessToTags</code> array parameter.<br/>Example: "Get unlimited access to all tutorials. Subscribe for only $49/month."
</td>
        </tr>
    </tbody>
</table>


####This tutorial will be based on Rental Offers.

----

##2. Get Offer Id

###2.1 Implementation

This is the second tutorial, so probably you have [example files](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master). If not, please download it and place them on your server.

Remember, you have to open publisher account first. All the information about that, you can find in [Introduction](Tutorials/Introduction)

Then, get a [publisher token](https://cleeng.com/dev/api-keys). Section 2.2.1 below shows how to use this token.

###2.2 Creating offer

In the first tutorial, we described how you can protect your content. As you probably remember, we've been working on default offer. Right now, we are going to create our own offer. 

Please open `create_offer.php`. This file will use Cleeng API to create new rental offer, then it will print `offerId` on your screen. This `offerId` you can use later in `purchase.php` as we did with default offer id in [Tutorial 1](/Tutorials/01_Starting_with_Cleeng_PHP_SDK).

<div class="accordion" id="accordion2">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
         <button class="btn" type="button">Show create_offer.php code <i class="icon-arrow-down"></i></button>
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
        <pre><code class="php">
        &lt;?php
        
        $publisherToken = 'YOUR_PUBLISHER_TOKEN';
        
        $offerSetup = array(
            'title' =&gt; 'Super Cool article for just $0.49. You will love it!',
            'period' =&gt; '48',
            'price' =&gt; 0.49,
            'url' =&gt; 'http://your-site.com/view-offer-here',
            'description' =&gt; 'This is my first Rental Offer, after buying this, you will get 48 hours of accesss to my Super Cool article.'
        );
        
        // include PHP SDK
        include_once('../cleeng-php-sdk/cleeng_api.php');
        
        // create Cleeng API object and set publisher token
        $cleengApi = new Cleeng_Api();
        $cleengApi->setPublisherToken($publisherToken);
        // create rental offer on Cleeng Platform
        $offer = $cleengApi-&gt;createRentalOffer($offerSetup);
        
        // print ID of new offer
        echo 'Created rental offer with id = ' . $offer-&gt;id . "\n";

        ?&gt;
        </code></pre>

      </div>
    </div>
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
         <button class="btn" type="button">Show purchase.php code <i class="icon-arrow-down"></i></button>
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
        <pre><code class="php">
        &lt;?php

        $offerId = 'PUT_YOUR_OFFER_ID_HERE';

        // include PHP SDK
        include_once('../cleeng-php-sdk/cleeng_api.php');

        $cleengApi = new Cleeng_Api();

        ?&gt;

        &lt;script type="text/javascript" src="&lt;?php echo $cleengApi->getJsApiUrl() ?&gt;"&gt;
        CleengApi.trackOfferImpression("&lt;?php echo $offerId ?&gt;");

        function cleengPurchase() {
            CleengApi.purchase("&lt;?php echo $offerId ?&gt;", function(result) {
                if (result.purchased) {
                    // improve the user experience - learn how to load with AJAX in tutorial 5
                    window.location.reload();
                }
            });
        }
        &lt;/script&gt;

        ... place the following within your HTML.
        if ($cleengApi-&gt;isAccessGranted($offerId)) {
            echo 'This content is accessible when you purchase it! Place here the stuff you want to sell.';
        } else {
            echo 'Content not accessible. &lt;a href="/javascript:cleengPurchase()"&gt;Buy&lt;/a&gt;';
        }
        .....remainder of your webpage.</code></pre>
      </div>
    </div>
</div>

####2.2.1 Prove that you're publisher

First step is to set your publisher Token, which you can find in <a href="http://cleeng.com/dev/api-keys">api-keys</a>.

e.g. `$publisherToken = 'Xlrx-SjTLVMCsaRsOf2q2hvWKOlrF57yHknDRRRMX-13Fz-x';`

####2.2.2 Describe your offer

All information about parameters you can find in <a href="v3/Reference">API Reference</a>
<pre>
<code>
$offerSetup = array(
    'title' => 'Bip Bip and Coyotte - Episode 12 -  Dailymotion',
    'period' => '48',
    'price' => 0.49,
    'url' => 'http://your-site.com/view-offer-here',
    'description' => 'See how Bip Bip and Coyotte are chasing each other for the 12th time. Watch it directly from your browser for a few pennies.'
);
</code>
</pre>

####2.2.3 The rest of the Cleeng magic

<pre><code>
// include PHP SDK
include_once('./../cleeng-php-sdk/cleeng_api.php');

// create Cleeng API object using your publisher token
$cleengApi = new Cleeng_Api();
$cleengApi->setPublisherToken($publisherToken);

// create rental offer on Cleeng Platform, using your offer description
$offer = $cleengApi->createRentalOffer($offerSetup);

// print ID of new offer
echo 'Created rental offer with id = ' . $offer->id . "\n";
</code></pre>


---

##3. Combine everything.

At this time in `purchase.php` you have to set offer ID, which you get from point 2.

e.g. `$offerId = 'R435427708_US';`

<!--Click to see a working demo: [Example 2 - Creating Offers](/example/02/purchase.php).-->

You are now ready to protect and sell digital content from your own website!

---


##4. Testing payment


During testing, as you probably can see, you can't complete you purchase unless you pay with real money. In Tutorial [How to use Cleeng sandbox](Tutorials/03_Cleeng_Sandbox), you can read how to use Sandbox to test payment and be able to finish the purchase process.

<a class="btn btn-primary" href="./Tutorials/03_Cleeng_Sandbox">Go to Sandbox testing tutorial &raquo;</a>
<!--
##6. Summary

This tutorial explains in detail the [Getting started example](example/01/purchase.php). Grab the [examples files, including the PHP SDK](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github and do the following:

* Register as a publisher on [Cleeng](http://cleeng.com/publisher-registration)
* Grab your [API token](http://cleeng.com/dev/api-keys).
* Define the offer you want to protect and control access via `$cleengApi->isAccessGranted();`
* Create you first offer in [create_offer.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/02_Creating_Offers/create_offer.php)
* Put your offer ID in [purchase.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/01_Getting_started_with_Cleeng/purchase.php)
* Within your browser - Log out from Cleeng (as you can't purchase your own offer) and run [purchase.php](https://github.com/Cleeng/cleeng-open/blob/master/public/example/01/purchase.php) in your browser.
* Enjoy the simple purchase process!

**Anything unclear or wrong?**

Let us know on [Github](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/01_Starting_with_Cleeng_PHP_SDK.md) and indicate any suggestions or changes! Highly appreciated.



-->

---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Creating Offers';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
