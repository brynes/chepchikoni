<?php
/**
 * Renders appropriate button for a loop product.
 *
 * @since 1.0.0
 * @action woocommerce_after_shop_loop_item
 */
function tm_woocompare_add_button_loop( $args ) {

	if ( 'yes' === get_option( 'tm_woocompare_show_in_catalog' ) ) {

		tm_woocompare_add_button( $args );
	}
}

/**
 * Renders appropriate button for a product.
 *
 * @since 1.0.0
 */
 $redux=get_option( 'theme_option_data' );
 if($redux['ronby_shop_page_layout']==1 || $redux['ronby_shop_page_layout']==2){
function tm_woocompare_add_button( $args ) {

	$id      = get_the_ID();
	$id      = tm_wc_compare_wishlist()->get_original_product_id( $id );
	$classes = array(  'tm-woocompare-button','ronby-woocompare-button' );
	$nonce   = wp_create_nonce( 'tm_woocompare' . $id );

	if ( in_array( $id, tm_woocompare_get_list() ) ) {

		$text      = get_option( 'tm_woocompare_remove_text', __( 'Remove from Compare', 'ronby' ) );
		$classes[] = ' in_compare';

	} else {

		$text = get_option( 'tm_woocompare_compare_text','' );
	}
	$text      = '<span class="tm_woocompare_product_actions_tip"><i class="fas fa-retweet"></i></span>';
	$preloader = apply_filters( 'tm_wc_compare_wishlist_button_preloader', '' );

	if( $single = ( is_array( $args ) && isset( $args['single'] ) && $args['single'] ) ) {

		$classes[] = 'tm-woocompare-button-single';
	}

	$html = sprintf( '<button type="button" class="%s" data-id="%s" data-nonce="%s">%s</button>', implode( ' ', $classes ), $id, $nonce, $text . $preloader );

	echo apply_filters( 'tm_woocompare_button', $html, $classes, $id, $nonce, $text, $preloader );

	if( in_array( $id, tm_woocompare_get_list() ) && $single ) {

		echo tm_woocompare_page_button();
	}
}	 
 }elseif($redux['ronby_shop_page_layout']==3){
function tm_woocompare_add_button( $args ) {

	$id      = get_the_ID();
	$id      = tm_wc_compare_wishlist()->get_original_product_id( $id );
	$classes = array(  'tm-woocompare-button','ronby-woocompare-button' );
	$nonce   = wp_create_nonce( 'tm_woocompare' . $id );

	if ( in_array( $id, tm_woocompare_get_list() ) ) {

		$text      = get_option( 'tm_woocompare_remove_text', __( 'Remove from Compare', 'ronby' ) );
		$classes[] = ' in_compare';

	} else {

		$text = get_option( 'tm_woocompare_compare_text','' );
	}
	$text      = '<span class="tm_woocompare_product_actions_tip"><i class="fas fa-retweet"></i> Compare product</span>';
	$preloader = apply_filters( 'tm_wc_compare_wishlist_button_preloader', '' );

	if( $single = ( is_array( $args ) && isset( $args['single'] ) && $args['single'] ) ) {

		$classes[] = 'tm-woocompare-button-single';
	}
	$html='<div class="compare-product-button">';
	$html .= sprintf( '<button type="button" class="%s" data-id="%s" data-nonce="%s">%s</button>', implode( ' ', $classes ), $id, $nonce, $text . $preloader );
	$html .='</div>';
	echo apply_filters( 'tm_woocompare_button', $html, $classes, $id, $nonce, $text, $preloader );

	if( in_array( $id, tm_woocompare_get_list() ) && $single ) {

		echo tm_woocompare_page_button();
	}
}	 
 }


/**
 * Renders appropriate button for a single product.
 *
 * @since 1.0.0
 * @action woocommerce_single_product_summary
 */
function tm_woocompare_add_button_single( $args ) {

	if ( 'yes' === get_option( 'tm_woocompare_show_in_single' ) ) {

		if( empty( $args ) ) {

			$args = array();
		}
		$args['single'] = true;

		tm_woocompare_add_button( $args );
	}
}

/**
 * Renders wishlist page button for a product.
 *
 * @since 1.0.0
 */
 $redux=get_option( 'theme_option_data' );
 if($redux['ronby_shop_page_layout']==1 || $redux['ronby_shop_page_layout']==2){
function tm_woocompare_page_button() {

	$link    = tm_woocompare_get_page_link();
	$classes = array( 'hover-background-primary  ronby-view-compare-btn');
	$text    = '<i class="fas fa-clipboard-list"></i>';
	$html    = sprintf( '<a class="%s" href="%s">%s</a>', implode( ' ', $classes ), $link, $text );

	return apply_filters( 'tm_woocompare_page_button', $html, $classes, $link, $text );
}	 
}elseif($redux['ronby_shop_page_layout']==3){
function tm_woocompare_page_button() {

	$link    = tm_woocompare_get_page_link();
	$classes = array( 'button rounded-capsule animate-400 hover-background-primary hover-color-white ml-2 ronby-view_wishlist-btn mt-3');
	$text    = esc_html__( 'View compare', 'ronby' );
	$html    = sprintf( '<a class="%s" href="%s">%s</a>', implode( ' ', $classes ), $link, $text );

	return apply_filters( 'tm_woocompare_page_button', $html, $classes, $link, $text );
}	 
} 
