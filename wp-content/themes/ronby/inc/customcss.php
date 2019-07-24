<?php
function ronby_styles_custom() {
	global $redux;
	global $is_gecko;

//Logo Start

	if(ronby_get_option('logo_width') !=''){

		$logo_width = ronby_get_option('logo_width');

	}else{
		$logo_width = '';
	}
	if(ronby_get_option('logo_height') !=''){

		$logo_height = ronby_get_option('logo_height');

	}else{
		$logo_height = 'auto';
	}
	//End Logo
	
	//Menu settings start
	if(ronby_get_option('ronby_header_top_menu_bg_color') !=''){

		$ronby_header_top_menu_bg_color = ronby_get_option('ronby_header_top_menu_bg_color')['rgba'];

	}else{
		$ronby_header_top_menu_bg_color = '';
	}
	if(ronby_get_option('ronby_header_top_menu_icon_color') !=''){

		$ronby_header_top_menu_icon_color = ronby_get_option('ronby_header_top_menu_icon_color')['rgba'];

	}else{
		$ronby_header_top_menu_icon_color = '';
	}	
	if(ronby_get_option('ronby_header_top_menu_text_color') !=''){

		$ronby_header_top_menu_text_color = ronby_get_option('ronby_header_top_menu_text_color')['rgba'];

	}else{
		$ronby_header_top_menu_text_color = '';
	}	
	if(ronby_get_option('ronby_header_top_menu_social_bg_color') !=''){

		$ronby_header_top_menu_social_bg_color = ronby_get_option('ronby_header_top_menu_social_bg_color')['rgba'];

	}else{
		$ronby_header_top_menu_social_bg_color = '';
	}	
	if(ronby_get_option('ronby_header_top_menu_social_icon_color') !=''){

		$ronby_header_top_menu_social_icon_color = ronby_get_option('ronby_header_top_menu_social_icon_color')['rgba'];

	}else{
		$ronby_header_top_menu_social_icon_color = '';
	}
	if(ronby_get_option('ronby_header_top_menu_social_icon_hover_bg_color') !=''){

		$ronby_header_top_menu_social_icon_hover_bg_color = ronby_get_option('ronby_header_top_menu_social_icon_hover_bg_color')['rgba'];

	}else{
		$ronby_header_top_menu_social_icon_hover_bg_color = '';
	}
	if(ronby_get_option('ronby_header_top_menu_social_icon_hover_color') !=''){

		$ronby_header_top_menu_social_icon_hover_color = ronby_get_option('ronby_header_top_menu_social_icon_hover_color')['rgba'];

	}else{
		$ronby_header_top_menu_social_icon_hover_color = '';
	}	
	if(ronby_get_option('ronby_header_top_menu_btn_text_color') !=''){

		$ronby_header_top_menu_btn_text_color = ronby_get_option('ronby_header_top_menu_btn_text_color')['rgba'];

	}else{
		$ronby_header_top_menu_btn_text_color = '';
	}
	if(ronby_get_option('ronby_header_top_menu_btn_bg_color') !=''){

		$ronby_header_top_menu_btn_bg_color = ronby_get_option('ronby_header_top_menu_btn_bg_color')['rgba'];

	}else{
		$ronby_header_top_menu_btn_bg_color = '';
	}

	if(ronby_get_option('ronby_header_top_menu_btn_hover_text_color') !=''){

		$ronby_header_top_menu_btn_hover_text_color = ronby_get_option('ronby_header_top_menu_btn_hover_text_color')['rgba'];

	}else{
		$ronby_header_top_menu_btn_hover_text_color = '';
	}
	if(ronby_get_option('ronby_header_top_menu_btn_hover_bg_color') !=''){

		$ronby_header_top_menu_btn_hover_bg_color = ronby_get_option('ronby_header_top_menu_btn_hover_bg_color')['rgba'];

	}else{
		$ronby_header_top_menu_btn_hover_bg_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_bg_color') !=''){

		$ronby_header_main_menu_bg_color = ronby_get_option('ronby_header_main_menu_bg_color')['rgba'];

	}else{
		$ronby_header_main_menu_bg_color = '';
	}
	if(ronby_get_option('ronby_header_main_menu_anchor_color') !=''){

		$ronby_header_main_menu_anchor_color = ronby_get_option('ronby_header_main_menu_anchor_color')['rgba'];

	}else{
		$ronby_header_main_menu_anchor_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_anchor_hover_color') !=''){

		$ronby_header_main_menu_anchor_hover_color = ronby_get_option('ronby_header_main_menu_anchor_hover_color')['rgba'];

	}else{
		$ronby_header_main_menu_anchor_hover_color = '';
	}
	if(ronby_get_option('ronby_header_main_menu_popup_search_btn_color') !=''){

		$ronby_header_main_menu_popup_search_btn_color = ronby_get_option('ronby_header_main_menu_popup_search_btn_color')['rgba'];

	}else{
		$ronby_header_main_menu_popup_search_btn_color = '';
	}
	if(ronby_get_option('ronby_header_top_menu_two_bg_color') !=''){

		$ronby_header_top_menu_two_bg_color = ronby_get_option('ronby_header_top_menu_two_bg_color')['rgba'];

	}else{
		$ronby_header_top_menu_two_bg_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_anchor_hover_bg_color') !=''){

		$ronby_header_main_menu_anchor_hover_bg_color = ronby_get_option('ronby_header_main_menu_anchor_hover_bg_color')['rgba'];

	}else{
		$ronby_header_main_menu_anchor_hover_bg_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_search_btn_bg_color') !=''){

		$ronby_header_main_menu_search_btn_bg_color = ronby_get_option('ronby_header_main_menu_search_btn_bg_color')['rgba'];

	}else{
		$ronby_header_main_menu_search_btn_bg_color = '';
	}
	if(ronby_get_option('ronby_header_main_menu_slide_nav_bg_color') !=''){

		$ronby_header_main_menu_slide_nav_bg_color = ronby_get_option('ronby_header_main_menu_slide_nav_bg_color')['rgba'];

	}else{
		$ronby_header_main_menu_slide_nav_bg_color = '';
	}	

	if(ronby_get_option('ronby_header_main_menu_slide_navigation_bg_color') !=''){

		$ronby_header_main_menu_slide_navigation_bg_color = ronby_get_option('ronby_header_main_menu_slide_navigation_bg_color')['rgba'];

	}else{
		$ronby_header_main_menu_slide_navigation_bg_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_slide_navigation_text_color') !=''){

		$ronby_header_main_menu_slide_navigation_text_color = ronby_get_option('ronby_header_main_menu_slide_navigation_text_color')['rgba'];

	}else{
		$ronby_header_main_menu_slide_navigation_text_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_slide_navigation_icon_color') !=''){

		$ronby_header_main_menu_slide_navigation_icon_color = ronby_get_option('ronby_header_main_menu_slide_navigation_icon_color')['rgba'];

	}else{
		$ronby_header_main_menu_slide_navigation_icon_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn1_text_color') !=''){

		$ronby_slide_navigation_btn1_text_color = ronby_get_option('ronby_slide_navigation_btn1_text_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn1_text_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn1_bg_color') !=''){

		$ronby_slide_navigation_btn1_bg_color = ronby_get_option('ronby_slide_navigation_btn1_bg_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn1_bg_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn1_hovertext_color') !=''){

		$ronby_slide_navigation_btn1_hovertext_color = ronby_get_option('ronby_slide_navigation_btn1_hovertext_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn1_hovertext_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn1_hoverbg_color') !=''){

		$ronby_slide_navigation_btn1_hoverbg_color = ronby_get_option('ronby_slide_navigation_btn1_hoverbg_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn1_hoverbg_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn2_text_color') !=''){

		$ronby_slide_navigation_btn2_text_color = ronby_get_option('ronby_slide_navigation_btn2_text_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn2_text_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn2_bg_color') !=''){

		$ronby_slide_navigation_btn2_bg_color = ronby_get_option('ronby_slide_navigation_btn2_bg_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn2_bg_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn2_hovertext_color') !=''){

		$ronby_slide_navigation_btn2_hovertext_color = ronby_get_option('ronby_slide_navigation_btn2_hovertext_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn2_hovertext_color = '';
	}	
	if(ronby_get_option('ronby_slide_navigation_btn2_hoverbg_color') !=''){

		$ronby_slide_navigation_btn2_hoverbg_color = ronby_get_option('ronby_slide_navigation_btn2_hoverbg_color')['rgba'];

	}else{
		$ronby_slide_navigation_btn2_hoverbg_color = '';
	}
	if(ronby_get_option('ronby_header_sub_menu_bg_color') !=''){

		$ronby_header_sub_menu_bg_color = ronby_get_option('ronby_header_sub_menu_bg_color')['rgba'];

	}else{
		$ronby_header_sub_menu_bg_color = '';
	}	
	if(ronby_get_option('ronby_header_sub_menu_anchor_color') !=''){

		$ronby_header_sub_menu_anchor_color = ronby_get_option('ronby_header_sub_menu_anchor_color')['rgba'];

	}else{
		$ronby_header_sub_menu_anchor_color = '';
	}	
	if(ronby_get_option('ronby_header_main_menu_slide_nav_width') !=''){

		$ronby_header_main_menu_slide_nav_width = ronby_get_option('ronby_header_main_menu_slide_nav_width');

	}else{
		$ronby_header_main_menu_slide_nav_width = '';
	}	
	if(ronby_get_option('ronby_mobile_nav_bg_color') !=''){

		$ronby_mobile_nav_bg_color = ronby_get_option('ronby_mobile_nav_bg_color')['rgba'];

	}else{
		$ronby_mobile_nav_bg_color = '';
	}	
	if(ronby_get_option('ronby_mobile_nav_text_color') !=''){

		$ronby_mobile_nav_text_color = ronby_get_option('ronby_mobile_nav_text_color')['rgba'];

	}else{
		$ronby_mobile_nav_text_color = '';
	}	
	if(ronby_get_option('ronby_mobile_nav_btn_color') !=''){

		$ronby_mobile_nav_btn_color = ronby_get_option('ronby_mobile_nav_btn_color')['rgba'];

	}else{
		$ronby_mobile_nav_btn_color = '';
	}	
	//End Menu Settings
	
	// Star Color Settings
	if(ronby_get_option('ronby_woo_product_star_color') !=''){

		$ronby_woo_product_star_color = ronby_get_option('ronby_woo_product_star_color')['rgba'];

	}else{
		$ronby_woo_product_star_color = '#FBD03B';
	}
	
	// Start Footer Settings
	if(isset($redux['ronby_footer_bg_image']['url']) && !empty($redux['ronby_footer_bg_image']['url'])){

		$ronby_footer_bg_image = $redux['ronby_footer_bg_image']['url'];

	}else{
		$ronby_footer_bg_image = '';
	}
	if(ronby_get_option('ronby_footer_bg_color') !=''){

		$ronby_footer_bg_color = ronby_get_option('ronby_footer_bg_color')['rgba'];

	}else{
		$ronby_footer_bg_color = '';
	}	
	if(ronby_get_option('ronby_footer_bottom_bg_color') !=''){

		$ronby_footer_bottom_bg_color = ronby_get_option('ronby_footer_bottom_bg_color')['rgba'];

	}else{
		$ronby_footer_bottom_bg_color = '';
	}	
	if(ronby_get_option('ronby_footer_bottom_txt_color') !=''){

		$ronby_footer_bottom_txt_color = ronby_get_option('ronby_footer_bottom_txt_color')['rgba'];

	}else{
		$ronby_footer_bottom_txt_color = '';
	}
	if($redux['ronby_footer_top_padding']['padding-top'] !='' || $redux['ronby_footer_top_padding']['padding-bottom'] != ''){

		$ronby_footer_top_padding_top = $redux['ronby_footer_top_padding']['padding-top'];
		$ronby_footer_top_padding_bottom = $redux['ronby_footer_top_padding']['padding-bottom'];

	}else{
		$ronby_footer_top_padding_top = '';
		$ronby_footer_top_padding_bottom = '';
	}
	
	if(ronby_get_option('ronby_about_us_one_widget_title_color') !=''){

		$ronby_about_us_one_widget_title_color = ronby_get_option('ronby_about_us_one_widget_title_color')['rgba'];

	}else{
		$ronby_about_us_one_widget_title_color = '';
	}
	if(ronby_get_option('ronby_about_us_one_widget_icon_color') !=''){

		$ronby_about_us_one_widget_icon_color = ronby_get_option('ronby_about_us_one_widget_icon_color')['rgba'];

	}else{
		$ronby_about_us_one_widget_icon_color = '';
	}
	if(ronby_get_option('ronby_about_us_one_widget_text_color') !=''){

		$ronby_about_us_one_widget_text_color = ronby_get_option('ronby_about_us_one_widget_text_color')['rgba'];

	}else{
		$ronby_about_us_one_widget_text_color = '';
	}	
	if(ronby_get_option('ronby_about_us_one_widget_iconbg_color') !=''){

		$ronby_about_us_one_widget_iconbg_color = ronby_get_option('ronby_about_us_one_widget_iconbg_color')['rgba'];

	}else{
		$ronby_about_us_one_widget_iconbg_color = '';
	}	
	if(ronby_get_option('ronby_about_us_one_widget_iconhover_color') !=''){

		$ronby_about_us_one_widget_iconhover_color = ronby_get_option('ronby_about_us_one_widget_iconhover_color')['rgba'];

	}else{
		$ronby_about_us_one_widget_iconhover_color = '';
	}
	if(ronby_get_option('ronby_about_us_one_widget_iconhoverbg_color') !=''){

		$ronby_about_us_one_widget_iconhoverbg_color = ronby_get_option('ronby_about_us_one_widget_iconhoverbg_color')['rgba'];

	}else{
		$ronby_about_us_one_widget_iconhoverbg_color = '';
	}	
	if(ronby_get_option('ronby_subscription_one_widget_btn_bg_color') !=''){

		$ronby_subscription_one_widget_btn_bg_color = ronby_get_option('ronby_subscription_one_widget_btn_bg_color')['rgba'];

	}else{
		$ronby_subscription_one_widget_btn_bg_color = '';
	}
	if(ronby_get_option('ronby_subscription_one_widget_btn_hover_bg_color') !=''){

		$ronby_subscription_one_widget_btn_hover_bg_color = ronby_get_option('ronby_subscription_one_widget_btn_hover_bg_color')['rgba'];

	}else{
		$ronby_subscription_one_widget_btn_hover_bg_color = '';
	}
	if(ronby_get_option('ronby_subscription_one_widget_title_color') !=''){

		$ronby_subscription_one_widget_title_color = ronby_get_option('ronby_subscription_one_widget_title_color')['rgba'];

	}else{
		$ronby_subscription_one_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_footer_nav_widget_title_color') !=''){

		$ronby_footer_nav_widget_title_color = ronby_get_option('ronby_footer_nav_widget_title_color')['rgba'];

	}else{
		$ronby_footer_nav_widget_title_color = '';
	}
	if(ronby_get_option('ronby_footer_nav_widget_anchor_color') !=''){

		$ronby_footer_nav_widget_anchor_color = ronby_get_option('ronby_footer_nav_widget_anchor_color')['rgba'];

	}else{
		$ronby_footer_nav_widget_anchor_color = '';
	}
	if(ronby_get_option('ronby_footer_nav_widget_anchor_hover_color') !=''){

		$ronby_footer_nav_widget_anchor_hover_color = ronby_get_option('ronby_footer_nav_widget_anchor_hover_color')['rgba'];

	}else{
		$ronby_footer_nav_widget_anchor_hover_color = '';
	}	
	if(ronby_get_option('ronby_contact_us_one_widget_title_color') !=''){

		$ronby_contact_us_one_widget_title_color = ronby_get_option('ronby_contact_us_one_widget_title_color')['rgba'];

	}else{
		$ronby_contact_us_one_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_contact_us_one_widget_icon_color') !=''){

		$ronby_contact_us_one_widget_icon_color = ronby_get_option('ronby_contact_us_one_widget_icon_color')['rgba'];

	}else{
		$ronby_contact_us_one_widget_icon_color = '';
	}	
	if(ronby_get_option('ronby_contact_us_one_widget_text_color') !=''){

		$ronby_contact_us_one_widget_text_color = ronby_get_option('ronby_contact_us_one_widget_text_color')['rgba'];

	}else{
		$ronby_contact_us_one_widget_text_color = '';
	}	
	if(ronby_get_option('ronby_flickr_album_widget_title_color') !=''){

		$ronby_flickr_album_widget_title_color = ronby_get_option('ronby_flickr_album_widget_title_color')['rgba'];

	}else{
		$ronby_flickr_album_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_contact_us_two_widget_title_color') !=''){

		$ronby_contact_us_two_widget_title_color = ronby_get_option('ronby_contact_us_two_widget_title_color')['rgba'];

	}else{
		$ronby_contact_us_two_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_contact_us_two_widget_icon_color') !=''){

		$ronby_contact_us_two_widget_icon_color = ronby_get_option('ronby_contact_us_two_widget_icon_color')['rgba'];

	}else{
		$ronby_contact_us_two_widget_icon_color = '';
	}	
	if(ronby_get_option('ronby_contact_us_two_widget_text_color') !=''){

		$ronby_contact_us_two_widget_text_color = ronby_get_option('ronby_contact_us_two_widget_text_color')['rgba'];

	}else{
		$ronby_contact_us_two_widget_text_color = '';
	}
	if(ronby_get_option('ronby_opening_hours_widget_title_color') !=''){

		$ronby_opening_hours_widget_title_color = ronby_get_option('ronby_opening_hours_widget_title_color')['rgba'];

	}else{
		$ronby_opening_hours_widget_title_color = '';
	}
	if(ronby_get_option('ronby_opening_hours_widget_text_color') !=''){

		$ronby_opening_hours_widget_text_color = ronby_get_option('ronby_opening_hours_widget_text_color')['rgba'];

	}else{
		$ronby_opening_hours_widget_text_color = '';
	}	
	if(ronby_get_option('ronby_recent_post_list_widget_title_color') !=''){

		$ronby_recent_post_list_widget_title_color = ronby_get_option('ronby_recent_post_list_widget_title_color')['rgba'];

	}else{
		$ronby_recent_post_list_widget_title_color = '';
	}
	if(ronby_get_option('ronby_recent_post_list_widget_text_color') !=''){

		$ronby_recent_post_list_widget_text_color = ronby_get_option('ronby_recent_post_list_widget_text_color')['rgba'];

	}else{
		$ronby_recent_post_list_widget_text_color = '';
	}
	if(ronby_get_option('ronby_recent_post_list_widget_anchor_hover_color') !=''){

		$ronby_recent_post_list_widget_anchor_hover_color = ronby_get_option('ronby_recent_post_list_widget_anchor_hover_color')['rgba'];

	}else{
		$ronby_recent_post_list_widget_anchor_hover_color = '';
	}	
	if(ronby_get_option('ronby_instagram_widget_title_color') !=''){

		$ronby_instagram_widget_title_color = ronby_get_option('ronby_instagram_widget_title_color')['rgba'];

	}else{
		$ronby_instagram_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_doctor_list_widget_title_color') !=''){

		$ronby_doctor_list_widget_title_color = ronby_get_option('ronby_doctor_list_widget_title_color')['rgba'];

	}else{
		$ronby_doctor_list_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_doctor_list_widget_anchor_color') !=''){

		$ronby_doctor_list_widget_anchor_color = ronby_get_option('ronby_doctor_list_widget_anchor_color')['rgba'];

	}else{
		$ronby_doctor_list_widget_anchor_color = '';
	}	
	if(ronby_get_option('ronby_doctor_list_widget_anchorhover_color') !=''){

		$ronby_doctor_list_widget_anchorhover_color = ronby_get_option('ronby_doctor_list_widget_anchorhover_color')['rgba'];

	}else{
		$ronby_doctor_list_widget_anchorhover_color = '';
	}	
	if(ronby_get_option('ronby_recent_post_two_widget_title_color') !=''){

		$ronby_recent_post_two_widget_title_color = ronby_get_option('ronby_recent_post_two_widget_title_color')['rgba'];

	}else{
		$ronby_recent_post_two_widget_title_color = '';
	}
	if(ronby_get_option('ronby_recent_post_two_widget_date_color') !=''){

		$ronby_recent_post_two_widget_date_color = ronby_get_option('ronby_recent_post_two_widget_date_color')['rgba'];

	}else{
		$ronby_recent_post_two_widget_date_color = '';
	}
	if(ronby_get_option('ronby_recent_post_two_widget_desc_color') !=''){

		$ronby_recent_post_two_widget_desc_color = ronby_get_option('ronby_recent_post_two_widget_desc_color')['rgba'];

	}else{
		$ronby_recent_post_two_widget_desc_color = '';
	}	
	if(ronby_get_option('ronby_subscription_two_widget_title_color') !=''){

		$ronby_subscription_two_widget_title_color = ronby_get_option('ronby_subscription_two_widget_title_color')['rgba'];

	}else{
		$ronby_subscription_two_widget_title_color = '';
	}	
	if(ronby_get_option('ronby_subscription_two_widget_text_color') !=''){

		$ronby_subscription_two_widget_text_color = ronby_get_option('ronby_subscription_two_widget_text_color')['rgba'];

	}else{
		$ronby_subscription_two_widget_text_color = '';
	}	
	if(ronby_get_option('ronby_subscription_two_widget_icon_color') !=''){

		$ronby_subscription_two_widget_icon_color = ronby_get_option('ronby_subscription_two_widget_icon_color')['rgba'];

	}else{
		$ronby_subscription_two_widget_icon_color = '';
	}
	if(ronby_get_option('ronby_subscription_two_widget_btn_bg_color') !=''){

		$ronby_subscription_two_widget_btn_bg_color = ronby_get_option('ronby_subscription_two_widget_btn_bg_color')['rgba'];

	}else{
		$ronby_subscription_two_widget_btn_bg_color = '';
	}	
	if(ronby_get_option('ronby_subscription_two_widget_btn_hover_bg_color') !=''){

		$ronby_subscription_two_widget_btn_hover_bg_color = ronby_get_option('ronby_subscription_two_widget_btn_hover_bg_color')['rgba'];

	}else{
		$ronby_subscription_two_widget_btn_hover_bg_color = '';
	}
	if(ronby_get_option('ronby_wordpress_default_widgets_title_color') !=''){

		$ronby_wordpress_default_widgets_title_color = ronby_get_option('ronby_wordpress_default_widgets_title_color')['rgba'];

	}else{
		$ronby_wordpress_default_widgets_title_color = '';
	}
	if(ronby_get_option('ronby_wordpress_default_widgets_text_color') !=''){

		$ronby_wordpress_default_widgets_text_color = ronby_get_option('ronby_wordpress_default_widgets_text_color')['rgba'];

	}else{
		$ronby_wordpress_default_widgets_text_color = '';
	}
	if(ronby_get_option('ronby_wordpress_default_widgets_anchor_color') !=''){

		$ronby_wordpress_default_widgets_anchor_color = ronby_get_option('ronby_wordpress_default_widgets_anchor_color')['rgba'];

	}else{
		$ronby_wordpress_default_widgets_anchor_color = '';
	}	
	if(ronby_get_option('ronby_wordpress_default_widgets_anchorhover_color') !=''){

		$ronby_wordpress_default_widgets_anchorhover_color = ronby_get_option('ronby_wordpress_default_widgets_anchorhover_color')['rgba'];

	}else{
		$ronby_wordpress_default_widgets_anchorhover_color = '';
	}
	// End Footer Settings
	

	// Start Blog Settings
	if(ronby_get_option('ronby_blog_page_pagi_btn_bg_color') !=''){

		$ronby_blog_page_pagi_btn_bg_color = ronby_get_option('ronby_blog_page_pagi_btn_bg_color')['rgba'];

	}else{
		$ronby_blog_page_pagi_btn_bg_color = '';
	}
	
	if(isset($redux['ronby_blog_page_brand_slider_bg_color']['rgba']) &&  ($redux['ronby_blog_page_brand_slider_bg_color']['rgba'] !='')){

		$ronby_blog_page_brand_slider_bg_color = $redux['ronby_blog_page_brand_slider_bg_color']['rgba'];

	}else{
		$ronby_blog_page_brand_slider_bg_color = '';
	}	
	// End Blog Settings
	
	// Start Single Post
	
	//End Single Post
	
	//Start Page settings
	if(isset($redux['ronby_page_header_sec_bg_image']['url']) && ($redux['ronby_page_header_sec_bg_image']['url'] !='')){

		$ronby_page_header_sec_bg_image = $redux['ronby_page_header_sec_bg_image']['url'];

	}else{
		$ronby_page_header_sec_bg_image = '';
	}	
	if(ronby_get_option('ronby_page_header_sec_overlay_color') !=''){

		$ronby_page_header_sec_overlay_color = ronby_get_option('ronby_page_header_sec_overlay_color')['rgba'];

	}else{
		$ronby_page_header_sec_overlay_color = '';
	}	
	if(ronby_get_option('ronby_page_header_sec_title_one_color') !=''){

		$ronby_page_header_sec_title_one_color = ronby_get_option('ronby_page_header_sec_title_one_color')['rgba'];

	}else{
		$ronby_page_header_sec_title_one_color = '';
	}
	if(ronby_get_option('ronby_page_header_sec_title_two_color') !=''){

		$ronby_page_header_sec_title_two_color = ronby_get_option('ronby_page_header_sec_title_two_color')['rgba'];

	}else{
		$ronby_page_header_sec_title_two_color = '';
	}
	if(ronby_get_option('ronby_page_header_sec_breadcrumb_bg_color') !=''){

		$ronby_page_header_sec_breadcrumb_bg_color = ronby_get_option('ronby_page_header_sec_breadcrumb_bg_color')['rgba'];

	}else{
		$ronby_page_header_sec_breadcrumb_bg_color = '';
	}
	if(ronby_get_option('ronby_page_header_sec_breadcrumb_txt_color') !=''){

		$ronby_page_header_sec_breadcrumb_txt_color = ronby_get_option('ronby_page_header_sec_breadcrumb_txt_color')['rgba'];

	}else{
		$ronby_page_header_sec_breadcrumb_txt_color = '';
	}	
	if($redux['ronby_page_header_sec_padding']['padding-top'] !='' || $redux['ronby_page_header_sec_padding']['padding-bottom'] != ''){

		$ronby_page_header_sec_padding_top = $redux['ronby_page_header_sec_padding']['padding-top'];
		$ronby_page_header_sec_padding_bottom = $redux['ronby_page_header_sec_padding']['padding-bottom'];

	}else{
		$ronby_page_header_sec_padding_top = '';
		$ronby_page_header_sec_padding_bottom = '';
	}	
	// End  page settings
	
	// Start 404 Page 
	if(ronby_get_option('ronby_404_btn_bg_color') != '') {

		$ronby_404_btn_bg_color = ronby_get_option('ronby_404_btn_bg_color')['rgba'];

	} else { 

		$ronby_404_btn_bg_color = '';

	}	
	if(ronby_get_option('ronby_404_btn_hover_bg_color') != '') {

		$ronby_404_btn_hover_bg_color = ronby_get_option('ronby_404_btn_hover_bg_color')['rgba'];

	} else { 

		$ronby_404_btn_hover_bg_color = '';

	}	
	
	// End 404 Page
	
	//if(ronby_get_option('show_ronby_web_global_color_primary') !=''){
	$ronby_web_global_color_primary = isset( ronby_get_option('ronby_web_global_color_primary')['rgba'] ) ? ronby_get_option('ronby_web_global_color_primary')['rgba'] : '';
	if(isset($_COOKIE['ft_main_color'])) {
		$show_ronby_web_global_color_primary = $_COOKIE['ft_main_color'];
	} elseif($ronby_web_global_color_primary==''){
		$show_ronby_web_global_color_primary = '#0085D3';
	}else{
		$show_ronby_web_global_color_primary =isset(ronby_get_option('ronby_web_global_color_primary')['rgba']) ? ronby_get_option('ronby_web_global_color_primary')['rgba'] : '';
	}
	$ronby_web_global_color_secondary = isset( ronby_get_option('ronby_web_global_color_secondary')['rgba'] ) ? ronby_get_option('ronby_web_global_color_secondary')['rgba'] : '';
	if($ronby_web_global_color_secondary==''){
		$show_ronby_web_global_color_secondary = '#FBD03B';
	}else{
		$show_ronby_web_global_color_secondary =isset(ronby_get_option('ronby_web_global_color_secondary')['rgba']) ? ronby_get_option('ronby_web_global_color_secondary')['rgba'] : '';
	}
	
	$ronby_blog_color_primary = isset( ronby_get_option('ronby_blog_color_primary')['rgba'] ) ? ronby_get_option('ronby_blog_color_primary')['rgba'] : '';
	if($ronby_blog_color_primary==''){
		$show_ronby_blog_color_primary = '#444';
	}else{
		$show_ronby_blog_color_primary =isset(ronby_get_option('ronby_blog_color_primary')['rgba']) ? ronby_get_option('ronby_blog_color_primary')['rgba'] : '';
	}
	$ronby_blog_color_secondary = isset( ronby_get_option('ronby_blog_color_secondary')['rgba'] ) ? ronby_get_option('ronby_blog_color_secondary')['rgba'] : '';
	if(isset($_COOKIE['ft_main_color'])) {
		$show_ronby_blog_color_secondary = $_COOKIE['ft_main_color'];
	} elseif($ronby_blog_color_secondary==''){
		$show_ronby_blog_color_secondary = '#0085D3';
	}else{
		$show_ronby_blog_color_secondary =isset(ronby_get_option('ronby_blog_color_secondary')['rgba']) ? ronby_get_option('ronby_blog_color_secondary')['rgba'] : '';
	}
	
	// End Global Color
	
	if(ronby_get_option('ronby_single_product_bg_color') !=''){
		$ronby_single_product_bg_color = ronby_get_option('ronby_single_product_bg_color')['rgba'];
	}else{
		$ronby_single_product_bg_color = '#F5F5F5';
	}
	// End Woo Shop Products bg Color
?>

<!-- Custom CSS Codes

========================================================= -->

<style id="custom-style">
	<?php if(!empty($logo_width)) { ?>
	 .logo img{
		width: <?php echo esc_attr($logo_width); ?>;
	}	
	<?php } ?>
	<?php if(!empty($logo_height)) { ?>
	.logo img{
		height: <?php echo esc_attr($logo_height); ?>;
	}	
	<?php } ?>
	
	<?php //Global COLOR Start ?>
	.woocommerce-pagination  a:hover,
	.woocommerce-pagination  li .current,
	.remodal .item-badge.item-badge-red,
	.remodal .button.product_type_variable.add_to_cart_button,
	.tm-woowishlist-item .add_to_cart_button, .form-style-4 label,
	.product-item-1 .item-badge-red, #footer .about-us-one .social-icons .social-8 ul li,
	.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
	.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover,
	.single-product .fitness-single-product-layout .product-detail-1 .product .summary.entry-summary .add_to_cart_button:hover,
	.single-product .fitness-single-product-layout .product-detail-1 .product .summary.entry-summary .ronby-view_wishlist-btn:hover,
	.single-product .fitness-single-product-layout .product-detail-1 .product .summary.entry-summary .ronby-woocompare-button:hover,
	.single-product .fitness-single-product-layout .product-detail-1 .product .summary.entry-summary .ronby-view-compare-btn:hover,
	.single-product .fitness-single-product-layout .product-detail-1 .social-6 li:hover,
	.single-product .fitness-single-product-layout .view-cart.btn:hover,
	.woocommerce-cart-form .shop_table thead tr, #payment #place_order,
	.woocommerce-cart-form .shop_table tr:last-child, .product-item-1 .item-badge-red,
	.woocommerce-form.woocommerce-form-login.login .button, .woocommerce-form-coupon .button,
	.cart_totals h2::after,
	#customer_details h3::after,
	#order_review_heading::after,
	#order_review .shop_table thead,
	.woocommerce-MyAccount-content .woocommerce-Address .woocommerce-Address-title h3::after,
	.woocommerce-MyAccount-content form h3::after,
	.cart-collaterals .cross-sells h2::after,
	.tm-woowishlist-item .added_to_cart,
	.shop_table thead tr,
	.shop_table tr:last-child,
	.cart_totals h2::after,
	#customer_details h3::after,
	#order_review_heading::after,
	#order_review .shop_table thead,
	.woocommerce-MyAccount-content .woocommerce-Address .woocommerce-Address-title h3::after,
	.woocommerce-MyAccount-content form h3::after,
	.remodal .item-badge.item-badge-red,
	.fitness-section-feature-products .added_to_cart:hover,
	.fitness-contact-form .button,
	.layout-3 .error-404-sec .button-default:hover, .layout-3 .error-404-sec .btn-default:hover,
	.srch_close, .calculator-box,
	.class-detail .class-detail-header .class-infomation .class-price,
	.section-timetable .timetable thead,
	.detailed-team-member-item-2 .member-socials ul li a:hover,
	.layout-3 .detailed-team-member-item-2 .member-socials ul li a,
	.team-detail-2 .member-socials ul li a:hover,
	.calculator-box .icon,
	.social-10 li:hover,
	.cart-table thead tr,
	.cart-summary,
	.cart-widget .cart-widget-title:after,
	.contact-infomation-box-5 .contact-social li:hover,
	.button-primary,
	.button-secondary:hover,
	.background-primary,
	.background-secondary:hover,
	.active-background-primary.active,
	.hover-background-primary:hover,
	.before-background-primary:before,
	.after-background-primary:after,
	.woocommerce a.button.wc-backward,
	.fitness-section-teams .team-item-2 .member-socials li a,
	.single-product .summary.entry-summary .ronby-view_wishlist-btn:hover,
	.single-product .summary.entry-summary .ronby-woocompare-button:hover,
	.single-product .summary.entry-summary .ronby-view-compare-btn:hover,
	.single-product .summary.entry-summary .social-6 a:hover,
	.construction-slider .section-title::after,
	.page-header-2 .page-header-breadcrumb,
	.header-2 .main-menu li.current-menu-item,.header-2 .main-menu li:hover > a,
	.layout-1 .button-secondary, .timetable-box,
	.comment-item-4 .reply-button:hover,
	.shop_layout_group_table .add_to_cart_button:hover,
	.shop_single_layout_upsells ul.products .added_to_cart:hover,
	.single-product-cart-notice .view-cart.btn,
	.shop_layout ul.products .added_to_cart:hover,
	.fashion-section-feature-products .added_to_cart:hover,
	.woocommerce-MyAccount-navigation li:nth-child(even),
	a.added_to_cart:hover,
	.service-item-2 .background-secondary,
	.background-primary.p-120-0:hover,
	.header-top .hover-background-secondary:hover,
	.event-countdown-1.background-secondary,
	.layout-1 .active-background-secondary.active,
	.business-blog-section-element .blog-post-item-1 .post-date.background-secondary,
	.product-item-4 .button-default:hover,
	.header-top .button-secondary,
	.construction-service-detail-2 ul li::before,
	.fitness-photo-gallery-grid .tab.active,
	.fitness-testimonial-slider-2 .owl-dot.active span,
	.summary-content .btn-danger,
	.ribbon2, .fashion-section-feature-products-2 .ribbon2,
	.section-header-style-2 .separator.background-primary,
	.post-featured, .portfolio-slider-one.blasa-section.portfolio-section-3,
	.portfolio-slider-one .portfolio-owl .owl-dots button.active,
	.fitness-section-feature-products-2 .sale-badge,
	.about_us_eight .about_us_btn a:hover,
	.service-section-nine .wrap_service:hover .service-icon,
	.about_us_eight .about_us_btn a i, .business-feature-box-3 .about_ficon_2,
	.bg-vdo-sec-one .rq-play-video:hover,
	.bg-vdo-sec-one .row_processes_head .rq-play-video:hover,
	.shop-feature-box .solution_more, .shop-feature-box .wrap_solution_img::before
	{
		background-color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	.product-item-1 .item-badge-red{
		box-shadow: 0 0 0 3px <?php echo esc_attr($show_ronby_web_global_color_primary); ?>, 0px 21px 5px -18px rgba(0,0,0,0.6)<?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	@media (max-width: 991px) {
	.article-with-overlay-5 .arrow
	{
		background-color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	}
	@media (min-width: 992px) {
	.article-with-overlay-5:hover .arrow
	{
		background-color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	}
	.food_layout_group_table .woocommerce-grouped-product-list-item__quantity a,
	.construction-slider .owl-dot.active span,
	.post-carousel-3 .owl-nav .owl-prev:hover,.post-carousel-3 .owl-nav .owl-next:hover,
	.post-carousel-2 .owl-nav .owl-prev:hover,.post-carousel-2 .owl-nav .owl-next:hover,
	.woocommerce-form.woocommerce-form-login.login .button,.woocommerce-form-coupon .button,
	.wc-proceed-to-checkout .checkout-button,
	.product .summary.entry-summary .ronby-woocompare-button:hover,
	.ronby-style-selector-content h4,
	#ronby_color_picker .button, .slider-dash-icon,
	.portfolio-slider-one, .portfolio-slider-one .portfolio-owl .owl-nav button
	{
		background-color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?> !important;
	}
	.button-secondary, .button-primary:hover,
	.background-secondary, .background-primary:hover,
	.button-default:hover, .btn-default:hover,
	.layout-1 .button-secondary:hover,
	.service-item-2 .background-secondary:hover,
	#rev_slider_1_1_wrapper .background-primary,
	.business-blog-section-element .blog-post-item-1 .post-date.background-secondary:hover,
	.business-testimonial-sec .owl-nav .background-primary,
	.section-header-style-2 .background-primary,
	.header-top .button-secondary:hover,
	.bg-vdo-sec-one .rq-play-video
	{
		background-color: <?php echo esc_attr($show_ronby_web_global_color_secondary); ?>;
	}
	.wc-proceed-to-checkout a.checkout-button:hover,
	.woocommerce a.button.wc-backward:hover,
	.food_layout_group_table .woocommerce-grouped-product-list-item__quantity a:hover,
	.ot-button:hover{
		background-color: <?php echo esc_attr($show_ronby_web_global_color_secondary); ?> !important;
	}
	.remodal #wcqv_contend .woocommerce-Price-amount,
	.fitness-section-feature-products .product-price-1 ins,
	.header-3 .main-menu li:hover > a,
	.class-item .class-infomation .class-title:hover,
	.class-detail .class-detail-header .class-infomation .class-title:hover,
	.class-detail .class-detail-header .class-infomation .class-schedule .lb,
	.team-item-2 .member-role,
	.calculator-box .tabs-filter .tab:hover,
	.plan-item .item-header .plan-price .plan-period,
	.cart-table .cart-item-remove:hover,
	.color-primary, .active-color-primary.active,
	footer .ronby-doctors-list .color-secondary,
	.post-comment-count.color-secondary,
	.post-carousel-2 .color-secondary,
	.widget-contact-infomation .color-secondary,
	.hover-color-primary:hover, .before-color-primary:before,
	.after-color-primary:after, .hover-color-primary:hover, .hover-color-secondary,
	.animhead h2, .single-product .logged-in-as a,
	.single-product #cancel-comment-reply-link,
	.single-product .comment-notes, .single-product .comment-reply-link,
	.construction-service-detail-2 h2 span,
	.section-we-provide-services .section-title span,
	.team-item-1 .name:hover, .article-with-overlay-4 .icon,
	.question-item .item-title:hover, .header-2 .contact-infomation .icon,
	.testimonial-slider-3 .item .item-author .author-description,
	.header-4 .main-menu li:hover > a,
	.header-1 .main-menu li.current-menu-item > a,.header-1 .main-menu li:hover > a,
	.header-6 .main-menu li:hover > a,
	.layout-6 .section-header-style-13 .section-sub-title,
	.header-top .header-infomation .color-secondary,
	ul.items-inline-block li.is-checked,
	#sc-toggle-close i,
	.construction-our-projects #filters .hover-color-primary,
	.layout-3 .header-1 .list-contact-infomations i,
	.plan-item .item-content ul li:before,
	.header-4 .header-infomation li i,
	.site-branding a.no-color, .section-header-style-2 .color-primary,
	.fashion-section-feature-products-2 .product-action-buttons-1 a:hover,
	.portfolio-slider-one .portfolio-owl .owl-nav button:hover,
	.portfolio-slider-one a, .portfolio-slider-one a:hover,
	.portfolio-slider-one .small-title, .about_us_eight .about_us_btn a,
	.about_us_eight .about_us_btn a:hover i,
	.about_us_eight a:hover, .small-title,
	.service-section-nine .service-icon,
	.business-heading-sec-3 .small-title,
	.bg-vdo-sec-one a:hover,.rq-play-video,
	.shop-feature-box .solution_more:hover,.shop-feature-box .wrap_solution:hover .solution_more,
	.shop-feature-box a:hover, .shop-testimonial-slider .owl-nav i,
	.fitness-section-feature-products-2 .product_type_button
	{
		color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	.color-secondary, .hover-color-primary, .hover-color-secondary:hover,
	.single-product .logged-in-as a:hover,
	footer .ronby-doctors-list .color-secondary:hover,
	.single-product a:hover#cancel-comment-reply-link,
	.single-product .comment-notes:hover,
	.header-1 .list-contact-infomations i,
	.post-comment-count.color-secondary:hover,
	.post-carousel-2 .color-secondary:hover,
	#rev_slider_1_1_wrapper .color-primary,
	.construction-our-projects #filters .hover-color-primary:hover
	{
		color: <?php echo esc_attr($show_ronby_web_global_color_secondary); ?>;
	}
	.single-product a.comment-reply-link.comment-reply.color-primary:hover,
	.portfolio-slider-one a:hover{
		color: <?php echo esc_attr($show_ronby_web_global_color_secondary); ?> !important;
	}
	#wcqv_contend ins .woocommerce-Price-amount,
	.remodal #wcqv_contend ins .woocommerce-Price-amount
	{
		color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?> !important;
	}
	.tm-woowishlist-item, .portfolio-slider-one .portfolio-owl .owl-dots button.active::before
	{
		border-bottom-color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	.error-404-sec .button-default:hover,
	.error-404-sec .btn-default:hover,
	.border-color-primary,
	.active-border-color-primary.active,
	.hover-border-color-primary:hover,
	.before-border-color-primary:before,
	.after-border-color-primary:after,
	.border-color-secondary:hover,
	section.section-join-us.bdron .section-list-item,
	.bordered-top-uls, .bordered-bottom-uls,
	.single-product-cart-msg, .construction-slider .owl-dot.active,
	.header-1 .main-menu .sub-menu,
	.fitness-photo-gallery-grid .tab,
	.fitness-testimonial-slider-2 .owl-dot.active,
	.ribbon2::after, .button-primary, .about_us_eight .about_us_btn a,
	.bg-vdo-sec-one .row_processes_head .rq-play-video:hover::after,
	.bg-vdo-sec-one .row_processes_head .rq-play-video::after,
	.shop-testimonial-slider .owl-nav i
	{
		border-color: <?php echo esc_attr($show_ronby_web_global_color_primary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	.border-color-secondary, .border-color-primary:hover,
	.button-default:hover, .btn-default:hover{
		border-color: <?php echo esc_attr($show_ronby_web_global_color_secondary); ?>;
	}
	<?php //Blog Color Start from here ?>
	.blog-post-detail-3 .blog-post-content ul li:before,
	.blog-post-detail-3 .blog-post-content a,
	.comment-layout-three .list-comments .comment-item-3 a:not(.comment-reply),
	.logged-in-as a, #cancel-comment-reply-link,
	.comment-notes, .comment-reply-link,
	.single-post #content .hover-color-primary, .single-post #content .hover-color-secondary:hover,
	.single-post #content .ronby-doctors-list .hover-color-secondary,
	.blog-section .hover-color-primary, .blog-section .hover-color-secondary:hover,
	.widget-menu-1 .hover-color-primary a, .widget-menu-1 .hover-color-primary span,
	.single-post #content .text-right.simple-pagenavi .hover-color-secondary
	{
		color: <?php echo esc_attr($show_ronby_blog_color_primary); ?>;
	}
	.sidebar .widget-menu-1 li a:hover, .blog-section .color-primary,
	.single-post #content .color-primary,
	.single-post #content .hover-color-primary:hover, .single-post #content .hover-color-secondary,
	.single-post #content .ronby-doctors-list .hover-color-secondary:hover,
	.blog-section .hover-color-primary:hover, .blog-section .hover-color-secondary,
	.widget-menu-1 .hover-color-primary:hover a, .widget-menu-1 .hover-color-primary:hover span,
	.blog-post-item-4 .post-date, .logged-in-as a:hover,
	a:hover#cancel-comment-reply-link,
	.comment-notes:hover,
	.blog-section .color-secondary, .blog-section .post-comment-count a,
	.single-post #content .color-secondary, .single-post #content .post-comment-count a,
	.blog-post-detail-2 .blog-post-header .post-author .post-date,
	.blog-post-item-2 .post-author .post-date,
	.layout-1 .section-light h2.title a:hover,
	.comment-layout-two .comments-list .comment-item-2 a:not(.reply-button),
	.blog-post-detail-2 a, .comment-item-4 .comment-content .comment-time,
	.blog-post-detail-4 .post-sharing a:hover, .sidebar .widget-menu-8 li a:hover,
	.sidebar .widget-menu-5 li a:hover, .sidebar .widget-post-item-3 .post-time,
	.comment-item-1 .comment-time, .sidebar .widget_archive li a:hover,
	.comment-layout-six a, .blog-post-detail-6 .blog-detail-content a,
	.single-post #content .text-right.simple-pagenavi .hover-color-secondary:hover
	{
		color: <?php echo esc_attr($show_ronby_blog_color_secondary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	a.comment-reply-link.comment-reply.color-primary:hover{
		color: <?php echo esc_attr($show_ronby_blog_color_secondary); ?> !important;
	}
	.blockquote-3,
	.single-post #content .button-secondary,
	.single-post #content .background-secondary, .single-post #content .background-primary:hover,
	.blog-section .button-secondary,
	.blog-section .background-secondary, .blog-section .background-primary:hover,
	.sidebar .subscription-widget-one .background-primary:hover,
	.sidebar #searchform button:hover,
	.layout-1.single-post #content .button-secondary,
	.layout-1 .blog-section .button-secondary,
	.bg2-featurebox-3 .img-box .postdate-box,
	.blog-section .background-secondary.post-date:hover,
	.single-post #content .background-secondary.post-date:hover,
	.single-post #content .button-primary:hover,
	.blog-section .button-primary:hover
	{
		background-color: <?php echo esc_attr($show_ronby_blog_color_primary); ?>;
	}
	.blog-section .background-secondary:hover,	
	.blog-section .button-primary,
	.blog-section .button-secondary:hover,
	.blog-section .background-primary,
	.blog-section .active-background-primary.active,
	.blog-section .hover-background-primary:hover,
	.blog-section .before-background-primary:before,
	.blog-section .after-background-primary:after,
	.single-post #content.background-secondary:hover,
	.single-post #content .button-primary,
	.single-post #content .button-secondary:hover,
	.single-post #content .background-primary,
	.single-post #content .active-background-primary.active,
	.single-post #content .hover-background-primary:hover,
	.single-post #content .before-background-primary:before,
	.single-post #content .after-background-primary:after,
	.sidebar .subscription-widget-one .background-primary,
	.blog-section .button-default:hover, .blog-section .btn-default:hover,
	.single-post #content .button-default:hover, .single-post #content .btn-default:hover,
	.blog-post-detail-2 .blog-post-content cite::before,
	.blog-post-detail-2 .blog-post-header .post-taxonomies::after,
	.list-style-2 .custom-dot, .layout-1 .section-light .button-primary,
	.layout-1 .section-light .button-secondary:hover,
	.blog-post-detail-2 .blog-post-content ul li::before,
	.comment-item-4 .reply-button, .blockquote-4:after,
	.social-7 a:hover,
	.layout-1.single-post #content .button-secondary:hover,
	.layout-1 .blog-section .button-secondary:hover,
	.blog-detail .blog-content-5 input[type=submit],
	.blog-detail .blog-content-5 .page-numbers.page-links .linkstyle,
	.blog-detail .blog-content-5 .page-numbers.page-links a:hover .linkstyle,
	.blog-post-detail-3 .blog-post-header .post-date,
	.blog-section .background-secondary.post-date,
	.blog-post-detail-4 .blog-post-content blockquote,
	.blog-post-detail-4 .blog-post-content blockquote::after,
	.single-post #content .background-secondary.post-date
	{
		background-color: <?php echo esc_attr($show_ronby_blog_color_secondary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	.fitness-contact-form .button,
	.blog-section .border-color-secondary, .blog-section .border-color-primary:hover,
	.single-post #content .border-color-secondary, .single-post #content .border-color-primary:hover,
	.single-post #content .button-primary:hover
	{
		border-color: <?php echo esc_attr($show_ronby_blog_color_primary); ?>;
	}
	.blog-section .border-color-primary,
	.blog-section .active-border-color-primary.active,
	.blog-section .hover-border-color-primary:hover,
	.blog-section .before-border-color-primary:before,
	.blog-section .after-border-color-primary:after,
	.single-post #content .border-color-primary,
	.single-post #content .active-border-color-primary.active,
	.single-post #content .hover-border-color-primary:hover,
	.single-post #content .before-border-color-primary:before,
	.single-post #content .after-border-color-primary:after,
	.blog-section .button-primary,
	.single-post #content .button-primary
	{
		border-color: <?php echo esc_attr($show_ronby_blog_color_secondary); ?><?php if(isset($_COOKIE['ft_main_color'])) { ?> !important<?php } ?>;
	}
	<?php //Global COLOR End ?>
	<?php if(ronby_get_option('ronby_page_bg_color') != ''){ ?>
	.ronby-page-post-page, #content, section.brands-carousel{
		background-color:<?php echo esc_attr(ronby_get_option('ronby_page_bg_color')['rgba']);?>
	}
	<?php } ?>

	<?php if(!empty($ronby_woo_product_star_color)) { ?>
	.stars-rating[data-rate="5"] span, .stars-rating li{
		color: <?php echo esc_attr($ronby_woo_product_star_color); ?> !important;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top{
		background-color: <?php echo esc_attr($ronby_header_top_menu_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .list-contact-infomations i{
		color: <?php echo esc_attr($ronby_header_top_menu_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .list-contact-infomations a{
		color: <?php echo esc_attr($ronby_header_top_menu_text_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .social-1 li{
		background-color: <?php echo esc_attr($ronby_header_top_menu_social_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .social-1 li a{
		color: <?php echo esc_attr($ronby_header_top_menu_social_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .social-1 li:hover{
		background-color: <?php echo esc_attr($ronby_header_top_menu_social_icon_hover_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .social-1 li a:hover{
		color: <?php echo esc_attr($ronby_header_top_menu_social_icon_hover_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .button-secondary{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .button-secondary{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .button-secondary:hover{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-top .button-secondary:hover{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-nav,
	.header-1.fitness-header-3 .header-nav.bg-scroll{
		background-color: <?php echo esc_attr($ronby_header_main_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-nav .main-menu .menu > li > a,.header-1 .nav-search-button{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .header-nav .main-menu .menu > li > a:hover,.header-1 .main-menu li.current-menu-item > a, .header-1 .main-menu li:hover > a{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .main-menu .sub-menu{
		border-color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .main-menu .sub-menu,
	.header-1 .bg-scroll .main-menu .sub-menu{
		background-color: <?php echo esc_attr($ronby_header_sub_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .main-menu .sub-menu a{
		color: <?php echo esc_attr($ronby_header_sub_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_popup_search_btn_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-1 .hidden-search-form .form-group-button{
		background-color: <?php echo esc_attr($ronby_header_main_menu_popup_search_btn_color); ?> ;
	}
	<?php } ?>

	<?php if(!empty($ronby_header_top_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-top{
		background-color: <?php echo esc_attr($ronby_header_top_menu_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-top .social-3 li a,.header-2 .header-top .social-3 li i{
		color: <?php echo esc_attr($ronby_header_top_menu_social_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_two_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-main{
		background-color: <?php echo esc_attr($ronby_header_top_menu_two_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .contact-infomation .icon{
		color: <?php echo esc_attr($ronby_header_top_menu_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .contact-infomation li{
		color: <?php echo esc_attr($ronby_header_top_menu_text_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-main .button-primary{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-main .button-primary{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-main .button-primary:hover{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-main .button-primary:hover{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-navbar{
		background-color: <?php echo esc_attr($ronby_header_main_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-nav .main-menu .menu > li > a,.header-2 .nav-search-button{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) ) { ?>
	.header-2 .header-nav .main-menu .menu > li > a:hover,.header-2 .main-menu li.current-menu-item > a, .header-2 .main-menu li:hover > a{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> !important;
	}
	<?php } ?>
	<?php if( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) ) { ?>
		.header-2 .header-nav .main-menu .menu > li > a:hover,.header-2 .main-menu li.current-menu-item > a, .header-2 .main-menu li:hover > a{
			color: #fff !important;
		}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .main-menu .sub-menu,.header-2 .main-menu .sub-menu li:not(:first-child) > a{
		border-color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-nav .main-menu .menu > li > a:hover,.header-2 .main-menu li.current-menu-item > a, .header-2 .main-menu li:hover > a{
		background-color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_bg_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_search_btn_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .hidden-search-form-toggler{
		background-color: <?php echo esc_attr($ronby_header_main_menu_search_btn_bg_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .hidden-search-form-toggler:hover{
		background-color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_bg_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .main-menu .sub-menu{
		background-color: <?php echo esc_attr($ronby_header_sub_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .main-menu .sub-menu a{
		color: <?php echo esc_attr($ronby_header_sub_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_popup_search_btn_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .hidden-search-form .form-group-button{
		background-color: <?php echo esc_attr($ronby_header_main_menu_popup_search_btn_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_slide_nav_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2 .header-navbar .nav-button{
		background-color: <?php echo esc_attr($ronby_header_main_menu_slide_nav_bg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_slide_navigation_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav{
		background-color: <?php echo esc_attr($ronby_header_main_menu_slide_navigation_bg_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_slide_navigation_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .widget_text{
		color: <?php echo esc_attr($ronby_header_main_menu_slide_navigation_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_slide_navigation_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .block-icon-text .icon-header{
		color: <?php echo esc_attr($ronby_header_main_menu_slide_navigation_icon_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .button-primary{
		color: <?php echo esc_attr($ronby_slide_navigation_btn1_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .button-primary{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn1_bg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_hovertext_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .button-primary:hover{
		color: <?php echo esc_attr($ronby_slide_navigation_btn1_hovertext_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_hoverbg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .button-primary:hover{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn1_hoverbg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .btn-default{
		color: <?php echo esc_attr($ronby_slide_navigation_btn2_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .btn-default{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn2_bg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_hovertext_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .btn-default:hover{
		color: <?php echo esc_attr($ronby_slide_navigation_btn2_hovertext_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_hoverbg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-2-slide-nav .main-slide-footer .btn-default:hover{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn2_hoverbg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-top .list-unstyled li,.header-3 .header-top .list-unstyled li span{
		color: <?php echo esc_attr($ronby_header_top_menu_text_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-top .button-primary{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-top .button-primary{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-top .button-primary:hover{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-top .button-primary:hover{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-top{
		background-color: <?php echo esc_attr($ronby_header_top_menu_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-nav{
		background-color: <?php echo esc_attr($ronby_header_main_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .main-menu .sub-menu{
		background-color: <?php echo esc_attr($ronby_header_sub_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .main-menu .sub-menu a{
		color: <?php echo esc_attr($ronby_header_sub_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_popup_search_btn_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .hidden-search-form .form-group-button{
		background-color: <?php echo esc_attr($ronby_header_main_menu_popup_search_btn_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-nav .main-menu .menu > li > a,.header-3 .nav-search-button{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_color); ?>;
	}
	<?php } if(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) { ?>
	.fitness-header-used.layout-1 .header-3 .header-nav .main-menu .menu > li > a,.fitness-header-used.layout-1 .header-3 .nav-search-button{
		color: #fff;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-3 .header-nav .main-menu .menu > li > a:hover,.header-3 .main-menu li.current-menu-item > a, .header-3 .main-menu li:hover > a{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-top .header-infomation li,.header-4 .header-top .header-infomation li .color-secondary{
		color: <?php echo esc_attr($ronby_header_top_menu_text_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-infomation li i{
		color: <?php echo esc_attr($ronby_header_top_menu_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-top .social-7 a{
		background-color: <?php echo esc_attr($ronby_header_top_menu_social_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-top .social-7 a{
		color: <?php echo esc_attr($ronby_header_top_menu_social_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-top .social-7 a:hover{
		background-color: <?php echo esc_attr($ronby_header_top_menu_social_icon_hover_bg_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_social_icon_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-top .social-7 a:hover{
		color: <?php echo esc_attr($ronby_header_top_menu_social_icon_hover_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav{
		background-color: <?php echo esc_attr($ronby_header_main_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav .main-menu .menu > li > a,.header-4 .header-nav .nav-search-button{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav .main-menu .menu > li > a:hover,.header-4 .main-menu li.current-menu-item > a, .header-4 .main-menu li:hover > a{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav .button-primary{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav .button-primary{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav .button-primary:hover{
		color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_text_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_btn_hover_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .header-nav .button-primary:hover{
		background-color: <?php echo esc_attr($ronby_header_top_menu_btn_hover_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .main-menu .sub-menu{
		background-color: <?php echo esc_attr($ronby_header_sub_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .main-menu .sub-menu a{
		color: <?php echo esc_attr($ronby_header_sub_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_popup_search_btn_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-4 .hidden-search-form .form-group-button{
		background-color: <?php echo esc_attr($ronby_header_main_menu_popup_search_btn_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5 .header-nav{
		background-color: <?php echo esc_attr($ronby_header_main_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_icon_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5 .header-nav i{
		color: <?php echo esc_attr($ronby_header_top_menu_icon_color); ?>;
	}	
	<?php } ?>
	<?php if(!empty($ronby_header_top_menu_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5 .site-branding a{
		color: <?php echo esc_attr($ronby_header_top_menu_text_color); ?>;
	}	
	<?php } ?>
		<?php if(!empty($ronby_slide_navigation_btn1_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .button-primary{
		color: <?php echo esc_attr($ronby_slide_navigation_btn1_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .button-primary{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn1_bg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_hovertext_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .button-primary:hover{
		color: <?php echo esc_attr($ronby_slide_navigation_btn1_hovertext_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn1_hoverbg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .button-primary:hover{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn1_hoverbg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .btn-default{
		color: <?php echo esc_attr($ronby_slide_navigation_btn2_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .btn-default{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn2_bg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_hovertext_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .btn-default:hover{
		color: <?php echo esc_attr($ronby_slide_navigation_btn2_hovertext_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_slide_navigation_btn2_hoverbg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .main-slide-footer .btn-default:hover{
		background-color: <?php echo esc_attr($ronby_slide_navigation_btn2_hoverbg_color); ?> ;
	}
	<?php } ?>
		<?php if(!empty($ronby_header_main_menu_slide_navigation_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav,.header-5-slide-nav .menu-mobile .sub-menu{
		background-color: <?php echo esc_attr($ronby_header_main_menu_slide_navigation_bg_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_slide_navigation_text_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .widget_text,.header-5-slide-nav .widget_text a{
		color: <?php echo esc_attr($ronby_header_main_menu_slide_navigation_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_slide_nav_width) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.header-5-slide-nav .style-customizer-wrap.form-horizontal{
		width: <?php echo esc_attr($ronby_header_main_menu_slide_nav_width); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_popup_search_btn_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	.hidden-search-form .form-group-button{
		background-color: <?php echo esc_attr($ronby_header_main_menu_popup_search_btn_color); ?> ;
	}
	<?php } ?>

	<?php if(!empty($ronby_header_main_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) )) { ?>
	.header-6 .header-nav{
		background-color: <?php echo esc_attr($ronby_header_main_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_bg_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) )) { ?>
	.header-6 .main-menu .sub-menu{
		background-color: <?php echo esc_attr($ronby_header_sub_menu_bg_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) )) { ?>
	.header-6 .header-nav .main-menu .menu > li > a,.header-6 .header-nav .nav-search-button{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_main_menu_anchor_hover_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) )) { ?>
	.header-6 .header-nav .main-menu .menu > li > a:hover,.header-6 .main-menu li.current-menu-item > a, .header-6 .main-menu li:hover > a{
		color: <?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> !important;
	}
	<?php } ?>
	<?php if(!empty($ronby_header_sub_menu_anchor_color) && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) )) { ?>
	.header-6 .main-menu .sub-menu a{
		color: <?php echo esc_attr($ronby_header_sub_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(!empty($ronby_mobile_nav_bg_color)) { ?>
	.navigation-mobile.navbar,.navigation-mobile.navbar .sub-menu,.nav-mobile,.nav-mobile .sub-menu{
		background-color: <?php echo esc_attr($ronby_mobile_nav_bg_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_mobile_nav_text_color)) { ?>
	.nav-mobile a{
		color: <?php echo esc_attr($ronby_mobile_nav_text_color); ?> ;
	}
	<?php } ?>
	<?php if(!empty($ronby_mobile_nav_btn_color)) { ?>
	.nav-mobile.navbar  .navbar-toggler{
		border-color: <?php echo esc_attr($ronby_mobile_nav_btn_color); ?> ;
	}
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.header-nav-icons .badge{
		position:absolute;
		right: 9px;
		top: 38px;
		border-radius:50%;
	}
	.cart-box.sub-menu{
	left:inherit !important;
	right:0;
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && !empty($ronby_header_main_menu_anchor_color)) { ?>
	.header-nav-icons a,.header-nav-icons .badge{
		color:<?php echo esc_attr($ronby_header_main_menu_anchor_color); ?>;
	}
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && !empty($ronby_header_main_menu_anchor_hover_color)) { ?>
	.header-nav-icons a:hover{
		color:<?php echo esc_attr($ronby_header_main_menu_anchor_hover_color); ?> !important;
	}
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) )) { ?>
	<?php if($is_gecko){ ?>
	.header-nav-icons .badge{
		position:absolute;
		margin-left: -6px;
		top:0;
		border-radius:50%;
	}
	<?php }else{ ?>
	.header-nav-icons .badge{
		position:absolute;
		margin-left: 10px;
		top:0;
		border-radius:50%;
	}	
	<?php } ?>
	.cart-box.sub-menu{
	left:inherit !important;
	right:0;
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) )) { ?>
	.header-nav-icons .badge{
	position: absolute;
    right: 11px;
    top: 23px;
    border-radius: 50%;
	}
	.cart-box.sub-menu{
	left:inherit !important;
	right:0;
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.header-nav-icons .badge{
    position: relative;
    top: -10px;
    right: 3px;
    border-radius: 50%;
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) )) { ?>
	.header-nav-icons .badge{
	position: absolute;
    right: 14px;
    top: 18px;
    border-radius: 50%;
	}
	.cart-box.sub-menu{
	padding-top:15px;
	padding-bottom:15px;
	left:inherit !important;
	right:0;	
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) )) { ?>
	.header-nav-icons .badge{
    position: absolute;
    border-radius: 50%;
    top: 25px;
    right: 5px;
	}
	.cart-box.sub-menu{
	padding-top:20px !important;
	padding-bottom:20px !important;
	left:inherit !important;
	right:0;	
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) )) { ?>
	.cart-box.sub-menu{
	left:inherit !important;
	right:0;	
	}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch')== 1 && ( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) )) { ?>
	.cart-box.sub-menu{
	left:inherit !important;
	right:0;	
	}	
	<?php } ?>
	<?php if($ronby_footer_bg_image != '') { ?>
	#footer{
		background-image:url(<?php echo esc_url($ronby_footer_bg_image);?>);
	}
	<?php } ?>
	<?php if($ronby_footer_bg_color != '') { ?>
	#footer .overlay{
		background-color:<?php echo esc_attr($ronby_footer_bg_color);?>;
	}
	<?php } ?>
	<?php if(ronby_get_option('ronby_footer_layout_style') == 1){ ?>
	<?php if($ronby_footer_top_padding_top != '' || $ronby_footer_top_padding_bottom != ''){?>
		#footer .inner-content {
			<?php if($ronby_footer_top_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_footer_top_padding_top);?>;
			<?php } ?>
			<?php if($ronby_footer_top_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_footer_top_padding_bottom);?>;
			<?php } ?>
		}	
	<?php }else{?>
		#footer .inner-content {
			padding: 110px 0 50px;
		}	
	<?php } ?>
	<?php } ?>
	<?php if(ronby_get_option('ronby_footer_layout_style') == 2){ ?>
	<?php if($ronby_footer_top_padding_top != '' || $ronby_footer_top_padding_bottom != ''){?>
		#footer .inner-content {
			<?php if($ronby_footer_top_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_footer_top_padding_top);?>;
			<?php } ?>
			<?php if($ronby_footer_top_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_footer_top_padding_bottom);?>;
			<?php } ?>
		}	
	<?php }else{?>
		#footer .inner-content {
			padding: 115px 0 55px;
		}		
	<?php } ?>
	<?php } ?>
	<?php if(ronby_get_option('ronby_footer_layout_style') == 3){ ?>
	<?php if($ronby_footer_top_padding_top != '' || $ronby_footer_top_padding_bottom != ''){?>
		#footer .inner-content {
			<?php if($ronby_footer_top_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_footer_top_padding_top);?>;
			<?php } ?>
			<?php if($ronby_footer_top_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_footer_top_padding_bottom);?>;
			<?php } ?>
		}	
	<?php }else{?>
		#footer .inner-content {
			padding: 115px 0 55px;
		}		
	<?php } ?>
	<?php } ?>
	<?php if(ronby_get_option('ronby_footer_layout_style') == 4){ ?>
	<?php if($ronby_footer_top_padding_top != '' || $ronby_footer_top_padding_bottom != ''){?>
		#footer .inner-content {
			<?php if($ronby_footer_top_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_footer_top_padding_top);?>;
			<?php } ?>
			<?php if($ronby_footer_top_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_footer_top_padding_bottom);?>;
			<?php } ?>
		}	
	<?php }else{?>
		#footer .inner-content {
			padding: 115px 0 55px;
		}		
	<?php } ?>
	<?php } ?>
	<?php if(ronby_get_option('ronby_footer_layout_style') == 5){ ?>
	<?php if($ronby_footer_top_padding_top != '' || $ronby_footer_top_padding_bottom != ''){?>
		#footer .inner-content {
			<?php if($ronby_footer_top_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_footer_top_padding_top);?>;
			<?php } ?>
			<?php if($ronby_footer_top_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_footer_top_padding_bottom);?>;
			<?php } ?>
		}	
	<?php }else{?>
		#footer .inner-content {
			padding: 110px 0 50px;
		}		
	<?php } ?>
	
	<?php } ?>
	<?php if(ronby_get_option('ronby_footer_layout_style') == 6){ ?>
	<?php if($ronby_footer_top_padding_top != '' || $ronby_footer_top_padding_bottom != ''){?>
		#footer .inner-content {
			<?php if($ronby_footer_top_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_footer_top_padding_top);?>;
			<?php } ?>
			<?php if($ronby_footer_top_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_footer_top_padding_bottom);?>;
			<?php } ?>
		}	
	<?php }else{?>
		#footer .inner-content {
			padding: 110px 0 50px;
		}		
	<?php } ?>
	<?php } ?>
	<?php if($ronby_footer_bottom_bg_color != ''){ ?>
		.copyright {
			background-color:<?php echo esc_attr($ronby_footer_bottom_bg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_footer_bottom_txt_color != ''){ ?>
		.copyright {
			color:<?php echo esc_attr($ronby_footer_bottom_txt_color);?>
		}	
	<?php } ?>
		
	<?php if($ronby_about_us_one_widget_title_color != ''){ ?>
		#footer .about-us-one .widget-title{
			color:<?php echo esc_attr($ronby_about_us_one_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_about_us_one_widget_text_color != ''){ ?>
		#footer .about-us-one p,#footer .about-us-one .list-unstyled li{
			color:<?php echo esc_attr($ronby_about_us_one_widget_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_about_us_one_widget_icon_color != ''){ ?>
		#footer .about-us-one .social-icons .social-8 ul li,#footer .about-us-one .list-unstyled li i{
			color:<?php echo esc_attr($ronby_about_us_one_widget_icon_color);?>
		}	
	<?php } ?>
	<?php if($ronby_about_us_one_widget_iconbg_color != ''){ ?>
		#footer .about-us-one .social-icons .social-8 ul li{
			background-color:<?php echo esc_attr($ronby_about_us_one_widget_iconbg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_about_us_one_widget_iconhover_color != ''){ ?>
		#footer .about-us-one .social-icons .social-8 ul li:hover{
			color:<?php echo esc_attr($ronby_about_us_one_widget_iconhover_color);?>
		}	
	<?php } ?>
	<?php if($ronby_about_us_one_widget_iconhoverbg_color != ''){ ?>
		#footer .about-us-one .social-icons .social-8 ul li:hover{
			background-color:<?php echo esc_attr($ronby_about_us_one_widget_iconhoverbg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_one_widget_title_color != ''){ ?>
		#footer .subscription-widget-one .widget-title{
			color:<?php echo esc_attr($ronby_subscription_one_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_one_widget_btn_bg_color != ''){ ?>
		#footer .subscription-widget-one .search-form button{
			background-color:<?php echo esc_attr($ronby_subscription_one_widget_btn_bg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_one_widget_btn_hover_bg_color != ''){ ?>
		#footer .subscription-widget-one .search-form button:hover{
			background-color:<?php echo esc_attr($ronby_subscription_one_widget_btn_hover_bg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_footer_nav_widget_title_color != ''){ ?>
		#footer .footer-nav .widget-title{
			color:<?php echo esc_attr($ronby_footer_nav_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_footer_nav_widget_anchor_color != ''){ ?>
		#footer .footer-nav a{
			color:<?php echo esc_attr($ronby_footer_nav_widget_anchor_color);?>
		}	
	<?php } ?>
	<?php if($ronby_footer_nav_widget_anchor_hover_color != ''){ ?>
		#footer .footer-nav a:hover{
			color:<?php echo esc_attr($ronby_footer_nav_widget_anchor_hover_color);?>
		}	
	<?php } ?>
	<?php if($ronby_contact_us_one_widget_title_color != ''){ ?>
		#footer .contact-us-one-widget .widget-title{
			color:<?php echo esc_attr($ronby_contact_us_one_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_contact_us_one_widget_icon_color != ''){ ?>
		#footer .contact-us-one-widget .icon{
			color:<?php echo esc_attr($ronby_contact_us_one_widget_icon_color);?>
		}	
	<?php } ?>
	<?php if($ronby_contact_us_one_widget_text_color != ''){ ?>
		#footer .contact-us-one-widget .item-lb, #footer .contact-us-one-widget .item-text,#footer .contact-us-one-widget .item-text a{
			color:<?php echo esc_attr($ronby_contact_us_one_widget_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_flickr_album_widget_title_color != ''){ ?>
		#footer .ronby_flickr_widget .widget-title{
			color:<?php echo esc_attr($ronby_flickr_album_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_contact_us_two_widget_title_color != ''){ ?>
		#footer .contact-us-two-widget .widget-title{
			color:<?php echo esc_attr($ronby_contact_us_two_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_contact_us_two_widget_icon_color != ''){ ?>
		#footer .contact-us-two-widget .icon{
			color:<?php echo esc_attr($ronby_contact_us_two_widget_icon_color);?>
		}	
	<?php } ?>
	<?php if($ronby_contact_us_two_widget_text_color != ''){ ?>
		#footer .contact-us-two-widget a,#footer .contact-us-two-widget .flex-fill{
			color:<?php echo esc_attr($ronby_contact_us_two_widget_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_opening_hours_widget_title_color != ''){ ?>
		#footer .opening-hours-widget .widget-title{
			color:<?php echo esc_attr($ronby_opening_hours_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_opening_hours_widget_text_color != ''){ ?>
		#footer .opening-hours-widget .widget-timetable li{
			color:<?php echo esc_attr($ronby_opening_hours_widget_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_recent_post_list_widget_title_color != ''){ ?>
		#footer .ronby-recent-post-widget .widget-title{
			color:<?php echo esc_attr($ronby_recent_post_list_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_recent_post_list_widget_text_color != ''){ ?>
		#footer .ronby-recent-post-widget .widget-post-item-5 .post-title,#footer .ronby-recent-post-widget .widget-post-item-5 .post-date{
			color:<?php echo esc_attr($ronby_recent_post_list_widget_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_recent_post_list_widget_anchor_hover_color != ''){ ?>
		#footer .ronby-recent-post-widget .widget-post-item-5 a:hover .post-title{
			color:<?php echo esc_attr($ronby_recent_post_list_widget_anchor_hover_color);?>
		}	
	<?php } ?>
	<?php if($ronby_instagram_widget_title_color != ''){ ?>
		#footer .ronby-instagram-feed .widget-title{
			color:<?php echo esc_attr($ronby_instagram_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_doctor_list_widget_title_color != ''){ ?>
		#footer .ronby-doctors-list .widget-title{
			color:<?php echo esc_attr($ronby_doctor_list_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_doctor_list_widget_anchor_color != ''){ ?>
		#footer .ronby-doctors-list .item-title,#footer .ronby-doctors-list .item-description{
			color:<?php echo esc_attr($ronby_doctor_list_widget_anchor_color);?>
		}	
	<?php } ?>
	<?php if($ronby_doctor_list_widget_anchorhover_color != ''){ ?>
		#footer .ronby-doctors-list .item-title:hover,#footer .ronby-doctors-list .item-title .color-secondary{
			color:<?php echo esc_attr($ronby_doctor_list_widget_anchorhover_color);?>
		}	
	<?php } ?>
	<?php if($ronby_recent_post_two_widget_title_color != ''){ ?>
		#footer .widget_ronby_recent_post_list_two .widget-title{
			color:<?php echo esc_attr($ronby_recent_post_two_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_recent_post_two_widget_date_color != ''){ ?>
		#footer .widget_ronby_recent_post_list_two .widget-post-item-4 .post-date{
			color:<?php echo esc_attr($ronby_recent_post_two_widget_date_color);?>
		}	
	<?php } ?>
	<?php if($ronby_recent_post_two_widget_desc_color != ''){ ?>
		#footer .widget_ronby_recent_post_list_two .widget-post-item-4 .post-excerpt{
			color:<?php echo esc_attr($ronby_recent_post_two_widget_desc_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_two_widget_title_color != ''){ ?>
		#footer .subscription-widget-two .widget-title{
			color:<?php echo esc_attr($ronby_subscription_two_widget_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_two_widget_text_color != ''){ ?>
		#footer .subscription-widget-two .widget-text,#footer .subscription-widget-two .list-unstyled,
		#footer .subscription-widget-two .widget-text p{
			color:<?php echo esc_attr($ronby_subscription_two_widget_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_two_widget_icon_color != ''){ ?>
		#footer .subscription-widget-two .list-unstyled i{
			color:<?php echo esc_attr($ronby_subscription_two_widget_icon_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_two_widget_btn_bg_color != ''){ ?>
		#footer .subscription-widget-two .button{
			background-color:<?php echo esc_attr($ronby_subscription_two_widget_btn_bg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_subscription_two_widget_btn_hover_bg_color != ''){ ?>
		#footer .subscription-widget-two .button:hover{
			background-color:<?php echo esc_attr($ronby_subscription_two_widget_btn_hover_bg_color);?>
		}	
	<?php } ?>
	<?php if($ronby_wordpress_default_widgets_title_color != ''){ ?>
		#footer .widget-title{
			color:<?php echo esc_attr($ronby_wordpress_default_widgets_title_color);?>
		}	
	<?php } ?>
	<?php if($ronby_wordpress_default_widgets_text_color != ''){ ?>
		#footer {
			color:<?php echo esc_attr($ronby_wordpress_default_widgets_text_color);?>
		}	
	<?php } ?>
	<?php if($ronby_wordpress_default_widgets_anchor_color != ''){ ?>
		#footer a{
			color:<?php echo esc_attr($ronby_wordpress_default_widgets_anchor_color);?>
		}	
	<?php } ?>
	<?php if($ronby_wordpress_default_widgets_anchorhover_color != ''){ ?>
		#footer a:hover{
			color:<?php echo esc_attr($ronby_wordpress_default_widgets_anchorhover_color);?>
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_bg_image != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
		.page-header-1{
			background-image:url(<?php echo esc_url($ronby_page_header_sec_bg_image);?>);
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_overlay_color != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
		.page-header-1 .overlay{
			background-color:<?php echo esc_attr($ronby_page_header_sec_overlay_color);?>;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_bg_image != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==2) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 2) ))){ ?>
		.page-header-2{
			background-image:url(<?php echo esc_url($ronby_page_header_sec_bg_image);?>);
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_overlay_color != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==2) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 2) ))){ ?>
		.page-header-2 .overlay{
			background-color:<?php echo esc_attr($ronby_page_header_sec_overlay_color);?>;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_bg_image != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
		.page-header-3{
			background-image:url(<?php echo esc_url($ronby_page_header_sec_bg_image);?>);
			padding:0;
			background-size: cover;
			background-position: center top;
			background-attachment: fixed;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_overlay_color != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
		.page-header-3 .overlay{
			background-color:<?php echo esc_attr($ronby_page_header_sec_overlay_color);?>;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_bg_image != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4{
			background-image:url(<?php echo esc_url($ronby_page_header_sec_bg_image);?>);
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_overlay_color != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4 .overlay{
			background-color:<?php echo esc_attr($ronby_page_header_sec_overlay_color);?>;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_bg_image != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==5) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 5) ))){ ?>
		.page-header-5{
			background-image:url(<?php echo esc_url($ronby_page_header_sec_bg_image);?>);
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_overlay_color != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==5) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 5) ))){ ?>
		.page-header-5 .overlay{
			background-color:<?php echo esc_attr($ronby_page_header_sec_overlay_color);?>;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_bg_image != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==6) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 6) ))){ ?>
		.page-header-6{
			background-image:url(<?php echo esc_url($ronby_page_header_sec_bg_image);?>);

			background-size: cover;
		}	
	<?php } ?>
	<?php if($ronby_page_header_sec_overlay_color != '' && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==6) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 6) ))){ ?>
		.page-header-6 .overlay{
			background-color:<?php echo esc_attr($ronby_page_header_sec_overlay_color);?>;
			padding-top: 160px;
			padding-bottom: 115px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==6) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 6) ))){ ?>
		.page-header-6 .overlay{
			padding-top: 210px;
			padding-bottom: 70px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==5) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 5) ))){ ?>
		.page-header-5 .inner-content{
			padding: 60px 0 30px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==5) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 5) ))){ ?>
		.page-header-5 .inner-content{
			padding: 40px 0 40px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4 .overlay{
			padding: 155px 0 80px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4 .overlay{
			padding: 155px 0 80px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4 .overlay{
			padding: 230px 0 85px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4 .overlay{
			padding: 150px 0 100px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){ ?>
		.page-header-4 .overlay{
			padding: 110px 0 100px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
		.page-header-3 .overlay{
			padding-top: 100px;
			padding-bottom: 100px;
		}
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
		.page-header-3 .overlay{
			padding-top: 120px;
			padding-bottom: 100px;
		}
		<?php if(ronby_get_option('ronby_header_top_menu_switch') == 1) { ?>
		.page-header-3 .overlay{
			padding-bottom: 70px;
		}
		<?php } ?>
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
	<?php if(ronby_get_option('ronby_header_top_menu_switch') != 1) { ?>
	.fitness-header-used .page-header-3 .overlay{
		padding-top: 190px;
	}
	<?php } ?>
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
	.page-header-3 .overlay{
		padding-top: 150px;
		padding-bottom: 100px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
	.page-header-3 .overlay{
		padding-top: 150px;
		padding-bottom: 100px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){ ?>
	.page-header-3 .overlay{
		padding-top: 150px;
		padding-bottom: 100px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==2) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 2) ))){ ?>
	.page-header-2 .page-header-inner{
		padding: 225px 0 80px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==2) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 2) ))){ ?>
	.page-header-2 .page-header-inner{
		padding: 100px 0 100px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
	.page-header-1 .inner-content{
		padding-top: 100px;
		padding-bottom: 75px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
	.page-header-1 .inner-content{
		padding-top: 250px;
		padding-bottom: 80px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
	.page-header-1 .inner-content{
		padding-top: 135px;
		padding-bottom: 80px;
		}	
	.page-header-1 .page-header-breadcrumb{
		z-index:1;
	}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
	.page-header-1 .inner-content{
		padding-top: 130px;
		padding-bottom: 80px;
		}	
	<?php } ?>
	<?php if(( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) ) && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){ ?>
	.page-header-1 .inner-content{
		padding-top: 140px;
		padding-bottom: 80px;
		}	
	<?php } ?>
	<?php if(!empty($ronby_page_header_sec_title_one_color) && ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){ ?>
	.page-header-title{
		color:<?php echo esc_attr($ronby_page_header_sec_title_one_color);?> !important;
		}	
	<?php } ?>
	<?php if(!empty($ronby_page_header_sec_title_two_color) && ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){ ?>
	.page-header-sub-title{
		color:<?php echo esc_attr($ronby_page_header_sec_title_two_color);?> !important;
		}	
	<?php } ?>
	<?php if(!empty($ronby_page_header_sec_breadcrumb_bg_color) && ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){ ?>
	.page-header-breadcrumb{
		background-color:<?php echo esc_attr($ronby_page_header_sec_breadcrumb_bg_color);?> !important;
		}	
	<?php } ?>
	<?php if(!empty($ronby_page_header_sec_breadcrumb_txt_color) && ronby_get_option('ronby_page_breadcrumb_section_switch') == 1){ ?>
	.page-header-breadcrumb a,.page-header-breadcrumb span,.page-header-breadcrumb{
		color:<?php echo esc_attr($ronby_page_header_sec_breadcrumb_txt_color);?> !important;
		}	
	<?php } ?>
	<?php  if(!empty($ronby_404_btn_bg_color) && (is_404())) { ?>
	.btn-404{
		background-color:<?php echo esc_attr($ronby_404_btn_bg_color); ?>;
		border-color:<?php echo esc_attr($ronby_404_btn_bg_color); ?>;
	}
	<?php } ?>
	<?php  if(!empty($ronby_404_btn_hover_bg_color) && (is_404())) { ?>
	.btn-404:hover{
		background-color:<?php echo esc_attr($ronby_404_btn_hover_bg_color); ?>;
		border-color:<?php echo esc_attr($ronby_404_btn_hover_bg_color); ?>;
	}
	<?php } ?>
	<?php  if(!empty($ronby_blog_page_pagi_btn_bg_color)) { ?>
	.page-navi .background-primary{
		background-color:<?php echo esc_attr($ronby_blog_page_pagi_btn_bg_color); ?>;
	}
	<?php } ?>
	<?php if(($ronby_page_header_sec_padding_top != '' || $ronby_page_header_sec_padding_bottom != '') && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==1) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 1) ))){?>
		#page-header .inner-content{
			<?php if($ronby_page_header_sec_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_page_header_sec_padding_top);?>;
			<?php } ?>
			<?php if($ronby_page_header_sec_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_page_header_sec_padding_bottom);?>;
			<?php } ?>
			min-height: inherit;
		}	
	<?php } ?>
	<?php if(($ronby_page_header_sec_padding_top != '' || $ronby_page_header_sec_padding_bottom != '') && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==2) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 2) ))){?>
		#page-header .page-header-inner {
			<?php if($ronby_page_header_sec_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_page_header_sec_padding_top);?>;
			<?php } ?>
			<?php if($ronby_page_header_sec_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_page_header_sec_padding_bottom);?>;
			<?php } ?>
			min-height: inherit;
		}	
	<?php } ?>
	<?php if(($ronby_page_header_sec_padding_top != '' || $ronby_page_header_sec_padding_bottom != '') && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==3) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 3) ))){?>
		#page-header.page-header-3 .overlay {
			<?php if($ronby_page_header_sec_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_page_header_sec_padding_top);?>;
			<?php } ?>
			<?php if($ronby_page_header_sec_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_page_header_sec_padding_bottom);?>;
			<?php } ?>
		}	
		.page-header-3{
			padding-top:0;
			padding-bottom:0;
		}
	<?php } ?>
	<?php if(($ronby_page_header_sec_padding_top != '' || $ronby_page_header_sec_padding_bottom != '') && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==4) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 4) ))){?>
		#page-header.page-header-4 .overlay {
			<?php if($ronby_page_header_sec_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_page_header_sec_padding_top);?>;
			<?php } ?>
			<?php if($ronby_page_header_sec_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_page_header_sec_padding_bottom);?>;
			<?php } ?>
		}	
	<?php } ?>
	<?php if(($ronby_page_header_sec_padding_top != '' || $ronby_page_header_sec_padding_bottom != '') && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==5) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 5) ))){?>
		#page-header.page-header-5 .inner-content{
			<?php if($ronby_page_header_sec_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_page_header_sec_padding_top);?>;
			<?php } ?>
			<?php if($ronby_page_header_sec_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_page_header_sec_padding_bottom);?>;
			<?php } ?>
			min-height: inherit;
		}	
	<?php } ?>
	<?php if(($ronby_page_header_sec_padding_top != '' || $ronby_page_header_sec_padding_bottom != '') && ( (isset($_COOKIE['ft_header_type']) && (int)$_COOKIE['ft_header_type']==6) || ((!isset($_COOKIE['ft_header_type'])) && (ronby_get_option('ronby_page_header_layout') == 6) ))){?>
		#page-header.page-header-6{
			<?php if($ronby_page_header_sec_padding_top != '') { ?>
			padding-top:<?php echo esc_attr($ronby_page_header_sec_padding_top);?>;
			<?php } ?>
			<?php if($ronby_page_header_sec_padding_bottom != '') { ?>
			padding-bottom:<?php echo esc_attr($ronby_page_header_sec_padding_bottom);?>;
			<?php } ?>
			
		}	
	<?php } ?>
	<?php if(ronby_get_option('ronby_header_top_menu_switch') == 1) { ?>
	.construction-header-used .page-header-3 .overlay{
		padding-top: 100px;
	}
	.fashion-header-used .page-header-3.clac-slider .overlay, .medical-header-used .page-header-3 .overlay {
		padding-top: 130px;
		padding-bottom: 60px;
	}
	.business-header-used .page-header-3.clac-slider .overlay{
		padding-top: 60px;
		padding-bottom: 60px;
	}
	.fitness-header-used .page-header-6 .overlay {
		padding-top: 250px;
	}
	#header.header-1 .header-nav.bg-scroll,
	#header.header-3 .header-nav.bg-scroll{
		margin-top: -50px;
	}
	#header.header-2 .header-nav.bg-scroll{
		margin-top: -158px;
	}
	#header.header-4 .header-nav.bg-scroll{
		margin-top: -60px;
	}
	<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 1){ ?>
@media (min-width: 768px){
.comments .comments-list .children{
    margin-left: 130px;	
}
.single-product .comments .comments-list .children{
    margin-left: 0;	
}
}
.comment-notes{
	margin-bottom:30px;
	font-size:13px;
}
.logged-in-as a{
	font-size:13px;
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	font-size:13px;
}
<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 2){ ?>
@media (min-width: 768px){
.comments .comments-list .children{
    margin-left: 100px;	
}
.single-product .comments .comments-list .children{
    margin-left: 0;	
}
}
.comment-notes{
font-size: 14px;
font-weight:500;
margin-bottom: 40px;
font-weight: 500;
font-family: Poppins, san-serif;
}
.logged-in-as{
margin-bottom: 40px;	
}
.logged-in-as a{
font-size: 14px;	
font-weight: 500;
font-family: Poppins, san-serif;
}
.logged-in-as::after {
    content: '';
    display: block;
    width: 112px;
    height: 4px;
    background: #b8b8b8;
    position: relative;
    top: -13px;
    left: unset;
    margin-left: 235px;
}
#cancel-comment-reply-link{
    font-size: 14px;
}
.sidebar .widget a:hover{
	color:#feb500
}
<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 3){ ?>
@media (min-width: 768px){
.comment-layout-three .list-comments .children{
    margin-left: 100px;	
}
.single-product .comment-layout-three .list-comments .children{
    margin-left: 0;	
}
}
.comment-notes{
	margin-bottom:35px;
	font-size:13px;
}
.logged-in-as a{
	font-size:13px;
	font-style:italic;	
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	font-size:13px;
	font-style:italic;
	text-transform: capitalize;
}

<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 4){ ?>
@media (min-width: 768px){
.comment-layout-four .list-comments .children .comment-item-4{
    padding-left: 70px;	
}
.single-product .comment-layout-four .list-comments .children .comment-item-4{
    padding-left: 0;	
}
}
.comment-layout-four .list-comments .children{
	margin-left:0;
}
.comment-item-4{
	padding-bottom: 37px;
    margin-bottom: 37px;
    border-bottom: 1px solid #eeeeee;		
}
.comment-notes{
	margin-bottom:35px;
	font-size:11px;
	color: inherit;		
	font-weight: 600;
}
.logged-in-as a{
	color: inherit;	
	font-size:11px;
    font-weight: 600;
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	color: inherit;	
	font-size:11px;
	text-transform: capitalize;
    font-weight: 600;	
}
<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 5){ ?>
@media (min-width: 768px){
.comment-layout-five .children{
    padding-left: 90px;	
}
.single-product .comment-layout-five .children{
    padding-left: 0;	
}
}
.comment-layout-five .list-comments .children{
	margin-left:0;
}

.comment-notes{
    font-size: 13px;
    font-style: italic;
    font-weight: 600;
    font-family: Poppins, san-serif;
}
.logged-in-as a{
    font-size: 13px;
    font-style: italic;
    font-weight: 600;
    font-family: Poppins, san-serif;
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	text-transform: capitalize;
    font-size: 13px;
    font-style: italic;
    font-weight: 600;
    font-family: Poppins, san-serif;
}
<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 6){ ?>
@media (min-width: 768px){
.comment-layout-six .list-comments .children{
    margin-left: 100px;	
}
.single-product .comment-layout-six .list-comments .children{
    margin-left: 0;	
}
}
.comment-notes{
	margin-bottom:35px;
	font-size:18px;
    font-family: 'Josefin Sans', sans-serif;	
	font-style: italic;	
	font-weight: 500;
}
.logged-in-as a{
	font-size:18px;
	font-style: italic;
    font-weight: 500;
    font-family: 'Josefin Sans', sans-serif;
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	font-size:18px;
	font-style:italic;
	text-transform: capitalize;
	font-family: 'Josefin Sans', sans-serif;
    font-weight: 500;	
}

<?php } ?>
<?php if( is_single() || (is_page() && !is_page_template( 'page-vc.php' )) ){ ?>
 table{
     width:100%;
     border: 1px solid #dee2e6;
     margin-bottom:20px;
}
 table a{
     color:#000;
     padding:5px;
     border-radius: 5px;
}
table th, table td {
     padding: 9px 12px;
     vertical-align: top;
     border-top: 1px solid #dee2e6;
	 display:table-cell;
}
.sidebar table th, .sidebar table td {
     padding: 7.8px;
}
table thead th{
     vertical-align: bottom;
     border-bottom: 2px solid #dee2e6;
}
table tbody + tbody{
     border-top: 2px solid #dee2e6;
}
table tbody tr:nth-of-type(odd){
     background-color: rgba(185, 176, 156, 0.36);
}
table tfoot tr:nth-of-type(odd) {
    background-color: rgba(185, 176, 156, 0.36);
}
h1, h2, h3, h4, h5, h6 {
    margin-top: .5rem;
}
<?php } ?>
<?php if(ronby_get_option('ronby_blog_post_layout') == 1){ ?>
@media only screen and (max-width: 768px) {
.page-header-1 .page-header-title{
	 line-height: 40px;
}
.margin-bottom-20{
	margin-bottom:20px;
}	
} 
<?php } ?>
<?php if(!empty($ronby_blog_page_brand_slider_bg_color)){ ?>
.brands-carousel,.section-brands-carousel-2{
	background-color:<?php echo esc_attr($ronby_blog_page_brand_slider_bg_color); ?>
}
<?php } ?>
<?php if(ronby_get_option('ronby_footer_top_columns') == 1){ ?>
#footer .subscription-widget-one .search-form button{
	left: 95.1%;
}
<?php }elseif(ronby_get_option('ronby_footer_top_columns') == 2){ ?>
#footer .subscription-widget-one .search-form button{
	left: 89.9%;
}
<?php }elseif(ronby_get_option('ronby_footer_top_columns') == 3){ ?>
#footer .subscription-widget-one .search-form button{
	left: 84.5%;
}
<?php }elseif(ronby_get_option('ronby_footer_top_columns') == 4){ ?>
#footer .subscription-widget-one .search-form button{
	left: 79%;
}
<?php }elseif(ronby_get_option('ronby_footer_top_columns') == 5){ ?>
#footer .subscription-widget-one .search-form button{
	left: 73%;
}
<?php } ?>
<?php if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {  ?>
.shop-single-product-layout .logged-in-as{
	margin-bottom:0px;
}
<?php } ?>
<?php if(ronby_get_option('ronby_shop_page_layout') == 1){ ?>
.comment-notes{
	margin-bottom:35px;
	font-size:13px;
	font-family: Poppins, san-serif;
	font-style: italic;	
	font-weight: 500;
}
.logged-in-as a{
	font-size:13px;
	font-family: Poppins, san-serif;
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	font-size:13px;
	font-family: Poppins, san-serif;
}
.comment-reply-link{
	font-size:13px;
	font-weight:500;
	font-family: Poppins, san-serif;
}
<?php } ?>
<?php if(ronby_get_option('ronby_shop_page_layout') == 2){ ?>
.comment-notes{
	margin-bottom:35px;
	font-size:18px;
	font-family: 'Josefin Sans', sans-serif;
	font-style: italic;	
	font-weight: 500;
}
.logged-in-as a{
	font-size:18px;
	font-weight:500;
	font-family: 'Josefin Sans', sans-serif;
}
.logged-in-as{
	margin-bottom:30px;
}
#cancel-comment-reply-link{
	font-size:18px;
	font-weight:500;
	font-family: 'Josefin Sans', sans-serif;
}
.comment-reply-link{
	font-size:18px;
	font-weight:500;
	font-family: 'Josefin Sans', sans-serif;
}
<?php } ?>
<?php if($ronby_single_product_bg_color){ ?>
.product-item-1 .thumbnail,.product-item-3 .thumbnail,.product-item-4 .thumbnail{
	background-color:<?php echo esc_attr($ronby_single_product_bg_color);?>
}
<?php } ?>
<?php if(ronby_get_option('ronby_woo_product_sale_badge_style') == 1){ ?>
.products .ribbon .ribbon-wrap {
   width: 100%;
   height: 188px;
   position: absolute;
   top: -8px;
   left: 8px;
   overflow: hidden;
}
.products .ribbon .ribbon-wrap:before,.products .ribbon .ribbon-wrap:after {
   content: ""; 
   position: absolute;
}
.products .ribbon .ribbon-wrap:before {
   width: 40px;
   height: 8px;
   right: 100px;
   background: #716766;
   border-radius: 8px 8px 0px 0px;
}
.products .ribbon .ribbon-wrap:after {
   width: 8px;
   height: 40px;
   right: 0px;
   top: 100px;
   background: #716766;
   border-radius: 0px 8px 8px 0px;
}
.products  .item-badge-red {
	width: 200px;
	height: 40px;
	line-height: 40px;
	position: absolute;
	top: 30px;
	right: -50px;
	z-index: 2;
	overflow: hidden;
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
	text-align: center;
	color: #fff;
	font-size: 17px;
}
@media (min-width: 500px) {
.products .ribbon{
    width: 48%;
  }
}
<?php }elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 2){ ?>
.ribbon1 {
  position: absolute;
  top: -6.1px;
  right: 10px;
  z-index:9;
}
.ribbon1::after {
	position: absolute;
    content: "";
    width: 0;
    height: 0;
    border-left: 45px solid transparent;
    border-right: 45px solid transparent;
    border-top: 10px solid #FFB235;
    right: 0px;
}
.ribbon1 span {
  position: relative;
  display: block;
  text-align: center;
  background: #FFB235;
  font-size: 14px;
  line-height: 1;
  padding: 12px 8px 10px;
  border-top-right-radius: 8px;
  width: 90px;
}
.ribbon1 span::before, .ribbon1 span::after {
  position: absolute;
  content: "";
}
.ribbon1 span::before {
 height: 6px;
 width: 6px;
 left: -6px;
 top: 0;
 background: #E5A02F;
}
.ribbon1 span::after {
 height: 6px;
 width: 8px;
 left: -8px;
 top: 0;
 border-radius: 8px 8px 0 0;
 background: #E5A02F;
}
<?php }elseif(ronby_get_option('ronby_woo_product_sale_badge_style') == 3){  ?>
.ribbon2 {
 width: 60px;
 padding: 10px 0;
 position: absolute;
 top: -6px;
 left: 25px;
 text-align: center;
 border-top-left-radius: 3px;
 background: #F47530;
 z-index: 9;
}
.ribbon2::before {
 height: 0;
 width: 0;
 right: -5.5px;
 top: 0.1px;
 border-bottom: 6px solid #8D5A20;
 border-right: 6px solid transparent;
}
.ribbon2::before, .ribbon2::after {
  content: "";
  position: absolute;
}
.ribbon2::after {
  height: 0;
  width: 0;
  bottom: -29.5px;
  left: 0;
  border-left: 30px solid #F47530;
  border-right: 30px solid #F47530;
  border-bottom: 30px solid transparent;
}
<?php } ?>
<?php if( (isset($_COOKIE['ft_sticky_menu']) && (int)$_COOKIE['ft_sticky_menu']==1) || ((!isset($_COOKIE['ft_sticky_menu'])) && (ronby_get_option('ronby_sticky_menu_switch') == 1)) ) { ?>
		#header .header-nav.vhidden, #header .header-nav.vhidden ul, #header .header-nav.vhidden li, #header .header-nav.vhidden li a,
		#header .header-nav.vhidden .navbar-brand{
			visibility: hidden !important;
			 -webkit-transition-timing-function: ease-out;
			transition-timing-function: ease-out;
			-webkit-transition: .5s;
			transition: .5s;
		}
		.nav-mobile.navigation-mobile.vshow,
		.nav-mobile.navigation-mobile.vhidden, .nav-mobile.navigation-mobile.vhidden li, .nav-mobile.navigation-mobile.vhidden li a,
		.nav-mobile.navigation-mobile.vhidden .navbar-brand,
		#header .header-nav.vshow{
			visibility: visible !important;
			 -webkit-transition-timing-function: ease-in;
			transition-timing-function: ease-in;
			-webkit-transition: .3s;
			transition: .3s;
		}
		@media screen and (min-width: 992px) and (max-width: 1299px){
		.medical-header-used #header .header-nav.vshow{
			visibility: hidden !important;
		}
		}
<?php } ?>
<?php if( (isset($_COOKIE['ft_footer_type']) && (int)$_COOKIE['ft_footer_type']==1) || ((!isset($_COOKIE['ft_footer_type'])) && (ronby_get_option('ronby_sticky_footer_switch') == 1)) ) { ?>
@media screen and (min-width: 1200px){
.sticky-footer-sentinel.height-applied + .footer-stuck {
	margin: 0;
	position: fixed;
	bottom: 0;
	left: 0;
	right: 0;
	opacity: 0;
	visibility: hidden;
	z-index: 0;
}
.ronby-page-post-page, #content, section.brands-carousel, section.blog-page-business-steps{
    z-index: 1;
    position: relative;
}
}
<?php } ?>
<?php if(isset($_COOKIE['ft_main_color'])) { ?>
	h2.section-title span,
	.class-description,
	.member-role i,
	.stars-rating[data-rate="5"] span, .stars-rating li,
	.article-with-overlay-1 .overlay-content.text-center span,
	.section-header-style-4 .section-sub-title,
	.article-box-with-icon-2 .item-link,
	.section-header-style-3 .section-sub-title.color-secondary,
	.layout-4 #slide-4-layer-8,
	.layout-2 #slide-1-layer-2,
	.layout-2 #slide-2-layer-2,
	.layout-2 #slide-3-layer-2,
	.layout-6 #slide-7-layer-2,
	.layout-6 #slide-8-layer-2,
	.layout-4 .ronby-recent-post-widget .post-title.hover-color-primary{
		color: <?php echo esc_attr($_COOKIE['ft_main_color']); ?> !important;
	}
	.fitness-section-feature-products .ribbon6{
		background-color: <?php echo esc_attr($_COOKIE['ft_main_color']); ?> !important;
		box-shadow: 0 0 0 3px <?php echo esc_attr($_COOKIE['ft_main_color']); ?>, 0px 21px 5px -18px rgba(0,0,0,0.6) !important;
	}
	.plan-item .button,
	.fitness-section-timetable .showall,
	.fitness-section-timetable .tab.active,
	#fashion-newsletter .button-secondary,
	.ribbon2, .page-header-1 .page-header-breadcrumb,
	.subscription-widget-one .background-secondary,
	#slide-2-layer-9, .vc_row.vc_custom_1555050944796,
	.vc_custom_1557295467859,
	.post-carousel-3 .background-secondary,
	.tesimonial-slider-1 .fas.fa-caret-left.background-primary,
	.tesimonial-slider-1 .fas.fa-caret-right.background-primary,
	.layout-4 #slide-3-layer-8:hover,
	.layout-4 #slide-4-layer-8:hover,
	.layout-2 #slide-1-layer-5,
	.layout-2 #slide-2-layer-5,
	.layout-2 #slide-3-layer-5,
	.layout-6 #slide-8-layer-14,
	.layout-6 #slider-4-layer-25,
	.layout-6 #slider-4-layer-26,
	.layout-6 .tparrows,
	.medical_trifold_flyer .bg-color-0098f1,
	.medical_trifold_flyer .bg-color-0085d3,
	.medical_trifold_flyer .bg-color-0074b8,
	.team-detail-header .col-lg-4.text-right,
	.section-we-provide-services .button-secondary{
		background-color: <?php echo esc_attr($_COOKIE['ft_main_color']); ?> !important;
	}
	.layout-4 #slide-3-layer-8,
	.layout-4 #slide-4-layer-8{
		border-color: <?php echo esc_attr($_COOKIE['ft_main_color']); ?> !important;
	}
	.ribbon2::after{
		border-left: <?php echo esc_attr($_COOKIE['ft_main_color']); ?> !important;
		border-right: <?php echo esc_attr($_COOKIE['ft_main_color']); ?> !important;
	}
	.section-header-style-6 {
		margin: 0 0 0px;
		background: none;
	}
	.layout-1 .button-secondary:hover,
	.layout-4 #slide-4-layer-8:hover,
	#construction_contact_form label{
		color: #fff !important;
	}
	.tesimonial-slider-1 .item .item-title.color-primary{
		color: #fbd03b !important;
	}
	.tesimonial-slider-1 .fas.fa-caret-left.background-primary{
		background: #fbd03b !important;
	}
	.medical_trifold_flyer .bg-color-0098f1{
		opacity: 0.8;
	}
	.medical_trifold_flyer .bg-color-0085d3{
		opacity: 0.9;
	}
	.layout-6 #slide-7-layer-10 img{
		display: none !important;
	}
	.layout-6 #slide-7-layer-10{
		background: transparent !important;
	}
<?php } ?>
</style>	
<?php }
add_action( 'wp_head', 'ronby_styles_custom', 100 );
?>