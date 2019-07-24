<?php 
// **********************************************************************// 
// ! Ronby Footer Column Function
// **********************************************************************//
function ronby_footer_top_columns(){
	if(ronby_get_option('ronby_footer_top_columns') == 1){ ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_1st_column_widgets' ) ) {
			dynamic_sidebar( 'footer_1st_column_widgets' );
		}
	?>
	</div>				
<?php	} elseif(ronby_get_option('ronby_footer_top_columns') == 2){ ?>
	<div class="col-md-6 col-sm-12 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_1st_column_widgets' ) ) {
			dynamic_sidebar( 'footer_1st_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-6 col-sm-12 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_2nd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_2nd_column_widgets' );
		}
	?>
	</div>		
<?php	} elseif(ronby_get_option('ronby_footer_top_columns') == 3){ ?>
	<div class="col-md-4 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_1st_column_widgets' ) ) {
			dynamic_sidebar( 'footer_1st_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-4 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_2nd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_2nd_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-4 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_3rd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_3rd_column_widgets' );
		}
	?>
	</div>		
<?php	} elseif(ronby_get_option('ronby_footer_top_columns') == 4){ ?>
	<div class="col-md-3 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_1st_column_widgets' ) ) {
			dynamic_sidebar( 'footer_1st_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_2nd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_2nd_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_3rd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_3rd_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12">
	<?php 
		if ( is_active_sidebar( 'footer_4th_column_widgets' ) ) {
			dynamic_sidebar( 'footer_4th_column_widgets' );
		}
	?>
	</div>		
<?php	} elseif(ronby_get_option('ronby_footer_top_columns') == 5){ ?>
	<div class="col-md-3 col-sm-6 col-xs-12 width-20-p">
	<?php 
		if ( is_active_sidebar( 'footer_1st_column_widgets' ) ) {
			dynamic_sidebar( 'footer_1st_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12 width-20-p">
	<?php 
		if ( is_active_sidebar( 'footer_2nd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_2nd_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12 width-20-p">
	<?php 
		if ( is_active_sidebar( 'footer_3rd_column_widgets' ) ) {
			dynamic_sidebar( 'footer_3rd_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12 width-20-p">
	<?php 
		if ( is_active_sidebar( 'footer_4th_column_widgets' ) ) {
			dynamic_sidebar( 'footer_4th_column_widgets' );
		}
	?>
	</div>	
	<div class="col-md-3 col-sm-6 col-xs-12 width-20-p">
	<?php 
		if ( is_active_sidebar( 'footer_5th_column_widgets' ) ) {
			dynamic_sidebar( 'footer_5th_column_widgets' );
		}
	?>
	</div>	
<?php	}
}

/******************************************
function for Detect footer class of footer 
*******************************************/
function ronby_footer_class(){
if(ronby_get_option('ronby_footer_layout_style') == 1){
	return "footer-1";
} elseif(ronby_get_option('ronby_footer_layout_style') == 2){
	return "footer-2";
} elseif(ronby_get_option('ronby_footer_layout_style') == 3){
	return "footer-3";
} elseif(ronby_get_option('ronby_footer_layout_style') == 4){
	return "footer-4";
} elseif(ronby_get_option('ronby_footer_layout_style') == 5){
	return "footer-5";
} elseif(ronby_get_option('ronby_footer_layout_style') == 6){
	return "footer-6";
}	
}

/******************************************
Ronby Footer Bottom Columns
*******************************************/
function ronby_footer_bottom_columns(){
if(ronby_get_option('ronby_footer_bottom_columns') == 1){ ?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 text-center">
		<?php if(ronby_get_option('copy_text') != ''){ ?>
		<span><?php echo esc_attr(ronby_get_option('copy_text'));?></span>
		<?php } else { ?>
		<span><?php esc_html_e('Ronby - Copyright 2019. Developed by Fluent-Themes','ronby'); ?></span>
		<?php } ?>
	</div>				
</div>				
<?php	} elseif(ronby_get_option('ronby_footer_bottom_columns') == 2){ ?>
<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12 text-left">
		<span><?php echo esc_attr(ronby_get_option('copy_text'));?></span>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12 text-right">
		<img src="<?php echo esc_url(ronby_get_option('payment_methods_image')['url']); ?>" alt="<?php esc_attr_e('copyright-image', 'ronby'); ?>"/>
	</div>
</div>	
<?php }	
}