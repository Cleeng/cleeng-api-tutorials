<?php
/**
 * Cleeng API Example 3 - Cleeng Sandbox
 * you can find tutorial 3 here: http://open.cleeng.com/Tutorials/02_Cleeng_Sandbox
 * =====================================================================
 * This file should be opened in browser, probably:
 * your-site.com/03_Cleeng_Sandbox/purchase.php
 */


// set the ID of the offer you want to sell
$offerId = 'YOUR_SANDBOX_OFFER_ID'; // R733029903_US - default offerID for sandbox


// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

$cleengApi = new Cleeng_Api();

//set endpoint to Sandbox
$cleengApi->enableSandbox();

?>
<html>
<head>
    <script type="text/javascript" src="<?php echo $cleengApi->getJsApiUrl() ?>"></script>
    <script type="text/javascript">
        CleengApi.trackOfferImpression("<?php echo $offerId ?>");
        function cleengPurchase() {
            CleengApi.purchase("<?php echo $offerId ?>", function (result) {
                window.location.reload();
            });
        }
    </script>
</head>
<body>
<h1>Example 3: Cleeng Sandbox</h1>
<p>In case of any problems, please go back to <a href="http://cleeng.com/open/Tutorials/03_Cleeng_Sandbox">tutorial</a> on Cleeng Open.</p>

<hr />

<?php

// Check if visitor has access to protected content
if ($cleengApi->isAccessGranted($offerId)): ?>

Yeah!! You have access to offer <?php echo $offerId ?>. You can define any html here that you want to sell. You have now access to this anywhere, anytime.
<br /><br />
Please note:
<ul>
    <li>A secure token is set, so next time you go to this page (using this browser) you have instant access again. </li>
    <li>To access this content from another device, just log in to Cleeng and visit this page. The content is automatically revealed.</li>
    <li>To have an overview of all items bought, check your <a href="http://sandbox.cleeng.com/my-account/">Sandbox Cleeng library</a>. Now this item is listed there as well.</li>
    <li>Be aware that as a publisher you have always instant access to the content you published.</li>
</ul>

    <?php else: ?>

Content is not accessible for you. <br /><br />
<form>
    <input type="button" onClick="javascript:cleengPurchase();" value="Buy access to this content" />
</form>

    <?php endif; ?>

<hr />
<p>
    &copy; Safe & secure content protection and monetization by
    <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank">
        <img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" />
    </a>.
</p>

</body>
</html>