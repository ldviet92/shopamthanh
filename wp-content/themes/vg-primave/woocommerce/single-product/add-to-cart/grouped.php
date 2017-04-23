<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly
global $product, $post;

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
	<div class="group_table">
		<?php
			$quantites_required = false;

			foreach ($grouped_products as $grouped_product) :
				$post_object        = get_post( $grouped_product->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product->is_purchasable() && ! $grouped_product->has_options() );

				setup_postdata( $GLOBALS['post'] =& $post_object );
				?>
					<div class="group-row">
						<div class="quantity-row">
							<?php if ( ! $grouped_product->is_purchasable() || $grouped_product->has_options() ) : ?>
								<?php woocommerce_template_loop_add_to_cart(); ?>

							<?php elseif ( $grouped_product->is_sold_individually() ) : ?>
								<input type="checkbox" name="<?php echo esc_attr( 'quantity[' . $grouped_product->get_id() . ']' ); ?>" value="1" class="wc-grouped-product-add-to-cart-checkbox" />

							<?php else : ?>
								<?php
									/**
									 * @since 3.0.0.
									 */
									do_action( 'woocommerce_before_add_to_cart_quantity' );

									woocommerce_quantity_input( array(
										'input_name'  => 'quantity[' . $grouped_product->get_id() . ']',
										'input_value' => isset( $_POST['quantity'][ $grouped_product->get_id() ] ) ? wc_stock_amount( $_POST['quantity'][ $grouped_product->get_id() ] ) : 0,
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product->get_max_purchase_quantity(), $grouped_product ),
									) );

									/**
									 * @since 3.0.0.
									 */
									do_action( 'woocommerce_after_add_to_cart_quantity' );
								?>
							<?php endif; ?>
						</div>

						<div class="label">
							<label for="product-<?php echo $grouped_product->get_id(); ?>">
								<?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $grouped_product->get_id() ) ) . '">' . get_the_title() . '</a>' : get_the_title(); ?>
							</label>
						</div>

						<?php do_action ('woocommerce_grouped_product_list_before_price', $product); ?>

						<div class="price">
							<?php
								echo $grouped_product->get_price_html();
								echo wc_get_stock_html( $grouped_product );
							?>
						</div>
					</div>
				<?php
			endforeach;

			wp_reset_postdata();
		?>
	</div>
<?php if($product) {?>
	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />

	<?php if ($quantites_required) : ?>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<div class="addtocart-button"><button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button></div>


		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	<?php endif; ?>
<?php } else { ?>
	<?php 
		$productid = intval($_POST['data']);
		$product = get_product($productid);
	?>
	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />

	<?php if ($quantites_required) : ?>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="addtocart-button"><button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button></div>
		

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	<?php endif; ?>
<?php }?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>