<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/projects/archive-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

$projects_loop  = primave_get_global_variables('projects_loop');
$post  = primave_get_global_variables('post');
$primave_projectrows  = primave_get_global_variables('primave_projectrows');
$primave_options  = primave_get_global_variables();

get_header(); ?>
<div class="main-container page-portfolio full-width">
	<div class="container">
		<div class="page-content">	
			<header class="archive-header">
				<h1 class="archive-title"><?php printf(esc_html__('Portfolio %s', 'vg-primave'), '<span>' . single_cat_title('', false) . '</span>'); ?></h1>

			<?php if (category_description()) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->
			<?php
				/**
				 * projects_before_main_content hook
				 *
				 * @hooked projects_output_content_wrapper - 10 (outputs opening divs for the content)
				 */
				do_action('projects_before_main_content');
			?>

			<?php do_action('projects_archive_description'); ?>

			<?php if (have_posts()) : ?>

				<?php
					/**
					 * projects_before_loop hook
					 *
					 */
					do_action('projects_before_loop');
				?>
				<div class="filter-options btn-group">
					<button data-group="all" class="btn active btn--warning"><?php esc_html_e('All', 'vg-primave');?></button>
					<?php 
					$datagroups = array();
					if(isset($primave_options['portfolio_per_page'])) {
						query_posts('posts_per_page='.$primave_options['portfolio_per_page'].'&post_type=project');
					}
					while (have_posts()) : the_post();
					
						$prcates = get_the_terms($post->ID, 'project-category');
						
						foreach ($prcates as $category) {
							$datagroups[$category->slug] = $category->name;
						}
						?>
					<?php endwhile; // end of the loop. ?>
					<?php
					foreach($datagroups as $key=>$value) { ?>
						<button data-group="<?php echo esc_attr($key);?>" class="btn btn--warning"><?php echo esc_html($value);?></button>
					<?php }
					?>
				</div>
				<div class="list_projects entry-content">

				<?php projects_project_loop_start(); ?>
					<?php $primave_projectrows = 1; ?>
					<?php while (have_posts()) : the_post(); ?>

						<?php projects_get_template_part('content', 'project'); ?>

					<?php endwhile; // end of the loop. ?>

				<?php projects_project_loop_end(); ?>

				</div><!-- .projects -->

				<?php
					/**
					 * projects_after_loop hook
					 *
					 * @hooked projects_pagination - 10
					 */
					do_action('projects_after_loop');
				?>

			<?php else : ?>

				<?php projects_get_template('loop/no-projects-found.php'); ?>

			<?php endif; ?>

			<?php
				/**
				 * projects_after_main_content hook
				 *
				 * @hooked projects_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action('projects_after_main_content');
			?>

			<?php
				/**
				 * projects_sidebar hook
				 *
				 * @hooked projects_get_sidebar - 10
				 */
				//do_action('projects_sidebar');
			?>
		</div>
	</div>
</div>
<?php get_footer('projects'); ?>