<?php
/**
* The default single post page of this theme
*/
get_header();
?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 1){ ?>
<?php get_template_part( 'blog-templates/business-post-layout', 'ronby' ); ?>
<?php } elseif(ronby_get_option('ronby_blog_post_layout') == 2) { ?>
<?php get_template_part( 'blog-templates/construction-post-layout', 'ronby' ); ?>
<?php } elseif(ronby_get_option('ronby_blog_post_layout') == 3) { ?>
<?php get_template_part( 'blog-templates/fitness-post-layout', 'ronby' ); ?>
<?php } elseif(ronby_get_option('ronby_blog_post_layout') == 4) { ?>
<?php get_template_part( 'blog-templates/medical-post-layout', 'ronby' ); ?>
<?php } elseif(ronby_get_option('ronby_blog_post_layout') == 5) { ?>
<?php get_template_part( 'blog-templates/shop-post-layout', 'ronby' ); ?>
<?php } elseif(ronby_get_option('ronby_blog_post_layout') == 6) { ?>
<?php get_template_part( 'blog-templates/food-post-layout', 'ronby' ); ?>	
<?php }else{ ?>
<?php get_template_part( 'blog-templates/fitness-post-layout', 'ronby' ); ?>	
<?php } ?>		
<?php get_footer(); ?>