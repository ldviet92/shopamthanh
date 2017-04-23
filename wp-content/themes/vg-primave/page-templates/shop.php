<?php
/**
 * Template Name: Shop Template
 *
 * Description: Shop Template
 *
* @package    VG Primave
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
if (! defined('ABSPATH')) exit; // Exit if accessed directly

get_header('shop'); ?>
<?php
$primave_options  = primave_get_global_variables();
$primave_productrows 		= primave_get_global_variables('primave_productrows');

$primave_productrows = 1;
?>
<div class="main-container page-shop">
	<div class="page-content">
		<div class="container">
			<?php if($primave_options['opening_img'] != '') { ?>
				<div class="primave-banner banner-category"><a href="<?php echo esc_html($primave_options['cat_banner_link']); ?>"><img src="<?php echo esc_url($primave_options['cat_banner_img']['url']); ?>" alt=""></a></div>
			<?php } ?>
			<div class="row">
			
				<?php if($primave_options['sidebar_pos']=='left' || !isset($primave_options['sidebar_pos'])) :?>
					<?php get_sidebar('category'); ?>
				<?php endif; ?>
				<div class="col-xs-12 <?php if (is_active_sidebar('sidebar-category')) : ?>col-md-9<?php endif; ?>">
					<?php primave_breadcrumb(); ?>
					<div class="default-shop">
						<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part('content', 'page'); ?>
						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
				<?php if($primave_options['sidebar_pos']=='right') :?>
					<?php get_sidebar('category'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer('shop'); ?>