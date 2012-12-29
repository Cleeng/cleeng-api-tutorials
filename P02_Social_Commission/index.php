    <?php
/*
Basic template to sell Virtual Tickets for Live Video events using Cleeng
V0.9 - 2012 (c) -  Cleeng - instant access to quality content

Check for more demos and tutorials http://cleeng.com/open

IMPORTANT:
WHEN YOU SELL TICKETS FOR A LIVE EVENT, PLEASE INFORM CLEENG ABOUT:
- when you start promoting your event
- exact start and end-time of your event
- estimated total tickets

IN CASE YOU WANT TO BENEFIT FROM CLEENG VIP SUPPORT FOR YOUR CUSTOMERS, PLEASE CONTACT CLEENG.

 In config.php define:
 1. the protected content (your video stream)
 2. the offerId (see for more info: create_offer.php)

 include Cleeng configuration file
*/
include 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="css/global.css" media="screen" type="text/css" />
    <title>Example 1 - Sell virtual tickets using Cleeng</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $cleengApi->getJsApiUrl() ?>"></script>
    <script type="text/javascript">
    <!-- loads protected content instantly with AJAX after payment is confirmed -->
    function reveal() {
        $.post('ajax.php', function(text) {
            if (text) {
                $('#protected_content').html(text).show();
                $('#wrapper').hide();
            }
        });
    }
    <!--when clicking buy and payment confirmed, reveal -->
    $('document').ready(function() {
        CleengApi.trackOfferImpression("<?php echo $offerId ?>");
        $('#buynow').click(function() {
            CleengApi.purchase("<?php echo $offerId ?>", function(result) {
                reveal();
            });
            return false;
        });
    });
    <!--when clicking login and payment confirmed, reveal -->
    $('document').ready(function() {
        $('#cleenglogin').click(function() {
            CleengApi.login(function(result) {
                if (result.success) {
                    reveal();
                    $('.already').html('No purchase registered yet!');
                }
            });
            return false;
        });
    });

    </script>
</head>
<body>
	<div class="content">
        <div class="ticket">
        	<h1>Virtual Ticket to "<?php echo $event->title; ?>"</h1>
            <h2><?php echo $event->description; ?></h2>
        </div>
        <div class="screen">
<?
if ($access->accessGranted) {
	echo '<div id="protected_content" class="video">';
	echo $contentToProtect; //defined in config.php
} else {
// show wrapper, also display the empty div "protected content" to load via AJAX after purchase is made.
	?>
			<div id="protected_content" class="video"></div>
        	<div id="wrapper" class="wrapper">
                <h3>Virtual ticket for <?php echo $event->title; ?><br /></h3>
                <p class="join-us">Join us at <?php echo $event->title; ?>... <br />....from the comfort of your own home!</p>
                <p class="text-1">This virtual ticket lets you experience the sights and sounds of <?php echo $event->title; ?> through a live, high-definition Internet video stream.</p>
                <p class="text-2">It provides full access to the event and can be watch from your home, mobile or iPad!</p>
                <span class="price">$7.95</span>
                <a href="#" id="buynow" class="purchase">Buy Now</a>
                <div class="already">Already bought a ticket? <a href="#" id="cleenglogin">Login here</a></div>
			</div></div>
    <?
}
?>
        <div class="bottom-links">

            <a href="faq.html" class="faq">FAQ &amp; Support</a>
            <a href="http://www.facebook.com/sharer.php?u=http://your-url.com" class="facebook" target="_blank">Post on Facebook</a>
            <a href="http://twitter.com/?status=Check this out! Pre-book a virtual ticket for [EVENT NAME] broadcasting HD live: http://your-url.com" class="twitter" target="_blank">Post on Twitter</a>

            <p class="powered">&copy; 2012 - Virtual ticket template powered by Cleeng</p>

        </div>

    </div>


</body>
</html>
