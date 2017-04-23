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

//Require plugins
require_once get_template_directory () . '/class-tgm-plugin-activation.php';

function primave_register_required_plugins() {

    $plugins = array(
		array(
            'name'               => esc_html__('VinaGecko Helper', 'vg-primave'),
            'slug'               => 'vinagecko-helper',
            'source'             => get_template_directory() . '/plugins/vinagecko-helper.zip',
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => esc_html__('Mega Main Menu', 'vg-primave'),
            'slug'               => 'mega_main_menu',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/mega_main_menu.zip'),
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => esc_html__('Visual Composer', 'vg-primave'),
            'slug'               => 'js_composer',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/js_composer.zip'),
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => esc_html__('Redux Framework', 'vg-primave'),
            'slug'               => 'redux-framework',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/redux-framework.zip'),
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => esc_html__('VG WooCarousel', 'vg-primave'),
            'slug'               => 'vg-woocarousel',
			'source'             => esc_url('http://wordpress.vinagecko.net/l/vg-woocarousel.zip'),
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => esc_html__('VG PostCarousel', 'vg-primave'),
            'slug'               => 'vg-postcarousel',
			'source'             => esc_url('http://wordpress.vinagecko.net/l/vg-postcarousel.zip'),
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => esc_html__('Revolution Slider', 'vg-primave'),
            'slug'               => 'revslider',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/revslider.zip'),
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'      => esc_html__('Wordpress Ajax AutoSuggest Plugin', 'vg-primave'),
            'slug'      => 'ajax-autosuggest',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/ajax-autosuggest-plugin.zip'),
            'required'           => true,
            'external_url'       => '',
        ),	
        // Plugins from the WordPress Plugin Repository.

        array(
            'name'      => esc_html__('Contact Form 7', 'vg-primave'),
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),			
		array(
            'name'      => esc_html__('WooCommerce', 'vg-primave'),
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
		array(
            'name'      => esc_html__('YITH WooCommerce Compare', 'vg-primave'),
            'slug'      => 'yith-woocommerce-compare',
            'required'  => true,
        ),
		array(
            'name'      => esc_html__('YITH WooCommerce Wishlist', 'vg-primave'),
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => true,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'vg-primave' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'vg-primave' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'vg-primave' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'vg-primave' ),
            'notice_can_install_required'     => _n_noop( 'This g requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'vg-primave' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'vg-primave' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'vg-primave' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'vg-primave' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'vg-primave' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'vg-primave' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'vg-primave' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'primave_register_required_plugins' ); 

//Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
    require_once( get_template_directory().'/theme-config.php' );
}

//Add Woocommerce support
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

//Override woocommerce widgets
function primave_override_woocommerce_widgets() {
	//Show mini cart on all pages
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		unregister_widget( 'WC_Widget_Cart' ); 
		include_once( get_template_directory() . '/woocommerce/class-wc-widget-cart.php' );
		register_widget( 'Custom_WC_Widget_Cart' );
	}
}
add_action( 'widgets_init', 'primave_override_woocommerce_widgets', 15 );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
function primave_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	
	<span class="mcart-number"><?php echo WC()->cart->cart_contents_count; ?></span>
	
	<?php
	$fragments['span.mcart-number'] = ob_get_clean();
	
	return $fragments;
} 
add_filter( 'woocommerce_add_to_cart_fragments', 'primave_woocommerce_header_add_to_cart_fragment' );

//Change price html
function primave_woo_price_html( $price,$product ){
	if ( $product->is_type( 'variable' ) ) {
		return '<div class="vgwc-price price-variable">'. $price .'</div>';
	}
	else {
		return '<div class="vgwc-price">'. $price .'</div>';
	}
}
add_filter( 'woocommerce_get_price_html', 'primave_woo_price_html', 100, 2 );

//Category Image
function primave_woocommerce_category_image() {
    if ( is_product_category() || is_shop() ){
	    global $wp_query;
		global $primave_options;
		$image = '';
		if ( is_product_category()){
			$cat = $wp_query->get_queried_object();
			$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );	
		}
	    if ( $image && !empty($image)) {?>
		   <div class="primave-banner banner-category"><img src="<?php echo esc_url($image); ?>" alt=""></div>
		<?php } elseif(isset($primave_options['cat_banner_img']) && !empty($primave_options['cat_banner_img'])) { ?>
			<div class="primave-banner banner-category"><a href="<?php echo esc_url($primave_options['cat_banner_link']); ?>"><img src="<?php echo esc_url($primave_options['cat_banner_img']['url']); ?>" alt=""></a></div>
		<?php } else { ?>
			<div class="primave-banner banner-category">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/category-image.jpg') ; ?>" alt=""/>
			</div>
		<?php
		}
	}
}

add_action( 'woocommerce_archive_description', 'primave_woocommerce_category_image', 2 );


// Change products per page
function primave_woo_change_per_page() {
	global $primave_options;
	
	return $primave_options['product_per_page'];
}
add_filter( 'loop_shop_per_page', 'primave_woo_change_per_page', 20 );

function primave_copyright() {
	global $primave_options;
		$copynotice = (isset($primave_options['copyright-notice'])) ? $primave_options['copyright-notice'] : '' ;
		$copylink 	= (isset($primave_options['copyright-link'])) ? $primave_options['copyright-link'] : '' ;
		if(strpos($copynotice,'{') && strpos($copynotice,'}')) {
			$copyright = str_ireplace('{','<a href="' . $copylink .'">',$copynotice);
			$copyright = str_ireplace('}','</a>',$copyright);
		}else {
			$copyright = $copynotice;
		}
	return $copyright;
}

//Limit number of products by shortcode [products]
//add_filter( 'woocommerce_shortcode_products_query', 'primave_woocommerce_shortcode_limit' );
function primave_woocommerce_shortcode_limit( $args ) {
	global $primave_options, $primave_productsfound;
	
	if(isset($primave_options['shortcode_limit']) && $args['posts_per_page']==-1) {
		$args['posts_per_page'] = $primave_options['shortcode_limit'];
	}
	
	$primave_productsfound = new WP_Query($args);
	$primave_productsfound = $primave_productsfound->post_count;
	
	return $args;
}

//Change number of related products on product page. Set your own value for 'posts_per_page'
function primave_woo_related_products_limit( $args ) {
	global $product, $primave_options;
	$args['posts_per_page'] = $primave_options['related_amount'];

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'primave_woo_related_products_limit' );

//Change number upsell 
function primave_woo_upsell_products_limit( $args ) {
	global $product, $primave_options;
	$args['posts_per_page'] = $primave_options['upsell_amount'];

	return $args;
}
add_filter( 'woocommerce_upsell_display', 'primave_woo_upsell_products_limit' );

//Remove woocommerce before, after shop loop item
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

//move message to top
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
add_action( 'woocommerce_show_message', 'wc_print_notices', 10 );

//Category product
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 15 );

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 45 );

//Single product organize
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_show_tabs_product_summary', 'woocommerce_output_product_data_tabs', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//remove single meta
add_action( 'woocommerce_show_related_products', 'woocommerce_output_related_products', 20 );

// Remove the WooCommerce Upsell hook
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
// Add a custom action to display Upsells
add_action( 'woocommerce_show_upsell_products', 'woocommerce_upsell_display', 15 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_short_description', 10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals');

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_meta', 30 );
function primave_single_meta(){
	global $primave_options;
	//remove single meta
	if(isset($primave_options['single_meta']) && $primave_options['single_meta']) {
	  remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_meta', 30 );
	}
}
add_action( 'init', 'primave_single_meta' );

//Display social sharing on product page
function primave_woocommerce_social_share(){
	global $primave_options;
?>
	<div class="share_buttons">
		<?php if ($primave_options['share_code']!='') {
			echo wp_kses($primave_options['share_code'], array(
				'div' => array(
					'class' => array()
				),
				'span' => array(
					'class' => array(),
					'displayText' => array()
				),
			));
		} ?>
	</div>
<?php
}
add_action( 'woocommerce_share', 'primave_woocommerce_social_share', 35 );

//Display stock status on product page
function primave_product_stock_status(){
	global $product;
	?>
	<div class="stock"><?php esc_html_e('Availability', 'vg-primave');?> 
		<?php if($product->is_in_stock()){ ?>
			<span class="in-stock"><?php echo $product->get_stock_quantity()." "; ?><?php esc_html_e('In stock', 'vg-primave');?></span>
		<?php } else { ?>
			<span class="out-of-stock"><?php esc_html_e('Out of stock', 'vg-primave');?></span>
		<?php } ?>	
	</div>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'primave_product_stock_status', 25 ); 

//Show buttons wishlist, compare, email on product page
function primave_product_buttons(){
	global $product;
	?>
	<div class="actions">
		<div class="action-buttons">
			<div class="add-to-links">
				<?php if(class_exists('YITH_Woocompare')) { ?>
					<?php echo do_shortcode('[yith_compare_button]') ?>
				<?php } ?>
				<?php if(class_exists('YITH_WCWL')){ ?>
					<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
				<?php } ?>
			</div>
			<?php echo '<div class="sharefriend"><a href="mailto: yourfriend@domain.com?Subject=Checkout this product: '.esc_attr($product->get_title()).'">'.esc_html__( 'Email your friend', 'vg-primave' ).'</a></div>'; ?>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'primave_product_buttons', 30 );

//Project organize
remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );
add_action( 'projects_single_project_summary', 'projects_template_single_title', 5 );
remove_action( 'projects_before_single_project_summary', 'projects_template_single_short_description', 20 );
remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );
add_action( 'projects_single_project_gallery', 'projects_template_single_gallery', 40 );
//projects list
remove_action( 'projects_loop_item', 'projects_template_loop_project_title', 20 ); 
 
//Change search form
function primave_search_form( $form ) {
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = esc_html__( 'Search...', 'vg-primave' );
	}
	
	$form = '<form role="search" method="get" id="blogsearchform" class="searchform" action="' . esc_url(home_url( '/' ) ). '" >
	<div class="form-input">
		<input class="input_text" type="text" value="'.esc_attr($search_str).'" name="s" id="search_input" />
		<button class="button" type="submit" id="blogsearchsubmit"><i class="fa fa-search"></i></button>
		<input type="hidden" name="post_type" value="post" />
		</div>
	</form>';
	$form .= '<script type="text/javascript">';
	$form .= 'jQuery(document).ready(function(){
		jQuery("#search_input").focus(function(){
			if(jQuery(this).val()=="'. esc_html__( 'Search...', 'vg-primave' ).'"){
				jQuery(this).val("");
			}
		});
		jQuery("#search_input").focusout(function(){
			if(jQuery(this).val()==""){
				jQuery(this).val("'. esc_html__( 'Search...', 'vg-primave' ).'");
			}
		});
		jQuery("#blogsearchsubmit").click(function(){
			if(jQuery("#search_input").val()=="'. esc_html__( 'Search...', 'vg-primave' ).'" || jQuery("#search_input").val()==""){
				jQuery("#search_input").focus();
				return false;
			}
		});
	});';
	$form .= '</script>';
	return $form;
}
add_filter( 'get_search_form', 'primave_search_form' ); 
 
//Change woocommerce search form
function primave_woo_search_form( $form ) {
	global $wpdb;
	
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = esc_html__( 'Search products...', 'vg-primave' );
	}
	
	$form = '<form role="search" method="get" id="searchform" action="'.esc_url( home_url( '/'  ) ).'">';
		$form .= '<div>';
			$form .= '<input type="text" value="'.esc_attr($search_str).'" name="s" id="ws" placeholder="" />';
			$form .= '<button class="btn btn-primary" type="submit" id="wsearchsubmit"><i class="fa fa-search"></i></button>';
			$form .= '<input type="hidden" name="post_type" value="product" />';
		$form .= '</div>';
	$form .= '</form>';
	$form .= '<script type="text/javascript">';
	$form .= 'jQuery(document).ready(function(){
		jQuery("#ws").focus(function(){
			if(jQuery(this).val()=="'.esc_html__( 'Search products...', 'vg-primave' ).'"){
				jQuery(this).val("");
			}
		});
		jQuery("#ws").focusout(function(){
			if(jQuery(this).val()==""){
				jQuery(this).val("'.esc_html__( 'Search products...', 'vg-primave' ).'");
			}
		});
		jQuery("#wsearchsubmit").click(function(){
			if(jQuery("#ws").val()=="'.esc_html__( 'Search products...', 'vg-primave' ).'" || jQuery("#ws").val()==""){
				jQuery("#ws").focus();
				return false;
			}
		});
	});';
	$form .= '</script>';
	return $form;
}
add_filter( 'get_product_search_form', 'primave_woo_search_form' ); 
 
//Add breadcrumbs
function primave_breadcrumb() {
	global $post;
	$delimiter = '<span class="separator"> -- </span>'; // delimiter between crumbs
	$before = '<span>'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb
	echo '<div class="breadcrumbs">';
    if (!is_home()) {
        echo '<a href="';
        echo esc_url( home_url( '/'  ) );
        echo '">';
        echo esc_html__('Home', 'vg-primave');
        echo '</a><span class="separator"> -- </span>';
        if (is_category() || is_single()) {
            the_category(' <span class="separator"> -- </span> ');
            if (is_single()) {
                echo '<span class="separator"> -- </span>';
                the_title();
            }
        } elseif (is_page()) {
            if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<a href="'.esc_url(get_permalink($ancestor)).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a><span class="separator"> -- </span>';
				}
				echo $output;
				echo '<span title="'. esc_attr($title) .'"> '.$title.'</span>';
			} else {
				echo '<span> '.get_the_title().'</span>';
			}
        }
		elseif (is_tag()) {single_tag_title();}
		elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		}
		elseif (is_author()) {echo "<span>". esc_html__('Author Archive', 'vg-primave').'</span>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>". esc_html__('Blog Archives', 'vg-primave').'</span>';}
		elseif (is_search()) {echo "<span>". esc_html__('Search Results', 'vg-primave').'</span>';}
	} else {
		echo '<a href="';
        echo esc_url( home_url( '/'  ) );
        echo '">';
        echo esc_html__('Home', 'vg-primave');
        echo '</a><span class="separator"> -- </span>';
		esc_html_e('Blog', 'vg-primave');
	}
	echo '</div>';
}
function primave_limitStringByWord ($string, $maxlength, $suffix = '') {

	if(function_exists( 'mb_strlen' )) {
		// use multibyte functions by Iysov
		if(mb_strlen( $string )<=$maxlength) return $string;
		$string = mb_substr( $string, 0, $maxlength );
		$index = mb_strrpos( $string, ' ' );
		if($index === FALSE) {
			return $string;
		} else {
			return mb_substr( $string, 0, $index ).$suffix;
		}
	} else { // original code here
		if(strlen( $string )<=$maxlength) return $string;
		$string = substr( $string, 0, $maxlength );
		$index = strrpos( $string, ' ' );
		if($index === FALSE) {
			return $string;
		} else {
			return substr( $string, 0, $index ).$suffix;
		}
	}
} 
// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625; 


function primave_setup() {
	/*
	 * Makes primave Themes available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on VinaGecko, use a find and replace
	 * to change 'vg-primave' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('vg-primave', get_template_directory() . '/languages');

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	// This theme supports a variety of post formats.
	add_theme_support('post-formats', array('image', 'gallery', 'video', 'audio'));

	// Register menus
	register_nav_menu('top-menu', esc_html__('Top Menu', 'vg-primave'));
	register_nav_menu('primary', esc_html__('Primary Menu', 'vg-primave'));
	register_nav_menu('mobilemenu', esc_html__('Mobile Menu', 'vg-primave'));
	register_nav_menu('menu-top-bottom', esc_html__('Menu Top Bottom', 'vg-primave'));
	register_nav_menu('menu-bottom-1', esc_html__('Menu Bottom 1', 'vg-primave'));
	register_nav_menu('menu-bottom-2', esc_html__('Menu Bottom 2', 'vg-primave'));
	register_nav_menu('menu-bottom-3', esc_html__('Menu Bottom 3', 'vg-primave'));
	register_nav_menu('menu-bottom-4', esc_html__('Menu Bottom 4', 'vg-primave'));
	register_nav_menu('mobilemenucategory', esc_html__('Mobile Category Product', 'vg-primave'));
	register_nav_menu('category-product', esc_html__('Category Product', 'vg-primave'));
	register_nav_menu('menu-login', esc_html__('Login', 'vg-primave'));

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support('custom-background', array(
		'default-color' => 'e6e6e6',
	));
	add_theme_support( "custom-header", array(
		'default-color' => '',
	));
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');
	
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support('post-thumbnails');

	set_post_thumbnail_size(1170, 9999); // Unlimited height, soft crop
	add_image_size('primave-category-thumb', 870, 580, true); // (cropped)
	add_image_size('primave-post-thumb', 300, 200, true); // (cropped)
	add_image_size('primave-post-thumbwide', 570, 352, true); // (cropped)
	
	//woocommerce products per page
	//require_once get_template_directory () . '/woocommerce/class-wppp-front-end.php';
}
add_action('after_setup_theme', 'primave_setup'); 
 
function primave_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'vg-primave' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'vg-primave', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (primave, cyrillic, vietnamese)', 'vg-primave' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'vg-primave' == $subset )
			$subsets .= ',primave,primave-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}
	return $font_url;
}
 
function primave_scripts_styles() {
	global $wp_styles, $wp_scripts, $primave_options;
	
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	*/
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	if ( !is_admin()) {
		// Add Bootstrap JavaScript
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.2.0', true );
		
		// Add Lazy-load
		wp_enqueue_script( 'lazy-js', get_template_directory_uri() . '/js/jquery.lazy.min.js', array('jquery'), '1.7.4', true );
		wp_enqueue_script( 'lazy-plugins-js', get_template_directory_uri() . '/js/jquery.lazy.plugins.min.js', array('jquery'), '1.7.3', true );
	
		// Add jQuery Cookie
		wp_enqueue_script('jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), '1.4.1', true);	
	
		// Add Fancybox
		wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true );
		wp_enqueue_style( 'jquery-fancybox-css', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), '2.1.5' );
		wp_enqueue_script('jquery-fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.js', array('jquery'), '1.0.5', true);
		wp_enqueue_style('jquery-fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.css', array(), '1.0.5');
	
		//Superfish
		wp_enqueue_script( 'superfish-js', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true );
	
		//Add Shuffle js
		wp_enqueue_script( 'modernizr-custom-js', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true );
		wp_enqueue_script( 'shuffle-js', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true );
	
		// Add owl.carousel files
		wp_enqueue_script('owl.carousel', 	get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));
		wp_enqueue_style('owl.carousel', 	get_template_directory_uri() . '/css/owl.carousel.css');
		wp_enqueue_style('owl.theme', 		get_template_directory_uri() . '/css/owl.theme.css');
	
		// Add jQuery countdown file
		wp_enqueue_script( 'countdown-js', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.0.4', true );
	
		// Add theme.js file
		wp_enqueue_script( 'primave-theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20140826', true );
	}
	
	$font_url = primave_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'primave-fonts', esc_url_raw( $font_url ), array(), null );
	
	if ( !is_admin()) {
		
		// Loads our main stylesheet.
		wp_enqueue_style( 'primave-style', get_stylesheet_uri() );

		// Load fontawesome css
		wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );
		
		// Load bootstrap css
		if ( !is_rtl() ) {
			wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5' );
		}
		
		if ( is_rtl() ) {
			wp_enqueue_style( 'primave-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.min.css', array(), '3.3.2-rc1' );
		}
	}
	// Compile Less to CSS
	// HieuJa get Preset Color Option
	$presetopt = primave_get_preset();	
	// HieuJa end block
	
	if (isset($primave_options['bodyfont']['font-family']) && !empty($primave_options['bodyfont']['font-family'])) {
		$bodyfont = $primave_options['bodyfont']['font-family'];
	} else {
		$bodyfont = 'Hind';
	}
	if (isset($primave_options['headingfont']['font-family']) && !empty($primave_options['headingfont']['font-family'])) {
		$headingfont = $primave_options['headingfont']['font-family'];
	} else {
		$headingfont = 'Hind';
	}
	
	if(isset($primave_options['enable_less'])){
		if($primave_options['enable_less']){
			$themevariables = array(
				'heading_font'=> $headingfont,
				'body_font'=> $bodyfont,
				'heading_color'=> $primave_options['headingfont']['color'],
				'text_color'=> $primave_options['bodyfont']['color'],
				'primary_color' => $primave_options['primary_color'],
				'color_bg'		=> $primave_options['color_bg'],
				'rate_color' => $primave_options['rate_color'],
			);
			switch ($presetopt) {
				case 2:
					$themevariables['primary_color'] = $primave_options['primary2_color'];
					$themevariables['rate_color']	 = $primave_options['rate2_color'];
					$themevariables['color_bg']		 = $primave_options['color2_bg'];
				break;
				case 3:
					$themevariables['primary_color'] = $primave_options['primary3_color'];
					$themevariables['rate_color'] 	 = $primave_options['rate3_color'];
					$themevariables['color_bg']		 = $primave_options['color3_bg'];
				break;
				case 4:
					$themevariables['primary_color'] = $primave_options['primary4_color'];
					$themevariables['rate_color'] 	 = $primave_options['rate4_color'];
					$themevariables['color_bg'] 	 = $primave_options['color4_bg'];
				break;
			}
			if( function_exists('compileLessFile') ){
				compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
				compileLessFile('compare.less', 'compare'.$presetopt.'.css', $themevariables);
				compileLessFile('ie.less', 'ie'.$presetopt.'.css', $themevariables);
			}
		}
	}
	
	if ( !is_admin()) {
		if( isset($presetopt) ){
			// Load main theme css style
			wp_enqueue_style( 'primave-css', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array(), '1.0.0' );
			//Compare CSS
			wp_enqueue_style( 'primave-css', get_template_directory_uri() . '/css/compare'.$presetopt.'.css', array(), '1.0.0' );
			// Loads the Internet Explorer specific stylesheet.
			wp_enqueue_style( 'primave-ie', get_template_directory_uri() . '/css/ie'.$presetopt.'.css', array( 'primave-style' ), '20152907' );
		} else {
			// Load main theme css style
			wp_enqueue_style( 'primave-css', get_template_directory_uri() . '/css/theme1.css', array(), '1.0.0' );
			//Compare CSS
			wp_enqueue_style( 'primave-css', get_template_directory_uri() . '/css/compare1.css', array(), '1.0.0' );
			// Loads the Internet Explorer specific stylesheet.
			wp_enqueue_style( 'primave-ie', get_template_directory_uri() . '/css/ie1.css', array( 'primave-style' ), '20152907' );
		}
		$wp_styles->add_data( 'primave-ie', 'conditional', 'lte IE 9' );
	}
	// Load styleswitcher css style
	wp_enqueue_style( 'primave-styleswitcher-css', get_template_directory_uri() . '/css/styleswitcher.css', array(), '1.0.0' );

	if(isset($primave_options['enable_sswitcher'])){
		if($primave_options['enable_sswitcher']){
		// Add styleswitcher.js file
		wp_enqueue_script( 'primave-styleswitcher-js', get_template_directory_uri() . '/js/styleswitcher.js', array(), '20140826', true );
		}
	}
	if ( is_rtl() ) {
		wp_enqueue_style( 'primave-rtl', get_template_directory_uri() . '/rtl.css', array(), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'primave_scripts_styles' );

//Swallow Code Custom elements Visual Composer        
function primave_load_custom_wp_admin_style() {
	wp_enqueue_style( 'vg_js_composer_icon', get_template_directory_uri() . '/css/vg_js_composer_icon.css', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'primave_load_custom_wp_admin_style' );
//End Swallow Code Custom elements Visual Composer

//Include
if (!class_exists('primave_widgets') && file_exists(get_template_directory().'/include/vinawidgets.php')) {
    require_once(get_template_directory().'/include/vinawidgets.php');
}
if (file_exists(get_template_directory().'/include/styleswitcher.php')) {
    require_once(get_template_directory().'/include/styleswitcher.php');
}
if (file_exists(get_template_directory().'/include/wooajax.php')) {
    require_once(get_template_directory().'/include/wooajax.php');
}
if (file_exists(get_template_directory().'/include/shortcodes.php')) {
    require_once(get_template_directory().'/include/shortcodes.php');
}
 
function primave_mce_css( $mce_css ) {
	$font_url = primave_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'primave_mce_css' ); 

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since VinaGecko 1.0
 */
function primave_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'primave_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since VinaGecko 1.0
 */
function primave_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__('Blog Sidebar', 'vg-primave'),
		'id' => 'sidebar-1',
		'description' => esc_html__('Sidebar on blog page', 'vg-primave'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="vg-title widget-title"><span>',
		'after_title' => '</span></h3>',
	));	
	register_sidebar(array(
		'name' => esc_html__('Top Header', 'vg-primave'),
		'id' => 'sidebar-top-header',
		'description' => esc_html__('Sidebar on Top Header', 'vg-primave'),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 col-md-6 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="vg-title widget-title"><span>',
		'after_title' => '</span></h3>',
	));	
	register_sidebar(array(
		'name' => esc_html__('Category Sidebar', 'vg-primave'),
		'id' => 'sidebar-category',
		'description' => esc_html__('Sidebar on product category page', 'vg-primave'),
		'before_widget' => '<aside id="%1$s" class="widget vg-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="vg-title widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Product Sidebar', 'vg-primave'),
		'id' => 'sidebar-product',
		'description' => esc_html__('Sidebar on product page', 'vg-primave'),
		'before_widget' => '<aside id="%1$s" class="widget vg-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="vg-title widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Pages Sidebar', 'vg-primave'),
		'id' => 'sidebar-page',
		'description' => esc_html__('Sidebar on content pages', 'vg-primave'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="vg-title widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Single Product Sidebar', 'vg-primave'),
		'id' => 'sidebar-single',
		'description' => esc_html__('Sidebar on content pages', 'vg-primave'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s sidebar-single">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="vg-title widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Bottom', 'vg-primave'),
		'id' => 'middle-bottom',
		'class' => 'bottom',
		'description' => esc_html__('Widget on Bottom', 'vg-primave'),
		'before_widget' => '<div id="%1$s" class="widget vg-bottom-menu col-lg-3 col-sm-6 col-xs-12 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="vg-title bottom-static-title"><h3>',
		'after_title' => '</h3></div>',
	));	
	register_sidebar(array(
		'name' => esc_html__('Widget Menu Bottom', 'vg-primave'),
		'id' => 'menu-bottom',
		'class' => 'bottom',
		'description' => esc_html__('Widget Menu on Bottom', 'vg-primave'),
		'before_widget' => '<div id="%1$s" class="widget vg-bottom-menu col-lg-3 col-sm-6 col-xs-12 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="vg-title bottom-static-title"><h3>',
		'after_title' => '</h3></div>',
	));	
}
add_action('widgets_init', 'primave_widgets_init');


if (! function_exists('primave_content_nav')) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since VinaGecko 1.0
 */
function primave_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'vg-primave' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link(wp_kses(__('<span class="meta-nav">&larr;</span> Older posts', 'vg-primave'), array('span' => array('class' => array())))); ?></div>
			<div class="nav-next"><?php previous_posts_link(wp_kses(__('Newer posts <span class="meta-nav">&rarr;</span>', 'vg-primave'), array('span' => array('class' => array())))); ?></div>
		</nav><!-- #<?php echo esc_attr($html_id); ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'primave_pagination' ) ) :
/* Pagination */
function primave_pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => wp_kses(__('<i class="fa fa-chevron-left"></i>', 'vg-primave'), array('i' => array('class' => array()))),
		'next_text'    => wp_kses(__('<i class="fa fa-chevron-right"></i>', 'vg-primave'), array('i' => array('class' => array()))),
	) );
}
endif;

if ( ! function_exists( 'primave_entry_meta' ) ) :
	function primave_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(esc_html__( ', ', 'vg-primave' ) );

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', esc_html__( ', ', 'vg-primave' ) );
		
		$date = sprintf( '<a href="'. get_permalink() .'" rel="bookmark" class="link_date"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'vg-primave' ), get_the_author() ) ),
			get_the_author()
		);
		
		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('0 comments', 'vg-primave');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . esc_html__(' comments', 'vg-primave');
			} else {
				$comments = esc_html__('1 comment', 'vg-primave');
			}
			$write_comments = '<a href="' . get_comments_link() .'"><i class="fa fa-comments-o"></i>'. $comments.'</a>';
		}

		// Translators: 1 is author's name, 2 is date, 3 is the category ,  4 is the tags and 5 is comments.
		
		if ( is_single() ) {
			$utility_text = wp_kses(__( '<i class="fa fa-folder-o"></i>%2$s<i class="fa fa-tags"></i>%3$s%4$s', 'vg-primave' ), array('i' => array('class' => array())));
		} else {
			$utility_text = wp_kses(__( '<i class="fa fa-user"></i>%1$s<i class="fa fa-folder-o"></i>%2$s%4$s', 'vg-primave' ), array('i' => array('class' => array())));
		}
		printf( $utility_text, $author, $categories_list, $tag_list, $write_comments );
	}
endif;

function primave_entry_meta_small() {
	
	$date = sprintf( '<a href="'. get_permalink() .'" rel="bookmark" class="link_date"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$num_comments = (int)get_comments_number();
	$write_comments = '';
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = esc_html__('0 comments', 'vg-primave');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . esc_html__(' comments', 'vg-primave');
		} else {
			$comments = esc_html__('1 comment', 'vg-primave');
		}
		$write_comments = '<a href="' . get_comments_link() .'"><i class="fa fa-comments-o"></i>'. $comments.'</a>';
	}
	
	$utility_text = wp_kses(__( '<div class="small-meta"><i class="fa fa-calendar"></i>%1$s%2$s</div>', 'vg-primave' ), array('div' => array('class' => array()),'i' => array('class' => array())));
	
	printf( $utility_text, $date, $write_comments );
}

function primave_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'primave_post_intro_section',
			esc_html__( 'Post featured content', 'vg-primave' ),
			'primave_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'primave_add_meta_box' );

function primave_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'primave_meta_box', 'primave_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_primave_meta_value_key', true );

	echo '<label for="primave_post_intro">';
	esc_html_e( 'This content will be used to replace the featured image, use shortcode here', 'vg-primave' );
	echo '</label><br />';
	//echo '<textarea id="primave_post_intro" name="primave_post_intro" rows="5" cols="50" />' . esc_attr( $value ) . '</textarea>';
	wp_editor( $value, 'primave_post_intro', $settings = array() );
	
	
}

function primave_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['primave_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['primave_meta_box_nonce'], 'primave_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['primave_post_intro'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['primave_post_intro'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_primave_meta_value_key', $my_data );
}
add_action( 'save_post', 'primave_save_meta_box_data' );

if ( ! function_exists( 'primave_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own primave_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since VinaGecko 1.0
 */
function primave_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_html_e( 'Pingback:', 'vg-primave' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__( '(Edit)', 'vg-primave' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 50 ); ?>
			</div>
			<div class="comment-info">
				<header class="comment-meta comment-author vcard">
					<?php
						
						printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'vg-primave' ) . '</span>' : ''
						);
						printf( '<time datetime="%1$s">%2$s</time>',
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s at %2$s', 'vg-primave' ), get_comment_date(), get_comment_time() )
						);
					?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'vg-primave' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</header><!-- .comment-meta -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'vg-primave' ); ?></p>
				<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'vg-primave' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->
			</div>
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
if ( ! function_exists( 'before_comment_fields' ) &&  ! function_exists( 'after_comment_fields' )) :
//Change comment form
function primave_before_comment_fields() {
	echo '<div class="comment-input">';
}
add_action('comment_form_before_fields', 'primave_before_comment_fields');

function primave_after_comment_fields() {
	echo '</div>';
}
add_action('comment_form_after_fields', 'primave_after_comment_fields');

endif; 
 
function primave_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'primave_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since VinaGecko 1.0
 */
 
add_action( 'wp_enqueue_scripts', 'primave_wcqi_enqueue_polyfill' );
function primave_wcqi_enqueue_polyfill() {
    wp_enqueue_script( 'wcqi-number-polyfill' );
}

// Remove Redux Ads
function primave_my_custom_admin_styles() {
?>
<style type="text/css">
.rAds {
	display: none !important;
}
</style>
<?php
}
add_action('admin_head', 'primave_my_custom_admin_styles');

/* Remove Redux Demo Link */
function primave_removeDemoModeLink()
{
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));    
    }
}
add_action('init', 'primave_removeDemoModeLink');


// HieuJa add specific class
function primave_add_query_vars_filter($vars){
    $vars[] = "demo";
    return $vars;
}
add_filter('query_vars', 'primave_add_query_vars_filter');

// Get value from URL and set Cookie, Class Subffix
function primave_body_class($classes)
{	
	global $primave_options;
	
	// Set Class Layout for Body Tag
	$classes[] = primave_get_layout();
	
	// Set Class Preset Color for Body Tag
	$classes[] = "preset-" . primave_get_preset();
	
	return $classes;
}
add_filter('body_class', 'primave_body_class');

// Override get_header function
function primave_get_header()
{
	// Set Cookie for Layout and Preset Color
	primave_set_layout_preset_color();
	
	// Reset Layout and Preset Color
	primave_reset_layout_preset_color();
	
	// Get Header Name
	$header = primave_get_layout();
	
	get_header($header);	
}

// Override get_footer function
function primave_get_footer()
{
	// Get Footer Name
	$footer = primave_get_layout();
	
	get_footer($footer);	
}

// HieuJa get Layout
function primave_get_layout()
{
    global $pisces_options;
        
        $layout = isset($pisces_options['page_layout']) ? $pisces_options['page_layout'] : 'layout-1';
        $demo   = get_query_var('demo', '');
        
        if(!empty($demo)) 
        {
            $demo   = str_replace("niche-", "", $demo);
            $demo   = str_split($demo);
            $layout = 'layout-' . $demo[0];
        }
    return $layout;
}

// HieuJa get Preset Color
function primave_get_preset()
{
    global $pisces_options;
    
    $presetColor = isset($pisces_options['preset_option']) ? $pisces_options['preset_option'] : '1';  
    $demo        = get_query_var('demo', '');
    
    if(!empty($demo)) 
    {
        $demo        = str_replace("niche-", "", $demo);
        $demo        = str_split($demo);
        $presetColor = $demo[1];
    }
    
    return $presetColor;
}
// HieuJa set Cookie for Layout and Preset Color
function primave_set_layout_preset_color()
{
	// Set Layout Style
	$ilayout = get_query_var('ilayout', '');
	if(!empty($ilayout)) {
		setcookie('page-layout', $ilayout, strtotime('+1 day'), '/');
	}
	
	// Set Preset Color
	$preset = get_query_var('preset', '');
	if(!empty($preset)) {
		setcookie('preset-color', $preset, strtotime('+1 day'), '/');
	}
	
	return true;
}

// HieuJa reset Layout Option and Preset Color
function primave_reset_layout_preset_color()
{
	global $primave_options;
	
	$requestURI = esc_url($_SERVER['REQUEST_URI']);
	$homeURL	= home_url('/');
	$isHomePage = strpos($homeURL, $requestURI);
	$primave_options['page_layout']   = isset($primave_options['page_layout']) ? $primave_options['page_layout'] : "layout-1";
	$primave_options['preset_option'] = isset($primave_options['preset_option']) ? $primave_options['preset_option'] : "1";
	
	if($requestURI == '/' || $isHomePage !== false) 
	{
		$pageLayout  = isset($_COOKIE['page-layout']) ? $_COOKIE['page-layout'] : $primave_options['page_layout'];
		$presetColor = isset($_COOKIE['preset-color']) ? $_COOKIE['preset-color'] : $primave_options['preset_option'];
		if($pageLayout != $primave_options['page_layout'] 
		|| $presetColor != $primave_options['preset_option']) {
			setcookie('page-layout', $primave_options['page_layout'], strtotime('+1 day'), '/');
			setcookie('preset-color', $primave_options['preset_option'], strtotime('+1 day'), '/');
			wp_redirect(home_url('/'));
			exit;
		}
	}
}
add_action('init', 'primave_reset_layout_preset_color');

// HieuJa get global variables
function primave_get_global_variables($variable = 'primave_options')
{
	global $woocommerce, $primave_options, $primave_productsfound, $product, $primave_productrows, $primave_secondimage, $woocommerce_loop, $projects_loop, $projects, $project, $post, $primave_projectrows, $primave_projectsfound, $wpdb, $wp_query, $is_IE;
	
	switch($variable)
	{
		case "primave_options":
			return $primave_options;
		break;
		case "woocommerce":
			return $woocommerce;
		break;	
		case "primave_productsfound":
			return $primave_productsfound;
		break;	
		case "product":
			return $product;
		break;	
		case "primave_productrows":
			return $primave_productrows;
		break;
		case "primave_secondimage":
			return $primave_secondimage;
		break;
		case "woocommerce_loop":
			return $woocommerce_loop;
		break;	
		case "projects_loop":
			return $projects_loop;
		break;
		case "projects":
			return $projects;
		break;
		case "project":
			return $project;
		break;		
		case "post":
			return $post;
		break;	
		case "primave_projectrows":
			return $primave_projectrows;
		break;	
		case "primave_projectsfound":
			return $primave_projectsfound;
		break;	
		case "wpdb":
			return $wpdb;
		break;		
		case "wp_query":
			return $wp_query;
		break;	
		case "is_IE":
			return $is_IE;
		break;
	}
	return false;
}

//Override woocommerce widgets
function primave_override_ajaxsearch_autosuggest_widgets() {
 //Show mini cart on all pages
 if ( class_exists( 'Ajax_search_widget' ) ) {
  unregister_widget( 'Ajax_search_widget' ); 
  include_once( get_template_directory() . '/include/ajax-search-autosuggest.php' );
  register_widget( 'Custom_Ajax_search_widget' );
 }
}
add_action( 'widgets_init', 'primave_override_ajaxsearch_autosuggest_widgets', 15 );

function primave_custom_script_css () {
	global $primave_options;
	?>
	<script type="text/javascript">
		<?php 
			echo (isset($primave_options['advanced_editor_js'])) ? $primave_options['advanced_editor_js'] : "";		
		?>
	</script>
	<style>
		<?php 
			echo (isset($primave_options['advanced_editor_css'])) ? $primave_options['advanced_editor_css'] : "";		
		?>
	</style>
	<?php
}
add_action('wp_head', 'primave_custom_script_css');


/**********Function Load Image Lazy-load**********/
if(!is_admin()){
    function primave_alter_att_attributes($attr) {
        $attr['data-src'] = $attr['src'];
        $attr['class'] = $attr['class'] . ' lazy';
        $attr['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
        return $attr;
    }
    add_filter('wp_get_attachment_image_attributes', 'primave_alter_att_attributes' );
}
/*end lazy load*/

/* disable_srcset */
function disable_srcset( $sources ) {
return false;
}
add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );