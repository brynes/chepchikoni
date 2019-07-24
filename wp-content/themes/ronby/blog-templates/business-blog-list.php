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
   *Template Name: Business Blog List 
   */ 
     
   // Blog Template start 
   if(basename(get_page_template()) == "business-blog-list.php") { 
   get_header(); ?>
<?php if((ronby_get_option('ronby_page_header_section_switch') == 1) ){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
<!-- Content -->
<div id="content" class="p-120-0-80 section-light blog-section">
   <!-- pagiloader -->
   <div id="pagiloader" class="pagiloader"><img src="<?php echo esc_url(get_template_directory_uri().'/images/blog-loader.gif') ?>" class="img-responsive" alt="<?php esc_attr_e('blog-pagination-loader','ronby');?>"/></div>
   <!-- End pagiloader -->
   <div class="content">
      <div class="container">
         <div class="row">
            <!-- Main content -->
            <div id="main-content" class="col-lg-12 nopadding">
               <!-- Start wrapper All Blog posts -->
               <div class="row">
                  <?php 
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
                     ?>        
                  <!-- Start Blog post  -->            
                  <div  <?php post_class('col-md-12'); ?> id="post-<?php the_ID(); ?>">
                     <div class="bg2-featurebox-3">
                        <?php 
                           // check if feature image is set
                           if($get_image){ ?>    
                        <!-- start img box -->                
                        <div class="img-box thumbnail thumbnail-rounded animate-zoom">
                           <a href="<?php esc_url(the_permalink())?>">
                              <div class="blog-p-f-img h-550" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                           </a>
                           <!-- Start Blog post info box -->                                
                           <div class="postdate-box">
                              <div class="blog-post-info">    
                                 <?php 
                                    //check if author meta switch is turned on
                                    if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>                                
                                 <?php if(function_exists('business_list_author_meta')) business_list_author_meta(); ?>
                                 <?php } 
                                    //check if comment meta switch is turned on
                                    if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>                                    
                                 <?php if(function_exists('business_list_comments_meta')) business_list_comments_meta($postid); ?>    
                                 <?php } // end comment meta ?>                                
                                 <?php
                                    //check if post date meta switch is turned on 
                                    if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                     
                                    //check if post date meta switch in wordpress format is turned on 
                                    if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>
                                 <?php if(function_exists('business_list_wp_date_meta')) business_list_wp_date_meta(); ?>
                                 <?php } 
                                    // end wordpress format post date meta
                                    else{ ?>    
                                 <?php if(function_exists('business_list_theme_date_meta')) business_list_theme_date_meta(); ?>    
                                 <?php } } 
                                    // end post date meta
                                    ?>                        
                              </div>
                           </div>
                           <!-- End Blog post info box -->                                
                        </div>
                        <!-- end img box -->    
                        <!-- Start Blog post info box Two-->    
                        <div class="postinfo-box">
                           <!-- Blog post title start -->
                           <h2 class="dosis title">
                              <a class="animate-300 hover-color-primary" href="<?php the_permalink() ?>">
                              <?php esc_attr(the_title()); ?>
                              </a>
                           </h2>
                           <!-- End Blog post title -->    
                           <!-- Start Blog Post info -->    
                           <div class="blog-post-info">
                              <?php  
                                 //check if comment meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>                                    
                              <?php if(function_exists('business_list_comments_meta')) business_list_comments_meta($postid); ?>
                              <?php } // end comment meta
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('business_list_category_meta')) echo business_list_category_meta($postid); ?>
                              <?php } // end category meta ?>                             
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('ronby_get_post_like_count'))echo ronby_get_post_like_count($postid);
                                 } ?>  
								<?php 
								//check if post Views meta switch is turned on
								if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
								<?php if(function_exists('business_blog_list_get_post_views'))echo business_blog_list_get_post_views(get_the_ID()); ?>
								<?php } ?>								 
                           </div>
                           <!-- End Blog Post info -->
                           <!-- Start Blog Post Description -->
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <!-- End Blog Post Description -->
                           <!-- Read more Button -->
                           <a class="button button-secondary rounded-capsule" href="<?php the_permalink(); ?>"><?php echo esc_attr__('Read more','ronby'); ?></a>
                           <!-- / End Read more Button -->                            
                        </div>
                        <!-- End Blog post info box Two -->                                
                        <?php }
                           // if featured image is not set
                           else { ?>
                        <!-- Start Blog post info box -->    
                        <div class="postinfo-box">
                           <!-- Blog post title start -->
                           <h2 class="dosis title">
                              <a class="animate-300 hover-color-primary" href="<?php the_permalink() ?>">
                              <?php esc_attr(the_title()); ?>
                              </a>
                           </h2>
                           <!-- End Blog post title -->
                           <!-- Start Blog Post Info -->
                           <div class="blog-post-info">
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>                                
                              <?php if(function_exists('business_list_author_meta')) business_list_author_meta(); ?>
                              <?php } ?>
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('business_list_wp_date_meta')) business_list_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('business_list_theme_date_meta')) business_list_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?>                             
                              <?php  
                                 //check if comment meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>                                    
                              <?php if(function_exists('business_list_comments_meta')) business_list_comments_meta($postid); ?>
                              <?php } // end comment meta
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('business_list_category_meta')) echo business_list_category_meta($postid); ?>
                              <?php } // end category meta ?>                             
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('ronby_get_post_like_count'))echo ronby_get_post_like_count($postid);
                                 } ?> 
								<?php 
								//check if post Views meta switch is turned on
								if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
								<?php if(function_exists('business_blog_list_get_post_views'))echo business_blog_list_get_post_views(get_the_ID()); ?>
								<?php } ?>								 
                           </div>
                           <!-- End Blog Post Info -->
                           <!-- Start Blog Post Description -->
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <!-- End Blog Post Description -->
                           <!-- Read More Button -->
                           <a class="button button-secondary rounded-capsule" href="<?php the_permalink(); ?>"><?php esc_attr_e('Read more','ronby'); ?></a>
                           <!-- /End Read More Button -->
                        </div>
                        <!-- End Blog post info box -->
                        <?php } ?>                                
                     </div>
                  </div>
                  <!-- End Blog post  -->                            
                  <?php endwhile; endif; ?>
                  <div class="clearfix"></div>
               </div>
               <!-- /End wrapper All Blog posts -->
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
            <!-- /Main content -->
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
   else{ ?>
<?php if((ronby_get_option('ronby_page_header_section_switch') == 1) && (is_home() || is_search())){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
<!-- Content -->
<div id="content" class="sec-padding section-light blog-section">
   <?php //check if get paginate links display pagiloader
      if(paginate_links()) { ?>    
   <div id="pagiloader" class="pagiloader"><img src="<?php echo esc_url(get_template_directory_uri().'/images/blog-loader.gif') ?>" class="img-responsive" alt="<?php esc_attr_e('blog-pagination-loader','ronby');?>"/></div>
   <?php } //End pagiloader ?>    
   <div class="content">
      <div class="container">
         <div class="row">
            <!-- Main content -->
            <div id="main-content" class="col-lg-12">
               <!-- Blog posts -->
               <div class="row">
                  <?php if (have_posts()) :  while ( have_posts() ) : the_post();
                     $ronby_global_post = ronby_get_global_post();
                     $postid = $ronby_global_post->ID;
                     $get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );     
                     ?>                    
                  <!-- Start Blog post  -->            
                  <div  <?php post_class('col-md-12'); ?> id="post-<?php the_ID(); ?>">
                     <div class="bg2-featurebox-3">
                        <?php 
                           // check if feature image is set
                           if($get_image){ ?>    
                        <!-- start img box -->                
                        <div class="img-box thumbnail thumbnail-rounded animate-zoom">
                           <a href="<?php esc_url(the_permalink())?>">
                              <div class="blog-p-f-img h-550" style="background-image: url(<?php echo esc_url($get_image)?>); background-position: center;background-size:cover"></div>
                           </a>
                           <!-- Start Blog post info box -->                                
                           <div class="postdate-box">
                              <div class="blog-post-info">    
                                 <?php 
                                    //check if author meta switch is turned on
                                    if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>                                
                                 <?php if(function_exists('business_list_author_meta')) business_list_author_meta(); ?>
                                 <?php } 
                                    //check if comment meta switch is turned on
                                    if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>                                    
                                 <?php if(function_exists('business_list_comments_meta')) business_list_comments_meta($postid); ?>    
                                 <?php } // end comment meta ?>                                
                                 <?php
                                    //check if post date meta switch is turned on 
                                    if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                     
                                    //check if post date meta switch in wordpress format is turned on 
                                    if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>
                                 <?php if(function_exists('business_list_wp_date_meta')) business_list_wp_date_meta(); ?>
                                 <?php } 
                                    // end wordpress format post date meta
                                    else{ ?>    
                                 <?php if(function_exists('business_list_theme_date_meta')) business_list_theme_date_meta(); ?>        
                                 <?php } } 
                                    // end post date meta
                                    ?>                        
                              </div>
                           </div>
                           <!-- End Blog post info box -->                                
                        </div>
                        <!-- end img box -->    
                        <!-- Start Blog post info box Two-->    
                        <div class="postinfo-box">
                           <!-- Blog post title start -->
                           <h2 class="dosis title">
                              <a class="animate-300 hover-color-primary" href="<?php the_permalink() ?>">
                              <?php esc_attr(the_title()); ?>
                              </a>
                           </h2>
                           <!-- End Blog post title -->    
                           <!-- Start Blog Post info -->    
                           <div class="blog-post-info">
                              <?php  
                                 //check if comment meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>                                    
                              <?php if(function_exists('business_list_comments_meta')) business_list_comments_meta($postid); ?>
                              <?php } // end comment meta
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('business_list_category_meta')) echo business_list_category_meta($postid); ?>
                              <?php } // end category meta ?>                             
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('ronby_get_post_like_count'))echo ronby_get_post_like_count($postid);
                                 } ?>    
								<?php 
								//check if post Views meta switch is turned on
								if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
								<?php if(function_exists('business_blog_list_get_post_views'))echo business_blog_list_get_post_views(get_the_ID()); ?>
								<?php } ?>								 
                           </div>
                           <!-- End Blog Post info -->
                           <!-- Start Blog Post Description -->
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt($excerpt_limit); ?>
                              <?php endif; ?>
                           </p>
                           <!-- End Blog Post Description -->
                           <!-- Read more Button -->
                           <a class="button button-secondary rounded-capsule" href="<?php the_permalink(); ?>"><?php echo esc_attr__('Read more','ronby'); ?></a>
                           <!-- / End Read more Button -->                            
                        </div>
                        <!-- End Blog post info box Two -->                                
                        <?php }
                           // if featured image is not set
                           else { ?>
                        <!-- Start Blog post info box -->    
                        <div class="postinfo-box">
                           <!-- Blog post title start -->
                           <h2 class="dosis title">
                              <a class="animate-300 hover-color-primary" href="<?php the_permalink() ?>">
                              <?php esc_attr(the_title()); ?>
                              </a>
                           </h2>
                           <!-- End Blog post title -->
                           <!-- Start Blog Post Info -->
                           <div class="blog-post-info">
                              <?php 
                                 //check if author meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_author_meta_switch') == 1){?>                                
                              <?php if(function_exists('business_list_author_meta')) business_list_author_meta(); ?>
                              <?php } ?>
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('ronby_blog_page_post_date_wordpress_switch') == 1){ ?>                
                              <?php if(function_exists('business_list_wp_date_meta')) business_list_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
							  <?php if(function_exists('business_list_theme_date_meta')) business_list_theme_date_meta(); ?>           
                              <?php } } 
                                 // end post date meta
                                 ?>                             
                              <?php  
                                 //check if comment meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_comment_meta_switch') == 1){?>                                    
                              <?php if(function_exists('business_list_comments_meta')) business_list_comments_meta($postid); ?>    
                              <?php } // end comment meta
                                 //check if category meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_category_meta_switch') == 1){ ?>
                              <?php if(function_exists('business_list_category_meta')) echo business_list_category_meta($postid); ?>
                              <?php } // end category meta ?>                             
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){
                                 if(function_exists('ronby_get_post_like_count'))echo ronby_get_post_like_count($postid);
                                 } ?> 
								<?php 
								//check if post Views meta switch is turned on
								if(ronby_get_option('ronby_blog_page_post_views_meta_switch') == 1){ ?>
								<?php if(function_exists('business_blog_list_get_post_views'))echo business_blog_list_get_post_views(get_the_ID()); ?>
								<?php } ?>								 
                           </div>
                           <!-- End Blog Post Info -->
                           <!-- Start Blog Post Description -->
                           <p>
                              <?php if ( has_post_format( 'video' ) ) : ?>
                              <?php echo ronby_content($content_limit); ?>
                              <?php else: ?>
                              <?php echo ronby_excerpt_non_featured_img($word_limit); ?>
                              <?php endif; ?>
                           </p>
                           <!-- End Blog Post Description -->
                           <!-- Read More Button -->
                           <a class="button button-secondary rounded-capsule" href="<?php the_permalink(); ?>"><?php esc_attr_e('Read more','ronby'); ?></a>
                           <!-- /End Read More Button -->
                        </div>
                        <!-- End Blog post info box -->
                        <?php } ?>                                
                     </div>
                  </div>
                  <!-- End Blog post  -->    
                  <?php endwhile; endif; ?>
                  <div class="clearfix"></div>
               </div>
               <!-- /Blog posts -->
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
            <!-- /Main content -->
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