<?php

// prevent direct access
if ( !defined( 'ABSPATH' ) ) {

	header( 'HTTP/1.0 404 Not Found', true, 404 );

	exit;
}

// register action hooks
add_action( 'woocommerce_settings_start', 'ronby_woowishlist_register_settings' );
add_action( 'woocommerce_settings_ronby_woowishlist', 'ronby_woowishlist_render_settings_page' );
add_action( 'woocommerce_update_options_ronby_woowishlist', 'ronby_woowishlist_update_options' );

// register filter hooks
add_filter( 'woocommerce_settings_tabs_array', 'ronby_woowishlist_register_settings_tab', PHP_INT_MAX );

/**
 * Returns array of the plugin settings, which will be rendered in the
 * WooCommerce settings tab.
 *
 * @since 1.0.0
 *
 * @return array The array of the plugin settings.
 */
function ronby_woowishlist_get_settings() {

	return array(
		array(
			'id'      => 'general-options',
			'type'    => 'title',
			'title'   => __( 'General Options', 'ronby' ),
		),
		array(
			'type'    => 'checkbox',
			'id'      => 'ronby_woowishlist_enable',
			'title'   => __( 'Enable wishlist', 'ronby' ),
			'desc'    => __( 'Enable wishlist functionality.', 'ronby' ),
			'default' => 'yes',
		),
		array(
			'type'    => 'single_select_page',
			'id'      => 'ronby_woowishlist_page',
			'class'   => 'chosen_select_nostd',
			'title'   => __( 'Select wishlist page', 'ronby' ),
			'desc'    => '<br>' . __( 'Select a page which will display wishlist. Use this <span class="shortcode-bg">[ronby_woo_wishlist_table]</span> shortcode into page to display wishlist table list.', 'ronby' ),
		),
		array(
			'type'    => 'checkbox',
			'id'      => 'ronby_woowishlist_show_in_catalog',
			'title'   => __( 'Show in catalog', 'ronby' ),
			'desc'    => __( 'Enable wishlist button for catalog list.', 'ronby' ),
			'default' => 'yes',
		),
		array(
			'type'    => 'checkbox',
			'id'      => 'ronby_woowishlist_show_in_single',
			'title'   => __( 'Show in products page', 'ronby' ),
			'desc'    => __( 'Enable wishlist button for single product page.', 'ronby' ),
			'default' => 'yes',
		),


		array(
			'type'    => 'select',
			'id'      => 'ronby_woowishlist_cols',
			'title'   => __( 'Wishlist columns', 'ronby' ),
			'desc'    => '<br>' . __( 'Choose a number of columns.', 'ronby' ),
			'default' => '1',
			'options' => array(
				'1'   => '1',
				'2'   => '2',
				'3'   => '3',
				'4'   => '4',
			)
		),

		array(
			'type'    => 'sectionend',
			'id'      => 'general-options'
		),
	);
}

/**
 * Registers plugin settings in the WooCommerce settings array.
 *
 * @since 1.0.0
 * @action woocommerce_settings_start
 *
 * @global array $woocommerce_settings WooCommerce settings array.
 */
function ronby_woowishlist_register_settings() {

	global $woocommerce_settings;

	$woocommerce_settings['ronby_woowishlist'] = ronby_woowishlist_get_settings();
}

/**
 * Registers WooCommerce settings tab which will display the plugin settings.
 *
 * @since 1.0.0
 * @filter woocommerce_settings_tabs_array PHP_INT_MAX
 *
 * @param array $tabs The array of already registered tabs.
 * @return array The extended array with the plugin tab.
 */
function ronby_woowishlist_register_settings_tab( $tabs ) {

	$tabs['ronby_woowishlist'] = esc_html__( 'Ronby Wishlist', 'ronby' );

	return $tabs;
}

/**
 * Renders plugin settings tab.
 *
 * @since 1.0.0
 * @action woocommerce_settings_ronby_woowishlist
 *
 * @global array $woocommerce_settings The aggregate array of WooCommerce settings.
 * @global string $current_tab The current WooCommerce settings tab.
 */
function ronby_woowishlist_render_settings_page() {

	global $woocommerce_settings, $current_tab;

	if ( function_exists( 'woocommerce_admin_fields' ) ) {

		woocommerce_admin_fields( $woocommerce_settings[$current_tab] );
	}
}

/**
 * Updates plugin settings after submission.
 *
 * @since 1.0.0
 * @action woocommerce_update_options_ronby_woowishlist
 */
function ronby_woowishlist_update_options() {

	if ( function_exists( 'woocommerce_update_options' ) ) {

		woocommerce_update_options( ronby_woowishlist_get_settings() );
	}
}