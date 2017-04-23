<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>
<?php $primave_options  = primave_get_global_variables();  ?>
<?php if(isset($primave_options['product_sharing_show']) && $primave_options['product_sharing_show']) { ?>
<div class="single-product-sharing">
	<?php vinagecko_product_sharing(); ?>
</div>
<?php } ?>
