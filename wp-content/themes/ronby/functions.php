<?php
function ronby_get_global_themedata() {
    global $ronby_theme_data;
    return $ronby_theme_data;
}
$ronby_themes_data = ronby_get_global_themedata();
$ronby_themes_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );

/* -----------------------------------------------------------------------------
 * Definations
 * -------------------------------------------------------------------------- */
if( !defined('RONBY_ADMIN_PATH') )
	define( 'RONBY_ADMIN_PATH', get_template_directory() . '/framework/admin/' );
if( !defined('RONBY_INIT_PATH') )
	define( 'RONBY_INIT_PATH', get_template_directory() . '/framework/' );
if( !defined('RONBY_GUTENBERG_PATH') )
	define( 'RONBY_GUTENBERG_PATH', get_template_directory() . '/gutenberg/' );
if( !defined('RONBY_INCLUDE_PATH') )
	define( 'RONBY_INCLUDE_PATH', get_template_directory() . '/inc/' );
if( !defined('RONBY_LANGUAGE_PATH') )
	define( 'RONBY_LANGUAGE_PATH', get_template_directory() . '/languages/' );

require_once( RONBY_INIT_PATH . 'init.php' );