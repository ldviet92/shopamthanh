<?php
/**
 * @version    1.9
 * @package    VG primave
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
?>
<?php $primave_options  = primave_get_global_variables();  ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content-full">
		<?php if (! post_password_required() && ! is_attachment()) : ?>
		<div class="post-thumbnail">
			<?php echo do_shortcode(get_post_meta($post->ID, '_primave_meta_value_key', true)); ?>
		</div>
		<?php endif; ?>
		
		<div class="postinfo-wrapper">
			
			<div class="grid-postinfo-wrapper">
				<?php if (is_single()) : ?>
					<div class="post-date">
						<?php echo '<span class="day">'.get_the_date('d', $post->ID).'</span><span class="month">'.get_the_date('M', $post->ID).' '.get_the_date('Y', $post->ID).'</span>' ;?>
					</div>
				<?php endif; ?>
				<?php if (is_single()) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php else : ?>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php endif; ?>
			
				<?php if (is_single()) : ?>
					<div class="entry-meta">
						<?php primave_entry_meta(); ?>
					</div>
				<?php endif; ?>
					
				<?php if (!is_single()) : ?>
					<div class="entry-meta-small">
						<?php if (is_sticky() && is_home() && ! is_paged()) : ?>
							<?php primave_entry_meta(); ?>
						<?php else : ?>
							<?php primave_entry_meta_small(); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<div class="post-info">
					
					<?php if (is_single()) : ?>
						<div class="entry-content">
							<?php the_content(wp_kses(__('Continue reading <span class="meta-nav">&rarr;</span>', 'vg-primave'), array('span' => array()))); ?>
							<?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'vg-primave'), 'after' => '</div>', 'pagelink' => '<span>%</span>')); ?>
						</div>
					<?php else : ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<div class="clear"></div>
							<a class="readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'vg-primave');  ?></a>
						</div>
					<?php endif; ?>
					
					
					<?php if (is_single()) : ?>
						<?php if(function_exists('vinagecko_blog_sharing')) { ?>
							<div class="social-sharing"><?php vinagecko_blog_sharing(); ?></div>
						<?php } ?>
					<?php endif; ?>
				</div>
			</div>
			<?php if (isset($primave_options['show_author'])) : ?>
				<?php if (is_single() && $primave_options['show_author'] && (get_the_author_meta('description') != null )) : ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php
							$author_bio_avatar_size = apply_filters('primave_author_bio_avatar_size', 68);
							echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
							?>
						</div>
						<div class="author-description">
							<h2><?php esc_html_e('About the Author:', 'vg-primave');?>
							<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"><?php printf('%s',get_the_author()); ?></a>
							</h2>
							<p><?php the_author_meta('description'); ?></p>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</article>