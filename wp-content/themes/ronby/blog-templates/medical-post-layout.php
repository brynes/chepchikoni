<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<!-- Content -->
<div id="content" class="p-120-0">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
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
            <article <?php post_class('blog-post-detail-4'); ?> id="post-<?php the_ID(); ?>">
               <?php
                  //check if featured image is set
                   if($get_image) { ?>	
               <div class="thumbnail">								  
                  <img src="<?php echo esc_url($get_image);?>" alt="<?php esc_attr_e('post-featured-image','ronby');?>">
                  <?php if(ronby_get_option('blog_post_date_meta_switch') == 1){?>
                  <?php if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>				
                  <?php if(function_exists('medical_wp_date_meta')) medical_wp_date_meta(); ?>
                  <?php }else{ ?>	
                  <?php if(function_exists('medical_theme_date_meta')) medical_theme_date_meta(); ?>	
                  <?php } } ?>		
               </div>
               <?php } ?>								
               <div class="blog-post-header">
                  <div class="mb-3">
                     <?php 
                        //check if author meta switch is turned on
                        if(ronby_get_option('blog_post_author_meta_switch') == 1){?>
                     <?php if(function_exists('medical_author_meta')) medical_author_meta(); ?>
                     <?php } ?>
                     <?php  if(ronby_get_option('blog_post_comment_meta_switch') == 1){?>									
                     <?php if(function_exists('medical_comments_meta')) medical_comments_meta($postid); ?>
                     <?php } ?>
                     <?php 
                        //check if featured image is not set date will appear here
                        if(!$get_image) { ?>
                     <?php if(ronby_get_option('blog_post_date_meta_switch') == 1){?>
                     <?php if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>				
                     <?php if(function_exists('medical_wp_date_meta')) medical_wp_date_meta(); ?>
                     <?php }else{ ?>	
                     <?php if(function_exists('medical_theme_date_meta')) medical_theme_date_meta(); ?>	
                     <?php } } ?>						   
                     <?php } ?>
                     <?php 
                        //check if category meta switch is turned on
                           if(ronby_get_option('blog_post_category_meta_switch') == 1){ ?>
                     <?php if(function_exists('medical_category_meta')) echo medical_category_meta(); ?>
                     <?php } // end category meta ?>
                     <?php 
                        //check if post Views meta switch is turned on
                        if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                     <?php if(function_exists('medical_grid_get_post_views'))echo medical_grid_get_post_views(get_the_ID()); ?>
                     <?php } ?>	
                     <?php 
                        //check if post like meta switch is turned on
                        if(ronby_get_option('blog_post_like_meta_switch') == 1){?>
                     <?php if(function_exists('medical_get_post_like_link')) echo medical_get_post_like_link($postid);?>
                     <?php } ?>							
                  </div>
                  <?php if($get_the_title) { ?>
                  <h2 class="post-title">
                     <?php the_title(); ?>
                  </h2>
                  <?php } ?>
                  <div class="post-tags-n-sharing d-flex flex-wrap justify-content-between align-items-center before-background-primary <?php if(!(ronby_get_option('blog_post_tags_meta_switch') == 1) || !(has_tag())){echo"has-no-tag";} ?>">
                     <?php 
                        //check if tag meta switch is turned on
                        if((ronby_get_option('blog_post_tags_meta_switch') == 1) && has_tag()){ if(function_exists('medical_tag')){ medical_tag(); } }?>
                     <?php 
                        //check if post social share meta switch is turned on
                        if(ronby_get_option('blog_post_social_share_meta_switch') == 1){ ?>
                     <?php if(function_exists('medical_post_share_meta'))echo medical_post_share_meta(); ?>
                     <?php } ?>			
                  </div>
               </div>
               <div class="blog-post-content <?php if(!(comments_open())) { echo "pb-0"; }?>">
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
         <div class="col-lg-4">
            <aside class="sidebar">
               <?php get_sidebar();?>
            </aside>
         </div>
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