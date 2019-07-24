<?php
/**
 * Renders appropriate button for a loop product.
 *
 * @since 1.0.0
 * @action woocommerce_after_shop_loop_item
 */
function ronby_woowishlist_add_button_loop( $args ) {

	if ( 'yes' === get_option( 'ronby_woowishlist_show_in_catalog' ) ) {

		ronby_woowishlist_add_button( $args );
	}
}

/**
 * Renders appropriate button for a product.
 *
 * @since 1.0.0
 */
$redux=get_option( 'theme_option_data' );
 if($redux['ronby_shop_page_layout']==1 || $redux['ronby_shop_page_layout']==2){
function ronby_woowishlist_add_button( $args ) {

	$id      = get_the_ID();
	$id      = tm_wc_compare_wishlist()->get_original_product_id( $id );
	$classes = array( 'tm-woowishlist-button',  'hover-background-primary' );
	$nonce   = wp_create_nonce( 'ronby_woowishlist' . $id );

	if ( in_array( $id, ronby_woowishlist_get_list() ) ) {

		$text      = get_option( 'ronby_woowishlist_added_text', __( 'Added to Wishlist', 'ronby' ) );
		$classes[] = ' in_wishlist';

	} else {

		$text = get_option( 'ronby_woowishlist_add_text','');
	}
	$text      = '<span class="ronby_woowishlist_product_actions_tip"><i class="fas fa-heart"></i></span>';
	$preloader = apply_filters( 'tm_wc_compare_wishlist_button_preloader', '' );

	if( $single = ( is_array( $args ) && isset( $args['single'] ) && $args['single'] ) ) {

		$classes[] = 'tm-woowishlist-button-single';
	}
	$html = sprintf( '<button type="button" class="%s" data-id="%s" data-nonce="%s">%s</button>', implode( ' ', $classes ), $id, $nonce, $text . $preloader );

	echo apply_filters( 'ronby_woowishlist_button', $html, $classes, $id, $nonce, $text, $preloader );

	if ( in_array( $id, ronby_woowishlist_get_list() ) && $single ) {

		echo ronby_woowishlist_page_button();
	}
}	 
 }elseif($redux['ronby_shop_page_layout']==3){
function ronby_woowishlist_add_button( $args ) {

	$id      = get_the_ID();
	$id      = tm_wc_compare_wishlist()->get_original_product_id( $id );
	$classes = array( 'tm-woowishlist-button',  'button button-circle animate-400 hover-background-primary hover-color-white ml-2' );
	$nonce   = wp_create_nonce( 'ronby_woowishlist' . $id );

	if ( in_array( $id, ronby_woowishlist_get_list() ) ) {

		$text      = get_option( 'ronby_woowishlist_added_text', __( 'Added to Wishlist', 'ronby' ) );
		$classes[] = ' in_wishlist';

	} else {

		$text = get_option( 'ronby_woowishlist_add_text','');
	}
	$text      = '<span class="ronby_woowishlist_product_actions_tip"><i class="fas  fa-heart"></i></span>';
	$preloader = apply_filters( 'tm_wc_compare_wishlist_button_preloader', '' );
	if( $single = ( is_array( $args ) && isset( $args['single'] ) && $args['single'] ) ) {

		$classes[] = 'tm-woowishlist-button-single';
	}
	$html = sprintf( '<button type="button" class="%s" data-id="%s" data-nonce="%s">%s</button>', implode( ' ', $classes ), $id, $nonce, $text . $preloader );

	echo apply_filters( 'ronby_woowishlist_button', $html, $classes, $id, $nonce, $text, $preloader );

	if ( in_array( $id, ronby_woowishlist_get_list() ) && $single ) {

		echo ronby_woowishlist_page_button();
	}
}	 
 }


/**
 * Renders appropriate button for a single product.
 *
 * @since 1.0.0
 * @action woocommerce_single_product_summary
 */
function ronby_woowishlist_add_button_single( $args ) {

	if ( 'yes' === get_option( 'ronby_woowishlist_show_in_single' ) ) {

		if( empty( $args ) ) {

			$args = array();
		}
		$args['single'] = true;

		ronby_woowishlist_add_button( $args );
	}
}

/**
 * Renders wishlist page button for a product.
 *
 * @since 1.0.0
 */
if($redux['ronby_shop_page_layout']==1 || $redux['ronby_shop_page_layout']==2){
function ronby_woowishlist_page_button( $classes = array() ) {

	$link = ronby_woowishlist_get_page_link();

	if( ! $link ) {

		return;
	}

	$classes = array_merge( $classes,  array( 'hover-background-primary ronby-view_wishlist-btn' ) );
	
	$text    =  '<i class="fas fa-list"></i>';
	$html    = sprintf( '<a class="%s" href="%s">%s</a>', implode( ' ', $classes ), $link, $text );

	return apply_filters( 'ronby_woowishlist_page_button', $html, $classes, $link, $text );

}	
}elseif($redux['ronby_shop_page_layout']==3){
function ronby_woowishlist_page_button( $classes = array() ) {

	$link = ronby_woowishlist_get_page_link();

	if( ! $link ) {

		return;
	}

	$classes = array_merge( $classes,  array( 'button rounded-capsule animate-400 hover-background-primary hover-color-white ml-2 ronby-view_wishlist-btn' ) );
	
	$text    =  esc_html__( 'View wishlist', 'ronby' );
	$html    = sprintf( '<a class="%s" href="%s">%s</a>', implode( ' ', $classes ), $link, $text );

	return apply_filters( 'ronby_woowishlist_page_button', $html, $classes, $link, $text );

}	
}
