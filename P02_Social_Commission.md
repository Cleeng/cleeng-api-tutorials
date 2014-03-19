Example 2 - Social Commission <i class="icon-thumbs-up"></i>
=============================

Learn how to push users to share your content with friends or followers and earn money for you. With the credits earned they can purchase new content (or eventually be paid out).
You need to be familiar with [Tutorial 1 - Getting started](Tutorials/01_Protect_your_content) and [Tutorial 2 - Creating Offers](Tutorials/02_Creating_Offers). This tutorial is build on that knowledge and
shows how to activate social commissions on your content offers.


<div class="alert alert-info">Click to see a working demo: <a href="example/P02/index.php">Example 2 - Social Commission</a>.</div>

Worth to have a look: [the example source](https://github.com/Cleeng/cleeng-api-tutorials/tree/master/P02_Social_Commission).


###How Social Commission works

####Say Hi to Nick.

<img src="images/social-commission-2.png" alt="Cleeng Social Commission">
<div id="social-commission">
    <span>Nick <i class="icon-heart"></i> a piece of content. He buys it.</span>
    <span>He shares it with his friends. Uses Cleeng.it/URL</span>
    <span>Nick's friends know that he shares only great stuff and they buy the content too.</span>
    <span>Nick collects some cash, so he can buy and share more amazing stuff.</span>
</div>
<br style="clear: left;">


###Prepare your offer.

At first, you have to prepare your offer. You can [set a new one](Tutorials/02_Creating_Offers) or [update existing](Tutorials/04_Manage_your_offers). Every type of offer has
`socialCommissionRate` param,
which describe how big the commission will be = how much customers will get for sharing your content. `socialCommissionRate` has to be within the range 0.05 (5%) and 0.5 (50%).

<div class="alert">Please, pay attention to <code>url</code> property in your offer. It has to be set right, and redirect users to the page with your offer!</div>

###What changed?

Do you remember [getAccessStatus](v3/Reference/Customer_API/Functions/getAccessStatus) method? This is the one, which tells you (in response) all about customer rights to your
content. One of the properties is `socialCommissionUrl` and if you prepared your offer properly, that field will contain url address (cleeng.it/URL),
which you can show to your customer and make him able to spread the world.

###Example summary

We mixed previous example with social commission, What we get is:

* e.g. You are broadcasting amazing live event
* customer buys the ticket, and gets access to your broadcast
* social commission stripe shows up with cleeng.it/URL
* customer is able to share your amazing live event.

Lets focus on social commission stripe. It is totally up to you how it will be designed. This is our proposition in this example:

<img src="images/socialcommission.png" alt="social commission stripe">

Elements you can see (from left):

* `socialCommissionUrl`, taken from [getAccessStatus](v3/Reference/Customer_API/Functions/getAccessStatus)
* Information how much customer can earn. In that case it is 40% (we set `socialCommissionRate` to 0.4)
* Make it even more easy and add few sharing options.




---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Social Commission';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
