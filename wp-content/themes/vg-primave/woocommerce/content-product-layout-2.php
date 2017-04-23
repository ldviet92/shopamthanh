<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

global $woocommerce_loop;
$primave_options  = primave_get_global_variables(); 
$product  = primave_get_global_variables('product'); 
$primave_productsfound 		= primave_get_global_variables('primave_productsfound');
$primave_productrows 		= primave_get_global_variables('primave_productrows');

// Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if (empty($woocommerce_loop['columns']))
	$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 3);

// Ensure visibility
if (! $product || ! $product->is_visible())
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();

$count   = $product->get_rating_count();

if ($woocommerce_loop['columns']==3 || $woocommerce_loop['columns']==4 || $woocommerce_loop['columns']==6) {
	$colwidth = 12/$woocommerce_loop['columns'];
} elseif ($woocommerce_loop['columns']==5){
	$colwidth = 13;
}else{
	$colwidth = 4;
}
//$classes[] = 'item-col col-xs-6 col-lg-4'; 
$classes[] = 'item-col col-xs-6 col-lg-'.$colwidth ;
?>
<?php if ((0 == ($woocommerce_loop['loop'] - 1) % 2) && ($woocommerce_loop['columns'] == 2)) {
	if($primave_productrows!=1){
		echo '<div class="group">';
	}
} ?>
<div <?php post_class($classes); ?>>
	<div class="vgwc-item">
		<div class="ma-box-content">
			<?php do_action('woocommerce_before_shop_loop_item'); ?>
			<div class="list-col8">
				<div class="gridview">
					<div class="vgwc-text-block">
						<h3 class="vgwc-product-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="vgwc-product-price">
							<?php echo $product->get_price_html(); ?>
						</div>
						<?php if (get_option('woocommerce_enable_review_rating') === 'yes') : ?>
						<div class="vgwc-product-rating"><?php echo wc_get_rating_html( $product->get_average_rating()); ?> <?php echo $product->get_review_count(). esc_html__(" review(s)", "vg-primave"); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="listview">
					<div class="vgwc-text-block">
						<h3 class="vgwc-product-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<?php if (get_option('woocommerce_enable_review_rating') === 'yes') : ?>
						<div class="vgwc-product-rating">
							<?php 
								$rating = $product->get_review_count();
								if (!$rating) : 
								 echo '<div class="star-rating"></div>';
								else : 
							?>
								<?php echo wc_get_rating_html( $product->get_average_rating()); ?> 
								<div class="vgwc-product-reviews"> ( <?php echo $product->get_review_count(). esc_html__(" review(s)", "vg-primave"); ?> ) </div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="vgwc-product-price"><?php echo $product->get_price_html(); ?></div>
						
						<div class="product-desc">
							<?php 
							 $trimexcerpt = get_the_excerpt();
							 $words_short_des = (isset($primave_options['words_short_des'])) ? $primave_options['words_short_des'] : "45";
							 $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = $words_short_des, $more = '...' ); 
							 echo $shortexcerpt;
							?>
						</div>
						
						<div class="vgwc-button-group">
							<div class="vgwc-add-to-cart">
								<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'" show_price="false"]') ?>
							</div>
							
							<div class="add-to-links">
								<?php if(isset($primave_options['quick_view']) && $primave_options['quick_view']){ ?>
									<div class="vgwc-quick">
										<a class="quickview quick-view" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php esc_html_e('Quick View', 'vg-primave');?></a>
									</div>
								<?php } ?>
								<?php if (class_exists('YITH_WCWL')) {
									echo '<div class="vgwc-wishlist">'.preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')). '</div>';
								} ?>
								<?php if(class_exists('YITH_Woocompare')) {
									echo '<div class="vgwc-compare">'. do_shortcode('[yith_compare_button]') . '</div>';
								} ?>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="list-col4">
				<div class="vgwc-image-block">
					
					<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
						<?php 
						echo $product->get_image('shop_catalog', array('class'=>'primary_image'));
						$image_second = '';
						if(isset($primave_options['second_image']) && $primave_options['second_image']){
							$attachment_ids = $product->get_gallery_image_ids();
							$image_second = '';
							if($attachment_ids[0] && ($attachment_ids[0] != get_post_thumbnail_id(get_the_ID()))) {
								$image_second = wp_get_attachment_image( $attachment_ids[0], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
							}
							elseif(isset($attachment_ids[1])){
								$image_second = wp_get_attachment_image( $attachment_ids[1], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
							}		
						}
						echo $image_second;
						?>
					</a>
					
					<?php if ($product->is_featured()) : ?>
						<?php echo apply_filters('woocommerce_featured_flash', '<div class="vgwc-label vgwc-featured">' . esc_html__('Hot', 'vg-primave') . '</div>', $post, $product); ?>
					<?php endif; ?>
					
					<?php if ($product->is_on_sale()) : ?>
						<?php echo apply_filters('woocommerce_sale_flash', '<div class="vgwc-label vgwc-onsale">' . esc_html__('Sale', 'vg-primave') . '</div>', $post, $product); ?>
					<?php endif; ?>
					<?php if(isset($primave_options['quick_view']) && $primave_options['quick_view']){ ?>
						<div class="vgwc-quick">
							<a class="quickview quick-view" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php esc_html_e('Quick View', 'vg-primave');?></a>
						</div>
					<?php } ?>
					<div class="vgwc-button-group">
						<div class="vgwc-add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'" show_price="false"] '); ?>
						</div>
						
						<div class="add-to-links">
							<?php if (class_exists('YITH_WCWL')) {
								echo '<div class="vgwc-wishlist">'.preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')). '</div>';
							} ?>
							<?php if(class_exists('YITH_Woocompare')) {
								echo '<div class="vgwc-compare">'. do_shortcode('[yith_compare_button]') . '</div>';
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php //do_action('woocommerce_after_shop_loop_item'); ?>
		</div>
	</div>
</div>