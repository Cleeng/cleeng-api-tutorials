Cleeng Open Tutorial 1 - Getting Started
=========

This basic tutorial shows you how to protect an item of your website, and how to define an offer to unprotect this item. You will learn the basics of the Cleeng API. All in just 5 minutes. This tutorial is for websites that can execute [PHP](http://php.net).

After this tutorial you can sell anything digital: a few lines of code, an answer to a riddle, access to a form, or ... be creative!

1. See it in action
2. Get prepared
3. Protect your item. Setup your offer. Sell it.
4. Full example
5. Develop & test further
6. Summary

1. See it in action
-------------------
Click to see a working demo: [Example 1 - Getting started](http://example)

2. Get prepared
---------------------------

* [Download all files from Github](http://github.com/cleeng/basic-examples/getting-started), including the PHP SDK and the example of this tutorial.
* To ensure the sales are registered (and credited) to your account; you need to [open a publisher account](http://cleeng.com) with Cleeng. 
* Then, get a [secure Cleeng API token](https://cleeng.com/dev/api-keys). Section 3.2 below shows how to use this token.

3. Protect your item. Setup your offer. Sell it.
-----------------------------------------------
### 3.1. Define & protect the item
Define the part you want to protect. Use $cleengAPI->isAccessGranted() to validate if the visitor is authorized and if the item should be revealed. You can place any piece of HTML between the tags.

	... place the following within your HTML.
	<?php if ($cleengAPI->isAccessGranted($itemOfferId)) {  ?>
        This content is accessible when you purchase it! 
        Place here the stuff you want to sell.
    <?php } else {  ?>
    	Content not accessible. <a href="javascript:cleengPurchase()">Buy</a>
    <?php } ?>
	.....remainder of you webpage.

### 3.2. Set-up your offer on cleeng
In order to sell items you need to set-up and define your offer in advance via the Cleeng API. This way Cleeng ensures a secure transaction and offers unique features like social commissions and a personal library for your visitors. 

Within the file [create_item_offer.php](http://github.com/cleeng) replace 'YOUR_PUBLISHER_TOKEN' with the API token obtained before.

Set-up your offer by defining the 3 mandatory parameters of the itemOffer. See the reference for all limitations, most important are mentioned here:  
- 'price' is limited to 0.15-19.99 by default. The currency is defined in your [publisher settings](http://cleeng.com/my-account/settings).  
- 'url' indicates on which webpage your item is accessible.  
- 'description' is a teaser shown just before your visitors decide to buy. It is limited to 110 characters.  
   
     $cleengAPI = new CleengClient(array(
        'publisherToken' => 'YOUR_PUBLISHER_TOKEN'
     ));

     $itemOfferId = $cleengAPI->createItemOffer(array(
        'price' => 0.49,
        'url' => 'http://your-site.com/view-item-here',
        'description' => 'Buy this item for just $0.49. You will love it!'
     ));

     echo "You have set-up an offer on Cleeng servers with ID=$itemOfferId";

Run create_item_offer.php. Copy the itemOfferId that is returned from the Cleeng servers and use it in next section.

### 3.3. Set-up for sale. Let your visitors purchase your item.

In the file [purchase.php](http://github.com/cleeng)  replace 'YOUR_OFFER_ID' with the ItemOfferId you obtained in previous step. With the JavaScript function cleengPurchase() you can trigger the check-out. After the purchase it reloads the page and, for security reasons, you can validate server-side if the item should be revealed. Tutorial 2 shows you an improved user experience by loading [asyncronous / AJAX](http://cleeng.com/open/ajax).

	<?php
    $itemOfferId = 'YOUR_OFFER_ID';
    ?>
    <script type="text/javascript" src="https://cdn.cleeng.com/js-api/client.js"></script>
    <script type="text/javascript">
    
    function cleengPurchase() {
        CleengClient.purchase("<?php echo $itemOfferId ?>", function(result) {
            if (result.purchased) {
                window.location.reload();
            }
        });
    }
    </script>

    <a href="javascript:cleengPurchase()">Buy</a>

Note DONALD: add countImpression explain

4. Full example
---------------------
Below you find the full example of [purchase.php]() to protect and sell your digital item.

Just fill in your itemOfferId (section 3.2) and run the file!

    <?php
    // Create your offer ID with create_item_offer.php or use ID 930339322 for demo purposes.
    $itemOfferId = 'YOUR_OFFER_ID'; 
    
    //include PHP SDK
    include_once(CleengClient.php); 
    $cleengAPI = new CleengClient();		
    ?>
    <script type="text/javascript" src="https://cdn.cleeng.com/js-api/client.js"></script>
    <script type="text/javascript">
    function cleengPurchase() {
        CleengClient.purchase("<?php echo $itemOfferId ?>", function(result) {
            if (result.purchased) {
            	// improve the user experience - learn how to load with AJAX in tutorial 2
                window.location.reload(); 
            }
        });
    }
    </script>
    
    ... place the following within your HTML.
	<?php if ($cleengAPI->isAccessGranted($itemOfferId)) {  ?>
        This content is accessible when you purchase it! 
        Place here the stuff you want to sell.
    <?php } else {  ?>
    	Content not accessible. <a href="javascript:cleengPurchase()">Buy</a>
    <?php } ?>
	.....remainder of you webpage.

You are now ready to protect and sell digital content from your own website!

5. Develop & test further
-----------------------------------------

This tutorial has shown you the basics of Cleeng. We highly recommend you to continue some more tutorials to improve the user experience and to benefit from the wide range of functionality Cleeng offers. Learn how to load [async](), to [enable social commission](), do [bulk protection]() and [much, much more]().

Cleeng offers a [sandbox](http://cleeng.com/dev/sandbox-explained), so you can freely develop and test without the need to transfer real money. It also keeps your statistics on your real publisher account clean. Please be aware that for sandbox you need use a different [publisher account](http://sandbox.cleeng.com) and [API token](https://sandbox.cleeng.com/dev/api-keys). 

Use the following credit card details to make a fake payment on sandbox: 
> card number: 5555 4444 3333 1111  
> name: any  
> expiry date: 12/2012   
> cvc: 737   


6. Summary
--------------------

Get the package with all files [Tutorial 1 - Getting started](http://github.com/cleeng/) from Github and do the following:

* Register as publisher on [production](http://cleeng.com) (or [sandbox](http://sandbox.cleeng.com))
* Grab your [API token](http://cleeng.com/dev/api-keys) (or from [sandbox](http://sandbox.cleeng.com/dev/api-keys)), and put them in config.php file
* Define the item you want to protect and control access via $cleengAPI->isAccessGranted();
* Fill in the sales parameters in [create_offer.php](http://github.com/cleeng) and open the file in your browser - this generates your item offer ID
* Put your item offer ID in [purchase.php](http://github.com/cleeng)
* Within your browser - Log out from Cleeng (as you can't purchase your own offer) and run [purchase.php](http://github.com/cleeng) in your browser. 
* Enjoy the purchase process!