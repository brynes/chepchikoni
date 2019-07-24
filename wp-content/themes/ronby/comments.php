<?php
/**
* The template for displaying Comments.
*/
if ( post_password_required() )
return;
?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 1){ ?>
<?php get_template_part( 'comment-templates/comment-layout-one', 'ronby' ); ?>
<?php }elseif(ronby_get_option('ronby_blog_post_layout') == 2){  ?>
<?php get_template_part( 'comment-templates/comment-layout-two', 'ronby' ); ?>
<?php }elseif(ronby_get_option('ronby_blog_post_layout') == 3){  ?>
<?php get_template_part( 'comment-templates/comment-layout-three', 'ronby' ); ?>
<?php }elseif(ronby_get_option('ronby_blog_post_layout') == 4){  ?>
<?php get_template_part( 'comment-templates/comment-layout-four', 'ronby' ); ?>
<?php }elseif(ronby_get_option('ronby_blog_post_layout') == 5){  ?>
<?php get_template_part( 'comment-templates/comment-layout-five', 'ronby' ); ?>
<?php }elseif(ronby_get_option('ronby_blog_post_layout') == 6){  ?>
<?php get_template_part( 'comment-templates/comment-layout-six', 'ronby' ); ?>
<?php }else{ ?>
<?php get_template_part( 'comment-templates/comment-layout-one', 'ronby' ); ?>
<?php } ?>