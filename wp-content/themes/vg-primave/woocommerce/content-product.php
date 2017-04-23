<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
 
$primave_options  = primave_get_global_variables(); 

$webLayout = primave_get_layout();

switch($webLayout)
{
	case "layout-1":
		get_template_part('woocommerce/content-product-layout','1');
	break;
	case "layout-2":
		get_template_part('woocommerce/content-product-layout','2');
	break;
	case "layout-3":
		get_template_part('woocommerce/content-product-layout','3');
	break;
	case "layout-4":
		get_template_part('woocommerce/content-product-layout','4');
	break;	
	case "layout-5":
		get_template_part('woocommerce/content-product-layout','5');
	break;	
	case "layout-6":
		get_template_part('woocommerce/content-product-layout','6');
	break;
	case "layout-7":
		get_template_part('woocommerce/content-product-layout','7');
	break;
	default:
		get_template_part('woocommerce/content-product-layout','1');
	break;
}