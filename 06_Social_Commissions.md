Tutorial 6 - Social commissions <i class="icon-thumbs-up"></i>
===============================


This tutorial shows how to setup [social commissions](http://cleeng.com/us/features/social-commission/). It allows users to be rewarded when sharing content with their friends
or followers. With the credits earned they can purchase new content (or eventually be paid out). You need to be familiar with [Tutorial 1 - Getting started](http://cleeng
.com/open/Tutorials/01_Getting_started_with_Cleeng) and [Tutorial 2 - Loading content async](http://cleeng.com/open/Tutorials/02_Loading_content_async). This tutorial id build
on that knowledge and shows how to activate social commissions on your content offers.

This tutorial is for websites and applications that execute [PHP](http://php.net).

After this tutorial you are able to offer social commissions on your digital offers. Download from Github the [tutorial package](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) with example code.

**Table of contents**

1. See it in action
2. Set-up social commissions along with your offer
3. Engage your audience and let them share
4. Full example: sell items with social commission
5. Summary

---

##1. See it in action

Click here to see a working demo: [Example 4 - Social commissions]()

##2. Set-up social commissions along with your offer

Cleeng offers a truly unique feature: [social commissions](http://cleeng.com/us/features/social-commission/). You can set this up per item you want to sell. There are two parameters you need to define when you create (or update) your itemOffer: `socialCommissionEnabled` (boolean) and `socialCommissionRate`. The rate is a percentage related to the item price and limited to 50% (=0.50).

*Example: if you sell an item for $2.50, and you set socialCommissionRate to 0.40 ( = 40%), people who share that item will earn $1 when their friends or followers buy it too.*

This tutorial re-uses the files from tutorial 3 to manage your offers. Open [create_item_offer.php]() and edit the parameters as you wish (or use [update_item_offer.php]()). Just like in Tutorial 1, run the file to create and define your offer on the Cleeng servers, though now with the two social commission parameters. Copy the itemOfferId that is returned from the Cleeng servers and put them in the [config]() file in the example 4 folder.

    ```php
	 // To set-up a social commission of $1 we need to set 40% of the item price ($2.50)
	 // So socialCommisionRate = 0.40 (=40%)
     $itemOffer = $cleengApi->createItemOffer(array(
          'price' => 2.50,
          'url' => 'http://your-site.com/view-item-here',
          'itemType' => 'video',
          'description' => 'Buy this item for $2.50. You will love it!',
          'pageTitle' => 'Win-Win situation: benefit from the social commission',
          'socialCommissionEnabled'=>TRUE,
          'socialCommissionRate'=> '0.40'
       ));
       echo 'Created item offer with id = ' . $itemOffer->id . "\n";
       ```

Now you have created an item with social commissions enabled.  Check [get_offer_details.php]() to validate the set-up. Continue with section 3 to let your visitors use it.

##3. Engage your audience and let them share

Now that you have enabled social commission on your itemOffer it is important that you communicate this great feature to your visitors. The social commissions works through unique personalized short URLs (cleeng.it) that are accessible via the [getAccessStatus()](/v3/Reference/Query_API/Functions/getAccessStatus). There are two important messages you should highlight to your users:

1. Inform them about how much they can earn.
2. Inform them to share the content via Twitter, Facebook or via any other means... (as long as the unique short-URL is shared)

### 3.1 Informing about social commissions.
You can explain the rate you have set and just write some plain text on your webpage (like in above example "Purchase, Share and Earn $1 per Sale!"), but you can also call the API to get the commission rate and display a rate or price accordingly.

Example in PHP:

    ```php
	// NOTE: CODE TO BE UPDATED
	$accessStatus = $cleengApi->getAccessStatus(123123123);

	If ($cleengAPI->itemOffer['socialCommissionEnabled']) {
		// only add the word "Purchase" when user didn't purchase it yet.
		if (!$cleengAPI->isAccessGranted) {
			echo "Purchase, ";
		}
		// show the currency of the user (or default from the publisher), and calculate the exact value the user
		echo "Share and Earn ".$cleengAPI->currency." ".round($itemOffer->price*$cleengAPI->socialCommissionRate,2);
		if ($cleengApi->isAccessGranted) {
			echo " by using this URL: ".$accessStatus->socialCommissionUrl;
		}
		echo "<br /><i>Money is transferred to your account and can be used to purchase more content.</i>";
	}
	```


Example in JavaScript:

    ```javascript
	// NOTE: CODE TO BE UPDATED
	// After purchase you can show an alert like this:
	CleengApi.getItemOffer(123123123, function(itemOffer) {
		alertmsg = 'Share and Earn: '.itemOffer.socialCommissionRate*100.' by sharing this link: ';
	});
	CleengApi.getAccessStatus(123123123, function(accessStatus) {
		alertmsg.= accessStatus.socialCommissionURL;
	}
    alert(alertmsg);
    ````

*Note: the social commission is only credited when the special cleeng.it URL is used to share the item. So ensure your users are instructed to use this.*

### 3.2 Informing about social commissions.
When somebody purchases your item, a unique short-URL (cleeng.it) is created. In order for the social commission to be activated, this is what needs to be shared. The commission is credited to the original sharer when friends or followers purchase via this URL. This URL is retreived with `$cleengAPI->xxx` and can be used within different social tools like Twitter or Facebook, or communicated directly.

    ```php
	// NOTE: CODE TO BE UPDATED
	$itemOfferId = 12312313;

	$accessStatus = $cleengApi->getAccessStatus($itemOfferId);
	$user = $cleengApi->getUserInfo();
	$itemOffer = $cleengApi -> getItemOffer();

	if ($cleengApi->isAccessGranted($itemOfferId)) {

		// define currency and rate in currency
		$earn = $cleengAPI->currency." ".round($itemOffer->price*$cleengAPI->socialCommissionRate*100,2);
		echo "Share &amp; Earn: ".$earn;

		// Example on how to post this on Twitter:
		echo '<a class="cleeng-twitter" href="http://twitter.com/?status='.$itemOffer->description.' '.$accessStatus->socialCommissionUrl.'">Share and earn using twitter</a>';

		// Example on how to post this on Facebook:
		echo '<a class="cleeng-facebook" href="http://www.facebook.com/sharer.php?u='.$accessStatus->socialCommissionUrl.'&amp;t='.$itemOffer->description.'">Share and earn using Facebook</a>';

		// Example on how to post this via Email:
		echo '<a class="cleeng-email" href="mailto:?subject='.$user->name'%20wants%20to%20share%20with%20you&amp;body=Hi,%0A%0AI%20wanted%20to%20share%20this%20'.$itemOffer->type.'%20with%20you.%0A%0AClick%20here%20to%20access%20it:%20'.$accessStatus->socialCommissionUrl.'%0A%0AHave%20a%20look!%0A%0A'.$itemOffer->XXXXXXXXX.'">&nbsp;</a>';

		// Communicate the link itself:
		echo 'Share your unique link and earn credits to buy more content: <a href="'.$accessStatus->socialCommissionUrl.'">'.$accessStatus->socialCommissionUrl.'</a>';
	}
	```php

Alternatively you can simply load the following div class `class="cleengShare"`. When an item is purchased it will display the above sharing options for Facebook, Twitter, Email and display the URL itself. You need to load the JS file: `cleengSocial.js`.

	// NOTE: CODE TO BE UPDATED
	<script type="text/javascript">

	</script>

	<div class="cleengShare"></div>


##4. Full example: sell items with social commission

The example of [Tutorial 2](http://cleeng.com/open/example/02/purchase.php) is simply extended with the social commission system. When you have set-up an itemOffer with social commission you can use the following script to sell that item and promote the social commission.

	// NOTE: TO BE UPDATED

	<script type="text/javascript">

	<?php

	if ($cleengApi->isAccessGranted($itemOfferId)) {
   		echo '<div id="protected_content">' . $itemToProtect . '</div>';
   		if ($cleengApi->socialCommissionEnabled) {
	   		echo '<div id="cleengShare">Share & Earn: '.$cleengApi->socialCommissionRate.'</div>';
		}
	} else {
  		echo '
   		<div id="prompt">Content not accessible. <a href="#" id="purchase">Buy</a></div>
   		<div id="protected_content" style="display:none"></div>';

		if ($cleengApi->socialCommissionEnabled) {
	   		echo '<div id="cleengShare" style="display:none">Share & Earn: '.$cleengApi->socialCommissionRate.'</div>';
		}
	}



##5. Summary

Get the package with all [example files](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) from Github and do the following:

* Ensure you are registered as publisher and have your API token entered in the config.php file - see [tutorial 1](http://cleeng.com/open/Tutorials/01_Getting_started_with_Cleeng)
* Complete the sales parameters in [create_offer.php]() from Tutorial 3. Run the file in your browser - this generates your itemOfferId. (See [tutorial 3](http://cleeng.com/open/Tutorials/Manage_pay-per-items) for more).
* Put your itemOfferId in the [config]() file of this example. Optional: validate if social commission is activated by using: [get_offer_details.php](http://github.com/cleeng) from tutorial 3.
* Explain social commission to your visitors in your [purchase.php](). After their purchase display the sharing mechanism to them.
* Promote your unique social commission feature, and let your visitors benefit from your quality content too. A real win-win situation!

**Anything unclear or wrong?**

Let us know on [Github](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/01_Getting_started_with_Cleeng.md) and indicate any suggestions or changes! Highly appreciated.
