<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

$post  = primave_get_global_variables('post');
$product  = primave_get_global_variables('product');
?>

<?php if ($product->is_featured()) : ?>
	<?php echo apply_filters('woocommerce_featured_flash', '<div class="vgwc-label vgwc-featured">' . esc_html__('Hot', 'vg-primave') . '</div>', $post, $product); ?>
<?php endif; ?>

<?php if ($product->is_on_sale()) : ?>
	<?php echo apply_filters('woocommerce_sale_flash', '<div class="vgwc-label vgwc-onsale">' . esc_html__('Sale', 'vg-primave') . '</div>', $post, $product); ?>
<?php endif; ?>