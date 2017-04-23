<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

$product  = primave_get_global_variables('product');
$post  = primave_get_global_variables('post');

?>
<div class="price-box" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<div class="vgwc-product-price">
		<?php echo $product->get_price_html();?>
	</div>
</div>