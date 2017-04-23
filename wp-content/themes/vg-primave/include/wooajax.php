<?php
//WooCommerce Ajax

add_action('wp_head','primave_woo_ajaxurl');
function primave_woo_ajaxurl() {
?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
<?php
	// Enqueue variation scripts
	wp_enqueue_script('wc-add-to-cart-variation');
}
add_action('wp_ajax_primave_product_quickview', 'primave_product_quickview');
add_action('wp_ajax_nopriv_primave_product_quickview', 'primave_product_quickview');

function primave_product_quickview() {
	global $product, $post, $woocommerce_loop, $primave_options;
		
	if($_POST['data']){
		$productid = intval($_POST['data']);
		$product = get_product($productid);
		$post = get_post($productid);
	}
	?>
	<div class="woocommerce product main-container">
		<div class="product-view">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="single-product-image product-images">
						<?php $image_link = wp_get_attachment_url($product->get_image_id());?>
						<div class="main-image images"><img src="<?php echo esc_attr($image_link); ?>" alt="" /></div>
						<?php
						$attachment_ids = $product->get_gallery_attachment_ids();

						if ($attachment_ids) {
							?>
							<div class="thumbnails_wrapper">
								<div class="quick-thumbnails">
									<?php $image_link = wp_get_attachment_url($product->get_image_id());?>
									<div><a href="<?php echo esc_url($image_link);?>"><?php echo $product->get_image('shop_thumbnail');?></a></div>
									<?php

									$loop = 0;
									$columns = apply_filters('woocommerce_product_thumbnails_columns', 3);

									foreach ($attachment_ids as $attachment_id) {
										?>
										<div>
										<?php
										$classes = array('zoom');

										if ($loop == 0 || $loop % $columns == 0)
											$classes[] = 'first';

										if (($loop + 1) % $columns == 0)
											$classes[] = 'last';

										$image_link = wp_get_attachment_url($attachment_id);

										if (! $image_link)
											continue;

										$image       = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
										$image_class = esc_attr(implode(' ', $classes));
										$image_title = esc_attr(get_the_title($attachment_id));

										echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image), $attachment_id, $product->ID, $image_class);

										$loop++;
										?>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<?php
						} ?>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="summary entry-summary single-product-info">
						<?php do_action('woocommerce_single_product_summary'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	die();
}

add_action('wp_ajax_primave_get_cartinfo', 'primave_get_cartinfo');
add_action('wp_ajax_nopriv_primave_get_cartinfo', 'primave_get_cartinfo');

function primave_get_cartinfo() {
	global $woocommerce;
	
	echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'vg-primave'), $woocommerce->cart->cart_contents_count);
	echo '|'.$woocommerce->cart->get_cart_total();echo '|'.$woocommerce->cart->get_total(); ?>

	<?php
	die();
}

add_action('wp_ajax_primave_get_productinfo', 'primave_get_productinfo');
add_action('wp_ajax_nopriv_primave_get_productinfo', 'primave_get_productinfo');

function primave_get_productinfo() {
	global $product, $woocommerce_loop, $primave_options;
	
	$productid = intval($_POST['data']['pid']);
	$product = get_product($productid);
	$quantity = intval($_POST['data']['quantity']);
	?>
	<h3><?php esc_html_e('Product is added to cart', 'vg-primave');?></h3>
	<div class="product-wrapper">
		<div class="product-image">
			<?php echo $product->get_image('shop_thumbnail');?>
		</div>
		<div class="product-info">
			<h4><?php echo esc_html($product->get_title());?></h4>
			<p class="price"><?php echo $product->get_price_html(); ?></p>
		</div>
	</div>
	<div class="buttons">
		<a class="button" href="<?php echo get_permalink(wc_get_page_id('cart'));?>"><?php esc_html_e('View Cart', 'vg-primave');?></a>
	</div>
	<?php
	die();
}