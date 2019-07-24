<!-- comments section start-->
<section class="mb-7 comments comment-layout-two">
   <?php if ( have_comments() ) : ?>               
   <div class="section-header-style-4">
      <h2 class="section-title">					
         <?php esc_html_e('Post comments','ronby');?>
      </h2>
      <h4 class="section-sub-title">                  
         <span><?php comments_number(esc_html__('No Comment Yet', 'ronby'), esc_html__('1 Comment', 'ronby'), esc_html__('% Comments', 'ronby') );?></span>
      </h4>
   </div>
   <ul class="comments-list">
      <?php wp_list_comments( array( 'callback' => 'ronby_comment' ) ); ?>
   </ul>
   <!-- .commentlist -->
   <div class="clearfix"></div>
   <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>    
   <div class="custom-pagination text-center">
      <ul class="pagination-list">
         <li><?php esc_url( previous_comments_link( '<i class="fas fa-angle-left"></i>' ) ) ?></li>
         <li><?php esc_url( next_comments_link( '<i class="fas fa-angle-right"></i>', 0 ) ) ?></li>
      </ul>
   </div>
   <?php endif; ?>
   <?php
      /* If there are no comments and comments are closed, let's leave a note.
       * But we only want the note on posts and pages that had comments in the first place.
       */
      if ( ! comments_open() ) : ?>
   <h4 class="comment-field-heading"><?php esc_html_e( 'Comments are closed' , 'ronby' ); ?></h4>
   <?php endif; ?>			 
   <?php endif; // have_comments() ?>
</section>
<?php if ( comments_open() ) : ?>
<section class="mb-7">
   <div class="form-style-3">
      <div id="responding">
         <?php comment_form(array(
            'title_reply' => esc_html__( 'POST COMMENT' , 'ronby' ),
            'title_reply_before' => '<div class="section-header-style-4 mb-0"><h2 class="section-title">',
            'title_reply_after' => '</h2></div>',
            )); ?>
      </div>
   </div>
</section>
<!-- #respond end-->
<?php endif; ?>
<!-- comments section end -->