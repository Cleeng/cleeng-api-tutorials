<?php
/**
 * Cleeng API Example 1 - How to protect your content
 * you can find tutorial 1 here: http://cleeng.com/open/Tutorials/01_Starting_with_Cleeng_PHP_SDK
 * =====================================================================
 * This file should be opened in browser, probably:
 * your-site.com/01_Getting_started_with_Cleeng/purchase.php
 * =====================================================================
 * Remember, if you want to test payment process, you have to work on sandbox.
 * Check how to work with sandbox in Tutorial 3 : http://cleeng.com/open/Tutorials/03_Sandbox_testing
 * =====================================================================
 */


// set the ID of the offer you want to sell
$offerId = 'R803743332_PL'; //default offer for cleeng.com


// include PHP SDK
include_once('../cleeng-php-sdk/cleeng_api.php');

$cleengApi = new Cleeng_Api();

?>
<html>
<head>
	<script type="text/javascript" src="http://cleeng.com/js-api/3.0/api.js"></script>
	<script type="text/javascript">
	    CleengApi.trackOfferImpression("<?php echo $offerId ?>");
	    function cleengPurchase() {
		CleengApi.purchase("<?php echo $offerId ?>", function (result) {
		    // reload page after purchase to reveal protected ite
		    // improve the user experience - learn how to load with AJAX in tutorial 2
		    window.location.reload();
		});
	    }
	</script>
</head>
<body>
	<h1>Example 1: Getting started with Cleeng</h1>
	<p>In case of any problems, please go back to <a href="http://cleeng.com/open/Tutorials/01_Protect_your_content">tutorial</a> on Cleeng Open.</p>

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
        <li>To have an overview of all items bought, check your <a href="http://cleeng.com/my-account/">Cleeng library</a>. Now this item is listed there as well.</li>
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