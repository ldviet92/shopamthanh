<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$product  = primave_get_global_variables('product');

if (get_option('woocommerce_enable_review_rating') === 'no') {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ($rating_count > 0) : ?>

	<div class="vgwc-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf(esc_html__('Rated %s out of 5', 'vg-primave'), $average); ?>">
			<span style="width:<?php echo (($average / 5) * 100); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html($average); ?></strong> <?php printf(__('out of %s5%s', 'vg-primave'), '<span itemprop="bestRating">', '</span>'); ?>
				<?php printf(_n('based on %s customer rating', 'based on %s customer ratings', $rating_count, 'vg-primave'), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>'); ?>
			</span>
		</div>
		<?php if (comments_open()) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf(_n('%s customer review', '%s customer reviews', $review_count, 'vg-primave'), '<span itemprop="reviewCount" class="count">' . $review_count . '</span>'); ?>)</a><?php endif ?>
	</div>

<?php endif; ?>
