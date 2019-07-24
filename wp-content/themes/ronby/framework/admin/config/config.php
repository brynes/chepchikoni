<?php
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
	function ronby_get_option($id) {
		$redux=get_option( 'theme_option_data' );
		if (is_array($redux) && array_key_exists($id, $redux)) {
		$returned_redux = $redux[$id];
		} else {
		$returned_redux = '';
		}
		return $returned_redux;
	}
	$redux=get_option( 'theme_option_data' );
    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_option_data";
    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );
    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'ronby' ),
        'page_title'           => esc_html__( 'Theme Options', 'ronby' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'ronby-options',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'ronby-theme-options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
       // 'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
		'show_options_object' => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

	$allowed_html = array(
		'span' => array(),
		'a' => array('href'=> array()),
		'p' => array(),
	);

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.


    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_html__( '', 'ronby' ), $v );
    } else {
        $args['intro_text'] = esc_html__( '', 'ronby' );
    }

    // Add content after the form.
    $args['footer_text'] = esc_html__( '', 'ronby' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array();
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '', 'ronby' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'ronby' ),
		'icon' => 'el el-home',
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_site_layout_style',
				'type' => 'image_select',
				'title' => esc_html__('Choose Website Layout', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'options'  => array(
					'1'      => array(
						'alt'   => 'Business Layout', 
						'img'   => get_template_directory_uri().'/images/site-layouts/business.jpg'
					),
					'2'      => array(
						'alt'   => 'Construction Layout', 
						'img'   => get_template_directory_uri().'/images/site-layouts/constructions.jpg'
					),
					'3'      => array(
						'alt'   => 'Fitness Layout', 
						'img'  => get_template_directory_uri().'/images/site-layouts/fitness.jpg'
					),
					'4'      => array(
						'alt'   => 'Medical Layout', 
						'img'   => get_template_directory_uri().'/images/site-layouts/medical.jpg'
					),
					'5'      => array(
						'alt'   => 'Fashion Layout', 
						'img'   => get_template_directory_uri().'/images/site-layouts/shop.jpg'
					),
					'6'      => array(
						'alt'  => 'Restaurant Layout', 
						'img'  => get_template_directory_uri().'/images/site-layouts/restaurant.jpg'
					)
				),
				'default' => '1'
			),
			array(
				'id' => 'ronby_web_global_color_primary',
				'type' => 'color_rgba',
				'title' => esc_html__('Choose Global Color (Primary) for your Website', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_web_global_color_secondary',
				'type' => 'color_rgba',
				'title' => esc_html__('Choose Global Color (Secondary) for your Website', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_blog_color_primary',
				'type' => 'color_rgba',
				'title' => esc_html__('Choose Primary Color for your Blog', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_blog_color_secondary',
				'type' => 'color_rgba',
				'title' => esc_html__('Choose Secondary Color for your Blog', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_style_selector',
				'type' => 'switch',
				'title' => esc_html__('On/Off Style Selector', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Favicon Settings', 'ronby' ),
		'icon' => 'el el-globe-alt',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_favicon',
				'type' => 'media',
				'title' => esc_html__('Upload Favicon', 'ronby'),
				'subtitle' => esc_html__('This is favicon. Upload 64x64 favicon icon.', 'ronby'),
			),
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo Settings', 'ronby' ),
		'icon' => 'el el-adjust-alt',
        'subsection' => true,		
        'subtitle'       => esc_html__( 'This is for Logo options.', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'logo_icon',
				'type' => 'media',
				'title' => esc_html__('Logo Icon', 'ronby'),
				'subtitle' => esc_html__('Upload your site logo here. (178x57 pixel)', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'logo_text',
				'type' => 'text',
				'title' => esc_html__('Logo Text', 'ronby'),
				'subtitle' => esc_html__('Enter here logo text. This is feature is available for Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'logo_width',
				'type' => 'text',
				'title' => esc_html__('Logo Width', 'ronby'),
				'subtitle' => esc_html__('Enter logo width in pixel. Example: 178px', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'logo_height',
				'type' => 'text',
				'title' => esc_html__('Logo Height', 'ronby'),
				'subtitle' => esc_html__('Enter logo height in pixel. Example: 57px', 'ronby'),
				'default' => '',
			),
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Settings', 'ronby' ),
		'icon' => 'el el-cog-alt',
        'subtitle'       => esc_html__( '', 'ronby' ),
    ) );	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Menu Style Settings', 'ronby' ),
		'icon' => 'el el-lines',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_header_main_menu_style',
				'type' => 'image_select',
				'title' => esc_html__('Header Main Menu Styles', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'options'  => array(
					'1'      => array(
						'alt'   => 'Menu Style- One', 
						'img'   => get_template_directory_uri().'/images/menu-layouts/layout-1.JPG'
					),
					'2'      => array(
						'alt'   => 'Menu Style- Two', 
						'img'   => get_template_directory_uri().'/images/menu-layouts/layout-2.JPG'
					),
					'3'      => array(
						'alt'   => 'Menu Style- Three', 
						'img'  => get_template_directory_uri().'/images/menu-layouts/layout-3.JPG'
					),
					'4'      => array(
						'alt'   => 'Menu Style- Four', 
						'img'   => get_template_directory_uri().'/images/menu-layouts/layout-4.JPG'
					),
					'5'      => array(
						'alt'   => 'Menu Style- Five', 
						'img'   => get_template_directory_uri().'/images/menu-layouts/layout-5.JPG'
					),
					'6'      => array(
						'alt'  => 'Menu Style- Six', 
						'img'  => get_template_directory_uri().'/images/menu-layouts/layout-6.JPG'
					)
				),
				'default' => '1'
			),
			array(
				'id' => 'ronby_sticky_menu_switch',
				'type' => 'radio',
				'title' => esc_html__('Sticky Menu', 'ronby'),
				'options' => array(
					'1' => 'Semi Sticky',
					'2' => 'Full Sticky',
					'3' => 'No Sticky',
				) , // Must provide key => value pairs for radio options
				'default' => '3'
			),
			array(
				'id' => 'ronby_header_top_menu_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Header Top Menu', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),
			array(
				'id' => 'ronby_header_top_menu_lang_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Header Top Menu Language Switch', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2', 'ronby'),
				'default' => '1'
			),
			array(
				'id' => 'ronby_header_main_menu_search_btn_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Header Main Menu Search Button', 'ronby'),
				'subtitle' => esc_html__('On/Off search button from header main menu.', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_header_main_menu_slide_nav_btn_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Header Main Menu Slide Navigation Menu', 'ronby'),
				'subtitle' => esc_html__('On/Off slide navigation menu. This feature is available for Menu Style- 2', 'ronby'),
				'default' => '1'
			),
			array(
				'id' => 'ronby_woocommerce_cart_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off WooCommerce Cart Icon on Main Navigation Menu', 'ronby'),
				'sub_desc' => esc_html__('On/Off WooCommerce Cart Icon on Main Navigation Menu', 'ronby'),
				'default' => '1'
			),			
			array(
				'id' => 'ronby_header_top_menu_phone',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu Phone Number', 'ronby'),
				'subtitle' => esc_html__('Enter here header top menu phone number.You should not use gap between digits. Use (-) instead of gap. Example:+1-23-4567-890', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_email',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu Email', 'ronby'),
				'subtitle' => esc_html__('Enter here header top menu email. Example: xyz@example.com', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_address',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu Address', 'ronby'),
				'subtitle' => esc_html__('Enter here header top menu address details.', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_business_working_day',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu - Business Working Day', 'ronby'),
				'subtitle' => esc_html__('Enter your business working day in a week. Example: Monday to Friday. This feature is available for Menu Style- 3 and Menu Style- 4', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_business_working_hours',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu - Business Working Hours', 'ronby'),
				'subtitle' => esc_html__('Enter your business working hours in a day. Example: 8.00 AM - 5.30 PM. This feature is available for Menu Style- 3 and Menu Style- 4', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_btn_label',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu Button Label', 'ronby'),
				'subtitle' => esc_html__('Enter here header top menu button label.', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_btn_link',
				'type' => 'text',
				'title' => esc_html__('Header Top Menu Button Link', 'ronby'),
				'subtitle' => esc_html__('Enter here header top menu button link.Example:http://google.com', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_width',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Width', 'ronby'),
				'subtitle' => esc_html__('Enter here slide navigation width in pixel. Example: 280px. (Optional)', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_header_main_menu_slide_nav_desc',
				'type' => 'textarea',
				'title' => esc_html__('Slide Navigation Description', 'ronby'),
				'subtitle' => esc_html__('Enter here business description. This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_postal_address',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Postal Address', 'ronby'),
				'subtitle' => esc_html__('Enter here business postal address. This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_telephone',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Phone Number', 'ronby'),
				'subtitle' => esc_html__('Enter here business phone numbers. This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_copyright',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Copyright Text', 'ronby'),
				'subtitle' => esc_html__('Enter here copyright text. This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_btn1_label',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Button- 1 Label', 'ronby'),
				'subtitle' => esc_html__('Enter here button- 1 label. This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_btn1_url',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Button- 1 URL', 'ronby'),
				'subtitle' => esc_html__('Enter here button- 1 url. This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_btn2_label',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Button- 2 Label', 'ronby'),
				'subtitle' => esc_html__('Enter here button- 2 label. This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_nav_btn2_url',
				'type' => 'text',
				'title' => esc_html__('Slide Navigation Button- 2 URL', 'ronby'),
				'subtitle' => esc_html__('Enter here button- 2 url. This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),			
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Menu Color Settings', 'ronby' ),
		'icon' => 'el el-brush',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_header_top_menu_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_two_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu- 2 Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_icon_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Icon Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_social_icon_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Social Icon Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_social_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Social Icon Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 1', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_social_icon_hover_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Social Icon Hover Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 1', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_social_icon_hover_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Social Icon Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 1', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_btn_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Button Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_btn_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Button Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_btn_hover_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Button Hover Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_top_menu_btn_hover_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Top Menu Button Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_anchor_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Anchor Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_anchor_hover_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Anchor Hover Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_anchor_hover_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Anchor Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style-2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_sub_menu_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Sub Menu Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_sub_menu_anchor_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Sub Menu Anchor Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_search_btn_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Search Button Background color.', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_popup_search_btn_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Pop-up Search Button Background color.', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_header_main_menu_slide_nav_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Header Main Menu Slide Navigation Button Background color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_header_main_menu_slide_navigation_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Background color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_navigation_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Text color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_header_main_menu_slide_navigation_icon_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Icon color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn1_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 1 Text Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn1_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 1 Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn1_hovertext_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 1 Hover Text Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn1_hoverbg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 1 Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn2_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 2 Text Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn2_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 2 Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn2_hovertext_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 2 Hover Text Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_slide_navigation_btn2_hoverbg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Slide Navigation Button- 2 Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Menu Style- 2 and Menu Style- 5', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_mobile_nav_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Main Navigation Menu Background Color in Mobile Device.', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_mobile_nav_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Main Navigation Menu Text Color in Mobile Device.', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_mobile_nav_btn_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Main Navigation Menu Toggle Button Border Color in Mobile Device.', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
		),
    ) );	

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Settings', 'ronby' ),
		'icon' => 'el el-cog-alt',
        'subtitle'       => esc_html__( '', 'ronby' ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Column Settings', 'ronby' ),
		'icon' => 'el el-adjust-alt',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_footer_top_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of Columns in Footer Top', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'options' => array(
					'1' => 'One Column <br>(Insert your Widgets in "Footer 1st Column Widgets" area from Appearance > Widgets page)',
					'2' => 'Two Columns <br>(Insert your Widgets in "Footer 1st Column Widgets and Footer 2nd Column Widgets" area from Appearance > Widgets page)',
					'3' => 'Three Columns <br>(Insert your Widgets in "Footer 1st Column Widgets, Footer 2nd Column Widgets and Footer 3rd Column Widgets" area from Appearance > Widgets page)',
					'4' => 'Four Columns <br>(Insert your Widgets in "Footer 1st Column Widgets, Footer 2nd Column Widgets, Footer 3rd Column Widgets and Footer 4th Column Widgets" area from Appearance > Widgets page)',
					'5' => 'Five Columns <br>(Insert your Widgets in "Footer 1st Column Widgets, Footer 2nd Column Widgets, Footer 3rd Column Widgets, Footer 4th Column Widgets and Footer 5th Column Widgets" area from Appearance > Widgets page)',					
				), 
				'default' => '4'
			),
			array(
				'id' => 'ronby_footer_bottom_columns',
				'type' => 'radio',
				'title' => esc_html__('Number of Columns in Footer Bottom', 'ronby'),
				'subtitle' => esc_html__('This feature is for copyright section.', 'ronby'),
				'options' => array(
					'1' => 'One Column',
					'2' => 'Two Columns',					
				), 
				'default' => '1'
			),
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Bottom Info', 'ronby' ),
		'icon' => 'el el-address-book-alt',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'copy_text',
				'type' => 'textarea',
				'title' => esc_html__('Copyright Text', 'ronby'),
				'subtitle' => esc_html__('Enter your Copyright text here', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'payment_methods_image',
				'type' => 'media',
				'title' => esc_html__('Upload here Copyright Section image.', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Design Settings', 'ronby' ),
		'icon' => 'el el-brush',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_footer_layout_style',
				'type' => 'radio',
				'title' => esc_html__('Choose Footer Layout', 'ronby'),
				'options' => array(
					'1' => 'Layout 1',
					'2' => 'Layout 2',
					'3' => 'Layout 3',
					'4' => 'Layout 4',
					'5' => 'Layout 5',
					'6' => 'Layout 6',
				), 
				'default' => '1'
			),
			array(
				'id' => 'ronby_sticky_footer_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Sticky Footer', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),
			array(
				'id' => 'ronby_footer_bg_image',
				'type' => 'media',
				'title' => esc_html__('Upload Footer Top Background Image', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_footer_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Footer Top Background Color / Overlay Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			
			array(
				'id' => 'ronby_footer_bottom_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Footer Bottom Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_footer_bottom_txt_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Footer Bottom Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
	
            array(
                'id'             => 'ronby_footer_top_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px'),  
                'units_extended' => true,
				'display_units' => true,
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left				
                'title'          => esc_html__( 'Footer Top Padding Spacing', 'ronby' ),
				'subtitle' => esc_html__('This feature is for Footer Top section', 'ronby'),				
                'default'        => array(
                'padding-top'    => '115px',
                'padding-bottom' => '55px',
            ),
            ),
			
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Widgets Color Settings', 'ronby' ),
		'icon' => 'el el-brush',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
		array(
       'id' => 'ronby_about_us_one_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby About us One Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
			array(
				'id' => 'ronby_about_us_one_widget_title_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),

			array(
				'id' => 'ronby_about_us_one_widget_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_about_us_one_widget_icon_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Icon Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
			array(
				'id' => 'ronby_about_us_one_widget_iconbg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Icon Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_about_us_one_widget_iconhover_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Icon Hover Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_about_us_one_widget_iconhoverbg_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Icon Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
	array(
    'id'     => 'ronby_about_us_one_widget-end',
    'type'   => 'section',
    'indent' => false,
	),
	
	array(
       'id' => 'ronby_subscription_one_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Subscription One Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
		array(
				'id' => 'ronby_subscription_one_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		array(
				'id' => 'ronby_subscription_one_widget_btn_bg_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Button Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),		
		array(
				'id' => 'ronby_subscription_one_widget_btn_hover_bg_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Button Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),				
	array(
    'id'     => 'ronby_subscription_one_widget-end',
    'type'   => 'section',
    'indent' => false,
	),
	
	array(
       'id' => 'ronby_footer_nav_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Footer Navigation Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),	
		array(
				'id' => 'ronby_footer_nav_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		array(
				'id' => 'ronby_footer_nav_widget_anchor_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Anchor Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),		
		array(
				'id' => 'ronby_footer_nav_widget_anchor_hover_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Anchor Hover Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
	array(
    'id'     => 'ronby_footer_nav_widget-end',
    'type'   => 'section',
    'indent' => false,
	),

	array(
       'id' => 'ronby_contact_us_one_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Contact us One Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),	
		array(
				'id' => 'ronby_contact_us_one_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		array(
				'id' => 'ronby_contact_us_one_widget_icon_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Icon Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),		
		array(
				'id' => 'ronby_contact_us_one_widget_text_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
	array(
    'id'     => 'ronby_contact_us_one_widget-end',
    'type'   => 'section',
    'indent' => false,
	),

	array(
       'id' => 'ronby_contact_us_two_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Contact us Two Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),	
		array(
				'id' => 'ronby_contact_us_two_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		array(
				'id' => 'ronby_contact_us_two_widget_icon_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Icon Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),		
		array(
				'id' => 'ronby_contact_us_two_widget_text_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
	array(
    'id'     => 'ronby_contact_us_two_widget-end',
    'type'   => 'section',
    'indent' => false,
	),

	array(
       'id' => 'ronby_flickr_album_widget',
       'type' => 'section',
       'title' => __('Ronby Flickr Album Widget Color Settings', 'ronby'),
       'subtitle' => __('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_flickr_album_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			
	array(
    'id'     => 'ronby_flickr_album_widget-end',
    'type'   => 'section',
    'indent' => false,
	),	

	array(
       'id' => 'ronby_opening_hours_widget',
       'type' => 'section',
       'title' => __('Ronby Opening Hours Widget Color Settings', 'ronby'),
       'subtitle' => __('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_opening_hours_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
		array(
				'id' => 'ronby_opening_hours_widget_text_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			
	array(
    'id'     => 'ronby_opening_hours_widget-end',
    'type'   => 'section',
    'indent' => false,
	),
	array(
       'id' => 'ronby_recent_post_list_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Recent Post List Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_recent_post_list_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
		array(
				'id' => 'ronby_recent_post_list_widget_text_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
		array(
				'id' => 'ronby_recent_post_list_widget_anchor_hover_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Anchor Hover Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	 
			
	array(
    'id'     => 'ronby_recent_post_list_widget-end',
    'type'   => 'section',
    'indent' => false,
	),

	array(
       'id' => 'ronby_instagram_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Instagram Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_instagram_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 			
	array(
    'id'     => 'ronby_instagram_widget-end',
    'type'   => 'section',
    'indent' => false,
	),
	array(
       'id' => 'ronby_doctor_list_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Doctor\'s List Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_doctor_list_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 		array(
				'id' => 'ronby_doctor_list_widget_anchor_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Anchor Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 		array(
				'id' => 'ronby_doctor_list_widget_anchorhover_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Anchor Hover Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
	array(
    'id'     => 'ronby_doctor_list_widget-end',
    'type'   => 'section',
    'indent' => false,
	),	

	array(
       'id' => 'ronby_recent_post_two_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Recent Post List Two Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_recent_post_two_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 		array(
				'id' => 'ronby_recent_post_two_widget_date_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Date Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 		array(
				'id' => 'ronby_recent_post_two_widget_desc_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Description Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
	array(
    'id'     => 'ronby_recent_post_two_widget-end',
    'type'   => 'section',
    'indent' => false,
	),	

	array(
       'id' => 'ronby_subscription_two_widget',
       'type' => 'section',
       'title' => esc_html__('Ronby Subscription Two Widget Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),
		
		array(
				'id' => 'ronby_subscription_two_widget_title_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 		array(
				'id' => 'ronby_subscription_two_widget_text_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
 		array(
				'id' => 'ronby_subscription_two_widget_icon_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Icon Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
		array(
				'id' => 'ronby_subscription_two_widget_btn_bg_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Subscription Button Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),		
		array(
				'id' => 'ronby_subscription_two_widget_btn_hover_bg_color',
				'type' => 'color_rgba', 
				'title' => esc_html__('Subscription Button Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),				
	array(
    'id'     => 'ronby_subscription_two_widget-end',
    'type'   => 'section',
    'indent' => false,
	),
	
	array(
       'id' => 'ronby_wordpress_default_widgets',
       'type' => 'section',
       'title' => esc_html__('Wordpress Default Widgets Color Settings', 'ronby'),
       'subtitle' => esc_html__('', 'ronby'),
       'indent' => true 
		),	
			array(
				'id' => 'ronby_wordpress_default_widgets_title_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_wordpress_default_widgets_text_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_wordpress_default_widgets_anchor_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Anchor Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_wordpress_default_widgets_anchorhover_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Anchor Hover Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
	array(
    'id'     => 'ronby_wordpress_default_widgets-end',
    'type'   => 'section',
    'indent' => false,
	),
	
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Settings', 'ronby' ),
		'icon' => 'el el-cog-alt',
        'subtitle'       => esc_html__( '', 'ronby' ),
    ) );	
	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Page Settings', 'ronby' ),
		'icon' => 'el el-th',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_blog_page_layout',
				'type' => 'image_select',
				'title' => esc_html__('Choose Blog Page Layout', 'ronby'),
				'options' => array(
					'1'      => array(
						'alt'   => 'Business Blog Grid Right Sidebar', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-grid-right-sidebar.JPG'
					),
					'2'      => array(
						'alt'   => 'Business Blog Grid Two Column', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-grid-two-column.JPG'
					),					
					'3'      => array(
						'alt'   => 'Business Blog Grid Three Column', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-grid-three-column.JPG'
					),
					'4'      => array(
						'alt'   => 'Business Blog List', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-list.JPG'
					),
					'5'      => array(
						'alt'   => 'Business Blog List Left Sidebar', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-list-left-sidebar.JPG'
					),	
					'6'      => array(
						'alt'   => 'Business Blog List Right Sidebar', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-list-right-sidebar.JPG'
					),	
					'7'      => array(
						'alt'   => 'Business Blog Thumbnail', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-thumbnail.JPG'
					),
					'8'      => array(
						'alt'   => 'Business Blog Thumbnail With Sidebar', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/business-blog-thumbnail-with-sidebar.JPG'
					),	
					'9'      => array(
						'alt'   => 'Fitness Blog', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/fitness-blog.JPG'
					),	
					'10'      => array(
						'alt'   => 'Food-Restaurent Blog', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/food-blog.JPG'
					),	
					'11'      => array(
						'alt'   => 'Medical Blog With Sidebar', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/medical-blog-with-sidebar.JPG'
					),	
					'12'      => array(
						'alt'   => 'Shop Blog', 
						'img'   => get_template_directory_uri().'/images/blog-layouts/shop-blog.JPG'
					),					
				),
				'default' => '6'
			),
			
			array(
				'id' => 'blog_page_header_sec_title_one',
				'type' => 'text',
				'title' => esc_html__('Blog Page Header Section Title One', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			
			array(
				'id' => 'blog_page_header_sec_title_two',
				'type' => 'text',
				'title' => esc_html__('Blog Page Header Section Title Two', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			
			array(
				'id' => 'ronby_blog_page_post_date_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Date Info Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			
			array(
				'id' => 'ronby_blog_page_post_date_wordpress_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Date Format According Wordpress', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),
			array(
				'id' => 'ronby_blog_page_post_author_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Author Info Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),		
			array(
				'id' => 'ronby_blog_page_post_author_avatar_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Author Avatar Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),			
			array(
				'id' => 'ronby_blog_page_post_comment_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Comment Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_blog_page_post_category_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Category Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_blog_page_post_like_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Likes Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),	
			array(
				'id' => 'ronby_blog_page_post_views_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Views Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),				
			array(
				'id' => 'ronby_blog_page_category_sec_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Category Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),

            array(
                'id'       => 'ronby_blog_page_category_sec_ids',
                'type'     => 'select',
				'data'     => 'categories',
				'multi'    => true,
                'title'    => esc_html__( 'Select Multi Categories', 'ronby' ),
                'subtitle' => esc_html__( '', 'ronby' ),
                'subtitle'     => esc_html__( '', 'ronby' ),
                'default'  => false,
            ),	
			array(
				'id' => 'ronby_blog_page_slider_sec_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Slider Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),	
            array(
                'id'       => 'ronby_blog_page_slider_images_ids',
                'type'     => 'gallery',				
                'title'    => esc_html__( 'Add/Edit Slider Images', 'ronby'),
                'subtitle' => esc_html__( '', 'ronby'),
                'desc'     => esc_html__( '','ronby'),
				
            ),			
			array(
				'id' => 'excerpt_limit',
				'type' => 'text',
				'title' => esc_html__('How many words want to display in post excerpt?', 'ronby'),
				'subtitle' => esc_html__('Example: 50', 'ronby'),
				'default' => '50'
			),			
			array(
				'id' => 'content_limit',
				'type' => 'text',
				'title' => esc_html__('How many words want to display in post content?', 'ronby'),
				'subtitle' => esc_html__('Example: 100', 'ronby'),
				'default' => '100'
			),	
			array(
				'id' => 'word_limit',
				'type' => 'text',
				'title' => esc_html__('How many words want to display for non featured image post content?', 'ronby'),
				'subtitle' => esc_html__('Example: 150', 'ronby'),
				'default' => '150'
			),				
		),
    ) );	
	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Post Settings', 'ronby' ),
		'icon' => 'el el-blogger',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(

			array(
				'id'       => 'ronby_blog_post_layout',
				'type'     => 'radio',
				'title'    => esc_html__('Choose Blog Post Layout', 'ronby'), 
				'subtitle' => esc_html__('', 'ronby'),
				'desc'     => esc_html__('', 'ronby'),
				//Must provide key => value pairs for radio options
				'options'  => array(
					'1' => 'Business Layout', 
					'2' => 'Construction Layout', 
					'3' => 'Fitness Layout',
					'4' => 'Medical Layout',
					'5' => 'Shop Layout',
					'6' => 'Food Layout',
				),
				'default' => '3'
			),		
			array(
				'id' => 'blog_post_header_sec_title_one',
				'type' => 'text',
				'title' => esc_html__('Blog Post Header Section Title One', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			
			array(
				'id' => 'blog_post_header_sec_title_two',
				'type' => 'text',
				'title' => esc_html__('Blog Post Header Section Title Two', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'blog_post_social_share_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Social Share Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),	
			array(
				'id' => 'blog_post_tags_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Tags Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),		
			array(
				'id' => 'blog_post_date_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Date Info Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			
			array(
				'id' => 'blog_post_date_wordpress_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Date Format According Wordpress', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),
			array(
				'id' => 'blog_post_author_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Author Info Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),		
			array(
				'id' => 'blog_post_author_avatar_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Author Avatar Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),			
			array(
				'id' => 'blog_post_comment_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Comment Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'blog_post_category_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Category Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'blog_post_like_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Likes Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),	
			array(
				'id' => 'blog_post_views_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Post Views Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),	
			array(
				'id' => 'blog_post_brand_slider_section',
				'type' => 'switch',
				'title' => esc_html__('On/Off Slider Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),			
			array(
				'id' => 'blog_post_category_section',
				'type' => 'switch',
				'title' => esc_html__('On/Off Category Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),			
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Page Color Settings', 'ronby' ),
		'icon' => 'el el-brush',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_blog_page_pagi_btn_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Pagination Button Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			
			array(
				'id' => 'ronby_blog_page_cat_sec_title_color',
				'type' => 'color',
				'title' => esc_html__('Blog Page Category Section Title Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_blog_page_brand_slider_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Blog Page Brand Slider Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		),	
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Settings', 'ronby' ),
		'icon' => 'el el-cog-alt',
        'subtitle'       => esc_html__( '', 'ronby' ),	
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Header Settings', 'ronby' ),
		'icon' => 'el el-website',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
					array(
				'id' => 'ronby_page_header_layout',
				'type' => 'image_select',
				'title' => esc_html__('Choose Page Header Layout', 'ronby'),
				'options' => array(
					'1'      => array(
						'alt'   => 'Business Layout', 
						'img'   => get_template_directory_uri().'/images/page-header-layouts/business-layout.JPG'
					),
					'2'      => array(
						'alt'   => 'Construction Layout', 
						'img'   => get_template_directory_uri().'/images/page-header-layouts/construction-layout.JPG'
					),					
					'3'      => array(
						'alt'   => 'Fitness Layout', 
						'img'   => get_template_directory_uri().'/images/page-header-layouts/fitness-layout.JPG'
					),
					'4'      => array(
						'alt'   => 'Medical Layout', 
						'img'   => get_template_directory_uri().'/images/page-header-layouts/medical-layout.JPG'
					),
					'5'      => array(
						'alt'   => 'Shop Layout', 
						'img'   => get_template_directory_uri().'/images/page-header-layouts/shop-layout.JPG'
					),	
					'6'      => array(
						'alt'   => 'Food Restaurent Layout', 
						'img'   => get_template_directory_uri().'/images/page-header-layouts/restaurent-layout.JPG'
					),	
					
				),
				'default' => '1'
			),
			array(
				'id' => 'ronby_page_header_section_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Page Header Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),
			array(
				'id' => 'ronby_page_breadcrumb_section_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Page Breadcrumb', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_page_header_sec_bg_image',
				'type' => 'media',
				'title' => esc_html__('Page Header Section Background Image', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
			),	
            array(
                'id'             => 'ronby_page_header_sec_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px'),  
                'units_extended' => true,
				'display_units' => true,
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left				
                'title'          => __( 'Page Header Section Padding Spacing', 'ronby' ),
				'subtitle' => esc_html__('This feature is for Page Header Section', 'ronby'),				
                'default'        => array(
                'padding-top'    => '',
                'padding-bottom' => '',
            ),
            ),			
			array(
				'id' => 'ronby_page_header_sec_overlay_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Page Header Section Overlay Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_page_header_sec_title_one_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Page Header Section Title One Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_page_header_sec_title_two_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Page Header Section Title Two Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_page_header_sec_breadcrumb_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Page Header Section Breadcrumb Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
			array(
				'id' => 'ronby_page_header_sec_breadcrumb_txt_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Page Header Section Breadcrumb Text Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),			
		),	
    ) );	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Color Settings', 'ronby' ),
		'icon' => 'el el-brush',
        'subsection' => true,
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_page_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('All Pages Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_404_btn_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('404 page Button Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_404_btn_hover_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('404 page Button Hover Background Color', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
		),	
    ) );	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'WooCommerce Settings', 'ronby' ),
		'icon' => 'el el-shopping-cart-sign',
        'subtitle'       => esc_html__( '', 'ronby' ),	
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Shop Page Settings', 'ronby' ),
		'icon' => 'el el-shopping-cart',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id'       => 'ronby_shop_page_layout',
				'type'     => 'radio',
				'title'    => esc_html__('Choose Shop Page Layout', 'ronby'), 
				'subtitle' => esc_html__('', 'ronby'),
				'desc'     => esc_html__('', 'ronby'),
				//Must provide key => value pairs for radio options
				'options'  => array(
					'1' => 'Fitness Layout', 
					'2' => 'Food Layout', 
					'3' => 'Fashion Layout',
				),
				'default' => '1'
			),		
			array(
				'id' => 'ronby_shop_page_header_sec_title_one',
				'type' => 'text',
				'title' => esc_html__('Page Header Section Title One', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_shop_page_header_sec_title_two',
				'type' => 'text',
				'title' => esc_html__('Page Header Section Title Two', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_loop_shop_per_page',
				'type' => 'text',
				'title' => esc_html__('How Many Products Want to Show Per Page?', 'ronby'),
				'subtitle' => esc_html__('Example: 8. Note: use -1 to show all products.', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_single_product_placeholder',
				'type' => 'media',
				'title' => esc_html__('Insert Placeholder Image for Non Featured Image Product.', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_single_product_bg_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Background Color for Transparent Image Product', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_woo_product_star_color',
				'type' => 'color_rgba',
				'title' => esc_html__('Color for WooCommerce Star Ratings', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_shop_page_quick_view_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Shop page Products Quick View Button', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Fitness Layout.', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_shop_page_slider_sec_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Slider Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '0'
			),
			array(
				'id'       => 'ronby_woo_product_sale_badge_style',
				'type'     => 'radio',
				'title'    => esc_html__('Choose Sale Badge Style', 'ronby'), 
				'subtitle' => esc_html__('', 'ronby'),
				'desc'     => esc_html__('', 'ronby'),
				//Must provide key => value pairs for radio options
				'options'  => array(
					'1' => 'Style 1', 
					'2' => 'Style 2', 
					'3' => 'Style 3',
				),
				'default' => '1'
			),			
		),	
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Product Page Settings', 'ronby' ),
		'icon' => 'el el-shopping-cart',
        'subsection' => true,		
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'ronby_single_product_header_sec_title_one',
				'type' => 'text',
				'title' => esc_html__('Page Header Section Title One', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),	
			array(
				'id' => 'ronby_single_product_header_sec_title_two',
				'type' => 'text',
				'title' => esc_html__('Page Header Section Title Two', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_single_product_upsells_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Upsells Product Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),
			array(
				'id' => 'ronby_single_product_upsells_limit',
				'type' => 'text',
				'title' => esc_html__('How Many Upsells Products Want to Show?', 'ronby'),
				'subtitle' => esc_html__('Example: 4. Note: use -1 to show all products.', 'ronby'),
				'default' => '',
			),			
			array(
				'id' => 'ronby_single_product_cross_sells_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Cross-sells Product Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_single_product_cross_sells_limit',
				'type' => 'text',
				'title' => esc_html__('How Many Cross-sells Products Want to Show?', 'ronby'),
				'subtitle' => esc_html__('Example: 4. Note: use -1 to show all products.', 'ronby'),
				'default' => '',
			),				
			array(
				'id' => 'ronby_single_product_related_products_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Related Product Section', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_single_product_related_products_limit',
				'type' => 'text',
				'title' => esc_html__('How Many Related Products Want to Show?', 'ronby'),
				'subtitle' => esc_html__('Example: 4. Note: use -1 to show all products.', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'ronby_single_product_related_products_title_1',
				'type' => 'text',
				'title' => esc_html__('Related Products Section Title- 1', 'ronby'),
				'subtitle' =>  '',
				'default' => '',
			),	
			array(
				'id' => 'ronby_single_product_related_products_title_2',
				'type' => 'text',
				'title' => esc_html__('Related Products Section Title- 2', 'ronby'),
				'subtitle' =>  '',
				'default' => '',
			),	
			array(
				'id' => 'ronby_single_product_related_products_desc',
				'type' => 'textarea',
				'title' => esc_html__('Related Products Section Description', 'ronby'),
				'subtitle' =>  '',
				'default' => '',
			),			
			array(
				'id' => 'ronby_single_product_sku_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off SKU Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_single_product_category_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Category Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),			
			array(
				'id' => 'ronby_single_product_tag_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Tag Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_single_product_social_share_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Social Share Meta', 'ronby'),
				'subtitle' => esc_html__('', 'ronby'),
				'default' => '1'
			),
			array(
				'id' => 'ronby_single_product_wishlist_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Wishlist Meta', 'ronby'),
				'subtitle' => esc_html__('This feature will not work untill Enable wishlist functionality. To enable the functionality, Go Woocommerce->Settings->Ronby Wishlist Tab.', 'ronby'),
				'default' => '1'
			),	
			array(
				'id' => 'ronby_single_product_compare_meta_switch',
				'type' => 'switch',
				'title' => esc_html__('On/Off Compare Meta', 'ronby'),
				'subtitle' => esc_html__('This feature will not work untill Enable Compare List functionality. To enable the functionality, Go Woocommerce->Settings->Ronby Compare List Tab.', 'ronby'),
				'default' => '1'
			),			
			array(
				'id' => 'ronby_single_product_brand_slider_section',
				'type' => 'switch',
				'title' => esc_html__('On/Off Slider Section', 'ronby'),
				'subtitle' => esc_html__('This feature is available for Fitness layout.', 'ronby'),
				'default' => '0'
			),			
		),	
    ) );	
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Newsletter Settings', 'ronby' ),
		'icon' => 'el el-envelope-alt',
        'subtitle'       => esc_html__( '', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'mailchimp_apikey',
				'type' => 'text',
				'title' => esc_html__('MailChimp API Key', 'ronby'),
				'subtitle' =>  wp_kses('The unique API Key of your MailChimp account. <a href="'.esc_url('https://mailchimp.com/help/about-api-keys/').'">Find Your API Key!</a>',$allowed_html ),
				'default' => '',
			),
			array(
				'id' => 'mailchimp_listid',
				'type' => 'text',
				'title' => esc_html__('MailChimp List ID', 'ronby'),
				'subtitle' => wp_kses('The unique List ID of your MailChimp account. <a href="'.esc_url('https://mailchimp.com/help/find-your-list-id/').'">Find Your List ID! </a>',$allowed_html ),
				'default' => '',
			),
			array(
				'id' => 'mailchimp_optin',
				'type' => 'switch',
				'title' => esc_html__('On/Off Mailchimp Double Optin', 'ronby'),
				'subtitle' => '',
				'default' => '1',
			),			
			array(
				'id' => '123',
				'type' => 'info',
				'subtitle' => esc_html__('If you want to use Aweber instead of MailChimp use the settings below and keep the above MailChimp fields empty.', 'ronby'),
			),
			array(
				'id' => 'ft_aweber_listid',
				'type' => 'text',
				'title' => esc_html__('Aweber List ID', 'ronby'),
				'subtitle' => esc_html__('The unique List ID of Aweber account', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'aweber_redirectpage',
				'type' => 'text',
				'title' => esc_html__('Redirect Page URL', 'ronby'),
				'subtitle' => esc_html__('Redirect page url after submission of Aweber form', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'aweber_redirectpage_old',
				'type' => 'text',
				'title' => esc_html__('Redirect Page URL for already subscribed users', 'ronby'),
				'subtitle' => esc_html__('Redirect page url for already subscribed users of Aweber', 'ronby'),
				'default' => '',
			),			
		),
    ) );	

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Media Settings', 'ronby' ),
		'icon' => 'el el-group-alt',
        'subtitle'       => esc_html__( 'This is options for setting up the social media of website. Do not forget to use http:// for any social urls.', 'ronby' ),
		'fields' => array(
			array(
				'id' => 'social_facebook',
				'type' => 'text',
				'title' => esc_html__('Facebook URL', 'ronby'),
				'subtitle' => esc_html__('The URL to your account page', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'social_twitter',
				'type' => 'text',
				'title' => esc_html__('Twitter URL', 'ronby'),
				'subtitle' => esc_html__('The URL to your account page', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'social_twitter_username',
				'type' => 'text',
				'title' => esc_html__('Twitter Username', 'ronby'),
				'subtitle' => esc_html__('Example: fluentthemes', 'ronby'),
				'default' => 'fluentthemes',
			),			
			array(
				'id' => 'social_linkedin',
				'type' => 'text',
				'title' => esc_html__('Linkedin URL', 'ronby'),
				'subtitle' => esc_html__('The URL to your account page', 'ronby'),
				'default' => '',
			),
			array(
				'id' => 'social_pinterest',
				'type' => 'text',
				'title' => esc_html__('Pinterest URL', 'ronby'),
				'subtitle' => esc_html__('The URL to your account page', 'ronby'),
				'default' => '',
			),

		),		
    ) );	
    /*
     * <--- END SECTIONS
     */
