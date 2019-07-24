<?php
// **********************************************************************// 
// ! Custom Walker for wp_nav_menu()
// **********************************************************************//
class ronby_walker_nav_menu extends Walker_Nav_Menu {

private $blog_sidebar_pos = "";
// add classes to ul sub-menus
public function start_lvl( &$output, $depth = 0, $args = Array() ) {
    // depth dependent classes
    $indent = str_repeat( "\t", $depth );
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        ( $display_depth == 1  ? 'sub-menu' : '' ),
		( $display_depth % 2  ? '' : 'sub-menu' ),
        ( $display_depth >=2 ? '' : '' ),
        'menu-depth-' . $display_depth
        );
    $class_names = implode( ' ', $classes );
	$output .= "\n$indent<ul role=\"menu\" class=\"$class_names\" >\n";
}
  
// add main/sub classes to li's and links
public function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {
    global $wp_query;
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
  
    /**
			 * Dividers, Headers or Disabled
			 * =============================
			 * Determine whether the item is a Divider, Header, Disabled or regular
			 * menu item. To prevent errors we use the strcasecmp() function to so a
			 * comparison that is not case sensitive. The strcasecmp() function returns
			 * a 0 if the strings are equal.
			 */
			if ( 0 === strcasecmp( $item->attr_title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->attr_title, 'dropdown-header' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} elseif ( 0 === strcasecmp( $item->attr_title, 'disabled' ) ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
				$value = '';
				$class_names = $value;
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID .' ';
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
					
				if ( $args->has_children ) {
					$class_names .= '  ';
				}

				if ( in_array( 'current-menu-item', $classes, true ) ) {
					$class_names .= '';
	
				}
				if( $depth == 1) {
					$class_names .= 'submenu-item';
				}
				if( $depth == 2) {
					$class_names .= 'submenu-item';
				}				
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
   
				$output .= $indent . '<li ' . $id . $value . $class_names . '>';
				
				$atts = array();

				if ( empty( $item->attr_title ) ) {
					$atts['title']  = ! empty( $item->title )   ? strip_tags( $item->title ) : '';
				} else {
					$atts['title'] = $item->attr_title;
				}
 
				$atts['target'] = ! empty( $item->target ) ? $item->target : '';
				$atts['rel']    = ! empty( $item->xfn )    ? $item->xfn    : '';
				$home_url = home_url();
				// If item has_children add atts to a.

				// If item has_children add atts to a.
				if ( $args->has_children && 0 === $depth && empty( $item->url ) ) {
					$atts['href']           = '#';
					$atts['data-toggle']    = '';
					$atts['class']          = '';
					$atts['aria-expanded']  = 'false';
				} elseif ( $args->has_children && 0 === $depth && ! empty( $item->url ) ) {
					$atts['href']           = $item->url;
					$atts['class']          = '';
					$atts['aria-expanded']  = 'false';
				} elseif ( $args->has_children && 1 === $depth && ! empty( $item->url ) ) {
					$atts['href']           = $item->url;
					$atts['class']          = '';
					$atts['aria-expanded']  = 'false';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}
				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
				$item_output = $args->before;

				/*
				 * Glyphicons/Font-Awesome
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */
				 
				if( 'mega-menu' == $item->object ){
					$megamenu_item = get_post( $item->object_id );
					$item_output .= '' . apply_filters( 'the_content', $megamenu_item->post_content ) . '';
				}else{
					$item_output .= '<a' . $attributes . ' class="">';
					if ( ! empty( $item->title ) && ! empty( $item->ID ) ) {
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					}
					if ( $args->has_children && 0 === $depth ){
					$item_output .= '</a>';
					} elseif ( $args->has_children && 1 === $depth ){
					$item_output .= '</a>';
					} else {
					$item_output .= '</a>';
					}
					$item_output .= $args->after;
				}
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				
				
			} // End if().
		}
		
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
}
 //End Walker_Nav_Menu

//Start walker Mobile Nav 
class ronby_walker_nav_menu_mobile extends Walker_Nav_Menu {

private $blog_sidebar_pos = "";
// add classes to ul sub-menus
public function start_lvl( &$output, $depth = 0, $args = Array() ) {
    // depth dependent classes
    $indent = str_repeat( "\t", $depth );
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        ( $display_depth == 1  ? 'sub-menu' : 'sub-menu' ),
		( $display_depth % 2  ? 'dropdown-menu' : 'dropdown-menu show' ),
        ( $display_depth >=2 ? '' : '' ),
        'menu-depth-' . $display_depth
        );
    $class_names = implode( ' ', $classes );
	$output .= "\n$indent<ul role=\"menu\" class=\"$class_names\" >\n";
}
  
// add main/sub classes to li's and links
public function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {
    global $wp_query;
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
  
    /**
			 * Dividers, Headers or Disabled
			 * =============================
			 * Determine whether the item is a Divider, Header, Disabled or regular
			 * menu item. To prevent errors we use the strcasecmp() function to so a
			 * comparison that is not case sensitive. The strcasecmp() function returns
			 * a 0 if the strings are equal.
			 */
			if ( 0 === strcasecmp( $item->attr_title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->attr_title, 'dropdown-header' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} elseif ( 0 === strcasecmp( $item->attr_title, 'disabled' ) ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
				$value = '';
				$class_names = $value;
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID .' ';
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
					
				if ( $args->has_children ) {
					$class_names .= ' dropdown  ';
				}

				if ( in_array( 'current-menu-item', $classes, true ) ) {
					$class_names .= '';
	
				}
				if( $depth == 1) {
					$class_names .= 'submenu-item';
				}
				if( $depth == 2) {
					$class_names .= 'submenu-item';
				}				
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
   
				$output .= $indent . '<li ' . $id . $value . $class_names . '>';
				
				$atts = array();

				if ( empty( $item->attr_title ) ) {
					$atts['title']  = ! empty( $item->title )   ? strip_tags( $item->title ) : '';
				} else {
					$atts['title'] = $item->attr_title;
				}
 
				$atts['target'] = ! empty( $item->target ) ? $item->target : '';
				$atts['rel']    = ! empty( $item->xfn )    ? $item->xfn    : '';
				$home_url = home_url();

				// If item has_children add atts to a.

				if ( $args->has_children && 0 === $depth && empty( $item->url ) ) {
					$atts['href']           = '#';
					$atts['data-toggle']    = 'dropdown';
					$atts['class']          = 'dropdown-toggle';
					$atts['aria-expanded']  = 'false';
				} elseif ( $args->has_children && 0 === $depth && ! empty( $item->url ) ) {
					$atts['href']           = $item->url;
					$atts['data-toggle']    = 'dropdown';					
					$atts['class']          = 'dropdown-toggle';
					$atts['aria-expanded']  = 'false';
				} elseif ( $args->has_children && 1 === $depth && ! empty( $item->url ) ) {
					$atts['href']           = $item->url;
					$atts['data-toggle']    = 'dropdown';
					$atts['class']          = 'dropdown-toggle';
					$atts['aria-expanded']  = 'false';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';	
				}

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
				$item_output = $args->before;

				/*
				 * Glyphicons/Font-Awesome
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */
				 
				if( 'mega-menu' == $item->object ){
					$megamenu_item = get_post( $item->object_id );
					$item_output .= '' . apply_filters( 'the_content', $megamenu_item->post_content ) . '';
				}else{
					$item_output .= '<a' . $attributes . ' >';
					if ( ! empty( $item->title ) && ! empty( $item->ID ) ) {
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					}
					if ( $args->has_children && 0 === $depth ){
					$item_output .= '</a>';
					} elseif ( $args->has_children && 1 === $depth ){
					$item_output .= '</a>';
					} else {
					$item_output .= '</a>';
					}
					$item_output .= $args->after;
				}
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				
				
			} // End if().
		}
		
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
}
//End Nav Mobile Nav

/***********************************
Detect body class for main menu function
************************************/
function ronby_main_menu_class(){
if(ronby_get_option('ronby_site_layout_style') == 1){
	return "layout-1";
}elseif(ronby_get_option('ronby_site_layout_style') == 2){
	return "layout-2";
}elseif(ronby_get_option('ronby_site_layout_style') == 3){
	return "layout-3";
}elseif(ronby_get_option('ronby_site_layout_style') == 4){
	return "layout-4";
}elseif(ronby_get_option('ronby_site_layout_style') == 5){
	return "layout-5";
}elseif(ronby_get_option('ronby_site_layout_style') == 6){
	return "layout-6";
}	
}

/*************************
Start header menu function
*************************/
function ronby_header_menu_function(){
if( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 1)) ){ ?>
        <!-- Nav mobile -->
        <nav class="nav-mobile navigation-mobile d-lg-none navbar navbar-expand-lg navbar-light">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url']) ) { ?>
                        <?php 
						$bdy_classes = ronby_main_menu_class();
						if(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1 && ($bdy_classes == 'layout-3')) { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1 && ($bdy_classes == 'layout-4')) { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1 && ($bdy_classes == 'layout-6')) { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } else { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } ?>
						<?php } else { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-business.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } ?>
			<?php } ?>			
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-toggle-nav" aria-controls="mobile-toggle-nav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="mobile-toggle-nav">
                <div class="menu-mobile">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'no-style menu navbar-nav', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu_mobile ) 
								); 
								} ?>
                </div>
            </div>
        </nav>
        <!-- /Nav mobile -->
        <!-- Header -->
        <div id="header" class="header-1">
            <div class="hidden-search-form">
                <div class="overlay-absolute">
                    <div class="srch_close">
							<span class="form-close">
								<i class="fas fa-times-circle"></i>
							</span>
					</div>
					<div class="search-form">
                        <form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="form-group-with-button">
                                <input class="form-element-styled form-group-input"   id="s1" type="text" placeholder="<?php esc_attr_e('Enter keywords', 'ronby'); ?>"  name="s" maxlength="100">
                                <button class="form-group-button background-primary color-inverse" type="submit"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		<?php if(ronby_get_option('ronby_header_top_menu_switch') == 1) { ?>	
            <!-- Header top -->
            <div class="header-top d-none d-xl-block">
                <div class="container">
                    <div class="row flex-wrap align-items-center justify-content-between">
                        <div class="col-auto">
                            <ul class="list-contact-infomations no-style items-inline-block">
							<?php if(ronby_get_option('ronby_header_top_menu_phone') !='') { ?>
                                <li>
                                    <a href="tel:<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_phone'));?>" class="no-color"> <i class="fas fa-phone"></i> <?php echo esc_attr(ronby_get_option('ronby_header_top_menu_phone'));?></a>
                                </li>
							<?php } ?>	
							<?php if(ronby_get_option('ronby_header_top_menu_email') !='') { ?>
                                <li>
                                    <a href="mailto:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_email')));?>" class="no-color"> <i class="fas fa-envelope"></i> <?php echo esc_attr(ronby_get_option('ronby_header_top_menu_email'));?> </a>
                                </li>
							<?php } ?>
							<?php if(ronby_get_option('ronby_header_top_menu_address') !='') { ?>							
                                <li>
                                    <a class="no-color"> <i class="fas fa-map-marker"></i> <?php echo esc_attr(ronby_get_option('ronby_header_top_menu_address'));?> </a>
                                </li>
							<?php } ?>								
                            </ul>
                        </div>
						<?php if((ronby_get_option('social_facebook')) || (ronby_get_option('social_twitter')) || (ronby_get_option('social_pinterest')) || (ronby_get_option('social_linkedin'))) { ?>
                        <div class="col-lg-auto d-none d-lg-block">
                            <div class="social-1">
                                <ul class="no-style items-inline-block">
							<?php if(ronby_get_option('social_facebook') !='') { ?>
                                    <li class="animate-200 hover-background-secondary hover-color-white">
                                        <a href="<?php echo esc_url(ronby_get_option('social_facebook'));?>" class="no-color"> <i class="fab fa-facebook-f"></i> </a>
                                    </li>
							<?php } ?>		
							<?php if(ronby_get_option('social_twitter') !='') { ?><li class="animate-200 hover-background-secondary hover-color-white">
                                        <a href="<?php echo esc_url(ronby_get_option('social_twitter'));?>" class="no-color"> <i class="fab fa-twitter"></i> </a>
                                    </li>
							<?php } ?>	
							<?php if(ronby_get_option('social_pinterest') !='') { ?>		<li class="animate-200 hover-background-secondary hover-color-white">
                                        <a href="<?php echo esc_url(ronby_get_option('social_pinterest'));?>" class="no-color"> <i class="fab fa-pinterest-p"></i> </a>
                                    </li>
							<?php } ?>
							<?php if(ronby_get_option('social_linkedin') !='') { ?>		<li class="animate-200 hover-background-secondary hover-color-white">
                                        <a href="<?php echo esc_url(ronby_get_option('social_linkedin'));?>" class="no-color"> <i class="fab fa-linkedin"></i> </a>
                                    </li>
							<?php } ?>		
                                </ul>
                            </div>
                        </div>
						<?php } ?>
						<?php if((ronby_get_option('ronby_header_top_menu_btn_label')) ) { ?>
                        <div class="col-lg-auto d-none d-lg-block"> <a href="<?php echo esc_url(ronby_get_option('ronby_header_top_menu_btn_link'));?>" class="button button-secondary button-flat"><?php echo esc_attr(ronby_get_option('ronby_header_top_menu_btn_label'));?></a></div>
						<?php } ?>
                    </div>
                </div>
            </div>
            <!-- /Header top -->
		<?php } ?>
            <!-- Header nav -->
            <div class="header-nav">
                <div class="container">
                    <div class="row flex-wrap align-items-center d-none d-lg-flex">
                        <div class="col-auto mr-auto">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo custm_logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                        <?php 
						$bdy_classes = ronby_main_menu_class();
						if(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1 && ($bdy_classes == 'layout-3')) { ?>
						<div class="logo thm_opt_logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1 && ($bdy_classes == 'layout-4')) { ?>
						<div class="logo thm_opt_logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==1 && ($bdy_classes == 'layout-6')) { ?>
						<div class="logo thm_opt_logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } else { ?>
						<div class="logo thm_opt_logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } ?>
						<?php } else { ?>
						<div class="logo thm_logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-business.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						<?php } ?>
			<?php } ?>
                        </div>
                        <div class="col-auto <?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ echo esc_attr('nopadding');}?>">
                            <div class="main-menu">
						
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'menu clearfix', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu ) 
								); 
								} ?>
                            </div>
                        </div>
				<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ ?>
					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
					<div class="col-auto nopadding">
						<div class="header-nav-icons main-menu">
							<ul class="no-style menu clearfix">
								<li>
									<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-shopping-basket">
										</i><span class="badge bg-secondary cart-badge text-white"><?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?></span>
									</a>
	<div class="sub-menu cart-box  menu-depth-1">									
			<div class="container">       
                          <div class="row">
                            <div class="col-sm-6"><a class="no-color nopadding cart-total-items"><?php
							if((WC()->cart->get_cart_contents_count()) <= 1 ){
							$item= esc_attr__(' Item','ronby');
							}else{
							$item= esc_attr(' Items');
							}
							echo esc_attr(WC()->cart->get_cart_contents_count()); echo esc_attr($item);
							?></a></div>
                            <div class="col-sm-6 text-right"> 
							<span class="woocommerce-Price-amount amount"><a class="no-color nopadding cart-total-price"><?php echo WC()->cart->get_cart_total();?></a></span> </div>
                          </div>
						  <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" title="View Cart" class="btn  btn-dark btn_small no-color text-white"><?php esc_html_e('View Cart','ronby');?></a> </div>
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'checkout' ) )); ?>" title="Check out" class="btn  btn-dark btn_small no-color float-right text-white"><?php esc_html_e('Checkout','ronby');?></a> </div>
                        </div>                      
			</div>
	</div>
								</li>
							</ul>
						</div>
					</div>
						<?php } ?>
						<?php } ?>
						<?php if(ronby_get_option('ronby_header_main_menu_search_btn_switch') == 1) {?>
                        <div class="col-auto">
                            <div class="nav-search-button hidden-search-form-toggler"> <i class="fas fa-search"></i> </div>
                        </div>
						<?php } ?>

                    </div>
                </div>

					
            </div>
            <!-- /Header nav -->
        </div>
        <!-- /Header -->
<?php }elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 2)) ){?>
<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn_switch') == 1){ ?>
		<!-- Style Customizer -->
		<section id="style-customizer" class="header-2-slide-nav">
		  <div class="style-customizer-wrap form-horizontal">
		    <div class="main-slide-header">
				
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?><aside id="media_image-5" class="widget widget_media_image">
			            <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
			</aside>
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
				<?php 
				$bdy_classes = ronby_main_menu_class();
				if(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-3')) { ?>
						<aside id="media_image-5" class="widget widget_media_image">
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						</aside>
				<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-4')) { ?>
						<aside id="media_image-5" class="widget widget_media_image">
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						</aside>
				<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-6')) { ?>
						<aside id="media_image-5" class="widget widget_media_image">
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
						</aside>
				<?php } else { ?>
			<aside id="media_image-5" class="widget widget_media_image">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                    </a>
                 </div>
			</aside>
			<?php } ?>
			<?php } else { ?>
			<aside id="media_image-5" class="widget widget_media_image">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-construction.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                    </a>
                </div>
			</aside>
			<?php } ?>
			<?php } ?>
			<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_desc') !=''){?>	
				<aside id="text-4" class="widget widget_text">
					<div class="textwidget">
						<p><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_desc')); ?></p>
					</div>
				</aside>   
			<?php } ?>		
			</div>
		    <div class="main-slide-content">
			<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_postal_address') !=''){?>	
				<aside id="custom_html-8" class="widget_text widget widget_custom_html"><div class="textwidget custom-html-widget"><div class="block-icon-text">
				<div class="icon-header"><i class="fas fa-id-card"></i></div>
				<div class="block-right">
				<h4 class="title"><?php echo esc_html__('Postal Address','ronby');?></h4>
				<p><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_postal_address')); ?></p>
				</div>
				</div>
				</div></aside>
			<?php } ?>	
			<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_telephone') !=''){?>	
				<aside id="custom_html-9" class="widget_text widget widget_custom_html">
					<div class="textwidget custom-html-widget">
						<div class="block-icon-text">
							<div class="icon-header"><i class="fas fa-tablet"></i></div>
							<div class="block-right">
								<h4 class="title"><?php echo esc_html__('Business Phones','ronby');?></h4>
								<p><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_telephone')); ?></p>
							</div>
						</div>
					</div>
				</aside>  
			<?php } ?>		
			</div>
			<div class="main-slide-footer">
				<aside>
				<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn1_label') !=''){ ?>
					<a href="<?php echo esc_url(ronby_get_option('ronby_header_main_menu_slide_nav_btn1_url')); ?>" class="button button-primary"><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_btn1_label')); ?></a> 
				<?php } ?>	
				<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn2_label') !=''){ ?>	
				<a href="<?php echo esc_url(ronby_get_option('ronby_header_main_menu_slide_nav_btn2_url')); ?>" class="btn btn-default"><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_btn2_label')); ?></a>
				<?php } ?>						
				</aside>
				<br><br>
			<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_copyright') !=''){?>				
				<aside id="text-5" class="widget widget_text">			
				<div class="textwidget"><p><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_copyright')); ?></p>
				</div>
				</aside> 
			<?php } ?>		
		</div>
		  </div>
			<a id="sc-toggle-close" title="Close Slide Navigation"><i class="fas fa-times-circle"></i></a>
		</section>
<?php } ?>		
		<!-- Nav mobile -->
			<nav class="nav-mobile  d-lg-none navbar navbar-expand-lg navbar-light">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			        <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                <?php
				$bdy_classes = ronby_main_menu_class();
				if(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-3')) { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
				<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-4')) { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
				<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-6')) { ?>
						<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
				<?php } else { ?>
					<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
				<?php } ?>
				<?php } else { ?>
					<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-construction.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-toggle-nav" aria-controls="mobile-toggle-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mobile-toggle-nav">
					<div class="menu-mobile">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'no-style menu navbar-nav', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu_mobile ) 
								); 
								} ?>
					</div>					
				</div>
			</nav>
		<!-- /Nav mobile -->
		
		<!-- Header -->
		<header id="header" class="header-2">

			<div class="hidden-search-form">
				<div class="overlay-absolute">
					<div class="srch_close">
							<span class="form-close">
								<i class="fas fa-times-circle"></i>
							</span>
					</div>
					<div class="search-form">
                        <form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="form-group-with-button">
                                <input class="form-element-styled form-group-input"   id="s1" type="text" placeholder="<?php esc_attr_e('Enter keywords', 'ronby'); ?>"  name="s" maxlength="100">
                                <button class="form-group-button background-primary color-inverse" type="submit"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		<?php if(ronby_get_option('ronby_header_top_menu_switch') == 1) { ?>
			<div class="header-top">
				<div class="container">
					<div class="position-relative">
						<div class="row">
						
						<?php if(ronby_get_option('ronby_header_top_menu_lang_switch') == 1) { ?>
						<div class="col-auto mr-auto">						
						<div class="language-bar">
								<form>
										<?php echo ronby_language_switch();?>
								</form>
								</div>
						</div>								
						<?php } ?>	
						
							<div class="col-auto">
								<div class="social-3 d-flex justify-content-end align-items-center">
									<ul class="list-unstyled mb-0">
							<?php if(ronby_get_option('social_facebook') !='') { ?>
                                    <li>
                                        <a href="<?php echo esc_url(ronby_get_option('social_facebook'));?>" class="no-color animated"> <i class="fab fa-facebook-f"></i><span class="d-none d-md-inline"><?php echo esc_html__('Facebook','ronby')?></span> </a>
                                    </li>
							<?php } ?>	
							<?php if(ronby_get_option('social_pinterest') !='') { ?>
                                    <li>
                                        <a href="<?php echo esc_url(ronby_get_option('social_pinterest'));?>" class="no-color animated"> <i class="fab fa-pinterest-p"></i><span class="d-none d-md-inline"><?php echo esc_html__('Pinterest','ronby')?></span> </a>
                                    </li>
							<?php } ?>											
							<?php if(ronby_get_option('social_twitter') !='') { ?>
                                    <li>
                                        <a href="<?php echo esc_url(ronby_get_option('social_twitter'));?>" class="no-color animated"> <i class="fab fa-twitter"></i><span class="d-none d-md-inline"><?php echo esc_html__('Twitter','ronby')?></span> </a>
                                    </li>
							<?php } ?>										

							<?php if(ronby_get_option('social_linkedin') !='') { ?>
                                    <li>
                                        <a href="<?php echo esc_url(ronby_get_option('social_linkedin'));?>" class="no-color animated"> <i class="fab fa-linkedin"></i><span class="d-none d-md-inline"><?php echo esc_html__('Linkedin','ronby')?></span> </a>
                                    </li>
							<?php } ?>
							
									</ul>								
								</div>							
							</div>							
						</div>
						<div class="follow-us-button">
							<a  class="button button-secondary"><?php echo esc_html__('Follow Us','ronby')?></a>
						</div>
					</div>
					
				</div>				
			</div>
		<?php } ?>
			<div class="header-main">
				<div class="container">
					<div class="row align-items-center">
						<div class="d-none d-lg-block col-auto mr-auto">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                    <?php
				$bdy_classes = ronby_main_menu_class();
				if(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-3')) { ?>
						<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
				<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-4')) { ?>
						<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
				<?php } elseif(isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==2 && ($bdy_classes == 'layout-6')) { ?>
						<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food-dark.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
				<?php } else { ?>
					<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
				<?php } ?>
			<?php } else { ?>
					<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-construction.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>
						</div>
						<div class="d-none d-md-block col-auto">
							<ul class="list-unstyled contact-infomation d-flex flex-wrap align-items-center justify-content-end">
								<?php if(ronby_get_option('ronby_header_top_menu_email') !='') { ?>
                                <li class="d-flex py-3 mr-4">
									<a href="mailto:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_email')));?>" class="icon">
										<span class="flaticon-message"></span>
									</a>
									<div>
										<div class="lb"><?php echo esc_html__('Email ID','ronby')?></div>
										<div class="prop">
											<a href="mailto:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_email')));?>" class="no-color animated">
												<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_email'));?>
											</a>
										</div>
									</div>
                                </li>
							<?php } ?>
							<?php if(ronby_get_option('ronby_header_top_menu_phone') !='') { ?>
								<li class="d-flex py-3 mr-4">
									<a href="tel:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_phone')));?>" class="icon">
										<span class="flaticon-phone-call"></span>
									</a>
									<div>
										<div class="lb"><?php echo esc_html__('Phone No','ronby')?></div>
										<div class="prop">
											<a href="tel:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_phone')));?>" class="no-color animated">
			<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_phone'));?>
											</a>
										</div>
									</div>
								</li>	
							<?php } ?>	
							<?php if(ronby_get_option('ronby_header_top_menu_address') !='') { ?>
								<li class="d-flex py-3 mr-4">
									<a href="<?php echo esc_url('#');?>" class="icon">
										<span class="flaticon-map-pin-silhouette"></span>
									</a>
									<div>
										<div class="lb"><?php echo esc_html__('Address','ronby')?></div>
										<div class="prop">
											<a  class="no-color animated">
			<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_address'));?>
											</a>
										</div>
									</div>
								</li>	
							<?php } ?>							
							</ul>
						</div>
						<?php if((ronby_get_option('ronby_header_top_menu_btn_label')) ) { ?>
                        <div class="d-none d-md-block col-auto"> 
						<div class="py-3">
						<a href="<?php echo esc_url(ronby_get_option('ronby_header_top_menu_btn_link'));?>" class="button button-primary" ><?php echo esc_attr(ronby_get_option('ronby_header_top_menu_btn_label'));?></a>
						</div>
						</div>
						<?php } ?>						
					</div>
				</div>
			</div>

			<div class="header-nav d-none d-lg-block">
				<div class="container">
					<div class="header-navbar d-flex">	
					<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn_switch') == 1){ ?>
						<a id="sc-toggle" title="Slide Nav" class="flex-auto d-flex align-items-center justify-content-center nav-button background-primary">
							<i class="fas fa-bars"></i>
						</a>
					<?php } ?>		
						<div class="main-menu flex-fill">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'menu clearfix', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu ) 
								); 
								} ?>
						</div>
				<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ ?>
					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
					<div class="col-auto nopadding">
						<div class="header-nav-icons main-menu">
							<ul class="no-style menu clearfix">
								<li>
									<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-shopping-basket">
										</i><span class="badge bg-secondary cart-badge"><?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?></span>
									</a>
	<div class="sub-menu cart-box  menu-depth-1">									
			<div class="container">       
                          <div class="row">
                            <div class="col-sm-6"><a class="no-color nopadding cart-total-items"><?php
							if((WC()->cart->get_cart_contents_count()) <= 1 ){
							$item= esc_attr__(' Item','ronby');
							}else{
							$item= esc_attr(' Items');
							}
							echo esc_attr(WC()->cart->get_cart_contents_count()); echo esc_attr($item);
							?></a></div>
                            <div class="col-sm-6 text-right"> 
							<span class="woocommerce-Price-amount amount"><a class="no-color nopadding cart-total-price"><?php echo WC()->cart->get_cart_total();?></a></span> </div>
                          </div>
						  <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" title="View Cart" class="btn  btn-dark btn_small no-color text-white"><?php esc_html_e('View Cart','ronby');?></a> </div>
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'checkout' ) )); ?>" title="Check out" class="btn  btn-dark btn_small no-color float-right text-white"><?php esc_html_e('Checkout','ronby');?></a> </div>
                        </div>                      
			</div>
	</div>
								</li>
							</ul>
						</div>
					</div>
						<?php } ?>
						<?php } ?>						
						<?php if(ronby_get_option('ronby_header_main_menu_search_btn_switch') == 1) {?>   
						<div class="flex-auto d-flex align-items-center justify-content-center nav-button hidden-search-form-toggler animate-400 hover-background-primary"> <i class="fas fa-search"></i> </div>
						<?php } ?>
					</div>
				</div>			
			</div>
			
		</header>
		<!-- /Header -->	
<?php }elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==3) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 3)) ){ ?>
		<!-- Nav mobile -->
			<nav class="nav-mobile navigation-mobile d-lg-none navbar navbar-expand-lg navbar-light">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
					<?php } else { ?>
					<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-toggle-nav" aria-controls="mobile-toggle-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mobile-toggle-nav">
					<div class="menu-mobile">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'no-style menu navbar-nav', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu_mobile ) 
								); 
								} ?>
					</div>					
				</div>
			</nav>
		<!-- /Nav mobile -->
		
		<!-- Header -->
		<header id="header" class="header-3 fitness-header-3">		
		<?php if(ronby_get_option('ronby_header_top_menu_switch') == 1) { ?>			
				<div class="header-top d-none d-lg-block">
					<div class="row align-items-center">
						<div class="col-auto mr-auto">
							<div class="header-infomation">
								<ul class="list-unstyled  m-0 p-0">
								<?php if((ronby_get_option('ronby_header_top_menu_phone'))) {?>
									<li>
										<span class="color-primary"><?php echo esc_html__('Help Line :','ronby')?></span>
											<a href="tel:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_phone')));?>" class="no-color">
			<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_phone'));?>
											</a>
									</li>
								<?php } ?>
								<?php if((ronby_get_option('ronby_header_top_business_working_day'))) {?>
									<li>
										<span class="color-primary"><?php echo esc_attr(ronby_get_option('ronby_header_top_business_working_day'));?></span>
										<?php echo esc_attr(ronby_get_option('ronby_header_top_business_working_hours'));?>
									</li>
								<?php } ?>	
								</ul>
							</div>
						</div>
	
						<?php if((ronby_get_option('ronby_header_top_menu_btn_label')) ) { ?>
                        <div class="col-auto"> <a href="<?php echo esc_url(ronby_get_option('ronby_header_top_menu_btn_link'));?>" class="button button-primary"><?php echo esc_attr(ronby_get_option('ronby_header_top_menu_btn_label'));?></a></div>
						<?php } ?>
					</div>
				</div>	
		<?php } ?>			
				<div class="header-nav d-none d-lg-block">				
					<div class="row align-items-center">
						<div class="d-none d-lg-block col-auto mr-auto">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                    <div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
					<?php } else { ?>
					<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-fitness.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>
						</div>
						<div class="d-none d-md-block col-auto <?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ echo esc_attr('nopadding');}?>">
							<div class="main-menu fitness-nav-menu">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'menu clearfix', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu ) 
								); 
								} ?>
							</div>
						</div>
	<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ ?>
					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
					<div class="d-none d-md-block col-auto nopadding">
						<div class="header-nav-icons main-menu">
							<ul class="no-style menu clearfix">
								<li class="menu-item-has-children">
									<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-shopping-basket">
										</i><span class="badge bg-secondary cart-badge"><?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?></span>
									</a>
	<div class="sub-menu cart-box  menu-depth-1">									
			<div class="container">       
                          <div class="row">
                            <div class="col-sm-6"><a class="no-color nopadding cart-total-items"><?php
							if((WC()->cart->get_cart_contents_count()) <= 1 ){
							$item= esc_attr__(' Item','ronby');
							}else{
							$item= esc_attr(' Items');
							}
							echo esc_attr(WC()->cart->get_cart_contents_count()); echo esc_attr($item);
							?></a></div>
                            <div class="col-sm-6 text-right"> 
							<span class="woocommerce-Price-amount amount"><a class="no-color nopadding cart-total-price"><?php echo WC()->cart->get_cart_total();?></a></span> </div>
                          </div>
						  <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" title="View Cart" class="btn  btn-dark btn_small no-color"><?php esc_html_e('View Cart','ronby');?></a> </div>
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'checkout' ) )); ?>" title="Check out" class="btn  btn-dark btn_small no-color float-right"><?php esc_html_e('Checkout','ronby');?></a> </div>
                        </div>                      
			</div>
	</div>
								</li>
							</ul>
						</div>
					</div>
						<?php } ?>
						<?php } ?>
					<?php if((ronby_get_option('ronby_header_main_menu_search_btn_switch')) ) { ?>
						<div class="d-none d-md-block col-auto">
							<div class="nav-search">
								<div class="nav-search-button hidden-search-form-toggler"><i class="fas fa-search"></i></div>								
							</div>
						</div>	
					<?php } ?>						
					</div>
					</div>
												
			
		</header>
			<div class="hidden-search-form">
				<div class="overlay-absolute">
						<div class="srch_close">
							<span class="form-close">
								<i class="fas fa-times-circle"></i>
							</span>
						</div>
					<div class="search-form">
                        <form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="form-group-with-button">
                                <input class="form-element-styled form-group-input"   id="s1" type="text" placeholder="<?php esc_attr_e('Search here', 'ronby'); ?>"  name="s" maxlength="100">
                                <button class="form-group-button background-primary color-inverse" type="submit"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
					</div>
				</div>
			</div>		
		<!-- End Header -->	
<?php }elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==4) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 4)) ){ ?> 
		<!-- Nav mobile -->
			<nav class="nav-mobile navigation-mobile d-lg-none navbar navbar-expand-lg navbar-light">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			        <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
					<?php } else { ?>
					<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-toggle-nav" aria-controls="mobile-toggle-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mobile-toggle-nav">
					<div class="menu-mobile">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'no-style menu navbar-nav', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu_mobile ) 
								); 
								} ?>
					</div>					
				</div>
			</nav>
		<!-- /Nav mobile -->
		
		<!-- Header -->
		<header id="header" class="header-4">

			<div class="hidden-search-form">
				<div class="overlay-absolute">
					<div class="srch_close">
							<span class="form-close">
								<i class="fas fa-times-circle"></i>
							</span>
					</div>
					<div class="search-form">
                        <form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="form-group-with-button">
                                <input class="form-element-styled form-group-input"   id="s1" type="text" placeholder="<?php esc_attr_e('Enter keywords', 'ronby'); ?>"  name="s" maxlength="100">
                                <button class="form-group-button background-primary color-inverse" type="submit"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
					</div>
				</div>
			</div>

			<div class="container">	
		<?php if(ronby_get_option('ronby_header_top_menu_switch') == 1) { ?>
				<div class="header-top d-none d-lg-block">
					<div class="row align-items-center">
						<div class="col-auto mr-auto">
							<div class="header-infomation">
								<ul>
	<?php if((ronby_get_option('ronby_header_top_business_working_day'))) {?>
								<li>
								<span class="color-secondary"><i class="fas fa-clock"></i> <?php echo esc_attr(ronby_get_option('ronby_header_top_business_working_day'));?></span>
								<?php echo esc_attr(ronby_get_option('ronby_header_top_business_working_hours'));?>
								</li>
								<?php } ?>											
	<?php if(ronby_get_option('ronby_header_top_menu_phone') !='') { ?>
								<li>
								<span class="color-secondary">
								<i class="fas fa-phone-volume"></i>
								<?php echo esc_html__('Phone No :','ronby')?>
								</span>
								<a href="tel:<?php echo esc_attr(wp_trim_words(ronby_get_option('ronby_header_top_menu_phone')));?>" class="no-color">
	<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_phone'));?>
								</a>
								</li>	
							<?php } ?>										
	<?php if(ronby_get_option('ronby_header_top_menu_address') !='') { ?>
								<li>
								<span class="color-secondary">
								<i class="fas fa-map-marker"></i> 
								<?php echo esc_html__('Location :','ronby')?>
								</span>
	<?php echo esc_attr(ronby_get_option('ronby_header_top_menu_address'));?>
								</li>	
							<?php } ?>			
								</ul>
							</div>
						</div>
						<div class="col-auto">
							<div class="social-7">
							<?php if(ronby_get_option('social_facebook') !='') { ?>
                                   <a href="<?php echo esc_url(ronby_get_option('social_facebook'));?>" class="no-color"> <i class="fab fa-facebook-f"></i> </a>
							<?php } ?>		
							<?php if(ronby_get_option('social_twitter') !='') { ?>
                                  <a href="<?php echo esc_url(ronby_get_option('social_twitter'));?>" class="no-color"> <i class="fab fa-twitter"></i> </a>       
							<?php } ?>	
							<?php if(ronby_get_option('social_pinterest') !='') { ?>		
                                  <a href="<?php echo esc_url(ronby_get_option('social_pinterest'));?>" class="no-color"> <i class="fab fa-pinterest-p"></i> </a>
							<?php } ?>
							<?php if(ronby_get_option('social_linkedin') !='') { ?>		<a href="<?php echo esc_url(ronby_get_option('social_linkedin'));?>" class="no-color"> <i class="fab fa-linkedin"></i></a>               
							<?php } ?>								
							</div>				
						</div>
					</div>
				</div>
		<?php } ?>				
			
				<div class="header-nav d-none d-lg-block">
					<div class="row align-items-center">
						<div class="d-none d-lg-block col-auto mr-auto">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                    <div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
					<?php } else { ?>
					<div class="logo d-flex align-items-center">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-medical.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>	
						</div>
						<div class="d-none d-md-block col-auto">
							<div class="main-menu medical-nav-menu">
                                <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'menu clearfix', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu ) 
								); 
								} ?>
							</div>
						</div>
				<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ ?>
					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
					<div class="col-auto nopadding">
						<div class="header-nav-icons main-menu">
							<ul class="no-style menu clearfix">
								<li>
									<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-shopping-basket">
										</i><span class="badge bg-secondary cart-badge"><?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?></span>
									</a>
	<div class="sub-menu cart-box  menu-depth-1">									
			<div class="container">       
                          <div class="row">
                            <div class="col-sm-6"><a class="no-color nopadding cart-total-items"><?php
							if((WC()->cart->get_cart_contents_count()) <= 1 ){
							$item= esc_attr__(' Item','ronby');
							}else{
							$item= esc_attr(' Items');
							}
							echo esc_attr(WC()->cart->get_cart_contents_count()); echo esc_attr($item);
							?></a></div>
                            <div class="col-sm-6 text-right"> 
							<span class="woocommerce-Price-amount amount"><a class="no-color nopadding cart-total-price"><?php echo WC()->cart->get_cart_total();?></a></span> </div>
                          </div>
						  <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" title="View Cart" class="btn  btn-dark btn_small no-color"><?php esc_html_e('View Cart','ronby');?></a> </div>
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'checkout' ) )); ?>" title="Check out" class="btn  btn-dark btn_small no-color float-right"><?php esc_html_e('Checkout','ronby');?></a> </div>
                        </div>                      
			</div>
	</div>
								</li>
							</ul>
						</div>
					</div>
						<?php } ?>						
						<?php } ?>						
						<?php if((ronby_get_option('ronby_header_top_menu_btn_label')) ) { ?>
                        <div class="d-none d-md-block col-auto"> <a href="<?php echo esc_url(ronby_get_option('ronby_header_top_menu_btn_link'));?>" class="button button-primary rounded"><?php echo esc_attr(ronby_get_option('ronby_header_top_menu_btn_label'));?></a></div>
						<?php } ?>
						
						<?php if((ronby_get_option('ronby_header_main_menu_search_btn_switch')) ) { ?>
						<div class="d-none d-md-block col-auto">
						<div class="nav-search">
								<div class="nav-search-button hidden-search-form-toggler cursor-point white"><i class="fas fa-search"></i></div>								
							</div>
						
						</div>	
						<?php } ?>	
					</div>
				</div>
			</div>
		</header>
		<!-- /Header -->
<?php } elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==5) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 5)) ){ ?>
		<!-- Style Customizer -->

		<section id="style-customizer" class="header-5-slide-nav">
		  <div class="style-customizer-wrap form-horizontal">
		    <div class="main-slide-header">
				<aside id="media_image-5" class="widget widget_media_image">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                        <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
			<?php } } ?>
				</aside>                   
			</div>
		    <div class="main-slide-content">
				<aside id="custom_html-8" class="widget_text widget widget_custom_html">
					<nav class="nav-mobile  navbar navbar-light">
						<div class="collapse navbar-collapse show" id="mobile-toggle-nav"><div class="menu-mobile">
	                    <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'no-style menu navbar-nav', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu_mobile ) 
								); 
								} ?>
						</div></div>
					</nav>
				</aside>                        
			</div>

			<div class="main-slide-footer">
				<aside>
				<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn1_label') !=''){ ?>
					<a href="<?php echo esc_url(ronby_get_option('ronby_header_main_menu_slide_nav_btn1_url')); ?>" class="button button-primary"><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_btn1_label')); ?></a> 
				<?php } ?>	
				<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn2_label') !=''){ ?>	
				<a href="<?php echo esc_url(ronby_get_option('ronby_header_main_menu_slide_nav_btn2_url')); ?>" class="btn btn-default"><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_btn2_label')); ?></a>
				<?php } ?>						
				</aside>
				<br><br>
			<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_copyright') !=''){?>				
				<aside id="text-5" class="widget widget_text">			
				<div class="textwidget"><p><?php echo esc_attr(ronby_get_option('ronby_header_main_menu_slide_nav_copyright')); ?></p>
				</div>
				</aside> 
			<?php } ?>		
		</div>
		  </div>
			<a id="sc-toggle-close" title="<?php esc_html_e('Styles Customizer', 'ronby'); ?>"><i class="fas fa-times-circle"></i></a>
		</section>	
		<div class="hidden-search-form">
			<div class="overlay-absolute">
				<div class="srch_close">
					<span class="form-close">
						<i class="fas fa-times-circle"></i>
					</span>
				</div>
				<div class="search-form">
                        <form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="form-group-with-button">
                                <input class="form-element-styled form-group-input" id="s1" type="text" placeholder="<?php esc_attr_e('Enter keywords', 'ronby'); ?>"  name="s" maxlength="100">
                                <button class="form-group-button background-primary color-inverse" type="submit"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
				</div>
			</div>
		</div>

	<!-- Header -->
	<div id="header" class="header-5">

		<div class="header-nav color-inverse">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-3 col-4">
						<div class="header-nav-icons">
							<ul class="no-style">
							<?php if(ronby_get_option('ronby_header_main_menu_search_btn_switch') == 1){ ?>
								<li>
									<a href="#" class="no-color animate-300 hover-color-primary hidden-search-form-toggler">
										<i class="fas fa-search"></i>
									</a>
								</li>
							<?php } ?>
							<?php if(ronby_get_option('ronby_header_main_menu_slide_nav_btn_switch') == 1){ ?>							
								<li>
									<a id="sc-toggle" title="Slide Nav Close" class="flex-auto d-flex align-items-center justify-content-center nav-button cursor-point">
										<i class="fas fa-bars"></i>
									</a>
								</li>
							<?php } ?>	
							</ul>
						</div>						
					</div>
					<div class="col-lg-6 col-4">
					<?php if(ronby_get_option('logo_text') != ''){ ?>					
						<div class="site-branding">
							<a href="<?php echo esc_url( home_url() ); ?>" class="no-color">
								<?php echo esc_attr(ronby_get_option('logo_text') );?>
							</a>
						</div>
					<?php }else{ ?>	
						<div class="site-branding">
							<a href="<?php echo esc_url( home_url() ); ?>" class="no-color">
							<?php echo esc_attr(get_bloginfo('name')); ?>
							</a>
						</div>					
					<?php } ?>
					</div>
					<div class="col-lg-3 col-4">
						<div class="header-nav-icons fright">
						<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ ?>
						<?php if ( class_exists( 'WooCommerce' ) ) { ?>
							<ul class="no-style">

								<li class="sm-dnone">
									<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-user"></i>
									</a>
								</li>
							
								<?php 
								if(function_exists('ronby_woowishlist_get_page_link')){
								$link=ronby_woowishlist_get_page_link();	
								}else{
								$link='#';
								}
								if(function_exists('ronby_woowishlist_get_list')){
								$list = count(array_filter(ronby_woowishlist_get_list()));
								}else{
								$list = '0';	
								}
								?>							
								<li>
									<a href="<?php echo esc_url($link); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-heart"></i>
										<span class="badge heart-badge bg-secondary wishlist-badge"><?php echo esc_attr($list) ;?></span>
									</a>
								</li>
								<li>
									<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-shopping-basket"></i>
										<span class="badge bg-secondary cart-badge"><?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?></span>
									</a>
									
								</li>
							</ul>
						<?php } ?>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- End Header -->
<?php }elseif( (isset($_COOKIE['ft_menu_type']) && (int)$_COOKIE['ft_menu_type']==6) || ((!isset($_COOKIE['ft_menu_type'])) && (ronby_get_option('ronby_header_main_menu_style') == 6)) ){ ?>
	<!-- Nav mobile -->
		<nav class="nav-mobile navigation-mobile d-lg-none navbar navbar-expand-lg navbar-light">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                        <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
					<?php } else { ?>
					<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand d-lg-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>
			<?php } ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-toggle-nav" aria-controls="mobile-toggle-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mobile-toggle-nav">
				<div class="menu-mobile">
	                    <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'no-style menu navbar-nav', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu_mobile ) 
								); 
								} ?>
				</div>					
			</div>
		</nav>
	<!-- /Nav mobile -->

	<!-- Header -->
	<div id="header" class="header-6 header-transparent color-inverse">
		<div class="overlay">
			<div class="header-nav d-none d-lg-block">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-3">
			<?php if(has_custom_logo()){ 		
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			?>
			            <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>" >
                        <img src="<?php echo esc_url( $logo[0] );?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
							
			<?php } else { if( (isset(ronby_get_option('logo_icon')['url']) && (ronby_get_option('logo_icon')['url'])) ) { ?>
                        <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url(ronby_get_option('logo_icon')['url']);?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                        </div>
					<?php } else { ?>
					<div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() ).'/images/logo-food.png'; ?>" alt="<?php esc_attr_e('logo','ronby'); ?>">
                        </a>
                    </div>
			<?php } ?>	
			<?php } ?>
						</div>
						<div class="<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ echo esc_attr("col-lg-8");} else{echo esc_attr("col-lg-9");}?>">
							<div class="main-menu d-flex justify-content-end text-right">						
                               <?php if ( has_nav_menu( 'ronby_primary_menu') ) { wp_nav_menu( array( 
								'theme_location'=> 'ronby_primary_menu', 
								'container' => false, 
								'container_id' => '', 
								'conatiner_class' => '', 
								'menu_class' => 'menu clearfix', 
								'echo' => true, 
								'items_wrap' => '
                                <ul id="%1$s" class="%2$s">%3$s</ul>', 
								'depth' => 3, 
								'walker' => new ronby_walker_nav_menu ) 
								); 
								} ?>
							</div>

						</div>
				<?php if(ronby_get_option('ronby_woocommerce_cart_switch') == 1){ ?>
					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
					<div class="col-auto nopadding">
						<div class="header-nav-icons main-menu">
							<ul class="no-style menu clearfix">
								<li>
									<a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" class="no-color animate-300 hover-color-primary">
										<i class="fas fa-shopping-basket">
										</i><span class="badge bg-secondary cart-badge"><?php echo esc_attr(WC()->cart->get_cart_contents_count()); ?></span>
									</a>
	<div class="sub-menu cart-box  menu-depth-1">									
			<div class="container">       
                          <div class="row">
                            <div class="col-sm-6"><a class="no-color nopadding cart-total-items"><?php
							if((WC()->cart->get_cart_contents_count()) <= 1 ){
							$item= esc_attr__(' Item','ronby');
							}else{
							$item= esc_attr(' Items');
							}
							echo esc_attr(WC()->cart->get_cart_contents_count()); echo esc_attr($item);
							?></a></div>
                            <div class="col-sm-6 text-right"> 
							<span class="woocommerce-Price-amount amount"><a class="no-color nopadding cart-total-price"><?php echo WC()->cart->get_cart_total();?></a></span> </div>
                          </div>
						  <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'cart' ) )); ?>" title="View Cart" class="btn  btn-dark btn_small no-color"><?php esc_html_e('View Cart','ronby');?></a> </div>
                            <div class="col-sm-6"> <a href="<?php echo esc_url(get_permalink( wc_get_page_id( 'checkout' ) )); ?>" title="Check out" class="btn  btn-dark btn_small no-color float-right"><?php esc_html_e('Checkout','ronby');?></a> </div>
                        </div>                      
			</div>
	</div>
								</li>
							</ul>
						</div>
					</div>
						<?php } ?>
						<?php } ?>
					</div>
				</div>			
			</div>	
		</div>
	</div>
	<!-- End Header -->	
<?php }
}

/*****************************
Language Switcher Function
******************************/
function ronby_language_switch(){
	// Defaults
	$user = new WP_User();
    $languages = get_available_languages();
    $user_locale = $user->locale;
    $fallback = get_locale();
    // Already en_US
    if ('en_US' === $user->locale) {
        $user_locale = false;
        // Language not available
    } elseif (!in_array($user->locale, $languages, true)) {
        $user_locale = $fallback;
    }
wp_dropdown_languages(array('name' => 'locale', 'id' => 'locale','selected' => $user_locale, 'languages' => $languages, 'show_available_translations' => false));	
}