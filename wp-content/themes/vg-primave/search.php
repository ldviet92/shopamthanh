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
<div class="main-container page-wrapper">
	<div class="blog_header"><?php esc_html_e('Blog', 'vg-primave'); ?></div>
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
							<h1 class="archive-title"><?php printf(esc_html_e('Search Results for: %s', 'vg-primave'), '<span>' . get_search_query() . '</span>'); ?></h1>
						</header><!-- .archive-header -->

						<?php /* Start the Loop */ ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part('content', get_post_format()); ?>
						<?php endwhile; ?>

						<div class="pagination">
							<?php primave_pagination(); ?>
						</div>

					<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e('Nothing Found', 'vg-primave'); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'vg-primave'); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

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