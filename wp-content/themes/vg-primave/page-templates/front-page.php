<?php
/**
 * Template Name: Home Shop Template
 *
 * Description: Home Shop template
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
<div class="main-container front-page">
	<div class="page-content">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php primave_get_footer(); ?>