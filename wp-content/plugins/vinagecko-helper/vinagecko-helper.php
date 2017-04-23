<?php
/**
 * Plugin Name: VinaGecko Helper
 * Plugin URI: http://vinagecko.com/
 * Description: The helper plugin for VinaGecko themes.
 * Version: 1.0.0
 * Author: VinaGecko
 * Author URI: http://vinagecko.com/
 * Text Domain: vinagecko
 * License: GPL/GNU.
 /*  Copyright 2014  VinaGecko  (email : support@vinagecko.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function vinagecko_shortcode_custom_css_class( $param_value, $prefix = '' ) {
	$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';

	return $css_class;
}

// Add shortcodes
function vinagecko_brands_shortcode( $atts ) {
	global $primave_options;
	$brand_index = 0;
	$brandfound=count($primave_options['brand_logos']);

	$atts = shortcode_atts( array(
		'title'				=> '',
		'rowsnumber' => 	'1',
		'add_show_icon'		=> '',
		'el_class' 			=> '',
		'type' 				=> '',
		'icon_fontawesome' 	=> '',
		'icon_openiconic' 	=> '',
		'icon_typicons' 	=> '',
		'icon_entypo' 		=> '',
		'icon_linecons' 	=> '',
	), $atts, 'ourbrands' );

	$el_class = $type = $icon = '';
	$css = isset( $atts['css'] ) ? $atts['css'] : '';  
	$el_class .= vinagecko_shortcode_custom_css_class( $css, ' ' );
	$el_class .= ' '.$atts['el_class'];
	if(!empty($atts['type'])) {
		$type = 'icon_'.$atts['type'];
	}
	else {
		$type = 'icon_fontawesome';
	}

	if(!empty($atts['add_show_icon']) && !empty($atts[$type])) {
		$icon = '<i class="'.$atts[$type].'"></i>';
		$el_class .= ' vg-icon';
	}
	
	$rowsnumber = $atts['rowsnumber'];

	$html = '';
	
	if($primave_options['brand_logos']) {
		
		$html  = '<div class="wpb_text_column wpb_brand_column wpb_content_element '.$el_class.'">';
			$html  .= '<div class="wpb_wrapper">';
				if(!empty($atts['title']) && isset($atts['title'])) {
					$html .= '<div class="vg-title">';
					$html .= '<h3>'.$icon.$atts['title'].'</h3>';
					$html .= '</div>';
				}
				$html .= '<div class="brands-carousel rows-'.$rowsnumber.'">';
					foreach($primave_options['brand_logos'] as $brand) {
						$brand_index ++;
						
						switch ($rowsnumber) {
							case "one":
								$html .= '<div class="group">';
								break;
							case "two":
								if ( (0 == ( $brand_index - 1 ) % 2 ) || $brand_index == 1) {
									$html .= '<div class="group">';
								}
								break;
							case "four":
								if ( (0 == ( $brand_index - 1 ) % 4 ) || $brand_index == 1) {
									$html .= '<div class="group">';
								}
								break;
						}
						
						$html .= '<div class="brands-inner">';
						$html .= '<a href="'.$brand['url'].'" title="'.$brand['title'].'">';
							$html .= '<img src="'.$brand['image'].'" alt="'.$brand['title'].'" />';
						$html .= '</a>';
						$html .= '</div>';
						
						switch ($rowsnumber) {
							case "one":
								$html .= '</div>';
								break;
							case "two":
								if ( ( ( 0 == $brand_index % 2 || $brandfound == $brand_index ))  ) { /* for odd case: $galio_productsfound == $woocommerce_loop['loop'] */
									$html .= '</div>';
								}
								break;
							case "four":
								if ( ( ( 0 == $brand_index % 4 || $brandfound == $brand_index ))  ) { /* for odd case: $galio_productsfound == $woocommerce_loop['loop'] */
									$html .= '</div>';
								}
								break;
						}

					}
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
	}
	
	return $html;
}
add_shortcode( 'ourbrands', 'vinagecko_brands_shortcode' );


//Swallow Code Custom elements Visual Composer

	function vinagecko_shortcode_woocarousel( $atts ) {
		$atts = shortcode_atts( array(
			'title'				=> '',
			'alias'				=> '',
			'css'				=> '',
			'add_show_icon'		=> '',
			'el_class' 			=> '',
			'type' 				=> '',
			'icon_fontawesome' 	=> '',
			'icon_openiconic' 	=> '',
			'icon_typicons' 	=> '',
			'icon_entypo' 		=> '',
			'icon_linecons' 	=> '',
		), $atts, 'listvgwccarousel' ); 
		extract( $atts );   
		$el_class = $type = $icon = '';
		$css = isset( $atts['css'] ) ? $atts['css'] : '';  
		$el_class .= vinagecko_shortcode_custom_css_class( $css, ' ' );

		$el_class .= ' '.$atts['el_class'];
		if(!empty($atts['type'])) {
			$type = 'icon_'.$atts['type'];
		}
		else {
			$type = 'icon_fontawesome';
		}

		if(!empty($atts['add_show_icon'])) {
			$icon = '<i class="'.$atts[$type].'"></i>';
			$el_class .= ' vg-icon';
		}
		
		$html  = '<div class="wpb_text_column wpb_vgwc_column wpb_content_element '.$el_class.'">';
			$html  .= '<div class="wpb_wrapper">';
				if(!empty($atts['title']) && isset($atts['title'])) {
					$html .= '<h3 class="vg-title-home">'.$icon.$atts['title'].'</h3>';
				}
				$html .= do_shortcode("[vgwc id=".$atts['alias']."]") ;
			$html .= '</div>';
		$html .= '</div>';
		return $html;
	}
	add_shortcode( 'listvgwccarousel', 'vinagecko_shortcode_woocarousel' );

function vinagecko_shortcode_postcarousel( $atts ) {
	$atts = shortcode_atts( array(
		'title'				=> '',
		'alias'				=> '',
		'css'				=> '',
		'add_show_icon'		=> '',
		'el_class' 			=> '',
		'type' 				=> '',
		'icon_fontawesome' 	=> '',
		'icon_openiconic' 	=> '',
		'icon_typicons' 	=> '',
		'icon_entypo' 		=> '',
		'icon_linecons' 	=> '',
	), $atts, 'listvgwccarousel' ); 
	extract( $atts );   
	$el_class = $type = $icon = '';
	$css = isset( $atts['css'] ) ? $atts['css'] : '';  
	$el_class .= vinagecko_shortcode_custom_css_class( $css, ' ' );

	$el_class .= ' '.$atts['el_class'];
	if(!empty($atts['type'])) {
		$type = 'icon_'.$atts['type'];
	}
	else {
		$type = 'icon_fontawesome';
	}

	if(!empty($atts['add_show_icon'])) {
		$icon = '<i class="'.$atts[$type].'"></i>';
		$el_class .= ' vg-icon';
	}
	
	$html  = '<div class="wpb_text_column wpb_vgwc_column wpb_content_element '.$el_class.'">';
		$html  .= '<div class="wpb_wrapper">';
			if(!empty($atts['title']) && isset($atts['title'])) {
				$html .= '<div class="vg-title">';
				$html .= '<h3>'.$icon.$atts['title'].'</h3>';
				$html .= '</div>';
			}
			$html .= do_shortcode("[vgpc id=".$atts['alias']."]") ;
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'listvgpccarousel', 'vinagecko_shortcode_postcarousel' );

function vinagecko_shortcode_vgmegamenu( $atts ) {
	$atts = shortcode_atts( array(
		'title'			=> '',
		'css'			=> '',
		'mega_menu'		=> '',
		'nav_menu'		=> '',
		'el_class' 		=> '',
	), $atts, 'vgmegamenu' ); 
	extract( $atts ); //var_dump($nav_menu); die();
	$title 		 = $mega_menu = $nav_menu = $el_class = '';
	$css 		 = isset( $atts['css'] ) ? $atts['css'] : '';  
	$el_class 	.= vinagecko_shortcode_custom_css_class( $css, ' ' );
	$el_class 	.= ' '.$atts['el_class'];
	$mega_menu   = $atts['mega_menu'];
	$nav_menu    = $atts['nav_menu'];
	
	$html  = '<div class="widget_mega_main_sidebar_menu wpb_custommegamenu_column wpb_content_element wpb_vgwc_column wpb_content_element icon '.$el_class.'">';
		$html  .= '<div class="wpb_wrapper">';
			if(!empty($atts['title']) && isset($atts['title'])) {
				$html .= '<h3 class="vg-title">';
				$html .= '<span>'.$title.'</span>';
				$html .= '</h3>';
			}
			$html .= wp_nav_menu( array( 'theme_location' => $mega_menu, 'echo' => false ) );
			$html .= wp_nav_menu( array( 'theme_location' => 'mobilemenucategory','container_class' => 'mobile-mega-menu hidden-lg hidden-md', 'echo' => false ) );
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'vgmegamenu', 'vinagecko_shortcode_vgmegamenu' );
//End Swallow Code Custom elements Visual Composer

//Add less compiler
function compileLessFile($input, $output, $params) {
    // include lessc.inc
    require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
	
	$less = new lessc;
	$less->setVariables($params);
	
    // input and output location
    $inputFile = get_template_directory().'/less/'.$input;
    $outputFile = get_template_directory().'/css/'.$output;

    $less->compileFile($inputFile, $outputFile);
}

function vinagecko_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>') {
 
	if(is_int($post)) {
		// get the post object of the passed ID
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}
 
	if(has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}
 
	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);
 
	return apply_filters('the_content', $the_excerpt);
}

function vinagecko_blog_sharing() {
	global $post, $primave_options;
	
	$share_url = get_permalink( $post->ID );
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	$postimg = $large_image_url[0];
	$posttitle = get_the_title( $post->ID );
	?>
	<div class="widget widget_socialsharing_widget">
		<h3 class="widget-title"><?php if(isset($primave_options['blog_share_title'])) { echo esc_html($primave_options['blog_share_title']); } else { _e('Share this post', 'roadthemes'); } ?></h3>
		<ul class="social-icons">
			<li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
		</ul>
	</div>
	<?php
}

function vinagecko_product_sharing() {

	if(isset($_POST['data'])) { // for the quickview
		$postid = intval( $_POST['data'] );
	} else {
		$postid = get_the_ID();
	}
	
	$share_url = get_permalink( $postid );

	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
	$postimg = $large_image_url[0];
	$posttitle = get_the_title( $postid );
	?>
	<div class="widget widget_socialsharing_widget">
		<h3 class="widget-title"><?php if(isset($primave_options['product_share_title'])) { echo esc_html($primave_options['product_share_title']); } else { _e('Share this product', 'roadthemes'); } ?></h3>
		<ul class="social-icons">
			<li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
		</ul>
	</div>
	<?php
}