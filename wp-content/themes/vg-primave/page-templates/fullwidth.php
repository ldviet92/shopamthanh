<?php
/**
 * Template Name: Full Width
 *
* Description: Full Width template
 *
 * @package    primave
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 */
$primave_options  = primave_get_global_variables();

primave_get_header();
?>
<div class="main-container full-width">

	<div class="page-content">

		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('content', 'page'); ?>
		<?php endwhile; // end of the loop. ?>

	</div>
</div>
<?php primave_get_footer(); ?>