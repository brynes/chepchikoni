<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<!-- Content -->
<div id="content" class="p-125-0-110">
   <?php if (have_posts()) :  while (have_posts()) : the_post(); 
      $ronby_global_post = ronby_get_global_post();
      $postid = $ronby_global_post->ID;
      $get_image = get_the_post_thumbnail_url($postid);
      $get_the_title   = get_the_title();	  
    ?>
   <?php 
      // post views function 
      if(function_exists('set_post_views')) set_post_views($postid);
    ?>	  
   <section <?php post_class( 'blog-post-detail-1 mb-80' ); ?> id="post-<?php the_ID(); ?>">
      <div class="container">
         <div class="mx-auto mx-width-830">
            <div class="section-header">
               <?php
                  //check if featured image is set
                   if($get_image) { ?>					
               <div class="row">
                  <div class="col-lg-3 order-lg-last text-right simple-pagenavi mb-30">
					<?php
					//get previous and next post link 
					if((get_next_post())){
					$next_post_url =  get_adjacent_post(false,'',false)->ID ;
					}else{
					$next_post_url="";	
					}
					if((get_previous_post())){				
					$previous_post_url = get_adjacent_post(false,'',true)->ID ;
					}else{
					$previous_post_url ="";	
					}	
					?>
					<?php if($previous_post_url !='' ){?>
                     <a href="<?php echo esc_url(get_permalink($previous_post_url)); ?>" class="no-color prev animate-300 hover-color-secondary">
                     <i class="fas fa-chevron-left"></i>
                     <?php esc_attr_e('Prev','ronby');?>
                     </a>		 
                     <?php } ?>
					 <?php if(($previous_post_url && $next_post_url) !='' ){?>
					 <span>|</span>
					 <?php } ?>
					 <?php if($next_post_url != ''){?>
                     <a href="<?php echo esc_url(get_permalink($next_post_url)); ?>" class="no-color next animate-300 hover-color-secondary">
                     <?php esc_attr_e('Next','ronby');?>
                     <i class="fas fa-chevron-right"></i>
                     </a>
                     <?php } ?>
         							
                  </div>
                  <div class="col-lg-9">
                     <div>
                        <?php
                           //check if author meta switch is turned on
                             if(ronby_get_option('blog_post_author_meta_switch') == 1){?>								
                        <?php if(function_exists('business_grid_author_meta')) business_grid_author_meta(); ?>
                        <?php } 
                           //check if comment meta switch is turned on
                           if(ronby_get_option('blog_post_comment_meta_switch') == 1){?>									
                        <?php if(function_exists('business_grid_comments_meta')) business_grid_comments_meta($postid); ?>
                        <?php } ?>
                        <?php 
                           //check if category meta switch is turned on
                           if(ronby_get_option('blog_post_category_meta_switch') == 1){ ?>
                        <?php if(function_exists('business_grid_category_meta')) echo business_grid_category_meta(); ?>
                        <?php } // end category meta ?>
                        <?php 
                           //check if post Views meta switch is turned on
                           if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                        <?php if(function_exists('business_grid_get_post_views'))echo business_grid_get_post_views(get_the_ID()); ?>
                        <?php } ?>							  
                     </div>
                        <?php if($get_the_title) { ?>
                        <h2 class="post-title">
                          <?php esc_attr(the_title()); ?>
                        </h2>
                        <?php } ?>								
                  </div>
               </div>
               <?php }else{ ?>	
               <div class="row">
                  <div class="col-lg-12">
                     <?php if(!empty($get_the_title)) { ?> 
                     <h2 class="post-title mb-15 mt-0"><?php echo esc_attr($get_the_title) ?></h2>
                     <?php } ?>						
                  </div>
                  <div class="col-lg-3 order-lg-last text-right simple-pagenavi mb-30">
					<?php
					//get previous and next post link 
					if((get_next_post())){
					$next_post_url =  get_adjacent_post(false,'',false)->ID ;
					}else{
					$next_post_url="";	
					}
					if((get_previous_post())){				
					$previous_post_url = get_adjacent_post(false,'',true)->ID ;
					}else{
					$previous_post_url ="";	
					}	
					?>
					<?php if($previous_post_url !='' ){?>
                     <a href="<?php echo esc_url(get_permalink($previous_post_url)); ?>" class="no-color prev animate-300 hover-color-secondary">
                     <i class="fas fa-chevron-left"></i>
                     <?php esc_attr_e('Prev','ronby');?>
                     </a>		 
                     <?php } ?>
					 <?php if(($previous_post_url && $next_post_url) !='' ){?>
					 <span>|</span>
					 <?php } ?>
					 <?php if($next_post_url != ''){?>
                     <a href="<?php echo esc_url(get_permalink($next_post_url)); ?>" class="no-color next animate-300 hover-color-secondary">
                     <?php esc_attr_e('Next','ronby');?>
                     <i class="fas fa-chevron-right"></i>
                     </a>
                     <?php } ?>								
                  </div>
                  <div class="col-lg-9">
                     <div class="mb-30">
                        <?php
                           //check if author meta switch is turned on
                             if(ronby_get_option('blog_post_author_meta_switch') == 1){?>								
                        <?php if(function_exists('business_grid_author_meta')) business_grid_author_meta(); ?>
                        <?php } 
                           //check if comment meta switch is turned on
                           if(ronby_get_option('blog_post_comment_meta_switch') == 1){?>									
                        <?php if(function_exists('business_grid_comments_meta')) business_grid_comments_meta($postid); ?>
                        <?php } ?>
                        <?php 
                           //check if date meta switch is turned on
                           if(ronby_get_option('blog_post_date_meta_switch') == 1){?>
                        <?php if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>				
                        <?php if(function_exists('business_grid_wp_date_meta')) business_grid_wp_date_meta(); ?>
                        <?php }else{ ?>	
                        <?php if(function_exists('business_grid_theme_date_meta')) business_grid_theme_date_meta(); ?>	
                        <?php } } ?>							   
                        <?php 
                           //check if category meta switch is turned on
                           if(ronby_get_option('blog_post_category_meta_switch') == 1){ ?>
                        <?php if(function_exists('business_grid_category_meta')) echo business_grid_category_meta(); ?>
                        <?php } // end category meta ?>
                        <?php 
                           //check if post Views meta switch is turned on
                           if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                        <?php if(function_exists('business_grid_get_post_views'))echo business_grid_get_post_views(get_the_ID()); ?>
                        <?php } ?>							  
                     </div>
                  </div>
               </div>
               <?php } ?>					
            </div>
         </div>
         <?php if($get_image) { ?> 
         <div class="mx-auto mx-width-970">
            <div class="thumbnail position-relative featured-thumbnail">
               <img src="<?php echo esc_url($get_image);?>" alt="<?php esc_attr_e('featured-image','ronby');?>">
               <?php 
                  //check if date meta switch is turned on
                  if(ronby_get_option('blog_post_date_meta_switch') == 1){?>
               <?php if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>				
               <?php if(function_exists('business_grid_wp_date_meta')) business_grid_wp_date_meta(); ?>
               <?php }else{ ?>	
               <?php if(function_exists('business_grid_theme_date_meta')) business_grid_theme_date_meta(); ?>	
               <?php } } ?>	
            </div>
         </div>
         <?php } ?>				
         <!-- Post content -->
         <div class="mx-auto mx-width-830">
            <div class="blog-post-detail-content text-content-area">
               <?php the_content(); ?>
                  <?php
                     wp_link_pages( array(
                     'before'      => '<div class="page-links page-numbers"><span class="page-links-title">' . esc_html__( 'Pages:', 'ronby' ) . '</span>',
                     'after'       => '</div>',
                     'link_before' => '<span>',
                     'link_after'  => '</span>',
                     'pagelink'    => '<span class="linkstyle">' . esc_html__( '%', 'ronby' ) . ' </span>',
                     'separator'   => '',
                     ) );
                     ?>			   
            </div>
			<!-- start FAQ section-->
			<?php if(function_exists('construction_faq')) construction_faq();?>
			<!-- end FAQ section-->								
			<!-- Start user quote -->
			<?php if(function_exists('fitness_user_quote')){ fitness_user_quote(); } ?>
			<!-- End user quote -->			
         </div>
         <!-- End Post content -->
      </div>
   </section>
   <?php endwhile; endif; wp_reset_postdata(); ?>
   <div class="clearfix"></div>
   <?php 
      // footer meta's function
      if(function_exists('business_single_post_footer_meta')) business_single_post_footer_meta();
      ?>
   <!-- Start Comment Section -->		
   <?php if(comments_open()) { ?>		
   <div class="col-md-12 nopadding">
      <?php comments_template( '', true ); ?>
   </div>
   <?php } ?>
   <!-- End Comment Section -->	
</div>
<!-- /Content -->
<!-- Blog Slider Section Start -->    
<?php if(ronby_get_option('blog_post_brand_slider_section') == 1){
   if (function_exists('blog_page_brand_carousel_slider'))blog_page_brand_carousel_slider();
   } ?> 
<!-- Blog Slider Section End -->
<!-- Blog Category Section Start -->    
<?php if(ronby_get_option('blog_post_category_section') == 1){  
   if(function_exists('blog_category_section')){
      echo blog_category_section();
   } } ?>    
<!-- Blog Category Section End -->