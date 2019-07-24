<?php 
/************************************* 
Start All comment functions from here
**************************************/

/**********************************************************************
create subject meta for comment form
**********************************************************************/

// Step- 1 - create subject meta
add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
 if ( have_comments() ) {
	if(isset($_POST[ 'subject' ])){
		$subject= $_POST[ 'subject' ];
	}else{
		$subject= "New Comment";	
	}	
    add_comment_meta( $comment_id, 'subject', $subject );
 }
}

// Step- 2 - attach subject meta data with author
add_filter( 'get_comment_author_link', 'attach_subject_to_author' );
function attach_subject_to_author( $author ) {
 if ( have_comments() ) {
    $subject = get_comment_meta( get_comment_ID(), 'subject', true );
    if ( $subject )
        $author .= " ($subject)";
    return $author;
 }
}
/********************************************************************** 
Add Subject Column to Comment Admin Page
**********************************************************************/
function ronby_subject_comment_columns( $columns )
{
 if ( have_comments() ) {
	$columns['subject'] = esc_attr__( 'Subject','ronby' );
	return $columns;
 }
}
add_filter( 'manage_edit-comments_columns', 'ronby_subject_comment_columns', 3 );
function ronby_get_subject_comment_column_data( $column, $comment_ID )
{
 if ( have_comments() ) {
	if ( 'subject' == $column ) {
		echo get_comment_meta( get_comment_ID(), 'subject', true );
	}
 }
}
add_filter( 'manage_comments_custom_column', 'ronby_get_subject_comment_column_data', 10, 2 );
// Move the subject column before the comment column
function change_subject_column_order($defaults) {
 if ( have_comments() ) {
    $new = array();
    $subject = $defaults['subject'];  // save the subject column
    unset($defaults['subject']);   // remove it from the columns list

    foreach($defaults as $key=>$value) {
        if($key=='comment') {  // when we find the comment column
           $new['subject'] = $subject;  // put the subject column before it
        }    
        $new[$key]=$value;
    }  

    return $new;
 }	
} 
add_filter('manage_edit-comments_columns', 'change_subject_column_order');


/**
 * Returns information about the current post's discussion, with cache support.
 */
function ronby_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$discussion = (object) array(
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

//Check if the post layout is business layout
if(ronby_get_option('ronby_blog_post_layout') == 1){
	
/**********************************************************************
Display Comments section
**********************************************************************/
if ( ! function_exists( 'ronby_comment' ) ) {
	function ronby_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	?>	
	<li>
	                    <div <?php comment_class("comment-item-1 d-flex align-items-center"); ?> id="comment-<?php comment_ID() ?>">
           					<div class="comment-avatar">
								<?php echo get_avatar($comment, 90); ?>
								</div>
							<div class="comment-content flex-fill position-relative ">
								<div class="comment-header">
									<span class="comment-author"><?php comment_author(); ?></span>
									<span class="comment-time color-secondary"><?php comment_date(' M d, Y h:i a') ?></span>
									<div class="comment-actions">
									<?php comment_reply_link(array_merge( $args, array(
									'reply_text' => esc_attr__('Reply', 'ronby'),
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
									))); ?>
									</div>
								</div>				
								<div class="comment-text">
								<?php comment_text()?>
								</div>
                            </div>									
                    </div>


	<!-- #comment# -->
	<?php
	
	}
}
// filter to replace class on reply link
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link comment-reply background-primary animate-300 hover-background-secondary hover-color-white", $class);
    return $class;
}
/*******************
Comment form styling
*******************/
if ( ! function_exists( 'ronby_modify_comment_fields' ) ) {
	function ronby_modify_comment_fields($fields) {
	$fields['fields'] ='<div class="row">';
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group">
                      <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name*", "ronby").'"';
	$n_value = '';
	$e_value = '';
	$fields['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
						 </div></div>';					 				 
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email*", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group"><input type="text" id="subject" name="subject" class="input-styled" placeholder="'.esc_attr__("Subject*", "ronby").'"  aria-required="false" /></div></div>';	
	$fields['fields'] .='</div>';
	return $fields;
	}
}

add_filter('comment_form_defaults', 'ronby_modify_comment_fields');//Name, Email and Website fields customization filter

if ( !is_user_logged_in() ) { 
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field'] = '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
} else {
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field'] = '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
}
if ( !is_user_logged_in() ) {
function ronby_comment_form_submit_button($button) {
	$button ='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="form-submit button button-primary rounded-capsule mt-3">'.esc_attr__("Post Comment", "ronby").' </button>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
} else {
function ronby_comment_form_submit_button($button) {
	$button ='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="form-submit button button-primary rounded-capsule mt-3">'.esc_attr__("Post Comment", "ronby").' </button>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
}	
}

//Check if the post layout is construction layout
if(ronby_get_option('ronby_blog_post_layout') == 2){
/**********************************************************************
Display Comments section
**********************************************************************/
if ( ! function_exists( 'ronby_comment' ) ) {
	function ronby_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	?>	
	<li>
	                    <div <?php comment_class("comment-item-2 d-flex align-items-center"); ?> id="comment-<?php comment_ID() ?>">
           					<div class="comment-avatar">
								<?php echo get_avatar($comment, 90); ?>
									<div class="comment-actions">
									<?php comment_reply_link(array_merge( $args, array(
									'reply_text' => esc_attr__('Reply', 'ronby'),
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
									))); ?>
									</div>								
							</div>
							<div class="comment-content ">
								<div class="comment-header">
									<span class="comment-author"><?php comment_author(); ?></span>
									<span class="comment-meta"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
			
								</div>				
								<div class="comment-text">
								<?php comment_text()?>
								</div>
                            </div>									
                    </div>


	<!-- #comment# -->
	<?php
	
	}
}
// filter to replace class on reply link
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link reply-button background-primary", $class);
    return $class;
}
/*******************
Comment form styling
*******************/
if ( ! function_exists( 'ronby_modify_comment_fields' ) ) {
	function ronby_modify_comment_fields($fields) {
	$fields['fields'] ='<div class="row">';
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group">
                      <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
	$n_value = '';
	$e_value = '';
	$fields['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
						 </div></div>';					 				 
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group"><input type="text" id="subject" name="subject" class="input-styled" placeholder="'.esc_attr__("Subject *", "ronby").'"  aria-required="false" /></div></div>';	
	$fields['fields'] .='</div>';
	return $fields;
	}
}

add_filter('comment_form_defaults', 'ronby_modify_comment_fields');//Name, Email and Website fields customization filter

if ( !is_user_logged_in() ) { 
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field'] = '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
} else {
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field'] = '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
}
if ( !is_user_logged_in() ) {
function ronby_comment_form_submit_button($button) {
	$button ='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded comment-submit">'.esc_attr__("Post Comment", "ronby").' </button>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
} else {
function ronby_comment_form_submit_button($button) {
	$button ='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded comment-submit">'.esc_attr__("Post Comment", "ronby").' </button>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
}

function ronby_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;

return $fields;
}
add_filter( 'comment_form_fields', 'ronby_move_comment_field_to_bottom' );//move the comment text field to the bottom		
}

//Check if the post layout is fitness layout
if(ronby_get_option('ronby_blog_post_layout') == 3){
/**********************************************************************
Display Comments section
**********************************************************************/
if ( ! function_exists( 'ronby_comment' ) ) {
	function ronby_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	?>	
	<li>
	                    <div <?php comment_class("comment-item-3"); ?> id="comment-<?php comment_ID() ?>">
			
           					<div class="comment-avatar">
								<?php echo get_avatar($comment, 90); ?>							
							</div>
							<div class="comment-content ">
								<div class="comment-header">
								
									<span class="comment-author"><?php comment_author(); ?></span>
									
									<span class="comment-time"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
									
									<div class="comment-actions">
									<?php comment_reply_link(array_merge( $args, array(
									'reply_text' => esc_attr__('Reply', 'ronby'),
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
									))); ?>
									</div>	
			
								</div>				
								<div class="comment-text">
								<?php comment_text()?>
								</div>
                            </div>
									
						</div>


	<!-- #comment# -->
	<?php
	
	}
}
// filter to replace class on reply link
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link comment-reply color-primary", $class);
    return $class;
}
/*******************
Comment form styling
*******************/
if ( ! function_exists( 'ronby_modify_comment_fields' ) ) {
	function ronby_modify_comment_fields($fields) {
	$fields['fields'] ='<div class="form-style-5">';	
	$fields['fields'] .='<div class="row">';
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group">
                      <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
	$n_value = '';
	$e_value = '';
	$fields['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
						 </div></div>';					 				 
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group"><input type="text" id="subject" name="subject" class="input-styled" placeholder="'.esc_attr__("Subject *", "ronby").'"  aria-required="false" /></div></div>';	
	$fields['fields'] .='</div>';
	$fields['fields'] .='</div>';
	return $fields;
	}
}

add_filter('comment_form_defaults', 'ronby_modify_comment_fields');//Name, Email and Website fields customization filter

if ( !is_user_logged_in() ) { 
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-5">';		
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
} else {
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-5">';	
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
}
if ( !is_user_logged_in() ) {
function ronby_comment_form_submit_button($button) {
	$button ='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post Comment", "ronby").' </button>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
} else {
function ronby_comment_form_submit_button($button) {
	$button ='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post Comment", "ronby").' </button>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
}

function ronby_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;

return $fields;
}
add_filter( 'comment_form_fields', 'ronby_move_comment_field_to_bottom' );//move the comment text field to the bottom		
}

//Check if the post layout is medical layout
if(ronby_get_option('ronby_blog_post_layout') == 4){
/**********************************************************************
Display Comments section
**********************************************************************/
if ( ! function_exists( 'ronby_comment' ) ) {
	function ronby_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	?>	
	<li>
	                    <div <?php comment_class("comment-item-4 d-flex align-items-center"); ?> id="comment-<?php comment_ID() ?>">
							<div class="comment-avatar">
								<span class="avatar-media"><?php echo get_avatar($comment, 90); ?></span>
									<?php comment_reply_link(array_merge( $args, array(
									'reply_text' => esc_attr__('Reply', 'ronby'),
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
									))); ?>								
							</div>
							<div class="comment-content flex-grow-1 flex-shrink-1">
								<div class="comment-header">

									<span class="comment-author"><?php comment_author(); ?></span>
									
									<span class="comment-time color-secondary"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
											
								</div>				
								<div class="comment-text">
								<?php comment_text()?>
								</div>
                            </div>									
						</div>
	<!-- #comment# -->
	<?php
	
	}
}
// filter to replace class on reply link
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link reply-button background-primary", $class);
    return $class;
}
/*******************
Comment form styling
*******************/
if ( ! function_exists( 'ronby_modify_comment_fields' ) ) {
	function ronby_modify_comment_fields($fields) {
	$fields['fields'] ='<div class="form-style-3">';	
	$fields['fields'] .='<div class="row">';
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group">
                      <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
	$n_value = '';
	$e_value = '';
	$fields['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
						 </div></div>';					 				 
    $fields['fields'] .= '<div class="col-md-6"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
    $fields['fields'] .= '<div class="col-md-6"><div class="form-group"><input type="text" id="subject" name="subject" class="input-styled" placeholder="'.esc_attr__("Subject *", "ronby").'"  aria-required="false" /></div></div>';	
	$fields['fields'] .='</div>';
	$fields['fields'] .='</div>';
	return $fields;
	}
}

add_filter('comment_form_defaults', 'ronby_modify_comment_fields');//Name, Email and Website fields customization filter

if ( !is_user_logged_in() ) { 
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-3">';		
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
} else {
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-3">';	
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
}
if ( !is_user_logged_in() ) {
function ronby_comment_form_submit_button($button) {
	$button ='<div class="form-group py-15px">';
	$button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded">'.esc_attr__("Post Comment", "ronby").' </button>';
	$button .='</div>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
} else {
function ronby_comment_form_submit_button($button) {
	$button ='<div class="form-group py-15px">';
	$button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded">'.esc_attr__("Post Comment", "ronby").' </button>';
	$button .='</div>';	
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
}

function ronby_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;

return $fields;
}
add_filter( 'comment_form_fields', 'ronby_move_comment_field_to_bottom' );//move the comment text field to the bottom		
}

//Check if the post layout is shop layout
if(ronby_get_option('ronby_blog_post_layout') == 5){
/**********************************************************************
Display Comments section
**********************************************************************/
if ( ! function_exists( 'ronby_comment' ) ) {
	function ronby_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	?>	
	<li>
	                    <div <?php comment_class("comment-item-5"); ?> id="comment-<?php comment_ID() ?>">
							<div class="comment-avatar">
								<?php echo get_avatar($comment, 90); ?>
							</div>
							<div class="comment-content">
								<div class="comment-header">
									<span class="comment-author"><?php comment_author(); ?></span>
									
									<span class="comment-time"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
									<div class="comment-actions">
									<?php comment_reply_link(array_merge( $args, array(
									'reply_text' => esc_attr__('Reply', 'ronby'),
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
									))); ?>	
									</div>
								</div>				
								<div class="comment-text">
								<?php comment_text()?>
								</div>
                            </div>									
						</div>
	<!-- #comment# -->
	<?php
	
	}
}
// filter to replace class on reply link
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link comment-reply color-primary", $class);
    return $class;
}
/*******************
Comment form styling
*******************/
if ( ! function_exists( 'ronby_modify_comment_fields' ) ) {
	function ronby_modify_comment_fields($fields) {
	$fields['fields'] ='<div class="form-style-7">';	
	$fields['fields'] .='<div class="row">';
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group">
                      <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
	$n_value = '';
	$e_value = '';
	$fields['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
						 </div></div>';					 				 
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
    $fields['fields'] .= '<div class="col-md-4"><div class="form-group"><input type="text" id="subject" name="subject" class="input-styled" placeholder="'.esc_attr__("Subject *", "ronby").'"  aria-required="false" /></div></div>';	
	$fields['fields'] .='</div>';
	$fields['fields'] .='</div>';
	return $fields;
	}
}

add_filter('comment_form_defaults', 'ronby_modify_comment_fields');//Name, Email and Website fields customization filter

if ( !is_user_logged_in() ) { 
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-7">';		
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
} else {
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-7">';	
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
}
if ( !is_user_logged_in() ) {
function ronby_comment_form_submit_button($button) {
	$button ='<div class="form-group py-15px">';
	$button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post Comment", "ronby").' </button>';
	$button .='</div>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
} else {
function ronby_comment_form_submit_button($button) {
	$button ='<div class="form-group py-15px">';
	$button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded-capsule comment-submit">'.esc_attr__("Post Comment", "ronby").' </button>';
	$button .='</div>';	
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
}

function ronby_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;

return $fields;
}
add_filter( 'comment_form_fields', 'ronby_move_comment_field_to_bottom' );//move the comment text field to the bottom		
}

//Check if the post layout is fitness layout
if(ronby_get_option('ronby_blog_post_layout') == 6){
/**********************************************************************
Display Comments section
**********************************************************************/
if ( ! function_exists( 'ronby_comment' ) ) {
	function ronby_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	?>	
	<li>
	                    <div <?php comment_class("comment-item-6"); ?> id="comment-<?php comment_ID() ?>">
							<div class="comment-avatar">
								<?php echo get_avatar($comment, 90); ?>
							</div>
							<div class="comment-content ">
								<div class="comment-header d-flex flex-wrap justify-content-between">
								<div>
									<span class="comment-author"><?php comment_author(); ?></span>
									
									<span class="comment-time"><?php comment_date(' M d, Y') ?><?php echo esc_html__(' at','ronby');?><?php comment_date(' h:i a') ?></span>
								</div>	
									<div class="comment-actions">
									<?php comment_reply_link(array_merge( $args, array(
									'reply_text' => esc_attr__('Reply', 'ronby'),
									'depth' => $depth, 
									'max_depth' => $args['max_depth']
									))); ?>
									</div>	
			
								</div>				
								<div class="comment-text">
								<?php comment_text()?>
								</div>
                            </div>									
						</div>
	<!-- #comment# -->
	<?php
	
	}
}
// filter to replace class on reply link
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link comment-reply color-primary", $class);
    return $class;
}
/*******************
Comment form styling
*******************/
if ( ! function_exists( 'ronby_modify_comment_fields' ) ) {
	function ronby_modify_comment_fields($fields) {
	$fields['fields'] ='<div class="form-style-8">';	
	$fields['fields'] .='<div class="row">';
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group">
                      <input type="text" id="author" class="input-styled" name="author"  placeholder="'.esc_attr__("Name *", "ronby").'"';
	$n_value = '';
	$e_value = '';
	$fields['fields'] .= ' value="'.esc_attr($n_value).'" aria-required="true" />
						 </div></div>';					 				 
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group"><input type="email" id="email_address" name="email" class="input-styled" placeholder="'.esc_attr__("Email *", "ronby").'" value="'.esc_attr($e_value).'" aria-required="true" /></div></div>';
    $fields['fields'] .= '<div class="col-md-12"><div class="form-group"><input type="text" id="subject" name="subject" class="input-styled" placeholder="'.esc_attr__("Subject *", "ronby").'"  aria-required="false" /></div></div>';	
	$fields['fields'] .='</div>';
	$fields['fields'] .='</div>';
	return $fields;
	}
}

add_filter('comment_form_defaults', 'ronby_modify_comment_fields');//Name, Email and Website fields customization filter

if ( !is_user_logged_in() ) { 
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-8">';		
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
} else {
if ( ! function_exists( 'ronby_comment_field' ) ) {
	function ronby_comment_field($arg) {
	$arg['comment_field']  ='<div class="form-style-8">';	
	$arg['comment_field'] .= '<div class="form-group">
								<textarea name="comment" class="input-styled" id="comment" rows="10"  placeholder="'.esc_attr__("Your comment *", "ronby").'"></textarea></div>';
	$arg['comment_field'] .='</div>';							
	return $arg;
	}
}
add_filter('comment_form_defaults', 'ronby_comment_field', 1, 1);//Text area customization filter
}
if ( !is_user_logged_in() ) {
function ronby_comment_form_submit_button($button) {
	$button ='<div class="form-group py-15px">';
	$button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded">'.esc_attr__("Post Comment", "ronby").' </button>';
	$button .='</div>';
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
} else {
function ronby_comment_form_submit_button($button) {
	$button ='<div class="form-group py-15px">';
	$button .='<button name="submit" type="submit" id="[args:id_submit]" value="[args:label_submit]" class="button button-primary rounded">'.esc_attr__("Post Comment", "ronby").' </button>';
	$button .='</div>';	
	return $button;
}
add_filter('comment_form_submit_button', 'ronby_comment_form_submit_button');//Submit button customization filter
}

function ronby_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;

return $fields;
}
add_filter( 'comment_form_fields', 'ronby_move_comment_field_to_bottom' );//move the comment text field to the bottom		
}