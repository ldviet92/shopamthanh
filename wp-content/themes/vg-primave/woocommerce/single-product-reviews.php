<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
$product  = primave_get_global_variables('product');

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (! comments_open()) {
	return;
}

?>
<div id="reviews">
	<div id="comments">
		<h2><?php
			if (get_option('woocommerce_enable_review_rating') === 'yes' && ($count = $product->get_review_count()))
				printf(_n('%s review for %s', '%s reviews for %s', $count, 'vg-primave'), $count, get_the_title());
			else
				esc_html_e('Reviews', 'vg-primave');
		?></h2>

		<?php if (have_comments()) : ?>

			<ol class="commentlist">
				<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
			</ol>

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				)));
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html__('There are no reviews yet.', 'vg-primave'); ?></p>

		<?php endif; ?>
	</div>

	<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->id)) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? esc_html__('Add a review', 'vg-primave') : esc_html__('Be the first to review', 'vg-primave') . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => esc_html__('Leave a Reply to %s', 'vg-primave'),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__('Name', 'vg-primave') . ' <span class="required">*</span></label> ' .
							            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'vg-primave') . ' <span class="required">*</span></label> ' .
							            '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email']) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => esc_html__('Submit', 'vg-primave'),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if (get_option('woocommerce_enable_review_rating') === 'yes') {
						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__('Your Rating', 'vg-primave') .'</label><select name="rating" id="rating">
							<option value="">' . esc_html__('Rate&hellip;', 'vg-primave') . '</option>
							<option value="5">' . esc_html__('Perfect', 'vg-primave') . '</option>
							<option value="4">' . esc_html__('Good', 'vg-primave') . '</option>
							<option value="3">' . esc_html__('Average', 'vg-primave') . '</option>
							<option value="2">' . esc_html__('Not that bad', 'vg-primave') . '</option>
							<option value="1">' . esc_html__('Very Poor', 'vg-primave') . '</option>
						</select></p>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your Review', 'vg-primave') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

					comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html__('Only logged in customers who have purchased this product may leave a review.', 'vg-primave'); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
