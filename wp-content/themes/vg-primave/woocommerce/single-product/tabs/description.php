<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

$post  = primave_get_global_variables('post');

$heading = esc_html(apply_filters('woocommerce_product_description_heading', esc_html__('Product Description', 'vg-primave')));
?>


<?php the_content(); ?>
