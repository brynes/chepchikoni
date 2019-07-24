<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<!-- Content -->
<div id="content" class="p-130-0-80">
   <div class="container">
      <div class="row">
         <div class="col-lg-9">
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
            <article <?php post_class( 'blog-post-detail-2' ); ?> id="post-<?php the_ID(); ?>">
               <div class="blog-post-header">
                  <?php
                     //check if featured image is set
                      if($get_image) { ?>							
                  <div class="blog-post-thumbnail thumbnail">
                     <img src="<?php echo esc_url($get_image);?>" alt="<?php esc_attr_e('post-featured-image','ronby');?>">
                  </div>
                  <?php } ?>
                  <div class="row">
                     <div class="col-auto mr-auto">
                        <?php if($get_the_title) { ?>
                        <h2 class="post-title">
                          <?php esc_attr(the_title()); ?>
                        </h2>
                        <?php } ?>	
                        <div class="mb-3">			 
                           <?php 
                              //check if category meta switch is turned on
                              if(ronby_get_option('blog_post_category_meta_switch') == 1){ ?>
                           <?php if(function_exists('construction_category_meta')) echo construction_category_meta(); ?>
                           <?php } // end category meta ?>
                           <?php  
                              //check if comment meta switch is turned on
                              if((ronby_get_option('blog_post_comment_meta_switch') == 1) && comments_open() ){?>
                           <span class="divider">-</span>
                           <?php if(function_exists('construction_comments_meta')) construction_comments_meta($postid); ?>    
                           <?php } // end comment meta ?>	
                           <?php 
                              //check if post Views meta switch is turned on
                              if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                           <span class="divider">-</span>
                           <?php if(function_exists('construction_get_post_views'))echo construction_get_post_views(get_the_ID()); ?>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="col-auto">
                        <div class="post-author d-flex align-items-center">
                           <div class="flex-auto">
                              <?php 
                                 //check if author avatar meta switch is turned on
                                 if(ronby_get_option('blog_post_author_avatar_meta_switch') == 1){?> 
                              <?php if(function_exists('business_thumbnail_author_avatar_meta')) business_thumbnail_author_avatar_meta();?>
                              <?php } ?>
                           </div>
                           <div class="flex-fill">
                              <?php //check if author meta switch is turned on
                                 if(ronby_get_option('blog_post_author_meta_switch') == 1){ if(function_exists('construction_author_meta')){ construction_author_meta();  
                                 }} ?>												
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('blog_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>
                              <?php if(function_exists('construction_wp_date_meta')) construction_wp_date_meta(); ?>
                              <?php } 
                                 // end wordpress format post date meta
                                 else{ ?>    
                              <?php if(function_exists('construction_theme_date_meta')) construction_theme_date_meta(); ?>    
                              <?php } } 
                                 // end post date meta
                                 ?> 												
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="blog-post-content singular-post-content-2">
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
            </article>
            <?php endwhile; endif; wp_reset_postdata(); ?>
            <div class="clearfix"></div>
            <!-- start FAQ section-->
            <?php if(function_exists('construction_faq')) construction_faq();?>
            <!-- end FAQ section-->	
			<!-- Start user quote -->
			<?php if(function_exists('fitness_user_quote')){ fitness_user_quote(); } ?>
			<!-- End user quote -->			
            <!-- start post footer meta section-->
            <?php if(function_exists('construction_post_footer_meta')) construction_post_footer_meta();?>
            <!-- end post footer meta section--> 
            <!-- Start Comment Section -->		
            <?php if(comments_open()) { ?>		
            <div class="col-md-12 nopadding">
               <?php comments_template( '', true ); ?>
            </div>
            <?php } ?>
            <!-- End Comment Section -->	   
         </div>
         <!-- Start Sidebar Section -->	 					
         <div class="col-lg-3">
            <aside class="sidebar">
               <?php get_sidebar();?>
            </aside>
         </div>
         <!-- End Sidebar Section -->					
      </div>
   </div>
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