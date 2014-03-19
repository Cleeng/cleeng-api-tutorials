Tutorial 6 - Offers Tagging, Subscription plans, Passes
=======================================================

Read how to create subscription plan, pass offer & learn how to use tags assigned to your offers. After previous tutorials, you should know almost everything about single or rental offers management. That knowledge will be very useful to clearly understand tagging process.

If you want to e.g.:

<i class="icon-arrow-right"></i> Provide access for your customers to all of your awesome content by weekly subscription.

or,

<i class="icon-arrow-right"></i> Provide access for your customers to all of your awesome content once for day or month.

or maybe,

<i class="icon-arrow-right"></i> Give access only to all your articles about Finance by monthly subscription.

You are in right place!

**What exactly you can find in this tutorial:**

* how to create & properly describe your subscription/pass plan,
* how to point offers covered by the subscription/pass plan

##1. Create subscription plan

Creating and managing subscription offers is similar to other types. If you missed previous tutorials, below you can find links to offer managing basics.

<i class="icon-arrow-right"></i> <a href="Tutorials/02_Creating_Offers">Full tutorial about how to create offers</a>

<i class="icon-arrow-right"></i> <a href="Tutorials/04_Manage_your_offers">How to manage your offers tutorial</a>

Also check out the [Subscription Offers Reference](v3/Reference/Subscription_Offer_API), where can you read about every property of subscription offer object. Besides,
you can find there API every method related to Subscription offers.

If everything is clear, lets create offer which will be **monthly subscription of your articles about Finances and Politics.**

Here, take a look at the code sample:

    $offerSetup = array(
        'title' => 'Subscribe fresh news about Finances and Politics',
        'price' => 19.00,
        'url' => 'http://your-site.com/',
        'description' => 'Get access to all of your favourite articles about Finances and Politics for 19$/month',
        'period' => 'month',
        'accessToTags' => array('Finance', 'Politics')
    );

    $cleengApi = new Cleeng_Api();
    $cleengApi->setPublisherToken('YOUR_PUBLISHER_TOKEN');

    $cleengApi->createSubscriptionOffer($offerSetup);

Most of the parameters in `$offerSetup` array are the same like in e.g. Rental Offers. Lets focus on `period` and `accessToTags` parameters:

* `period` - How often to bill the user. week / month / 3months / 6months / year

* `accessToTags` - Describe which offers you want to cover by you subscription offer.

<div class="alert alert-info"><strong>Important:</strong><br/>
    1. To cover all of your offers by subscription plan, just set <code>'accessToTags' => array('(all)')</code><br/>
    2. Multiple tags are defined as "OR" (not "AND").
</div>

##2. Pass offers

Pass offers are totally similar to subscriptions. First one, but extremely important difference:

<div class="alert alert-info"><strong>Important:</strong>
    After purchasing Pass offer, customer is billed only once! and has access to your content for period you set in pass parameters.
</div>

Also, instead of `period` parameter, you can use `expiresAt` and set unix timestamp expire date.

Getting all things together:

* you can give to your customers one-time access for whole day to every article about finance,

`period` = 'day'

`accessToTags` = array('finanse')

* access till (any date) to every video about health food.

`expiresAt` = 'some date (unix timestamp)'

`accessToTags` = array('health food')

Check out the [Pass Offers Reference](v3/Reference/Pass_Offer_API), where can you read about every property of pass offer object. Besides,
you can find there API every method related to Pass offers.


##3. Tag your offer

Creating subscription/pass offer it is not enough. Your offers have to be tagged properly and compatible with 'accessToTags' param from subscription plan.

Do you remember how to create rental offers ? Check out code sample, which also you can find in [Creating offers](Tutorials/02_Creating_Offers) tutorial.

    $offerSetup = array(
        'title' => 'Most important news from Politics / July 2012',
        'price' => 3.99,
        'url' => 'http://your-site.com/most_important_news_from_politcs_july',
        'contentType' => 'article',
        'description' => 'Catch up the most important facts from Politics',
        'tags' => array('Politics', 'July2012')
    );

    $cleengApi = new Cleeng_Api();
    $cleengApi->setPublisherToken('YOUR_PUBLISHER_TOKEN');

    $cleengApi->createSingleOffer($offerSetup);

<div class="alert alert-info"><strong>Important:</strong><br/>
    Focus on the line: <code>'tags' => array('Politics', 'July2012')</code><br/>Only after <code>'tags'</code> array param your offer is tagged and tag <code>'Politics'</code>will
    be connected with subscription plan which we created above in 1st point. That offer can also be connected with other subscription plan
    with e.g. "every article from July 2012" using tag 'July2012'.
</div>


##4. What you should know!

- To cover all of your offers by subscription plan/pass, just set <code>'accessToTags' => array('(all)')</code>, read above (1st point)
- Multiple tags are defined as "OR" (not "AND"),
- Subscription plan/pass can cover single, rental and event offers only,
- If your subscription plan/pass contain rental offers, <code>period</code> parameter doesn't count anymore for customers with active subscription, they have access to your rental offer for whole subscription period,
- Periods in subscription plans / Passes: week / month / 3months / 6months / year

---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Subscription plan';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
