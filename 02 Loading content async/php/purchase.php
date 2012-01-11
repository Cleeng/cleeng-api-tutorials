<?php
/**
 * Cleeng API Example 2 - Loading content asynchronously
 *
 * This file should be opened in browser.
 */

// include configuration file
include 'config.php';
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cleeng.local/js-api/2.0/api.js"></script>
<script type="text/javascript">
$('document').ready(function() {
    CleengApi.countItemOfferImpression("<?php echo $itemOfferId ?>");
    $('#purchase').click(function() {
        CleengApi.purchase("<?php echo $itemOfferId ?>", function(result) {
           $.post('ajax.php', function(text) {
               if (text) {
                   $('#protected_content').html(text).show();
                   $('#prompt').hide();
               }
           });
        });
        return false;
    });
});
</script>

<?php

// Check if visitor has access to protected content
if ($cleengApi->isAccessGranted($itemOfferId)) {
    echo '<div id="protected_content">' . $itemToProtect . '</div>';
} else {
    echo '
    <div id="prompt">Content not accessible. <a href="#" id="purchase">Buy</a></div>
    <div id="protected_content" style="display:none"></div>
    ';
}