<?php
/**
 * Lost password form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<form method="post" class="lost_reset_password">

	<?php if('lost_password' == $args['form']) : ?>

		<p><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'vg-primave')); ?></p>

		<p class="form-row form-row-first"><label for="user_login"><?php esc_html__('Username or email', 'vg-primave'); ?></label> <input class="input-text" type="text" name="user_login" id="user_login" /></p>

	<?php else : ?>

		<p><?php echo apply_filters('woocommerce_reset_password_message', esc_html__('Enter a new password below.', 'vg-primave')); ?></p>

		<p class="form-row form-row-first">
			<label for="password_1"><?php esc_html__('New password', 'vg-primave'); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_1" id="password_1" />
		</p>
		<p class="form-row form-row-last">
			<label for="password_2"><?php esc_html__('Re-enter new password', 'vg-primave'); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_2" id="password_2" />
		</p>

		<input type="hidden" name="reset_key" value="<?php echo isset($args['key']) ? esc_attr($args['key']) : ''; ?>" />
		<input type="hidden" name="reset_login" value="<?php echo isset($args['login']) ? esc_attr($args['login']) : ''; ?>" />

	<?php endif; ?>

	<div class="clear"></div>

	<p class="form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? esc_html__('Reset Password', 'vg-primave') : esc_html__('Save', 'vg-primave'); ?>" />
	</p>

	<?php wp_nonce_field($args['form']); ?>

</form>
