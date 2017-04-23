<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

// Find the category + category parent, if applicable 
$term = get_queried_object(); 
$parent_id = empty( $term->term_id ) ? 0 : $term->term_id; 

// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( http://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
$args = array(
	'child_of'		=> $parent_id,
	'menu_order'	=> 'ASC',
	'hide_empty'	=> 0,
	'hierarchical'	=> 1,
	'taxonomy'		=> 'product_cat',
	'pad_counts'	=> 1
);
$product_subcategories = get_categories( $args  );

primave_get_header(); ?>
<?php
$primave_options  = primave_get_global_variables();
$primave_productrows 		= primave_get_global_variables('primave_productrows');
$primave_productrows = 1;
?>
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
			
			<div class="row">
				
				
				<div id="archive-product" class="<?php echo ($primave_options['sidebar_product']=='left')? 'pull-right' : ''; ?>  col-xs-12 col-md-<?php echo (is_active_sidebar( 'sidebar-product' )) ? 9 : 12 ; ?>">
					<div class="archive-border <?php if($primave_options['sidebar_product']=='right') { echo ' border-right';} ?>">
						
						<?php if (have_posts()) : ?>
							<?php
								/**
								* remove message from 'woocommerce_before_shop_loop' and show here
								*/
								do_action('woocommerce_show_message');
							?>
							
							<?php do_action('woocommerce_archive_description');?>
							
							<div class="shop_header">
								<h1><a href="#">
									<?php
									if(is_shop()){
										esc_html_e('All Categories', 'vg-primave');
									} elseif (is_product_category()) {
										echo single_cat_title('', false);
									}
									?>
								</a></h1>
							</div>
							
							<?php if((is_shop() && '' !== get_option('woocommerce_shop_page_display')) || (is_product_category() && '' !== get_option('woocommerce_category_archive_display'))) : ?>
							<div class="row shop-category">
								<?php woocommerce_product_subcategories(); ?>
								<div class="clearfix"></div>
							</div>							
							<?php endif; ?>
							
							<?php if((is_shop() && 'subcategories' !== get_option('woocommerce_shop_page_display')) || (is_product_category() && 'subcategories' !== get_option('woocommerce_category_archive_display')) || (empty($product_subcategories) && 'subcategories' == get_option('woocommerce_category_archive_display'))): ?>
							<div class="toolbar tb-top">
								<div class="view-mode">
									<a href="#" class="grid active" title="<?php echo esc_attr__('Grid', 'vg-primave'); ?>"><i class="fa fa-th-large"></i> <strong><?php //echo esc_html__('Grid', 'vg-primave'); ?></strong></a>
									<a href="#" class="list" title="<?php echo esc_attr__('List', 'vg-primave'); ?>"><i class="fa fa-th-list"></i> <strong><?php // echo esc_html__('List', 'vg-primave'); ?></strong></a>
								</div>
								<?php
									
									/**
									 * woocommerce_before_shop_loop hook
									 *
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action('woocommerce_before_shop_loop');
								?>
								<div class="clearfix"></div>
							</div>
							<?php endif; ?>
							
							<?php woocommerce_product_loop_start(); ?>
								<?php while (have_posts()) : the_post(); ?>

									<?php wc_get_template_part('content', 'product'); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>
							
							<?php if((is_shop() && 'subcategories' !== get_option('woocommerce_shop_page_display')) || (is_product_category() && 'subcategories' !== get_option('woocommerce_category_archive_display')) || (empty($product_subcategories) && 'subcategories' == get_option('woocommerce_category_archive_display'))): ?>
							<div class="toolbar tb-bottom">
								<div class="view-mode">
									<a href="#" class="grid active" title="<?php echo esc_attr__('Grid', 'vg-primave'); ?>"><i class="fa fa-th-large"></i> <strong><?php //echo esc_html__('Grid', 'vg-primave'); ?></strong></a>
									<a href="#" class="list" title="<?php echo esc_attr__('List', 'vg-primave'); ?>"><i class="fa fa-th-list"></i> <strong><?php // echo esc_html__('List', 'vg-primave'); ?></strong></a>
								</div>
								<?php
									
									/**
									 * woocommerce_before_shop_loop hook
									 *
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action('woocommerce_before_shop_loop');
								?>
								<div class="clearfix"></div>
							</div>
							<?php endif; ?>
							
						<?php elseif (! woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

							<?php wc_get_template('loop/no-products-found.php'); ?>

						<?php endif; ?>

					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action('woocommerce_after_main_content');
					?>
					</div>
				</div>
				
				<?php if($primave_options['sidebar_product']=='left' || !isset($primave_options['sidebar_product'])) :?>
					<?php get_sidebar('product'); ?>
				<?php endif; ?>
				
				<?php if($primave_options['sidebar_product']=='right') :?>
					<?php get_sidebar('product'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<script>
	(function($) {
		"use strict";
		jQuery(document).ready(function(){
			jQuery('.view-mode').each(function(){
			<?php if($primave_options['layout_product']=='gridview') { ?>
				/* Grid View */					
				jQuery('#archive-product .view-mode').find('.grid').addClass('active');
				jQuery('#archive-product .view-mode').find('.list').removeClass('active');
				
				jQuery('#archive-product .shop-products').removeClass('list-view');
				jQuery('#archive-product .shop-products').addClass('grid-view');
				
				jQuery('#archive-product .list-col4').removeClass('col-sm-6 col-lg-4 col-xs-12');
				jQuery('#archive-product .list-col8').removeClass('col-sm-6 col-lg-8 col-xs-12');
			<?php } ?>
			<?php if($primave_options['layout_product']=='listview') { ?>
				/* List View */								
				jQuery('#archive-product .view-mode').find('.list').addClass('active');
				jQuery('#archive-product .view-mode').find('.grid').removeClass('active');
				
				jQuery('#archive-product .shop-products').addClass('list-view');
				jQuery('#archive-product .shop-products').removeClass('grid-view');
				
				jQuery('#archive-product .list-col4').addClass('col-sm-6 col-lg-4 col-xs-12');
				jQuery('#archive-product .list-col8').addClass('col-sm-6 col-lg-8 col-xs-12');
			<?php } ?>
			});
		});
	})(jQuery);
</script>
<?php primave_get_footer(); ?>