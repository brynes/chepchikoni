<?php
/**
 * 404 page
 */
if (!defined('ABSPATH')) exit;
get_header(); ?>
<?php if(ronby_get_option('ronby_page_header_section_switch') == 1 ){ ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION =-=-=-=-=-=-= -->
  <?php if (function_exists('ronby_page_heading_function')) ronby_page_heading_function(); ?>
<!-- =-=-=-=-=-=-= PAGE HEADING SECTION END =-=-=-=-=-=-= -->
<?php } ?>
		<section class="sec-padding ronby-page-post-page error-404-sec">
			<div class="container">
			  <div class="row">
				<div class="error_404">
				<h1 class="uppercase font90 font-color"><?php esc_html_e('Oops', 'ronby'); ?></h1>
				<h2 class="font-thin font35"><?php esc_html_e('Oops... Nothing Found!', 'ronby'); ?></h2>
				<p class="m-bottom4 m-top2"><?php esc_html_e('Sorry nothing found here. Try using the button below to go to main page of the site', 'ronby'); ?></p>
				<div class="m-bottom4">
				  <div class="input-group input-group-lg one divcenter newsletter">
					<span class="input-group-btn">
					<a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-default uppercase"><?php esc_html_e('Home', 'ronby'); ?></a>
					</span> </div>
				</div>
			  </div>
			</div>
			</div>
		</section> 				
<?php get_footer(); ?>