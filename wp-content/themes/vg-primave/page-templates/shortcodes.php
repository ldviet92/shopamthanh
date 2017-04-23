<?php
/**
 * Template Name: Shortcodes
 *
 * Description: About Us page template
 *
 * @package    VG Primave
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
$primave_options  = primave_get_global_variables();

primave_get_header();
?>
<div class="main-container default-page page-title">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php primave_breadcrumb(); ?>
			</div>
			<div class="col-xs-12 <?php if (is_active_sidebar('sidebar-page')) : ?>col-md-9<?php endif; ?>">
				<div class="page-content default-page page-shortcodes">
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('content', 'page'); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php primave_get_footer(); ?>