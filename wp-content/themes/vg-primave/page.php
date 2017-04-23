<?php
/**
 * @version    1.9
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
<div class="main-container default-page">
	<div class="row-breadcrumd">
		<div class="container">
			<?php primave_breadcrumb(); ?>
		</div>
	</div>
	<div class="container">
		<?php $primave_options['sidebarse_pos'] = isset($primave_options['sidebarse_pos']) ? $primave_options['sidebarse_pos'] : ""; ?>
		<div class="row">
			<?php if($primave_options['sidebarse_pos']=='left'  || !isset($primave_options['sidebarse_pos'])) :?>
				<?php get_sidebar('page'); ?>
			<?php endif; ?>
			<div class="col-xs-12 <?php if (is_active_sidebar('sidebar-page')) : ?>col-md-9<?php endif; ?>">
				<div class="page-content default-page">
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('content', 'page'); ?>
						<?php comments_template('', true); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php if($primave_options['sidebarse_pos']=='right') :?>
				<?php get_sidebar('page'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php primave_get_footer(); ?>