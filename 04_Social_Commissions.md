Tutorial 4 - Social commissions
==========================================================

This tutorial shows how to setup [social commissions](http://cleeng.com/us/featues/social-commissions/). It allows users to be rewarded when sharing content with their friends or followers. With the credits earned they can purchase new content (or eventually be paid out). You need to be familiar with [Tutorial 1 - Getting started]() and [Tutorial 2 - Loading content async](). This tutorial builds on that knowledge and shows how to activate social commissions on your content offers.

This tutorial is for websites and applications that execute [PHP](http://php.net).

After this tutorial you are able to offer social commissions on your digital offers.

1. See it in action
2. Set-up social commissions along with your offer
3. Engage your audience and let them share
4. Full example: sell items with social commission
5. Summary


1. See it in action
-------------------

Click here to see a working demo: [Example 4 - Social commissions]()

2. Set-up social commissions along with your offer
---------------
Cleeng offers a truly unique feature: [social commissions](http://cleeng.com/us/features/social-commission/). You can set this up per item you want to sell. There are two parameters you need to define when you create (or update) your itemOffer: `socialCommissionEnabled` (boolean) and `socialCommissionRate`. The rate is a percentage related to the item price and limited to 50% (=0.50).

*Example: if you sell an item for $2.50, and you set socialCommissionRate to 0.40 ( = 40%), people who share that item will earn $1 when their friends or followers buy it too.*

Now open [create_item_offer.php]() and edit the parameters as you wish (or use [update_item_offer.php]()). Just like in Tutorial 1, run the file to create and define your offer on the Cleeng servers, though now with the two social commission parameters. Copy the itemOfferId that is returned from the Cleeng servers and put them in the [config]() file.

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

Now you have created an item with social commissions enabled.  Check [get_offer_details.php]() to validate the set-up. Continue with section 3 to let your visitors use it.

3. Engage your audience and let them share
-------------------------------------------------------
Now that you have enabled social commission on your itemOffer it is important that you communicate this great feature to your visitors. The social commissions works through unique personalized short URLs (cleeng.it). There are two important messages you should highlight to your users:

1. Inform them about how much they can earn.
2. Inform them to share the content via Twitter, Facebook or via any other means... (as long as the unique short-URL is shared)

### 3.1 Informing about social commissions.
You can explain the rate you have set and just write some plain text on your webpage (like in above example "Purchase, Share and Earn $1 per Sale!"), but you can also call the API to get the commission rate and display a rate or price accordingly.

Example in PHP:

	// NOTE: WRONG CODE, TO BE CREATED BY MAT
	$cleengAPI->socialCommissionRate;
	If ($cleengAPI->socialCommissionEnabled) {
		if (!$cleengAPI->isAccessGranted) {
			echo "Purchase ";
		}
		// show the currency of the user (or default from the publisher), and calculate the exact value the user
		echo "Share and Earn ".$cleengAPI->currency." ".round($itemOffer->price*$cleengAPI->socialCommissionRate,2);
		echo "<br />";
	}


Example in JavaScript:

	// NOTE: WRONG CODE, TO BE CREATED BY MAT
	CleengAPI->socialCommissionRate;

*Note: the social commission is only credited when the special cleeng.it short-URL is used to share the item.*

### 3.2 Informing about social commissions.
When somebody purchases your item, a unique short-URL (cleeng.it) is created. In order for the social commission to be activated, this is what needs to be shared. The commission is credited to the original sharer when friends or followers purchase via this URL. This URL is retreived with `$cleengAPI->xxx` and can be used within different social tools like Twitter or Facebook, or communicated directly.

	// NOTE: WRONG CODE, TO BE CREATED BY MAT

	if ($cleengApi->isAccessGranted($itemOfferId)) {

		// define currency and rate in currency
		$earn = $cleengAPI->currency." ".round($itemOffer->price*$cleengAPI->socialCommissionRate,2);
		echo "Share &amp; Earn: ".$earn

		// Example on how to post this on Twitter:
		echo '<a class="cleeng-twitter" href="http://twitter.com/?status='.$itemOffer->description.' '.$shortURL'">Share and earn using twitter</a>';

		// Example on how to post this on Facebook:
		echo '<a class="cleeng-facebook" href="http://www.facebook.com/sharer.php?u='.$XXXXXX.'&amp;t='.$itemOffer->description.'">Share and earn using Facebook</a>';

		// Example on how to post this via Email:
		echo '<a class="cleeng-email" href="mailto:?subject='.$itemOffer->XXXXXXXXX.'%20want%20to%20share%20with%20you&amp;body=Hi,%0A%0AI%20wanted%20to%20share%20this%20item%20with%20you.%0A%0AClick%20here%20to%20access%20it:%20'.$XXXXXXXXXXXX.'%0A%0AHave%20a%20look!%0A%0A'.$itemOffer->XXXXXXXXX.'">&nbsp;</a>';

		// Communicate the link itself:
		echo 'Share your unique link and earn credits to buy more content: <a href="'.$XXXXX.'">'.$XXXXXX.'</a>';
		// NOTE: MAT, can't we make a simple popup for collecting/sharing URLs instead?
	}


Alternatively you can simply load the following div class `class="cleengShare"`. When an item is purchased it will display the above sharing options for Facebook, Twitter, Email and display the URL itself. You need to load the JS file: `cleengSocial.js`.

	// MAT......
	<script type="text/javascript">

	</script>

	<div class="cleengShare"></div>


4. Full example: sell items with social commission
-------------------------------------------------------

We can reuse the example of [Tutorial 2](), and extend it with the social commission system. When you have set-up an itemOffer with social commission you can use the following script to sell that item and promote the social commission.

	// NOTE: MAT... PLEASE COMPLETE AND CORRECT....

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



5. Summary
----------

Get the package with all files [Tutorial 4 - Social Commissions ](http://github.com/cleeng/) from Github and do the following:

* Ensure you are registered as publisher and have your API token entered in the config.php file - see [tutorial 1]()
* Complete the sales parameters in [create_offer.php](http://github.com/cleeng). Run the file in your browser - this generates your itemOfferId. (See [tutorial 2]() for more).
* Put your itemOfferId in the [config]() file. Optional: validate if social commission is activated: [get_offer_details.php](http://github.com/cleeng).
* Explain social commission to your visitors in your [purchase.php](). Once they purchased enable the sharing mechanism to them.
* Promote your unique social commission feature, and let your visitors benefit from your quality content too. A real win-win situation!