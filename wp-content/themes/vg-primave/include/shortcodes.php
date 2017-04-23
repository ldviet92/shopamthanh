<?php
//Shortcodes for Visual Composer

add_action('vc_before_init', 'primave_vc_shortcodes');
function primave_vc_shortcodes() {
	//Swallow Code Custom elements Visual Composer
	if ( is_plugin_active( 'vg-woocarousel/vg-woocarousel.php' ) ) {
		$args = array(
			'post_type' => 'vgwc',
			'posts_per_page' => -1,
		);

		$vgwc = new WP_Query($args);
		$vgwctitle = (isset($vgwctitle)) ? $vgwctitle : '';
		if ($vgwc->have_posts()) : 
			while ($vgwc->have_posts()) : $vgwc->the_post(); 
				$vgwctitle[get_the_title()]= get_the_ID();
			endwhile;
		endif;
	}	
	
	if ( is_plugin_active( 'vg-postcarousel/vg-postcarousel.php' ) ) {
		$args = array(
			'post_type' => 'vgpc',
			'posts_per_page' => -1,
		);

		$vgpc = new WP_Query($args);
		$vgwctitle = (isset($vgwctitle)) ? $vgwctitle : '';
		if ($vgpc->have_posts()) : 
			while ($vgpc->have_posts()) : $vgpc->the_post(); 
				$vgpctitle[get_the_title()]= get_the_ID();
			endwhile;
		endif;
	}
	if ( is_plugin_active( 'mega_main_menu/mega_main_menu.php' ) ) {
		foreach ( get_registered_nav_menus() as $key => $value ){
			$key = str_replace( ' ', '-', $key );
			$theme_menu_locations[ $key ] = $key;
		}
		foreach ( get_nav_menu_locations() as $key => $value ){
			$key = str_replace( ' ', '-', $key );
			$theme_menu_locations[ $key ] = $key;
		}
	}
	

	//End Swallow Code Custom elements Visual Composer
	
	if ( is_plugin_active( 'mega_main_menu/mega_main_menu.php' ) ) {
		//VG MegaMenu && Custom Menu
		vc_map(array(
			'name' => esc_html__('VG MegaMenu', 'vg-primave'),
			'base' => 'vgmegamenu',
			'icon' => 'icon-wpb-vg icon-wpb-megamenu',
			'class' => '',
			'category' => esc_html__('VG Primave', 'vg-primave'),
			'description' => esc_html__('VG MegaMain Extensions Replace', 'vg-primave'),
			'admin_label' => true,
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'vg-primave' ),
					'param_name' => 'title',
					'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'vg-primave' ),
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'CSS box', 'vg-primave' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'vg-primave' ),
				),
				array(
					'heading' => esc_html__( 'Select Mega Menu Desktop', 'vg-primave' ),
					'description' => esc_html__( 'Select Mega menu in desktop.', 'vg-primave' ),
					'param_name' => 'mega_menu',
					'type' => 'dropdown',
					'value' => $theme_menu_locations,
					'admin_label' => true,
					'save_always' => true,
				),	
				array(
					'heading' => esc_html__( 'Select Treeview Menu Mobile', 'vg-primave' ),
					'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'vg-primave' ) : esc_html__( 'Select menu to display.', 'vg-primave' ),
					'param_name' => 'nav_menu',
					'type' => 'dropdown',
					'value' => $theme_menu_locations,
					'admin_label' => true,
					'save_always' => true,
				),	
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'vg-primave' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'vg-primave' ),
				),
			)
		));
	}
	//Brand logos
	vc_map(array(
		'name' => esc_html__('Brand Logos', 'vg-primave'),
		'base' => 'ourbrands',
		'icon' => 'icon-wpb-vg icon-wpb-ourbrands',
		'class' => '',
		'category' => esc_html__('VG Primave', 'vg-primave'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__('Number of rows', 'vg-primave'),
				'param_name' => 'rowsnumber',
				'value' => array(
					'one'	=> 'one',
					'two'	=> 'two',
					'four'	=> 'four',
				),
			),
		)
	));
	
	//Swallow Code Custom elements Visual Composer
	if ( is_plugin_active( 'vg-woocarousel/vg-woocarousel.php' ) ) {
		//List VG WooCarousel
		vc_map(array(
			'name' => esc_html__('VG WooCarousel', 'vg-primave'),
			'base' => 'listvgwccarousel',
			'icon' => 'icon-wpb-vg icon-wpb-woocarousel',
			'class' => '',
			'category' => esc_html__('VG Primave', 'vg-primave'),
			'description' => esc_html__('VG WooCarousel Extensions', 'vg-primave'),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'vg-primave' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'vg-primave' ),
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'CSS box', 'vg-primave' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'vg-primave' ),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__('VG WooCarousel', 'vg-primave'),
					'param_name' => 'alias',
					'admin_label' => true,
					'value' => $vgwctitle,
					'save_always' => true,
					'description' => esc_html__( 'Select your VG WooCarousel.', 'vg-primave' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Icon?', 'vg-primave' ),
					'param_name' => 'add_show_icon',
					'description' => esc_html__( 'Show Icon.', 'vg-primave' ),
					'value' => array( esc_html__( 'Yes', 'vg-primave' ) => 'Yes' ),
					'save_always' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'vg-primave' ),
					'value' => array(
						__( 'Font Awesome', 'vg-primave' ) => 'fontawesome',
						__( 'Open Iconic', 'vg-primave' ) => 'openiconic',
						__( 'Typicons', 'vg-primave' ) => 'typicons',
						__( 'Entypo', 'vg-primave' ) => 'entypo',
						__( 'Linecons', 'vg-primave' ) => 'linecons',
					),
					'save_always' => true,
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an 'EMPTY' icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'vg-primave' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'vg-primave' ),
				),
			)
		));
	}
	
	if ( is_plugin_active( 'vg-postcarousel/vg-postcarousel.php' ) ) {
		//List VG PostCarousel
		vc_map(array(
			'name' => esc_html__('VG PostCarousel', 'vg-primave'),
			'base' => 'listvgpccarousel',
			'icon' => 'icon-wpb-vg icon-wpb-postcarousel',
			'class' => '',
			'category' => esc_html__('VG Primave', 'vg-primave'),
			'description' => esc_html__('VG PostCarousel Extensions', 'vg-primave'),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'vg-primave' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'vg-primave' ),
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'CSS box', 'vg-primave' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'vg-primave' ),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__('VG WooCarousel', 'vg-primave'),
					'param_name' => 'alias',
					'admin_label' => true,
					'value' => $vgpctitle,
					'save_always' => true,
					'description' => esc_html__( 'Select your VG WooCarousel.', 'vg-primave' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Icon?', 'vg-primave' ),
					'param_name' => 'add_show_icon',
					'description' => esc_html__( 'Show Icon.', 'vg-primave' ),
					'value' => array( esc_html__( 'Yes', 'vg-primave' ) => 'Yes' ),
					'save_always' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'vg-primave' ),
					'value' => array(
						__( 'Font Awesome', 'vg-primave' ) => 'fontawesome',
						__( 'Open Iconic', 'vg-primave' ) => 'openiconic',
						__( 'Typicons', 'vg-primave' ) => 'typicons',
						__( 'Entypo', 'vg-primave' ) => 'entypo',
						__( 'Linecons', 'vg-primave' ) => 'linecons',
					),
					'save_always' => true,
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an 'EMPTY' icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'vg-primave' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
					'save_always' => true,
					'settings' => array(
						'emptyIcon' => false, // default true, display an 'EMPTY' icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'The Always select icon from the library if you want to have the icon.', 'vg-primave' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'vg-primave' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'vg-primave' ),
				),
			)
		));
	}
	//End Swallow Code Custom elements Visual Composer
}
?>