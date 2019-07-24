<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<!-- Content -->
<div id="content" class="p-125-0-110">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-10">
            <div class="blog-post-detail-6-inner">
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
               <article  <?php post_class('blog-post-detail-6'); ?> id="post-<?php the_ID(); ?>">
                  <div class="blog-post-header">
                     <div class="row">
                        <div class="col-lg-9">
                           <?php if($get_the_title) { ?>
                           <h2 class="post-title">
                              <?php the_title(); ?>
                           </h2>
                           <?php } ?>	
                           <ul class="list-unstyled blog-post-6-meta">
                              <?php
                                 //check if post date meta switch is turned on 
                                 if(ronby_get_option('blog_post_date_meta_switch') == 1){
                                  
                                 //check if post date meta switch in wordpress format is turned on 
                                 if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>                
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
                                 if(ronby_get_option('blog_post_author_meta_switch') == 1){?>
                              <?php if(function_exists('food_blog_author_meta')) food_blog_author_meta();?>
                              <?php } ?>
                              <?php 
                                 //check if post Views meta switch is turned on
                                 if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                              <?php if(function_exists('food_blog_get_post_views'))echo food_blog_get_post_views(get_the_ID()); ?>
                              <?php } ?>
                              <?php 
                                 //check if post like meta switch is turned on
                                 if(ronby_get_option('blog_post_like_meta_switch') == 1){?>
                              <?php if(function_exists('food_get_post_like_link')) echo food_get_post_like_link($postid);?>
                              <?php } ?>							  
                           </ul>
                        </div>
                        <div class="col-lg-3 text-right">
                           <?php 
                              //check if post social share meta switch is turned on
                              if(ronby_get_option('blog_post_social_share_meta_switch') == 1){ ?>
                           <?php if(function_exists('food_social_share_meta'))echo food_social_share_meta(); ?>
                           <?php } ?>
                        </div>
                     </div>
                     <?php
                        //check if featured image is set
                         if($get_image) { ?>							
                     <div class="blog-post-image">
                        <img src="<?php echo esc_url($get_image);?>" alt="<?php esc_attr_e('post-featured-image','ronby');?>">
                     </div>
                     <?php } ?>								
                  </div>
                  <div class="blog-detail-content text-content-area">
                     <!-- Start Content -->			
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
                     <!-- End Content -->					
                  </div>
                  <!-- start FAQ section-->
                  <?php if(function_exists('construction_faq')) construction_faq();?>
                  <!-- end FAQ section-->								
                  <!-- Start user quote -->
                  <?php if(function_exists('fitness_user_quote')){ fitness_user_quote(); } ?>
                  <!-- End user quote -->	
				  <div class="clearfix"></div>				  
                  <div class="blog-post-list-categories">
                     <div class="row nopadding">
                        <div class="<?php if(ronby_get_option('blog_post_tags_meta_switch') == 1){echo "col-md-6";}else{echo"col-md-12";} ?>">
                           <?php 
                              //check if category meta switch is turned on
                              if(ronby_get_option('blog_post_category_meta_switch') == 1){ ?>
                           <?php if(function_exists('food_blog_post_category_meta')) echo food_blog_post_category_meta(); ?>
                           <?php } // end category meta ?>							
                        </div>
                        <div class="<?php if(ronby_get_option('blog_post_category_meta_switch') == 1){echo "col-md-6";}else{echo"col-md-12";} ?>">
                           <?php 
                              //check if tag meta switch is turned on
                              if((ronby_get_option('blog_post_tags_meta_switch') == 1) && has_tag()){ if(function_exists('food_tag')){ food_tag(); } }?>
                        </div>
                     </div>
                  </div>
               </article>
               <?php endwhile; endif; wp_reset_postdata(); ?>
               <div class="clearfix"></div>
               <!-- Start Comment Section -->		
               <?php if(comments_open()) { ?>		
               <div class="col-md-12 nopadding">
                  <?php comments_template( '', true ); ?>
               </div>
               <?php } ?>
               <!-- End Comment Section -->	
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Content -->
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