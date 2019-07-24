<?php 
/*************************
Elements Function
****************************/
//FITNESS WP FORMAT DATE META
function fitness_blog_section_wp_date_meta(){
	$wp_date_format='<span class="post-date">';
	$wp_date_format.=esc_attr(get_the_date()).'</span>';
	return $wp_date_format;//escaped already		
}

//FITNESS THEME DATE FORMAT META
function fitness_blog_section_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<span class="post-date">'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';
	return $theme_date_format;//escaped already		
}

//FITNESS COMMENTS
function fitness_blog_section_comments_meta($postid){
	$comments_meta='<span class="ml-2 mr-2">|</span>';
		if ( comments_open($postid) ) {
				$comments_meta.='<span class=""> ';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_attr__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_attr__(' Comments','ronby');
			} else {
				$comments_meta.= esc_attr__('1 Comment','ronby');
			}
				$comments_meta.='</span>';
		}
	return $comments_meta;//escaped already
}

function ronby_element_breadcrumb_function($page_header_style)
{
	if (!(is_front_page())) {
		$ronby_global_post = ronby_get_global_post();
		if (!(is_404()) && !(is_search()) && (class_exists('woocommerce')) && !(is_shop())) {
			$postid = $ronby_global_post->ID;
			$postcat = get_the_category($postid);
		}
		else {
			$postcat = get_the_category(get_the_id());
		}
		$output = '';
		if (ronby_get_option('ronby_page_header_layout') == 3) {
			$output.= '
		<a>' . esc_attr(single_cat_title()) . '</a>	
	';
		}
		$output.= '

<div class="page-header-breadcrumb ';
		if ($page_header_style == 1) {
			$output.= 'background-primary';
		}
		$output.= '">

<a href="' . esc_url(get_home_url()) . '">' . esc_attr__('Home', 'ronby') . '</a>
        
';
		if (is_category()) {
			$output.= '	
	
- <span>' . esc_attr(single_cat_title()) . '</span>

';
		}
		elseif (is_page()) {
			$output.= '		

- <span>' . esc_attr(get_the_title()) . '</span>

';
		}
		elseif (is_home()) {
			$output.= '	
	
- <span>' . esc_attr(get_the_title()) . '</span>

';
		}
		elseif (is_search()) {
			$output.= '	

- <span' . esc_html__('Search Results for...', 'ronby') . '' . esc_attr(the_search_query()) . '</span>
		
';
		}
		elseif (is_single() && (!class_exists('woocommerce') || !(is_product()))) {
			$output.= '	

<a href="' . get_permalink(get_option('page_for_posts')) . '">' . esc_html__('- Blog - ', 'ronby') . '</a>
';
			if ($postcat) {
				$output.= '
<span>' . esc_attr($postcat[0]->name) . '</span>	
';
			}
			else {
				$output.= '
<span>' . esc_attr(the_title()) . '</span>	
';
			}
			$output.= '
';
		}
		elseif (is_archive() && !(is_author()) && class_exists('woocommerce') && !(is_shop())) {
			$output.= '

- <span>' . esc_attr(get_the_archive_title()) . '</span>

';
		}
		elseif (is_author()) {
			$output.= '

- <span>' . esc_attr(get_the_author_meta('display_name')) . '</span>

';
		}
		elseif (is_404() || is_page_template('404.php')) {
			$output.= '

- <span' . esc_attr__('404', 'ronby') . '</span>

';
		}
		elseif (class_exists('woocommerce') && is_product()) {
			$output.= '
- <span>' . esc_attr__('Product', 'ronby') . '</span>

';
		}
		elseif (class_exists('woocommerce') && is_shop()) {
			$output.= '
- <span>' . esc_attr__('Shop', 'ronby') . '</span>
';
		}
		$output.= '

</div>
';
	}
	return $output;
}

//PRODUCT CATEGORY AVARAGE STAR RATING
function restaurant_get_average_product_rating($cat_id){
	$args = array( 
    'post_type' => 'product', 
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'terms'    => $cat_id,
        ),
    ),
);
  $total_avg = 0;
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post(); 
  global $product; 
  $average = $product->get_average_rating();
  $total_avg += $average;
  endwhile;
  wp_reset_query();
  return $total_avg;

}

//PRODUCT CATEGORY AVARAGE STAR RATING
function restaurant_return_rating_star($totalresult){
	$i=0;						
	$out='<div class="stars-rating d-inline-block mt-05" data-rate="5">';
	while($i < $totalresult){
	$out.='<span class="fas fa-star"></span>';
	$i++;	
	}
	$out.='</div>';
if($totalresult > 0){	
	return $out;	
}
}

//FOOD BLOG WP DATE META
function element_food_blog_wp_date_meta(){
	$wp_date_format='<li><i class="fas fa-calendar"></i> ';
	$wp_date_format.=esc_attr(get_the_date()).'</li>';
	return $wp_date_format;//escaped already		
}

//FOOD BLOG THEME DATE META
function element_food_blog_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<li><i class="fas fa-calendar"></i> '. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</li>';	
	return $theme_date_format;//escaped already	
}
//FOOD BLOG AUTHOR META
function element_food_blog_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<li><i class="fas fa-user"></i> 
	'.esc_attr__('By','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</li>';
	return $author_meta;	//escaped already
}

//BUSINESS WP FORMAT DATE META
function e_business_blog_section_wp_date_meta(){
	$wp_date_format='<span class="post-date background-secondary color-inverse">';
	$wp_date_format.=esc_attr(get_the_date()).'</span>';
	return $wp_date_format;//escaped already		
}

//BUSINESS THEME DATE FORMAT META
function e_business_blog_section_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<span class="post-date background-secondary color-inverse">'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';
	return $theme_date_format;//escaped already		
}

//BUSINESS BLOG AUTHOR META
function e_business_blog_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<span class="post-author"> 
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</span>';
	return $author_meta;	//escaped already
}

//BUSINESS COMMENTS
function e_business_blog_section_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='<span class="post-comment-count color-secondary"><i class="fas fa-comments"></i> ';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_attr__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_attr__(' Comments','ronby');
			} else {
				$comments_meta.= esc_attr__('1 Comment','ronby');
			}
				$comments_meta.='</span>';
		}
	return $comments_meta;//escaped already
}

//CONSTRUCTION CETEGORY
function e_business_thumbnail_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category = get_the_category();	
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='<div class="post-taxonomies"><i class="fas fa-folder"></i> ';
		$i = 0;
		$c = count($category_names);
			 foreach($category_names as $c_name){
				$link = get_category_link( $c_name->term_id ); 
				$category_meta.='<a href="'.esc_url($link).'">'. esc_attr($c_name->cat_name);
				$category_meta.='</a>';
				 if ($i++ < $c - 1) {
					$category_meta.=  ' / ';
					}
				}
	$category_meta.='</div>';
	return $category_meta;//escaped already
	}
}
//CONSTRUCTION AVATAR
function e_business_thumbnail_author_avatar_meta(){
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
	return $author_avatar;//escaped already				
}
//CONSTRUCTION AUTHOR
function e_business_thumbnail_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<div class="author-name"> 
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</div>';
	return $author_meta;	//escaped already
}
//CONSTRUCTION WP DATE
function e_business_thumbnail_wp_date_meta(){
	$wp_date_format='<div class="post-date">';
	$wp_date_format.=esc_attr(get_the_date()).'</div>';
	return $wp_date_format; //escaped already		
}
//CONSTRUCTION THEME DATE
function e_business_thumbnail_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<div class="post-date">'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
	return $theme_date_format; //escaped already		
}
//CONSTRUCTION SOCIAL SHARE META
function e_construction_social_share_meta(){
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
	$res='
	<div class="social-share-sec">
		<div class="social-3 d-flex justify-content-center align-items-center">
			<ul class="list-unstyled mb-0">
				<li>
					<a href="'.esc_url($facebookURL).'" class="no-color animated">
						<i class="fab fa-facebook-f"></i> <span class="d-none d-md-inline">'.esc_html__('Facebook','ronby').'</span>
					</a>
				</li>
				<li>
					<a href="'.esc_url($pinterestURL).'" class="no-color animated">
						<i class="fab fa-pinterest-p"></i> <span class="d-none d-md-inline">'.esc_html__('Pinterest','ronby').'</span>
					</a>
				</li>
				<li>
					<a href="'.esc_url($twitterURL).'" class="no-color animated">
						<i class="fab fa-twitter"></i> <span class="d-none d-md-inline">'.esc_html__('Twitter','ronby').'</span>
					</a>
				</li>
				<li>
					<a href="'.esc_url($linkedInURL).'" class="no-color animated">
						<i class="fab fa-linkedin-in"></i> <span class="d-none d-md-inline">'.esc_html__('Linkedin','ronby').'</span>
					</a>
				</li>
			</ul>									
		</div>
	</div>';
	return $res;	
}

/*****************************************
Shop Blog Meta functions
******************************************/
function e_shop_blog_wp_date_meta(){
	$wp_date_format='';
	$wp_date_format.=esc_attr(get_the_date()).'';
	return $wp_date_format;//escaped already		
}

function e_shop_blog_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format=''. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'';	
	return $theme_date_format;//escaped already		
}
function e_shop_blog_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta=''.esc_attr__('By','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='';
	return $author_meta;//escaped already	
}

//MEDICAL WP FORMAT DATE META
function e_medical_blog_section_wp_date_meta(){
	$wp_date_format='<span class="post-date background-primary">';
	$wp_date_format.=esc_attr(get_the_date()).'</span>';
	return $wp_date_format;//escaped already		
}

//MEDICAL THEME DATE FORMAT META
function e_medical_blog_section_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<span class="post-date background-primary">'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';
	return $theme_date_format;//escaped already		
}

//MEDICAL BLOG AUTHOR META
function e_medical_blog_author_meta(){
	$author_first_name = get_the_author_meta('first_name');	
	$author_display_name = get_the_author_meta('display_name');
	$author_meta='<span class="post-author"> 
	'.esc_attr__('Posted by','ronby').' '; 
	if($author_first_name){ 
	$author_meta.= esc_attr($author_first_name);}else{
	$author_meta.= esc_attr($author_display_name);}
	$author_meta.='</span>';
	return $author_meta;	//escaped already
}

//MEDICAL COMMENTS
function e_medical_blog_section_comments_meta($postid){
	$comments_meta='';
		if ( comments_open($postid) ) {
				$comments_meta.='<span class="post-comment-count color-secondary"><i class="fas fa-comments"></i> ';
			if ( get_comments_number($postid) == 0 ) {
				$comments_meta.= esc_attr__('No Comments','ronby');
			} elseif ( get_comments_number($postid) > 1 ) {
				$comments_meta.= get_comments_number($postid) . esc_attr__(' Comments','ronby');
			} else {
				$comments_meta.= esc_attr__('1 Comment','ronby');
			}
				$comments_meta.='</span>';
		}
	return $comments_meta;//escaped already
}

//BUSINESS PROJECT SOCIAL SHARE META
function e_business_projects_social_share_meta(){
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
	$res='<div class="social-2">			
							<b class="mr-4">
								'.esc_html__('Share this article:','ronby').'
							</b>
							<span class="sharing-icons">
								<a href="'.esc_url($facebookURL).'" class="no-color animate-300 hover-color-secondary"><i class="fab fa-facebook"></i></a>
								<a href="'.esc_url($twitterURL).'" class="no-color animate-300 hover-color-secondary"><i class="fab fa-twitter"></i></a>
								<a href="'.esc_url($pinterestURL).'" class="no-color animate-300 hover-color-secondary"><i class="fab fa-pinterest-p"></i></a>
								<a href="'.esc_url($linkedInURL).'" class="no-color animate-300 hover-color-secondary"><i class="fab fa-linkedin-in"></i></a>
							</span>	
						</div>	';
	return $res;	
}