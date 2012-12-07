<?php
/**
 * Cleeng API Example 2 - Loading content asynchronously
 *
 * This file should be opened in browser.
 */

// include configuration file
// in here the protected content is defined, as well as the itemOfferId.
include 'config.php';
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.cleeng.com/js-api/3.0/api.js"></script>
<script type="text/javascript">
$('document').ready(function() {
    CleengApi.trackOfferImpression("<?php echo $offerId ?>");
    $('#purchase').click(function() {
        CleengApi.purchase("<?php echo $offerId ?>", function(result) {
           $.post('ajax.php', function(text) {
               if (text) {
                   $('#protected_content').html(text).show();
                   $('#prompt').hide();
               }
               console.log(text);
           });
        });
        return false;
    });
});
</script>

<?php

// Check if visitor has access to protected content
if ($cleengApi->isAccessGranted($offerId)) {
    echo '<div id="protected_content">' .$contentToProtect. '</div>';
} else {
    echo '
    <div id="prompt">Content not accessible. <a href="#" id="purchase">Buy</a></div>
    <div id="protected_content" style="display:none"></div>
    ';
}

?>
<hr />
<p>&copy; Safe & secure content protection and monetization by <a href="http://cleeng.com" title="Cleeng Content Monetization" target="_blank"><img src="http://cdn.cleeng.com/images/layout/cleeng_logo_small.png" alt="Cleeng Content Monetization" title="Cleeng Content Monetization" /></a>.</p>
