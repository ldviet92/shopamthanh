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
<div class="main-container default-page page-category page-wrapper ">
	<div class="row-breadcrumd">
		<div class="container">
			<?php primave_breadcrumb(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">

			
			<div class="<?php echo ($blogsidebar=='left')? 'pull-right' : ''; ?> col-xs-12 col-md-<?php echo (is_active_sidebar( 'sidebar-1' )) ? esc_attr($blogcolclass) : '12' ; ?>">
				<div class="page-content blog-page single <?php echo esc_attr($blogclass); if($blogsidebar=='left') {echo ' left-sidebar'; } if($blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('content', get_post_format()); ?>

						<?php comments_template('', true); ?>
						
						<nav class="nav-single">
							<span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'vg-primave') . '</span> %title'); ?></span>
							<span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'vg-primave') . '</span>'); ?></span>
						</nav>
						
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			
			<?php if($blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			
			<?php if($blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
		</div>
	</div>
</div>

<?php primave_get_footer(); ?>