<?php
/**
 * Template Name: Contact Template
 *
 * Description: Contact page template
 *
 * @package    VG Primave
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */

global $primave_options;

primave_get_header();
?>
<div class="main-container contact-page page-title">
	<div class="row-breadcrumd">
		<div class="container">
			<?php primave_breadcrumb(); ?>
		</div>
	</div>
	<div class="contact-fom-info">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-content">

						<?php while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content">
									<?php the_content(); ?>
									<?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'vg-primave'), 'after' => '</div>')); ?>
								</div><!-- .entry-content -->
							</article><!-- #post -->
						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer('contact'); ?>