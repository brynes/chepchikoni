<?php
   // **********************************************************************// 
   // ! Function is_woocommerce_activated
   // **********************************************************************//
   if ( ! function_exists( 'is_woocommerce_activated' ) ) {
   	function is_woocommerce_activated() {
   		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
   	}
   }
   
   // **********************************************************************// 
   // ! Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages
   // **********************************************************************//
   add_action( 'wp_enqueue_scripts', 'fthemes_optimize_woocommerce_styles', 99 );
   function fthemes_optimize_woocommerce_styles() {
   
   	//first check that woo exists to prevent fatal errors
   	if ( function_exists( 'is_woocommerce' ) ) {
   		//dequeue scripts and styles
   		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
   			# Styles
               wp_dequeue_style( 'woocommerce-general' );
               wp_dequeue_style( 'woocommerce-layout' );
               wp_dequeue_style( 'woocommerce-smallscreen' );
               wp_dequeue_style( 'woocommerce_frontend_styles' );
               wp_dequeue_style( 'woocommerce_fancybox_styles' );
               wp_dequeue_style( 'woocommerce_chosen_styles' );
               wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
               # Scripts
               wp_dequeue_script( 'wc_price_slider' );
               wp_dequeue_script( 'wc-single-product' );
               wp_dequeue_script( 'wc-add-to-cart' );
               wp_dequeue_script( 'wc-cart-fragments' );
               wp_dequeue_script( 'wc-checkout' );
               wp_dequeue_script( 'wc-add-to-cart-variation' );
               wp_dequeue_script( 'wc-single-product' );
               wp_dequeue_script( 'wc-cart' );
               wp_dequeue_script( 'wc-chosen' );
               wp_dequeue_script( 'woocommerce' );
               wp_dequeue_script( 'prettyPhoto' );
               wp_dequeue_script( 'prettyPhoto-init' );
               wp_dequeue_script( 'jquery-blockui' );
               wp_dequeue_script( 'jquery-placeholder' );
               wp_dequeue_script( 'fancybox' );
               wp_dequeue_script( 'jqueryui' );
   		}
   		if(is_shop() || is_product() || is_product_category() || is_product_taxonomy()){
   			wp_dequeue_style( 'woocommerce-general' );
   		}

   	}
   
   }
   
   // **********************************************************************// 
   // ! Declare WooCommerce support in third party theme
   // **********************************************************************//
   add_action( 'after_setup_theme', 'ronby_woocommerce_support' );
   function ronby_woocommerce_support() {
   	
       add_theme_support( 'woocommerce', array(
           'product_grid'          => array(
               'default_rows'    => 3,
               'min_rows'        => 2,
               'max_rows'        => 8,
               'default_columns' => 4,
               'min_columns'     => 2,
               'max_columns'     => 5,
           ),
       ) );
       add_theme_support( 'wc-product-gallery-zoom' );
       add_theme_support( 'wc-product-gallery-lightbox' );
       add_theme_support( 'wc-product-gallery-slider' );
   }  
   
   
   /**
    * Change number of products that are displayed per page (shop page)
    */
   add_filter( 'loop_shop_per_page', 'ronby_loop_shop_per_page', 20 );
   function ronby_loop_shop_per_page( $cols ) {	
     // $cols contains the current number of products per page based on the value stored on Options -> Reading
     // Return the number of products you wanna show per page.
     $number_of_product= filter_var(ronby_get_option('ronby_loop_shop_per_page'), FILTER_SANITIZE_NUMBER_INT);
     if($number_of_product){
   	$cols = $number_of_product;  
     }else{
     $cols = 8;
     }
     return $cols;
   }
   
   
   /***************************************
   If Shop Page Layout is set to Shop Layout
   ****************************************/
   if(ronby_get_option('ronby_shop_page_layout')==3){
   
   /* Remove unnessary action from shop page */
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
   remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
   remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
   
   // **********************************************************************// 
   // ! Add page header function in shop page before content 
   // **********************************************************************//
   add_action( 'woocommerce_before_main_content', 'ronby_before_main_content_shop_page', 5 );
   function ronby_before_main_content_shop_page() {
       // Only on "shop" archives pages
       if(is_shop()  || is_product_category() || is_product_taxonomy()){
   	echo ronby_page_heading_function();
   echo '<div id="content" class="p-125-0-110 shop_layout">
      <div id="pagiloader" class="pagiloader"><img src="'. esc_url(get_template_directory_uri().'/images/blog-loader.gif') .'" class="img-responsive" alt="'.esc_attr__('blog-pagination-loader','ronby').'"/></div>
      <div class="content">
   		<div class="container">
   			<!-- Products -->
   			<div class="row">';		
   	}
   
   }
   
   // **********************************************************************// 
   // ! Add  function in shop page  after content 
   // **********************************************************************//
   add_action( 'woocommerce_after_main_content', 'ronby_after_main_content_shop_page', 15 );
   function ronby_after_main_content_shop_page() {
   if(is_shop()  || is_product_category() || is_product_taxonomy()){	
   echo '</div></div></div></div>';
   }
   }
   
   // Get Texnomy/category description
   add_action( 'woocommerce_archive_description', 'ronby_woo_product_archive_desc', 10 );
   function ronby_woo_product_archive_desc(){
   if(is_product_category() || is_product_taxonomy()){
    $cat = get_queried_object();	 
    $catID = $cat->term_id;
    
    global $product;
    echo"<div class='row mb-5'><div class='col-md-12'>";
    echo category_description($catID);
    echo "</div></div>";	
    }
   }
   	
   // Remove woocommerce_breadcrumb
   remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
   
   // Remove woocommerce_show_page_title
   add_filter( 'woocommerce_show_page_title' , '__return_false' );
   
   // Remove woocommerce_sidebar
   remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
   
   // Remove the result count from WooCommerce
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
   
   // Remove the sorting dropdown from Woocommerce
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
   remove_action( 'woocommerce_shop_loop' , '__return_false' );
   
   // Remove the woocommerce_shop_loop_item_title
   remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
   
   // remove the woocommerce_shop_loop_item_title
   add_action('woocommerce_shop_loop_item_title', 'Change_Products_Title', 10 );
   function Change_Products_Title() {
       return false;
   }
     
   //remove output_content_wrapper
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
   
   //remove output_content_wrapper_end
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
   
   //remove product product link
   remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
   
   //remove product product link
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
   
   //remove product add-to-cart
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
   
   //add product wrapper
   add_action( 'woocommerce_before_shop_loop_item', 'product_article_wrapper_before', 15 ); 
   function product_article_wrapper_before() {
   echo '<!-- Product-item -->
   	<div class="col-md-12">
   	<article class="product-item-4">';
   }
   
   //add product wrapper
   add_action( 'woocommerce_after_shop_loop_item', 'product_article_wrapper_after', 15 );
   function product_article_wrapper_after() {
   echo '</article></div>';
   }
   
   //remove shop page product price
   remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
   
   //remove product thumbnail
   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
   
   // Remove the product rating display on product loops
   remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
   
   //Change Sell Badge filter
   add_filter('woocommerce_sale_flash', 'ronby_change_sale_content', 10, 3);
   function ronby_change_sale_content($content, $post, $product){
	if(ronby_get_option('ronby_woo_product_sale_badge_style') == 1){   
	$content= '<div class="ribbon">
			  <div class="ribbon-wrap">
				<span class="ribbon6 item-badge-red">'.esc_attr__('Sale','ronby').'</span>
			  </div>
			</div>';
	}elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 2){		
	$content= '<div class="ribbon">
				<span class="ribbon1 text-white"><span>'.esc_attr__('Sale','ronby').'</span></span>
			</div>';
	}elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 3){
	$content= '<div class="ribbon">
				<span class="ribbon2 text-white">'.esc_attr__('S','ronby').'<br>'.esc_attr__('A','ronby').'<br>'.esc_attr__('L','ronby').'<br>'.esc_attr__('E','ronby').'</span>
			</div>';		
	}
      return $content;
   }
   
   // Ajax add to cart button function
   function ronby_add_to_cart_button() {
       global $product;
       $classes = implode( ' ',  array(
           'button',
           'product_type_' . $product->get_type(),
           $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
           $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
       )  );
   
       return apply_filters( 'woocommerce_loop_add_to_cart_link',
           sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s  button-default hover-background-primary rounded-capsule">%s <img src="'.esc_url(get_template_directory_uri()).'/images/add-to-cart.gif"  class="cart-loader display-none" alt="'.esc_attr__('add-to-cart-loader','ronby').'"/><img src="'.esc_url(get_template_directory_uri()).'/images/added-to-cart.png?a='.esc_attr(rand()).'"  class="added-cart-loader display-none"  alt="'.esc_attr__('added-to-cart-loader','ronby').'"/></a>',
               esc_url( $product->add_to_cart_url() ),
               esc_attr( $product->get_id() ),
               esc_attr( $product->get_sku() ),
               esc_attr( isset( $quantity ) ? $quantity : 1 ),
               esc_attr( isset( $classes ) ? $classes : 'button' ),
               esc_attr( $product->get_type() ),
               esc_html( $product->add_to_cart_text() )
           ),
       $product );
   }
   
   //Change add to cart button text in shop page
   add_filter('woocommerce_product_add_to_cart_text', 'ronby_custom_cart_button_text_shop_page');
   function ronby_custom_cart_button_text_shop_page() {
   return esc_html__('Shop now', 'ronby');
   }
   
   //Change add to cart button text in single product
   add_filter('woocommerce_product_single_add_to_cart_text', 'ronby_custom_cart_button_text_single_product');
   function ronby_custom_cart_button_text_single_product() {
   return esc_html__('Shop now', 'ronby');
   }
   
   // Ensure cart contents update when products are added to the cart via AJAX 
   add_filter( 'woocommerce_add_to_cart_fragments', 'ronby_cart_count_fragments', 10, 1 );
   function ronby_cart_count_fragments( $fragments ) {  
   if((WC()->cart->get_cart_contents_count()) <= 1 ){
   	$item= esc_attr__(' Item','ronby');
   	}else{
   	$item= esc_attr__(' Items','ronby');
   	} 	
       $fragments['.cart-badge'] = '<span class="badge bg-secondary cart-badge text-white">' . esc_attr(WC()->cart->get_cart_contents_count()) . '</span>';   
   	$fragments['.cart-total-items'] = '<a class="no-color nopadding cart-total-items">' . esc_attr(WC()->cart->get_cart_contents_count()).esc_attr($item).' </a>';	
   	$fragments['.cart-total-price'] = '<a class="no-color nopadding cart-total-price"> '.WC()->cart->get_cart_total().'</a>';	
       return $fragments;    
   }
   
   //add product thumbnail
   function add_thumbnail(){
   global $post;
   global $product;
   global $redux;
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
   $i=0;
   $average = round($product->get_average_rating());
   	echo'<div class="position-relative">
   		<div class="thumbnail animate-zoom">
   			<a href="'.esc_url(get_the_permalink()).'">';
   			if($image){
   			echo'	<img src="'.esc_url($image[0]).'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && !empty($redux['ronby_single_product_placeholder']['url'])){
   				echo'<img src="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';
   				}else{
   				echo'<img src="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';					
   				}
   				
   			}
   			echo'</a>
   		</div>
   		<div class="price-n-rating d-flex justify-content-between align-items-center">
   			<div class="product-price-2">'.$product->get_price_html().'</div>
   ';
   		if(!empty($average)){ 
   		echo '<div class="stars-rating justify-content-center" data-rate="5">';
   		while($i < $average){
   			echo"<span class='fas fa-star'></span>";
   			$i++;
   		}
   		echo'</div>';
   		}
   echo'</div>	
   </div>';
   
   echo '
   <div class="item-content text-center">
   ';if($product->get_sku()){ echo'
   		<div class="product-id">
   			'.esc_attr('Product id:').' '.esc_attr($product->get_sku()).'
   		</div>
   ';} echo'		
   		<a class="no-color" href="'.esc_url(get_the_permalink()).'">
   			<h3 class="product-name animate-300 hover-color-primary">
   				'.esc_attr(get_the_title()).'
   			</h3>
   		</a>';
   	echo ronby_add_to_cart_button(); 
   	echo'</div>';
   }
   add_action( 'woocommerce_before_shop_loop_item_title', 'add_thumbnail', 10 );
   
   //custom woocommerce pagination function
   add_filter( 'woocommerce_pagination_args', 	'ronby_woo_pagination' );
   function ronby_woo_pagination( $args ) {
   	$args['prev_text'] = esc_attr('PREV');
   	$args['next_text'] = esc_attr('NEXT');
   	return $args;
   }
   
   //check if shop page
   if(function_exists('is_shop') || is_product_category()){
   //add cart loader function
   function add_cart_loader_shop(){
   echo "<script>jQuery(document).ready(function(){
	   jQuery(this).find('.cart-loader').hide();
	   jQuery(this).find('.added-cart-loader').hide();
   	jQuery('.add_to_cart_button').click(function(){
       jQuery(this).find('.cart-loader').show();
   });
   });</script>";
    }
   add_action( 'wp_footer','add_cart_loader_shop' );
   }
   
   	// **********************************************************************// 
   // ! Woocommerce Pagination without loading
   // **********************************************************************//
   //if the page is shop page
   if(function_exists('is_shop') || is_product_category()) {
   function ronby_woo_pagination_without_loading() {
   echo "
   	<script>
   	jQuery(function(jQuery) {
   	jQuery('#pagiloader').hide();	
       jQuery('.shop_layout').on('click', '.page-numbers a', function(e){
           e.preventDefault();
           var link = jQuery(this).attr('href');
           jQuery('.content').fadeOut(1500, function(){
   			jQuery('#pagiloader').show();
   			jQuery('html, body').animate({
   			scrollTop: jQuery('.shop_layout').offset().top - 100
   		}, 1000);
               jQuery(this).load(link + ' .content', function() {
   				jQuery('#pagiloader').hide();
                   jQuery(this).fadeIn(1500);
   				jQuery('.add_to_cart_button').click(function(){
   				jQuery(this).find('.cart-loader').show();
   			});				
               });
           });
       });
   });
   </script>
   ";
   }
   add_action( 'wp_footer','ronby_woo_pagination_without_loading' );
   }
   
   /********************************************************************************************
   SINGLE PRODUCT FUNCTIONS START FROM HERE
   ********************************************************************************************/
   //check if single product page
   if(function_exists('is_product') && !(is_shop())){
   	
   //remove sale badge	
   remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
   
   //remove added to cart message
   add_filter( 'wc_add_to_cart_message_html', '__return_false' );
   
   
   //remove product rating
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
   
   //remove product price
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
   
   //remove product excerpt-1
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
   
   //remove product addtocart
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    
   //remove product meta
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
   
   //remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
   
   add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
   function woo_remove_product_tabs( $tabs ) {
       unset( $tabs['description'] );      	// Remove the description tab  
       unset( $tabs['additional_information'] );  	// Remove the additional information tab
       return $tabs;
   
   }
   
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
   
   //woocommerce upsell function
   	function ronby_woocommerce_upsell_display( $limit = '-1', $columns = 4, $orderby = 'rand', $order = 'desc' ) {
   		global $product;
   
   		if ( ! $product ) {
   			return;
   		}
   		if((ronby_get_option('ronby_single_product_upsells_limit'))){
   			$limit=ronby_get_option('ronby_single_product_upsells_limit');
   		}else{
   			$limit= '-1';
   		}
   		// Handle the legacy filter which controlled posts per page etc.
   		$args = apply_filters( 'woocommerce_upsell_display_args', array(
   			'posts_per_page' => $limit,
   			'orderby'        => $orderby,
   			'columns'        => $columns,
   		) );
   		wc_set_loop_prop( 'name', 'up-sells' );
   		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );
   
   		$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
   		$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );
   
   		// Get visible upsells then sort them at random, then limit result set.
   		$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
   		$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;
   
   if ( $upsells ) : ?>
<div class="container">
   <div class="row">
      <section class="up-sells upsells products shop_single_layout_upsells">
         <div class="col-md-12">
            <div class="section-header-style-11">
               <h2 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'ronby' ) ?></h2>
            </div>
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php foreach ( $upsells as $upsell ) : ?>
         <?php
            $post_object = get_post( $upsell->get_id() );
            
            setup_postdata( $GLOBALS['post'] =& $post_object );
            
            wc_get_template_part( 'content', 'product' ); ?>
         <?php endforeach; ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   function ronby_woocommerce_cross_sell_display(){
       $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);
   
       if(empty($crosssells)){
           return;
       }
   		if((ronby_get_option('ronby_single_product_cross_sells_limit'))){
   			$limit=ronby_get_option('ronby_single_product_cross_sells_limit');
   		}else{
   			$limit= '-1';
   		}
       $args = array( 
           'post_type' => 'product', 
           'posts_per_page' => $limit, 
           'post__in' => $crosssells 
           );
       $products = new WP_Query( $args );
       if( $products->have_posts() ) :  ?>
<div class="container">
   <div class="row">
      <section class="shop_single_layout_upsells cross_sells">
         <div class="col-md-12">
            <div class="section-header-style-11">
               <h2 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'ronby' ) ?></h2>
            </div>
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php
            while ( $products->have_posts() ) : $products->the_post();
            	wc_get_template_part( 'content', 'product' );
            endwhile; // end of the loop.					
            ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   function ronby_woocommerce_related_product_display(){
   global $product;
   
   if ( ! $product ) {
   return;
   }
   if((ronby_get_option('ronby_single_product_related_products_limit'))){
   $limit=ronby_get_option('ronby_single_product_related_products_limit');
   }else{
   $limit= '-1';
   }
   $defaults = array(
   'posts_per_page' => $limit, 
   'columns'        => 4,
   'orderby'        => 'rand', // @codingStandardsIgnoreLine.
   'order'          => 'desc',
   );
   
   $args = wp_parse_args($defaults );
   
   // Get visible related products then sort them at random.
   $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
   
   // Handle orderby.
   $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
   
   // Set global loop values.
   wc_set_loop_prop( 'name', 'related' );
   wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );
   
   if ( $args['related_products'] ) : ?>
<div class="container">
   <div class="row">
      <section class="related-products shop_single_layout_upsells">
         <div class="col-md-12 nopadding">
			<div class="section-header-style-6">
				<h2 class="section-title"><?php echo ronby_get_option('ronby_single_product_related_products_title_1');?></h2>
				<h4 class="section-sub-title"><?php echo ronby_get_option('ronby_single_product_related_products_title_2');?></h4>
			</div>		
			<div class="section-description text-center">
			<?php echo ronby_get_option('ronby_single_product_related_products_desc');?>
			</div>			
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php foreach ( $args['related_products'] as $related_product ) : ?>
         <?php
            $post_object = get_post( $related_product->get_id() );
            
            setup_postdata( $GLOBALS['post'] =& $post_object );
            
            wc_get_template_part( 'content', 'product' ); ?>
         <?php endforeach; ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   //single product wrapper start
   add_action( 'woocommerce_before_single_product', 'ronby_single_product_wrapper_start', 15 );
   function ronby_single_product_wrapper_start() {
	echo ronby_page_heading_function();	   
   echo '<!-- Content -->
   	 <div id="content" class="p-125-0-110 shop-single-product-layout">		
   		<section class="product-detail-2">
   			<div class="container">
   			<div class="product-detail-header pb-0">
   			<div class="row">';   				  
   }
   
   //single product wrapper end
   add_action( 'woocommerce_after_single_product', 'ronby_single_product_wrapper_after', 15 );
   function ronby_single_product_wrapper_after() {
   echo '</div>
   	 </div>'; 
   global $product;         
   ?>
<?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' ) || get_the_excerpt()){?>
<div class="product-detail-content">
   <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
         <?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' )){?>							
         <div class="product-additional-information mb-0">
            <div class="section-header-style-12">
               <h2 class="section-title"><?php esc_html_e('Additional information','ronby');?></h2>
            </div>
            <ul class="no-style">
               <?php if($product->get_weight()) { ?>								
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Weight:','ronby');?></span>
                  <span class="flex-fill"><?php echo esc_attr($product->get_weight()).' '.esc_attr(get_option( 'woocommerce_weight_unit' )) ?></span>
               </li>
               <?php } ?>									
               <?php if($product->get_length() && $product->get_width() && $product->get_height()) { ?>									
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Dimensions:','ronby');?></span>
                  <span class="flex-fill"><?php if($product->get_length()){echo esc_attr($product->get_length());}if($product->get_width()){echo' x '.esc_attr($product->get_width());}if($product->get_height()){echo ' x '.esc_attr($product->get_height());} echo ' '.esc_attr(get_option( 'woocommerce_dimension_unit' )); ?></span>
               </li>
               <?php } ?>										
               <?php if($product->get_attribute( 'Size' )) { ?>
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Size:','ronby');?></span>
                  <span class="flex-fill"><?php echo $product->get_attribute( 'Size' ); //escaped already ?></span>
               </li>
               <?php } ?>									
            </ul>
         </div>
         <?php } ?>							
         <div class="shop-single-layout-product-excerpt mt-45">
            <?php echo the_content();?>
         </div>
      </div>
   </div>
</div>
<?php } ?>				
<?php	 
   echo'</div></section>';	
     if((comments_open()) && (is_shop() || is_product() || is_product_category() || is_product_taxonomy() || is_cart() || is_checkout())) {
     ronby_comment_and_review(); 
     }
     if(ronby_get_option('ronby_single_product_upsells_switch')==1){
   echo ronby_woocommerce_upsell_display();
     }
     if(ronby_get_option('ronby_single_product_cross_sells_switch')==1){   
   echo ronby_woocommerce_cross_sell_display(); 
     }
     if(ronby_get_option('ronby_single_product_related_products_switch')==1){   
   echo ronby_woocommerce_related_product_display();  
     } 
   echo'</div>
   <!-- End Content -->';
   }
   
   
   //single product summary
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
   add_action( 'woocommerce_single_product_summary', 'ronby_woocommerce_summary_area', 10 );
   function ronby_woocommerce_summary_area(){	
   global $product;
   // get product_tags of the current product
   $current_tags = get_the_terms( get_the_ID(), 'product_tag' );
   $attributes = $product->get_attributes();
   $attribute_keys = array_keys( $attributes );
   $stock_qty= $product->get_stock_quantity();	
   if($stock_qty >= 1){
   	$availbility= "In Stock";
   }else{
   	$availbility= "Stock Out";
   }
   $average = round($product->get_average_rating());
   $i=0;
   global  $woocommerce;
   $currency= get_woocommerce_currency_symbol();
   $product_details = $product->get_data();
   if($product->is_type( 'simple' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();	
   }elseif($product->is_type( 'variable' )){
   #1 Get product variations
   if($product->get_available_variations()){
   $product_variations = $product->get_available_variations();
   #2 Get one variation id of a product
   $variation_product_id = $product_variations [0]['variation_id'];	
   #3 Create the product object
   $variation_product = new WC_Product_Variation( $variation_product_id );	
   #4 Use the variation product object to get the variation prices
   $regular_price= $currency.$variation_product ->get_regular_price();
   $sale_price= $currency.$variation_product ->get_sale_price();
   }else{
	$product_variations = '';
   $regular_price= '';
   $sale_price= '';	
   }
	
   }elseif($product->is_type( 'grouped' )){
   $regular_price='';
   $sale_price='';
   }elseif($product->is_type( 'external' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();
   }
   $max_value= $product->get_max_purchase_quantity();
   $min_value= $product->get_min_purchase_quantity();
   $input_name = 'quantity';
   $input_value = '1';
   $step = apply_filters( 'woocommerce_quantity_input_step', '1', $product );
   $classes =apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text','input-styled','qty-input-styled' ));
   $input_id= uniqid( 'quantity_' );
   
   /* translators: %s: Quantity. */
   $labelledby = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'ronby' ), wp_strip_all_tags( $args['product_name'] ) ) : '';	
   
   
   // Ajax add to cart button function
   function ronby_add_to_cart_button_single_product() {
      global $product;
      $classes = implode( ' ',  array(
          'button',
          'product_type_' . $product->get_type(),
          $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
          $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
      )  );
   
      return apply_filters( 'woocommerce_loop_add_to_cart_link',
          sprintf( '<button type="submit" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s button rounded-capsule animate-400 hover-background-primary hover-color-white">'.esc_html( $product->add_to_cart_text() ).' <img src="'.esc_url(get_template_directory_uri()).'/images/add-to-cart.gif"  class="cart-loader-single" alt="'.esc_attr__('add-to-cart-loader','ronby').'"/><img src="'.esc_url(get_template_directory_uri()).'/images/added-to-cart.png?a='.esc_attr(rand()).'"  class="added-cart-loader" alt="'.esc_attr__('added-to-cart-loader','ronby').'"/></button>',
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->get_id() ),
              esc_attr( $product->get_sku() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( isset( $classes ) ? $classes : 'button' ),
              esc_attr( $product->get_type() ),
              esc_html( $product->add_to_cart_text() )
          ),
      $product );
   }
   // Ajax add to cart button function
   function ronby_add_to_cart_button_single_product_non_variation() {
      global $product;
      $classes = implode( ' ',  array(
          'button',
          'product_type_' . $product->get_type(),
          $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
          $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
      )  );
   
      return apply_filters( 'woocommerce_loop_add_to_cart_link',
          sprintf( '<button type="submit" name="add-to-cart" value="'.esc_attr( $product->get_id() ).'" class="button rounded-capsule animate-400 hover-background-primary hover-color-white">'.esc_html( $product->add_to_cart_text() ).' <img src="'.esc_url(get_template_directory_uri()).'/images/add-to-cart.gif"  class="cart-loader-single "   alt="'.esc_attr__('add-to-cart-loader','ronby').'"/><img src="'.esc_url(get_template_directory_uri()).'/images/added-to-cart.png?a='.esc_attr(rand()).'"  class="added-cart-loader added-cart-loader2" alt="'.esc_attr__('added-to-cart-loader','ronby').'"/></button>',		
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->get_id() ),
              esc_attr( $product->get_sku() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( isset( $classes ) ? $classes : 'button' ),
              esc_attr( $product->get_type() ),
              esc_html( $product->add_to_cart_text() )
          ),
      $product );
   }
   
   //ajax add to cart loader function.this for variation product
   function add_cart_loader_single_product(){
   echo "<script>jQuery(document).ready(function(e){
   jQuery('.reset_variations').click(function(){
   jQuery('.entry-summary form.cart')[0].reset();	
   });
   jQuery('select').prop('required', true);
   jQuery('.input-text').prop('required', true);
   var jQuerywarp_fragment_refresh = {
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
      type: 'POST',
      success: function( data ) {
          if ( data && data.fragments ) {
              jQuery.each( data.fragments, function( key, value ) {
                  jQuery( key ).replaceWith( value );
              });
   
              jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
          }
      }
   };	
   jQuery('.entry-summary form.cart').on('submit', function (e)
   {
      e.preventDefault();
   jQuery('.added-cart-loader').hide();
   if(jQuery('select').val()==''){
   	jQuery('.cart-loader-single').hide();
   }else{
   jQuery('.cart-loader-single').show();	
      var product_url = window.location,
          form = jQuery(this);
   
      jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
      {
          var cart_dropdown = jQuery('.widget_shopping_cart', result)
   
          // update dropdown cart
          jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);
   
          // update fragments
          jQuery.ajax(jQuerywarp_fragment_refresh);
   	jQuery('.cart-loader-single').hide();
   	jQuery('.added-cart-loader').show();
   	jQuery('.single-product-cart-notice').show();
      });
   }
   });
   
   });</script>";
   }
   
   
   //ajax add to cart loader function. this for non variation product
   function add_cart_loader_single_product_2(){
   echo "<script>jQuery(document).ready(function(e){
   jQuery('.input-text').prop('required', true);
   var jQuerywarp_fragment_refresh = {
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
      type: 'POST',
      success: function( data ) {
          if ( data && data.fragments ) {
              jQuery.each( data.fragments, function( key, value ) {
                  jQuery( key ).replaceWith( value );
              });
   
              jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
          }
      }
   };	
   jQuery('.entry-summary form.cart').on('submit', function (e)
   {
      e.preventDefault();
   jQuery('.added-cart-loader').hide();
   jQuery('.cart-loader-single').show();	
      var product_url = window.location,
          form = jQuery(this);
   
      jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
      {
          var cart_dropdown = jQuery('.widget_shopping_cart', result)
   
          // update dropdown cart
          jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);
   
          // update fragments
          jQuery.ajax(jQuerywarp_fragment_refresh);
   	jQuery('.cart-loader-single').hide();
   	jQuery('.added-cart-loader2').show();
   	jQuery('.single-product-cart-notice').show();
      });
   });
   if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
   }
   });</script>";
   }
   
   
   echo"<div class='pt-3 pl-4 summary-container'>
   			<div class='row justify-content-between'>
   				<div class='col-md-6'>";
   				if( $product->is_on_sale() ){ 
   				echo "<h4 class='product-sub-title badge badge-danger text-white'>".esc_attr('Sale')."</h4>";
   				}
   				echo'<h2 class="product-title">'.esc_attr(get_the_title()).'</h2>';
   
   echo"</div>";	
   echo'
   <div class="col-auto text-right">';
   if($product->is_type( 'variable' ) || $product->is_type( 'simple' )){
   	echo '<div class="product-stock pb-4">
   		'.esc_html__('Availability:','ronby').' <span class="ml-2 color-primary">'.esc_attr($availbility).'</span>
   	</div>';
   }
   	if(!empty($average)){ 
   	echo '<div class="stars-rating justify-content-center" data-rate="5">';
   	while($i < $average){
   		echo"<span class='fas fa-star'></span>";
   		$i++;
   	}
   	echo'</div>';
   	}
   	echo'<div class="product-price-2">';
   	if($product->is_on_sale()){
   		echo'<span class="regular-price mr-2">
   			'.esc_attr($regular_price).'
   		</span>
   		<span class="sale-price">
   			'.esc_attr($sale_price).'
   	</span>';
   	}else{
   		echo'<span class="sale-price">
   			'.esc_attr($regular_price).'
   		</span>';	
   	}
   	echo'</div>
   </div>
   ';		
   echo'</div><p class="product-description">'.$product_details['short_description'].'</p>';	
   ?>
<?php
   if($product->is_type( 'variable' )){
   $available_variations = $product->get_available_variations();	
   $attributes = $product->get_variation_attributes();
   $attribute_keys = array_keys( $attributes );	
   }else{
   $available_variations = '';	
   $attributes = '';
   $attribute_keys = '';	
   }
   ?>
<?php if($product->is_type( 'variable' )){ ?>	
<?php do_action( 'woocommerce_before_variations_form' ); ?>
<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations) ); // WPCS: XSS ok. ?>">
   <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
   <p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'ronby' ); ?></p>
   <?php else : ?>		
   <div class="d-flex flex-wrap align-items-center mb-4">
   <?php if($product->get_available_variations()) { ?>
      <?php foreach ( $attributes as $attribute_name => $options ) : ?>		
      <div class="shop-product-detail-quanty">
         <?php
            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product,'class' => 'input-styled') );
            ?>
      </div>
      <?php endforeach;?>			
   <?php } ?>			
      <div class=" ml-3">
	  <?php if($product->get_available_variations()) { ?>
         <?php  echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations  btn-dark btn-sm text-white cursor-pointer">' . esc_html__( 'Clear', 'ronby' ) . '</a>' ) : ''; ?>
		<?php } ?>
      </div>
   </div>
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <div class="single_variation_wrap">
      <div class="woocommerce-variation-add-to-cart variations_button">
         <?php
            do_action( 'woocommerce_before_add_to_cart_quantity' );
            if ( $max_value && $min_value === $max_value ) {
            	?>
         <div class="quantity hidden">
            <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
         </div>
         <?php
            } else {
            	?>
         <div class="quantity mb-4">
            <input
               type="number"
               id="<?php echo esc_attr( $input_id ); ?>"
               class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
               step="<?php echo esc_attr( $step ); ?>"
               min="<?php echo esc_attr( $min_value ); ?>"
               max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
               name="<?php echo esc_attr( $input_name ); ?>"
               value="<?php echo esc_attr( $input_value ); ?>"
               title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'ronby' ); ?>"
               size="4"
               <?php if ( ! empty( $labelledby ) ) { ?>
               aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" 
               <?php } ?>/>
         </div>
         <?php
            } 
            	do_action( 'woocommerce_after_add_to_cart_quantity' );		
            	?>
         <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
         <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
         <input type="hidden" name="variation_id" class="variation_id" value="0" />
      </div>
   </div>
   <div class="row align-items-center">
      <div class="col-auto">
         <?php
            echo ronby_add_to_cart_button_single_product();
             ?>
         <?php
            $args="";
            if(function_exists('ronby_woowishlist_add_button_single')){
            echo ronby_woowishlist_add_button_single($args);
            }
            ?>
      </div>
      <div class="col-auto">
         <?php
            if(function_exists('tm_woocompare_add_button_single')){
            echo tm_woocompare_add_button_single( $args );
            }
            ?>
      </div>
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <?php 
      //only start if we have some tags
      if ( $current_tags && ! is_wp_error( $current_tags ) ) { 
          //create a list to hold our tags
          echo '<div class="product-tags"><i class="fas fa-tags color-primary mr-2"></i>';
          //for each tag we create a list item
          foreach ($current_tags as $tag) {
              $tag_title = $tag->name; // tag name
              $tag_link = get_term_link( $tag );// tag archive link
              echo ' <a href="'.$tag_link.'" class="no-color">'.$tag_title.'</a>,';
          }
          echo '</div>';
      }
      ?>	
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
   <?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_variations_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product' ); ?>	
<?php }elseif($product->is_type( 'simple' )){ ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>">
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php do_action( 'woocommerce_before_add_to_cart_quantity' );?>
   <div class="quantity mb-4">
      <input
         type="number"
         id="<?php echo esc_attr( $input_id ); ?>"
         class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
         step="<?php echo esc_attr( $step ); ?>"
         min="<?php echo esc_attr( $min_value ); ?>"
         max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
         name="<?php echo esc_attr( $input_name ); ?>"
         value="<?php echo esc_attr( $input_value ); ?>"
         title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'ronby' ); ?>"
         size="4"
         <?php if ( ! empty( $labelledby ) ) { ?>
         aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" 
         <?php } ?>/>
   </div>
   <?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
   <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
   <div class="row align-items-center">
      <div class="col-auto">
         <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
         <?php
            $args="";
            if(function_exists('ronby_woowishlist_add_button_single')){
            echo ronby_woowishlist_add_button_single($args);
            }
            ?>
      </div>
      <div class="col-auto">
         <?php
            if(function_exists('tm_woocompare_add_button_single')){
            echo tm_woocompare_add_button_single( $args );
            }
            ?>
      </div>
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <?php 
      //only start if we have some tags
      if ( $current_tags && ! is_wp_error( $current_tags ) ) { 
          //create a list to hold our tags
          echo '<div class="product-tags"><i class="fas fa-tags color-primary mr-2"></i>';
          //for each tag we create a list item
          foreach ($current_tags as $tag) {
              $tag_title = $tag->name; // tag name
              $tag_link = get_term_link( $tag );// tag archive link
              echo ' <a href="'.$tag_link.'" class="no-color">'.$tag_title.'</a>,';
          }
          echo '</div>';
      }
      ?>	
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product_2' ); ?>	
<?php }elseif($product->is_type( 'grouped' )){ 
   global $product, $post;
   
   do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
   <table cellspacing="0" class="woocommerce-grouped-product-list group_table shop_layout_group_table">
      <tbody>
         <?php
            $products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );			
            	$quantites_required      = false;
            	$previous_post           = $post;
            	$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
            		'quantity',
            		'label',
            		'price',
            	), $product );
            
            	foreach ( $products as $grouped_product_child ) {
            		$post_object        = get_post( $grouped_product_child->get_id() );
            		$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
            		$post               = $post_object; // WPCS: override ok.
            		setup_postdata( $post );
            
            		echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child->get_id() ) ) ) . '">';
            
            		// Output columns for each product.
            		foreach ( $grouped_product_columns as $column_id ) {
            			do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );
            
            			switch ( $column_id ) {
            				case 'quantity':
            					ob_start();
            
            					if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
            						woocommerce_template_loop_add_to_cart();
            					} elseif ( $grouped_product_child->is_sold_individually() ) {
            						echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
            					} else {
            						do_action( 'woocommerce_before_add_to_cart_quantity' );
            
            echo '<input
            	type="number"
            	class="'.esc_attr( join( ' ', (array) $classes ) ).'"
            	min_value="'.apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ).'"
            	max_value="'.apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ).'"
            	name="quantity[' . $grouped_product_child->get_id() . ']"
            	input_value=""
            	value="'.esc_attr( $input_value ).'"
            	/>';
            														
            
            						do_action( 'woocommerce_after_add_to_cart_quantity' );
            					}
            
            					$value = ob_get_clean();
            					break;
            				case 'label':
            					$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
            					$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
            					$value .= '</label>';
            					break;
            				case 'price':
            					$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
            					break;
            				default:
            					$value = '';
            					break;
            			}
            
            			echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // WPCS: XSS ok.
            
            			do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
            		}
            
            		echo '</tr>';
            	}
            	$post = $previous_post; // WPCS: override ok.
            	setup_postdata( $post );
            	?>
      </tbody>
   </table>
   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
   <?php if ( $quantites_required ) : ?>
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
   <div class="row">
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
   <?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product_2' ); ?>	
<?php } elseif($product->is_type( 'external' )){ 
   global $product;
   ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="get">
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
   <?php wc_query_string_form_fields( $product->add_to_cart_url()); ?>
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php } ?>
<?php
   echo'</div>';
   }

   //function for ronby comment and review
   function ronby_comment_and_review(){
   global $product;	
   ?>
<?php if (comments_open()) { ?>
<section class="pt-70">
   <div class="container">
      <div class="row">
         <div class="col-xl-10 offset-xl-1">
            <?php if($product->get_review_count()){ ?>
            <div class="section-header-style-11">
               <h2 class="section-title">
                  <?php
                     if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
                     	/* translators: 1: reviews count 2: product name */
                     	printf( esc_html( _n( '%1$s review', '%1$s reviews', $count, 'ronby' ) ), esc_html( $count ) );
                     } else {
                     	esc_html_e( 'Reviews', 'ronby' );
                     }
                     ?>
               </h2>
            </div>
            <?php } ?>
            <?php if ( have_comments() ) { ?>
            <ul class="list-comments">
               <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'ronby_woocommerce_comments' ) ) ); ?>
            </ul>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
               echo '<nav class="woocommerce-pagination">';
               paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
               	'prev_text' => '&larr;',
               	'next_text' => '&rarr;',
               	'type'      => 'list',
               ) ) );
               echo '</nav>';
               } ?>
            <?php } ?>			
         </div>
      </div>
   </div>
</section>
<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) { ?>
<section class="pb-45">
   <div class="container">
      <div class="row">
         <div class="col-xl-10 offset-xl-1">
            <?php
               $commenter = wp_get_current_commenter();
               
               $comment_form = array(
               	'title_reply'          => have_comments() ? esc_html__( 'Post Review', 'ronby' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'ronby' ), get_the_title() ),
               	'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'ronby' ),
               	'title_reply_before'   => '<div class="section-header-style-11 "><h2 class="section-title">',
               	'title_reply_after'    => '</h2></div>',
               	'comment_notes_after'  => '',
				'comment_field' => '',
               );
               
               $comment_form['fields'] ='<div class="form-style-7">
               <div class="row align-items-center">';
               $comment_form['fields'] .= '<div class="col-lg-4"><div class="form-group">
                                <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
               $n_value = '';
               $e_value = '';
               $comment_form['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
               	 </div></div>';					 				 
               $comment_form['fields'] .= '<div class="col-lg-4"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
               
               if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
               $comment_form['fields'] .= '<div class="col-lg-4">
               				<div class="p-4 mt-2 stars-rating">
               				<div class="form-group">
               				<div class="py3 d-flex align-items-center">
               				<i  class="color-lighten mr-2">'.esc_html__('Rating*','ronby').'</i>               	
               	<select name="rating" id="ronby-woo-star-ratings" required>
               <option value="">' . esc_html__( '0', 'ronby' ) . '</option>
               <option value="1">' . esc_html__( '1', 'ronby' ) . '</option>
               <option value="2">' . esc_html__( '2', 'ronby' ) . '</option>
               <option value="3">' . esc_html__( '3', 'ronby' ) . '</option>
               <option value="4">' . esc_html__( '4', 'ronby' ) . '</option>
               <option value="5">' . esc_html__( '5', 'ronby' ) . '</option>
               </select>
               </div>
               </div>
               </div>		
               </div>';
               }
               
               $comment_form['fields'] .='</div></div>';
               
               if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
               $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'ronby' ), esc_url( $account_page_url ) ) . '</p>';
               }
               if ( !is_user_logged_in() ) {  
               $comment_form['comment_field'] .= '<div class="form-style-7"><div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" class="input-styled" placeholder="'.esc_attr__("Review *", "ronby").'" required></textarea></div></div>';
               }else{
				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {   
               $comment_form['comment_field'] .= '
               				<div class="pl-0 mt-2 stars-rating">
               				<div class="form-group">
               				<div class="py3 d-flex align-items-center">
               				<i  class="color-lighten mr-2">'.esc_html__('Rating*','ronby').'</i>              	
               <select name="rating" id="ronby-woo-star-ratings" required>
               <option value="">' . esc_html__( '0', 'ronby' ) . '</option>
               <option value="1">' . esc_html__( '1', 'ronby' ) . '</option>
               <option value="2">' . esc_html__( '2', 'ronby' ) . '</option>
               <option value="3">' . esc_html__( '3', 'ronby' ) . '</option>
               <option value="4">' . esc_html__( '4', 'ronby' ) . '</option>
               <option value="5">' . esc_html__( '5', 'ronby' ) . '</option>
               </select>
               </div>
               </div>
               </div>';	
				}			   
               $comment_form['comment_field'] .= '<div class="clearfix"></div><div class="form-style-7"><div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" class="input-styled" placeholder="'.esc_attr__("Review *", "ronby").'" required></textarea></div></div>';	
               }					
               if ( !is_user_logged_in() ) {
               function ronby_woo_comment_form_submit_button($button) {
               $button ='<span class="form-group py-15px">';	
               $button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post review", "ronby").' </button>';
               $button .='</span>';	
               return $button;
               }
               add_filter('comment_form_submit_button', 'ronby_woo_comment_form_submit_button');//Submit button customization filter
               } else {
               function ronby_woo_comment_form_submit_button($button) {
               $button ='<span class="form-group py-15px">';
               $button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post review", "ronby").' </button>';
               $button .='</span>';
               return $button;
               }
               add_filter('comment_form_submit_button', 'ronby_woo_comment_form_submit_button');//Submit button customization filter
               }										
               comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
               ?>
            <?php if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) { 
               function ronby_woo_review_rating_script(){
               echo "<script>
               jQuery(document).ready(function(){
               jQuery('#ronby-woo-star-ratings').fontstar();
               });
               </script>";
               }
               add_action('wp_footer','ronby_woo_review_rating_script');
               } ?>
         </div>
      </div>
   </div>
</section>
<?php } else { ?>
<section class="pb-7">
   <div class="container">
      <div class="row">
         <div class="col-xl-10 offset-xl-1">
            <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'ronby' ); ?></p>
         </div>
      </div>
   </div>
</section>
<?php } ?>	
<?php } ?>	
<?php }
   //Ronby woocommerce comments
   function ronby_woocommerce_comments($comment, $args, $depth ){
   	$GLOBALS['comment'] = $comment;
   	global $post;?>
<li>
   <div  <?php comment_class("comment-item-5"); ?> id="comment-<?php comment_ID() ?>">
      <div class="comment-avatar">
         <?php echo get_avatar($comment, 90, 'gravatar_default'); ?>
      </div>
      <div class="comment-content">
         <div class="comment-header">
            <span class="comment-author"><?php comment_author(); ?></span>
            <span class="comment-time"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
            <div class="comment-actions">
               <?php comment_reply_link(array_merge( $args, array(
                  'reply_text' => esc_attr__('Reply Comment', 'ronby'),
                  'depth' => $depth, 
                  'max_depth' => $args['max_depth']
                  ))); ?>											
            </div>
         </div>
         <div class="comment-text">
            <?php comment_text()?>
         </div>
      </div>
   </div>
   <?php }
   function ronby_woo_review_remove(){
   if(is_single()){	
   echo "<script>
      jQuery(document).ready(function() {
          jQuery('.woocommerce-tabs').remove();
      });
   </script>";
   }
   }
   add_action('wp_footer','ronby_woo_review_remove');
   //End is_product function condition here
   }
   /*****************************
   Start from here cart page function 
   **************************/
   remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
   
   }elseif(ronby_get_option('ronby_shop_page_layout')==1){
	   
	/**********************************************
	/*START FITNESS SHOP LAYOUT FUNCTIONS FROM HERE*/ 
	/**********************************************/ 
	   
   /* Remove unnessary action from shop page */
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
   remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
   remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );	 
   
   // Remove woocommerce_breadcrumb
   remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
   
   // Remove woocommerce_show_page_title
   add_filter( 'woocommerce_show_page_title' , '__return_false' );
   
   // Remove woocommerce_sidebar
   remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
   
   // Remove the result count from WooCommerce
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
   
   // Remove the sorting dropdown from Woocommerce
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
   remove_action( 'woocommerce_shop_loop' , '__return_false' );
   
   // Remove the woocommerce_shop_loop_item_title
   remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
   
   // remove the woocommerce_shop_loop_item_title
   add_action('woocommerce_shop_loop_item_title', 'Change_Products_Title', 10 );
   function Change_Products_Title() {
       return false;
   }
      
   //remove output_content_wrapper
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
   
   //remove output_content_wrapper_end
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
   
   //remove product product link
   remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
   
   //remove product product link
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
   
   //remove product add-to-cart
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );   

    //remove shop page product price
   remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
   
   //remove product thumbnail
   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
   
   // Remove the product rating display on product loops
   remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
   
   // **********************************************************************// 
   // ! Add page header function in shop page before content 
   // **********************************************************************//
   add_action( 'woocommerce_before_main_content', 'ronby_before_main_content_shop_page', 5 );
   function ronby_before_main_content_shop_page() {
       // Only on "shop" archives pages
       if(is_shop()  || is_product_category() || is_product_taxonomy()){
   	echo ronby_page_heading_function();
   echo '<div id="content" class="p-120-0 fitness_shop_layout">
		<section class="products">
      <div id="pagiloader" class="pagiloader"><img src="'. esc_url(get_template_directory_uri().'/images/blog-loader.gif') .'" class="img-responsive" alt="'.esc_attr__('blog-pagination-loader','ronby').'"/></div>
      <div class="content">
   		<div class="container">
   			<!-- Products -->
   			<div class="row">';		
   	}
   
   }
   
   // **********************************************************************// 
   // ! Add  function in shop page  after content 
   // **********************************************************************//
   add_action( 'woocommerce_after_main_content', 'ronby_after_main_content_shop_page', 15 );
   function ronby_after_main_content_shop_page() {
   if(is_shop()  || is_product_category() || is_product_taxonomy()){	
   echo '</div></div></div></section></div>';
   }
if(!(is_single())){  
   if(ronby_get_option('ronby_shop_page_slider_sec_switch') == 1){
   if (function_exists('blog_page_brand_carousel_slider'))blog_page_brand_carousel_slider();
   } 
}   
   }
   
   // Get Texnomy/category description
   add_action( 'woocommerce_archive_description', 'ronby_woo_product_archive_desc', 10 );
   function ronby_woo_product_archive_desc(){
   if(is_product_category() || is_product_taxonomy()){
    $cat = get_queried_object();	 
    $catID = $cat->term_id;
    
    global $product;
    echo"<div class='row mb-5'><div class='col-md-12'>";
    echo category_description($catID);
    echo "</div></div>";	
    }
   }
   	   
   //add product wrapper
   add_action( 'woocommerce_before_shop_loop_item', 'product_article_wrapper_before', 15 ); 
   function product_article_wrapper_before() {
   echo '<!-- Product-item -->
	<div class="col-md-12">
	<div class="col-md-12 nopadding">
	<article class="product-item-1 text-center">';
   }
   
   //add product wrapper
   add_action( 'woocommerce_after_shop_loop_item', 'product_article_wrapper_after', 15 );
   function product_article_wrapper_after() {
   echo '</article>';
   echo '</div>';
   echo '</div>';
   echo '<!-- End Product-item -->';
   }
     
   //Change Sell Badge filter
   add_filter('woocommerce_sale_flash', 'ronby_change_sale_content', 10, 3);
   function ronby_change_sale_content($content, $post, $product){
	if(ronby_get_option('ronby_woo_product_sale_badge_style') == 1){   
	$content= '<div class="ribbon">
			  <div class="ribbon-wrap">
				<span class="ribbon6 item-badge-red">'.esc_attr__('Sale','ronby').'</span>
			  </div>
			</div>';
	}elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 2){		
	$content= '<div class="ribbon">
				<span class="ribbon1 text-white"><span>'.esc_attr__('Sale','ronby').'</span></span>
			</div>';
	}elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 3){
	$content= '<div class="ribbon">
				<span class="ribbon2 text-white">'.esc_attr__('S','ronby').'<br>'.esc_attr__('A','ronby').'<br>'.esc_attr__('L','ronby').'<br>'.esc_attr__('E','ronby').'</span>
			</div>';		
	}		
      return $content;
   }
 
   //add product thumbnail
   add_action( 'woocommerce_before_shop_loop_item_title', 'ronby_product_wrapper', 10 );   
   function ronby_product_wrapper(){
   global $post;
   global $product;
   global $redux;
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
   $i=0;
   $average = round($product->get_average_rating());
   $args="";

   	echo'<div class="position-relative">
   		<div class="thumbnail animate-zoom d-flex">
   			<a href="'.esc_url(get_the_permalink()).'">';
   			if($image){
   			echo'	<img src="'.esc_url($image[0]).'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && !empty($redux['ronby_single_product_placeholder']['url'])){
   				echo'<img src="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';					
   				}else{
   				echo'<img src="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';					
   				}   				
   			}
   			echo'</a>
   		</div>
		<div class="shadow-brdr">
   		<div class="item-buttons product-action-buttons-1 d-flex justify-content-center">';
   			if($image){
				echo'<a href="'.esc_url($image[0]).'" class="hover-background-primary" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && !empty($redux['ronby_single_product_placeholder']['url'])){
				echo'<a href="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" class="hover-background-primary" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';
   				}else{
				echo'<a href="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" class="hover-background-primary" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';				
   				}   				
   			}
            if(function_exists('ronby_woowishlist_add_button_single')){
              echo ronby_woowishlist_add_button_single($args);
            }	
			if(ronby_get_option('ronby_shop_page_quick_view_switch')){
			echo'
				<a href="'.esc_url('#0').'" class="hover-background-primary quick_view" data-product-id="'.esc_attr($product->get_id()).'" >
					<i class="fas fa-eye"></i>
				</a>';
			}
			echo ronby_add_to_cart_button();	
		echo '</div>';
			
   		if(!empty($average)){ 
   		echo '<div class="stars-rating" data-rate="5">';
   		while($i < $average){
   			echo"<span class='fas fa-star'></span>";
   			$i++;
   		}
   		echo'</div>';
   		}

   echo'<a class="no-color" href="'.esc_url(get_the_permalink()).'">
   			<h3 class="product-name animate-300 hover-color-primary">
   				'.esc_attr(get_the_title()).'
   			</h3>
   		</a>';
								  
   echo '<div class="product-price-1 mb-4">';
   echo'<a class="no-color" href="'.esc_url(get_the_permalink()).'">';

			echo '<span class="sale-price color-primary">'.$product->get_price_html().'</span>';
   
   echo'</a>';
   	echo '</div>';
   	echo '</div>';
   	echo '</div>';
   	echo '';
   }

   //custom woocommerce pagination function
   add_filter( 'woocommerce_pagination_args', 	'ronby_woo_pagination' );
   function ronby_woo_pagination( $args ) {
   	$args['prev_text'] = esc_attr('PREV');
   	$args['next_text'] = esc_attr('NEXT');
   	return $args;
   }

   	// **********************************************************************// 
   // ! Woocommerce Pagination without loading
   // **********************************************************************//
   //if the page is shop page
   if(function_exists('is_shop') || is_product_category()) {
   function ronby_woo_pagination_without_loading() {
   echo "
   	<script>
   	jQuery(function(jQuery) {
   	jQuery('#pagiloader').hide();	
       jQuery('.fitness_shop_layout').on('click', '.page-numbers a', function(e){
           e.preventDefault();
           var link = jQuery(this).attr('href');
           jQuery('.content').fadeOut(1500, function(){
   			jQuery('#pagiloader').show();
   			jQuery('html, body').animate({
   			scrollTop: jQuery('.fitness_shop_layout').offset().top - 100
   		}, 1000);
               jQuery(this).load(link + ' .content', function() {
   				jQuery('#pagiloader').hide();
                   jQuery(this).fadeIn(1500);
   				jQuery('.add_to_cart_button').click(function(){
   				jQuery(this).find('.cart-loader').show();
   			});				
               });
           });
       });
   });
   </script>
   ";
   }
   add_action( 'wp_footer','ronby_woo_pagination_without_loading' );
   } 
   // Ensure cart contents update when products are added to the cart via AJAX 
   add_filter( 'woocommerce_add_to_cart_fragments', 'ronby_cart_count_fragments', 10, 1 );
   function ronby_cart_count_fragments( $fragments ) {  
   if((WC()->cart->get_cart_contents_count()) <= 1 ){
   	$item= esc_attr(' Item');
   	}else{
   	$item= esc_attr(' Items');
   	} 	
       $fragments['.cart-badge'] = '<span class="badge bg-secondary cart-badge text-white">' . esc_attr(WC()->cart->get_cart_contents_count()) . '</span>';   
   	$fragments['.cart-total-items'] = '<a class="no-color nopadding cart-total-items">' . esc_attr(WC()->cart->get_cart_contents_count()).esc_attr($item).' </a>';	
   	$fragments['.cart-total-price'] = '<a class="no-color nopadding cart-total-price"> '.WC()->cart->get_cart_total().'</a>';	
       return $fragments;    
   } 
   // Ajax add to cart button function
   function ronby_add_to_cart_button() {
       global $product;
       $classes = implode( ' ',  array(
           'button',
           'product_type_' . $product->get_type(),
           $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
           $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
       )  );
   
       return apply_filters( 'woocommerce_loop_add_to_cart_link',
           sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="product_type_%s  hover-background-primary"><i class="fas fa-shopping-basket"></i></a>',
               esc_url( $product->add_to_cart_url() ),
               esc_attr( $product->get_id() ),
               esc_attr( $product->get_sku() ),
               esc_attr( isset( $quantity ) ? $quantity : 1 ),
               esc_attr( isset( $classes ) ? $classes : 'button' ),
               esc_attr( $product->get_type() ),
               esc_html( $product->add_to_cart_text() )
           ),
       $product );
   }


/******STARTS FROM HERE SINGLE PAGE FUNCTIONS*******/

   //check if single product page
   if(function_exists('is_product') && !(is_shop()) ){
  //remove sale badge	
   remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
   
   //remove added to cart message
   add_filter( 'wc_add_to_cart_message_html', '__return_false' );
   
   
   //remove product rating
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
   
   //remove product price
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
   
   //remove product excerpt-1
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
   
   //remove product addtocart
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    
   //remove product meta
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
   //remove upsell   
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
   //remove related products  
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
   // filter woocommerce tabs
   add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
   function woo_remove_product_tabs( $tabs ) {
       unset( $tabs['description'] );      	// Remove the description tab  
       unset( $tabs['additional_information'] );  	// Remove the additional information tab
       return $tabs;
   
   }
   //single product summary
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
  


   //woocommerce upsell function
   	function ronby_woocommerce_upsell_display( $limit = '-1', $columns = 4, $orderby = 'rand', $order = 'desc' ) {
   		global $product;
   
   		if ( ! $product ) {
   			return;
   		}
   		if((ronby_get_option('ronby_single_product_upsells_limit'))){
   			$limit=ronby_get_option('ronby_single_product_upsells_limit');
   		}else{
   			$limit= '-1';
   		}
   		// Handle the legacy filter which controlled posts per page etc.
   		$args = apply_filters( 'woocommerce_upsell_display_args', array(
   			'posts_per_page' => $limit,
   			'orderby'        => $orderby,
   			'columns'        => $columns,
   		) );
   		wc_set_loop_prop( 'name', 'up-sells' );
   		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );
   
   		$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
   		$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );
   
   		// Get visible upsells then sort them at random, then limit result set.
   		$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
   		$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;
   
   if ( $upsells ) : ?>
<div class="container">
   <div class="row">
      <section class="up-sells upsells products fitness_single_layout_upsells">
         <div class="col-md-12">
            <div class="section-header-style-11">
               <h2 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'ronby' ) ?></h2>
            </div>
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php foreach ( $upsells as $upsell ) : ?>
         <?php
            $post_object = get_post( $upsell->get_id() );
            
            setup_postdata( $GLOBALS['post'] =& $post_object );
            
            wc_get_template_part( 'content', 'product' ); ?>
         <?php endforeach; ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   function ronby_woocommerce_cross_sell_display(){
       $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);
   
       if(empty($crosssells)){
           return;
       }
   		if((ronby_get_option('ronby_single_product_cross_sells_limit'))){
   			$limit=ronby_get_option('ronby_single_product_cross_sells_limit');
   		}else{
   			$limit= '-1';
   		}
       $args = array( 
           'post_type' => 'product', 
           'posts_per_page' => $limit, 
           'post__in' => $crosssells 
           );
       $products = new WP_Query( $args );
       if( $products->have_posts() ) :  ?>
<div class="container">
   <div class="row">
      <section class="fitness_single_layout_upsells cross_sells">
         <div class="col-md-12">
            <div class="section-header-style-11">
               <h2 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'ronby' ) ?></h2>
            </div>
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php
            while ( $products->have_posts() ) : $products->the_post();
            	wc_get_template_part( 'content', 'product' );
            endwhile; // end of the loop.					
            ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   function ronby_woocommerce_related_product_display(){
   global $product;
   
   if ( ! $product ) {
   return;
   }
   if((ronby_get_option('ronby_single_product_related_products_limit'))){
   $limit=ronby_get_option('ronby_single_product_related_products_limit');
   }else{
   $limit= '-1';
   }
   $defaults = array(
   'posts_per_page' => $limit, 
   'columns'        => 4,
   'orderby'        => 'rand', // @codingStandardsIgnoreLine.
   'order'          => 'desc',
   );
   
   $args = wp_parse_args($defaults );
   
   // Get visible related products then sort them at random.
   $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
   
   // Handle orderby.
   $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
   
   // Set global loop values.
   wc_set_loop_prop( 'name', 'related' );
   wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );
   
   if ( $args['related_products'] ) : ?>
<div class="container">
   <div class="row">
      <section class="related-products fitness_single_layout_upsells">
         <div class="col-md-12 nopadding">
			<div class="section-header-style-6">
				<h2 class="section-title"><?php echo ronby_get_option('ronby_single_product_related_products_title_1');?></h2>
				<h4 class="section-sub-title"><?php echo ronby_get_option('ronby_single_product_related_products_title_2');?></h4>
			</div>		
			<div class="section-description text-center">
			<?php echo ronby_get_option('ronby_single_product_related_products_desc');?>
			</div>			
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php foreach ( $args['related_products'] as $related_product ) : ?>
         <?php
            $post_object = get_post( $related_product->get_id() );
            
            setup_postdata( $GLOBALS['post'] =& $post_object );
            
            wc_get_template_part( 'content', 'product' ); ?>
         <?php endforeach; ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   //single product wrapper start
   add_action( 'woocommerce_before_single_product', 'ronby_single_product_wrapper_start', 15 );
   function ronby_single_product_wrapper_start() {
   echo ronby_page_heading_function();  
   echo'<div id="content" class="p-120-0-80 fitness-single-product-layout">	
			<section class="product-detail-1">
				<div class="container">
					<div class="mx-auto mx-width-850">
						<div class="row align-items-center">';   
   }
   
   //single product wrapper end
   add_action( 'woocommerce_after_single_product', 'ronby_single_product_wrapper_after', 15 );

   function ronby_single_product_wrapper_after() {
	global $product;   
   echo '</div></div></div>'; 
?>
<?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' ) || get_the_excerpt()){?>
<div class="product-detail-content fitness-singular-content mt-70">
   <div class="container">
      <div class="mx-auto mx-width-970">
         <?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' )){?>							
         <div class="product-additional-information mb-0">
            <div class="section-header-style-12">
               <h2 class="section-title"><?php esc_html_e('Additional information','ronby');?></h2>
            </div>
            <ul class="no-style">
               <?php if($product->get_weight()) { ?>								
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Weight:','ronby');?></span>
                  <span class="flex-fill"><?php echo esc_attr($product->get_weight()).' '.esc_attr(get_option( 'woocommerce_weight_unit' )) ?></span>
               </li>
               <?php } ?>									
               <?php if($product->get_length() && $product->get_width() && $product->get_height()) { ?>									
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Dimensions:','ronby');?></span>
                  <span class="flex-fill"><?php if($product->get_length()){echo esc_attr($product->get_length());}if($product->get_width()){echo' x '.esc_attr($product->get_width());}if($product->get_height()){echo ' x '.esc_attr($product->get_height());} echo ' '.esc_attr(get_option( 'woocommerce_dimension_unit' )); ?></span>
               </li>
               <?php } ?>										
               <?php if($product->get_attribute( 'Size' )) { ?>
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Size:','ronby');?></span>
                  <span class="flex-fill"><?php echo $product->get_attribute( 'Size' ); //escaped already ?></span>
               </li>
               <?php } ?>									
            </ul>
         </div>
         <?php } ?>							
         <div class="fitness-shop-single-layout-product-excerpt <?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' )){?>	mt-45 <?php } ?>">
            <?php echo the_content();?>
         </div>
      </div>
   </div>
</div>
<?php }					
	echo '</section>';				
?>
			
<?php	 
     if((comments_open()) && (is_shop() || is_product() || is_product_category() || is_product_taxonomy() || is_cart() || is_checkout())) {
     ronby_comment_and_review(); 
     }
     if(ronby_get_option('ronby_single_product_upsells_switch')==1){
   echo ronby_woocommerce_upsell_display();
     }
     if(ronby_get_option('ronby_single_product_cross_sells_switch')==1){   
   echo ronby_woocommerce_cross_sell_display(); 
     }
     if(ronby_get_option('ronby_single_product_related_products_switch')==1){   
   echo ronby_woocommerce_related_product_display();  
     }
   echo'</div>
   <!-- End Content -->';
  
	if(ronby_get_option('ronby_single_product_brand_slider_section') == 1){
    if (function_exists('blog_page_brand_carousel_slider'))blog_page_brand_carousel_slider();
   }    
   }
   //remove review tabs on loading page
    function ronby_woo_review_remove(){
   if(is_single()){	
   echo "<script>
      jQuery(document).ready(function() {
          jQuery('.woocommerce-tabs').remove();
      });
   </script>";
   }
   }
   add_action('wp_footer','ronby_woo_review_remove');  
   

   add_action( 'woocommerce_single_product_summary', 'ronby_woocommerce_summary_area', 10 );
   function ronby_woocommerce_summary_area(){	
   global $product;
   // get product_tags of the current product
   $current_tags = get_the_terms( get_the_ID(), 'product_tag' );
   $attributes = $product->get_attributes();
   $attribute_keys = array_keys( $attributes );
   $stock_qty= $product->get_stock_quantity();	
   if($stock_qty >= 1){
   	$availbility= "In Stock";
   }else{
   	$availbility= "Stock Out";
   }
   $average = round($product->get_average_rating());
   $i=0;
   global  $woocommerce;
   $currency= get_woocommerce_currency_symbol();
   $product_details = $product->get_data();
   if($product->is_type( 'simple' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();	
   }elseif($product->is_type( 'variable' )){
   #1 Get product variations
   if($product->get_available_variations()){
   $product_variations = $product->get_available_variations();
   #2 Get one variation id of a product
   $variation_product_id = $product_variations [0]['variation_id'];	
   #3 Create the product object
   $variation_product = new WC_Product_Variation( $variation_product_id );	
   #4 Use the variation product object to get the variation prices
   $regular_price= $currency.$variation_product ->get_regular_price();
   $sale_price= $currency.$variation_product ->get_sale_price();
   }else{
	$product_variations = '';
   $regular_price= '';
   $sale_price= '';	
   }
	
   }elseif($product->is_type( 'grouped' )){
   $regular_price='';
   $sale_price='';
   }elseif($product->is_type( 'external' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();
   }
   $max_value= $product->get_max_purchase_quantity();
   $min_value= $product->get_min_purchase_quantity();
   $input_name = 'quantity';
   $input_value = '1';
   $step = apply_filters( 'woocommerce_quantity_input_step', '1', $product );
   $classes =apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text','input-styled','qty-input-styled' ));
   $input_id= uniqid( 'quantity_' );
   
   /* translators: %s: Quantity. */
   $labelledby = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'ronby' ), wp_strip_all_tags( $args['product_name'] ) ) : '';	
   
$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
if ( comments_open() ) {
	if ( $num_comments == 0 ) {
		$comments = esc_html__('No Reviews','ronby');
	} elseif ( $num_comments > 1 ) {
		$comments = $num_comments . esc_html__(' Reviews','ronby');
	} else {
		$comments = esc_html__('1 Review','ronby');
	}
	
} 
   
   // Ajax add to cart button function
   function ronby_add_to_cart_button_single_product() {
      global $product;
      $classes = implode( ' ',  array(
          'button',
          'product_type_' . $product->get_type(),
          $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
          $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
      )  );
   
      return apply_filters( 'woocommerce_loop_add_to_cart_link',
          sprintf( '<button type="submit" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s hover-background-primary">'.esc_html( $product->add_to_cart_text() ).' <img src="'.esc_url(get_template_directory_uri()).'/images/loader.gif"  class="cart-loader-single fitness-cart-loader-single display-none" alt="'.esc_attr__('add-to-cart-loader','ronby').'"/></button>',
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->get_id() ),
              esc_attr( $product->get_sku() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( isset( $classes ) ? $classes : 'button' ),
              esc_attr( $product->get_type() ),
              esc_html( $product->add_to_cart_text() )
          ),
      $product );
   }
 
   // Ajax add to cart button function
   function ronby_add_to_cart_button_single_product_non_variation() {
      global $product;
      $classes = implode( ' ',  array(
          '',
          'product_type_' . $product->get_type(),
          $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
          $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
      )  );
   
      return apply_filters( 'woocommerce_loop_add_to_cart_link',
          sprintf( '<button type="submit" name="add-to-cart" value="'.esc_attr( $product->get_id() ).'" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="add_to_cart_button  hover-background-primary">'.esc_html( $product->add_to_cart_text() ).' <img src="'.esc_url(get_template_directory_uri()).'/images/loader.gif"  class="cart-loader-single fitness-cart-loader-single display-none"   alt="'.esc_attr__('add-to-cart-loader','ronby').'"/></button>',		
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->get_id() ),
              esc_attr( $product->get_sku() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( isset( $classes ) ? $classes : '' ),
              esc_attr( $product->get_type() ),
              esc_html( $product->add_to_cart_text() )
          ),
      $product );
   }
   
   //ajax add to cart loader function.this for variation product
   function add_cart_loader_single_product(){
   echo "<script>jQuery(document).ready(function(e){
   jQuery('.reset_variations').click(function(){
   jQuery('.entry-summary form.cart')[0].reset();	
   });
   jQuery('select').prop('required', true);
   jQuery('.input-text').prop('required', true);
   var jQuerywarp_fragment_refresh = {
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
      type: 'POST',
      success: function( data ) {
          if ( data && data.fragments ) {
              jQuery.each( data.fragments, function( key, value ) {
                  jQuery( key ).replaceWith( value );
              });
   
              jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
          }
      }
   };	
   jQuery('.entry-summary form.cart').on('submit', function (e)
   {
      e.preventDefault();
   jQuery('.added-cart-loader').hide();
   if(jQuery('select').val()==''){
   	jQuery('.cart-loader-single').hide();
   }else{
   jQuery('.cart-loader-single').show();	
      var product_url = window.location,
          form = jQuery(this);
   
      jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
      {
          var cart_dropdown = jQuery('.widget_shopping_cart', result)
   
          // update dropdown cart
          jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);
   
          // update fragments
          jQuery.ajax(jQuerywarp_fragment_refresh);
   	jQuery('.cart-loader-single').hide();
   	jQuery('.added-cart-loader').show();
   	jQuery('.single-product-cart-notice').show();
      });
   }
   });
   
   });</script>";
   }
   
   
   //ajax add to cart loader function. this for non variation product
   function add_cart_loader_single_product_2(){
   echo "<script>jQuery(document).ready(function(e){
   jQuery('.input-text').prop('required', true);
   var jQuerywarp_fragment_refresh = {
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
      type: 'POST',
      success: function( data ) {
          if ( data && data.fragments ) {
              jQuery.each( data.fragments, function( key, value ) {
                  jQuery( key ).replaceWith( value );
              });
   
              jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
          }
      }
   };	
   jQuery('.entry-summary form.cart').on('submit', function (e)
   {
      e.preventDefault();
   jQuery('.added-cart-loader').hide();
   jQuery('.cart-loader-single').show();	
      var product_url = window.location,
          form = jQuery(this);
   
      jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
      {
          var cart_dropdown = jQuery('.widget_shopping_cart', result)
   
          // update dropdown cart
          jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);
   
          // update fragments
          jQuery.ajax(jQuerywarp_fragment_refresh);
   	jQuery('.cart-loader-single').hide();
   	jQuery('.added-cart-loader2').show();
   	jQuery('.single-product-cart-notice').show();
      });
   });
   if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
   }
   });</script>";
   }
   
  
   echo"<div class='pt-3 summary-container'>";
   echo'<div class="d-flex align-items-center">';
   if(comments_open()){
   	if(!empty($average)){ 
   	echo '<div class="stars-rating rating-open" data-rate="5">';
   	while($i < $average){
   		echo"<span class='fas fa-star'></span>";
   		$i++;
   	}
   	echo'</div>';
   	}
	echo'<div class="review-count">('.esc_attr($comments).')</div>';
   }
	echo'</div>';  
	echo'<h2 class="product-name">'.esc_attr(get_the_title()).'</h2>';	
	if( $product->is_on_sale() ){ 
	echo "<h4 class='product-sub-title badge badge-danger text-white'>".esc_attr('Sale')."</h4>";
	}	
   	echo"<div class='d-flex align-items-center mb-3'>";
   	echo'<div class="product-price-1">';
   	if($product->is_on_sale()){
   		echo'<span class="sale-price color-primary mr-2">
   			'.esc_attr($sale_price).'
			</span>
			<span class="regular-price ">
				'.esc_attr($regular_price).'
			</span>';
   	}else{
   		echo'<span class="sale-price">
   			'.esc_attr($regular_price).'
   		</span>';	
   	}
   	echo'</div>';   
   if($product->is_type( 'variable' ) || $product->is_type( 'simple' )){
   	echo '<div class="product-stock">
   		'.esc_html__('Availability:','ronby').' <span class="ml-2 color-primary">'.esc_attr($availbility).'</span>
   	</div>';
   }		
   echo'</div><div class="product-description mb-3">'.$product_details['short_description'].'</div>';	
   ?>
<?php
   if($product->is_type( 'variable' )){
   $available_variations = $product->get_available_variations();	
   $attributes = $product->get_variation_attributes();
   $attribute_keys = array_keys( $attributes );	
   $attribute_name='';  
   }else{
   $available_variations = '';	
   $attributes = '';
   $attribute_keys = '';
   $attribute_name='';   
   }
   ?>
<?php if($product->is_type( 'variable' )){ ?>	
<?php do_action( 'woocommerce_before_variations_form' ); ?>
<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations) ); // WPCS: XSS ok. ?>">
   <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
   <p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'ronby' ); ?></p>
   <?php else : ?>		
   <div class="d-flex flex-wrap align-items-center mb-4">
   <?php if($product->get_available_variations()) { ?>
      <?php foreach ( $attributes as $attribute_name => $options ) : ?>		
      <div class="fitness-product-detail-quanty">
         <?php
            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product,'class' => 'input-styled') );
            ?>
      </div>
      <?php endforeach;?>			
   <?php } ?>			
      <div class=" ml-3">
	  <?php if($product->get_available_variations()) { ?>
         <?php  echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations  btn-dark btn-sm text-white cursor-pointer">' . esc_html__( 'Clear', 'ronby' ) . '</a>' ) : ''; ?>
		<?php } ?>
      </div>
   </div>
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <div class="single_variation_wrap">
      <div class="woocommerce-variation-add-to-cart variations_button">
         <?php
            do_action( 'woocommerce_before_add_to_cart_quantity' );
            if ( $max_value && $min_value === $max_value ) {
            	?>
         <div class="quantity hidden">
            <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
         </div>
         <?php
            } else {
            	?>
         <div class="quantity mb-4">
            <input
               type="number"
               id="<?php echo esc_attr( $input_id ); ?>"
               class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
               step="<?php echo esc_attr( $step ); ?>"
               min="<?php echo esc_attr( $min_value ); ?>"
               max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
               name="<?php echo esc_attr( $input_name ); ?>"
               value="<?php echo esc_attr( $input_value ); ?>"
               title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'ronby' ); ?>"
               size="4"
               <?php if ( ! empty( $labelledby ) ) { ?>
               aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" 
               <?php } ?>/>
         </div>
         <?php
            } 
            	do_action( 'woocommerce_after_add_to_cart_quantity' );		
            	?>
         <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
         <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
         <input type="hidden" name="variation_id" class="variation_id" value="0" />
      </div>
   </div>
   <div class="row align-items-center mb-4">
      <div class="col-auto">
         <?php
            echo ronby_add_to_cart_button_single_product();
          ?>
         <?php
            $args="";
            if(function_exists('ronby_woowishlist_add_button_single')){
            echo ronby_woowishlist_add_button_single($args);
            }
            ?>
         <?php
            if(function_exists('tm_woocompare_add_button_single')){
            echo tm_woocompare_add_button_single( $args );
            }
            ?>			
      </div>

      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10 hover-background-primary"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <?php 
   if(ronby_get_option('ronby_single_product_sku_meta_switch') == 1){
 		if($product->get_sku()){ echo'
   		<div class="product-id product-tags"><i class="fas fa-qrcode color-primary mr-2 "></i>
   			'.esc_attr('SKU:').' '.esc_attr($product->get_sku()).'
   		</div>
		';}
   }
   if(ronby_get_option('ronby_single_product_category_meta_switch') == 1){ 
          //create a list to hold our tags
          echo '<div class="product-tags"><i class="fas fa-tag color-primary mr-2"></i>';
          //for each tag we create a list item
		  echo 	wc_get_product_category_list($product->get_id());
          echo '</div>';
   }      
   if(ronby_get_option('ronby_single_product_tag_meta_switch') == 1){ 	  
      //only start if we have some tags
      if ( $current_tags && ! is_wp_error( $current_tags ) ) { 
          //create a list to hold our tags
          echo '<div class="product-tags"><i class="fas fa-tags color-primary mr-2"></i>';
          //for each tag we create a list item
		$i = 0;
		$c = count($current_tags);
          foreach ($current_tags as $tag) {
              $tag_title = $tag->name; // tag name
              $tag_link = get_term_link( $tag );// tag archive link
              echo '<a href="'.$tag_link.'" class="no-color">'.$tag_title.'</a>';
			  		if ($i++ < $c - 1) {
					echo   ', ';
					}
          }
          echo '</div>';
      }
   }
   if(ronby_get_option('ronby_single_product_social_share_meta_switch') == 1){    
     fitness_woo_social_share_meta();  
   }
      ?>	
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
   <?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_variations_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product' ); ?>	
<?php }elseif($product->is_type( 'simple' )){ ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>">
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php do_action( 'woocommerce_before_add_to_cart_quantity' );?>
   <div class="quantity mb-4">
      <input
         type="number"
         id="<?php echo esc_attr( $input_id ); ?>"
         class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
         step="<?php echo esc_attr( $step ); ?>"
         min="<?php echo esc_attr( $min_value ); ?>"
         max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
         name="<?php echo esc_attr( $input_name ); ?>"
         value="<?php echo esc_attr( $input_value ); ?>"
         title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'ronby' ); ?>"
         size="4"
         <?php if ( ! empty( $labelledby ) ) { ?>
         aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" 
         <?php } ?>/>
   </div>
   <?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
   <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
   <div class="row align-items-center mb-4">
      <div class="col-auto">
         <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
         <?php
            $args="";
            if(function_exists('ronby_woowishlist_add_button_single')){
            echo ronby_woowishlist_add_button_single($args);
            }
            ?>
         <?php
            if(function_exists('tm_woocompare_add_button_single')){
            echo tm_woocompare_add_button_single( $args );
            }
            ?>
      </div>
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <?php 
   if(ronby_get_option('ronby_single_product_sku_meta_switch') == 1){
 		if($product->get_sku()){ echo'
   		<div class="product-id product-tags"><i class="fas fa-qrcode color-primary mr-2 "></i>
   			'.esc_attr('SKU:').' '.esc_attr($product->get_sku()).'
   		</div>
		';}
   }
   if(ronby_get_option('ronby_single_product_category_meta_switch') == 1){ 
          //create a list to hold our tags
          echo '<div class="product-tags"><i class="fas fa-tag color-primary mr-2"></i>';
          //for each tag we create a list item
		  echo 	wc_get_product_category_list($product->get_id());
          echo '</div>';
   }      
   if(ronby_get_option('ronby_single_product_tag_meta_switch') == 1){ 	  
      //only start if we have some tags
      if ( $current_tags && ! is_wp_error( $current_tags ) ) { 
          //create a list to hold our tags
          echo '<div class="product-tags"><i class="fas fa-tags color-primary mr-2"></i>';
          //for each tag we create a list item
		$i = 0;
		$c = count($current_tags);
          foreach ($current_tags as $tag) {
              $tag_title = $tag->name; // tag name
              $tag_link = get_term_link( $tag );// tag archive link
              echo '<a href="'.$tag_link.'" class="no-color">'.$tag_title.'</a>';
			  		if ($i++ < $c - 1) {
					echo   ', ';
					}
          }
          echo '</div>';
      }
   }
   if(ronby_get_option('ronby_single_product_social_share_meta_switch') == 1){    
     fitness_woo_social_share_meta();  
   }
   ?>	
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product_2' ); ?>	
<?php }elseif($product->is_type( 'grouped' )){ 
   global $product, $post;
   
   do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
   <table cellspacing="0" class="woocommerce-grouped-product-list group_table fitness_layout_group_table">
      <tbody>
         <?php
            $products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );			
            	$quantites_required      = false;
            	$previous_post           = $post;
            	$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
            		'quantity',
            		'label',
            		'price',
            	), $product );
            
            	foreach ( $products as $grouped_product_child ) {
            		$post_object        = get_post( $grouped_product_child->get_id() );
            		$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
            		$post               = $post_object; // WPCS: override ok.
            		setup_postdata( $post );
            
            		echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child->get_id() ) ) ) . '">';
            
            		// Output columns for each product.
            		foreach ( $grouped_product_columns as $column_id ) {
            			do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );
            
            			switch ( $column_id ) {
            				case 'quantity':
            					ob_start();
            
            					if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
            						woocommerce_template_loop_add_to_cart();
            					} elseif ( $grouped_product_child->is_sold_individually() ) {
            						echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
            					} else {
            						do_action( 'woocommerce_before_add_to_cart_quantity' );
            
            echo '<input
            	type="number"
            	class="'.esc_attr( join( ' ', (array) $classes ) ).'"
            	min_value="'.apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ).'"
            	max_value="'.apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ).'"
            	name="quantity[' . $grouped_product_child->get_id() . ']"
            	input_value=""
            	value="'.esc_attr( $input_value ).'"
            	/>';
            														
            
            						do_action( 'woocommerce_after_add_to_cart_quantity' );
            					}
            
            					$value = ob_get_clean();
            					break;
            				case 'label':
            					$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
            					$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
            					$value .= '</label>';
            					break;
            				case 'price':
            					$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
            					break;
            				default:
            					$value = '';
            					break;
            			}
            
            			echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // WPCS: XSS ok.
            
            			do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
            		}
            
            		echo '</tr>';
            	}
            	$post = $previous_post; // WPCS: override ok.
            	setup_postdata( $post );
            	?>
      </tbody>
   </table>
   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
   <?php if ( $quantites_required ) : ?>
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
   <div class="row">
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
   <?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product_2' ); ?>	
<?php } elseif($product->is_type( 'external' )){ 
   global $product;
   ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="get">
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
   <?php wc_query_string_form_fields( $product->add_to_cart_url()); ?>
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php } ?>
<?php
   echo'</div>';
} 

//function for ronby comment and review
function ronby_comment_and_review(){
global $product;	
?>
<?php if (comments_open()) { ?>
<section class="<?php if(have_comments()){ ?> p-70-0 <?php } ?> woo-fitness-comment-section">
   <div class="container">
      <div class="mx-auto mx-width-970">
            <?php if($product->get_review_count()){ ?>
            <div class="section-header-style-5">
               <h2 class="section-title">
                  <?php
                     if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
                     	/* translators: 1: reviews count 2: product name */
                     	printf( esc_html( _n( '%1$s review', '%1$s reviews', $count, 'ronby' ) ), esc_html( $count ) );
                     } else {
                     	esc_html_e( 'Reviews', 'ronby' );
                     }
                     ?>
               </h2>
            </div>
            <?php } ?>
            <?php if ( have_comments() ) { ?>
            <ul class="list-comments">
               <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'ronby_woocommerce_comments' ) ) ); ?>
            </ul>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
               echo '<nav class="woocommerce-pagination">';
               paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
               	'prev_text' => '&larr;',
               	'next_text' => '&rarr;',
               	'type'      => 'list',
               ) ) );
               echo '</nav>';
               } ?>
            <?php } ?>			

      </div>
   </div>
</section>
<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) { ?>
<section class="mb-70 <?php if(comments_open() && !(have_comments())){ echo 'mt-70';}?>">
   <div class="container">
      <div class="mx-auto mx-width-970">
            <?php
               $commenter = wp_get_current_commenter();
              
               $comment_form = array(
               	'title_reply'          => have_comments() ? esc_html__( 'Post Review', 'ronby' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'ronby' ), get_the_title() ),
               	'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'ronby' ),
               	'title_reply_before'   => '<div class="section-header-style-5 mb-0"><h2 class="section-title">',
               	'title_reply_after'    => '</h2></div>',
               	'comment_notes_after'  => '',
				'comment_field' => '',
               );
               
               $comment_form['fields'] ='<div class="form-style-7">
               <div class="row align-items-center">';
               $comment_form['fields'] .= '<div class="col-lg-4"><div class="form-group">
                                <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
               $n_value = '';
               $e_value = '';
               $comment_form['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
               	 </div></div>';					 				 
               $comment_form['fields'] .= '<div class="col-lg-4"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
               
               if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
               $comment_form['fields'] .= '<div class="col-lg-4">
               				<div class="p-4 stars-rating">
               				<div class="form-group">
               				<i  class="mr-2 rating_color">'.esc_html__('Rating*','ronby').'</i> 
               	<div class=" rating-open d-inline-flex">
               	<select name="rating" id="ronby-woo-star-ratings" required>
               <option value="">' . esc_html__( '0', 'ronby' ) . '</option>
               <option value="1">' . esc_html__( '1', 'ronby' ) . '</option>
               <option value="2">' . esc_html__( '2', 'ronby' ) . '</option>
               <option value="3">' . esc_html__( '3', 'ronby' ) . '</option>
               <option value="4">' . esc_html__( '4', 'ronby' ) . '</option>
               <option value="5">' . esc_html__( '5', 'ronby' ) . '</option>
               </select></div>
               </div>
               </div>		
               </div>';
               }
               
               $comment_form['fields'] .='</div></div>';
               
               if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
               $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'ronby' ), esc_url( $account_page_url ) ) . '</p>';
               }
               if ( !is_user_logged_in() ) {  
               $comment_form['comment_field'] .= '<div class="form-style-7"><div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" class="input-styled" placeholder="'.esc_attr__("Review *", "ronby").'" required></textarea></div></div>';
               }else{
				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {   
               $comment_form['comment_field'] .= '               				
               				<div class="pl-0 stars-rating">
               				<div class="form-group">
               				<i  class="mr-2">'.esc_html__('Rating*','ronby').'</i> 
               	<div class="rating-open d-inline-flex">
               	<select name="rating" id="ronby-woo-star-ratings" required>
               <option value="">' . esc_html__( '0', 'ronby' ) . '</option>
               <option value="1">' . esc_html__( '1', 'ronby' ) . '</option>
               <option value="2">' . esc_html__( '2', 'ronby' ) . '</option>
               <option value="3">' . esc_html__( '3', 'ronby' ) . '</option>
               <option value="4">' . esc_html__( '4', 'ronby' ) . '</option>
               <option value="5">' . esc_html__( '5', 'ronby' ) . '</option>
               </select></div>
               </div>
               </div>';	
				}			   
               $comment_form['comment_field'] .= '<div class="clearfix"></div><div class="form-style-7"><div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" class="input-styled" placeholder="'.esc_attr__("Review *", "ronby").'" required></textarea></div></div>';	
               }					
               if ( !is_user_logged_in() ) {
               function ronby_woo_comment_form_submit_button($button) {
               $button ='<span class="form-group py-15px">';	
               $button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post review", "ronby").' </button>';
               $button .='</span>';	
               return $button;
               }
               add_filter('comment_form_submit_button', 'ronby_woo_comment_form_submit_button');//Submit button customization filter
               } else {
               function ronby_woo_comment_form_submit_button($button) {
               $button ='<span class="form-group py-15px">';
               $button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post review", "ronby").' </button>';
               $button .='</span>';
               return $button;
               }
               add_filter('comment_form_submit_button', 'ronby_woo_comment_form_submit_button');//Submit button customization filter
               }										
               comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
               ?>
            <?php if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) { 
               function ronby_woo_review_rating_script(){
               echo "<script>
               jQuery(document).ready(function(){
               jQuery('#ronby-woo-star-ratings').fontstar();
               });
               </script>";
               }
               add_action('wp_footer','ronby_woo_review_rating_script');
               } ?>
      </div>
   </div>
</section>
<?php } else { ?>
<section class="mb-70">
   <div class="container">
      <div class="mx-auto mx-width-970">
            <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'ronby' ); ?></p>
      </div>
   </div>
</section>
<?php } ?>	
<?php } ?>	
<?php }
   //Ronby woocommerce comments
   function ronby_woocommerce_comments($comment, $args, $depth ){
   	$GLOBALS['comment'] = $comment;
   	global $post;
	$count_rating=get_comment_meta( $comment->comment_ID, 'rating', true);
	$i=0;
	?>
<li>
   <div  <?php comment_class("comment-item-3"); ?> id="comment-<?php comment_ID() ?>">
      <div class="comment-avatar">
         <?php echo get_avatar($comment, 90, 'gravatar_default'); ?>
      </div>
      <div class="comment-content">
         <div class="comment-header">
            <span class="comment-author"><?php comment_author(); ?></span>
            <span class="comment-time"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
				<?php 
				if(!empty($count_rating)){ 
				echo '<div class="stars-rating d-inline-flex ml-4" data-rate="5">';
				while($i < $count_rating){
					echo"<span class='fas fa-star'></span>";
					$i++;
				}
				echo'</div>';
				}
				?>
		
            <div class="comment-actions">
               <?php comment_reply_link(array_merge( $args, array(
                  'reply_text' => esc_attr__('Reply Comment', 'ronby'),
                  'depth' => $depth, 
                  'max_depth' => $args['max_depth']
                  ))); ?>											
            </div>
         </div>
         <div class="comment-text">
            <?php comment_text()?>
         </div>
      </div>
   </div>
   <?php }
   
} //END Single product page Checking Condition from here
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text(){
	return 'Shop now';
}
//Social share meta function
function fitness_woo_social_share_meta(){
	global $product;
	$post = ronby_get_global_post();
	$postid = $product->get_id();	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/%20button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;	
?>
										<div class="social-6 mt-4">
											<ul>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($facebookURL);?>" class="no-color"><i class="fab fa-facebook"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($twitterURL);?>" class="no-color"><i class="fab fa-twitter"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($linkedInURL);?>" class="no-color"><i class="fab fa-linkedin-in"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($pinterestURL);?>" class="no-color"><i class="fab fa-pinterest-p"></i></a>
												</li>
											</ul>
										</div>
<?php	
}
 
/******END FROM HERE SINGLE PAGE FUNCTIONS*******/

/**********************************************
/*END FITNESS SHOP LAYOUT FUNCTIONS FROM HERE*/ 
/**********************************************/  
   } elseif(ronby_get_option('ronby_shop_page_layout')==2){
	   
	/**********************************************
	/*START FOOD SHOP LAYOUT FUNCTIONS FROM HERE*/ 
	/**********************************************/ 
	   
   /* Remove unnessary action from shop page */
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
   remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
   remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );	 
   
   // Remove woocommerce_breadcrumb
   remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
   
   // Remove woocommerce_show_page_title
   add_filter( 'woocommerce_show_page_title' , '__return_false' );
   
   // Remove woocommerce_sidebar
   remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
   
   // Remove the result count from WooCommerce
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
   
   // Remove the sorting dropdown from Woocommerce
   remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
   remove_action( 'woocommerce_shop_loop' , '__return_false' );
   
   // Remove the woocommerce_shop_loop_item_title
   remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
   
   // remove the woocommerce_shop_loop_item_title
   add_action('woocommerce_shop_loop_item_title', 'Change_Products_Title', 10 );
   function Change_Products_Title() {
       return false;
   }
      
   //remove output_content_wrapper
   remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
   
   //remove output_content_wrapper_end
   remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
   
   //remove product product link
   remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 
   
   //remove product product link
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
   
   //remove product add-to-cart
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );   

    //remove shop page product price
   remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
   
   //remove product thumbnail
   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
   
   // Remove the product rating display on product loops
   remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
   
   // **********************************************************************// 
   // ! Add page header function in shop page before content 
   // **********************************************************************//
   add_action( 'woocommerce_before_main_content', 'ronby_before_main_content_shop_page', 5 );
   function ronby_before_main_content_shop_page() {
       // Only on "shop" archives pages
       if(is_shop()  || is_product_category() || is_product_taxonomy()){
   	echo ronby_page_heading_function();
   echo '<div id="content" class="p-120-0 food_shop_layout">
		<section class="products">
      <div id="pagiloader" class="pagiloader"><img src="'. esc_url(get_template_directory_uri().'/images/blog-loader.gif') .'" class="img-responsive" alt="'.esc_attr__('blog-pagination-loader','ronby').'"/></div>
      <div class="content">
   		<div class="container">
   			<!-- Products -->
   			<div class="row">';		
   	}
   
   }
   
   // **********************************************************************// 
   // ! Add  function in shop page  after content 
   // **********************************************************************//
   add_action( 'woocommerce_after_main_content', 'ronby_after_main_content_shop_page', 15 );
   function ronby_after_main_content_shop_page() {
   if(is_shop()  || is_product_category() || is_product_taxonomy()){	
   echo '</div></div></div></section></div>';
   }
   }
   
   // Get Texnomy/category description
   add_action( 'woocommerce_archive_description', 'ronby_woo_product_archive_desc', 10 );
   function ronby_woo_product_archive_desc(){
   if(is_product_category() || is_product_taxonomy()){
    $cat = get_queried_object();	 
    $catID = $cat->term_id;
    
    global $product;
    echo"<div class='row mb-5'><div class='col-md-12'>";
    echo category_description($catID);
    echo "</div></div>";	
    }
   }
   	   
   //add product wrapper
   add_action( 'woocommerce_before_shop_loop_item', 'product_article_wrapper_before', 15 ); 
   function product_article_wrapper_before() {
   echo '<!-- Product-item -->
	<div class="col-md-12">
	<article class="product-item-3 text-center">';
   }
   
   //add product wrapper
   add_action( 'woocommerce_after_shop_loop_item', 'product_article_wrapper_after', 15 );
   function product_article_wrapper_after() {
   echo '</article>';
   echo '</div>';
   echo '<!-- End Product-item -->';
   }
     
   //Change Sell Badge filter
   add_filter('woocommerce_sale_flash', 'ronby_change_sale_content', 10, 3);
   function ronby_change_sale_content($content, $post, $product){
	if(ronby_get_option('ronby_woo_product_sale_badge_style') == 1){   
	$content= '<div class="ribbon">
			  <div class="ribbon-wrap">
				<span class="ribbon6 item-badge-red">'.esc_attr__('Sale','ronby').'</span>
			  </div>
			</div>';
	}elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 2){		
	$content= '<div class="ribbon">
				<span class="ribbon1 text-white"><span>'.esc_attr__('Sale','ronby').'</span></span>
			</div>';
	}elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 3){
	$content= '<div class="ribbon">
				<span class="ribbon2 text-white">'.esc_attr__('S','ronby').'<br>'.esc_attr__('A','ronby').'<br>'.esc_attr__('L','ronby').'<br>'.esc_attr__('E','ronby').'</span>
			</div>';
	}
      return $content;
   }
 
   //add product thumbnail
   add_action( 'woocommerce_before_shop_loop_item_title', 'ronby_product_wrapper', 10 );   
   function ronby_product_wrapper(){
   global $post;
   global $product;
   global $redux;
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
   $i=0;
   $average = round($product->get_average_rating());
   $args="";

   	echo'<div class="position-relative">
   		<div class="thumbnail animate-zoom d-flex">
   			<a href="'.esc_url(get_the_permalink()).'">';
   			if($image){
   			echo'	<img src="'.esc_url($image[0]).'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && !empty($redux['ronby_single_product_placeholder']['url'])){
   				echo'<img src="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';					
   				}else{
   				echo'<img src="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" alt="'.esc_attr__('product-featured-image', 'ronby').'">';					
   				}   				
   			}
   			echo'</a>
   		</div>
   		<div class="item-buttons product-action-buttons-1 d-flex justify-content-center">';
   			if($image){
				echo'<a href="'.esc_url($image[0]).'" class="hover-background-primary" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';
   			}else{
   				if(isset($redux['ronby_single_product_placeholder']['url']) && !empty($redux['ronby_single_product_placeholder']['url'])){
				echo'<a href="'.esc_url($redux['ronby_single_product_placeholder']['url']).'" class="hover-background-primary" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';
   				}else{
				echo'<a href="'.esc_url(get_template_directory_uri().'/images/dummy-product-image.jpg').'" class="hover-background-primary" data-lightbox="featured-image">
					<i class="fas fa-search"></i></a>';				
   				}   				
   			}
            if(function_exists('ronby_woowishlist_add_button_single')){
              echo ronby_woowishlist_add_button_single($args);
            }	
			if(ronby_get_option('ronby_shop_page_quick_view_switch')){
			echo'
				<a href="'.esc_url('#0').'" class="hover-background-primary quick_view" data-product-id="'.esc_attr($product->get_id()).'" >
					<i class="fas fa-eye"></i>
				</a>';
			}
			echo ronby_add_to_cart_button();	
		echo '</div>';
			
   		if(!empty($average)){ 
   		echo '<div class="stars-rating" data-rate="5">';
   		while($i < $average){
   			echo"<span class='fas fa-star'></span>";
   			$i++;
   		}
   		echo'</div>';
   		}

   echo'<a class="no-color" href="'.esc_url(get_the_permalink()).'">
   			<h3 class="product-name animate-300 hover-color-primary">
   				'.esc_attr(get_the_title()).'
   			</h3>
   		</a>';
								  
   echo '<div class="product-price-1">';
   echo'<a class="no-color" href="'.esc_url(get_the_permalink()).'">';

			echo '<span class="sale-price color-primary">'.$product->get_price_html().'</span>';
   
   echo'</a>';
   	echo '</div>';
   	echo '</div>';
   	echo '';
   }

   //custom woocommerce pagination function
   add_filter( 'woocommerce_pagination_args', 	'ronby_woo_pagination' );
   function ronby_woo_pagination( $args ) {
   	$args['prev_text'] = esc_attr('PREV');
   	$args['next_text'] = esc_attr('NEXT');
   	return $args;
   }

   	// **********************************************************************// 
   // ! Woocommerce Pagination without loading
   // **********************************************************************//
   //if the page is shop page
   if(function_exists('is_shop') || is_product_category() || is_product_taxonomy()) {
   function ronby_woo_pagination_without_loading() {
   echo "
   	<script>
   	jQuery(function(jQuery) {
   	jQuery('#pagiloader').hide();	
       jQuery('.food_shop_layout').on('click', '.page-numbers a', function(e){
           e.preventDefault();
           var link = jQuery(this).attr('href');
           jQuery('.content').fadeOut(1500, function(){
   			jQuery('#pagiloader').show();
   			jQuery('html, body').animate({
   			scrollTop: jQuery('.food_shop_layout').offset().top - 100
   		}, 1000);
               jQuery(this).load(link + ' .content', function() {
   				jQuery('#pagiloader').hide();
                   jQuery(this).fadeIn(1500);
   				jQuery('.add_to_cart_button').click(function(){
   				jQuery(this).find('.cart-loader').show();
   			});				
               });
           });
       });
   });
   </script>
   ";
   }
   add_action( 'wp_footer','ronby_woo_pagination_without_loading' );
   } 
   // Ensure cart contents update when products are added to the cart via AJAX 
   add_filter( 'woocommerce_add_to_cart_fragments', 'ronby_cart_count_fragments', 10, 1 );
   function ronby_cart_count_fragments( $fragments ) {  
   if((WC()->cart->get_cart_contents_count()) <= 1 ){
   	$item= esc_attr(' Item');
   	}else{
   	$item= esc_attr(' Items');
   	} 	
       $fragments['.cart-badge'] = '<span class="badge bg-secondary cart-badge text-white">' . esc_attr(WC()->cart->get_cart_contents_count()) . '</span>';   
   	$fragments['.cart-total-items'] = '<a class="no-color nopadding cart-total-items">' . esc_attr(WC()->cart->get_cart_contents_count()).esc_attr($item).' </a>';	
   	$fragments['.cart-total-price'] = '<a class="no-color nopadding cart-total-price"> '.WC()->cart->get_cart_total().'</a>';	
       return $fragments;    
   } 
   // Ajax add to cart button function
   function ronby_add_to_cart_button() {
       global $product;
       $classes = implode( ' ',  array(
           'button',
           'product_type_' . $product->get_type(),
           $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
           $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
       )  );
   
       return apply_filters( 'woocommerce_loop_add_to_cart_link',
           sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="product_type_%s  hover-background-primary"><i class="fas fa-shopping-basket"></i></a>',
               esc_url( $product->add_to_cart_url() ),
               esc_attr( $product->get_id() ),
               esc_attr( $product->get_sku() ),
               esc_attr( isset( $quantity ) ? $quantity : 1 ),
               esc_attr( isset( $classes ) ? $classes : 'button' ),
               esc_attr( $product->get_type() ),
               esc_html( $product->add_to_cart_text() )
           ),
       $product );
   }


/******STARTS FROM HERE SINGLE PAGE FUNCTIONS*******/

   //check if single product page
   if(function_exists('is_product') && !(is_shop()) ){
  //remove sale badge	
   remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
   
   //remove added to cart message
   add_filter( 'wc_add_to_cart_message_html', '__return_false' );
   
   
   //remove product rating
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
   
   //remove product price
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
   
   //remove product excerpt-1
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
   
   //remove product addtocart
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    
   //remove product meta
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
   //remove upsell   
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
   //remove related products  
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
   // filter woocommerce tabs
   add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
   function woo_remove_product_tabs( $tabs ) {
       unset( $tabs['description'] );      	// Remove the description tab  
       unset( $tabs['additional_information'] );  	// Remove the additional information tab
       return $tabs;
   
   }
   //single product summary
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
  
   //woocommerce upsell function
   	function ronby_woocommerce_upsell_display( $limit = '-1', $columns = 4, $orderby = 'rand', $order = 'desc' ) {
   		global $product;
   
   		if ( ! $product ) {
   			return;
   		}
   		if((ronby_get_option('ronby_single_product_upsells_limit'))){
   			$limit=ronby_get_option('ronby_single_product_upsells_limit');
   		}else{
   			$limit= '-1';
   		}
   		// Handle the legacy filter which controlled posts per page etc.
   		$args = apply_filters( 'woocommerce_upsell_display_args', array(
   			'posts_per_page' => $limit,
   			'orderby'        => $orderby,
   			'columns'        => $columns,
   		) );
   		wc_set_loop_prop( 'name', 'up-sells' );
   		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );
   
   		$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
   		$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );
   
   		// Get visible upsells then sort them at random, then limit result set.
   		$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
   		$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;
   
   if ( $upsells ) : ?>
<div class="container">
   <div class="row">
      <section class="up-sells upsells products food_single_layout_upsells">
         <div class="col-md-12">
            <div class="section-header-style-11">
               <h2 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'ronby' ) ?></h2>
            </div>
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php foreach ( $upsells as $upsell ) : ?>
         <?php
            $post_object = get_post( $upsell->get_id() );
            
            setup_postdata( $GLOBALS['post'] =& $post_object );
            
            wc_get_template_part( 'content', 'product' ); ?>
         <?php endforeach; ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   function ronby_woocommerce_cross_sell_display(){
       $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);
   
       if(empty($crosssells)){
           return;
       }
   		if((ronby_get_option('ronby_single_product_cross_sells_limit'))){
   			$limit=ronby_get_option('ronby_single_product_cross_sells_limit');
   		}else{
   			$limit= '-1';
   		}
       $args = array( 
           'post_type' => 'product', 
           'posts_per_page' => $limit, 
           'post__in' => $crosssells 
           );
       $products = new WP_Query( $args );
       if( $products->have_posts() ) :  ?>
<div class="container">
   <div class="row">
      <section class="food_single_layout_upsells cross_sells">
         <div class="col-md-12">
            <div class="section-header-style-11">
               <h2 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'ronby' ) ?></h2>
            </div>
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php
            while ( $products->have_posts() ) : $products->the_post();
            	wc_get_template_part( 'content', 'product' );
            endwhile; // end of the loop.					
            ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   function ronby_woocommerce_related_product_display(){
   global $product;
   
   if ( ! $product ) {
   return;
   }
   if((ronby_get_option('ronby_single_product_related_products_limit'))){
   $limit=ronby_get_option('ronby_single_product_related_products_limit');
   }else{
   $limit= '-1';
   }
   $defaults = array(
   'posts_per_page' => $limit, 
   'columns'        => 4,
   'orderby'        => 'rand', // @codingStandardsIgnoreLine.
   'order'          => 'desc',
   );
   
   $args = wp_parse_args($defaults );
   
   // Get visible related products then sort them at random.
   $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
   
   // Handle orderby.
   $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
   
   // Set global loop values.
   wc_set_loop_prop( 'name', 'related' );
   wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );
   
   if ( $args['related_products'] ) : ?>
<div class="container">
   <div class="row">
      <section class="related-products food_single_layout_upsells">
         <div class="col-md-12 nopadding">
			<div class="section-header-style-6">
				<h2 class="section-title"><?php echo ronby_get_option('ronby_single_product_related_products_title_1');?></h2>
				<h4 class="section-sub-title"><?php echo ronby_get_option('ronby_single_product_related_products_title_2');?></h4>
			</div>		
			<div class="section-description text-center">
			<?php echo ronby_get_option('ronby_single_product_related_products_desc');?>
			</div>			
         </div>
         <?php woocommerce_product_loop_start(); ?>
         <?php foreach ( $args['related_products'] as $related_product ) : ?>
         <?php
            $post_object = get_post( $related_product->get_id() );
            
            setup_postdata( $GLOBALS['post'] =& $post_object );
            
            wc_get_template_part( 'content', 'product' ); ?>
         <?php endforeach; ?>
         <?php woocommerce_product_loop_end(); ?>
      </section>
   </div>
</div>
<?php endif;
   wp_reset_postdata();
   }
   
   //single product wrapper start
   add_action( 'woocommerce_before_single_product', 'ronby_single_product_wrapper_start', 15 );
   function ronby_single_product_wrapper_start() {
   echo ronby_page_heading_function();  
   echo'<div id="content" class="p-120-0 food-single-product-layout">	
		<div class="container">
			<section class="product-detail-header-2">
				<div class="container">
						<div class="row justify-content-center">';   
   }
   
   //single product wrapper end
   add_action( 'woocommerce_after_single_product', 'ronby_single_product_wrapper_after', 15 );

   function ronby_single_product_wrapper_after() {
	global $product;   
   echo '</div></div>'; 
					
	echo '</section>';				
			
	echo '<div class="row justify-content-center"><div class="col-xl-10"><div class="product-detail-content-2 text-content-area ';if(($product->get_upsell_ids()) || (wc_get_related_products( $product->get_id())) || ($product->get_cross_sell_ids())){ echo"mb-50";}echo'">';	
?>
<?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' ) || get_the_excerpt()){?>


         <?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' )){?>							
         <div class="product-attributes mb-0">

               <h2 class="box-title"><?php esc_html_e('Additional information','ronby');?></h2>

            <ul class="list-unstyled">
               <?php if($product->get_weight()) { ?>								
               <li class="d-flex">
                  <span class="lb"><?php esc_html_e('Weight:','ronby');?></span>
                  <span><?php echo esc_attr($product->get_weight()).' '.esc_attr(get_option( 'woocommerce_weight_unit' )) ?></span>
               </li>
               <?php } ?>									
               <?php if($product->get_length() && $product->get_width() && $product->get_height()) { ?>									
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Dimensions:','ronby');?></span>
                  <span class="flex-fill"><?php if($product->get_length()){echo esc_attr($product->get_length());}if($product->get_width()){echo' x '.esc_attr($product->get_width());}if($product->get_height()){echo ' x '.esc_attr($product->get_height());} echo ' '.esc_attr(get_option( 'woocommerce_dimension_unit' )); ?></span>
               </li>
               <?php } ?>										
               <?php if($product->get_attribute( 'Size' )) { ?>
               <li class="d-flex">
                  <span class="lb flex-auto"><?php esc_html_e('Size:','ronby'); ?></span>
                  <span class="flex-fill"><?php echo $product->get_attribute( 'Size' ); //escaped already ?></span>
               </li>
               <?php } ?>									
            </ul>
         </div>
         <?php } ?>							
         <div class="food-shop-single-layout-product-excerpt <?php if($product->has_dimensions() || $product->get_weight() || ($product->get_length() && $product->get_width() && $product->get_height()) || $product->get_attribute( 'Size' )){?>	mt-45 <?php } ?>">
            <?php echo the_content();?>
         </div>


<?php }
     if((comments_open()) && (is_shop() || is_product() || is_product_category() || is_product_taxonomy() || is_cart() || is_checkout())) {
     ronby_comment_and_review(); 
     }	
	echo '</div></div></div>';				
?>
			
<?php	 

     if(ronby_get_option('ronby_single_product_upsells_switch')==1){
   echo ronby_woocommerce_upsell_display();
     }
     if(ronby_get_option('ronby_single_product_cross_sells_switch')==1){   
   echo ronby_woocommerce_cross_sell_display(); 
     }
     if(ronby_get_option('ronby_single_product_related_products_switch')==1){   
   echo ronby_woocommerce_related_product_display();  
     }
   echo'</div></div>
   <!-- End Content -->';
	if(ronby_get_option('ronby_single_product_brand_slider_section') == 1){
    if (function_exists('blog_page_brand_carousel_slider'))blog_page_brand_carousel_slider();
   }    
   }
   //remove review tabs on loading page
    function ronby_woo_review_remove(){
   if(is_single()){	
   echo "<script>
      jQuery(document).ready(function() {
          jQuery('.woocommerce-tabs').remove();
      });
   </script>";
   }
   }
   add_action('wp_footer','ronby_woo_review_remove');  

//Add Price Badge 
global $product;
 
add_action( 'woocommerce_product_thumbnails' , 'ronby_price_badge', 5 );
function ronby_price_badge() {
global $product;
   $currency= get_woocommerce_currency_symbol();
   $product_details = $product->get_data();
   if($product->is_type( 'simple' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();	
   }elseif($product->is_type( 'variable' )){
   #1 Get product variations
   if($product->get_available_variations()){
   $product_variations = $product->get_available_variations();
   #2 Get one variation id of a product
   $variation_product_id = $product_variations [0]['variation_id'];	
   #3 Create the product object
   $variation_product = new WC_Product_Variation( $variation_product_id );	
   #4 Use the variation product object to get the variation prices
   $regular_price= $currency.$variation_product ->get_regular_price();
   $sale_price= $currency.$variation_product ->get_sale_price();
   }else{
	$product_variations = '';
   $regular_price= '';
   $sale_price= '';	
   }
	
   }elseif($product->is_type( 'grouped' )){
   $regular_price='';
   $sale_price='';
   }elseif($product->is_type( 'external' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();
   }
if(!($product->is_type( 'grouped' ))){
    echo '<div class="product-price-badge background-primary ';if(!($product->is_on_sale())){echo'pt-38';}echo'">';
   	if($product->is_on_sale()){
   		echo'<span class="sale-price">
   			'.esc_attr($sale_price).'
			</span><br>
			<span class="regular-price "><del> 
				'.esc_attr($regular_price).'
			</del></span>';
   	}else{
   		echo'<span class="sale-price">
   			'.esc_attr($regular_price).'
   		</span>';	
   	}
    echo '</div>';	
}   
}
 


   add_action( 'woocommerce_single_product_summary', 'ronby_woocommerce_summary_area', 10 );
   function ronby_woocommerce_summary_area(){	
	global $product;
   // get product_tags of the current product
   $current_tags = get_the_terms( get_the_ID(), 'product_tag' );
   $attributes = $product->get_attributes();
   $attribute_keys = array_keys( $attributes );
   $stock_qty= $product->get_stock_quantity();	
   if($stock_qty >= 1){
   	$availbility= "In Stock";
   }else{
   	$availbility= "Stock Out";
   }
   $average = round($product->get_average_rating());
   $i=0;
   global  $woocommerce;
   $currency= get_woocommerce_currency_symbol();
   $product_details = $product->get_data();
   if($product->is_type( 'simple' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();	
   }elseif($product->is_type( 'variable' )){
   #1 Get product variations
   if($product->get_available_variations()){
   $product_variations = $product->get_available_variations();
   #2 Get one variation id of a product
   $variation_product_id = $product_variations [0]['variation_id'];	
   #3 Create the product object
   $variation_product = new WC_Product_Variation( $variation_product_id );	
   #4 Use the variation product object to get the variation prices
   $regular_price= $currency.$variation_product ->get_regular_price();
   $sale_price= $currency.$variation_product ->get_sale_price();
   }else{
	$product_variations = '';
   $regular_price= '';
   $sale_price= '';	
   }
	
   }elseif($product->is_type( 'grouped' )){
   $regular_price='';
   $sale_price='';
   }elseif($product->is_type( 'external' )){
   $regular_price=$currency.$product->get_regular_price();
   $sale_price=$currency.$product->get_sale_price();
   }
   $max_value= $product->get_max_purchase_quantity();
   $min_value= $product->get_min_purchase_quantity();
   $input_name = 'quantity';
   $input_value = '1';
   $step = apply_filters( 'woocommerce_quantity_input_step', '1', $product );
   $classes =apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text','input-styled','qty-input-styled' ));
   $input_id= uniqid( 'quantity_' );
   
   /* translators: %s: Quantity. */
   $labelledby = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'ronby' ), wp_strip_all_tags( $args['product_name'] ) ) : '';	
   

   // Ajax add to cart button function
   function ronby_add_to_cart_button_single_product() {
      global $product;
      $classes = implode( ' ',  array(
          'button',
          'product_type_' . $product->get_type(),
          $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
          $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
      )  );
   
      return apply_filters( 'woocommerce_loop_add_to_cart_link',
          sprintf( '<button type="submit" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s button button-primary rounded">'.esc_html( $product->add_to_cart_text() ).' <img src="'.esc_url(get_template_directory_uri()).'/images/loader.gif"  class="cart-loader-single food-cart-loader-single display-none" alt="'.esc_attr__('add-to-cart-loader','ronby').'"/></button>',
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->get_id() ),
              esc_attr( $product->get_sku() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( isset( $classes ) ? $classes : 'button' ),
              esc_attr( $product->get_type() ),
              esc_html( $product->add_to_cart_text() )
          ),
      $product );
   }
 
   // Ajax add to cart button function
   function ronby_add_to_cart_button_single_product_non_variation() {
      global $product;
      $classes = implode( ' ',  array(
          '',
          'product_type_' . $product->get_type(),
          $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
          $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
      )  );
   
      return apply_filters( 'woocommerce_loop_add_to_cart_link',
          sprintf( '<button type="submit" name="add-to-cart" value="'.esc_attr( $product->get_id() ).'" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="add_to_cart_button  button button-primary rounded">'.esc_html( $product->add_to_cart_text() ).' <img src="'.esc_url(get_template_directory_uri()).'/images/loader.gif"  class="cart-loader-single food-cart-loader-single display-none"   alt="'.esc_attr__('add-to-cart-loader','ronby').'"/></button>',		
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->get_id() ),
              esc_attr( $product->get_sku() ),
              esc_attr( isset( $quantity ) ? $quantity : 1 ),
              esc_attr( isset( $classes ) ? $classes : '' ),
              esc_attr( $product->get_type() ),
              esc_html( $product->add_to_cart_text() )
          ),
      $product );
   }
   
   //ajax add to cart loader function.this for variation product
   function add_cart_loader_single_product(){
   echo "<script>jQuery(document).ready(function(e){
   jQuery('.reset_variations').click(function(){
   jQuery('.entry-summary form.cart')[0].reset();	
   });
   jQuery('select').prop('required', true);
   jQuery('.input-text').prop('required', true);
   var jQuerywarp_fragment_refresh = {
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
      type: 'POST',
      success: function( data ) {
          if ( data && data.fragments ) {
              jQuery.each( data.fragments, function( key, value ) {
                  jQuery( key ).replaceWith( value );
              });
   
              jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
          }
      }
   };	
   jQuery('.entry-summary form.cart').on('submit', function (e)
   {
      e.preventDefault();
   jQuery('.added-cart-loader').hide();
   if(jQuery('select').val()==''){
   	jQuery('.cart-loader-single').hide();
   }else{
   jQuery('.cart-loader-single').show();	
      var product_url = window.location,
          form = jQuery(this);
   
      jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
      {
          var cart_dropdown = jQuery('.widget_shopping_cart', result)
   
          // update dropdown cart
          jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);
   
          // update fragments
          jQuery.ajax(jQuerywarp_fragment_refresh);
   	jQuery('.cart-loader-single').hide();
   	jQuery('.added-cart-loader').show();
   	jQuery('.single-product-cart-notice').show();
      });
   }
   });
   
   });</script>";
   }
   
   
   //ajax add to cart loader function. this for non variation product
   function add_cart_loader_single_product_2(){
   echo "<script>jQuery(document).ready(function(e){
   jQuery('.input-text').prop('required', true);
   var jQuerywarp_fragment_refresh = {
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
      type: 'POST',
      success: function( data ) {
          if ( data && data.fragments ) {
              jQuery.each( data.fragments, function( key, value ) {
                  jQuery( key ).replaceWith( value );
              });
   
              jQuery( document.body ).trigger( 'wc_fragments_refreshed' );
          }
      }
   };	
   jQuery('.entry-summary form.cart').on('submit', function (e)
   {
      e.preventDefault();
   jQuery('.added-cart-loader').hide();
   jQuery('.cart-loader-single').show();	
      var product_url = window.location,
          form = jQuery(this);
   
      jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
      {
          var cart_dropdown = jQuery('.widget_shopping_cart', result)
   
          // update dropdown cart
          jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);
   
          // update fragments
          jQuery.ajax(jQuerywarp_fragment_refresh);
   	jQuery('.cart-loader-single').hide();
   	jQuery('.added-cart-loader2').show();
   	jQuery('.single-product-cart-notice').show();
      });
   });
   if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
   }
   });</script>";
   }
    
   echo"<div class='summary-container'>";
   echo'<h2 class="product-name">'.esc_attr(get_the_title()).'</h2>';
	if( $product->is_on_sale() ){ 
	echo "<span class='product-sub-title badge badge-danger text-white background-primary'>".esc_attr('Sale')."</span>";
	}    
   echo'<div class="product-meta d-flex flex-wrap">';
   echo '<span class="product-date mr-4">'.esc_attr(get_the_date()).'</span>';
   if(comments_open()){
   	if(!empty($average)){ 
   	echo '<div class="stars-rating rating-open" data-rate="5">';
   	while($i < $average){
   		echo"<span class='fas fa-star'></span>";
   		$i++;
   	}
   	echo'</div>';
   	}
	
   }
	echo'</div>';  
$gallery_image_ids=$product->get_gallery_image_ids();
$count_ids=count($gallery_image_ids);
if($count_ids > 0){
   	if($product->is_on_sale()){
   		echo'<span class="sale-price color-primary mr-2">
   			'.esc_attr($sale_price).'
			</span>
			<span class="regular-price "> 
				<del>'.esc_attr($regular_price).'</del>
			</span>';
   	}else{
   		echo'<span class="sale-price color-primary">
   			'.esc_attr($regular_price).'
   		</span>';	
   	}	
}

	
   	echo"<div class='product-meta d-flex flex-wrap mb-3'>";
  		
    echo'</div><div class="product-description mb-3">'.$product_details['short_description'].'</div>';	
   ?>
<?php
   if($product->is_type( 'variable' )){
   $available_variations = $product->get_available_variations();	
   $attributes = $product->get_variation_attributes();
   $attribute_keys = array_keys( $attributes );	
   $attribute_name='';  
   }else{
   $available_variations = '';	
   $attributes = '';
   $attribute_keys = '';
   $attribute_name='';   
   }
   ?>
<?php if($product->is_type( 'variable' )){ ?>	
<?php do_action( 'woocommerce_before_variations_form' ); ?>
<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations) ); // WPCS: XSS ok. ?>">
   <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
   <p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'ronby' ); ?></p>
   <?php else : ?>		
   <div class="d-flex flex-wrap align-items-center mb-4">
   <?php if($product->get_available_variations()) { ?>
      <?php foreach ( $attributes as $attribute_name => $options ) : ?>		
      <div class="food-product-detail-quanty">
         <?php
            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product,'class' => 'input-styled') );
            ?>
      </div>
      <?php endforeach;?>			
   <?php } ?>			
      <div class=" ml-3">
	  <?php if($product->get_available_variations()) { ?>
         <?php  echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations  btn-dark btn-sm text-white cursor-pointer">' . esc_html__( 'Clear', 'ronby' ) . '</a>' ) : ''; ?>
		<?php } ?>
      </div>
   </div>
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <div class="single_variation_wrap">
      <div class="woocommerce-variation-add-to-cart variations_button">
         <?php
            do_action( 'woocommerce_before_add_to_cart_quantity' );
            if ( $max_value && $min_value === $max_value ) {
            	?>
         <div class="quantity hidden">
            <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
         </div>
         <?php
            } else {
            	?>
         <div class="row flex-wrap">
		 <div class="col-auto mb-4">
		 <div class="custom-number-input-2 d-flex">
		 									<span class="input-increase flex-auto">
										<i class="fas fa-caret-up"></i>
									</span>	
									
            <input
               type="number"
               id="<?php echo esc_attr( $input_id ); ?>"
               class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
               step="<?php echo esc_attr( $step ); ?>"
               min="<?php echo esc_attr( $min_value ); ?>"
               max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
               name="<?php echo esc_attr( $input_name ); ?>"
               value="<?php echo esc_attr( $input_value ); ?>"
               title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'ronby' ); ?>"
               size="4"
               <?php if ( ! empty( $labelledby ) ) { ?>
               aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" 
               <?php } ?>/>
			   						<span class="input-decrease flex-auto">
										<i class="fas fa-caret-down"></i>
									</span>	
									
         </div>
         </div>
      <div class="col-auto mb-4">
         <?php
            echo ronby_add_to_cart_button_single_product();
          ?>		
      </div>		 
         </div>
         <?php
            } 
            	do_action( 'woocommerce_after_add_to_cart_quantity' );		
            	?>
         <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
         <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
         <input type="hidden" name="variation_id" class="variation_id" value="0" />
      </div>
   </div>
   <div class="row align-items-center mb-4">

      <div class="col-auto">
         <?php
            $args="";
            if(function_exists('ronby_woowishlist_add_button_single') && ronby_get_option('ronby_single_product_wishlist_meta_switch') ==1){
            echo ronby_woowishlist_add_button_single($args);
            }
            ?>
         <?php
            if(function_exists('tm_woocompare_add_button_single') && ronby_get_option('ronby_single_product_compare_meta_switch') ==1){
            echo tm_woocompare_add_button_single( $args );
            }
            ?>			
      </div>
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart  btn-sm ml-2 p-10 button button-primary rounded"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <div class="blog-post-list-categories">
   <?php 
   if(ronby_get_option('ronby_single_product_sku_meta_switch') == 1){
 		if($product->get_sku()){ echo'
   		<div class="product-id product-tags"><span class="color-primary">'.esc_attr('SKU: ').'</span>
   			 '.esc_attr($product->get_sku()).'
   		</div>
		';}
   }
   if(ronby_get_option('ronby_single_product_category_meta_switch') == 1){ 
          //create a list to hold our tags
          echo '<div class="product-tags"><span class="color-primary">'.esc_attr('Category: ').'</span>';
          //for each tag we create a list item
		  echo 	wc_get_product_category_list($product->get_id());
          echo '</div>';
   }      
   if(ronby_get_option('ronby_single_product_tag_meta_switch') == 1){ 	  
      //only start if we have some tags
      if ( $current_tags && ! is_wp_error( $current_tags ) ) { 
          //create a list to hold our tags
          echo '<div class="product-tags"><span class="color-primary">'.esc_attr('Tags: ').'</span>';
          //for each tag we create a list item
		$i = 0;
		$c = count($current_tags);
          foreach ($current_tags as $tag) {
              $tag_title = $tag->name; // tag name
              $tag_link = get_term_link( $tag );// tag archive link
              echo '<a href="'.$tag_link.'" class="no-color">'.$tag_title.'</a>';
			  		if ($i++ < $c - 1) {
					echo   ', ';
					}
          }
          echo '</div>';
      }
   }
   if(ronby_get_option('ronby_single_product_social_share_meta_switch') == 1){    
     food_woo_social_share_meta();  
   }
      ?>   
   </div>
	
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
   <?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_variations_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product' ); ?>	
<?php }elseif($product->is_type( 'simple' )){ ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>">
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php do_action( 'woocommerce_before_add_to_cart_quantity' );?>
         <div class="row flex-wrap">
		 <div class="col-auto mb-4">
		 <div class="custom-number-input-2 d-flex">
		 									<span class="input-increase flex-auto">
										<i class="fas fa-caret-up"></i>
									</span>	
									
            <input
               type="number"
               id="<?php echo esc_attr( $input_id ); ?>"
               class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
               step="<?php echo esc_attr( $step ); ?>"
               min="<?php echo esc_attr( $min_value ); ?>"
               max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
               name="<?php echo esc_attr( $input_name ); ?>"
               value="<?php echo esc_attr( $input_value ); ?>"
               title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'ronby' ); ?>"
               size="4"
               <?php if ( ! empty( $labelledby ) ) { ?>
               aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" 
               <?php } ?>/>
			   						<span class="input-decrease flex-auto">
										<i class="fas fa-caret-down"></i>
									</span>	
									
         </div>
         </div>
      <div class="col-auto mb-4">
         <?php
            echo ronby_add_to_cart_button_single_product_non_variation();
          ?>		
      </div>		 
         </div>
   <?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
   <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
   <div class="row align-items-center mb-4">

      <div class="col-auto">
         <?php
            $args="";
            if(function_exists('ronby_woowishlist_add_button_single') && ronby_get_option('ronby_single_product_wishlist_meta_switch') ==1){
            echo ronby_woowishlist_add_button_single($args);
            }
            ?>
         <?php
            if(function_exists('tm_woocompare_add_button_single') && ronby_get_option('ronby_single_product_compare_meta_switch') ==1){
            echo tm_woocompare_add_button_single( $args );
            }
            ?>			
      </div>
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart  btn-sm ml-2 p-10 button button-primary rounded"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
   <div class="blog-post-list-categories">
   <?php 
   if(ronby_get_option('ronby_single_product_sku_meta_switch') == 1){
 		if($product->get_sku()){ echo'
   		<div class="product-id product-tags"><span class="color-primary">'.esc_attr('SKU: ').'</span>
   			 '.esc_attr($product->get_sku()).'
   		</div>
		';}
   }
   if(ronby_get_option('ronby_single_product_category_meta_switch') == 1){ 
          //create a list to hold our tags
          echo '<div class="product-tags"><span class="color-primary">'.esc_attr('Category: ').'</span>';
          //for each tag we create a list item
		  echo 	wc_get_product_category_list($product->get_id());
          echo '</div>';
   }      
   if(ronby_get_option('ronby_single_product_tag_meta_switch') == 1){ 	  
      //only start if we have some tags
      if ( $current_tags && ! is_wp_error( $current_tags ) ) { 
          //create a list to hold our tags
          echo '<div class="product-tags"><span class="color-primary">'.esc_attr('Tags: ').'</span>';
          //for each tag we create a list item
		$i = 0;
		$c = count($current_tags);
          foreach ($current_tags as $tag) {
              $tag_title = $tag->name; // tag name
              $tag_link = get_term_link( $tag );// tag archive link
              echo '<a href="'.$tag_link.'" class="no-color">'.$tag_title.'</a>';
			  		if ($i++ < $c - 1) {
					echo   ', ';
					}
          }
          echo '</div>';
      }
   }
   if(ronby_get_option('ronby_single_product_social_share_meta_switch') == 1){    
     food_woo_social_share_meta();  
   }
      ?>   
   </div>	
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product_2' ); ?>	
<?php }elseif($product->is_type( 'grouped' )){ 
   global $product, $post;
   
   do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
   <table cellspacing="0" class="woocommerce-grouped-product-list group_table food_layout_group_table">
      <tbody>
         <?php
            $products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );			
            	$quantites_required      = false;
            	$previous_post           = $post;
            	$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
            		'quantity',
            		'label',
            		'price',
            	), $product );
            
            	foreach ( $products as $grouped_product_child ) {
            		$post_object        = get_post( $grouped_product_child->get_id() );
            		$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
            		$post               = $post_object; // WPCS: override ok.
            		setup_postdata( $post );
            
            		echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child->get_id() ) ) ) . '">';
            
            		// Output columns for each product.
            		foreach ( $grouped_product_columns as $column_id ) {
            			do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );
            
            			switch ( $column_id ) {
            				case 'quantity':
            					ob_start();
            
            					if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
            						woocommerce_template_loop_add_to_cart();
            					} elseif ( $grouped_product_child->is_sold_individually() ) {
            						echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
            					} else {
            						do_action( 'woocommerce_before_add_to_cart_quantity' );
            
            echo '<input
            	type="number"
            	class="'.esc_attr( join( ' ', (array) $classes ) ).'"
            	min_value="'.apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ).'"
            	max_value="'.apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ).'"
            	name="quantity[' . $grouped_product_child->get_id() . ']"
            	input_value=""
            	value="'.esc_attr( $input_value ).'"
            	/>';
            														
            
            						do_action( 'woocommerce_after_add_to_cart_quantity' );
            					}
            
            					$value = ob_get_clean();
            					break;
            				case 'label':
            					$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
            					$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
            					$value .= '</label>';
            					break;
            				case 'price':
            					$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
            					break;
            				default:
            					$value = '';
            					break;
            			}
            
            			echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // WPCS: XSS ok.
            
            			do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
            		}
            
            		echo '</tr>';
            	}
            	$post = $previous_post; // WPCS: override ok.
            	setup_postdata( $post );
            	?>
      </tbody>
   </table>
   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
   <?php if ( $quantites_required ) : ?>
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
   <div class="row">
      <div class="col-md-12 mt-4 single-product-cart-notice display-none">
         <div class=" single-product-cart-msg">	
            <span><i class="fas fa-info-circle"></i> <?php esc_attr_e('Product have been added to your cart.','ronby');?></span>
            <a href="<?php echo esc_url(wc_get_cart_url());?>" class="view-cart btn btn-warning text-white  btn-sm ml-2 p-10"><?php esc_html_e('View Cart','ronby');?></a>	
         </div>
      </div>
   </div>
    <div class="blog-post-list-categories">
   <?php      
   if(ronby_get_option('ronby_single_product_social_share_meta_switch') == 1){    
     food_woo_social_share_meta();  
   }
   ?>   
   </div>  
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
   <?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php add_action( 'wp_footer','add_cart_loader_single_product_2' ); ?>	
<?php } elseif($product->is_type( 'external' )){ 
   global $product;
   ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="get">
   <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
   <?php echo ronby_add_to_cart_button_single_product_non_variation(); ?>
   <?php wc_query_string_form_fields( $product->add_to_cart_url()); ?>
   <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php } ?>
<?php
   echo'</div>';
} 

//function for ronby comment and review
function ronby_comment_and_review(){
global $product;	
?>
<?php if (comments_open()) { ?>
<section class="<?php if(have_comments()){ ?> p-70-0 <?php } ?> woo-food-comment-section">

            <?php if($product->get_review_count()){ ?>
            <div class="section-header-style-14">
               <h2 class="section-title">
                  <?php
                     if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
                     	/* translators: 1: reviews count 2: product name */
                     	printf( esc_html( _n( '%1$s Review', '%1$s Reviews', $count, 'ronby' ) ), esc_html( $count ) );
                     } else {
                     	esc_html_e( 'Reviews', 'ronby' );
                     }
                     ?>
               </h2>
            </div>
            <?php } ?>
            <?php if ( have_comments() ) { ?>
            <ul class="list-comments">
               <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'ronby_woocommerce_comments' ) ) ); ?>
            </ul>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
               echo '<nav class="woocommerce-pagination">';
               paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
               	'prev_text' => '&larr;',
               	'next_text' => '&rarr;',
               	'type'      => 'list',
               ) ) );
               echo '</nav>';
               } ?>
            <?php } ?>			


</section>
<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) { ?>
<section class="mb-70 <?php if(comments_open() && !(have_comments())){ echo 'mt-70';}?>">

            <?php
               $commenter = wp_get_current_commenter();
              
               $comment_form = array(
               	'title_reply'          => have_comments() ? esc_html__( 'Add Review', 'ronby' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'ronby' ), get_the_title() ),
               	'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'ronby' ),
               	'title_reply_before'   => '<div class="section-header-style-14 mb-0"><h2 class="section-title">',
               	'title_reply_after'    => '</h2></div>',
               	'comment_notes_after'  => '',
				'comment_field' => '',
               );
               
               $comment_form['fields'] ='<div class="form-style-8">
               <div class="row align-items-center">';
               if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
               $comment_form['fields'] .= '<div class="col-lg-12">
               				<div class="stars-rating">
               				<div class="form-group">
               				<i  class="mr-2 rating_color">'.esc_html__('Rating*','ronby').'</i> 
               	<div class=" rating-open d-inline-flex">
               	<select name="rating" id="ronby-woo-star-ratings" required>
               <option value="">' . esc_html__( '0', 'ronby' ) . '</option>
               <option value="1">' . esc_html__( '1', 'ronby' ) . '</option>
               <option value="2">' . esc_html__( '2', 'ronby' ) . '</option>
               <option value="3">' . esc_html__( '3', 'ronby' ) . '</option>
               <option value="4">' . esc_html__( '4', 'ronby' ) . '</option>
               <option value="5">' . esc_html__( '5', 'ronby' ) . '</option>
               </select></div>
               </div>
               </div>		
               </div>';
               }			   
               $comment_form['fields'] .= '<div class="col-lg-12"><div class="form-group">
                                <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
               $n_value = '';
               $e_value = '';
               $comment_form['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
               	 </div></div>';					 				 
               $comment_form['fields'] .= '<div class="col-lg-12"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
               

               
               $comment_form['fields'] .='</div></div>';
               
               if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
               $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'ronby' ), esc_url( $account_page_url ) ) . '</p>';
               }
               if ( !is_user_logged_in() ) {  
               $comment_form['comment_field'] .= '<div class="form-style-8"><div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" class="input-styled" placeholder="'.esc_attr__("Review *", "ronby").'" required></textarea></div></div>';
               }else{
				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {   
               $comment_form['comment_field'] .= '               				
               				<div class="pl-0 stars-rating">
               				<div class="form-group">
               				<i  class="mr-2 rating_color">'.esc_html__('Rating*','ronby').'</i> 
               	<div class="rating-open d-inline-flex">
               	<select name="rating" id="ronby-woo-star-ratings" required>
               <option value="">' . esc_html__( '0', 'ronby' ) . '</option>
               <option value="1">' . esc_html__( '1', 'ronby' ) . '</option>
               <option value="2">' . esc_html__( '2', 'ronby' ) . '</option>
               <option value="3">' . esc_html__( '3', 'ronby' ) . '</option>
               <option value="4">' . esc_html__( '4', 'ronby' ) . '</option>
               <option value="5">' . esc_html__( '5', 'ronby' ) . '</option>
               </select></div>
               </div>
               </div>';	
				}			   
               $comment_form['comment_field'] .= '<div class="clearfix"></div><div class="form-style-8"><div class="form-group"><textarea id="comment" name="comment" cols="45" rows="8" class="input-styled" placeholder="'.esc_attr__("Review *", "ronby").'" required></textarea></div></div>';	
               }					
               if ( !is_user_logged_in() ) {
               function ronby_woo_comment_form_submit_button($button) {
               $button ='<span class="form-group py-15px">';	
               $button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded">'.esc_attr__("Post review", "ronby").' </button>';
               $button .='</span>';	
               return $button;
               }
               add_filter('comment_form_submit_button', 'ronby_woo_comment_form_submit_button');//Submit button customization filter
               } else {
               function ronby_woo_comment_form_submit_button($button) {
               $button ='<span class="form-group py-15px">';
               $button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded">'.esc_attr__("Post review", "ronby").' </button>';
               $button .='</span>';
               return $button;
               }
               add_filter('comment_form_submit_button', 'ronby_woo_comment_form_submit_button');//Submit button customization filter
               }										
               comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
               ?>
            <?php if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) { 
               function ronby_woo_review_rating_script(){
               echo "<script>
               jQuery(document).ready(function(){
               jQuery('#ronby-woo-star-ratings').fontstar();
               });
               </script>";
               }
               add_action('wp_footer','ronby_woo_review_rating_script');
               } ?>

</section>
<?php } else { ?>
<section class="mb-70">
   <div class="container">
      <div class="row">
            <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'ronby' ); ?></p>
      </div>
   </div>
</section>
<?php } ?>	
<?php } ?>	
<?php }
   //Ronby woocommerce comments
   function ronby_woocommerce_comments($comment, $args, $depth ){
   	$GLOBALS['comment'] = $comment;
   	global $post;
	$count_rating=get_comment_meta( $comment->comment_ID, 'rating', true);
	$i=0;
	?>
<li>
   <div  <?php comment_class("comment-item-6"); ?> id="comment-<?php comment_ID() ?>">
      <div class="comment-avatar">
        <?php echo get_avatar($comment, 90, 'gravatar_default'); ?>
      </div>
      <div class="comment-content">
         <div class="comment-header d-flex flex-wrap justify-content-between">

            <span class="comment-author"><?php comment_author(); ?></span>
            <span class="comment-time"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
	

				<?php 
				if(!empty($count_rating)){ 
				echo '<div class="stars-rating d-inline-flex ml-4" data-rate="5">';
				while($i < $count_rating){
					echo"<span class='fas fa-star'></span>";
					$i++;
				}
				echo'</div>';
				}
				?>
		            <div class="comment-actions">
               <?php comment_reply_link(array_merge( $args, array(
                  'reply_text' => esc_attr__('Reply', 'ronby'),
                  'depth' => $depth, 
                  'max_depth' => $args['max_depth']
                  ))); ?>											
            </div>		

         </div>
         <div class="comment-text">
            <?php comment_text()?>
         </div>
      </div>
   </div>
   <?php }
   
} //END Single product page Checking Condition from here
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text(){
	return 'Add to cart';
}
//Social share meta function
function food_woo_social_share_meta(){
	global $product;
	$post = ronby_get_global_post();
	$postid = $product->get_id();	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/%20button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;	
?>
										<div class="social-6 mt-4">
											<ul>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($facebookURL);?>" class="no-color"><i class="fab fa-facebook"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($twitterURL);?>" class="no-color"><i class="fab fa-twitter"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($linkedInURL);?>" class="no-color"><i class="fab fa-linkedin-in"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($pinterestURL);?>" class="no-color"><i class="fab fa-pinterest-p"></i></a>
												</li>
											</ul>
										</div>
<?php	
}
 
/******END FROM HERE SINGLE PAGE FUNCTIONS*******/
   function ronby_product_badge_remove(){
   if(is_single()){	
   echo "<script>
      jQuery(document).ready(function() {
          jQuery('.flex-viewport .product-price-badge').remove();
      });
   </script>";
   }
   }
   add_action('wp_footer','ronby_product_badge_remove');
/**********************************************
/*END FOOD SHOP LAYOUT FUNCTIONS FROM HERE*/ 
/**********************************************/  
   }