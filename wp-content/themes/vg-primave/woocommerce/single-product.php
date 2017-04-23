<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

primave_get_header(); ?>
<?php $primave_options  = primave_get_global_variables(); ?>
<div class="main-container page-shop">
	<div class="page-content">
		<div class="row-breadcrumd">
			<div class="container">
				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action('woocommerce_before_main_content');
				?>
			</div>
		</div>
		<div class="container">
			<?php //do_action('woocommerce_before_main_content'); ?>
			<div class="row">
				<?php if($primave_options['sidebar_single']=='left' || !isset($primave_options['sidebar_single'])) :?>
					<?php get_sidebar('single'); ?>
				<?php endif; ?>
				<div id="product-content" class="col-xs-12 <?php if (is_active_sidebar('sidebar-product')) : ?>col-md-9 <?php endif; ?>">
					<div class="product-view">
						<?php while (have_posts()) : the_post(); ?>

							<?php wc_get_template_part('content', 'single-product'); ?>

						<?php endwhile; // end of the loop. ?>

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action('woocommerce_after_main_content');
						?>

						<?php
							/**
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							//do_action('woocommerce_sidebar');
						?>
					</div>
				</div>
				
				<?php if($primave_options['sidebar_single']=='right' || !isset($primave_options['sidebar_single'])) :?>
					<?php get_sidebar('single'); ?>
				<?php endif; ?>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					<div class="product-view">
						<div class="product">
							<?php
								do_action('woocommerce_show_tabs_product_summary');
							?>
						</div>
					</div>
				</div>
			</div>
			<?php 
				//do_action('woocommerce_show_tabs_product_summary');
				do_action('woocommerce_show_related_products');
			?>
			
			<?php
				do_action('woocommerce_show_upsell_products');
			?>

		</div>
	</div>
</div>
<?php primave_get_footer(); ?>