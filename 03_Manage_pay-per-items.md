Tutorial 3 - Set-up and manage pay-per-items
==========================================================


<div class="alert-message warning">
<p><strong>Warning!</strong> This tutorial is still in draft.</p>
</div>


This tutorial shows how to setup, update, remove and find pay-per-items via the Cleeng Open API. You need to be familiar with [Tutorial 1 - Getting started](/Tutorials/01_Getting_started_with_Cleeng). In tutorial 1 you learn how to protect an item and how to define an offer to unprotect this item. Basically it shows how to set up a "pay-per-item" offer, while this tutorial builds on that knowledge and shows more functionalities to manage multiple item offers.

This tutorial is for websites and applications that execute [PHP](http://php.net).

After this tutorial you are able to manage your individual digital offers.

1. See it in action
2. All options to set-up your single item offer
3. Get offer details you defined before
4. Update or remove offers
5. Retrieve your default single item parameters
6. Summary


##1. See it in action

Click here to see (or unfold) a working demo: [Example 3 - Manage pay-per-item settings]()

##2. All options to set-up your single item offer

In [Tutorial 1](/Tutorials/01_Getting_started_with_Cleeng) we already showed you how to set-up one offer. Though only the absolute basics were shown. When you create an itemOffer, there are actually many more features you can use.

### 2.1. Social commission
Cleeng offers a truly unique feature: a [social commission](http://cleeng.com/us/features/social-commission/) system allowing users to be rewarded when sharing your content with their friends or followers. There are two parameters you need to set if you want to enable this: `socialCommisionEnabled` (boolean) and `socialCommissionRate` (0-0.50). The rate is a figure in between 0 and 0.50, and is related to the item price. 

Example: if you sell an item for 2 USD, and you set socialCommissionRate to 0.40 ( = 40%), people who share that item will earn 80 cents when their friends or followers buy it too.

[Tutorial 4](/Tutorials/04_Social_Commisions) is all about this unique functionality and will explain in depth how to fully leverage social commissions.

### 2.2. Making your protection dependent on time or dates
Some types of digital content have a perceived value that changes over time. Some items only have value directly after it is published (e.g. breaking news), while other materials gain its value as research material over time (e.g. archives). With Cleeng you can define a specific period for which your offer is applicable. Outside these dates, access is granted automatically to your visitors. 

In order to enable the protection for a certain period you need to switch on `hasProtectionDate` and define at minimum one of the dates. In below example the item is protected until the end of 2012.

	"hasProtectionDate":true,
     "protectionStartDate:":false,
     "protectionEndDate":2012-12-31 23:59

### 2.3. Set-up for rent

Please contact Cleeng if you are interested in setting up rentals.

### 2.4. Reference your own data

In order to give you some flexibility there are two attributes `myId` and `myData` that are set-up for you in order to store additional data along with the rest of the offer. This is mostly used to match up the sales you do with your own reference, or to just be able to find items based on the reference you use in your system in case you don't store the itemOfferId from Cleeng.

### 2.5. To save all these options

Now open [create_item_offer_all.php]() and edit the parameters as you wish. Run the file to create and define your offer on the Cleeng servers. Copy the item offer ID that is returned from the Cleeng servers and use it in order to sell your item as shown in tutorial 1 and 2.

      $itemOffer = $cleengApi->createItemOffer(array(
          'price' => 0.49,
          'url' => 'http://your-site.com/view-item-here',
          'description' => 'Buy this item for just $0.49. You will love it!',
          'pageTitle' => 'Name of video - videosite',
          'socialCommisionEnabled' => true,
          'socialCommisionRate' => 0.30,
          'type' => 'video',
          "hasProtectionDate":true,
	      "protectionStartDate:":false,
     	  "protectionEndDate":2012-12-31 23:59,
          'myId' => '',
          'myData' => '',
       ));
       echo 'Created item offer with id = ' . $itemOffer->id . "\n";
 

##3. Get details of the offers you defined before

To find the details of an offer you have created before you can use the PHP function `getItemOffer()`.

// replace with the itemOfferId you created before:
	$itemOffer1 = $cleengApi->getItemOffer(930339322); 
    $itemOffer2 = $cleengApi->getItemOffer(108640889);
    $itemOffer3 = $cleengApi->getItemOffer(427318025);

    echo "Item Offer 1:<br />\n";
    print_r($itemOffer1->toArray());

    echo "\nItem Offer 2:<br />\n";
    print_r($itemOffer2->toArray());

    echo "\nItem Offer 3:<br />\n";
    print_r($itemOffer3->toArray());
 
See the file [get_offer_details.php]().

Retreiving the details of an offer can also be done via the Javascript function covered in the [UX API]() by simply running the following as shown in file [get_offer_details_JS.html]().

	<script type="text/javascript" src="https://cdn.cleeng.com/js-api/2.0/api.js"></script>
	<script type="text/javascript">
   	CleengApi.getItemOffer(930339322, function(itemOffer) {
        alert('Item description: ' + itemOffer.description);
    });
    </script>

In case you don't know the offerId anymore, you can retreive them by using function x.

##4. Update or remove offers

Once you have created your offer you might want to update some parameters, or even completely remove the offer. 

Please be aware that if you have already sold items to customers, you might upset them once you change something or remove the items entirely. So use these functions smartly. Obviously you can only update or remove items from yourself.

Use [update_offer.php]() to update an offer. 

    // change price and description
	$cleengApi->updateItemOffer(707221016, array(
        'price' => 1.99,
        'description' => 'new, updated description'
     ));

Use [remove_offer.php]() to delete an offer.

	$cleengApi->removeItemOffer(707221016);

Please note that removeItemOffer won't actually delete anything from Cleeng database - it will only mark given
item as "removed".

##5. Retrieve your default single item parameters

Please contact Cleeng if you are interested in setting up using default parameters.

##6. Summary

Get the package with all files [Tutorial 3 - ](http://github.com/cleeng/) from Github and do the following:

* Ensure you are registered as publisher and have your API token entered in the config.php file - see [tutorial 1]()
* To enjoy the extra features like social commission or rent, complete the sales parameters in [create_offer_all.php](http://github.com/cleeng). Run the file in your browser - this generates your item offer ID
* Put your item offer ID in the other files. To see the details of the offer: [get_offer_details.php](http://github.com/cleeng), update the offer: [update_offer.php]() or delete the offer: [remove_offer.php].
* Now you are able to manage your digital offers. You can setup, update, remove and find pay-per-items via the Cleeng Open API.
