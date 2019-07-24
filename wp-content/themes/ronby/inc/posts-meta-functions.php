<?php
function business_list_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='<span><i class="fas fa-folder"></i> '; 
		$i = 0;
		$c = count($category_names);
			 foreach($category_names as $c_name){
				$category_meta.='<a class="no-a-style" href="' . esc_url( get_category_link( $c_name->term_id ) ) . '">';
				$category_meta.= esc_attr($c_name->cat_name);
				$category_meta.='</a>';
				 if ($i++ < $c - 1) {
					$category_meta.=  ' / ';
					}
				}
	$category_meta.='</span>';
	return $category_meta; //escaped already
	}
}

function construction_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='<div class="post-taxonomies">'; 
		$i = 0;
		$c = count($category_names);
			 foreach($category_names as $c_name){
				$link=get_category_link($c_name->term_id); 
				$category_meta.='<a href="'.esc_url($link).'">'. esc_attr($c_name->cat_name).'</a>';
				 if ($i++ < $c - 1) {
					$category_meta.=  ' , ';
					}
				}
	$category_meta.='</div>';
	return $category_meta; //escaped already
	}
}

function shop_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category_names = get_the_category($postid);
	if($category_names){
	$category_meta=' - <span>';
		$i = 0;
		$c = count($category_names);
			 foreach($category_names as $c_name){
				$category_meta.='<a class="no-a-style" href="' . esc_url( get_category_link( $c_name->term_id ) ) . '">';
				$category_meta.= esc_attr($c_name->cat_name);
				$category_meta.='</a>';
				 if ($i++ < $c - 1) {
					$category_meta.=  ' / ';
					}
				}
	$category_meta.='</span>';
	return $category_meta;//escaped already
	}
}

function medical_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category_names = get_the_category($postid);
	if($category_names){
	$category_meta='<span class="post-category mr-20"><i class="fas fa-folder"></i> ';
		$i = 0;
		$c = count($category_names);
			 foreach($category_names as $c_name){
				$category_meta.='<a class="no-a-style" href="' . esc_url( get_category_link( $c_name->term_id ) ) . '">';
				$category_meta.= esc_attr($c_name->cat_name);
				$category_meta.='</a>';
				 if ($i++ < $c - 1) {
					$category_meta.=  ' / ';
					}
				}
	$category_meta.='</span>';
	return $category_meta;//escaped already
	}
}

function shop_blog_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category = get_the_category();	
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='';
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
	$category_meta.='';
	return $category_meta;//escaped already
	}
}

function food_blog_post_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category = get_the_category();	
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='<span class="color-primary">'.esc_html__('Category:','ronby').'</span> ';
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
	$category_meta.='';
	return $category_meta;//escaped already
	}
}

function food_blog_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category = get_the_category();	
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='<li><i class="fas fa-folder"></i> ';
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
	$category_meta.='</li>';
	return $category_meta;//escaped already
	}
}

function fitness_blog_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category = get_the_category();	
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='';
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
	$category_meta.='';
	return $category_meta;//escaped already
	}
}

function fitness_blog_wp_date_meta(){
	$wp_date_format='<span class="post-date">';
	$wp_date_format.=esc_attr(get_the_date()).'</span>';
	return $wp_date_format;//escaped already		
}

function fitness_blog_theme_date_meta(){
	$archive_month = get_the_time('M'); 
	$archive_day   = get_the_time('d'); 
	$archive_year   = get_the_time('Y'); 
	$theme_date_format='<span class="post-date">'. esc_attr($archive_month).' '. esc_attr($archive_day).', '. esc_attr($archive_year).'</span>';	
	return $theme_date_format;//escaped already		
}

function business_thumbnail_category_meta(){
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

function business_grid_category_meta(){
	$ronby_global_post = ronby_get_global_post();
	$postid = $ronby_global_post->ID;
	$category_names = get_the_category($postid);
	if ($category_names) {
	$category_meta='<span class="post-category mr-15"><i class="fas fa-folder"></i> ';
		$i = 0;
		$c = count($category_names);
			 foreach($category_names as $c_name){
				$category_meta.='<a class="no-a-style" href="' . esc_url( get_category_link( $c_name->term_id ) ) . '">';
				$category_meta.= esc_attr($c_name->cat_name);
				$category_meta.='</a>';
				 if ($i++ < $c - 1) {
					$category_meta.=  ' / ';
					}
				}
	$category_meta.='</span>';
	return $category_meta;//escaped already
	}
}

function fitness_tag(){ ?>
		<div class="post-tags text-md-right">
			<i class="fas fa-tags color-primary"></i>
			<?php echo the_tags(); ?>
		</div>
<?php }
function medical_tag(){ ?>
	<div class="post-tags">
	<?php echo get_the_tag_list('',', ',''); ?>
	</div>
<?php }