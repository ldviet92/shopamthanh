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
<?php 
$bloglayout = 'blog-sidebar';
if(isset($primave_options['layout']) && $primave_options['layout']!=''){
	$bloglayout = $primave_options['layout'];
}
$blogsidebar = 'right';

if(isset($_GET['layout']) && $_GET['layout']!=''){
	$bloglayout = $_GET['layout'];
	
	switch($bloglayout) {
		case 'nosidebar':
			$blogclass = 'blog-nosidebar';
			$blogcolclass = 12;
			$blogsidebar = 'none';
			break;
		case 'fullwidth':
			$blogclass = 'blog-fullwidth';
			$blogcolclass = 12;
			$blogsidebar = 'none';
			break;
		case 'left':
			$blogclass = 'blog-sidebar';
			$blogcolclass = 9;
			$blogsidebar = 'left';
			break;
		default:
			$blogclass = 'blog-sidebar';
			$blogcolclass = 9;
	}
}
else {
	if(isset($primave_options['sidebarblog_pos']) && $primave_options['sidebarblog_pos']!=''){
		$blogsidebar = $primave_options['sidebarblog_pos'];
	}	
	switch($blogsidebar) {
		case 'nosidebar':
			$blogclass = 'blog-nosidebar';
			$blogcolclass = 12;
			$blogsidebar = 'none';
			break;
		case 'fullwidth':
			$blogclass = 'blog-fullwidth';
			$blogcolclass = 12;
			$blogsidebar = 'none';
			break;
		case 'left':
			$blogclass = 'blog-sidebar';
			$blogcolclass = 9;
			$blogsidebar = 'left';
			break;
		default:
			$blogclass = 'blog-sidebar';
			$blogcolclass = 9;
	}
}
?>
<div class="main-container default-page page-category">
	<div class="row-breadcrumd">
		<div class="container">
			<?php primave_breadcrumb(); ?>
		</div>
	</div>
	<div class="container">
		
		
		<div class="row">
			
			<div class="<?php echo ($blogsidebar=='left')? 'pull-right' : ''; ?> col-xs-12 <?php echo 'col-md-'. esc_attr($blogcolclass); ?>">
				<div class="page-content blog-page <?php echo esc_attr($blogclass); if($blogsidebar=='left') {echo ' left-sidebar'; } if($blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<?php if (have_posts()) : ?>
						<header class="archive-header">
							<?php
								the_archive_title('<h1 class="page-title">', '</h1>');
								the_archive_description('<div class="taxonomy-description">', '</div>');
							?>
						</header><!-- .archive-header -->

						<?php
						/* Start the Loop */
						while (have_posts()) : the_post();

							/* Include the post format-specific template for the content. If you want to
							 * this in a child theme then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part('content', get_post_format());

						endwhile;
						?>
						
						<div class="pagination">
							<?php primave_pagination(); ?>
						</div>
						
					<?php else : ?>
						<?php get_template_part('content', 'none'); ?>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if($blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<?php if($blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
		</div>
	</div>
</div>
<?php primave_get_footer(); ?>