<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('primave_theme_config')) {

    class primave_theme_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'vg-primave'),
                'desc' => wp_kses(__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'vg-primave'), array('p' => array())),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
			);

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'vg-primave'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'vg-primave'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'vg-primave'); ?>" />
                <?php endif; ?>

                <h4><?php echo esc_html($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'vg-primave'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'vg-primave'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'vg-primave') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
				printf(' <p class="howto">' . wp_kses(__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'vg-primave'), array('a' => array('href' => array(),'title' => array()))) . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'vg-primave'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
	
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'vg-primave'),
                'desc'      => esc_html__('General theme options', 'vg-primave'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'logo_main',
                        'type'      => 'media',
                        'title'     => esc_html__('Logo', 'vg-primave'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload logo here.', 'vg-primave'),
					),
					array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => esc_html__('Body Background', 'vg-primave'),
                        'subtitle'  => esc_html__('Body background with image, color. Only work with box layout', 'vg-primave'),
						'default'   => '#ffffff',
					),
					array(
						'id'		=>'share_head_code',
						'type' 		=> 'textarea',
						'title' 	=> esc_html__('ShareThis/AddThis head tag', 'vg-primave'), 
						'desc' 		=> esc_html__('Paste your ShareThis or AddThis head tag here', 'vg-primave'),
						'default' 	=> '',
					),
					array(
						'id'		=>'share_code',
						'type' 		=> 'textarea',
						'title' 	=> esc_html__('ShareThis/AddThis code', 'vg-primave'), 
						'desc' 		=> esc_html__('Paste your ShareThis or AddThis code here', 'vg-primave'),
						'default' 	=> '',
					),
					array(
                        'id'        => 'show_author',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Author Info Page', 'vg-primave'),
						'default'   => true,
					),
					
				),
			);
			
			//Header
			$this->sections[] = array(
                'title'     => esc_html__('Header', 'vg-primave'),
                'desc'      => esc_html__('Header options', 'vg-primave'),
                'icon'      => 'el-icon-tasks',
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Sticky Header', 'vg-primave'),
                        'default'   => true,
					),
					array(
                        'id'        => 'title_mobile_menu',
                        'type'      => 'text',
                        'title'     => esc_html__('Title Mobile Menu', 'vg-primave'),
                        'default'   => 'Menu'
					),
				),
			);
			//Footer
			$this->sections[] = array(
                'title'     => esc_html__('Footer', 'vg-primave'),
                'desc'      => esc_html__('Footer options', 'vg-primave'),
                'icon'      => 'el-icon-tasks',
				'subsection' => true,
                'fields'    => array(
					array(
                        'id'        => 'logo_bottom_show',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Logo Bottom', 'vg-primave'),
						'default'   => true,
					),
                    array(
                        'id'        => 'logo_bottom',
                        'type'      => 'media',
                        'title'     => esc_html__('Logo Bottom', 'vg-primave'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload logo bottom here or we will get the logo header.', 'vg-primave'),
					),     
					array(
                        'id'        => 'link_logo_bottom',
                        'type'      => 'text',
                        'title'     => esc_html__('Link Logo Bottom', 'vg-primave'),
                        'desc'      => esc_html__('Empty link will take you to the home page link', 'vg-primave'),
						'placeholder'  => 'http://',
					),
					array(
                        'id'        => 'logo_des',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Logo Description', 'vg-primave'),
                        'default'   => 'This is Photoshops version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin...',
					),
					array(
						'id'       => 'vg-menu-top-bottom',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => esc_html__( 'Menu Top Bottom', 'vg-primave' ),
						'subtitle' => esc_html__( 'Select a menu', 'vg-primave' ),
						'default'   => 'Menu Top Bottom',
					),
					array(
                        'id'        => 'copyright_show',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Copyright', 'vg-primave'),
						'default'   => true,
					),
					array(
                        'id'        => 'copyright-notice',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Copyright Notice', 'vg-primave'),
                        'default'   => 'Copyright (C) 2016 {VinaGecko.com}. All Rights Reserved.'
					),
					array(
                        'id'        => 'copyright-link',
                        'type'      => 'text',
                        'title'     => esc_html__('Copyright Link', 'vg-primave'),
                        'default'   => 'http://vinagecko.com',
						'placeholder'  => 'http://',
					),
				),
			);
			
			$this->sections[] = array(
				'icon'       => 'el-icon-globe-alt',
				'title'      => esc_html__('Social', 'vg-primave'),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'social_show',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Social', 'vg-primave'),
						'default'   => true,
					),
					array(
						'id'       => 'ftsocial_icons',
						'type'     => 'sortable',
						'title'    => esc_html__('Footer social Icons', 'vg-primave'),
						'subtitle' => esc_html__('Enter social links', 'vg-primave'),
						'desc'     => esc_html__('Drag/drop to re-arrange', 'vg-primave'),
						'mode'     => 'text',
						'options'  => array(
							'facebook'    => 'https://www.facebook.com/vinawebsolutions',
							'twitter'     => 'https://twitter.com/vnwebsolutions',
							'instagram'   => 'Instagram',
							'tumblr'      => 'Tumblr',
							'pinterest'   => 'Pinterest',
							'google-plus' => 'https://plus.google.com/',
							'linkedin'    => 'Linkedin',
							'behance'     => 'Behance',
							'dribbble'    => 'Dribbble',
							'youtube'     => 'https://youtube.com/',
							'vimeo'       => 'Vimeo',
							'rss'         => 'RSS',
						),
						'default' => array(
						    'facebook'    => 'https://www.facebook.com/vinawebsolutions',
							'twitter'     => 'https://twitter.com/vnwebsolutions',
							'instagram'   => '',
							'tumblr'      => '',
							'pinterest'   => '',
							'google-plus' => 'https://plus.google.com/+HieuJa/posts',
							'linkedin'    => '',
							'behance'     => '',
							'dribbble'    => '',
							'youtube'     => 'https://www.youtube.com/user/vinawebsolutions',
							'vimeo'       => '',
							'rss'         => '',
						),
					),
				),
			);
			// Colors
            $this->sections[] = array(
                'title'     => esc_html__('Preset Manager', 'vg-primave'),
                'desc'      => esc_html__('Presets options', 'vg-primave'),
                'icon'      => 'el-icon-tint',
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets1', 'vg-primave'),
                'desc'     		=> esc_html__('Presets1 options', 'vg-primave'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #92c841).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#92c841',
                        'validate'  	=> 'color',
					),	
					array(
                        'id'        	=> 'color_bg',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Color 2', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for color 2 (default: #363636).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#363636',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Rating Star Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #ffd873).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'  		=> '#ffd873',
                        'validate'  	=> 'color',
					),
				),
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets2', 'vg-primave'),
                'desc'      	=> esc_html__('Presets2 options', 'vg-primave'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary2_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #94bce1).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#94bce1',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'color2_bg',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Color 2', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for color 2 (default: #ff4f4f).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ff4f4f',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate2_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Rating Star Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #ffd873).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ffd873',
                        'validate'  	=> 'color',
					),
				),
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets3', 'vg-primave'),
                'desc'      	=> esc_html__('Presets3 options', 'vg-primave'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary3_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #ea7974).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ea7974',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'color3_bg',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Color 2', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for color 2 (default: #dc615b).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#dc615b',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate3_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Rating Star Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #ffd873).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ffd873',
                        'validate'  	=> 'color',
					),
				),
			);
			$this->sections[] = array(
                'title'     	=> esc_html__('Presets4', 'vg-primave'),
                'desc'      	=> esc_html__('Presets4 options', 'vg-primave'),
                'icon'      	=> 'el-icon-tint',
				'subsection' 	=> true,
                'fields'    	=> array(
					array(
                        'id'        	=> 'primary4_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Primary Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for primary color (default: #ff9c00).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ff9c00',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'color4_bg',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Color 2', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for color 2 (default: #ff7e00).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ff7e00',
                        'validate'  	=> 'color',
					),
					array(
                        'id'        	=> 'rate4_color',
                        'type'      	=> 'color',
                        'title'     	=> esc_html__('Rating Star Color', 'vg-primave'),
                        'subtitle'  	=> esc_html__('Pick a color for star of rating (default: #ffd873).', 'vg-primave'),
						'transparent' 	=> false,
                        'default'   	=> '#ffd873',
                        'validate'  	=> 'color',
					),
				),
			);
			
			
			// Layout
            $this->sections[] = array(
                'title'     => esc_html__('Layout', 'vg-primave'),
                'desc'      => esc_html__('Select page layout: Box or Full Width', 'vg-primave'),
                'icon'      => 'el-icon-align-justify',
                'fields'    => array(
					array(
						'id'       => 'page_layout',
						'subtitle' => esc_html__('Select page default page layout.', 'vg-primave'),
						'type'     => 'select',
						'multi'    => false,
						'title'    => esc_html__('Page Layout', 'vg-primave'),
						'options'  => array(
							'layout-1' => 'Page Layout 01',
							'layout-2' => 'Page Layout 02',
							'layout-3' => 'Page Layout 03',
							'layout-4' => 'Page Layout 04',
						),
						'default'  => 'layout-1'
					),		
					array(
						'id'       => 'page_style',
						'subtitle' => esc_html__('Select layout style: Box or Full Width', 'vg-primave'),
						'type'     => 'select',
						'multi'    => false,
						'title'    => esc_html__('Layout Style', 'vg-primave'),
						'options'  => array(
							'full' => 'Full Width',
							'box'  => 'Box'
						),
						'default'  => 'full'
					),
					array(
                        'id'        => 'preset_option',
                        'type'      => 'select',
                        'title'     => esc_html__('Preset', 'vg-primave'),
						'subtitle'      => esc_html__('Select a preset to quickly apply pre-defined colors and fonts', 'vg-primave'),
                        'options'   => array(
							'1' => 'Preset 1',
                            '2' => 'Preset 2',
							'3' => 'Preset 3',
							'4' => 'Preset 4',
                      ),
                        'default'   => '1'
					),
					array(
                        'id'        => 'enable_sswitcher',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Style Switcher', 'vg-primave'),
						'subtitle'  => esc_html__('The style switcher is only for preview on front-end', 'vg-primave'),
						'default'   => false,
					),
				),
			);
			
			// Sidebar
			$this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'vg-primave'),
                'desc'      => esc_html__('Sidebar options', 'vg-primave'),
                'icon'      => 'el-icon-th-large',
                'fields'    => array(
					array(
						'id'       	=> 'sidebar_pos',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Main Sidebar Position', 'vg-primave'),
						'subtitle'      => esc_html__('Sidebar on category page', 'vg-primave'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'left'
					),
					array(
						'id'       	=> 'sidebar_product',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Product Sidebar Position', 'vg-primave'),
						'subtitle'      => esc_html__('Sidebar on product page', 'vg-primave'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'right'
					),
					array(
						'id'       	=> 'sidebar_single',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Single Product Sidebar Position', 'vg-primave'),
						'subtitle'      => esc_html__('Sidebar on product page', 'vg-primave'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'right'
					),
					array(
						'id'       	=> 'sidebarse_pos',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Secondary Sidebar Position', 'vg-primave'),
						'subtitle'  => esc_html__('Sidebar on pages', 'vg-primave'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right'),
						'default'  	=> 'left'
					),
					array(
						'id'       	=> 'sidebarblog_pos',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Blog Sidebar Position', 'vg-primave'),
						'subtitle'  => esc_html__('Sidebar on Blog pages', 'vg-primave'),
						'options'  	=> array(
							'left' 	=> 'Left',
							'right' => 'Right',
							'nosidebar' 	=> 'Nosidebar',
							'fullwidth' 	=> 'Fullwidth',
						),
						'default'  	=> 'right'
					),
				),
			);
			
			
			//Typography
			$this->sections[] = array(
                'title'     => esc_html__('Typography', 'vg-primave'),
                'desc'      => esc_html__('Typography options', 'vg-primave'),
                'icon'      => 'el-icon-font',
                'fields'    => array(
                    array(
                        'id'            	=> 'bodyfont',
                        'type'          	=> 'typography',
                        'title'         	=> esc_html__('Body font', 'vg-primave'),
                        'google'        	=> true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   	=> false,    // Select a backup non-google font in addition to a google font
                        'all_styles'    	=> false,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        	=> array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         	=> 'px', // Defaults to px
                        'subtitle'      	=> esc_html__('Main body font.', 'vg-primave'),
                        'default'       	=> array(
                            'color'         => '#363636',
                            'font-weight'   => '400',
                            'font-family'   => '',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '20px'),
					),
					array(
                        'id'            	=> 'headingfont',
                        'type'          	=> 'typography',
                        'title'         	=> esc_html__('Heading font', 'vg-primave'),
                        'google'        	=> true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   	=> true,    // Select a backup non-google font in addition to a google font
                        'font-size'     	=> false,
                        'line-height'   	=> false,
                        'all_styles'    	=> true,    // Enable all Google Font style/weight variations to be added to the page
                        'units'         	=> 'px', // Defaults to px
                        'subtitle'      	=> esc_html__('Heading font.', 'vg-primave'),
                        'default'       	=> array(
                            'color'         => '#363636',
                            'font-weight'   => '400',
                            'font-family'   => '',
                            'google'        => true,
						),
					),
				),
			);
			//Brand logos
			$this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'vg-primave'),
                'desc'      => esc_html__('Upload brand logos and links', 'vg-primave'),
                'icon'      => 'el-icon-website',
                'fields'    => array(
					array(
                        'id'        => 'enable_brands',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Brands Logo', 'vg-primave'),
						'subtitle'  => esc_html__('The Brands Logo is only for preview on front-end', 'vg-primave'),
						'default'   => true,
					),
					array(
						'id'          => 'brand_logos',
						'type'        => 'slides',
						'title'       => esc_html__('Logos', 'vg-primave'),
						'desc'        => esc_html__('Upload logo image and enter logo link.', 'vg-primave'),
						'placeholder' => array(
							'title'           => esc_html__('Title', 'vg-primave'),
							'description'     => esc_html__('Description', 'vg-primave'),
							'url'             => esc_html__('Link', 'vg-primave'),
						),
					),
				),
			);
			
			// Woocommerce
			$this->sections[] = array(
                'title'     => esc_html__('Woocommerce', 'vg-primave'),
                'desc'      => esc_html__('Use this section to select options for product', 'vg-primave'),
                'icon'      => 'el-icon-shopping-cart',
                'fields'    => array(
					array(
						'id'       => 'second_image',
						'type'     => 'switch',
						'title'    => esc_html__('Use secondary product image', 'vg-primave'),
						'default'  => true,
					),
					array(
						'id'       => 'quick_view',
						'type'     => 'switch',
						'title'    => esc_html__('Use quick view product', 'vg-primave'),
						'default'  => true,
					),
				),
			);
			
			$this->sections[] = array(
				'icon'       => 'el-icon-tags',
				'title'      => esc_html__( 'Mini Cart', 'vg-primave' ),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'mini_cart_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Mini cart title', 'vg-primave'),
                        'default'   => 'Shopping Cart'
					),		
					array(
                        'id'        => 'mini_cart_sub_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Mini cart Sub title', 'vg-primave'),
                        'default'   => 'items'
					),	
					array(
                        'id'        => 'icon_mini_cart',
                        'type'      => 'media',
                        'title'     => esc_html__('Icon Mini Cart', 'vg-primave'),
                        'compiler'  => 'true',
                        'mode'      => false,
						'desc'      => esc_html__('Upload Icon Mini Cart.', 'vg-primave'),
						'default'  => array( 'url' => get_template_directory_uri() . '/images/icon-cart.png' ),
					),   	
				),
			);
			$this->sections[] = array(
				'icon'       => 'el-icon-tags',
				'title'      => esc_html__( 'Category', 'vg-primave' ),
				'desc'      => esc_html__('Use this section to select options for Page Category Product', 'vg-primave'),
				'subsection' => true,	
                'fields'    => array(
					array(
						'id'       	=> 'layout_product',
						'type'     	=> 'radio',
						'title'    	=> esc_html__('Category View Layout', 'vg-primave'),
						'subtitle'      => esc_html__('View layout on category page', 'vg-primave'),
						'options'  	=> array(
							'gridview' 	=> 'Grid View',
							'listview' => 'List View',
						),
						'default'  	=> 'gridview',
					),
					array(
                        'id'        => 'cat_banner_img',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner Header Category', 'vg-primave'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload banner category here.', 'vg-primave'),
						'default'  => array( 'url' => get_template_directory_uri(). '/images/category-image.jpg' ),
					),
					array(
                        'id'        => 'cat_banner_link',
                        'type'      => 'text',
                        'title'     => esc_html__('Link Banner Category', 'vg-primave'),
                        'default'   => 'http://vinagecko.com',
					),
				),
			);
			$this->sections[] = array(
				'icon'       => 'el-icon-tags',
				'title'      => esc_html__( 'Single Product', 'vg-primave' ),
				'desc'      => esc_html__('Use this section to select options for Page Single Product', 'vg-primave'),
				'subsection' => true,	
                'fields'    => array(
				
					array(
						'id'       => 'single_meta',
						'type'     => 'switch',
						'title'    => esc_html__('Use hidden meta tags, category, SKU', 'vg-primave'),
						'default'  => false,
					),
					array(
                        'id'        => 'product_sharing_show',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Product Sharing', 'vg-primave'),
						'default'   => true,
					),
					array(
					  'id'       => 'words_short_des',
					  'type'     => 'text',
					  'title'    => esc_html__('Product Short Description Trim words', 'vg-primave'),
					  'default'  => '45',
					),
					array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Upsell products title', 'vg-primave'),
                        'default'   => 'You may also like...'
					),
					array(
                        'id'        => 'crosssells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Cross Sells title', 'vg-primave'),
                        'default'   => 'You may be interested in...'
					),
					array(
                        'id'        => 'related_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related products title', 'vg-primave'),
                        'default'   => 'Related Products',
					),
					array(
						'id'        	=> 'related_amount',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Number of related products', 'vg-primave'),
						"default"   	=> 6,
						"min"       	=> 3,
						"step"      	=> 1,
						"max"       	=> 16,
						'display_value' => 'text',
					),
				),
			);
			/**
			 *	Advanced
			 **/
			$this->sections[] = array(
				'id'			=> 'advanced',
				'title'			=> esc_html__( 'Advanced', 'vg-primave' ),
				'desc'			=> '',
                'icon'      => 'el-icon-wrench',
            );
			
			// Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'vg-primave'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'vg-primave'),
                'icon'      => 'el-icon-brush',
				'subsection' 	=> true,
                'fields'    => array(
					array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'vg-primave'),
						'default'   => true,
					),
				),
			);
			/**
			 *	Advanced Custom CSS
			 **/
			$this->sections[] = array(
				'icon'      => 'el-icon-css',
				'id'			=> 'advanced_css',
				'title'			=> esc_html__( 'Custom CSS', 'vg-primave' ),
				'desc'			=> '',
                'subsection' => true,
				'fields'		=> array(
                    array(
                        'id'       => 'advanced_editor_css',
                        'type'     => 'ace_editor',
                        'title'    => esc_html__( 'CSS Code', 'vg-primave' ),
                        'subtitle' => esc_html__( 'Paste your CSS code here.', 'vg-primave' ),
                        'mode'     => 'css',
                        'theme'    => 'monokai',
						'default'  => "body{\n margin: 0 auto;\n}",
                        'full_width' => true
                    ),
                ),
            );
            /**
			 *	Advanced Custom JS
			 **/
			$this->sections[] = array(
				'icon'      => 'el-icon-barcode',
				'id'			=> 'advanced_js',
				'title'			=> esc_html__( 'Custom JS', 'vg-primave' ),
				'desc'			=> '',
                'subsection' => true,
				'fields'		=> array(
                    array(
                        'id'       => 'advanced_editor_js',
                        'type'     => 'ace_editor',
                        'title'    => esc_html__( 'JS Code', 'vg-primave' ),
                        'subtitle' => esc_html__( 'Paste your JS code here.', 'vg-primave' ),
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'default'  => "jQuery(document).ready(function(){\n\n});",
                        'full_width' => true
                    ),
                ),
            );	
			
			// Portfolio
            $this->sections[] = array(
                'title'     => esc_html__('Portfolio', 'vg-primave'),
                'desc'      => esc_html__('Use this section to select options for portfolio', 'vg-primave'),
                'icon'      => 'el-icon-picture',
				'subsection' => true,
                'fields'    => array(
					array(
                        'id'        => 'portfolio_header',
                        'type'      => 'background',
                        'output'    => array('.portfolio_header'),
                        'title'     => esc_html__('Portfolio header background', 'vg-primave'),
						'default'   => '#eee',
					),
					array(
						'id'        	=> 'portfolio_columns',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Portfolio Columns', 'vg-primave'),
						"default"   	=> 3,
						"min"       	=> 2,
						"step"      	=> 1,
						"max"       	=> 4,
						'display_value' => 'text'
					),
					array(
						'id'        	=> 'portfolio_per_page',
						'type'      	=> 'slider',
						'title'     	=> esc_html__('Projects per page', 'vg-primave'),
						'desc'      	=> esc_html__('Amount of projects per page on portfolio page', 'vg-primave'),
						"default"   	=> 15,
						"min"       	=> 4,
						"step"      	=> 1,
						"max"       	=> 48,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'related_project_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related projects title', 'vg-primave'),
                        'default'   => 'Related Projects'
					),
				),
			);
			$this->sections[] = array(	
				'icon'      => 'el-icon-record',
                'title'     => esc_html__('Loading Page', 'vg-primave'),
				'subsection' 	=> true,
                'fields'    => array(
					array(
						'id'        => 'primave_loading',
						'type'      => 'switch',
						'title'     => esc_html__('Show Loading Page', 'vg-primave'),
						'default'   => false,
					),
				),
			);	
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . wp_kses(__('<strong>Theme URL:</strong> ', 'vg-primave'), array('strong' => array())) . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . wp_kses(__('<strong>Author:</strong> ', 'vg-primave'), array('strong' => array())) . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . wp_kses(__('<strong>Version:</strong> ', 'vg-primave'), array('strong' => array())) . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs 		 = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . wp_kses(__('<strong>Tags:</strong> ', 'vg-primave'), array('strong' => array())) . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'icon'              => 'el-icon-list-alt',
                'title'             => esc_html__('Customizer Only', 'vg-primave'),
                'desc'              => wp_kses(__('<p class="description">This Section should be visible only in Customizer</p>', 'vg-primave'), array('p' => array('class' => array()))),
                'customizer_only'   => true,
                'fields'    => array(
                    array(
                        'id'        => 'opt-customizer-only',
                        'type'      => 'select',
                        'title'     => esc_html__('Customizer Only Option', 'vg-primave'),
                        'subtitle'  => esc_html__('The subtitle is NOT visible in customizer', 'vg-primave'),
                        'desc'      => esc_html__('The field desc is NOT visible in customizer.', 'vg-primave'),
                        'customizer_only'   => true,

                        //Must provide key => value pairs for select options
                        'options'   => array(
                            '1' => 'Opt 1',
                            '2' => 'Opt 2',
                            '3' => 'Opt 3'
						),
                        'default'   => '2'
					),
				)
			);            
            
            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'vg-primave'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'vg-primave'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
					),
				),
			);

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'vg-primave'),
                //'desc'      => esc_html__('<p class="description">This is the Description. Again HTML is allowed</p>', 'vg-primave'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
					)
				),
			);
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'vg-primave'),
                'content'   => wp_kses(__('<p>This is the tab content, HTML is allowed.</p>', 'vg-primave'), array('p' => array()))
			);

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'vg-primave'),
                'content'   => wp_kses(__('<p>This is the tab content, HTML is allowed.</p>', 'vg-primave'), array('p' => array()))
			);

            // Set the help sidebar
            $this->args['help_sidebar'] = wp_kses(__('<p>This is the sidebar content, HTML is allowed.</p>', 'vg-primave'), array('p' => array()));
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'primave_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'vg-primave'),
                'page_title'        => esc_html__('Theme Options', 'vg-primave'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' 	=> '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'          => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'       => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
					),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
					),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
						),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
						),
					),
				)
			);


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			);
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
			);
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
			);
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
			);

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'vg-primave'), $v);
            } else {
                //$this->args['intro_text'] = esc_html__('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'vg-primave');
            }

            // Add content after the form.
            //$this->args['footer_text'] = esc_html__('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'vg-primave');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new primave_theme_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
