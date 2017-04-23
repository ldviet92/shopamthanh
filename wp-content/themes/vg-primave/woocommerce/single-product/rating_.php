<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

$product  = primave_get_global_variables('product');

if (get_option('woocommerce_enable_review_rating') === 'no')
	return;

$count   = $product->get_rating_count();
$average = $product->get_average_rating();

?>
<div class="vgwc-product-rating">
<?php
if ($count > 0) : ?>
	<div class="star-rating" title="<?php printf(__('Rated %s out of 5', 'vg-primave'), $average); ?>">
		<span style="width:<?php echo (($average / 5) * 100); ?>%">
			<strong class="rating"><?php echo esc_html($average); ?></strong> <?php esc_html__('out of 5', 'vg-primave'); ?>
		</span>
	</div>
	<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('%s review | Add your review', '%s reviews | Add your review', $count, 'vg-primave'), '<span class="count">' . $count . '</span>'); ?></a>
<?php else: ?>
<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('%s review | Add your review', '%s reviews | Add your review', $count, 'vg-primave'), '<span class="count">' . $count . '</span>'); ?></a>
<?php endif; ?>
</div>