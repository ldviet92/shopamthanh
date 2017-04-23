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
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>

<?php 
	$primave_options  = primave_get_global_variables(); 
	$woocommerce 		= primave_get_global_variables('woocommerce'); 
?>

<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if (isset($primave_options['share_head_code']) && $primave_options['share_head_code']!='') {
	echo wp_kses($primave_options['share_head_code'], array(
		'script' => array(
			'type' 	=> array(),
			'src' 	=> array(),
			'async' => array()
		),
	));
} ?>

<?php 
	// HieuJa get Preset Color Option
	$presetopt = primave_get_preset();
	// HieuJa end block
?>

<?php wp_head(); ?>
</head>

<!-- Body Start Block -->
<body <?php body_class(); ?>>

<!-- Page Loader Block -->
<?php if (isset($primave_options['primave_loading'])) : ?>
	<?php if ($primave_options['primave_loading']) : ?>
	<div id="pageloader">
		<div id="loader"></div>
		<div class="loader-section left"></div>
		<div class="loader-section right"></div>
	</div>
	<?php endif; ?>
<?php endif; ?>

<div id="yith-wcwl-popup-message"><div id="yith-wcwl-message"></div></div>
<?php $primave_options['page_style'] = isset($primave_options['page_style']) ? $primave_options['page_style'] : ""; ?> 
<div class="wrapper <?php if($primave_options['page_style']=='box'){echo 'box-layout';}?>">
	<!-- Top Header -->
	<div class="top-wrapper <?php echo (isset($primave_options['sticky_header']) && $primave_options['sticky_header']) ? 'top-wrapper-fixed' : ''; ?>">
		<div class="header-container">
			<?php if (is_active_sidebar('sidebar-top-header')) : ?>
			<div class="top-bar">
				<div class="container">
					<div id="top">
						<div class="row">
							
								<?php dynamic_sidebar('sidebar-top-header'); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="header">
				<div class="container">
					<div class="row">
						<div id="sp-logo" class="col-xs-12 col-md-3">
						<?php if(isset($primave_options['logo_main']) && !empty($primave_options['logo_main']['url'])){ ?>
							<div class="logo">
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
									<img src="<?php echo esc_url($primave_options['logo_main']['url']); ?>" alt="" />
								</a>
							</div>
						<?php } else { ?>
							<div class="logo">
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
									<img src="<?php echo esc_url(get_template_directory_uri() . '/images/presets/preset'. $presetopt .'/logo.png' ); ?>" alt="" />
								</a>
							</div>
						<?php } ?>
						</div>
						<div class="col-xs-9 col-md-6 header-center">
							<?php if (class_exists('Custom_Ajax_search_widget')) { ?>
							<div class="vg-search">
								 <div class="search-container">
								   <?php ajax_autosuggest_form(); ?>
								</div> 
							</div>	
							<?php } ?>
						</div>	
						<div class="col-xs-3 header-right">
							<?php if (class_exists('WC_Widget_Cart')) { ?>
							<div class="vg-cart">
								<?php $primave_options['mini_cart_title'] = isset($primave_options['mini_cart_title']) ? esc_html($primave_options['mini_cart_title']) : esc_html__('Shopping Cart', 'vg-primave'); ?>
								<?php the_widget('Custom_WC_Widget_Cart', array('title' => $primave_options['mini_cart_title'])); ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-menu-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-3"></div>
					<div class="col-xs-12 col-md-9">
						<div id="header-menu" class="header-menu visible-large">
							<?php echo wp_nav_menu(array("theme_location" => "primary","")); ?>
						</div>
						<div class="visible-small">
							<div class="mbmenu-toggler"><span><?php echo (isset($primave_options['title_mobile_menu'])) ? esc_html($primave_options['title_mobile_menu']) : esc_html__('Menu', 'vg-primave'); ?></span><span class="mbmenu-icon"></span></div>
							<div class="nav-container">
								<?php wp_nav_menu(array('theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu')); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div><!-- / navigation-->
							
	</div>
	