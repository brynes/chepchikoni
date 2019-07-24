<?php
// Register Sidebar
function ronby_widgets_init() {
		register_sidebar( array(
		'name' => esc_html__( 'Blog Sidebar Widgets', 'ronby'),
		'id' => 'ronby_sidebar_widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => esc_html__( 'Footer 1st Column Widgets', 'ronby'),
		'id' => 'footer_1st_column_widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => esc_html__( 'Footer 2nd Column Widgets', 'ronby'),
		'id' => 'footer_2nd_column_widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => esc_html__( 'Footer 3rd Column Widgets', 'ronby'),
		'id' => 'footer_3rd_column_widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => esc_html__( 'Footer 4th Column Widgets', 'ronby'),
		'id' => 'footer_4th_column_widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => esc_html__( 'Footer 5th Column Widgets', 'ronby'),
		'id' => 'footer_5th_column_widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );		
}
add_action( 'widgets_init', 'ronby_widgets_init' );