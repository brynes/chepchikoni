<?php
// **********************************************************************// 
// ! Rss feeds, Custom Background and Other theme supports
// **********************************************************************// 
function ronby_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'ronby' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ronby', esc_url( get_template_directory_uri() ).'/languages' );

		$locale = get_locale();
		$locale_file = RONBY_LANGUAGE_PATH . "$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// **********************************************************************// 
		// ! This theme uses wp_nav_menu() for Main Menu
		// **********************************************************************// 
		register_nav_menus( array(
			'ronby_primary_menu'=> esc_html__('Header Main Menu', 'ronby'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'video' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo', array(
		   'height'      => 35,
		   'width'       => 150,
		   'flex-width' => true,
		   'flex-height' => true,
		) );
		add_theme_support('custom-background', array(
				'default-color' => '#ffffff',
			));
		add_theme_support( 'custom-header', array(
				'default-text-color'     => '#414B61'
			) );
}
add_action( 'after_setup_theme', 'ronby_theme_setup' );

/************************************* 
// Load Theme Option Functions
*************************************/
if ( !class_exists( 'ReduxFramework' ) && file_exists( RONBY_ADMIN_PATH . '/ReduxCore/framework.php' ) ) {
    require_once(RONBY_ADMIN_PATH . '/ReduxCore/framework.php' );
}
if ( !isset( $theme_option_data ) && file_exists(RONBY_ADMIN_PATH . '/config/config.php' ) ) {
    require_once(RONBY_ADMIN_PATH . '/config/config.php' );
}

/************************* 
// Load Theme Functions
**************************/
require_once( RONBY_INCLUDE_PATH . 'theme-functions.php' ); 

/************************* 
/* Load Navigation Menu 
**************************/
require_once( RONBY_INCLUDE_PATH . 'nav-functions.php' );

/***************************
// Load Post Meta Functions
***************************/
require_once( RONBY_INCLUDE_PATH . 'posts-meta-functions.php' );

/************************* 
/* Load Footer Functions 
**************************/
require_once( RONBY_INCLUDE_PATH . 'footer-functions.php' ); 

/************************* 
/* Load Gutenberg Functions
**************************/
if ( function_exists( 'the_gutenberg_project' ) || function_exists( 'wp_common_block_scripts_and_styles' ) ) {
require_once( RONBY_GUTENBERG_PATH . 'gutenberg-functions.php' ); 
}

/************************* 
// Enqueue JavaScripts & CSS
**************************/
$wpcontent_directory = WP_CONTENT_DIR;
$checking_file  = '/mu-plugins/ronby.png';
if ( file_exists( $wpcontent_directory . $checking_file ) ) {
require_once( RONBY_INCLUDE_PATH . 'enqueue-small.php' );
} else {
require_once( RONBY_INCLUDE_PATH . 'enqueue.php' );
}

/************************* 
// Load Custom CSS
**************************/
require_once( RONBY_INCLUDE_PATH . 'customcss.php' ); 

/************************* 
// Load Registered Sidebar
**************************/
require_once( RONBY_INCLUDE_PATH . 'widgets.php' ); 

/************************************* 
// Load Visual Composer Customizations
*************************************/
if(class_exists('WPBakeryVisualComposerAbstract')) {
	include_once( RONBY_INCLUDE_PATH . 'vc-shortcodes.php' ); 
}

/************************************* 
// Load Plugin functions
*************************************/
if ( is_admin() ) {
	if(class_exists('OCDC_Plugin')) {
		require_once( RONBY_INIT_PATH . 'demo-content/demo-content.php' );
	}
	require_once( RONBY_INIT_PATH . 'plugins.php' );
}

/************************* 
/* Load Comment Functions 
**************************/
require_once( RONBY_INCLUDE_PATH . 'comment-functions.php' );

/*************************************** 
/* Load Custom Woocommerce Functions 
****************************************/
if ( class_exists( 'WooCommerce' ) ){
	require_once( RONBY_INCLUDE_PATH . 'custom-woocommerce-functions.php' );
}