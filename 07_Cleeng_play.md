Tutorial 7 - Advanced video management
======================================


This tutorial is for publishers who want to monetize multiple videos using Cleeng Play (Pre-build wrapper) and host videos on any of these platforms: [Vimeo](http://vimeo.com), [Brightcove](http://brightcove.com) or [Wistia](http://wistia.com).

**We assume that you know already:**

* The features that Cleeng Play offers. No? Go ahead, catch up -> [Cleeng Play](http://play.cleeng.com)
* [How to create offers](Tutorials/02_Creating_Offers) and [how to manage them](Tutorials/04_Manage_your_offers). This is essential here.
* Structure of [Single](v3/Reference/Single_Offer_API) and [Rental](v3/Reference/Rental_Offer_API) offers

**Why should I care ? After this tutorial you will be able to:**

* Automatically create and update multiple video offers
* Generate embed codes

**What you can find in this tutorial:**

* The difference between normal (rental) offers and offers specificly for Cleeng Play.
* How to create and update such offers with the details for each platform
* The advantages of [Cleeng Play](http://play.cleeng.com).

##1. What is a Cleeng Play offer ?

Basically, this is exactly the same offer that you know from previous tutorials. Single offer, for unlimited access and Rental offer for access to video with a time limit.
Besides [the required fields](v3/Reference/Single_Offer_API/Functions/createSingleOffer), we need to complete 3 additional fields with correct data. This will accurately describe your platform and video details.

Below you can find those parameters with example data:

<table class="table table-bordered table-striped">
    <colgroup>
        <col class="span1">
        <col class="span5">
    </colgroup>
    <thead>
        <tr>
            <th>Parameter</th>
            <th>Example</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>contentType</td>
            <td><strong>video</strong><br/>contentType has to be set as video</td>
        </tr>
        <tr>
            <td>contentExternalId</td>
            <td><strong>2099536337001</strong> - Video ID<br/>How to find on <a target="_blank" href="https://d2ck31vttkr8sc.cloudfront.net/img/bc-player_id.png">Brightcove [image]</a> or <a target="_blank" href="https://d2ck31vttkr8sc.cloudfront.net/img/vimeo-id-looks-like-this.png">Vimeo [image]</a></td>
        </tr>
        <tr>
            <td>contentExternalData</td>
            <td>json array with video specification<br/><br/>
                <strong>Brightcove:</strong><br/>
<pre><code class="js">{
    "platform":"brightcove",
    "playerId":"1843362103001",
    "playerKey":"AQ~~,AAABrdmeEWk~,HDSlMwuC-e2wjQi4mKSYh2mvajm7M2Iu",
    "dimWidth":"480",
    "dimHeight":"270",
    "hasPreview":true,
    "previewVideoId":"1934391916001",
    "backgroundImage":"http://play.cleeng.com/resources/img/video_curtains.jpg"
}</code></pre>
                <strong>Vimeo:</strong><br/>
<pre><code class="js">{
    "platform":"vimeo",
    "dimWidth":"500",
    "dimHeight":"306",
    "hasPreview":false,
    "previewVideoId":"",
    "backgroundImage":"http://b.vimeocdn.com/ts/166/821/166821828_640.jpg",
}</code></pre>
                <strong>Wistia:</strong><br/>
<pre><code class="js">{
    "platform":"wistia",
    "dimWidth":600,
    "dimHeight":290,
    "backgroundImage":"http://embed.wistia.com/deliveries/92ccc9740287761fbd1290268661ff9b5ce33d57.jpg",
    "contentType":"video",
    "playerColor":"81b7db",
    "version":"v1",
    "volumeControl":true
}</code></pre>
            </td>
        </tr>
    </tbody>
</table>

As you can see, the most complex is to fill contentExternalData. Lets take a look what information we can find there (on Vimeo example):

- `platform` (brightcove, vimeo or wistia),
- `dimWidth`, `dimHeight`, your player size,
- `backgroundImage`, url to image which you can see under embed video details, in example we have [[image]](http://b.vimeocdn.com/ts/166/821/166821828_640.jpg)  which you can see here [https://play.cleeng.com/james-smith/A528026616_PL](https://play.cleeng.com/tomasz-szadkowski/A528026616_PL)
- `hasPreview`, true or false
- `previewVideoId`, put here ID of some teaser.

Only for brightcove:

- `playerId`
- `playerKey`
both you can find on <a target="_blank" href="https://d2ck31vttkr8sc.cloudfront.net/img/bc-player_id.png">[image]</a>

Only for wistia:

- `contentType` video
- `playerColor` 81b7db
- `version` v1
- `volumeControl` true



##2. How to create Cleeng Play offers?

Read the basic tutorial on how to create offers [here](/Tutorials/02_Creating_Offers). Based on that example, you find below the php array with specific offer data to store your video details.

Lets create Video for $9 with 48h access. To improve selling we will add nice background photo and preview video.

<pre><code class="php">
$offerSetup = array(
    'title' => 'My very first video offer, created via Cleeng API. You will love it!',
    'period' => 48,
    'price' => 9,
    'url' => 'http://your-site.com/view-video-here',
    'description' => 'Video description.',
    'contentType' => 'video',
    'contentExternalId' => 123456789,
    'contentExternalData' => '{"platform":"vimeo","dimWidth":"500","dimHeight":"306","backgroundImage":"http://super.background.com/background.jpg","hasPreview":true,"previewVideoId":"987654321","publisherId":"584833144"}'
);
$offer = $cleengApi->createRentalOffer($offerSetup);
</code></pre>


What we see above is exactly the same way of creating the offers as in [previous tutorials](/Tutorials/02_Creating_Offers), except those three additional fields which have to be filled correctly.

##3. Embed codes

After you created the offer, now it is time to spread the world about it. All we need is the offer ID, which you get returned from [`createRentalOffer`](v3/Reference/Rental_Offer_API/Functions/createRentalOffer) method:
<pre><code class="php">$offerSetup = array(...);
$offer = $cleengApi->createRentalOffer($offerSetup);
//display ID
echo $offer->id;
</code></pre>

Or, from [`listRentalOffers`](v3/Reference/Rental_Offer_API/Functions/listRentalOffers).

----

####Using offer ID, generate the embed code:



<table style="width: 100%"><tr><td>Embed offer on your website, by putting code:</td></tr>
<tr>
<td>
<textarea style="width:100%"><script type="text/javascript" src="https://play.cleeng.com/movie.js?offerId=OFFER-ID&width=XXX&height=YYY" ></script></textarea>
Note: you can use https or http protocol.
</td></tr><tr><td>
e.g. with https <textarea style="width:100%"><script type="text/javascript" src="https://play.cleeng.com/movie.js?offerId=A246854168_XX&width=600&height=430" ></script></textarea>
or with http
<textarea style="width:100%"><script type="text/javascript" src="https://play.cleeng.com/movie.js?offerId=A246854168_XX&width=600&height=430" ></script></textarea>

</td></tr></table>


to see ready to sell video:

<script type="text/javascript" src="http://play.cleeng.com/movie.js?offerId=A246854168_XX&width=500&height=330"></script>
---

##4. What you should know!

- After you create offer, it is cached on Cleeng Play. You may have problems with updating offers.

---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Cleeng Play';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>