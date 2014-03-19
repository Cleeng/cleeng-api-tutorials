Example 3 - Sell files/downloads
===============================

**If you want to sell files and give your buyers a great user experience, you're in the right place!!**

In this tutorial, you can learn how to sell files using Cleeng. The tutorial is based on PHP and the example is available on [github](https://github.com/Cleeng/cleeng-download-example).


Start with cloning: git@github.com:Cleeng/cleeng-download-example.git

Then run `php composer.phar install` to download Cleeng PHP SDK.

Check the [live demo](example/08/cleeng-download-example/index.php)

---

##1. Introduction

Note: for this example we assume you host the downloadable file yourself.

Suggested steps:

1. Ensure you are registered with a Cleeng Publisher account, and have your PublisherToken ready.
2. Define the conditions on how you want to sell your file(s), and set the price by creating a [Single offer](v3/Reference/Single_Offer_API/Functions/createSingleOffer).
for unlimited access or [Rental offer](v3/Reference/Single_Offer_API/Functions/createRentalOffer) for temporary access. Check [Tutorial 2](Tutorials/02_Creating_Offers) for more examples.
3. Using the offer ID from step 2, protect your file against the Cleeng API. When access is granted, share the file to the customer. Check [Tutorial 1](Tutorials/01_Protect_your_content) for basics around access and protection of content.
4. Provide a great user experience, by downloading automatically after purchase and display a 'download has started message'.

All information about using the SDK, creating offers and how to protect it is documented in previous tutorials. 
This example combines this knowledge, and gives some specifics on how to provide a great user experience for premium downloads.

##2. The example code explained

When you check index.php file, it starts with including `config.php`.
Just put your reference to the file, and the offer ID into your config.php.

    ```php
    $offerId = 'A655681095_SE';`

    $file = "myvideo.mp4";`
    ```

After setting config file, this is time for some JS magic. On example in `index.php` you can see "Own & download for 0.99", onclick will run the purchase() method, which provides a cleeng popup if customer in not logged in and gives you info about the access for current customer.
When access is granted we are going to run the `content.php` file.

    ```js

        $('document').ready(function () {
            function loadContent(token) {
                $.post('content.php', function (result) {
                    if (result) {
                        $('#cleeng_content').html(result);
                    } else {
                        $('#cleeng_loader').hide();
                    }
                });
            }
            $('#cleeng_purchase').click(function () {
                CleengApi.purchase(offerId, function (accessStatus) {
                    if (accessStatus.accessGranted) {
                        $('#cleeng_loader').show();
                        loadContent(accessStatus.token);
                    }
                });
                return false;
            });
        });

    ```

Let's take closer look on `content.php` file:

    ```php

    if ($cleengApi->isAccessGranted($offerId)) { //one more time check if customer has access

    	echo <<<HTML
             <div class="alert alert-success">

            Download will start automatically in 5 seconds, if not please click <a href="file.php">here</a>.
            //this will be shown for customer, if problems provide the link to download file manually "<a href="file.php">here</a>"

             <script type="text/javascript">
                 $('document').ready(function () {
                     function download() {
                         window.location = 'file.php'; //when access is granted, run file.php which will push your file (myvideo.mp4) to download.
                     }
                     window.setTimeout(download, 5000);
               });
             </script>
             </div>

    HTML;
    ;
        exit;
    }

    ```

One more time, check if customer has access and run `file.php`, which will push file to download automatically. Read about `file.php` below!

##3. Security

**It is all about `file.php`!**

    ```php

    if ($accessStatus && $accessStatus->accessGranted) {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=thankyoufordownloading.mp4');

            //customer will download thankyoufordownloading.mp4 file with no clue what is the original name

            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
        }
    }

    ```

We have to make sure that your customers won't share the link to download your file (www.yourwebsite.com/myvideo.mp4). There are several ways to do it:

- (our example) not showing file name by using "click `<a href="file.php">`here`</a>`" and changing file name to *thankyoufordownloading.mp4*

- if you want to share direct link to the file, generate a temporary access token on your file, so your user can only access the link during the time it is offered for download. If he would share the actual link to the file it would expire anytime soon.



---

**Anything unclear or wrong?**

Let us know on [Github](https://github.com/Cleeng/cleeng-download-example) and indicate any suggestions or changes! Highly appreciated.

---

##Any thoughts or suggestions? Share with us!
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_title = 'Cleeng Open';
    var disqus_identifier = 'Protect your files';
    var disqus_shortname = 'cleengopen';
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>