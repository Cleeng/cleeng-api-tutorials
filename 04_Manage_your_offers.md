Tutorial 4 - Manage your offers
===============================


Welcome to the 4th tutorial our dear Developer. What you should know already:

* [What is Cleeng and how it works](/Tutorials/Introduction)
* [How to implement PHP SDK and protect you content](/Tutorials/01_Protect_your_content)
* [How to get publisher token and how easy is to create new offers](/Tutorials/01_Creating_Offers)
* [How to set Cleeng Sandbox](/Tutorials/03_Cleeng_Sandbox), our cozy environment for testing Cleeng.

<table><tr>
    <td style="padding:20px 10px 27px 25px">From now on, the main assumption is:</td>
    <td><h3>Coding<i class="icon-arrow-up"></i>  <i class="icon-arrow-down" style="margin-left:15px;"></i>Talking</h3></td>
</tr></table>

##1. Introduction

Again we stay close to offers, but this time you can learn how to update and deactivate existing offers.

Also in this tutorial we will work with Cleeng Sandbox [?](Tutorials/03_Cleeng_Sandbox).

What can be useful:

* [API Reference](/Reference) - place, where you can read about every method we are using
* [Example files<i class="icon-download"></i>](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) - package of examples, you should have it already, from previous tutorials.

---

##2. Creating offer

The same as in previous tutorial: [Cleeng Sandbox](Tutorials/03_Cleeng_Sandbox)

[create_offer.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/03_Cleeng_Sandbox/create_offer.php) quick guide:

2.1. Create new Cleeng_Api object

    $cleengApi = new Cleeng_Api();

2.2. Set publisherToken from Sandbox

    $cleengApi->setPublisherToken('YOUR_SANDBOX_PUBLISHER_TOKEN');


2.3. Set endpoint to sandbox.

    $cleengApi->enableSandbox();

2.4. Create `offerSetup` array and use it to create your offer.

    $offer = $cleengApi->createRentalOffer($offerSetup);

That's it!

##3. Update your offer

At first check [update_offer.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/04_Manage_your_offer/update_offer.php), as you can see we repeat steps from 2.2 - 2.3 to switch to Sandbox environment.

Because in this Tutorial we are working with Rental offers, read about how to [updateRentalOffer](/v3/Reference/Rental_Offer_API/Functions/updateRentalOffer) in API Reference. Main assumptions connected with changing existing offers are:

* you have to be the offer owner
* you have to know the id of the offer you want to change

3.1 Set offer ID

    $offerId = 'R495315693_PL';

3.2 Set array only with parameters you want to change

E.g. if I want to change only title and period:

    $offerSetup = array(
        'title' => 'Super Cool article for just $0.49 with longer access!',
        'period' => '72'
    );

3.2 Use it in `updateRentalOffer` method

    $offer = $cleengApi->updateRentalOffer($offerId, $offerSetup);


And it's done!

##4. Deactivate the offer

About `active` property you can read in [Rental Offer Overview](/v3/Reference/Rental_Offer_API). One and only option to change it is [deactivateRentalOffer](/v3/Reference/Rental_Offer_API/Functions/deactivateRentalOffer) method.
After calling this method, you still will be able to find the offer using e.g. [getRentalOffer](/v3/Reference/Rental_Offer_API/Functions/getRentalOffer), **but** there is no option to make the offer active again!

So, to make the offer disable to purchase you just have to:

* you have to be the offer owner
* you have to know the id of the offer you want to disable

3.1 Set offer ID

    $offerId = 'R495315693_PL';

3.2 Use it in `updateRentalOffer` method

    $offer = $cleengApi->deactivateRentalOffer($offerId);

And it's gone.




---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Cleeng Sandbox';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
