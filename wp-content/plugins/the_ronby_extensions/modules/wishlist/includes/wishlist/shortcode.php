<?php

// add shortcode hooks
add_shortcode( 'ronby_woo_wishlist_table', 'ronby_woowishlist_shortcode' );

/**
 * Renders wishlist shortcode.
 *
 * @since 1.0.0
 *
 * @param array $atts The array of shortcode attributes.
 */
function ronby_woowishlist_shortcode( $atts ) {

	$atts = apply_filters( 'shortcode_atts_tm_woo_wishlist_table', $atts );

	return ronby_woowishlist_render( $atts );
}