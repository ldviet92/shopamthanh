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
?><!DOCTYPE html>
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

<?php $primave_options  = primave_get_global_variables();  ?>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
	// HieuJa get Preset Color Option
	$presetopt = primave_get_preset();
	// HieuJa end block
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<div class="page-wrapper">
		<div class="container">
			<?php if(isset($primave_options['logo_main']) && $primave_options['logo_main']['url']!=''){ ?>
				<div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo esc_url($primave_options['logo_erorr']['url']); ?>" alt="" /></a></div>
			<?php } else { ?>
				<div class="logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/images/presets/preset'. $presetopt .'/logo.png' ); ?>" alt="" />
					</a>
				</div>
			<?php } ?>