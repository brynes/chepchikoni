<?php
// **********************************************************************// 
// ! Custom Logo
// **********************************************************************//
function ronby_the_custom_logo() {
   if ( function_exists( 'the_custom_logo' ) ) {
      the_custom_logo();
   }
}

// **********************************************************************// 
// ! Excerpt and Content Limit
// **********************************************************************//
function ronby_excerpt($excerpt_limit) {
      $excerpt = explode(' ', get_the_excerpt(), $excerpt_limit);

      if (count($excerpt) >= $excerpt_limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}
function ronby_excerpt_non_featured_img($word_limit) {
      $excerpt = explode(' ', get_the_excerpt(), $word_limit);

      if (count($excerpt) >= $word_limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}

function ronby_theme_excerpt_length( $length ) {
	return 150;
}
add_filter( 'excerpt_length', 'ronby_theme_excerpt_length', 999 );

function ronby_content($content_limit) {
    $content = explode(' ', get_the_content(), $content_limit);

    if (count($content) >= $content_limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }

    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);

    return $content;
}
// **********************************************************************// 
// ! Getting Theme Fonts
// **********************************************************************//
// Arimo, Arvo, Montserrat, Poppins, Lato, pinyon and cormorant garamond Font function
function ronby_custom_google_fonts_arimo_montserrat_poppins() {
$fonts_url = '';
$font_families[] = 'Arimo:400,400i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
$query_args = array(
'family' => urlencode( implode( '|', $font_families ) ),
);
$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
return esc_url_raw( $fonts_url );
}

function ronby_custom_google_fonts_josefin_sans_cookie() {
$fonts_url = '';
$font_families[] = 'Josefin Sans:100,300,400,400i,600,700|Cookie';
$query_args = array(
'family' => urlencode( implode( '|', $font_families ) ),
);
$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
return esc_url_raw( $fonts_url );
}

function ronby_custom_google_fonts_arvo() {
$fonts_url = 'https://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i';
return esc_url_raw( $fonts_url );
}
// **********************************************************************// 
// ! Get Global Variables
// **********************************************************************//
function ronby_get_global_post() {
    global $post;
    if ( 
        ! $post instanceof \WP_Post
    ) {
        return false;
    }
    return $post;
}

function ronby_get_global_wpquery() {
    global $wp_query;
    return $wp_query;
}

function ronby_get_global_numpages() {
    global $numpages;
    return $numpages;
}

// **********************************************************************// 
// ! Set Content Width
// **********************************************************************// 
if (!isset($content_width)) { $content_width = 825; }


 // *********************************************************************************// 
// ! Add a pingback url auto-discovery header for single posts, pages, or attachments.
// **********************************************************************************//
function ronby_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ronby_pingback_header' );

// **********************************************************************// 
// ! Custom Pagination
// **********************************************************************//
function ronby_custom_pagination()
{
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'show_all'     => false,
		'end_size'     => 0,
		'mid_size'     => 2,
		'prev_next'    => true,
		'prev_text'    => esc_html__('PREV','ronby'),
		'next_text'    => esc_html__('NEXT','ronby'),
		'type'         => 'list',
		'add_args'     => false,
		'add_fragment' => ''
	) ); 
?>

<script>
jQuery(document).ready(function(){
            jQuery('.page-navi .next').parents('li').addClass('page-navi-text background-primary');    
            jQuery('.page-navi .prev').parents('li').addClass('page-navi-text background-primary');  
            jQuery('.page-navi span.current').parents('li').addClass(' background-primary');	
            jQuery('.page-navi li').addClass(' hover-background-primary');			
});
</script>
<?php 
}

// **********************************************************************// 
// ! Pagination without loading
// **********************************************************************//

function ronby_pagination_without_loading() {
echo "
	<script>
	jQuery(function(jQuery) {
	jQuery('#pagiloader').hide();	
    jQuery('.content').on('click', '.page-numbers a', function(e){
        e.preventDefault();
        var link = jQuery(this).attr('href');
        jQuery('.content').fadeOut(1500, function(){
			jQuery('#pagiloader').show();
			jQuery('html, body').animate({
			scrollTop: jQuery('#content').offset().top - 100
		}, 1000);
            jQuery(this).load(link + ' .content', function() {
				jQuery('#pagiloader').hide();
                jQuery(this).fadeIn(1500);
				jQuery('.page-navi .next').parents('li').addClass('page-navi-text background-primary');    
            jQuery('.page-navi .prev').parents('li').addClass('page-navi-text background-primary'); 
			jQuery('.page-navi span.current').parents('li').addClass(' background-primary');
            jQuery('.page-navi li').addClass(' hover-background-primary');				
            });
        });
    });
});
</script>
";
}
// **********************************************************************// 
// ! Newsletter without loading
// **********************************************************************//
function ronby_newsletter_without_loading(){
 ?>
        <script>
            jQuery(document).ready(function(){
				jQuery(".newsletter-loader").css("display", "none");
                jQuery('.newsletter').on("submit", function(e){
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();
					var data = {};                 
                    var email = jQuery("#newsletter-email").val();
                    jQuery.ajax({
                        type: "POST",
						dataType: 'json',
						  beforeSend: function(){
							jQuery(".newsletter-loader").css("display", "block");
						  },
                        url: "<?php echo esc_url(plugin_dir_url(''));?>the_ronby_extensions/modules/subscribe.php",
                        data: {email1:email},
						complete: function(){
							jQuery(".newsletter")[0].reset();
							jQuery(".newsletter-loader").css("display", "none");
						  },
                        success: function(data){
						jQuery('.output').html(data);
                        },	
						error: function(data){
						jQuery('.output').html('Sorry, Something is wrong. Try again later.');
						  },
					  
                    });
                });
            });
        </script>
<?php 
}

// **********************************************************************// 
// ! Getting rid of archive "label"
// **********************************************************************//
function ronby_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author();
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_month() ) {
	    $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'ronby' ) );
	} elseif ( is_year() ) {
	    $title = esc_html__('Posts from ', 'ronby') .get_the_date( _x( 'Y', 'yearly archives date format', 'ronby' ) );
	} elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
 
add_filter( 'get_the_archive_title', 'ronby_theme_archive_title' );

// **********************************************************************// 
// ! Adding Conditional Class to Body
// **********************************************************************//
add_filter( 'body_class', 'ronby_body_custom_class' );
function ronby_body_custom_class( $classes ) {
	$header_style_themeoptions = ronby_get_option('ronby_header_main_menu_style');
	if( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && ($header_style_themeoptions == 1)) ){
        $classes[] = 'business-header-used';
    } elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && ($header_style_themeoptions == 2)) ){
		$classes[] = 'construction-header-used';
	} elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && ($header_style_themeoptions == 3)) ){
		$classes[] = 'fitness-header-used';
	} elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && ($header_style_themeoptions == 4)) ){
		$classes[] = 'medical-header-used';
	} elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && ($header_style_themeoptions == 5)) ){
		$classes[] = 'fashion-header-used';
	} elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && ($header_style_themeoptions == 6)) ){
		$classes[] = 'restaurant-header-used';
	} else {
		$classes[] = 'business-header-used';
	}
	
	if(ronby_get_option('ronby_site_layout_style') == 1){
		$classes[] = 'layout-1';
	}elseif(ronby_get_option('ronby_site_layout_style') == 2){
		$classes[] = 'layout-2';
	}elseif(ronby_get_option('ronby_site_layout_style') == 3){
		$classes[] = 'layout-3';
	}elseif(ronby_get_option('ronby_site_layout_style') == 4){
		$classes[] = 'layout-4';
	}elseif(ronby_get_option('ronby_site_layout_style') == 5){
		$classes[] = 'layout-5';
	}elseif(ronby_get_option('ronby_site_layout_style') == 6){
		$classes[] = 'layout-6';
	}

    return $classes;
}

// **********************************************************************// 
// ! Page Header Function
// **********************************************************************//
function ronby_page_heading_function() {
global $post;
if( !(is_404()) && !(is_search())  && (class_exists('woocommerce')) && !(is_shop()) && !(is_product())){
if(is_a($post, 'WP_Post')){
$postid = $post->ID;
} else {
$postid = 1;
}
// Retrieves the stored value from the database
$ronby_page_heading_one_meta = get_post_meta( $postid, 'ronby_page_heading_one', true );
$ronby_page_heading_two_meta = get_post_meta( $postid, 'ronby_page_heading_two', true );
} else {
$ronby_page_heading_one_meta = '';
$ronby_page_heading_two_meta = '';
}
if( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1)) ){ ?>
  <div class="page-header-1" id="page-header">
    <div class="overlay">       
      <div class="container">
        <div class="inner-content d-flex flex-column justify-content-center">
		
		<?php if(is_front_page()){ ?>
		
		    <h1 class="page-header-title 1">
			<?php echo esc_attr(get_bloginfo('name')); ?>
			</h1>
			<h4 class="page-header-sub-title color-primary">
			<?php echo esc_attr(get_bloginfo('description')); ?>
			</h4>
			
		<?php }elseif(is_home() ){ ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_one'))) { ?>
		
          <h1 class="page-header-title 2"><?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_one'));?></h1>
		  
		<?php }else{ ?> 
		
		  <h1 class="page-header-title 3">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if((ronby_get_option('blog_page_header_sec_title_two'))) { ?>	
		
          <h4 class="page-header-sub-title color-primary 4">
		  <?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_two'));?>
		  </h4>
		  
		<?php } ?>
		
		<?php }elseif(is_page() ){ ?>
		
		<?php if(!empty($ronby_page_heading_one_meta)) { ?>
		
          <h1 class="page-header-title 5"><?php echo esc_attr($ronby_page_heading_one_meta);?></h1>
		  
		<?php }else{ ?> 
		
		  <h1 class="page-header-title 6">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if(!empty($ronby_page_heading_two_meta)) { ?>	
		
          <h4 class="page-header-sub-title color-primary">
		  <?php echo esc_attr($ronby_page_heading_two_meta);?>
		  </h4>
		  
		<?php } ?>		
		
		<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>
		
		<h1 class="page-header-title 7"><?php if(ronby_get_option('blog_post_header_sec_title_one')){echo esc_attr(ronby_get_option('blog_post_header_sec_title_one'));}else{echo esc_attr__('Blog Detail','ronby');} ?></h1>
		<?php if(ronby_get_option('blog_post_header_sec_title_two')){ ?>
		<h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_post_header_sec_title_two')); ?>
		</h4>
		<?php } ?>
		
		<?php } elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(( is_post_type_archive( 'product' ) ) && !(is_product_category()) && !(is_product_taxonomy()))) { ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title(); //archive title ?></h1>
		
		<?php } elseif(is_archive() && !(is_author()) && !class_exists('woocommerce')) { ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title(); //archive title ?></h1>
		
		<?php } elseif(is_category() ) { ?>
		
		<h1 class="page-header-title 9"><?php single_cat_title(); ?></h1>
		
		<?php } elseif(is_search()) { ?>	
		
		<h1 class="page-header-title 11"><?php echo esc_attr__('Search','ronby');?></h1>		
		
		<h4 class="page-header-sub-title">
		  <?php echo esc_html__('Search Results for: ','ronby');?><?php echo esc_attr(the_search_query());?>
		</h4>
		
		<?php } elseif(is_author() ) { ?>		
		
		<h1 class="page-header-title 10"><?php if((get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){echo esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));} else {echo get_the_author_meta('display_name');} ?></h1>	

		<h4 class="page-header-sub-title">
		  <?php echo esc_attr__('Author','ronby'); ?>
		</h4>		
		
		<?php } elseif(is_404() || is_page_template('404.php') && !(is_search())) { ?>

		<h1 class="page-header-title"><?php esc_html_e('404 - NOT FOUND!','ronby'); ?></h1>	
		
		<?php } elseif(class_exists('woocommerce') && is_shop()){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));} else { esc_html_e('Shop','ronby');} ?></h1>
		
		<?php if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')); ?>
		</h4>
		
		<?php } ?>		
		<?php } elseif(class_exists('woocommerce') && is_product()){  ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_single_product_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));} else { esc_html_e('PRODUCT DETAIL','ronby');} ?></h1>
	
		<?php if(ronby_get_option('ronby_single_product_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')); ?>
		</h4>	
		
		<?php }  ?>
		<?php } elseif(class_exists('woocommerce') && is_product_category()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>		

		<?php } elseif(class_exists('woocommerce') && is_product_taxonomy()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>

		<?php }  ?>
		
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();}
		}
		?>
		
        </div> 
      </div>
    </div>      
  </div>
<?php } elseif( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==2) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 2)) ){ ?>
		<div class="page-header-2" id="page-header">
			<div class="overlay">
				<div class="container">
					<div class="page-header-inner">

		<?php if(is_front_page()){ ?>
		
		    <h1 class="page-header-title">
			<?php echo esc_attr(get_bloginfo('name')); ?>
			</h1>
			<h4 class="page-header-sub-title">
			<?php echo esc_attr(get_bloginfo('description')); ?>
			</h4>
			
		<?php } elseif(is_home()){ ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_one'))) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_one'));?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if((ronby_get_option('blog_page_header_sec_title_two'))) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_two'));?>
		  </h4>
		  
		<?php } ?>
		
		<?php } elseif(is_page()){ ?>
		
		<?php if(!empty($ronby_page_heading_one_meta)) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr($ronby_page_heading_one_meta);?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if(!empty($ronby_page_heading_two_meta)) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr($ronby_page_heading_two_meta);?>
		  </h4>
		  
		<?php } ?>		
		
		<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>

		<h1 class="page-header-title"><?php if(ronby_get_option('blog_post_header_sec_title_one')){echo esc_attr(ronby_get_option('blog_post_header_sec_title_one'));} else {echo esc_attr__('Blog Detail','ronby');}?></h1>
		<?php if(ronby_get_option('blog_post_header_sec_title_two')){ ?>
		<h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_post_header_sec_title_two')); ?>
		</h4>
		<?php } ?>
		
		<?php } elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) &&!(is_product_taxonomy()) && !(is_product_category())) { ?>

		<h1 class="page-header-title"><?php echo get_the_archive_title(); //archive title ?></h1>
		
		<?php } elseif(is_category() ) { ?>
		
		<h1 class="page-header-title"><?php single_cat_title(); ?></h1>	
		
		<?php } elseif(is_search()) { ?>	
		
		<h1 class="page-header-title"><?php echo esc_attr__('Search','ronby');?></h1>		
		
		<h4 class="page-header-sub-title">
		  <?php echo esc_html__('Search Results for: ','ronby');?><?php echo esc_attr(the_search_query());?>
		</h4>
		
		<?php } elseif(is_author()) { ?>		
		
		<h1 class="page-header-title 10"><?php if((get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){echo esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));} else {echo get_the_author_meta('display_name');} ?></h1>

		<h4 class="page-header-sub-title">
		  <?php echo esc_attr__('Author','ronby'); ?>
		</h4>		
		
		<?php } elseif(is_404() || is_page_template('404.php')) { ?>

		<h1 class="page-header-title"><?php esc_html_e('404 - NOT FOUND!','ronby'); ?></h1>	
		
		<?php } elseif(class_exists('woocommerce') && is_shop()){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));} else { esc_html_e('Shop','ronby');} ?></h1>
		
		<?php if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')); ?>
		</h4>
		
		<?php } ?>		
		<?php } elseif(class_exists('woocommerce') && is_product()){  ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_single_product_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));} else { esc_html_e('PRODUCT DETAIL','ronby');} ?></h1>
	
		<?php if(ronby_get_option('ronby_single_product_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')); ?>
		</h4>	
		
		<?php }  ?>
		<?php } elseif(class_exists('woocommerce') && is_product_category()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>		

		<?php } elseif(class_exists('woocommerce') && is_product_taxonomy()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>	

		<?php }  ?>
		
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>						
						
					</div>
				</div>		
			</div>				
		</div>
<?php } elseif( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3)) ){ ?>
				<div class="page-header-3" id="page-header">
				<div class="overlay">
					<div class="container">
						<div class="inner-content">						

		<?php if(is_front_page()){ ?>
		
		    <h1 class="page-header-title">
			<?php echo esc_attr(get_bloginfo('name')); ?>
			</h1>
			<h4 class="page-header-sub-title">
			<?php echo esc_attr(get_bloginfo('description')); ?>
			</h4>
			
		<?php } elseif(is_home()){ ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_one'))) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_one'));?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if((ronby_get_option('blog_page_header_sec_title_two'))) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_two'));?>
		  </h4>
		  
		<?php } ?>
		
		<?php } elseif(is_page()){ ?>
		
		<?php if(!empty($ronby_page_heading_one_meta)) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr($ronby_page_heading_one_meta);?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if(!empty($ronby_page_heading_two_meta)) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr($ronby_page_heading_two_meta);?>
		  </h4>
		  
		<?php } ?>		
		
		<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>
		
		<h1 class="page-header-title 7"><?php if(ronby_get_option('blog_post_header_sec_title_one')){echo esc_attr(ronby_get_option('blog_post_header_sec_title_one'));} else {echo esc_attr__('Blog Detail','ronby');}?></h1>
		<?php if(ronby_get_option('blog_post_header_sec_title_two')){ ?>
		<h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_post_header_sec_title_two')); ?>
		</h4>
		<?php } ?>
		
		<?php } elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { ?>

		<h1 class="page-header-title"><?php echo get_the_archive_title(); //archive title ?></h1>
		
		<?php } elseif(is_category() ) { ?>
		
		<h1 class="page-header-title"><?php single_cat_title(); ?></h1>		
		
		<?php } elseif(is_search()) { ?>	
		
		<h1 class="page-header-title"><?php echo esc_attr__('Search','ronby');?></h1>		
		
		<h4 class="page-header-sub-title">
		  <?php echo esc_html__('Search Results for: ','ronby');?><?php echo esc_attr(the_search_query());?>
		</h4>
		
		<?php } elseif(is_author()) { ?>		
		
		<h1 class="page-header-title 10"><?php if((get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){echo esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));} else {echo get_the_author_meta('display_name');} ?></h1>

		<h4 class="page-header-sub-title">
		  <?php echo esc_attr__('Author','ronby'); ?>
		</h4>		
		
		<?php } elseif(is_404() || is_page_template('404.php')) { ?>

		<h1 class="page-header-title"><?php esc_html_e('404 - NOT FOUND!','ronby'); ?></h1>	
		
		<?php } elseif(class_exists('woocommerce') && is_shop()){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));} else { esc_html_e('Shop','ronby');} ?></h1>
		
		<?php if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')); ?>
		</h4>
		
		<?php } ?>		
		<?php } elseif(class_exists('woocommerce') && is_product()){  ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_single_product_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));} else { esc_html_e('PRODUCT DETAIL','ronby');} ?></h1>
	
		<?php if(ronby_get_option('ronby_single_product_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')); ?>
		</h4>	
		
		<?php }  ?>
		<?php } elseif(class_exists('woocommerce') && is_product_category()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>	

		<?php } elseif(class_exists('woocommerce') && is_product_taxonomy()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>

		<?php }  ?>
		
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
						</div>
					</div>
					</div>
				</div>
<?php } elseif( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4)) ){ ?>
		<div class="page-header-4" id="page-header">
			<div class="overlay">
				<div class="container">

		<?php if(is_front_page()){ ?>
		
		    <h1 class="page-header-title">
			<?php echo esc_attr(get_bloginfo('name')); ?>
			</h1>
			<h4 class="page-header-sub-title">
			<?php echo esc_attr(get_bloginfo('description')); ?>
			</h4>
			
		<?php } elseif(is_home()){ ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_one'))) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_one'));?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
		
		<?php if((ronby_get_option('blog_page_header_sec_title_two'))) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_two'));?>
		  </h4>
		  
		<?php } ?>
		
		<?php } elseif(is_page()){ ?>
		
		<?php if(!empty($ronby_page_heading_one_meta)) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr($ronby_page_heading_one_meta);?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>
		
		<?php if(!empty($ronby_page_heading_two_meta)) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr($ronby_page_heading_two_meta);?>
		  </h4>
		  
		<?php } ?>		
		
		<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('blog_post_header_sec_title_one')){echo esc_attr(ronby_get_option('blog_post_header_sec_title_one'));} else {echo esc_attr__('Blog Detail','ronby');}?></h1>
		<?php if(ronby_get_option('blog_post_header_sec_title_two')){ ?>
		<h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_post_header_sec_title_two')); ?>
		</h4>
		<?php } ?>
		
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>
		
		<?php } elseif(is_archive() && !(is_author()) && (class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy()))) { ?>

		<h1 class="page-header-title"><?php echo get_the_archive_title(); //archive title ?></h1>	

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
		
		<?php } elseif(is_archive() && !(is_author()) && !class_exists('woocommerce')) { ?>

		<h1 class="page-header-title"><?php echo get_the_archive_title(); //archive title ?></h1>	

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
		
		<?php } elseif(is_category()) { ?>
		
		<h1 class="page-header-title"><?php single_cat_title(); ?></h1>	

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>
		
		<?php } elseif(is_search()) { ?>	
		
		<h1 class="page-header-title"><?php echo esc_attr__('Search','ronby');?></h1>		

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>
		
		<h4 class="page-header-sub-title">
		  <?php echo esc_html__('Search Results for: ','ronby');?><?php echo esc_attr(the_search_query());?>
		</h4>
		
		<?php } elseif(is_author()) { ?>		
		
		<h1 class="page-header-title 10"><?php if((get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){echo esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));} else {echo get_the_author_meta('display_name');} ?></h1>

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>

		<h4 class="page-header-sub-title">
		  <?php echo esc_attr__('Author','ronby'); ?>
		</h4>		
		
		<?php } elseif(is_404() || is_page_template('404.php')) { ?>

		<h1 class="page-header-title"><?php esc_html_e('404 - NOT FOUND!','ronby'); ?></h1>	
				<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}?>
		
		<?php } elseif(class_exists('woocommerce') && is_shop()){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));} else { esc_html_e('Shop','ronby');} ?></h1>
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}?>		
		<?php if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')); ?>
		</h4>
		
		<?php } ?>		
		<?php } elseif(class_exists('woocommerce') && is_product()){  ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_single_product_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));} else { esc_html_e('PRODUCT DETAIL','ronby');} ?></h1>
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
		<?php if(ronby_get_option('ronby_single_product_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')); ?>
		</h4>	
		
		<?php }  ?>
		<?php } elseif(class_exists('woocommerce') && is_product_category()){  ?>

		<h1 class="page-header-title "><?php echo get_the_archive_title();?></h1>	
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>		

		<?php } elseif(class_exists('woocommerce') && is_product_taxonomy()){  ?>

		<h1 class="page-header-title "><?php echo get_the_archive_title();?></h1>	
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	

		<?php }  ?>
	
				</div>
			</div>
		</div>	
<?php } elseif( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==5) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 5)) ){ ?>
	<div class="page-header-5" id="page-header">
		<div class="overlay">				
			<div class="container">
				<div class="inner-content row align-items-center">
					<div class="col-md-6 col-lg-4">

		<?php if(is_front_page()){ ?>
		
		    <h1 class="page-header-title">
			<?php echo esc_attr(get_bloginfo('name')); ?>
			</h1>
			<h4 class="page-header-sub-title">
			<?php echo esc_attr(get_bloginfo('description')); ?>
			</h4>
			
		<?php } elseif(is_home()){ ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_one'))) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_one'));?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if((ronby_get_option('blog_page_header_sec_title_two'))) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_two'));?>
		  </h4>
		  
		<?php } ?>
		
		<?php } elseif(is_page()){ ?>
		
		<?php if(!empty($ronby_page_heading_one_meta)) { ?>
		
          <h1 class="page-header-title"><?php echo esc_attr($ronby_page_heading_one_meta);?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
		
		<?php if(!empty($ronby_page_heading_two_meta)) { ?>	
		
          <h4 class="page-header-sub-title">
		  <?php echo esc_attr($ronby_page_heading_two_meta);?>
		  </h4>
		  
		<?php } ?>		
		
		<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('blog_post_header_sec_title_one')){echo esc_attr(ronby_get_option('blog_post_header_sec_title_one'));} else {echo esc_attr__('Blog Detail','ronby');}?></h1>
		<?php if(ronby_get_option('blog_post_header_sec_title_two')){ ?>
		<h4 class="page-header-sub-title">
		  <?php echo esc_attr(ronby_get_option('blog_post_header_sec_title_two')); ?>
		</h4>
		<?php } ?>
		
		<?php } elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { ?>

		<h1 class="page-header-title"><?php echo get_the_archive_title(); //archive title ?></h1>		
		
		<?php } elseif(is_category() ) { ?>
		
		<h1 class="page-header-title"><?php single_cat_title(); ?></h1>		
		
		<?php } elseif(is_search()) { ?>	
		
		<h1 class="page-header-title"><?php echo esc_attr__('Search','ronby');?></h1>		
		
		<h4 class="page-header-sub-title">
		  <?php echo esc_html__('Search Results for: ','ronby');?><?php echo esc_attr(the_search_query());?>
		</h4>
		
		<?php } elseif(is_author()) { ?>		
		
		<h1 class="page-header-title 10"><?php if((get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){echo esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));} else {echo get_the_author_meta('display_name');} ?></h1>

		<h4 class="page-header-sub-title">
		  <?php echo esc_attr__('Author','ronby'); ?>
		</h4>		
		
		<?php } elseif(is_404() || is_page_template('404.php')) { ?>

		<h1 class="page-header-title"><?php esc_html_e('404 - NOT FOUND!','ronby'); ?></h1>	
		
		<?php } elseif(class_exists('woocommerce') && is_shop()){ ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));} else { esc_html_e('Shop','ronby');} ?></h1>
	
		<?php if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')); ?>
		</h4>
		
		<?php } ?>		
		<?php } elseif(class_exists('woocommerce') && is_product()){  ?>
		
		<h1 class="page-header-title"><?php if(ronby_get_option('ronby_single_product_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));} else { esc_html_e('PRODUCT DETAIL','ronby');} ?></h1>
	
		<?php if(ronby_get_option('ronby_single_product_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title">
		 <?php echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')); ?>
		</h4>	
		
		<?php }  ?>
		<?php } elseif(class_exists('woocommerce') && is_product_category()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>		

		<?php } elseif(class_exists('woocommerce') && is_product_taxonomy()){  ?>

		<h1 class="page-header-title 8"><?php echo get_the_archive_title();?></h1>		

		<?php }  ?>
										
					</div>
					<div class="col-md-6 col-lg-8">

		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
					</div>
				</div>				
			</div>
		</div>			
	</div>
<?php } elseif( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==6) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 6)) ){ ?>
	<div class="page-header-6 text-center" id="page-header">
	<div class="overlay">
		<div class="container">	

		<?php if(is_front_page()){ ?>
			<h4 class="page-header-sub-title color-primary">
			<?php echo esc_attr(get_bloginfo('description')); ?>
			</h4>		
		    <h1 class="page-header-title color-white">
			<?php echo esc_attr(get_bloginfo('name')); ?>
			</h1>

			
		<?php } elseif(is_home()){ ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_two'))) { ?>	
		
          <h4 class="page-header-sub-title  color-primary">
		  <?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_two'));?>
		  </h4>
		  
		<?php } ?>

		<?php if((ronby_get_option('blog_page_header_sec_title_one'))) { ?>
		
          <h1 class="page-header-title color-white"><?php echo esc_attr(ronby_get_option('blog_page_header_sec_title_one'));?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title color-white">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
				
		<?php } elseif(is_page()){ ?>
		
		<?php if(!empty($ronby_page_heading_two_meta)) { ?>	
		
          <h4 class="page-header-sub-title color-primary">
		  <?php echo esc_attr($ronby_page_heading_two_meta);?>
		  </h4>
		  
		<?php } ?>		
		
		<?php if(!empty($ronby_page_heading_one_meta)) { ?>
		
          <h1 class="page-header-title color-white"><?php echo esc_attr($ronby_page_heading_one_meta);?></h1>
		  
		<?php } else { ?> 
		
		  <h1 class="page-header-title color-white">
		  <?php echo esc_attr(single_post_title()); ?>
		  </h1>
		  
		<?php } ?>
				
		
		<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>
		<h4 class="page-header-sub-title color-primary">
		  <?php echo esc_attr(ronby_get_option('blog_post_header_sec_title_two')); ?>
		</h4>		
		<h1 class="page-header-title color-white"><?php if(ronby_get_option('blog_post_header_sec_title_one')){echo esc_attr(ronby_get_option('blog_post_header_sec_title_one'));} else {echo esc_attr__('Blog Detail','ronby');}?></h1>
		<?php if(ronby_get_option('blog_post_header_sec_title_two')){ ?>

		<?php } ?>
		
		<?php } elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop()) && !(is_product_category()) && !(is_product_taxonomy())) { ?>
		
		<h1 class="page-header-title color-white"><?php echo get_the_archive_title(); //archive title ?></h1>	
			
		<?php } elseif(is_category() ) { ?>
		
		<h1 class="page-header-title color-white"><?php single_cat_title(); ?></h1>		
		
		<?php } elseif(is_search()) { ?>	

		<h4 class="page-header-sub-title color-primary">
		  <?php echo esc_html__('Search Results for: ','ronby');?><?php echo esc_attr(the_search_query());?>
		</h4>
		
		<h1 class="page-header-title color-white"><?php echo esc_html__('Search','ronby');?></h1>		
				
		<?php } elseif(is_author()) { ?>		

		<h4 class="page-header-sub-title color-primary">
		  <?php echo esc_html__('Author','ronby'); ?>
		</h4>
		
		<h1 class="page-header-title"><?php if((get_the_author_meta('user_firstname') || get_the_author_meta('user_lastname'))){echo esc_attr(get_the_author_meta('user_firstname').' '. get_the_author_meta('user_lastname'));} else {echo get_the_author_meta('display_name');} ?></h1>
		
		<?php } elseif(is_404() || is_page_template('404.php')) { ?>

		<h1 class="page-header-title color-white"><?php esc_html_e('404 - NOT FOUND!','ronby'); ?></h1>	
		
		<?php } elseif(class_exists('woocommerce') && is_shop()){ ?>
		
		<?php if(ronby_get_option('ronby_shop_page_header_sec_title_two')) { ?>
		
		<h4 class="page-header-sub-title color-primary">
		 <?php echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_two')); ?>
		</h4>
		
		<?php } ?>
		
		<h1 class="page-header-title color-white"><?php if(ronby_get_option('ronby_shop_page_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_shop_page_header_sec_title_one'));} else { esc_html_e('Shop','ronby');} ?></h1>
		<?php } elseif(class_exists('woocommerce') && is_product()){  ?>
		
		<?php if(ronby_get_option('ronby_single_product_header_sec_title_two')) { ?>		
		<h4 class="page-header-sub-title color-primary">
		 <?php echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_two')); ?>
		</h4>			
		<?php }  ?>		
		<h1 class="page-header-title color-white"><?php if(ronby_get_option('ronby_single_product_header_sec_title_one')){echo esc_attr(ronby_get_option('ronby_single_product_header_sec_title_one'));} else { esc_html_e('PRODUCT DETAIL','ronby');} ?></h1>
	
		<?php } elseif(class_exists('woocommerce') && is_product_category()){  ?>
		
		<h1 class="page-header-title color-white"><?php echo get_the_archive_title();?></h1>	
		
		<?php } elseif(class_exists('woocommerce') && is_product_taxonomy()){  ?>
		
		<h1 class="page-header-title color-white"><?php echo get_the_archive_title();?></h1>			

		<?php }  ?>
		<?php 
		if(ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){
		if(function_exists('ronby_page_breadcrumb_function')){ echo ronby_page_breadcrumb_function();} 
		}
		?>	
			
		</div>		
		</div>		
	</div>
<?php
	}
}

/// Page Header End ///

// **********************************************************************// 
// ! Breadcrumb Function Start
// **********************************************************************//

function ronby_page_breadcrumb_function() {
if(!(is_front_page())){		
$ronby_global_post = ronby_get_global_post();
if( !(is_404()) && !(is_search())  && (class_exists('woocommerce')) && !(is_shop())){
$postid = $ronby_global_post->ID;
$postcat = get_the_category($postid);
} else {
$postcat = get_the_category(get_the_id());
}
?>

<div class="page-header-breadcrumb <?php if( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1)) ){echo 'background-primary';} ?>">

<a href="<?php echo esc_url(get_home_url()); ?>"><?php echo esc_attr__('Home','ronby');?></a>
        
<?php if (is_category()) { ?>	
	
- <span><?php single_cat_title();?></span>

<?php } elseif (is_page()) { ?>	

- <span><?php echo esc_attr(single_post_title());?></span>

<?php } elseif (is_home()) { ?>	
	
- <span><?php echo esc_attr(single_post_title());?></span>

<?php } elseif (is_search()) { ?>	

- <span><?php echo esc_html__('Search Results for...','ronby');?><?php echo esc_attr(the_search_query());?></span>
		
<?php } elseif(is_single() && (!class_exists('woocommerce') || !(is_product()))){ ?>	

- <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php echo esc_html__('Blog','ronby');?></a>
<?php if($postcat){ ?>
- <a href="<?php echo esc_url($postcat[0]->url);?>"><?php echo esc_attr( $postcat[0]->name);?></a>
<?php } else { ?>
- <span><?php echo esc_attr(the_title());?></span>	
<?php } ?>
<?php } elseif(is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop())){ ?>

- <span><?php echo esc_attr(get_the_archive_title());?></span>

<?php } elseif(is_archive() && !(is_author()) && !class_exists('woocommerce')){ ?>

- <span><?php echo esc_attr(get_the_archive_title());?></span>

<?php } elseif(is_author()){ ?>

- <span><?php echo esc_attr(get_the_author_meta('display_name'));?></span>

<?php } elseif(is_404() || is_page_template('404.php')){ ?>

- <span><?php echo esc_attr__('404','ronby');?></span>

<?php } elseif(class_exists('woocommerce') && is_product()) { ?>
- <span><?php echo esc_attr__('Product','ronby');?></span>

<?php } elseif(class_exists('woocommerce') && is_shop()) { ?>
- <span><?php echo esc_attr__('Shop','ronby');?></span>
<?php } ?>

</div>

<?php
	}
}
// **********************************************************************// 
// ! End Breadcrumb Function
// **********************************************************************//


// **********************************************************************// 
// ! Ronby Admin Menu Create Function
// **********************************************************************//
add_action( 'admin_menu', 'ronby_admin_menu' );

function ronby_admin_menu(){

  $page_title = 'ronby-options';
  $menu_title = 'Ronby';
  $capability = 'manage_options';
  $menu_slug  = 'ronby-options';
  $function   = 'ronby_admin_sub_menu';
  $icon_url   = 'dashicons-admin-settings';
  $position   = 4;

  add_menu_page( $page_title,
                 $menu_title, 
                 $capability, 
                 $menu_slug, 
                 $function, 
                 $icon_url, 
                 $position );
}

add_action( 'admin_menu', 'ronby_admin_sub_menu' );

function ronby_admin_sub_menu() {

  $parent_slug  = 'ronby-options';
  $menu_slug  = 'ronby-options';
  $page_title = 'ronby-options';
  $menu_title = 'Welcome';
  $capability = 'manage_options';  
  $function   = 'ronby_welcome_page';

  add_submenu_page( $parent_slug,
					$page_title,
					$menu_title, 
					$capability, 
					$menu_slug, 
					$function );
}

/***************************
Ronby welcome page function
****************************/
function ronby_welcome_page(){

    echo '<div class="wrap about-wrap">';
    echo '<h1>Welcome to Ronby 1.0</h1>';
    echo '<h2 class="about-text" style="text-align:left">Congratulations! You have Choosed Most Exclusive Multipurpose Wordpress Theme.</h2>';
	echo '<p>Developed by <a href="'.esc_url('https://themeforest.net/user/fluent-themes/portfolio').'">Fluent Themes</a></p>';
	echo '<a href="'.esc_url('https://www.facebook.com/fluentthemes2016').'" class="tm-btn f-btn">Like us on facebook</a> | <a href="'.esc_url('https://www.youtube.com/user/reader17911').'" class="tm-btn y-btn">Subscribe us on youtube</a> | <a href="'.esc_url('https://www.linkedin.com/in/fluent-themes-156b8a54').'" class="tm-btn l-btn">Connect on Linkedin</a>';
    echo '</div>';
}

/***************************************************
Category and Tag Featured Image Functions Starts from here
****************************************************/

define('RONBY_IMAGE_PLACEHOLDER', get_template_directory_uri()."/images/placeholder.png");
add_action('admin_init', 'ronby_init');
function ronby_init() {
    $ronby_taxonomies = get_taxonomies();
    if (is_array($ronby_taxonomies)) {
        $ronby_options = get_option('ronby_options');
        
        if (!is_array($ronby_options)) {
            $ronby_options = array();
        }
        if (empty($ronby_options['excluded_taxonomies'])) {
            $ronby_options['excluded_taxonomies'] = array();
        }
        foreach ($ronby_taxonomies as $ronby_taxonomy) {
            if (in_array($ronby_taxonomy, $ronby_options['excluded_taxonomies'])) {
                continue;
			}
            add_action($ronby_taxonomy.'_add_form_fields', 'ronby_add_texonomy_field');
            add_action($ronby_taxonomy.'_edit_form_fields', 'ronby_edit_texonomy_field');
            add_filter( 'manage_edit-' . $ronby_taxonomy . '_columns', 'ronby_taxonomy_columns' );
            add_filter( 'manage_' . $ronby_taxonomy . '_custom_column', 'ronby_taxonomy_column', 10, 3 );
        }
    }
}

function ronby_add_style() {
    echo '<style type="text/css" media="screen">
        th.column-thumb {width:60px;}
        .form-field img.taxonomy-image {border:1px solid #eee;max-width:300px;max-height:300px;}
        .inline-edit-row fieldset .thumb label span.title {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
        .column-thumb span {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
        .inline-edit-row fieldset .thumb img,.column-thumb img {width:48px;height:48px;}
    </style>';
}

// add image field in add form
function ronby_add_texonomy_field() {
    if (get_bloginfo('version') >= 3.5) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }
    
    echo '<div class="form-field">
        <label for="taxonomy_image">' . esc_attr__('Featured Image', 'ronby') . '</label>
        <input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
        <br/>
        <button class="ronby_upload_image_button button">' . esc_html__('Upload/Add image', 'ronby') . '</button>
    </div>'.ronby_script();
}

// add image field in edit form
function ronby_edit_texonomy_field($taxonomy) {
    if (get_bloginfo('version') >= 3.5) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }
    
    if (ronby_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) == RONBY_IMAGE_PLACEHOLDER) {
        $image_url = "";
    } else {
        $image_url = ronby_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE );
	}
    echo '<tr class="form-field">
        <th scope="row" valign="top"><label for="taxonomy_image">' . esc_html__('Featured Image', 'ronby') . '</label></th>
        <td><img class="taxonomy-image" src="' . ronby_taxonomy_image_url( $taxonomy->term_id, 'medium', TRUE ) . '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_url.'" /><br />
        <button class="ronby_upload_image_button button">' . esc_html__('Upload/Add image', 'ronby') . '</button>
        <button class="ronby_remove_image_button button">' . esc_html__('Remove image', 'ronby') . '</button>
        </td>
    </tr>'.ronby_script();
}

// upload using wordpress upload
function ronby_script() {
    return '<script type="text/javascript">
        jQuery(document).ready(function($) {
            var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
            jQuery(".ronby_upload_image_button").click(function(event) {
                upload_button = $(this);
                var frame;
                if (wordpress_ver >= "3.5") {
                    event.preventDefault();
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media();
                    frame.on( "select", function() {
                        // Grab the selected attachment.
                        var attachment = frame.state().get("selection").first();
                        frame.close();
                        if (upload_button.parent().prev().children().hasClass("tax_list")) {
                            upload_button.parent().prev().children().val(attachment.attributes.url);
                            upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
                        }
                        else
                            jQuery("#taxonomy_image").val(attachment.attributes.url);
                    });
                    frame.open();
                }
                else {
                    tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
                    return false;
                }
            });
            
            jQuery(".ronby_remove_image_button").click(function() {
               jQuery(".taxonomy-image").attr("src", "'.RONBY_IMAGE_PLACEHOLDER.'");
                jQuery("#taxonomy_image").val("");
                jQuery(this).parent().siblings(".title").children("img").attr("src","' . RONBY_IMAGE_PLACEHOLDER . '");
                jQuery(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
                return false;
            });
            
            if (wordpress_ver < "3.5") {
                window.send_to_editor = function(html) {
                    imgurl = $("img",html).attr("src");
                    if (upload_button.parent().prev().children().hasClass("tax_list")) {
                        upload_button.parent().prev().children().val(imgurl);
                        upload_button.parent().prev().prev().children().attr("src", imgurl);
                    }
                    else
                        $("#taxonomy_image").val(imgurl);
                    tb_remove();
                }
            }
            
            $jQuery(".editinline").click(function() { 
                var tax_id = $(this).parents("tr").attr("id").substr(4);
                var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");

                if (thumb != "' . RONBY_IMAGE_PLACEHOLDER . '") {
                    jQuery(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
                } else {
                    jQuery(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
                }
                
                jQuery(".inline-edit-col .title img").attr("src",thumb);
            });
        });
    </script>';
}

// save our taxonomy image while edit or save term
add_action('edit_term','ronby_save_taxonomy_image');

add_action('create_term','ronby_save_taxonomy_image');
function ronby_save_taxonomy_image($term_id) {
    if(isset($_POST['taxonomy_image'])) {
        update_option('ronby_taxonomy_image'.$term_id, $_POST['taxonomy_image'], NULL);
	}
}

// get attachment ID by image url
function ronby_get_attachment_id_by_url($image_src) {
    global $wpdb;
    $query = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid = %s", $image_src);
    $id = $wpdb->get_var($query);
    return (!empty($id)) ? $id : NULL;
}

// get taxonomy image url for the given term_id (Place holder image by default)
function ronby_taxonomy_image_url($term_id = NULL, $size = 'full', $return_placeholder = FALSE) {
    if (!$term_id) {
        if (is_category()) {
            $term_id = get_query_var('cat');
        } elseif (is_tag()) {
            $term_id = get_query_var('tag_id');
        } elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    
    $taxonomy_image_url = get_option('ronby_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
        $attachment_id = ronby_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)) {
            $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
            $taxonomy_image_url = $taxonomy_image_url[0];
        }
    }

    if ($return_placeholder) {
        return ($taxonomy_image_url != '') ? $taxonomy_image_url : RONBY_IMAGE_PLACEHOLDER;
    } else {
        return $taxonomy_image_url;
	}
}

function ronby_quick_edit_custom_box($column_name, $screen, $name) {
    if ($column_name == 'thumb') {
        echo '<fieldset>
        <div class="thumb inline-edit-col">
            <label>
                <span class="title"><img src="" alt="'.esc_attr__('Thumbnail', 'ronby').'"/></span>
                <span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
                <span class="input-text-wrap">
                    <button class="ronby_upload_image_button button">' . esc_html__('Upload/Add image', 'ronby') . '</button>
                    <button class="ronby_remove_image_button button">' . esc_html__('Remove image', 'ronby') . '</button>
                </span>
            </label>
        </div>
    </fieldset>';
	}
}

/**
 * Thumbnail column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function ronby_taxonomy_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumb'] = esc_html__('Image', 'ronby');

    unset( $columns['cb'] );

    return array_merge( $new_columns, $columns );
}

/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function ronby_taxonomy_column( $columns, $column, $id ) {
    if ( $column == 'thumb' ) {
        $columns = '<span><img src="' . ronby_taxonomy_image_url($id, 'full', TRUE) . '" alt="' . esc_attr__('Thumbnail', 'ronby') . '" class="wp-post-image" /></span>';
    }
    return $columns;
}

// Change 'insert into post' to 'use this image'
function ronby_change_insert_button_text($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}

// Style the image in category list
if ( strpos( filter_var(getenv('SCRIPT_NAME')), 'edit-tags.php' ) > 0 ) {
    add_action( 'admin_head', 'ronby_add_style' );
    add_action('quick_edit_custom_box', 'ronby_quick_edit_custom_box', 10, 3);
    add_filter("attribute_escape", "ronby_change_insert_button_text", 10, 2);
}


// Excluded taxonomies checkboxs
function ronby_excluded_taxonomies() {
    $ronby_taxonomies = get_taxonomies();
	if (is_array($ronby_taxonomies)) {
		$ronby_options = get_option('ronby_options');
		if (!is_array($ronby_options)) {
			$ronby_options = array();
		}
		$disabled_taxonomies = array('nav_menu', 'link_category', 'post_format');
		foreach ($ronby_taxonomies as $tax) {
			if (in_array($tax, $disabled_taxonomies)) {
				continue;
			}
		?>
			<input type="checkbox" name="ronby_options[excluded_taxonomies][<?php echo esc_attr($tax); ?>]" value="<?php echo esc_attr($tax); ?>" <?php checked(isset($ronby_options['excluded_taxonomies'][esc_attr($tax)])); ?> /> <?php echo esc_attr($tax); ?><br />
		<?php
		}
	}
}

// Validating options
function ronby_options_validate($input) {
    return $input;
}

// display taxonomy image for the given term_id
function ronby_taxonomy_image($term_id = NULL, $size = 'full', $attr = NULL, $echo = TRUE) {
    if (!$term_id) {
        if (is_category()) {
            $term_id = get_query_var('cat');
        } elseif (is_tag()) {
            $term_id = get_query_var('tag_id');
        } elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    
    $taxonomy_image_url = get_option('ronby_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
        $attachment_id = ronby_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)) {
            $taxonomy_image = wp_get_attachment_image($attachment_id, $size, FALSE, $attr);
        } else {
            $image_attr = '';
            if(is_array($attr)) {
                if(!empty($attr['class']))
                    $image_attr .= ' class="'.$attr['class'].'" ';
                if(!empty($attr['alt']))
                    $image_attr .= ' alt="'.$attr['alt'].'" ';
                if(!empty($attr['width']))
                    $image_attr .= ' width="'.$attr['width'].'" ';
                if(!empty($attr['height']))
                    $image_attr .= ' height="'.$attr['height'].'" ';
                if(!empty($attr['title']))
                    $image_attr .= ' title="'.$attr['title'].'" ';
            }
            $taxonomy_image = '<img src="'.$taxonomy_image_url.'" '.$image_attr.'/>';
        }
    }
    else{
        $taxonomy_image = '';
    }

    if ($echo) {
        echo esc_attr($taxonomy_image);
    } else {
        return $taxonomy_image;
	}
}

/*************************************** 
/* Load Cutomizer
****************************************/
function ronby_style_selector_function(){
	if (is_home() || is_front_page() || is_archive() || is_category()) {
		if(ronby_get_option('ronby_style_selector') == 1){
			$theme_directory = get_template_directory();
			$settings_file  = '/inc/style_selector/images/settings.png';
			// Enqueuing CSS stylesheet for Iris
			if ( file_exists( $theme_directory . $settings_file ) ) {
				wp_enqueue_style( 'wp-color-picker' );

				// Manually enqueing Iris itself by linking directly
				//    to it and naming its dependencies
				wp_enqueue_script(
					'iris',
					admin_url( 'js/iris.min.js' ),
					array( 
						'jquery-ui-draggable', 
						'jquery-ui-slider', 
						'jquery-touch-punch'
					),
					false,
					1
				);

				// Now we can enqueue the color-picker script itself, 
				//    naming iris.js as its dependency
				wp_enqueue_script(
					'wp-color-picker',
					admin_url( 'js/color-picker.min.js' ),
					array( 'iris' ),
					false,
					1
				);

				// Manually passing text strings to the JavaScript
				$colorpicker_l10n = array(
					'clear' => esc_html__('Clear', 'ronby'),
					'defaultString' => esc_html__( 'Default', 'ronby' ),
					'pick' => esc_html__( 'Select Color', 'ronby' ),
					'current' => esc_html__( 'Current Color', 'ronby' ),
				);
				wp_localize_script( 
					'wp-color-picker',
					'wpColorPickerL10n', 
					$colorpicker_l10n 
				);
				require_once( RONBY_INCLUDE_PATH . 'style_selector/style_selector.php' );
			}
		}
	}
}
add_action('wp_footer','ronby_style_selector_function');

/***************************************************
Blog Page Category Section function
****************************************************/

function blog_category_section(){
if((ronby_get_option('ronby_blog_page_category_sec_ids'))){ ?>
<section class="business-steps blog-page-business-steps">		
<div class="row no-gutters">
<?php 
$count=count(array_keys(ronby_get_option('ronby_blog_page_category_sec_ids')));
$cat_id=ronby_get_option('ronby_blog_page_category_sec_ids');
$i=1;
$c=0;
while ($i <= $count){ 
$count_cat_words=str_word_count(get_cat_name($cat_id[$c]));
 
if((ronby_get_option('ronby_blog_page_cat_sec_title_color'))){
$color=ronby_get_option('ronby_blog_page_cat_sec_title_color');
} else {
$color='#fff'; 
}
$allowed_htmlarray = array(
		'span' => array('style'=> array()),
		'a' => array('href'=> array()),
	);
$start ='<span style="color:'.esc_attr($color).'">';
$end ='</span>';
$catname= get_cat_name($cat_id[$c]); 
if($count_cat_words > 1 ){
$replace= preg_replace("~\W\w+\s*$~", ' ' . $start . '\\0'.$end, $catname );
} else {
$replace= $start.$catname.$end;	
}
?>		
			<div class="col-md-4">
				<div class="article-with-overlay-1">
					<div class="thumbnail animate-zoom">
						<div style="background-image:url(<?php if((get_option('ronby_taxonomy_image'.$cat_id[$c]))){ echo esc_url(get_option('ronby_taxonomy_image'.$cat_id[$c]));} else{echo esc_url(get_template_directory_uri()."/images/placeholder.png");} ?>);" class="blog-cat-f-section"></div>
					</div>
					<a href="<?php echo get_category_link($cat_id[$c]); ?>">
						<div class="overlay overlay-fill d-flex flex-column justify-content-center">
							<div class="overlay-content text-center">
							<?php echo wp_kses($replace, $allowed_htmlarray ); ?>
							</div>
						</div>	
					</a>
				</div>
			</div>
<?php $i++; $c++; } ?>
</div>		
</section>	
<?php
	}
}

/***************************************************
Blog Page Brand Carousel Slider Section function
****************************************************/
function blog_page_brand_carousel_slider(){ ?>
		<section class="<?php if(ronby_get_option('ronby_site_layout_style')== 3){echo esc_attr('section-brands-carousel-2');} else {echo esc_attr('brands-carousel');}?>">
			<div class="container">
				<div class="brand-carousel-slider owl-carousel">
				<?php 
				$attachment_ids=ronby_get_option('ronby_blog_page_slider_images_ids');
				$i=1;
				$c=0;	
				$arr=explode(",",$attachment_ids);
				$count=count(array_keys($arr));
				while ($i <= $count){ ?>
					<div class="item">						
						<img src="<?php echo esc_url(wp_get_attachment_url($arr[$c]));	?>" alt="<?php esc_attr_e('brand-carousel-image','ronby');?>">
					</div>
				<?php $i++; $c++; } ?>  				
				</div>
			</div>
		</section>
<?php }

/**********************************************
Function to add margin on comment reply button
***********************************************/
function ronby_comment_reply_button_js(){
if(is_single()){
echo "<script>
jQuery(document).ready(function() {
    jQuery('.comment-reply-link').click(function(){
		jQuery('.comment-respond .button').addClass('mb-45');
	});
    jQuery('.comment-respond a').click(function(){
		jQuery('.comment-respond .button').removeClass('mb-45');
	});	
});
</script>";

	}
}
add_action('wp_footer','ronby_comment_reply_button_js');