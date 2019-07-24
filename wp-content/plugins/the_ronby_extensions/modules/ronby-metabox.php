<?php
/********************************************
Ronby All meta box functions start from here
*********************************************/
function ronby_add_meta_box() {
		global $post;
		
		add_meta_box(
                'ronby-page-headline', esc_html__( 'Page Head line Settings', 'ronby' ), 'ronby_page_headline_meta_callback', array('page'), 'normal', 'high'
        );
		add_meta_box( 'ronby-post-views', esc_html__( 'Post Views Settings', 'ronby' ), 'ronby_post_views_meta_callback', 'post', 'normal', 'high' );
		add_meta_box( 'ronby-post-likes', esc_html__( 'Post Likes Settings', 'ronby' ), 'ronby_post_likes_meta_callback', 'post', 'normal', 'high' );
		add_meta_box( 'ronby-faq-settings', esc_html__( 'FAQ Settings', 'ronby' ), 'ronby_faq_meta_callback', 'post', 'normal', 'high' );		
		add_meta_box( 'ronby-user-quote-settings', esc_html__( 'User Quote Settings', 'ronby' ), 'ronby_user_quote_meta_callback', 'post', 'normal', 'high' );
		add_meta_box( 'ronby-blog-template-excerpt-settings', esc_html__( 'Blog Post Excerpt Settings', 'ronby' ), 'ronby_blog_template_excerpt_callback', 'page', 'normal', 'high' );	
		add_meta_box( 'ronby-product-new-badge-settings', esc_html__( 'Product Badge Settings', 'ronby' ), 'ronby_product_new_badge_callback', 'product', 'normal', 'high' );		
}
add_action( 'add_meta_boxes', 'ronby_add_meta_box' );


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function ronby_page_headline_meta_callback( $post ) {
        global $post;
        // Add an nonce field so we can check for it later.
       // wp_nonce_field( 'ronby_meta_box', 'ronby_meta_box_nonce' );
		wp_nonce_field( 'ronby_meta_box', 'ronby_page_headline_nonce' );

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
		$ronby_page_heading_one        = get_post_meta( $post->ID, 'ronby_page_heading_one', true ); 
        $ronby_page_heading_two     = get_post_meta( $post->ID, 'ronby_page_heading_two', true );
        ?>  
        <div class="wrap">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="ronby_page_heading_one"><?php esc_html_e('Page Headline One', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="ronby_page_heading_one" class="widefat" value="<?php esc_attr_e($ronby_page_heading_one); ?>" id="ronby_page_heading_one">            
                    </td>
                </tr>
		        <tr valign="top">
                    <th scope="row">
                        <label for="ronby_page_heading_two"><?php echo esc_html__('Page Headline Two', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="ronby_page_heading_two" class="widefat" value="<?php echo esc_attr($ronby_page_heading_two); ?>" id="ronby_page_heading_two">            
                    </td>
                </tr>		
                <!-- End Page Heading -->
                                                
            </table>
        </div>        
        <?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ronby_save_page_headline_meta_box_data($post_id) {

        
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'ronby_page_headline_nonce' ] ) && wp_verify_nonce( $_POST[ 'ronby_page_headline_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'ronby_page_heading_one' ] ) ) {
        update_post_meta( $post_id, 'ronby_page_heading_one', sanitize_text_field( $_POST[ 'ronby_page_heading_one' ] ) );
    }
    if( isset( $_POST[ 'ronby_page_heading_two' ] ) ) {
        update_post_meta( $post_id, 'ronby_page_heading_two', sanitize_text_field( $_POST[ 'ronby_page_heading_two' ] ) );
    }

}

add_action( 'save_post', 'ronby_save_page_headline_meta_box_data', 10, 2 );

/*******************************
Post Views Meta Box Functions
*********************************/


function ronby_post_views_meta_callback()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $text = get_post_meta( $post->ID, 'post_views_count', true ); 
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'ronby_post_views_nonce', 'meta_box_nonce2' );
    ?>
        <div class="wrap">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="post_views_count"><?php esc_html_e('Post Views Custom Number', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="post_views_count" class="widefat" value="<?php esc_attr_e($text); ?>" id="post_views_count">            
                    </td>
                </tr>		
                <!-- End Page Heading -->
                                                
            </table>
        </div> 
    <?php    
}

add_action( 'save_post', 'ronby_post_views_meta_box_save' );
function ronby_post_views_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce2'] ) || !wp_verify_nonce( $_POST['meta_box_nonce2'], 'ronby_post_views_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array();
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['post_views_count'] ) )
        update_post_meta( $post_id, 'post_views_count', $_POST['post_views_count'] );
         
}

/*******************************
Post Likes Meta Box Functions
*********************************/
function ronby_post_likes_meta_callback()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $text = get_post_meta( $post->ID, 'votes_count', true ); 
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'ronby_post_likes_nonce', 'meta_box_nonce3' );
    ?>
        <div class="wrap">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="votes_count"><?php esc_html_e('Post Likes Custom Number', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="votes_count" class="widefat" value="<?php esc_attr_e($text); ?>" id="votes_count">            
                    </td>
                </tr>		
                <!-- End Page Heading -->
                                                
            </table>
        </div> 
    <?php    
}

add_action( 'save_post', 'ronby_post_likes_meta_box_save' );
function ronby_post_likes_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce3'] ) || !wp_verify_nonce( $_POST['meta_box_nonce3'], 'ronby_post_likes_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array();
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['votes_count'] ) ){
	update_post_meta( $post_id, 'votes_count', $_POST['votes_count'] );
	}
         
}

/*******************************
FAQ Meta Box Functions
*********************************/
function ronby_faq_meta_callback()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $title = get_post_meta( $post->ID, 'title', true ); 
    $sub_title = get_post_meta( $post->ID, 'sub_title', true ); 
	
    $q1_img_url = get_post_meta( $post->ID, 'q1_img_url', true ); 
    $q1_title = get_post_meta( $post->ID, 'q1_title', true ); 
    $q1_excerpt = get_post_meta( $post->ID, 'q1_excerpt', true ); 
    $q1_link = get_post_meta( $post->ID, 'q1_link', true );
	
    $q2_img_url = get_post_meta( $post->ID, 'q2_img_url', true ); 
    $q2_title = get_post_meta( $post->ID, 'q2_title', true ); 
    $q2_excerpt = get_post_meta( $post->ID, 'q2_excerpt', true );
    $q2_link = get_post_meta( $post->ID, 'q2_link', true ); 
 	
    $q3_img_url = get_post_meta( $post->ID, 'q3_img_url', true ); 
    $q3_title = get_post_meta( $post->ID, 'q3_title', true ); 
    $q3_excerpt = get_post_meta( $post->ID, 'q3_excerpt', true );
    $q3_link = get_post_meta( $post->ID, 'q3_link', true ); 	
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'ronby_faq_nonce', 'meta_box_nonce' );
    ?>
        <div class="wrap">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="title"><?php esc_html_e('Section Title', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="title" class="widefat" value="<?php echo esc_attr($title); ?>" id="title">            
                    </td>
                </tr>		
                <tr valign="top">
                    <th scope="row">
                        <label for="sub_title"><?php esc_html_e('Section Sub Title', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="sub_title" class="widefat" value="<?php echo esc_attr($sub_title); ?>" id="sub_title">            
                    </td>
                </tr>  
                <tr valign="top">
                    <th scope="row">
                        <label for="q1_title"><?php esc_html_e('Q-1 Title', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q1_title" class="widefat" value="<?php echo esc_attr($q1_title); ?>" id="q1_title">            
                    </td>
                </tr>  	
                <tr valign="top">
                    <th scope="row">
                        <label for="q1_excerpt"><?php esc_html_e('Q-1 Excerpt', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q1_excerpt" class="widefat" value="<?php echo esc_attr($q1_excerpt); ?>" id="q1_excerpt">            
                    </td>
                </tr> 
                <tr valign="top">
                    <th scope="row">
                        <label for="q1_img_url"><?php esc_html_e('Q-1 Image URL', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q1_img_url" class="widefat" value="<?php echo esc_url($q1_img_url); ?>" id="q1_img_url" placeholder="http://">            
                    </td>
                </tr> 
                <tr valign="top">
                    <th scope="row">
                        <label for="q1_link"><?php esc_html_e('Q-1 Link', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q1_link" class="widefat" value="<?php echo esc_url($q1_link); ?>" id="q1_link" placeholder="http://">            
                    </td>
                </tr>
<!-- Q-2 -->				
                <tr valign="top">
                    <th scope="row">
                        <label for="q2_title"><?php esc_html_e('Q-2 Title', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q2_title" class="widefat" value="<?php echo esc_attr($q2_title); ?>" id="q2_title">            
                    </td>
                </tr>  	
                <tr valign="top">
                    <th scope="row">
                        <label for="q2_excerpt"><?php esc_html_e('Q-2 Excerpt', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q2_excerpt" class="widefat" value="<?php echo esc_attr($q2_excerpt); ?>" id="q2_excerpt">            
                    </td>
                </tr> 
                <tr valign="top">
                    <th scope="row">
                        <label for="q2_img_url"><?php esc_html_e('Q-2 Image URL', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q2_img_url" class="widefat" value="<?php echo esc_url($q2_img_url); ?>" id="q2_img_url" placeholder="http://">            
                    </td>
                </tr> 
                <tr valign="top">
                    <th scope="row">
                        <label for="q2_link"><?php esc_html_e('Q-2 Link', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q2_link" class="widefat" value="<?php echo esc_url($q2_link); ?>" id="q2_link" placeholder="http://">            
                    </td>
                </tr> 
<!-- Q-3 -->				
                <tr valign="top">
                    <th scope="row">
                        <label for="q3_title"><?php esc_html_e('Q-3 Title', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q3_title" class="widefat" value="<?php echo esc_attr($q3_title); ?>" id="q3_title">            
                    </td>
                </tr>  	
                <tr valign="top">
                    <th scope="row">
                        <label for="q3_excerpt"><?php esc_html_e('Q-3 Excerpt', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q3_excerpt" class="widefat" value="<?php echo esc_attr($q3_excerpt); ?>" id="q3_excerpt">            
                    </td>
                </tr> 
                <tr valign="top">
                    <th scope="row">
                        <label for="q3_img_url"><?php esc_html_e('Q-3 Image URL', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q3_img_url" class="widefat" value="<?php echo esc_url($q3_img_url); ?>" id="q3_img_url" placeholder="http://">            
                    </td>
                </tr> 
                <tr valign="top">
                    <th scope="row">
                        <label for="q3_link"><?php esc_html_e('Q-3 Link', 'ronby'); ?></label>
                    </th>
                    <td style="vertical-align: middle;">
                        <input type="text" name="q3_link" class="widefat" value="<?php echo esc_url($q3_link); ?>" id="q3_link" placeholder="http://">            
                    </td>
                </tr> 				
            </table>
        </div> 
    <?php    
}
add_action( 'save_post', 'ronby_faq_meta_box_save' );
function ronby_faq_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'ronby_faq_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data  
    // Make sure your data is set before trying to save it
    if( isset( $_POST['title'] ) ){
	update_post_meta( $post_id, 'title', $_POST['title'] );}
    if( isset( $_POST['sub_title'] ) ){
	update_post_meta( $post_id, 'sub_title', $_POST['sub_title'] );}
    if( isset( $_POST['q1_img_url'] ) ){
	update_post_meta( $post_id, 'q1_img_url', $_POST['q1_img_url'] );}	
    if( isset( $_POST['q1_title'] ) ){
	update_post_meta( $post_id, 'q1_title', $_POST['q1_title'] );}		
    if( isset( $_POST['q1_excerpt'] ) ){
	update_post_meta( $post_id, 'q1_excerpt', $_POST['q1_excerpt'] );}	
    if( isset( $_POST['q1_link'] ) ){
	update_post_meta( $post_id, 'q1_link', $_POST['q1_link'] );}
    if( isset( $_POST['q2_img_url'] ) ){
	update_post_meta( $post_id, 'q2_img_url', $_POST['q2_img_url'] );}	
	if( isset( $_POST['q2_title'] ) ){
	update_post_meta( $post_id, 'q2_title', $_POST['q2_title'] );}	
	if( isset( $_POST['q2_excerpt'] ) ){
	update_post_meta( $post_id, 'q2_excerpt', $_POST['q2_excerpt'] );}	
	if( isset( $_POST['q2_link'] ) ){
	update_post_meta( $post_id, 'q2_link', $_POST['q2_link'] );}
	if( isset( $_POST['q3_img_url'] ) ){
	update_post_meta( $post_id, 'q3_img_url', $_POST['q3_img_url'] );}	
	if( isset( $_POST['q3_title'] ) ){
	update_post_meta( $post_id, 'q3_title', $_POST['q3_title'] );}	
	if( isset( $_POST['q3_excerpt'] ) ){
	update_post_meta( $post_id, 'q3_excerpt', $_POST['q3_excerpt'] );}
	if( isset( $_POST['q3_link'] ) ){
	update_post_meta( $post_id, 'q3_link', $_POST['q3_link'] );}		
}

/*****************************
User Quote Meta Function
********************************/
function ronby_user_quote_meta_callback( $post ) {
global $post;
// Add an nonce field so we can check for it later.
wp_nonce_field( 'ronby_user_quote_nonce', 'ronby_user_quote_nonce' );
/*
* Use get_post_meta() to retrieve an existing value
* from the database and use the value for the form.
*/
$quote_content= get_post_meta( $post->ID, 'ronby_post_quote_content', true ); 
$fb_url = get_post_meta( $post->ID, 'ronby_post_quote_fb_url', true );
$twitter_url = get_post_meta( $post->ID, 'ronby_post_quote_twitter_url', true );
$linkedin_url = get_post_meta( $post->ID, 'ronby_post_quote_linkedin_url', true );
$bg_img_url = get_post_meta( $post->ID, 'ronby_post_quote_background_img_url', true );
?>  
<div class="wrap">
   <table class="form-table">
      <tr valign="top">
         <th scope="row">
            <label for="quote_content"><?php esc_html_e('Quote Content', 'ronby'); ?></label>
         </th>
         <td style="vertical-align: middle;">
            <textarea name="quote_content" id="quote_content" rows="5" cols="30" style="width:100%"><?php esc_attr_e($quote_content); ?></textarea>						
         </td>
      </tr>
      <tr valign="top">
         <th scope="row">
            <label for="fb_url"><?php echo esc_html__('Facebook Profile URL', 'ronby'); ?></label>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="fb_url" class="widefat" value="<?php echo esc_url($fb_url); ?>" id="fb_url">            
         </td>
      </tr>
      <tr valign="top">
         <th scope="row">
            <label for="twitter_url"><?php echo esc_html__('Twitter Profile URL', 'ronby'); ?></label>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="twitter_url" class="widefat" value="<?php echo esc_url($twitter_url); ?>" id="twitter_url">            
         </td>
      </tr>
      <tr valign="top">
         <th scope="row">
            <label for="linkedin_url"><?php echo esc_html__('Linkedin Profile URL', 'ronby'); ?></label>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="linkedin_url" class="widefat" value="<?php echo esc_url($linkedin_url); ?>" id="linkedin_url">            
         </td>
      </tr>
      <tr valign="top">
         <th scope="row">
            <label for="bg_img_url"><?php echo esc_html__('Background Image Upload', 'ronby'); ?></label>
         </th>
         <td style="vertical-align: middle;">
            <div class="image-preview"><img src="<?php echo esc_url($bg_img_url); ?>" style="max-width: 250px;"></div>
            <input type="text" name="bg_img_url" id="bg_img_url" class="meta-image regular-text" value="<?php echo esc_url($bg_img_url); ?>">
            <input type="button" class="button image-upload" value="Browse">            
         </td>
      </tr>
      <script>
         jQuery(document).ready(function (jQuery) {
           // Instantiates the variable that holds the media library frame.
           var meta_image_frame;
           // Runs when the image button is clicked.
           jQuery('.image-upload').click(function (e) {
             // Get preview pane
             var meta_image_preview = jQuery(this).parent().parent().children('.image-preview');
             // Prevents the default action from occuring.
             e.preventDefault();
             var meta_image = jQuery(this).parent().children('.meta-image');
             // If the frame already exists, re-open it.
             if (meta_image_frame) {
               meta_image_frame.open();
               return;
             }
             // Sets up the media library frame
             meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
               title: meta_image.title,
               button: {
                 text: meta_image.button
               }
             });
             // Runs when an image is selected.
             meta_image_frame.on('select', function () {
               // Grabs the attachment selection and creates a JSON representation of the model.
               var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
               // Sends the attachment URL to our custom image input field.
               meta_image.val(media_attachment.url);
               meta_image_preview.children('img').attr('src', media_attachment.url);
             });
             // Opens the media library frame.
             meta_image_frame.open();
           });
         });
      </script>
   </table>
</div>
<?php
}
add_action( 'save_post', 'ronby_user_quote_meta_box_save' );
function ronby_user_quote_meta_box_save( $post_id )
{
// Bail if we're doing an auto save
if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
// if our nonce isn't there, or we can't verify it, bail
if( !isset( $_POST['ronby_user_quote_nonce'] ) || !wp_verify_nonce( $_POST['ronby_user_quote_nonce'], 'ronby_user_quote_nonce' ) ) return;
// if our current user can't edit this post, bail
if( !current_user_can( 'edit_post', $post_id ) ) return;
// now we can actually save the data  
// Make sure your data is set before trying to save it
if( isset( $_POST['quote_content'] ) ){
update_post_meta( $post_id, 'ronby_post_quote_content', $_POST['quote_content'] );}
if( isset( $_POST['fb_url'] ) ){
update_post_meta( $post_id, 'ronby_post_quote_fb_url', $_POST['fb_url'] );}	
if( isset( $_POST['twitter_url'] ) ){
update_post_meta( $post_id, 'ronby_post_quote_twitter_url', $_POST['twitter_url'] );}	
if( isset( $_POST['linkedin_url'] ) ){
update_post_meta( $post_id, 'ronby_post_quote_linkedin_url', $_POST['linkedin_url'] );}	
if( isset( $_POST['bg_img_url'] ) ){
update_post_meta( $post_id, 'ronby_post_quote_background_img_url', $_POST['bg_img_url'] );}	
}

/*****************************
Blog Post Templates Excerpt Functions
********************************/
function ronby_blog_template_excerpt_callback( $post ) {
global $post;
// Add an nonce field so we can check for it later.
wp_nonce_field( 'ronby_blog_template_excerpt_nonce', 'ronby_blog_template_excerpt_nonce' );
/*
* Use get_post_meta() to retrieve an existing value
* from the database and use the value for the form.
*/
$post_excerpt_limit= get_post_meta( $post->ID, 'ronby_post_excerpt_limit', true ); 
$post_content_limit = get_post_meta( $post->ID, 'ronby_post_content_limit', true );
$post_word_limit = get_post_meta( $post->ID, 'ronby_post_word_limit', true );
?>  
<div class="wrap">
   <table class="form-table">
      <tr valign="top">
         <th scope="row">
            <label for="post_excerpt_limit"><?php echo esc_html__('Featured Image Blog Post Excerpt Word Limit.', 'ronby'); ?></label><br>
			<small><?php esc_html_e('Example:50','ronby'); ?></small>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="post_excerpt_limit" class="widefat" value="<?php echo esc_attr($post_excerpt_limit); ?>" id="post_excerpt_limit">            
         </td>
      </tr>
      <tr valign="top">
         <th scope="row">
            <label for="post_content_limit"><?php echo esc_html__('Video Format Blog Post Content Word Limit.', 'ronby'); ?></label><br>
			<small><?php esc_html_e('Example:100','ronby'); ?></small>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="post_content_limit" class="widefat" value="<?php echo esc_attr($post_content_limit); ?>" id="post_content_limit">            
         </td>
      </tr>
      <tr valign="top">
         <th scope="row">
            <label for="post_word_limit"><?php echo esc_html__('Non-Featured Image Blog Post Excerpt Word Limit.', 'ronby'); ?></label><br>
			<small><?php esc_html_e('Example:150','ronby'); ?></small>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="post_word_limit" class="widefat" value="<?php echo esc_attr($post_word_limit); ?>" id="post_word_limit">            
         </td>
      </tr>
   </table>
</div>
<?php
}
add_action( 'save_post', 'ronby_blog_template_excerpt_meta_box_save' );
function ronby_blog_template_excerpt_meta_box_save( $post_id )
{
// Bail if we're doing an auto save
if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
// if our nonce isn't there, or we can't verify it, bail
if( !isset( $_POST['ronby_blog_template_excerpt_nonce'] ) || !wp_verify_nonce( $_POST['ronby_blog_template_excerpt_nonce'], 'ronby_blog_template_excerpt_nonce' ) ) return;
// if our current user can't edit this post, bail
if( !current_user_can( 'edit_post', $post_id ) ) return;
// now we can actually save the data  
// Make sure your data is set before trying to save it
if( isset( $_POST['post_excerpt_limit'] ) ){
update_post_meta( $post_id, 'ronby_post_excerpt_limit', $_POST['post_excerpt_limit'] );}
if( isset( $_POST['post_content_limit'] ) ){
update_post_meta( $post_id, 'ronby_post_content_limit', $_POST['post_content_limit'] );}	
if( isset( $_POST['post_word_limit'] ) ){
update_post_meta( $post_id, 'ronby_post_word_limit', $_POST['post_word_limit'] );}	

}

/*****************************
Product Badge Settings
********************************/
function ronby_product_new_badge_callback( $post ) {
global $post;
// Add an nonce field so we can check for it later.
wp_nonce_field( 'ronby_product_new_badge_nonce', 'ronby_product_new_badge_nonce' );
/*
* Use get_post_meta() to retrieve an existing value
* from the database and use the value for the form.
*/
$ronby_product_new_badge= get_post_meta( $post->ID, 'ronby_product_new_badge', true ); 
$ronby_product_new_badge_bg= get_post_meta( $post->ID, 'ronby_product_new_badge_bg', true ); 
?>  
<div class="wrap">
   <table class="form-table">
	  <tr>
		<th><label><small><?php esc_attr_e('Note: This Settings Only for Shop Products Section Element','ronby'); ?></small></label></th>
	  </tr>
      <tr valign="top" style="border-top:1px solid #d3d3d3">
         <th scope="row">
            <label for="ronby_product_new_badge"><?php  esc_html_e('Product Badge Title', 'ronby'); ?></label><br>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="ronby_product_new_badge" class="widefat" value="<?php echo esc_attr($ronby_product_new_badge); ?>" id="ronby_product_new_badge">            
         </td>
      </tr>
      <tr valign="top" style="border-top:1px solid #d3d3d3">
         <th scope="row">
            <label for="ronby_product_new_badge_bg"><?php  esc_html_e('Product Badge Background Color Code', 'ronby'); ?></label><br>
			<small><?php esc_html_e('Example: #FFC137', 'ronby'); ?></small>
         </th>
         <td style="vertical-align: middle;">
            <input type="text" name="ronby_product_new_badge_bg" class="widefat" value="<?php echo esc_attr($ronby_product_new_badge_bg); ?>" id="ronby_product_new_badge_bg">            
         </td>
      </tr>	  
   </table> 
</div>
<?php
}

// Save Meta Details
add_action('save_post', 'ronby_product_new_badge_save_details');

function ronby_product_new_badge_save_details( $post_id ){
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['ronby_product_new_badge_nonce'] ) || !wp_verify_nonce( $_POST['ronby_product_new_badge_nonce'], 'ronby_product_new_badge_nonce' ) ) return;
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post', $post_id ) ) return;
	// now we can actually save the data  
	// Make sure your data is set before trying to save it
	if( isset( $_POST['ronby_product_new_badge'] ) ){
	update_post_meta( $post_id, 'ronby_product_new_badge', $_POST['ronby_product_new_badge'] );
	}
	if( isset( $_POST['ronby_product_new_badge_bg'] ) ){
	update_post_meta( $post_id, 'ronby_product_new_badge_bg', $_POST['ronby_product_new_badge_bg'] );
	}
}