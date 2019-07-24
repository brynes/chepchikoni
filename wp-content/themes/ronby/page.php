<?php
/**
 * The default page of this theme
 */
get_header();
?>
<?php if(ronby_get_option('ronby_page_header_section_switch') == 1){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
  <?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
<section class="ronby-page-post-page sec-padding">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12">
			
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<!-- post grid -->		
        <div <?php post_class( 'ronby-post-block' ); ?> id="post-<?php the_ID(); ?>">
			<div class="col-12 col-md-12 nopadding">
				<div class="text-box">
					<?php the_content(); ?>
					<?php
                     wp_link_pages( array(
                     'before'      => '<div class="clearfix"></div><div class="page-links page-numbers"><span class="page-links-title">' . esc_html__( 'Pages:', 'ronby' ) . '</span>',
                     'after'       => '</div>',
                     'link_before' => '<span>',
                     'link_after'  => '</span>',
                     'pagelink'    => '<span class="linkstyle">' . esc_html__( '%', 'ronby' ) . ' </span>',
                     'separator'   => '',
                     ) );
                     ?>	
				</div>
			</div>
		</div>
		<?php endwhile; endif; ?>
		<div class="clearfix"></div>
			<!-- Start Comment Section -->		
		   <?php if(comments_open()) { ?>		
		   <div class="col-md-12 nopadding sm-paddings">
			  <?php comments_template( '', true ); ?>
		   </div>
		   <?php } ?>
		   <!-- End Comment Section -->
	  </div>
    </div>
    </div>
</section> 

  <!-- end -->
  <?php get_footer(); ?>