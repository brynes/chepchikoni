<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<!-- Content -->
<div id="content" class="p-120-0">
   <!-- Blog post detail -->
   <section class="blog-post-detail-3">
      <div class="container">
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
         <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="mx-auto mx-width-970">
               <div class="blog-post-header">
                  <div class="row align-items-end">
                     <div class="col-lg-8">
                        <?php
                           //check if post date meta switch is turned on 
                           if(ronby_get_option('blog_post_date_meta_switch') == 1){
                            
                           //check if post date meta switch in wordpress format is turned on 
                           if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>                
                        <?php if(function_exists('fitness_blog_wp_date_meta')) echo fitness_blog_wp_date_meta(); ?>
                        <?php } 
                           // end wordpress format post date meta
                           else{ ?>    
                        <?php if(function_exists('fitness_blog_theme_date_meta')) echo fitness_blog_theme_date_meta(); ?>    
                        <?php } } 
                           // end post date meta
                           ?>
                        <!-- Title Start -->		
                        <?php if($get_the_title) { ?>
                        <h2 class="post-title">
                          <?php esc_attr(the_title()); ?>
                        </h2>
                        <?php }else{ ?>	
						<div class="mt-4"></div>
						<?php } ?>
                        <!-- Title End -->
                     </div>
                     <div class="col-lg-4">
                        <?php 
                           //check if post social share meta switch is turned on
                           if(ronby_get_option('blog_post_social_share_meta_switch') == 1){ ?>
                        <?php if(function_exists('fitness_social_share_meta'))echo fitness_social_share_meta(); ?>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="hr"></div>
                  <div class="row ">
                     <div class="col-md-6 mt-4">
                        <div class="post-stats">
                           <?php 
                              //check if post Views meta switch is turned on
                              if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                           <?php if(function_exists('get_post_views'))echo get_post_views(get_the_ID()); ?><span class="ml-2 mr-2 divider-2">|</span>
                           <?php } ?>										
                           <?php 
                              //check if post comments meta switch is turned on
                              if(ronby_get_option('blog_post_comment_meta_switch') == 1){ ?>
                           <?php if(function_exists('fitness_blog_comments_meta')) { echo fitness_blog_comments_meta(get_the_ID()); } ?><?php if( comments_open() && function_exists('fitness_blog_comments_meta') ) { ?><span class="ml-2 mr-2 divider-2">|</span><?php } ?>
                           <?php } ?>
                           <?php 
                              //check if post category meta switch is turned on
                              if(ronby_get_option('blog_post_category_meta_switch') == 1){ ?>
                           <?php if(function_exists('fitness_blog_category_meta'))echo fitness_blog_category_meta(get_the_ID()); ?>
                           <?php } ?>
                           <?php 
                              //check if post author meta switch is turned on
                              if(ronby_get_option('blog_post_author_meta_switch') == 1){ ?>
                           <?php if(function_exists('fitness_author_meta')) { ?>
						   <?php if(has_category()) { ?>
						   <span class="ml-2 mr-2 divider-2">|</span>
						   <?php } echo fitness_author_meta(); ?>
						   <span class="ml-2 mr-2 divider-2">|</span>
                           <?php } } ?>                                  
						   <?php 
                              //check if post like meta switch is turned on
                              if(ronby_get_option('blog_post_like_meta_switch') == 1){?>
                           <?php if(function_exists('ronby_get_post_like_link')) echo ronby_get_post_like_link($postid);?><span class="ml-2 mr-2 divider-2">|</span>
                           <?php } ?>									   
                        </div>
                     </div>
                     <div class="col-md-6 mt-4">
                        <?php 
                           //check if tag meta switch is turned on
                           if((ronby_get_option('blog_post_tags_meta_switch') == 1) && has_tag()){ if(function_exists('fitness_tag')){ fitness_tag(); } }?>
                     </div>
                  </div>
               </div>
               <div class="blog-post-content">
                  <?php
                     //check if featured image is set
                      if($get_image) { ?>							
                  <div class="post-thumbnail mb-5" style="">
                     <img src="<?php echo esc_url($get_image);?>" alt="<?php esc_attr_e('post-featured-image','ronby');?>">
                  </div>
                  <?php } ?>	
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
            </div>
         </article>
         <?php endwhile; endif; wp_reset_postdata(); ?>
         <div class="clearfix"></div>
      </div>
   </section>
   <!-- /Blog post detail -->
   <!-- Start Comment Section -->
   <div class="col-md-12 nopadding sm-paddings">
      <?php comments_template( '', true ); ?>
   </div>
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