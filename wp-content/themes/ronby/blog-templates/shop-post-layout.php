<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
<?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<!-- Content -->
<div id="content" class="p-100-0-60">
   <section class="blog-detail">
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
            <div class="blog-header-5 text-center">
               <div class="feature-image position-relative">
                  <?php //check if featured image is set
                     if($get_image) { ?>								  
                  <img src="<?php echo esc_url($get_image);?>" alt="<?php esc_attr_e('post-featured-image','ronby');?>">	
                  <?php } ?>
                  <?php 
                     //check if post social share meta switch is turned on
                      if($get_image !='' && ronby_get_option('blog_post_social_share_meta_switch') == 1){ ?>
                  <?php if(function_exists('shop_post_share_meta')) shop_post_share_meta(); ?>
                  <?php } ?>					
               </div>
               <div class="blog-header-meta text-center">
                  <div class="post-description color-primary">
                     <?php // If Post Date Meta is turned on
                        if(ronby_get_option('blog_post_date_meta_switch') == 1){?>
                     <?php if(ronby_get_option('blog_post_date_wordpress_switch') == 1){ ?>				
                     <?php if(function_exists('shop_wp_date_meta')) shop_wp_date_meta(); ?>
                     <?php }else{ ?>	
                     <?php if(function_exists('shop_theme_date_meta')) shop_theme_date_meta(); ?>	
                     <?php } } ?>	
                     <?php 
                        //check if author meta switch is turned on
                        if(ronby_get_option('blog_post_author_meta_switch') == 1){?>
                     <?php if(function_exists('shop_author_meta')) shop_author_meta(); ?>
                     <?php } ?>
                     <?php 
                        //check if category meta switch is turned on
                        if(ronby_get_option('blog_post_category_meta_switch') == 1){?>
                     <?php if(function_exists('shop_category_meta')) echo shop_category_meta(); ?>
                     <?php } ?>	
                     <?php 
                        //check if comments meta switch is turned on
                        if(ronby_get_option('blog_post_comment_meta_switch') == 1){?>
                     <?php if(function_exists('shop_comments_meta')) shop_comments_meta($postid); ?>
                     <?php } ?>	
                     <?php 
                        //check if post Views meta switch is turned on
                        if(ronby_get_option('blog_post_views_meta_switch') == 1){ ?>
                     <?php if(function_exists('shop_get_post_views'))echo shop_get_post_views(get_the_ID()); ?>
                     <?php } ?>					 
                     <?php 
                        //check if post like meta switch is turned on
                        if(ronby_get_option('blog_post_like_meta_switch') == 1){?>
                     <?php if(function_exists('shop_get_post_like_link')) echo shop_get_post_like_link($postid);?>
                     <?php } ?>					 
                  </div>
                  <?php if($get_the_title) { ?>
                  <div class="post-title">
                     <?php the_title(); ?>
                  </div>
                  <?php } ?>
                  <?php 
                     //check if tag meta switch is turned on
                     if((ronby_get_option('blog_post_tags_meta_switch') == 1) && has_tag()){ if(function_exists('shop_tag')){ shop_tag(); } }?>
                  <?php 
                     //check if post social share meta switch is turned on
                      if($get_image =='' && ronby_get_option('blog_post_social_share_meta_switch') == 1){ ?>
                  <?php if(function_exists('shop_post_share_meta_2')) shop_post_share_meta_2(); ?>
                  <?php } ?>							
               </div>
            </div>
            <div class="col-xl-10 offset-xl-1">
               <div class="row">
                  <div class="blog-content-5 <?php if(!(comments_open())){echo"mb-5";}?>">
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
                  <?php if(function_exists('fitness_user_quote')) fitness_user_quote(); ?>
                  <!-- End user quote -->								
               </div>
            </div>
         </article>
         <?php endwhile; endif; wp_reset_postdata(); ?>
         <div class="clearfix"></div>
      </div>
   </section>
   <!-- Start Comment Section -->		
   <?php if(comments_open()) { ?>		
   <div class="col-md-12 nopadding">
      <?php comments_template( '', true ); ?>
   </div>
   <?php } ?>
   <!-- End Comment Section -->
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