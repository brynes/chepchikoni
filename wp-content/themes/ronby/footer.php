<!-- Footer -->
<?php
if ( is_active_sidebar( 'footer_1st_column_widgets' ) || is_active_sidebar( 'footer_2nd_column_widgets' ) || is_active_sidebar( 'footer_3rd_column_widgets' ) || is_active_sidebar( 'footer_4th_column_widgets' ) || is_active_sidebar( 'footer_5th_column_widgets' ) ) {
?>
<?php if( (isset($_COOKIE['ft_footer_type']) && (int)$_COOKIE['ft_footer_type']==1) || ((!isset($_COOKIE['ft_footer_type'])) && (ronby_get_option('ronby_sticky_footer_switch') == 1)) ) { ?>
<div class="sticky-footer-sentinel height-applied"></div>
<div class="main-footer footer-stuck">
<?php } ?>
<footer id="footer" class="<?php if(function_exists('ronby_footer_class')){ echo ronby_footer_class();} ?>">
    <div class="overlay">
        <div class="container">
            <div class="inner-content">
                <div class="row">
				<?php 
				if(function_exists('ronby_footer_top_columns')){
				   echo ronby_footer_top_columns();
				}
				?>          
                </div>
            </div>
        </div>
    </div>
</footer>
<?php } ?>
<!-- /Footer -->
<!-- Copyright -->
<div class="copyright text-center">
    <div class="container"> 
				<?php 
				if(function_exists('ronby_footer_bottom_columns')){
				   echo ronby_footer_bottom_columns();
				}
				?>  
	</div>
</div>
<?php if( (isset($_COOKIE['ft_footer_type']) && (int)$_COOKIE['ft_footer_type']==1) || ((!isset($_COOKIE['ft_footer_type'])) && (ronby_get_option('ronby_sticky_footer_switch') == 1)) ) { ?>
</div>
<?php } ?>
<!-- /Copyright -->
</div>
<!-- End Page -->
<?php
wp_footer();	
?>
</body>
</html>