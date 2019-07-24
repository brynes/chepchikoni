<?php
//check if FAQ meta box and quote meta box is empty add margin
$title = get_post_meta( $post->ID, 'title', true ); 
$sub_title = get_post_meta( $post->ID, 'sub_title', true ); 
$q1_title = get_post_meta( $post->ID, 'q1_title', true ); 
$q2_title = get_post_meta( $post->ID, 'q2_title', true );
$q3_title = get_post_meta( $post->ID, 'q3_title', true ); 	
$quote_content= get_post_meta( $post->ID, 'ronby_post_quote_content', true ); 

$margin_top = '';
if ( ! comments_open() && ! have_comments() ) :
$margin_top='mt-minus-35';
else :
if(!empty($title && $sub_title && $q1_title && $q2_title && $q3_title && $quote_content)) {
  $margin_top='mt-75';
}else{
$margin_top='mt-5'; 
}
endif;

$discussion = ronby_get_discussion_data();
?>

<!-- comments section start-->
<section class="mx-auto mx-width-970 mb-4 comments comment-layout-three <?php echo esc_attr($margin_top); ?>">
    <?php if ( comments_open() ) { 
			if ( have_comments() ) { ?>
	<div class="section-header-style-5">
      <h2 class="section-title">					
        <span><?php esc_html_e( 'Join the Conversation', 'ronby' ); ?></span>
      </h2>
   </div>
			<?php } ?>
   <?php } else { ?>
   <div class="section-header-style-5">
      <h2 class="section-title">					
        <span><?php 
			if ( have_comments() ) {
				if ( '1' == $discussion->responses ) {
					/* translators: %s: post title */
					printf( _x( 'One Reply on &ldquo;%s&rdquo;', 'comments title', 'ronby' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply on &ldquo;%2$s&rdquo;',
							'%1$s Replies on &ldquo;%2$s&rdquo;',
							$discussion->responses,
							'comments title',
							'ronby'
						),
						number_format_i18n( $discussion->responses ),
						get_the_title()
					);
				} 
			} ?>
		</span>
      </h2>
   </div>
   <?php } ?>
   <!-- start commentlist -->
   <?php if ( have_comments() ) : ?>
   <ul class="list-comments">
      <?php wp_list_comments( array( 'callback' => 'ronby_comment' ) ); ?>
   </ul>
   <?php endif; ?>
   <!-- end commentlist -->
   <div class="clearfix"></div>
   <?php if ( have_comments() ) : ?>
   <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>    
   <div class="custom-pagination text-center">
      <ul class="pagination-list">
         <li><?php esc_url( previous_comments_link( '<i class="fas fa-angle-left"></i>' ) ) ?></li>
         <li><?php esc_url( next_comments_link( '<i class="fas fa-angle-right"></i>', 0 ) ) ?></li>
      </ul>
   </div>
   <?php endif; ?>
   <?php endif; ?>
   <?php
      /* If there are no comments and comments are closed, let's leave a note.
       * But we only want the note on posts and pages that had comments in the first place.
       */
      if ( ! comments_open() && have_comments() ) : ?>
   <div class="section-header-style-5 cclosed">
      <h2 class="section-title">					
         <span><?php esc_html_e('Comments are closed','ronby');?></span>
      </h2>
   </div>
   <?php endif; ?>
</section>

<?php if ( comments_open() ) : ?>
<section>
   <div class="container">
      <div  class="mx-auto mx-width-970">
         <div class="form-style-5">
            <?php comment_form(array(
               'title_reply' => esc_html__( 'Leave a Comment' , 'ronby' ),
               'title_reply_before' => '<div class="section-header-style-5 mb-0"><h2 class="section-title">',
               'title_reply_after' => '</h2></div>',
               )); ?>
         </div>
      </div>
   </div>
</section>
<!-- #respond end-->
<?php endif; ?>
<!-- comments section end -->