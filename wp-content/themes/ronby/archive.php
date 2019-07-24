<?php
/**
 * The template for displaying Archive pages
 */
get_header(); ?>
<?php if(ronby_get_option('ronby_page_header_section_switch') == 1 ){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
  <?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
<?php if(ronby_get_option('ronby_blog_page_layout') == 1){ ?>
	<?php get_template_part( 'blog-templates/business-blog-grid-right-sidebar', 'ronby' ); ?>
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 2) { ?>
	<?php get_template_part( 'blog-templates/business-blog-grid-two-column', 'ronby' ); ?>
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 3) { ?>
	<?php get_template_part( 'blog-templates/business-blog-grid-three-column', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 4) { ?>
	<?php get_template_part( 'blog-templates/business-blog-list', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 5) { ?>
	<?php get_template_part( 'blog-templates/business-blog-list-left-sidebar', 'ronby' ); ?>
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 6) { ?>
	<?php get_template_part( 'blog-templates/business-blog-list-right-sidebar', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 7) { ?>
	<?php get_template_part( 'blog-templates/business-blog-thumbnail', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 8) { ?>
	<?php get_template_part( 'blog-templates/business-blog-thumbnail-with-sidebar', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 9) { ?>
	<?php get_template_part( 'blog-templates/fitness-blog', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 10) { ?>
	<?php get_template_part( 'blog-templates/food-blog', 'ronby' ); ?>		
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 11) { ?>
	<?php get_template_part( 'blog-templates/medical-blog', 'ronby' ); ?>	
  <?php } elseif(ronby_get_option('ronby_blog_page_layout') == 12) { ?>
	<?php get_template_part( 'blog-templates/shop-blog', 'ronby' ); ?>		
  <?php }else{ ?>
	<?php get_template_part( 'blog-templates/business-blog-list-right-sidebar', 'ronby' ); ?>	
  <?php } ?>			
  <!-- end -->
<?php get_footer(); ?>