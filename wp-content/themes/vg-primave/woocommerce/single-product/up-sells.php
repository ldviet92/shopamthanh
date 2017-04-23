<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if(! defined('ABSPATH')) {
	exit;
}

if ( $upsells ) : ?>
<div class="widget upsells_products_widget">
	
	<h2 class="vg-title-home"><?php echo (isset($primave_options['upsells_title'])) ? esc_html($primave_options['upsells_title']) : esc_html_e( 'You may also like&hellip;', 'vg-primave'); ?></h2>
	<div class="upsells products">

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				 	$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
</div>
<?php endif;

wp_reset_postdata();
