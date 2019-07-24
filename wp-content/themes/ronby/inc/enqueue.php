<?php
function ronby_scripts_basic()
{
    global $post;
    /* ------------------------------------------------------------------------ */
    /* Enqueue Template scripts  */
    /* ------------------------------------------------------------------------ */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.3', true);       
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
	
	if ( (isset($_COOKIE['ft_sticky_menu']) && (int)$_COOKIE['ft_sticky_menu']!=3) || (!isset($_COOKIE['ft_sticky_menu'])) ) {
	if ( (isset($_COOKIE['ft_sticky_menu']) && (int)$_COOKIE['ft_sticky_menu']==1) || ((!isset($_COOKIE['ft_sticky_menu'])) && (ronby_get_option('ronby_sticky_menu_switch') == 1)) ) {
		wp_enqueue_script('ronby-navigation-sticky-one', get_template_directory_uri() . '/js/navigation-sticky-one.js', array('jquery'), '1.0.0', true);
	} elseif ( (isset($_COOKIE['ft_sticky_menu']) && (int)$_COOKIE['ft_sticky_menu']==2) || ((!isset($_COOKIE['ft_sticky_menu'])) && (ronby_get_option('ronby_sticky_menu_switch') == 2)) ) {
		wp_enqueue_script('ronby-navigation-sticky-two', get_template_directory_uri() . '/js/navigation-sticky-two.js', array('jquery'), '1.0.0', true);
	}
	}
	
	if( (isset($_COOKIE['ft_footer_type']) && (int)$_COOKIE['ft_footer_type']==1) || ((!isset($_COOKIE['ft_footer_type'])) && (ronby_get_option('ronby_sticky_footer_switch') == 1)) ) {
		wp_enqueue_script( 'waypoints-v4', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), '1.0.0', true );	
		wp_enqueue_script('inview', get_template_directory_uri() . '/js/inview.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('ronby-inview-custom', get_template_directory_uri() . '/js/inview-custom.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_restaurant_products_tab_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_projects_tab_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_projects_tab_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_projects_grid_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fitness_photo_gallery_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_service_tab_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_projects_tab_section_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_restaurant_products_tab_section_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_restaurant_products_tab_section_three'))) {
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
		wp_enqueue_script('ronby-custom-isotope', get_template_directory_uri() . '/js/custom-isotope.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_counter_section'))) {
		wp_enqueue_script('counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_fitness_brand_slider')) ||
	ronby_get_option('ronby_blog_page_slider_sec_switch') == 1 || ronby_get_option('blog_post_brand_slider_section') == 1 ||
	ronby_get_option('ronby_shop_page_slider_sec_switch') == 1 ||
	ronby_get_option('ronby_single_product_brand_slider_section') == 1) {
		wp_enqueue_script('ronby-brand-carousel-slider-custom', get_template_directory_uri() . '/js/brand-carousel-slider-custom.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_event_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fashion_best_deal_sec'))) {
		wp_enqueue_script('countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.1.0', true);
		wp_enqueue_script('ronby-countdown-style-custom', get_template_directory_uri() . '/js/countdown-style-custom.js', array('jquery', 'countdown'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_fitness_counter_box_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_counter_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_counter_section'))) {
		wp_enqueue_script('ronby-count-up-number-custom', get_template_directory_uri() . '/js/count-up-number-custom.js', array('jquery'), '1.0.0', true);
	}
	
    wp_enqueue_script('ronby-custom-number-input-custom-script', get_template_directory_uri() . '/js/custom-number-input-custom-script.js', array('jquery'), '1.0.0', true);	
    wp_enqueue_script('ronby-hidden-search-form-custom', get_template_directory_uri() . '/js/hidden-search-form-custom.js', array('jquery'), '1.0.0', true);
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_testimonial_slider')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fitness_testimonial_slider'))) {
		wp_enqueue_script('ronby-testimonial-slider-4-custom-script', get_template_directory_uri() . '/js/testimonial-slider-4-custom-script.js', array( 'jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fitness_testimonial_slider_two'))) {
		wp_enqueue_script('ronby-testimonial-slider-5-custom-script', get_template_directory_uri() . '/js/testimonial-slider-5-custom.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_video_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_portfolio_sec'))) {
		wp_enqueue_script('mognific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery'), '1.1.0', true);
		wp_enqueue_script('ronby-custom-magnific-popup', get_template_directory_uri() . '/js/custom-magnific-popup.js', array( 'jquery'), '1.1.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_doctors_slider'))) {
		wp_enqueue_script('ronby-post-carousel-2-custom-script', get_template_directory_uri() . '/js/post-carousel-2-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_service_slider'))) {
		wp_enqueue_script('ronby-post-carousel-3-custom-script', get_template_directory_uri() . '/js/post-carousel-3-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_project_details_section'))) {
		wp_enqueue_script('ronby-project-detail-carousel-slider-custom-script', get_template_directory_uri() . '/js/project-detail-carousel-slider-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_company_ranking_progress')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_bmi_weight_calculator')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_data_table'))) {
		wp_enqueue_script('ronby-tab-filter-custom-script', get_template_directory_uri() . '/js/tab-filter-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_testimonial_slider'))) {
		wp_enqueue_script('ronby-testimonial-slider-1-custom-script', get_template_directory_uri() . '/js/testimonial-slider-1-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_testimonial_slider')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_shop_testimonial_slider'))) {
		wp_enqueue_script('ronby-testimonial-slider-2-custom-script', get_template_directory_uri() . '/js/testimonial-slider-2-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_team_details')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_service_details'))) {
		wp_enqueue_script('ronby-testimonial-slider-3-custom-script', get_template_directory_uri() . '/js/testimonial-slider-3-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	wp_enqueue_script('ronby-toggle-custom-script', get_template_directory_uri() . '/js/toggle-custom-script.js', array('jquery'), '1.0.0', true);
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_food_category')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_projects_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_projects_grid_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_photo_gallery')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_food_gallery_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_food_category_two'))) {
		wp_dequeue_script('masonry'); //Dequeuing older version of masonry (v3.3.2) enqueued by WordPress
		wp_enqueue_script('masonry-latest', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '4.2.2', true); //Now enqueuing latest version (v4.2.2) of masonry	
		wp_enqueue_script('ronby-masonry-custom-script', get_template_directory_uri() . '/js/masonry-custom-script.js', array('jquery'), '1.0.0', true);
	}
	
	if (is_single()) {
		wp_enqueue_script('ronby-like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );
		wp_localize_script('ronby-like_post', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
		wp_enqueue_script('ronby-fontstar-js', get_template_directory_uri().'/js/ronby.fontstar.js', array('jquery'), '1.0', true );	
	}
	
	if (ronby_get_option('ronby_shop_page_layout') == 1 || ronby_get_option('ronby_shop_page_layout') == 2 ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_fitness_woo_products_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_projects_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_project_details_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_image_gallery')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fitness_photo_gallery_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_photo_gallery')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_food_gallery_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fashion_woo_products_two_section'))) {
		wp_enqueue_script('lightbox', get_template_directory_uri().'/js/lightbox/js/lightbox.js', array('jquery'), '2.10.0', true );	
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fashion_category_slider'))) {
		wp_enqueue_script('ronby-product-category-slider', get_template_directory_uri().'/js/fashion-category-slider.js', array('jquery'), '1.0', true );
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_products_slider'))) {
		wp_enqueue_script('ronby-restaurant-products-slider', get_template_directory_uri().'/js/restaurant_products_slider.js', array('jquery'), '1.0', true );
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_portfolio_slider_one'))) {
		wp_enqueue_script('ronby-portfolio-slider-one-custom', get_template_directory_uri().'/js/portfolio-slider-one-custom.js', array('jquery'), '1.0', true );
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_portfolio_sec'))) {
		wp_enqueue_script('ronby-pbar', get_template_directory_uri() . '/js/pbar.js', array( 'jquery' ), '1.0.0', true);	
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_shop_products_slider'))) {
		wp_enqueue_script('ronby-shop-product-slider-custom', get_template_directory_uri() . '/js/shop-products-slider-custom.js', array('jquery'), '1.0.0', true);
	}
		
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcodes_for_accordion_one'))) {
		wp_enqueue_script( 'smk-accordion', get_template_directory_uri() . '/js/accordion/js/smk-accordion.js', array('jquery'), '1.3', true );
		wp_enqueue_script( 'ronby-accordion-custom', get_template_directory_uri() . '/js/accordion/js/custom.js', array('jquery'), '1.0', true );
	}
	if ( (get_the_title()=='Animations') || (get_the_title()=='Counters') ) {
		wp_enqueue_script( 'animations', get_template_directory_uri() . '/js/animations/js/animations.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/animations/js/appear.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '2.0.3', true );	
	}
	
	// DATEPICKER
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_restaurant_reservation_form')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_appoint_form'))) {
		wp_enqueue_script('bootstrap-datepicker', get_template_directory_uri().'/js/bootstrap-datepicker.min.js', array('jquery'), '1.8.0', true );
	}
	
	if((is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'ronby_shortcode_for_bmi_weight_calculator'))){
		wp_enqueue_script('ronby-anim-headlines', get_template_directory_uri().'/js/animated-headlines.js', array('jquery'), '1.0', true );
	}
	
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fitness_nearby_gyms'))) {
		wp_enqueue_script('ronby-nearby_gyms', get_template_directory_uri().'/js/nearby_gyms_custom.js', array('jquery'), '1.0', true );
	}
}
add_action('wp_enqueue_scripts', 'ronby_scripts_basic');

function ronby_styles_basic()
{
    /* ------------------------------------------------------------------------ */
    /* Enqueue Stylesheets */
    /* ------------------------------------------------------------------------ */
	global $post;
    /* Fonts */
    wp_enqueue_style('ronby-custom-google-fonts-arimo_montserrat_poppins', ronby_custom_google_fonts_arimo_montserrat_poppins(), array(), false, 'all');
	if( ronby_get_option('ronby_site_layout_style') == 6 ){
		wp_enqueue_style('ronby-custom-google-fonts-josefin-sans', ronby_custom_google_fonts_josefin_sans_cookie(), array(), false, 'all');
	} //Rev slider imports fonts on their own. So, when rev slider is used in a page, this enqueue can be OFF
	if( ronby_get_option('ronby_site_layout_style') == 4 ) {
		wp_enqueue_style('ronby-custom-google-fonts-arvo', ronby_custom_google_fonts_arvo(), array(), false, 'all');
	}
    /* Bootstrap */
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    /* Template Styles */
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/fonts/font-awesome/css/fontawesome-all.min.css');
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style('owl.theme.default', get_template_directory_uri() . '/css/owl.theme.default.min.css');
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_video_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_portfolio_sec'))) {
		wp_enqueue_style('ronby-custom-magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css');
	}
    /*Main Stylesheet*/
    wp_enqueue_style('ronby-main-stylesheet', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('ronby-sidebar-widgets', get_template_directory_uri() . '/css/widget.css');
	wp_enqueue_style('ronby-nav-only', get_template_directory_uri() . '/css/nav-only.css');
	wp_enqueue_style('ronby-mobile', get_template_directory_uri() . '/css/mobile.css');
    /*Gutenberg Only*/
    if (function_exists('the_gutenberg_project') || function_exists('wp_common_block_scripts_and_styles')) {
        wp_enqueue_style('ronby-gutenberg-additions', get_template_directory_uri() . '/gutenberg/css/gutenberg-additions.css'); // Gutenberg CSS
    }
	/*layout wise shop css called*/
	if(ronby_get_option('ronby_shop_page_layout')==1){	
		wp_enqueue_style('ronby-fitness-shop-layout', get_template_directory_uri() . '/css/fitness-layout.css');			
	}elseif(ronby_get_option('ronby_shop_page_layout')==2){
		wp_enqueue_style('ronby-food-shop-layout', get_template_directory_uri() . '/css/food-layout.css');		
	}elseif(ronby_get_option('ronby_shop_page_layout')==3){
		wp_enqueue_style('ronby-fashion-shop-layout', get_template_directory_uri() . '/css/shop-layout.css');	
	}
	if (ronby_get_option('ronby_shop_page_layout') == 1 || ronby_get_option('ronby_shop_page_layout') == 2 ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_fitness_woo_products_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_projects_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_construction_project_details_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_image_gallery')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fitness_photo_gallery_grid')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_photo_gallery')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_restaurant_food_gallery_two')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_fashion_woo_products_two_section'))) {
		wp_enqueue_style('fitness-lightbox', get_template_directory_uri() . '/js/lightbox/css/lightbox.css');	
	}
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_business_portfolio_sec'))) {
		wp_enqueue_style( 'ronby-b-portfolio', get_template_directory_uri() . '/css/business-portfolio.css');
	}
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_portfolio_slider_one'))) {
		wp_enqueue_style('bootstrap-datepicker', get_template_directory_uri() . '/css/pr-slider-one.css');
	}
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcodes_for_accordion_one'))) {
		wp_enqueue_style( 'smk-accordion', get_template_directory_uri() . '/js/accordion/css/smk-accordion.css');
	}
	if ( (get_the_title()=='Animations') ) {
		wp_enqueue_style( 'animation', get_template_directory_uri() . '/js/animations/css/animations.min.css');
	}
	// DATEPICKER
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_ronby_restaurant_reservation_form')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_medical_appoint_form'))) {
		wp_enqueue_style('bootstrap-datepicker', get_template_directory_uri() . '/css/bootstrap-datepicker.min.css');
	}
	
	//Hover Effect Css
	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_shop_brands_section')) ||
	(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_shop_call_to_action'))) {
		wp_enqueue_style('ronby-hovering', get_template_directory_uri() . '/css/hovering.css');
	}

	if ((is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ronby_shortcode_for_shop_feature_box'))) {
		wp_enqueue_style('ronby-shop-fbox', get_template_directory_uri() . '/css/shop-fbox.css');
	}
}
add_action('wp_enqueue_scripts', 'ronby_styles_basic', 1);

function ronby_enqueue_comment_reply()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('comment_form_before', 'ronby_enqueue_comment_reply');