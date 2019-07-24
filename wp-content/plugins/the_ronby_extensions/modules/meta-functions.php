<?php
/***************************
Business Blog List Meta functions
****************************/
function business_list_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<span><i class="fas fa-user"></i> '.esc_attr__('By','ronby').' '; if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</span>';
	echo $author_meta; //escaped already
}

function business_list_wp_date_meta(){
	$wp_date_format='<span><i class="far fa-calendar-alt"></i> 
					'.esc_attr(get_the_date()).'</span>';
	echo $wp_date_format; //escaped already	 			
}

function business_list_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<span><i class="far fa-calendar-alt"></i> 
						'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
	echo $theme_date_format; //escaped already					
}

function business_list_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='<span><i class="fas fa-comments"></i> ';
				$comments_meta.='<a href="'.get_comments_link().'">';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_html__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
			} else {
				$comments_meta.= esc_html__('1 Comment','ronby');
			}
				$comments_meta.='</a>';
				$comments_meta.='</span>';
		}
	echo $comments_meta; //escaped already
}


/**********************************
Construction Meta functions
*************************************/
function construction_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<div class="author-name"> 
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</div>';
	echo $author_meta;	//escaped already
}

function construction_wp_date_meta(){
	$wp_date_format='<div class="post-date">'.esc_attr(get_the_date()).'</div>';
	echo $wp_date_format; //escaped already				
}

function construction_theme_date_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 	
	$theme_date_format='<div class="post-date">';
	$theme_date_format.=esc_attr($archive_day).' '. esc_attr($archive_month).' '. esc_attr($archive_year).'</div>';	
	echo $theme_date_format; //escaped already
}

function construction_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='<div class="post-comments"> ';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_html__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
			} else {
				$comments_meta.= esc_html__('1 Comment','ronby');
			}
				$comments_meta.='</div>';
		}
	echo $comments_meta; //escaped already
}

function construction_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='<div class="post-comments"> ';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='<div class="post-comments"> ';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</div>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</div>';
	return $output;
}

function construction_faq(){
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
	if($title || $sub_title || $q1_title || $q1_excerpt || $q2_title || $q2_excerpt || $q3_title || $q3_excerpt){
?>
						<section class="questions p-40-0-20">
							<div class="section-header-style-4">
							<?php if($title){ ?>
								<h2 class="section-title"><?php echo esc_attr($title);?></h2>
							<?php } ?>
							<?php if($sub_title){ ?>							
								<h4 class="section-sub-title"><?php echo esc_attr($sub_title);?></h4>
							<?php } ?>	
							</div>
							<?php if($q1_title){ ?>
							<div class="question-item">
							
								<div class="row align-items-center">
								<?php if($q1_img_url){ ?>
									<div class="d-none d-sm-block  col-sm-3 col-md-2">
										<div class="thumbnail animate-zoom">
											<a href="<?php echo esc_attr($q1_link);?>">
												<img src="<?php echo esc_url($q1_img_url);?>" alt="<?php  esc_attr_e('faq-featured-image','ronby');?>">
											</a>
										</div>
									</div>
								<?php } ?>	
									<div class="col-sm-9 col-md-10">
									<?php if($q1_title){ ?>
										<a class="no-color" href="<?php echo esc_attr($q2_link);?>"><h3 class="item-title before-color-primary animte-300 hover-color-primary"><?php echo esc_attr($q1_title);?></h3></a>
									<?php } ?>
						            <?php if($q1_excerpt){ ?>		
										<p class="item-text mb-0">
											<?php echo esc_attr($q1_excerpt);?>
										</p>
									<?php } ?>	
									</div>
								</div>
							</div>
							<?php } if($q2_title){ ?>
							<div class="question-item">
								<div class="row align-items-center">
								<?php if($q2_img_url){ ?>
									<div class="d-none d-sm-block  col-sm-3 col-md-2">
										<div class="thumbnail animate-zoom">
											<a href="<?php echo esc_attr($q2_link);?>">
												<img src="<?php echo esc_url($q2_img_url);?>" alt="<?php  esc_attr_e('faq-featured-image','ronby');?>">
											</a>
										</div>
									</div>
								<?php } ?>	
									<div class="col-sm-9 col-md-10">
									<?php if($q2_title){ ?>
										<a class="no-color" href="<?php echo esc_attr($q2_link);?>"><h3 class="item-title before-color-primary animte-300 hover-color-primary"><?php echo esc_attr($q2_title);?></h3></a>
									<?php } ?>
						            <?php if($q2_excerpt){ ?>		
										<p class="item-text mb-0">
											<?php echo esc_attr($q2_excerpt);?>
										</p>
									<?php } ?>	
									</div>
								</div>
							</div>
							<?php } if($q3_title){ ?>
							<div class="question-item">
								<div class="row align-items-center">
								<?php if($q3_img_url){ ?>
									<div class="d-none d-sm-block  col-sm-3 col-md-2">
										<div class="thumbnail animate-zoom">
											<a href="<?php echo esc_attr($q3_link);?>">
												<img src="<?php echo esc_url($q3_img_url);?>" alt="<?php  esc_attr_e('faq-featured-image','ronby');?>">
											</a>
										</div>
									</div>
								<?php } ?>	
									<div class="col-sm-9 col-md-10">
									<?php if($q3_title){ ?>
										<a class="no-color" href="<?php echo esc_attr($q3_link);?>"><h3 class="item-title before-color-primary animte-300 hover-color-primary"><?php echo esc_attr($q3_title);?></h3></a>
									<?php } ?>
						            <?php if($q3_excerpt){ ?>		
										<p class="item-text mb-0">
											<?php echo esc_attr($q3_excerpt);?>
										</p>
									<?php } ?>	
									</div>
								</div>
							</div>
							<?php }  ?>
						</section>
<?php
	}	
}

function construction_post_footer_meta(){
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;	
?>
						<div class="social-share-3-wrapper">
						<div class="row nopadding">
						<?php if(ronby_get_option('blog_post_social_share_meta_switch') == 1) { ?>
						<div class="<?php if(((ronby_get_option('blog_post_tags_meta_switch') == 1) || (ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1))) { echo "col-md-6";}else{echo "col-md-12";} ?>">
							<div class="social-3 d-flex justify-content-center align-items-center">
								<ul class="list-unstyled mb-0">
									<li>
										<a href="<?php echo esc_url($facebookURL);?>" class="no-color animated">
											<i class="fab fa-facebook"></i> <span class="d-none d-md-inline"><?php esc_html_e('Facebook','ronby');?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo esc_url($pinterestURL);?>" class="no-color animated">
											<i class="fab fa-pinterest-p"></i> <span class="d-none d-md-inline"><?php esc_html_e('Pinterest','ronby');?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo esc_url($twitterURL);?>" class="no-color animated">
											<i class="fab fa-twitter"></i> <span class="d-none d-md-inline"><?php esc_html_e('Twitter','ronby');?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo esc_url($linkedInURL);?>" class="no-color animated">
											<i class="fab fa-linkedin"></i> <span class="d-none d-md-inline"><?php esc_html_e('Linkedin','ronby');?></span>
										</a>
									</li>
								</ul>									
							</div>						
						</div>
						<?php } ?>
					   <?php 
						//check if post like meta switch is turned on
						if(ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1){ ?>						
						<div class="col-md-2 text-center-u-768px <?php if(!(has_tag())){echo "pb-10";}?>">						
						<?php
						  if(function_exists('ronby_get_post_like_link'))echo ronby_get_post_like_link($postid);
						   ?>
						</div>
						<?php } ?>
					   <?php 
						//check if tag meta switch is turned on
						if((ronby_get_option('blog_post_tags_meta_switch') == 1) && has_tag()){ ?>							
						<div class="text-center-u-768px <?php if(( (ronby_get_option('ronby_blog_page_post_like_meta_switch') == 1))) { echo "col-md-4";}else{echo "col-md-6";} ?>">
							<span class="mr-4 single_post_tag_title">
								<?php esc_html_e('Tags:','ronby'); ?>
							</span>
						 <div class="single_post_tag_list tagcloud">	
						    <?php echo get_the_tag_list(); ?>
						 </div>
						</div>
						<?php } ?>						
						</div>
						</div>
<?php	
}

/**********************************
//Post Like Functions Start
*************************************/
add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');
function post_like()
{
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
     
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
		if ( ! empty(getenv('HTTP_CLIENT_IP')) ) {
		//check ip from share internet
		$ip = filter_var(getenv('HTTP_CLIENT_IP'));
		} elseif ( ! empty(getenv('HTTP_X_FORWARDED_FOR')) ) {
		//to check ip is pass from proxy
		$ip = filter_var(getenv('HTTP_X_FORWARDED_FOR'));
		} else {
		$ip = filter_var(getenv('REMOTE_ADDR'));
		}		
        $postid = $_POST['post_id'];
         
        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($postid, "voted_IP");
        $voted_IP = $meta_IP[0];
 
        if(!is_array($voted_IP))
            $voted_IP = array();
         
        // Get votes count for the current post
        $meta_count = get_post_meta($postid, "votes_count", true);
 
        // User has already voted ?
        if(!hasAlreadyVoted($postid))
        {
            $voted_IP[$ip] = time();
 
            // Save IP and increase votes count
            update_post_meta($postid, "voted_IP", $voted_IP);
            update_post_meta($postid, "votes_count", ++$meta_count);
             
            // Display count (ie jQuery return value)
            echo esc_attr($meta_count);
        }
        else
            echo esc_attr("already");
    }
    exit;
}
function hasAlreadyVoted($postid)
{
    global $timebeforerevote;
	if(!empty(get_post_meta($postid, "voted_IP"))){	 
    // Retrieve post votes IPs
    $meta_IP = get_post_meta($postid, "voted_IP");
    $voted_IP = $meta_IP[0];  
    if(!is_array($voted_IP))
        $voted_IP = array();
         
        // Retrieve user IP address
		if ( ! empty(filter_var(getenv('HTTP_CLIENT_IP'))) ) {
		//check ip from share internet
		$ip = filter_var(getenv('HTTP_CLIENT_IP'));
		} elseif ( ! empty(getenv('HTTP_X_FORWARDED_FOR')) ) {
		//to check ip is pass from proxy
		$ip = filter_var(getenv('HTTP_X_FORWARDED_FOR'));
		} else {
		$ip = filter_var(getenv('REMOTE_ADDR'));
		}
     
    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();
         
        // Compare between current time and vote time
        if(round(($now - $time) < 60) > 15724800)
            return false;
             
        return true;
    }
     
    return false;
} 	
}
function ronby_get_post_like_link($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '<span class="post-like">';
    if(hasAlreadyVoted($postid)){
	$output .= ' <i class="fas fa-thumbs-up"></i><span title="'.esc_attr__('I like this article', "ronby").'" class="alreadyvoted mr-0"> </span>';}
    else{
    $output .= '<a href="#" data-post_id="'.$postid.'" class="post-like-btn">
                    <span  title="'.esc_attr__('I like this article', 'ronby').'" class="mr-0" ><i class="fas fa-thumbs-up"></i> Like</span>
	</a>';}
    $output .= '<span class="count mr-0"> '.esc_attr($vote_count).'';if($vote_count==1)$output .= esc_attr__(' Like','ronby');elseif($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' 0 ','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); $output .='</span>';
	$output .='</span>';
     
    return $output;
}
function ronby_get_post_like_count($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '<span class="post-like">';
    $output .= '<i class="fas fa-thumbs-up"></i> <span class="count mr-0"> '.esc_attr($vote_count).'</span>';
	if($vote_count==1)$output .= esc_attr__(' Like','ronby');elseif($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' No Likes','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); 
	$output .='</span>';
     
    return $output;
}

function business_single_post_footer_meta(){ 
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;
?>
		<section class="blog-post-sharing">
			<div class="container">
				<div class="mx-auto mx-width-970">
					<div class="social-2">	
					<div class="row">
					   <?php 
						//check if social share meta switch is turned on
						if(ronby_get_option('blog_post_social_share_meta_switch') == 1){?>					
						<div class="col-md-4 margin-bottom-20">
						<span class="mr-05 bold">
							<?php esc_html_e('Share this article:','ronby'); ?>
						</span>
						<span class="sharing-icons">
							<a href="<?php echo esc_url($facebookURL); ?>" class="no-color animate-300 hover-color-secondary"><i class="fab fa-facebook"></i></a>
							<a href="<?php echo esc_url($twitterURL); ?>" class="no-color animate-300 hover-color-secondary"><i class="fab fa-twitter"></i></a>
							<a href="<?php echo esc_url($pinterestURL); ?>" class="no-color animate-300 hover-color-secondary"><i class="fab fa-pinterest-p"></i></a>
							<a href="<?php echo esc_url($linkedInURL); ?>" class="no-color animate-300 hover-color-secondary"><i class="fab fa-linkedin"></i></a>
						</span>
						</div>
						<?php } ?>
					   <?php 
						//check if post like meta switch is turned on
						if(ronby_get_option('blog_post_like_meta_switch') == 1){?>
						<div class="col-md-2 margin-bottom-20">					
						<span class="mr-4 bold">
						<?php
						  if(function_exists('ronby_get_post_like_link'))echo ronby_get_post_like_link($postid);
						   ?>	
						</span>
						</div>
						<?php } ?>
					   <?php 
						//check if tag meta switch is turned on
						if((ronby_get_option('blog_post_tags_meta_switch') == 1) && has_tag()){ ?>							
						<div class="col-md-6">
							<span class="mr-4 bold single_post_tag_title">
								<?php esc_html_e('Tags:','ronby'); ?>
							</span>
						 <div class="single_post_tag_list tagcloud">					 
							<?php echo get_the_tag_list(); ?>
						 </div>
						</div>
						<?php } ?>	
						</div>
					</div>						
					</div>		
				</div>
				
		</section>	
<?php }

/***************************
Business Blog Grid Meta functions
****************************/
function business_grid_author_meta(){
	$author_id = get_the_author_meta('ID');
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<span class="post-author mr-15"><i class="fas fa-user"></i> 
	'.esc_attr__('By','ronby').' '; 
	$author_meta .= '<a class="no-a-style" href="'.esc_url(get_author_posts_url($author_id)).'"</a>';
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</a></span>';
	echo $author_meta;	//escaped already
}

function business_grid_wp_date_meta(){
	 $ronby_global_post = ronby_get_global_post();
	 $postid = $ronby_global_post->ID;
	 $get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) ); 		
	$wp_date_format='<span ';
	if($get_image){
		$wp_date_format.='class="post-date background-secondary color-inverse"';}else{
		$wp_date_format.='class="post-date-2 mr-15"';}
		$wp_date_format.='>';
		if(empty($get_image)){
		$wp_date_format.='<i class="far fa-calendar-alt"></i> ';}
		$wp_date_format.=esc_attr(get_the_date()).'</span>';
	echo $wp_date_format; //escaped already				
}

function business_grid_theme_date_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 	
	$theme_date_format='<span ';
	if($get_image){
		$theme_date_format.='class="post-date background-secondary color-inverse"';}else{
		$theme_date_format.='class="post-date-2 mr-15"';}
		$theme_date_format.='>';
		if(empty($get_image)){
		$theme_date_format.='<i class="far fa-calendar-alt"></i> ';}$theme_date_format.=esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
		echo $theme_date_format; //escaped already
}

function business_grid_comments_meta($postid){
	$comments_meta='';
	if ( comments_open($postid) ) {
		$comments_meta.='<span class="post-comment-count color-secondary mr-15"><i class="fas fa-comments"></i> ';
		$comments_meta.='<a href="'.get_comments_link().'">';
		if ( get_comments_number($postid) == 0 ) {
		$comments_meta.= esc_html__('0','ronby');
		} elseif ( get_comments_number($postid) > 1 ) {
		$comments_meta.= get_comments_number($postid);
		} else {
		$comments_meta.= esc_html__('1','ronby');
		}
		$comments_meta.='</a>';
		$comments_meta.='</span>';
		}
	echo $comments_meta;//escaped already			
}

function business_grid_get_post_like_count($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '<span class="post-like b-grid-post-like mr-15">';
    $output .= '<i class="fas fa-thumbs-up"></i> <span class="count mr-0"> '.esc_attr($vote_count).'</span>';
	if($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' No Likes','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); 
	$output .='</span>';
     
    return $output;
}
function business_grid_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='<span class="b-grid-post-views"><i class="fas fa-book-reader"></i> ';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='<span class="b-grid-post-views"><i class="fas fa-book-reader"></i> ';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</span>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</span>';
	return $output;
}
/***********************************
Business Blog List Meta Functions
**************************************/
function business_blog_list_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='<span class="b-thumb-post-views"><i class="fas fa-book-reader"></i> ';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='<span class="b-thumb-post-views"><i class="fas fa-book-reader"></i> ';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</span>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</span>';
	return $output;
}

/*****************************************
Business Blog Thumbnail Meta functions
******************************************/
function business_thumbnail_author_avatar_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;	
	$author_id=$ronby_global_post->post_author;
	$link= get_avatar_url($author_id );
	$author_post_url=get_author_posts_url($author_id);
	$author_avatar='<div class="avatar flex-shrink-0">
						<a href="'.esc_url($author_post_url).'">
							<img src="'.esc_url($link).'" alt="'.esc_attr__('author-profile-picture','ronby').'">
						</a>
					</div>';
	echo $author_avatar;//escaped already				
}

function business_thumbnail_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<div class="author-name"> 
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</div>';
	echo $author_meta;	//escaped already
}

function business_thumbnail_wp_date_meta(){
	$wp_date_format='<div class="post-date">';
	$wp_date_format.=esc_attr(get_the_date()).'</div>';
	echo $wp_date_format; //escaped already		
}

function business_thumbnail_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<div class="post-date">'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
	echo $theme_date_format; //escaped already		
}
function business_thumbnail_get_post_like_count($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '<div class="b-thumb-post-like">';
    $output .= ' <span class="count mr-0"> '.esc_attr($vote_count).'</span>';
	if($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' No Likes','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); 
	$output .='</div>';
     
    echo $output;//escaped already
}
function business_thumbnail_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='<div class="b-thumb-post-views">';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='<div class="b-thumb-post-views">';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</div>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</div>';
	return $output;
}
/*****************************************
Fitness Blog  Meta functions
******************************************/
function fitness_blog_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='<span class=""> ';
				$comments_meta.='<a href="'.get_comments_link().'">';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_html__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
			} else {
				$comments_meta.= esc_html__('1 Comment','ronby');
			}
				$comments_meta.='</a>';
				$comments_meta.='</span>';
		}
	echo $comments_meta;//escaped already
}

function fitness_blog_get_post_like_count($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '';
    $output .= '<span class="count mr-2"> '.esc_attr($vote_count).'</span>';
	if($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' No Likes','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); 
	$output .='';
     
    echo $output;//escaped already
}

function fitness_social_share_meta(){
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;	
?>
										<div class="social-6 text-lg-right">
											<ul>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($facebookURL);?>" class="no-color"><i class="fab fa-facebook"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($twitterURL);?>" class="no-color"><i class="fab fa-twitter"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($linkedInURL);?>" class="no-color"><i class="fab fa-linkedin-in"></i></a>
												</li>
												<li class="hover-background-primary">
													<a href="<?php echo esc_url($pinterestURL);?>" class="no-color"><i class="fab fa-pinterest-p"></i></a>
												</li>
											</ul>
										</div>
<?php	
}

function fitness_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<span class="post-author mr-10">
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</span>';
	echo $author_meta;	//escaped already
}

function fitness_author_avatar_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;	
	$author_id=$ronby_global_post->post_author;
	$link= get_avatar_url($author_id );
	$author_avatar='<div class="author-avatar"">	
							<img src="'.esc_url($link).'" alt="'.esc_attr__('author-profile-picture','ronby').'">
					</div>';
	echo $author_avatar;//escaped already				
}

function fitness_user_quote(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;	
	$author_id=$ronby_global_post->post_author;
	$link= get_avatar_url($author_id );	
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');	
	if($author_first_name){ 
	$author_name= esc_attr($author_first_name);}else{
	$author_name= esc_attr($author_display_name);}	
$quote_content= get_post_meta( $postid, 'ronby_post_quote_content', true ); 
$fb_url = get_post_meta( $postid, 'ronby_post_quote_fb_url', true );
$twitter_url = get_post_meta( $postid, 'ronby_post_quote_twitter_url', true );
$linkedin_url = get_post_meta( $postid, 'ronby_post_quote_linkedin_url', true );
$bg_img_url = get_post_meta( $postid, 'ronby_post_quote_background_img_url', true );
if($quote_content){	
	?>
							<div class="user-quote-2 mb-90" <?php if($bg_img_url){?>style="background-image:url(<?php echo esc_url($bg_img_url);?>);" <?php } ?>>
								<div class="overlay">
									<div class="author-avatar">
									<img src="<?php echo esc_url($link); ?>" alt="<?php echo esc_attr__('author-profile-picture','ronby');?>">
									</div>
									<div class="author-name"><?php echo esc_attr($author_name);?></div>
									<div class="quote-content">
									<?php echo esc_attr($quote_content);?>
									</div>
									<div class="quote-social">
										<ul>
											<li class="hover-background-primary">
												<a href="<?php echo esc_url($fb_url); ?>"><i class="fab fa-facebook"></i></a>
											</li>
											<li class="hover-background-primary">
												<a href="<?php echo esc_url($twitter_url); ?>"><i class="fab fa-twitter"></i></a>
											</li>
											<li class="hover-background-primary">
												<a href="<?php echo esc_url($linkedin_url); ?>"><i class="fab fa-linkedin-in"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
<?php } }



/*****************************************
Post Views Meta functions
******************************************/
function get_post_views($postid){
    $count_key = 'post_views_count';
    $count = get_post_meta($postid, $count_key, true);
    if($count==''){
        delete_post_meta($postid, $count_key);
        add_post_meta($postid, $count_key, '0');
        return ''.esc_attr__('0 View', 'ronby').'';
    }
    return $count . ' '.esc_attr__('Views', 'ronby').'';
}

function set_post_views($postid) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postid, $count_key, true);
    if($count!=''){
        $count++;
        update_post_meta($postid, $count_key, $count);
    }
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*****************************************
Food Blog Meta functions
******************************************/
function food_blog_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<li><i class="fas fa-user"></i> 
	'.esc_attr__('By','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</li>';
	echo $author_meta;	//escaped already
}
function food_blog_wp_date_meta(){
	$wp_date_format='<li><i class="fas fa-calendar"></i> ';
	$wp_date_format.=esc_attr(get_the_date()).'</li>';
	echo $wp_date_format;//escaped already		
}

function food_blog_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<li><i class="fas fa-calendar"></i> '. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</li>';	
	echo $theme_date_format;//escaped already	
}
function food_blog_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='<li><i class="fas fa-comments"></i> ';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_html__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
			} else {
				$comments_meta.= esc_html__('1 Comment','ronby');
			}
				$comments_meta.='</li>';
		}
	echo $comments_meta;//escaped already
}
function food_blog_get_post_like_count($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '';
    $output .= '<li class="count mr-2"><i class="fas fa-thumbs-up"></i> '.esc_attr($vote_count).'</li>';
	if($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' No Likes','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); 
	$output .='';
     
    echo $output;//escaped already
}

function food_blog_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='<li class="b-thumb-post-views"><i class="fas fa-book-reader"></i> ';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='<li class="b-thumb-post-views"><i class="fas fa-book-reader"></i> ';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</li>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</li>';
	return $output;
}
function food_social_share_meta(){
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;	
?>
										<div class="social-12">
											<ul class="no-style items-inline-block">
												<li class="animate-400 hover-background-primary">
													<a class="no-color" href="<?php echo esc_url($facebookURL);?>">
														<i class="fab fa-facebook"></i>
													</a>
												</li>
												<li class="animate-400 hover-background-primary">
													<a class="no-color" href="<?php echo esc_url($twitterURL);?>">
														<i class="fab fa-twitter"></i>
													</a>
												</li>
												<li class="animate-400 hover-background-primary">
													<a href="<?php echo esc_url($pinterestURL);?>" class="no-color"><i class="fab fa-pinterest-p"></i></a>
												</li>
												<li class="animate-400 hover-background-primary">
													<a href="<?php echo esc_url($linkedInURL);?>" class="no-color"><i class="fab fa-linkedin-in"></i></a>
												</li>
											</ul>
										</div>										
<?php	
}

function food_tag(){?>
<div class="food-post-tags">
<?php
echo get_the_tag_list('<span class="color-primary">Tags:</span> ',', ',''); ?>
</div>
<?php }

function food_get_post_like_link($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '<li class="post-like">';
    if(hasAlreadyVoted($postid)){
	$output .= ' <i class="fas fa-thumbs-up"></i><span title="'.esc_attr__('I like this article', "ronby").'" class="alreadyvoted mr-0"> </span>';}
    else{
    $output .= '<a href="#" data-post_id="'.$postid.'" class="post-like-btn">
                    <span  title="'.esc_attr__('I like this article', 'ronby').'" class="mr-0" ><i class="fas fa-thumbs-up"></i> Like</span>
	</a>';}
    $output .= '<span class="count mr-0"> '.esc_attr($vote_count).'';if($vote_count==1)$output .= esc_attr__(' Like','ronby');elseif($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' 0 ','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); $output .='</span>';
	$output .='</li>';
     
    return $output;
}

/*****************************************
Shop Blog Meta functions
******************************************/
function shop_blog_wp_date_meta(){
	$wp_date_format='';
	$wp_date_format.=esc_attr(get_the_date()).'';
	echo $wp_date_format;//escaped already		
}

function shop_blog_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format=''. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'';	
	echo $theme_date_format;//escaped already		
}
function shop_blog_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta=''.esc_attr__('By','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='';
	echo $author_meta;//escaped already	
}
function shop_blog_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_html__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
			} else {
				$comments_meta.= esc_html__('1 Comment','ronby');
			}
				$comments_meta.='';
		}
	echo $comments_meta;//escaped already
}

function shop_blog_get_post_like_count($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '';
    $output .= ''.esc_attr($vote_count).'';
	if($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' No Likes','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); 
	$output .='';
     
    echo $output;//escaped already
}
function shop_blog_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='';
		echo $output;//escaped already
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='';
	echo $output;//escaped already
}

/**************************
Medical Meta Functions
****************************/
function medical_wp_date_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );	
	$wp_date_format='<span ';
	if($get_image){
		$wp_date_format.='class="post-date background-primary color-inverse"';}else{
		$wp_date_format.='class="post-date-2 mr-20"';}
		$wp_date_format.='>';
		if(empty($get_image)){
		$wp_date_format.='<i class="far fa-calendar-alt"></i> ';}
		$wp_date_format.=esc_attr(get_the_date()).'</span>';
	echo $wp_date_format;	//escaped already			
}

function medical_theme_date_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 	
	$theme_date_format='<span ';
	if($get_image){
		$theme_date_format.='class="post-date background-primary color-inverse"';}else{
		$theme_date_format.='class="post-date-2 mr-20"';}
		$theme_date_format.='>';
		if(empty($get_image)){
		$theme_date_format.='<i class="far fa-calendar-alt"></i> ';}$theme_date_format.=esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
		echo $theme_date_format;//escaped already
}
function medical_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<span class="post-author mr-20"> 
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</span>';
	echo $author_meta;	//escaped already
}
function medical_comments_meta($postid){
	$comments_meta='';
	if ( comments_open($postid) ) {
		$comments_meta.='<span class="color-secondary post-comments-count mr-20 ml-0"><i class="fas fa-comments"></i> ';
		$comments_meta.='<a href="'.get_comments_link().'">';
		if ( get_comments_number($postid) == 0 ) {
		$comments_meta.= esc_html__('No Comments','ronby');
		} elseif ( get_comments_number($postid) > 1 ) {
		$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
		} else {
		$comments_meta.= esc_html__('1 Comment','ronby');
		}
		$comments_meta.='</a>';
		$comments_meta.='</span>';
		}
	echo $comments_meta;//escaped already			
}

function medical_post_share_meta(){
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;?>
		<div class="post-sharing <?php if(!(ronby_get_option('blog_post_tags_meta_switch') == 1) || !(has_tag())){echo"bl-0-pl-0";} ?>">
			<a href="<?php echo esc_url($facebookURL);?>">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="<?php echo esc_url($twitterURL);?>">
				<i class="fab fa-twitter"></i>
			</a>
			<a href="<?php echo esc_url($pinterestURL);?>">
				<i class="fab fa-pinterest-p"></i>
			</a>
			<a href="<?php echo esc_url($linkedInURL);?>">
				<i class="fab fa-linkedin"></i>
			</a>
		</div>	
<?php	
}

function medical_get_post_like_link($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = '<span class="post-like b-grid-post-views">';
    if(hasAlreadyVoted($postid)){
	$output .= ' <i class="fas fa-thumbs-up"></i><span title="'.esc_attr__('I like this article', "ronby").'" class="alreadyvoted mr-0"> </span>';}
    else{
    $output .= '<a href="#" data-post_id="'.$postid.'" class="post-like-btn">
                    <span  title="'.esc_attr__('I like this article', 'ronby').'" class="mr-0" ><i class="fas fa-thumbs-up "></i> Like</span>
	</a>';}
    $output .= '<span class=" count mr-0"> '.esc_attr($vote_count).'';if($vote_count==1)$output .= esc_attr__(' Like','ronby');elseif($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' 0 ','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); $output .='</span>';
	$output .='</span>';
     
    return $output;
}

function medical_grid_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output='<span class="b-grid-post-views mr-20"><i class="fas fa-book-reader"></i> ';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output='<span class="b-grid-post-views"><i class="fas fa-book-reader"></i> ';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</span>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</span>';
	return $output;
}

/*********************
Shop Post layout meta's
***********************/
function shop_post_share_meta(){
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;?>

	<div class="blog-detail-social">
		<div class="social-10">
			<ul class="no-style items-inline-block">
				<li>
					<a class="no-color" href="<?php echo esc_url($facebookURL);?>">
						<i class="fab fa-facebook"></i>
					</a>
				</li>
				<li>
					<a class="no-color" href="<?php echo esc_url($twitterURL);?>">
						<i class="fab fa-twitter"></i>
					</a>
				</li>
				<li>
					<a class="no-color" href="<?php echo esc_url($pinterestURL);?>">
						<i class="fab fa-pinterest-p"></i>
					</a>
				</li>
				<li>
					<a class="no-color" href="<?php echo esc_url($linkedInURL);?>">
						<i class="fab fa-linkedin"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>		
<?php	
}

function shop_post_share_meta_2(){
	$post = ronby_get_global_post();
	$postid = $post->ID;	
	// Get current post URL 
	$ronbyURL = urlencode(get_permalink());

	// Get current post title
	$ronbyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $ronbyTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$ronbyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	
	$twitter_username=ronby_get_option('social_twitter_username');
	
	// sharing URL 
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$ronbyTitle.'&amp;url='.$ronbyURL.'&amp;via='.$twitter_username;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ronbyURL;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$ronbyURL.'&amp;title='.$ronbyTitle;
	$pinterestURL = 'https://www.pinterest.com/pin/create/button/?url='.$ronbyURL.'&amp;media='.$ronbyThumbnail[0].'&amp;description='.$ronbyTitle;?>

		<div class="social-10 display-inline-block">
		
			<ul class="no-style items-inline-block"><i class="fas fa-share-alt display-inline-block  color-primary pl-15"></i>
				<li>
					<a class="no-color" href="<?php echo esc_url($facebookURL);?>">
						<i class="fab fa-facebook"></i>
					</a>
				</li>
				<li>
					<a class="no-color" href="<?php echo esc_url($twitterURL);?>">
						<i class="fab fa-twitter"></i>
					</a>
				</li>
				<li>
					<a class="no-color" href="<?php echo esc_url($pinterestURL);?>">
						<i class="fab fa-pinterest-p"></i>
					</a>
				</li>
				<li>
					<a class="no-color" href="<?php echo esc_url($linkedInURL);?>">
						<i class="fab fa-linkedin"></i>
					</a>
				</li>
			</ul>
		</div>		
<?php	
}

function shop_wp_date_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );	
	$wp_date_format='<span ';
	if($get_image){
		$wp_date_format.='';}else{
		$wp_date_format.='';}
		$wp_date_format.='>';
		if(empty($get_image)){
		$wp_date_format.='';}
		$wp_date_format.=esc_attr(get_the_date()).'</span>';
	echo $wp_date_format;//escaped already				
}

function shop_theme_date_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$get_image = wp_get_attachment_url( get_post_thumbnail_id($postid) );
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 	
	$theme_date_format='<span ';
	if($get_image){
		$theme_date_format.='';}else{
		$theme_date_format.='';}
		$theme_date_format.='>';
		if(empty($get_image)){
		$theme_date_format.=' ';}$theme_date_format.= esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
		echo $theme_date_format;//escaped already
}

function shop_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta=' - <span> 
	'.esc_attr__('By','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</span>';
	echo $author_meta;//escaped already	
}

function shop_comments_meta($postid){
	$comments_meta='';
	if ( comments_open($postid) ) {
		$comments_meta.=' - <span>';
		$comments_meta.='<a href="'.get_comments_link().'">';
		if ( get_comments_number($postid) == 0 ) {
		$comments_meta.= esc_html__('No Comments','ronby');
		} elseif ( get_comments_number($postid) > 1 ) {
		$comments_meta.= get_comments_number($postid) . esc_html__(' Comments','ronby');
		} else {
		$comments_meta.= esc_html__('1 Comment','ronby');
		}
		$comments_meta.='</a>';
		$comments_meta.='</span>';
		}
	echo $comments_meta;//escaped already			
}

function shop_tag(){?>
<div class="post-tags display-inline-block">
<?php
echo get_the_tag_list('<i class="fas fa-tags color-primary"></i> ',', ',''); ?>
</div>
<?php }

function shop_get_post_like_link($postid)
{
    $vote_count = get_post_meta($postid, "votes_count", true);
    $output = ' - <span class="post-like">';
    if(hasAlreadyVoted($postid)){
	$output .= ' <span title="'.esc_attr__('I like this article', "ronby").'" class="alreadyvoted mr-0"> </span>';}
    else{
    $output .= '<a href="#" data-post_id="'.$postid.'" class="post-like-btn">
                    <span  title="'.esc_attr__('I like this article', 'ronby').'" class="mr-0" > Like</span>
	</a>';}
    $output .= '<span class=" count mr-0"> '.esc_attr($vote_count).'';if($vote_count==1)$output .= esc_attr__(' Like','ronby');elseif($vote_count>1)$output .= esc_attr__(' Likes','ronby');elseif($vote_count<1) $output .= esc_attr__(' 0 ','ronby');elseif($vote_count=1) $output .= esc_attr__(' Like','ronby'); $output .='</span>';
	$output .='</span>';
     
    return $output;
}

function shop_get_post_views($post_id){
    $count_key = 'post_views_count';
	$output=' - <span class=""> ';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
		$output=' - <span class=""> ';
        $output.= ''.esc_attr__('0 View', 'ronby').'';
		$output.='</span>';
		return $output;
    }
	
    $output.= $count . ' '.esc_attr__('Views', 'ronby').'';
	$output.='</span>';
	return $output;
}