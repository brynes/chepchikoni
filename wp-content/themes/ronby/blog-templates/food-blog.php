<?php 
   $post_excerpt_limit= get_post_meta(get_the_ID(), 'ronby_post_excerpt_limit', true ); 
	$post_content_limit = get_post_meta(get_the_ID(), 'ronby_post_content_limit', true );
	$post_word_limit = get_post_meta( get_the_ID(), 'ronby_post_word_limit', true );
	if($post_excerpt_limit){
	   $excerpt_limit=$post_excerpt_limit;
	}else{
	   if(ronby_get_option('excerpt_limit')){
	   $excerpt_limit=ronby_get_option('excerpt_limit');
	   }else{ 
	   $excerpt_limit='50';
	   }
	} 
	if($post_content_limit){
	   $content_limit=$post_content_limit;
	}else{  
	   if(ronby_get_option('content_limit')){
	   $content_limit=ronby_get_option('content_limit');
	   }else{ 
	   $content_limit='100';
	   }
	} 
	if($post_word_limit){
	   $word_limit=$post_word_limit;
	}else{  
	   if(ronby_get_option('word_limit')){
	   $word_limit=ronby_get_option('word_limit');
	   }else{ 
	   $word_limit='150';
	   }
	}   
?>
<?php 
   /* 
   *Template Name: Food Blog
   */ 
     
   // Blog Template start 
   if(basename(get_page_template()) == "food-blog.php") { 
   get_header(); ?>
<?php if((ronby_get_option('ronby_page_header_section_switch') == 1) ){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
<!-- Content -->
<div id="content" class="p-125-0-110 blog-section blog-fdblog">
<!-- pagiloader -->
<div id="pagiloader" class="pagiloader"><img src="<?php echo esc_url(get_template_directory_uri().'/images/blog-loader.gif') ?>" class="img-responsive" alt="<?php esc_attr_e('blog-pagination-loader','ronby');?>"/></div>
<!-- End pagiloader -->
<div class="content">
   <div class="container">
      <div class="row">
         <!-- Main content -->
         <div id="main-content" class="col-lg-12">
            <div class="row">
               <?php 
                  $counter=1;				                   
				 if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
					elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
					else { $paged = 1; }
				 $original_query = $wp_query;
				 $wp_query= null;
				 $args = array(
							 'orderby'          => 'post_date',
							 'order'            => 'DESC',
							 'post_status'      => 'publish',
							 'paged' => $paged,            
							 );                     
				 $wp_query = new WP_Query( $args );
				 if (have_posts()) :  while (have_posts()) : the_post();
                  $ronby_global_post = ronby_get_global_post();
                  $postid = $ronby_global_post->ID;
                  $get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );
                  if($counter > 4){$counter = 1;}
                  ?>	
               <?php if($counter == 1) { ?>					 
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7<?php }else { ?>col-sm-12<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>
							  <?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php }elseif($counter == 2){ ?>
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7<?php }else { ?>col-sm-12<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>							<?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php }elseif($counter  == 3){ ?> 
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 order-sm-last mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7 order-sm-first text-right<?php }else { ?>col-sm-12 order-sm-first text-right<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>							<?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php } elseif($counter == 4){ ?> 
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 order-sm-last mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7 order-sm-first text-right<?php }else { ?>col-sm-12 order-sm-first text-right<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>							<?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php } ?> 				
               <?php  $counter++; endwhile; endif; ?>
               <div class="clearfix"></div>
            </div>
			    <!--Start Pagination-->
               <?php if(paginate_links()) { ?>
               <div class="page-navi">
                  <div class="container">
                     <?php 
                        if (function_exists('ronby_custom_pagination')) ronby_custom_pagination();
                        ?>							
                  </div>
               </div>
               <?php } ?>				
               <!--End Pagination-->	 	
         </div>
         <!-- End Main content -->
      </div>
   </div>
</div>
</div>
<!-- /Content -->
<!-- Blog Slider Section Start -->    
<?php if(ronby_get_option('ronby_blog_page_slider_sec_switch') == 1){
if (function_exists('blog_page_brand_carousel_slider'))blog_page_brand_carousel_slider();
} ?> 
<!-- Blog Slider Section End -->
<!-- Blog Category Section Start -->    
<?php if(ronby_get_option('ronby_blog_page_category_sec_switch') == 1){  
   if(function_exists('blog_category_section')){
      echo blog_category_section();
   } } ?>    
<!-- Blog Category Section End -->
<!-- Pagination Wihtout Loding Function Start -->	
<?php if(paginate_links()) { 
   if(function_exists('ronby_pagination_without_loading')){
   echo ronby_pagination_without_loading();
   } } 
   $wp_query = null;
   $wp_query = $original_query;
   wp_reset_query(); ?>
<!-- Pagination Wihtout Loding Function End -->	  
<?php get_footer(); }
   // Blog Template End
   // Blog page start 
   else { ?>
<?php if((ronby_get_option('ronby_page_header_section_switch') == 1) && (is_home() || is_search())){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
<!-- Content -->
<div id="content" class="p-120-0 blog-section blog-fdblog">
<!-- pagiloader -->
<div id="pagiloader" class="pagiloader"><img src="<?php echo esc_url(get_template_directory_uri().'/images/blog-loader.gif') ?>" class="img-responsive" alt="<?php esc_attr_e('blog-pagination-loader','ronby');?>"/></div>
<!-- End pagiloader -->
<div class="content">
   <div class="container">
      <div class="row">
         <!-- Main content -->
         <div id="main-content" class="col-lg-12">
            <div class="row">
               <?php 
				  $counter = 1;
                  if (have_posts()) :  while (have_posts()) : the_post();
                  $ronby_global_post = ronby_get_global_post();
                  $postid = $ronby_global_post->ID;
                  $get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );
                  if($counter > 4){$counter = 1;}
                  ?>	
               <?php if($counter == 1) { ?>					 
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7<?php }else { ?>col-sm-12<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>
							  <?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php }elseif($counter == 2){ ?>
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7<?php }else { ?>col-sm-12<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>							<?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php }elseif($counter  == 3){ ?> 
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 order-sm-last mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7 order-sm-first text-right<?php }else { ?>col-sm-12 order-sm-first text-right<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>							<?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php } elseif($counter == 4){ ?> 
               <!-- Start Post -->					 
               <div <?php post_class('col-md-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-item-7">
                     <div class="row align-items-center">
                        <?php 
                           // if featured image is set
                           if($get_image){?>							
                        <div class="col-sm-5 order-sm-last mb-4 mb-sm-0">
                           <div class="thumbnail animate-zoom">
                              <a href="<?php esc_url(the_permalink())?>">
                                 <div class="blog-p-f-img h-215 h-385" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                              </a>
                           </div>
                        </div>
                        <?php } ?>			
                        <div class="<?php if($get_image){ ?>col-sm-7 order-sm-first text-right<?php }else { ?>col-sm-12 order-sm-first text-right<?php } ?>">
                           <a href="<?php esc_url(the_permalink())?>" class="no-color">
                              <h3 class="post-title animate-300 hover-color-primary"><?php esc_attr(the_title()); ?></h3>
                           </a>
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('food_blog_wp_date_meta')) food_blog_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('food_blog_theme_date_meta')) food_blog_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php
                                 //check if post comment meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>									
                              <?php if(function_exists('food_blog_comments_meta')) food_blog_comments_meta($postid); ?>
                              <?php } ?>	
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('food_blog_get_post_like_count')) food_blog_get_post_like_count($postid);
                                 } ?>	
                              <?php 
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_category_meta')) echo food_blog_category_meta(); ?>
                              <?php } // end category meta ?>							<?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>							  
                           </ul>
                           <?php 
                              // if featured image is set
                              if($get_image){ ?>				
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php }else{ ?>	
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <?php } ?>					
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Post -->
               <?php } ?> 				
               <?php  $counter++; endwhile; endif; ?>
               <div class="clearfix"></div>
            </div>
			    <!--Start Pagination-->
               <?php if(paginate_links()) { ?>
               <div class="page-navi">
                  <div class="container">
                     <?php 
                        if (function_exists('ronby_custom_pagination')) ronby_custom_pagination();
                        ?>							
                  </div>
               </div>
               <?php } ?>				
               <!--End Pagination-->	
         </div>
         <!-- End Main content -->
      </div>
   </div>
</div>
</div>
<!-- /Content -->
<!-- Blog Slider Section Start -->    
<?php if(ronby_get_option('ronby_blog_page_slider_sec_switch') == 1){
if (function_exists('blog_page_brand_carousel_slider'))blog_page_brand_carousel_slider();
} ?> 
<!-- Blog Slider Section End -->
<!-- Blog Category Section Start -->    
<?php if(ronby_get_option('ronby_blog_page_category_sec_switch') == 1){  
   if(function_exists('blog_category_section')){
      echo blog_category_section();
   } } ?>    
<!-- Blog Category Section End -->
<!-- Pagination Without Loding Function Start -->    
<?php if(paginate_links()) { 
   if(function_exists('ronby_pagination_without_loading')){
   echo ronby_pagination_without_loading();
   } } ?>
<!-- Pagination Without Loding Function End -->     
<?php } // Blog page end ?>