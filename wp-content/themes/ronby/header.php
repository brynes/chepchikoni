<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <?php global $redux; if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { if( isset($redux['ronby_favicon']['url']) && !empty($redux['ronby_favicon']['url'])) { ?>
    <link rel="shortcut icon" href="<?php echo esc_url($redux['ronby_favicon']['url']); ?>">
    <?php } } ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
    <!-- Start Page -->
    <div id="wrapper">
<?php if(function_exists( 'ronby_header_menu_function' ))ronby_header_menu_function(); ?>