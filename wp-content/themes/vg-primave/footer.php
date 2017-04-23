<?php
/**
 * @version    1.9
 * @package    VG primave
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
?>

<?php 
	// HieuJa get Preset Color Option
	$presetopt = primave_get_preset();
	// HieuJa end block
?>

<?php $primave_options  = primave_get_global_variables();  ?>
		<div class="clear clearfix"></div>
		<?php if(isset($primave_options['enable_brands'])) : ?>
			<?php if($primave_options['enable_brands'] && do_shortcode("[ourbrands]")) : ?>
				<div class="vg-brand-slider-wrapper">
					<div class="container">
						<div class="row">
							<div class="our-brands">
								<div class="wpb_wrapper">
									<?php echo do_shortcode("[ourbrands]"); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<!--  Top Bottom -->
		<div class="top-bottom-wrapper">
			<div class="container">
				<div class="row">
					<?php if(isset($primave_options['social_show'])) : ?>
						<?php if($primave_options['social_show']) : ?>
						<div class="col-xs-12 col-lg-6">
							<div class="vg-social">
							<!-- Social -->
							<?php
								echo '<ul class="social-icons">';
								foreach($primave_options['ftsocial_icons'] as $key=>$value) {
									if($value!=''){
										if($key=='vimeo'){
											echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
										} else {
											echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
										}
									}
								}
								echo '</ul>';
								?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					
					<div class="col-xs-12 col-lg-<?php echo (isset($primave_options['social_show']) && $primave_options['social_show']) ? '6 text-right' : '12 text-center' ; ?> menu-top-bottom">
						<?php echo wp_nav_menu(array("theme_location" => "menu-top-bottom","")); ?>
					</div>
					
				</div>
			</div>
		</div>
		<!--  Top Bottom -->
		
		<!-- Bottom -->
		<?php if (isset($primave_options['logo_bottom_show'])) : ?>
			<?php if (is_active_sidebar('middle-bottom') || $primave_options['logo_bottom_show'] ) : ?>
			<div class="bottom-wrapper">
				<div class="container">
					<div class="row middle-bottom">
						<?php if ($primave_options['logo_bottom_show']) : ?>
						<div class="col-lg-<?php echo (is_active_sidebar('middle-bottom')) ? '3' : '12' ; ?> col-sm-<?php echo (is_active_sidebar('middle-bottom')) ? '6' : '12' ; ?> col-xs-12 col-footer">
							<div class="logo-bottom widget">
								<?php if(!empty($primave_options['logo_bottom']['url'])) { ?>
									<div class="img-logo"><a href="<?php echo ($primave_options['link_logo_bottom']) ? esc_url($primave_options['link_logo_bottom']) : esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo esc_url($primave_options['logo_bottom']['url']); ?>" alt="" /></a></div>
								<?php } else { ?>
									<div class="img-logo">
										<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
											<img src="<?php echo esc_url(get_template_directory_uri() . '/images/presets/preset'. $presetopt .'/logo-footer.jpg' ); ?>" alt="" />
										</a>
									</div>
								<?php } ?>
								
								<?php if(!empty($primave_options['logo_des'])) : ?>
								<div class="bottom-static-content">
									<?php echo '<p>'.$primave_options['logo_des'].'...</p>'; ?>
								</div>
								<?php endif; ?>
								
								<a href="<?php echo esc_url($primave_options['link_logo_bottom']); ?>" class="readmore"><?php echo esc_html__('Read more', 'vg-primave'); ?></a>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if (is_active_sidebar('middle-bottom')) : ?>
							<?php
								dynamic_sidebar( 'middle-bottom' );
							?>
						<?php endif;?>
			
						
					</div>
					<div class="row menu-bottom">
						<?php if (is_active_sidebar('menu-bottom')) : ?>
							<?php
								dynamic_sidebar( 'menu-bottom' );
							?>
						<?php endif;?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(isset($primave_options['copyright_show'])) { ?>
			<?php if($primave_options['copyright_show']) { ?>
			<div class="footer-wrapper">
				<div class="container">
					<div class="row">
						<div class="copyright">
							<?php echo primave_copyright(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
	</div><!-- .wrapper -->
	<div class="to-top"><i class="fa fa-chevron-up"></i></div>
	<?php wp_footer(); ?>
</body>
</html>