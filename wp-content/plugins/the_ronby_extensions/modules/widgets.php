<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
/************************************
Ronby Footer Navigation Widget
*************************************/
class ronby_footer_nav_widget extends WP_Widget {


	function __construct()
	{
		$widget_ops = array( 'description' => esc_html__( 'Add a custom Nav menu to your footer.', 'ronby' ) );
		parent::__construct( 'nav_plus_widget', esc_html__( 'Ronby Footer Navigation', 'ronby' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		static $menu_id_slugs = array();

		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$menu_args = array(
			'menu'				=> $nav_menu,
			'items_wrap'		=> '%3$s',
			'echo'				=> false,
			'container'			=> false,
		);

		$wp_nav_menu = wp_nav_menu( $menu_args );

		if ( ! $wp_nav_menu ) {
			return;
		}

		// Attributes
		$wrap_id = 'menu-' . $nav_menu->slug;
		while ( in_array( $wrap_id, $menu_id_slugs ) ) {
			if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) ) {
				$wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
			} else {
				$wrap_id = $wrap_id . '-1';
			}
		}
		$menu_id_slugs[] = $wrap_id;

		$instance['title']		= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$instance['menu_class']	= ( isset( $instance['menu_class'] ) ) ? $instance['menu_class'] : 'widget-menu-1';
		
		?><div class="widget footer-nav"><?php

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		?>
		<div class="menu-<?php echo $nav_menu->slug; ?>-container <?php echo esc_attr( $instance['menu_class'] ); ?>">
			<ul id="<?php echo $wrap_id; ?>" class="no-style">
				<?php echo $wp_nav_menu; ?>
			</ul>
		</div>
		<?php

		?></div><?php
	}

	function update( $new_instance, $old_instance )
	{
		$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
		$instance['menu_class'] 	= $this->sanitize_menu_classes( $new_instance['menu_class'] );
		$instance['title_color'] 	=  $new_instance['title_color'] ;	
		$instance['anchor_color'] 	=  $new_instance['anchor_color'] ;	
		$instance['anchor_hover_color'] 	=$new_instance['anchor_hover_color'];	
		$instance['nav_menu'] 		= (int) $new_instance['nav_menu'];
 

		return $instance;
	}

	function sanitize_menu_classes( $menu_classes, $sanitized_menu_classes = '' )
	{
		$menu_classes = explode( ' ', $menu_classes );
		if ( ! empty( $menu_classes ) ) {
			foreach ( $menu_classes as $menu_class ) {
				$sanitized_menu_classes .= sanitize_html_class( $menu_class ) . ' ';
			}
			$sanitized_menu_classes = rtrim( $sanitized_menu_classes );
		}

		return $sanitized_menu_classes;
	}

	function form( $instance )
	{
		// Get menus
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		$title 				= isset( $instance['title'] ) 			? $instance['title'] 			: '';
		$menu_class			= isset( $instance['menu_class'] ) 		? $instance['menu_class'] 		: 'widget-menu-1';			
	
		// If no menus exists, direct the user to go and create some.
		if ( ! $menus ) {
			echo '<p>'. sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'ronby' ), admin_url('nav-menus.php') ) .'</p>';
			return;
		} else {
			$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : $menus[0]->term_id;

			// Get menu items
			$menu_items = wp_get_nav_menu_items( $nav_menu );
		}
		?>

		
		<div class="wpnp_section_wrap general">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'ronby' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e( 'Menu Name:', 'ronby' ); ?></label>
				<select id="<?php echo $this->get_field_id('nav_menu'); ?>" class="wpnp_menu_name widefat" name="<?php echo $this->get_field_name('nav_menu'); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;', 'ronby' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('menu_class'); ?>"><?php _e( 'Menu Class:', 'ronby' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('menu_class'); ?>" name="<?php echo $this->get_field_name('menu_class'); ?>" value="<?php echo esc_attr( $menu_class ); ?>" />
				<span class="description"><?php esc_html_e('Style- 1 Menu Class: "widget-menu-1"', 'ronby' ) ?></span><br>
				<span class="description"><?php esc_html_e('Style- 2 Menu Class: "widget-menu-2"', 'ronby' ) ?></span><br>
				<span class="description"><?php esc_html_e('Style- 3 Menu Class: "widget-menu-3"', 'ronby' ) ?></span><br>
				<span class="description"><?php esc_html_e('Style- 4 Menu Class: "widget-menu-4"', 'ronby' ) ?></span><br>
				<span class="description"><?php esc_html_e('Style- 5 Menu Class: "widget-menu-5"', 'ronby' ) ?></span>
			</p>
		</div>

		<?php
	}
}

function register_ronby_footer_nav_widget() {

	register_widget( 'ronby_footer_nav_widget' );
}

add_action( 'widgets_init', 'register_ronby_footer_nav_widget' );

/*************************
Ronby About us- 1 Widget
*************************/
class ronby_about_us_one_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_about_us', // Base ID
      esc_html__('Ronby About us one widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays business details', 'ronby'), ) // Args
    );
  }


  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
	  $desc= isset($instance['desc']) ? $instance['desc'] : '';
	  $telephone= isset($instance['telephone']) ? $instance['telephone'] : '';
	  $email= isset($instance['email']) ? $instance['email'] : '';
	  $address= isset($instance['address']) ? $instance['address'] : '';
	  $facebook_url= isset($instance['facebook_url']) ? $instance['facebook_url'] : '';
	  $twitter_url= isset($instance['twitter_url']) ? $instance['twitter_url'] : '';
	  $google_url= isset($instance['google_url']) ? $instance['google_url'] : '';
	  $linkedin_url= isset($instance['linkedin_url']) ? $instance['linkedin_url'] : '';
	  $newsletter_switch= isset($instance['newsletter_switch']) ? $instance['newsletter_switch'] : '';
      $social_bg_color = isset($instance['social_bg_color']) ? $instance['social_bg_color'] : '';		
	  $allowed_html = array(
		'span' => array(
			'class' => array(),
			'style' => array()
		),
		'br' => array(),
		'strong' => array(),
		'p' => array(),
	);	  
  ?>
				<div class="widget about-us-one">
						<?php if(!empty($title)){ ?>
							<h3 class="widget-title"><?php echo esc_attr($title);?></h3>
						<?php } ?>	
							<div class="widget-text">
							<?php if(!empty($desc)){ ?>
								<p>
								<?php echo wp_kses($desc,$allowed_html); ?>
								</p>
							<?php } ?>		
								<ul class="list-unstyled" style="font-size: 13px;">
								<?php if(!empty($telephone)){ ?>
									<li class="mb-3">
										<i class="fas fa-phone color-primary mr-2" ></i> <?php echo esc_attr($telephone);?>
									</li>
								<?php } ?>	
								<?php if(!empty($email)){ ?>
									<li class="mb-3">
										<i class="fas  fa-envelope color-primary  mr-2"></i> <?php echo esc_attr($email);?>
									</li>
								<?php } ?>	
								<?php if(!empty($address)){ ?>								
									<li>
										<i class="fas fa-map-marker color-primary  mr-2"></i> <?php echo esc_attr($address);?>
									</li>
								<?php } ?>	
								</ul>

							</div>
							<?php if(($facebook_url !='' || $twitter_url !='' || $google_url !='' || $linkedin_url !='')){?>
							<div class="social-icons">
							<div class="social-8 pt-4">
								<ul class="no-style items-inline-block">
								<?php if(!empty($facebook_url)){?>
									<li class="hover-background-primary" <?php if($social_bg_color){echo"style='background-color:".esc_attr($social_bg_color)."'";}?>>									
										<a href="<?php echo esc_url($facebook_url);?>" class="no-color">
											<i class="fab  fa-facebook-f"></i>
										</a>
									</li>
								<?php } ?>
								<?php if(!empty($twitter_url)){?>								
									<li class="hover-background-primary" <?php if($social_bg_color){echo"style='background-color:".esc_attr($social_bg_color)."'";}?>>
										<a href="<?php echo esc_url($twitter_url);?>" class="no-color">
											<i class="fab fa-twitter"></i>
										</a>
									</li>
								<?php } ?>
								<?php if(!empty($google_url)){?>								
									<li class="hover-background-primary" <?php if($social_bg_color){echo"style='background-color:".esc_attr($social_bg_color)."'";}?>>
										<a href="<?php echo esc_url($google_url);?>" class="no-color">
											<i class="fab fa-pinterest-p"></i>
										</a>
									</li>
								<?php } ?>	
								<?php if(!empty($linkedin_url)){?>
									<li class="hover-background-primary" <?php if($social_bg_color){echo"style='background-color:".esc_attr($social_bg_color)."'";}?>>
										<a href="<?php echo esc_url($linkedin_url);?>" class="no-color">
										<i class="fab fa-linkedin-in"></i>
									</a>
									</li>
								<?php } ?>	
								</ul>
							</div>	
							</div>
							<?php } ?>
 <?php if( 'on' == $newsletter_switch) { ?>						
  <div class="subscription-widget-one">
  <?php if(ronby_get_option('ft_aweber_listid') != '') { ?>
  <div class="search-form">
  <form method="post" action="https://www.aweber.com/scripts/addlead.pl">
	<div class="form-group-with-button">
		<input type="hidden" name="redirect" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage') ); ?>" />
		<input type="hidden" name="meta_redirect_onlist" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage_old') ); ?>" />
		<input type="hidden" name="meta_message" value="<?php esc_html_e('1', 'ronby');?>" /> 
		<input type="hidden" name="meta_required" value="<?php esc_html_e('email', 'ronby');?>" />
		<input name="email" class="form-element-styled form-group-input" id="samplees" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="text" required />
		<button type="submit" class="form-group-button background-secondary color-inverse animate-300 hover-background-primary"> <i class="fas fa-angle-right"></i></button>
	</div>
  </form>
  </div>
  <?php } elseif ((ronby_get_option('mailchimp_apikey') != '') && (ronby_get_option('mailchimp_listid') != '')){ ?>
	<div class="search-form">
  <form   method="post" class="newsletter">
		<input name="email" class="form-element-styled form-group-input" id="newsletter-email" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="email" required />
		<button type="submit" class="form-group-button background-secondary color-inverse animate-300 hover-background-primary"><i class="fas fa-angle-right"></i></button>
	  <div class="output"></div>
	  <div class="newsletter-loader"><img src="<?php echo plugin_dir_url(__FILE__);?>/images/newsletter_loader.gif" alt="newsletter-loader"/></div>	  
	</form>
	</div>
<?php if(function_exists('ronby_newsletter_without_loading')){ echo ronby_newsletter_without_loading();} ?>	
  <?php } else { ?>
  <div class="search-form">
 <form method="post" action="#">
		<input type="hidden" name="redirect" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage') ); ?>" />
		<input type="hidden" name="meta_redirect_onlist" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage_old') ); ?>" />
		<input type="hidden" name="meta_message" value="<?php esc_html_e('1', 'ronby');?>" /> 
		<input type="hidden" name="meta_required" value="<?php esc_html_e('email', 'ronby');?>" />
		<input name="email" class="form-element-styled form-group-input" id="samplees" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="email" required />
		<button type="submit" class="form-group-button background-secondary color-inverse animate-300 hover-background-primary"><i class="fas fa-angle-right"></i></button>
  </form>
  </div>
  <?php } ?>
  </div>	
 <?php } ?>  
				</div>
							
<?php	
 }

  function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['desc']= strip_tags( $new_instance['desc'] );
    $instance['telephone']= strip_tags( $new_instance['telephone'] );
    $instance['email']= strip_tags( $new_instance['email'] );
    $instance['address']= strip_tags( $new_instance['address'] );
    $instance['facebook_url']= strip_tags( $new_instance['facebook_url'] );
    $instance['twitter_url']= strip_tags( $new_instance['twitter_url'] );
    $instance['google_url']= strip_tags( $new_instance['google_url'] );
    $instance['linkedin_url']= strip_tags( $new_instance['linkedin_url'] );
    $instance['newsletter_switch']= strip_tags( $new_instance['newsletter_switch'] );
    $instance['social_bg_color']= strip_tags( $new_instance['social_bg_color'] );
return $instance;
  }


  function form($instance){
    $defaults = array( 
      'title'               => '',
      'desc'               => '',
      'telephone'              => '',
      'email'        => '',
      'address'       => '',
      'facebook_url'         => '',
      'twitter_url'         => '',
      'google_url'           => '',
      'linkedin_url'          => '',
      'newsletter_switch'          => '',
      'social_bg_color'          => '',

    );
    $instance = wp_parse_args( (array) $instance, $defaults );
	$allowed_html = array(
    'span' => array(
        'class' => array(),
        'style' => array()
    ),
    'br' => array(),
    'strong' => array(),
    'p' => array(),
);
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>"><?php esc_html_e('Description', 'ronby'); ?></label>
      <textarea type="text" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>" class="widefat" ><?php echo wp_kses($instance['desc'],$allowed_html); ?></textarea>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>"><?php esc_html_e('Telephone', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telephone' )); ?>" class="widefat" value="<?php echo esc_attr($instance['telephone']); ?>">
	  <small><?php echo esc_html__('Enter here your telephone number. Example: +1-234-5689','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php esc_html_e('Email', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" class="widefat" value="<?php echo esc_attr($instance['email']); ?>">
	  <small><?php echo esc_html__('Enter here your email address. Example: xyz@example.com','ronby'); ?></small>
    </p>	
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e('Address', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" class="widefat" value="<?php echo esc_attr($instance['address']); ?>">
	  <small><?php echo esc_html__('Enter here your company address.','ronby'); ?></small>
    </p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'facebook_url' )); ?>"><?php esc_html_e('Facebook Profile URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'facebook_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['facebook_url']); ?>">
	  <small><?php echo esc_html__('Example: http://facebook.com/username','ronby'); ?></small>
    </p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'twitter_url' )); ?>"><?php esc_html_e('Twitter Profile URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['twitter_url']); ?>">
	    <small><?php echo esc_html__('Example: http://twitter.com/username','ronby'); ?></small>
    </p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'google_url ' )); ?>"><?php esc_html_e('Pinterest Profile URL', 'ronby'); ?></label><br/>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'google_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google_url' )); ?>" class="widefat " value="<?php echo esc_url($instance['google_url']); ?>">
	 <small><?php echo esc_html__('Example: http://pinterest.com/username','ronby'); ?></small>
    </p>	
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'linkedin_url' )); ?>"><?php esc_html_e('Linkedin URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'linkedin_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['linkedin_url']); ?>">
	 <small><?php echo esc_html__('Example: http://linkedin.com/username','ronby'); ?></small>	  
    </p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'newsletter_switch' )); ?>"><?php esc_html_e('Do you want Newsletter Form?', 'ronby'); ?></label>
      <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'newsletter_switch' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'newsletter_switch' )); ?>" class="widefat newsletter_switch" value="<?php echo esc_attr('on'); ?>" <?php checked( $instance[ 'newsletter_switch' ], 'on' ); ?> />  
    </p>	
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'social_bg_color ' )); ?>"><?php esc_html_e('Social Icon Background Color', 'ronby'); ?></label><br/>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'social_bg_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'social_bg_color' )); ?>" class="widefat social_bg_color" value="<?php echo esc_attr($instance['social_bg_color']); ?>">
    </p>	
	<script>
		jQuery(document).ready(function($){
			jQuery('.social_bg_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});		
		});
	</script>	
  <?php
  }

}//end of class

 
function register_ronby_about_us_one_widget() {
  register_widget( 'ronby_about_us_one_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_about_us_one_widget' );

/*************************
Start subscription widget
*************************/
class ronby_subscription_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_subscription', // Base ID
      esc_html__('Ronby Subscription One Widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays ronby subscription area style- 1.', 'ronby'), ) // Args
    );
  }

  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
      $current_time = isset($instance['current_time']) ? $instance['current_time'] : '';
  ?>
  <?php
  $before_widget = $args['before_widget'];
  $after_widget = $args['after_widget'];
  echo $before_widget; 
  ?>
  <div class="subscription-widget-one">
  <?php if($title){ ?>
  <h3 class="widget-title <?php echo esc_attr($current_time); ?>" <?php if(!empty($widget_title_color)) {?>style="color:<?php echo esc_attr($widget_title_color); ?>" <?php } ?>><?php echo esc_attr($title); ?></h3>
  <?php } ?>
  <?php if(ronby_get_option('ft_aweber_listid') != '') { ?>
  <div class="search-form">
  <form method="post" action="https://www.aweber.com/scripts/addlead.pl">
	<div class="form-group-with-button">
		<input type="hidden" name="redirect" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage') ); ?>" />
		<input type="hidden" name="meta_redirect_onlist" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage_old') ); ?>" />
		<input type="hidden" name="meta_message" value="<?php esc_html_e('1', 'ronby');?>" /> 
		<input type="hidden" name="meta_required" value="<?php esc_html_e('email', 'ronby');?>" />
		<input name="email" class="form-element-styled form-group-input" id="samplees" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="text" required />
		<button type="submit" class="form-group-button background-primary color-inverse animate-300 hover-background-secondary"> <i class="fas fa-angle-right"></i></button>
	</div>	
  </form>
  </div>
  <?php } elseif ((ronby_get_option('mailchimp_apikey') != '') && (ronby_get_option('mailchimp_listid') != '')){ ?>
	<div class="search-form">
  <form   method="post" class="newsletter">
		<input name="email" class="form-element-styled form-group-input" id="newsletter-email" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="email" required />
		<button type="submit" class="form-group-button background-primary color-inverse animate-300 hover-background-secondary"><i class="fas fa-angle-right"></i></button>
	  <div class="output"></div>
	  <div class="newsletter-loader"><img src="<?php echo plugin_dir_url(__FILE__);?>/images/newsletter_loader.gif" alt="newsletter-loader"/></div>	  
	</form>
	</div>
<?php if(function_exists('ronby_newsletter_without_loading')){ echo ronby_newsletter_without_loading();} ?>	
  <?php } else { ?>
  <div class="search-form">
 <form method="post" action="#">
		<input type="hidden" name="redirect" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage') ); ?>" />
		<input type="hidden" name="meta_redirect_onlist" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage_old') ); ?>" />
		<input type="hidden" name="meta_message" value="<?php esc_html_e('1', 'ronby');?>" /> 
		<input type="hidden" name="meta_required" value="<?php esc_html_e('email', 'ronby');?>" />
		<input name="email" class="form-element-styled form-group-input" id="samplees" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="email" required />
		<button type="submit" class="form-group-button background-primary color-inverse animate-300 hover-background-secondary"><i class="fas fa-angle-right"></i></button>
  </form>
  </div>
  <?php } ?>
  </div> 
  <?php echo $after_widget; ?>
	<?php
  }
  
  

  function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['current_time']= strip_tags( $new_instance['current_time'] );
    return $instance;

  }

  function form($instance){
    $defaults = array( 
      'title'               => '',
      'current_time'           => time()
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title ' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
    </p>
	


	
	<input type="hidden" id="<?php echo esc_attr($this->get_field_id( 'current_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'current_time' )); ?>" class="widefat" value="<?php echo time(); ?>">
	
  <?php
  }

}//end of class

// register ronby_subscription_widget widget
function ronby_register_subscription_Widget() {
  register_widget( 'ronby_subscription_widget' );  // Class Name
}
add_action( 'widgets_init', 'ronby_register_subscription_Widget' );


/*************************
Ronby Contact us- 1 Widget
*************************/
class ronby_contact_us_one_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_contact_us', // Base ID
      esc_html__('Ronby Contact us one Widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays contact details', 'ronby'), ) // Args
    );
  }


  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
	  $telephone= isset($instance['telephone']) ? $instance['telephone'] : '';
	  $email= isset($instance['email']) ? $instance['email'] : '';
	  $address= isset($instance['address']) ? $instance['address'] : '';
	
	  $allowed_html = array(
		'span' => array(
			'class' => array(),
			'style' => array()
		),
		'br' => array(),
		'strong' => array(),
		'p' => array(),
	);	  
  ?>				
				<div class="widget contact-us-one-widget">
						<?php if(!empty($title)){ ?>
							<h3 class="widget-title"><?php echo esc_attr($title);?></h3>
						<?php } ?>	
								<div class="widget-contact-infomation">
									<ul class="no-style">
									<?php if(!empty($telephone)){ ?>
										<li class="d-flex">
											<div class="icon color-secondary">
												<i class="flaticon-phone-call"></i>
											</div>
											<div class="flex-fill">
												<div class="item-lb"><?php echo esc_html__('Phone','ronby');?></div>
												<div class="item-text">
													<a class="no-color" href="tel:<?php echo esc_attr(wp_trim_words($telephone));?>"><?php echo esc_attr($telephone);?></a>
												</div>
											</div>
										</li>
									<?php } ?>
									<?php if(!empty($email)){ ?>
										<li class="d-flex">
											<div class="icon color-secondary">
												<i class="flaticon-clock"></i>
											</div>
											<div class="flex-fill">
												<div class="item-lb"><?php echo esc_html__('Email','ronby');?></div>
												<div class="item-text">
													<a class="no-color" href="mailto:<?php echo esc_attr(wp_trim_words($email));?>"><?php echo esc_attr($email);?></a>
												</div>
											</div>
										</li>
									<?php } ?>
									<?php if(!empty($address)){ ?>									
										<li class="d-flex">
											<div class="icon color-secondary">
												<i class="flaticon-map-pin-silhouette"></i>
											</div>
											<div class="flex-fill">
												<div class="item-lb"><?php echo esc_html__('Location','ronby');?></div>
												<div class="item-text">
													<a class="no-color" href="#">
											<?php echo esc_attr($address);?>
													</a>
												</div>
											</div>
										</li>
									<?php } ?>
									</ul>
								</div>
							</div>
							
<?php	
 }

  function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['telephone']= strip_tags( $new_instance['telephone'] );
    $instance['email']= strip_tags( $new_instance['email'] );
    $instance['address']= strip_tags( $new_instance['address'] );
return $instance;
  }


  function form($instance){
    $defaults = array( 
      'title'               => '',
      'telephone'              => '',
      'email'        => '',
      'address'       => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
	$allowed_html = array(
    'span' => array(
        'class' => array(),
        'style' => array()
    ),
    'br' => array(),
    'strong' => array(),
    'p' => array(),
);
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>"><?php esc_html_e('Telephone', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telephone' )); ?>" class="widefat" value="<?php echo esc_attr($instance['telephone']); ?>">
	  <small><?php echo esc_html__('Enter here your telephone number. Example: +1-234-5689','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php esc_html_e('Email', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" class="widefat" value="<?php echo esc_attr($instance['email']); ?>">
	  <small><?php echo esc_html__('Enter here your email address. Example: xyz@example.com','ronby'); ?></small>
    </p>	
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e('Address', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" class="widefat" value="<?php echo esc_attr($instance['address']); ?>">
	  <small><?php echo esc_html__('Enter here your company address.','ronby'); ?></small>
    </p>

			
  <?php
  }

}//end of class

 
function register_ronby_contact_us_one_widget() {
  register_widget( 'ronby_contact_us_one_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_contact_us_one_widget' );

/*************************
Ronby Flickr Album Photos Widget
*************************/
class ronby_flickr_album_photos_widget extends WP_Widget {

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'ronby_flickr_widget', 'description' => __( 'Display your Flickr photostream', 'ronby' ) );
		$control_ops = array( 'id_base' => 'ronby_flickr_widget' );
		parent::__construct( 'ronby_flickr_widget', __( 'Ronby Flickr Album Widget', 'ronby' ), $widget_ops, $control_ops );

		$this->defaults = array(
			'title' => 'Flickr Photos',
			'id' => '',
			'count' => 9,
			't_width' => 85,
			't_height' => 65,
			'randomize' => 0,
		);

		//Allow themes or plugins to modify default parameters
		$this->defaults = apply_filters( 'ronby_flickr_widget_modify_defaults', $this->defaults );
	}


	function widget( $args, $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$photos = $this->get_photos( $instance['id'], $instance['count'] );

		if ( !empty( $photos ) ) {

			if($instance['randomize']){
				shuffle($photos);
			}

			$height = $instance['t_height'] ? $instance['t_height'].'px' : 'auto';
			$style = 'width: '.esc_attr( $instance['t_width'] ).'px; height: '.esc_attr( $height ).';';

			echo '<div class="flickr">';
			foreach ( $photos as $photo ) {
				echo '<a href="'.esc_url( $photo['img_url'] ).'"><div style="background-image:url('.esc_attr( $photo['img_src'] ).');background-size:cover;display:inline-block;margin-right:5px;background-position:center;'.$style.'" ></div></a>';
			}
			echo '</div>';
			echo '<div class="clear"></div>';
		}
		echo $after_widget;
	}


	function get_photos( $id, $count = 8 ) {
		if ( empty( $id ) )
			return false;

		$transient_key = md5( 'ronby_flickr_cache_' . $id . $count );
		$cached = get_transient( $transient_key );
		if ( !empty( $cached ) ) {
			return $cached;
		}

		$protocol = is_ssl() ? 'https' : 'http';
		$output = array();
		$rss = $protocol.'://api.flickr.com/services/feeds/photos_public.gne?id='.$id.'&lang=en-us&format=rss_200';
		$rss = fetch_feed( $rss );

		if ( is_wp_error( $rss ) ) {
			//check for group feed
			$rss = $protocol.'://api.flickr.com/services/feeds/groups_pool.gne?id='.$id.'&lang=en-us&format=rss_200';
			$rss = fetch_feed( $rss );
		}

		if ( !is_wp_error( $rss ) ) {
			$maxitems = $rss->get_item_quantity( $count );
			$rss_items = $rss->get_items( 0, $maxitems );
			foreach ( $rss_items as $item ) {
				$temp = array();
				$temp['img_url'] = esc_url( $item->get_permalink() );
				$temp['title'] = esc_html( $item->get_title() );
				$content =  $item->get_content();
				preg_match_all( "/<IMG.+?SRC=[\"']([^\"']+)/si", $content, $sub, PREG_SET_ORDER );
				$photo_url = str_replace( "_m.jpg", "_t.jpg", $sub[0][1] );
				$temp['img_src'] = esc_url( $photo_url );
				$output[] = $temp;
			}

			set_transient( $transient_key, $output, 60 * 60 * 24 );
		}

		//print_r( $output );

		return $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['count'] = absint( $new_instance['count'] );
		$instance['t_width'] = absint( $new_instance['t_width'] );
		$instance['t_height'] = absint( $new_instance['t_height'] );
		$instance['randomize'] = isset( $new_instance['randomize'] ) ? 1 : 0;
		return $new_instance;
	}


	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ronby' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'Flickr ID', 'ronby' ); ?>:</label> <small><a href="http://idgettr.com/" target="_blank"><?php _e( 'What\'s my Flickr ID?', 'ronby' ); ?></a></small>
			<input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" value="<?php echo esc_attr( $instance['id'] ); ?>" />
			<small class="howto"><?php _e( 'Example ID: 23100287@N07', 'ronby' ); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of photos', 'ronby' ); ?>:</label>
			<input class="small-text" type="text" value="<?php echo absint( $instance['count'] ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 't_width' ); ?>"><?php _e( 'Thumbnail width', 'ronby' ); ?>:</label>
			<input class="small-text" type="text" value="<?php echo absint( $instance['t_width'] ); ?>" id="<?php echo $this->get_field_id( 't_width' ); ?>" name="<?php echo $this->get_field_name( 't_width' ); ?>" /> px
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 't_height' ); ?>"><?php _e( 'Thumbnail height', 'ronby' ); ?>:</label>
			<input class="small-text" type="text" value="<?php echo absint( $instance['t_height'] ); ?>" id="<?php echo $this->get_field_id( 't_height' ); ?>" name="<?php echo $this->get_field_name( 't_height' ); ?>" /> px
			<small class="howto"><?php _e( 'Note: You can use "0" value for auto height', 'ronby' ); ?></small>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'randomize' ); ?>">
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'randomize' ); ?>" name="<?php echo $this->get_field_name( 'randomize' ); ?>" <?php checked( $instance['randomize'], 1 ); ?>/> <?php _e( 'Randomize photos?', 'ronby' ); ?>
		</label>
		</p>

		<?php
	}

}//end of class

 
function register_ronby_flickr_album_photos_widget() {
  register_widget( 'ronby_flickr_album_photos_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_flickr_album_photos_widget' );

/*************************
Ronby Contact us- 2 Widget
*************************/
class ronby_contact_us_two_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_contact_us_two', // Base ID
      esc_html__('Ronby Contact us Two Widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays contact details', 'ronby'), ) // Args
    );
  }


  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
	  $telephone= isset($instance['telephone']) ? $instance['telephone'] : '';
	  $email= isset($instance['email']) ? $instance['email'] : '';
	  $address= isset($instance['address']) ? $instance['address'] : '';
	  $time= isset($instance['time']) ? $instance['time'] : '';
	  
  ?>				

							
					<div class="widget contact-us-two-widget">
						<?php if(!empty($title)){ ?>
							<h3 class="widget-title"><?php echo esc_attr($title);?></h3>
						<?php } ?>
							<div class="widget-contact-infomation-2">
								<ul class="list-unstyled">
								<?php if(!empty($telephone)){ ?>
									<li class="d-flex">
										<div class="flex-auto">
											<div class="icon color-primary">
												<i class="fas fa-phone"></i>
											</div>
										</div>
										<div class="flex-fill">												<a class="no-color animated" href="tel:<?php echo esc_attr(wp_trim_words($telephone));?>"><?php echo esc_attr($telephone);?></a>
										</div>
									</li>
								<?php } ?>	
								<?php if(!empty($email)){ ?>
									<li class="d-flex">
										<div class="flex-auto">
											<div class="icon color-primary">
												<i class="fas  fa-envelope"></i>
											</div>
										</div>
										<div class="flex-fill">
										<a class="no-color animated" href="mailto:<?php echo esc_attr(wp_trim_words($email));?>"><?php echo esc_attr($email);?></a>
										</div>
									</li>
								<?php } ?>	
									<?php if(!empty($time)){ ?>
									<li class="d-flex">
										<div class="flex-auto">
											<div class="icon color-primary">
												<i class="fas fa-clock"></i>
											</div>
										</div>
										<div class="flex-fill">
											<?php echo esc_attr($time);?>
										</div>
									</li>
									<?php } ?>
									<?php if(!empty($address)){ ?>
									<li class="d-flex">
										<div class="flex-auto">
											<div class="icon color-primary">
												<i class="fas fa-map-marker"></i>
											</div>
										</div>
										<div class="flex-fill">
											<a class="no-color animated" href="#"><?php echo esc_attr($address);?></a>
										</div>
									</li>
									<?php } ?>
								</ul>
							</div>
							
						</div>		
							
<?php	
 }

  function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['telephone']= strip_tags( $new_instance['telephone'] );
    $instance['email']= strip_tags( $new_instance['email'] );
    $instance['address']= strip_tags( $new_instance['address'] );
    $instance['time']= strip_tags( $new_instance['time'] );
return $instance;
  }


  function form($instance){
    $defaults = array( 
      'title'               => '',
      'telephone'              => '',
      'email'        => '',
      'address'       => '',
      'time'       => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );

  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>"><?php esc_html_e('Telephone', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telephone' )); ?>" class="widefat" value="<?php echo esc_attr($instance['telephone']); ?>">
	  <small><?php echo esc_html__('Enter here your telephone number. Example: +1-234-5689','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php esc_html_e('Email', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" class="widefat" value="<?php echo esc_attr($instance['email']); ?>">
	  <small><?php echo esc_html__('Enter here your email address. Example: xyz@example.com','ronby'); ?></small>
    </p>	
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e('Address', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" class="widefat" value="<?php echo esc_attr($instance['address']); ?>">
	  <small><?php echo esc_html__('Enter here your company address.','ronby'); ?></small>
    </p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"><?php esc_html_e('Working Day and Time', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['time']); ?>">
	  <small><?php echo esc_html__('Enter here your company Working days a week and time a day.','ronby'); ?></small>
    </p>
			
  <?php
  }

}//end of class

 
function register_ronby_contact_us_two_widget() {
  register_widget( 'ronby_contact_us_two_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_contact_us_two_widget' );

/*************************
Ronby Opening Hours Widget
*************************/
class ronby_opening_hours_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_opening_hours', // Base ID
      esc_html__('Ronby Opening Hour\'s Widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays business opening hour\'s details', 'ronby'), ) // Args
    );
  }


  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
	  $day1_name= isset($instance['day1_name']) ? $instance['day1_name'] : '';
	  $day1_time= isset($instance['day1_time']) ? $instance['day1_time'] : '';
	  $day2_name= isset($instance['day2_name']) ? $instance['day2_name'] : '';
	  $day2_time= isset($instance['day2_time']) ? $instance['day2_time'] : '';	
	  $day3_name= isset($instance['day3_name']) ? $instance['day3_name'] : '';
	  $day3_time= isset($instance['day3_time']) ? $instance['day3_time'] : '';	
	  $day4_name= isset($instance['day4_name']) ? $instance['day4_name'] : '';
	  $day4_time= isset($instance['day4_time']) ? $instance['day4_time'] : '';	
	  $day5_name= isset($instance['day5_name']) ? $instance['day5_name'] : '';
	  $day5_time= isset($instance['day5_time']) ? $instance['day5_time'] : '';	
	  $day6_name= isset($instance['day6_name']) ? $instance['day6_name'] : '';
	  $day6_time= isset($instance['day6_time']) ? $instance['day6_time'] : '';	  $day7_name= isset($instance['day7_name']) ? $instance['day7_name'] : '';
	  $day7_time= isset($instance['day7_time']) ? $instance['day7_time'] : '';		  
  ?>				

							
					<div class="widget opening-hours-widget">
						<?php if(!empty($title)){ ?>
							<h3 class="widget-title"><?php echo esc_attr($title);?></h3>
						<?php } ?>
					<div class="widget-timetable">
								<ul class="list-unstyled">
								<?php if(!empty($day1_name) && !empty($day1_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day1_name);?></span>
										<span><?php echo esc_attr($day1_time);?></span>
									</li>
								<?php } ?>	
								<?php if(!empty($day2_name) && !empty($day2_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day2_name);?></span>
										<span><?php echo esc_attr($day2_time);?></span>
									</li>
								<?php } ?>	
								<?php if(!empty($day3_name) && !empty($day3_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day3_name);?></span>
										<span><?php echo esc_attr($day3_time);?></span>
									</li>
								<?php } ?>	
									<?php if(!empty($day4_name) && !empty($day4_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day4_name);?></span>
										<span><?php echo esc_attr($day4_time);?></span>
									</li>
								<?php } ?>	
								<?php if(!empty($day5_name) && !empty($day5_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day5_name);?></span>
										<span><?php echo esc_attr($day5_time);?></span>
									</li>
								<?php } ?>	
										<?php if(!empty($day6_name) && !empty($day6_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day6_name);?></span>
										<span><?php echo esc_attr($day6_time);?></span>
									</li>
								<?php } ?>	
								<?php if(!empty($day7_name) && !empty($day7_time)) { ?>
									<li class="d-flex justify-content-between">
										<span class="text-uppercase"><?php echo esc_attr($day7_name);?></span>
										<span><?php echo esc_attr($day7_time);?></span>
									</li>
								<?php } ?>	
								</ul>
							</div>
							
						</div>		
							
<?php	
 }

  function update( $new_instance, $old_instance ){
    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['day1_name']= strip_tags( $new_instance['day1_name'] );
    $instance['day1_time']= strip_tags( $new_instance['day1_time'] );
    $instance['day2_name']= strip_tags( $new_instance['day2_name'] );
    $instance['day2_time']= strip_tags( $new_instance['day2_time'] );
	$instance['day3_name']= strip_tags( $new_instance['day3_name'] );
    $instance['day3_time']= strip_tags( $new_instance['day3_time'] );
    $instance['day4_name']= strip_tags( $new_instance['day4_name'] );
    $instance['day4_time']= strip_tags( $new_instance['day4_time'] );
    $instance['day5_name']= strip_tags( $new_instance['day5_name'] );
    $instance['day5_time']= strip_tags( $new_instance['day5_time'] );
    $instance['day6_name']= strip_tags( $new_instance['day6_name'] );
    $instance['day6_time']= strip_tags( $new_instance['day6_time'] );
    $instance['day7_name']= strip_tags( $new_instance['day7_name'] );
    $instance['day7_time']= strip_tags( $new_instance['day7_time'] );	
	return $instance;
  }


  function form($instance){
    $defaults = array( 
      'title'               => '',
      'day1_name'               => '',
      'day1_time'               => '',
      'day2_name'               => '',
      'day2_time'               => '',
      'day3_name'               => '',
      'day3_time'               => '',	
      'day4_name'               => '',
      'day4_time'               => '',
      'day5_name'               => '',
      'day5_time'               => '',
      'day6_name'               => '',
      'day6_time'               => '',	
      'day7_name'               => '',
      'day7_time'               => '',	  
    );
    $instance = wp_parse_args( (array) $instance, $defaults );

  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day1_name' )); ?>"><?php esc_html_e('Business Working Day-1 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day1_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day1_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day1_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day1_time' )); ?>"><?php esc_html_e('Business Working Day-1 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day1_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day1_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day1_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-1 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day2_name' )); ?>"><?php esc_html_e('Business Working Day-2 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day2_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day2_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day2_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day2_time' )); ?>"><?php esc_html_e('Business Working Day-2 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day2_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day2_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day2_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-2 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day3_name' )); ?>"><?php esc_html_e('Business Working Day-3 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day3_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day3_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day3_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day3_time' )); ?>"><?php esc_html_e('Business Working Day-3 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day3_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day3_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day3_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-3 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day4_name' )); ?>"><?php esc_html_e('Business Working Day-4 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day4_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day4_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day4_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day4_time' )); ?>"><?php esc_html_e('Business Working Day-4 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day4_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day4_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day4_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-4 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>	
	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day5_name' )); ?>"><?php esc_html_e('Business Working Day-5 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day5_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day5_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day5_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day5_time' )); ?>"><?php esc_html_e('Business Working Day-5 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day5_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day5_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day5_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-5 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day6_name' )); ?>"><?php esc_html_e('Business Working Day-6 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day6_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day6_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day6_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day6_time' )); ?>"><?php esc_html_e('Business Working Day-6 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day6_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day6_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day6_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-6 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day7_name' )); ?>"><?php esc_html_e('Business Working Day-7 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day7_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day7_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day7_name']); ?>">
	  <small><?php echo esc_html__('Enter here wroking day name. Example: Monday','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'day7_time' )); ?>"><?php esc_html_e('Business Working Day-7 Opening Hours', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'day7_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'day7_time' )); ?>" class="widefat" value="<?php echo esc_attr($instance['day7_time']); ?>">
	  <small><?php echo esc_html__('Enter here day-7 wroking hours time. Example: 08:00 am - 12:00 pm','ronby'); ?></small>
    </p>	
  <?php
  }

}//end of class

 
function register_ronby_opening_hours_widget() {
  register_widget( 'ronby_opening_hours_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_opening_hours_widget' );

// **********************************************************************// 
// ! Ronby WP Color picker for widgets
// **********************************************************************//
function ronby_widgets_colorpicker_scripts( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'wp-color-picker' ); 
}
add_action( 'admin_enqueue_scripts', 'ronby_widgets_colorpicker_scripts' );




/**********************
Ronby Instagram Widgets
************************/

Class ronby_instagram_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'ronby-instagram-feed',
			__( 'Ronby Instagram Widget', 'ronby' ),
			array(
				'classname' => 'ronby-instagram-feed',
				'description' => esc_html__( 'Displays your most recent Instagram photos', 'ronby' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	function widget( $args, $instance ) {

		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$size = 'thumbnail';
		$width = empty( $instance['width'] ) ? '85px' : $instance['width'];
		$height = empty( $instance['height'] ) ? '85px' : $instance['height'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];

		echo $args['before_widget'];

		if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };

		do_action( 'ronby_before_widget', $instance );

		if ( '' !== $username ) {

			$media_array = $this->scrape_instagram( $username );

			if ( is_wp_error( $media_array ) ) {

				echo wp_kses_post( $media_array->get_error_message() );

			} else {

				// filter for images only?
				if ( $images_only = apply_filters( 'ronby_images_only', false ) ) {
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				}

				// slice list down to required limit.
				$media_array = array_slice( $media_array, 0, $limit );

				// filters for custom classes.
				$ulclass = apply_filters( 'ronby_list_class', 'instagram-pics instagram-size-' . $size );
				$liclass = apply_filters( 'ronby_item_class', '' );
				$aclass = apply_filters( 'ronby_a_class', '' );
				$imgclass = apply_filters( 'ronby_img_class', '' );

				?><div class="<?php echo esc_attr( $ulclass ); ?>"><?php
				foreach( $media_array as $item ) {
						echo '<a href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $target ) . '"  class="' . esc_attr( $aclass ) . '"><div class="' . esc_attr( $liclass ) . '" style="background-image:url(' . esc_url( $item[$size] ) . ');background-position:top;display:inline-block;margin-right:5px;width:'.esc_attr($width).';height:'.esc_attr($height).';"></div></a>';
					
				}
				?></div><?php
			}
		}

		$linkclass = apply_filters( 'ronby_link_class', 'clear' );
		$linkaclass = apply_filters( 'ronby_linka_class', '' );

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url = '//instagram.com/explore/tags/' . str_replace( '#', '', $username );
				break;

			default:
				$url = '//instagram.com/' . str_replace( '@', '', $username );
				break;
		}

		if ( '' !== $link ) {
			?><p class="<?php echo esc_attr( $linkclass ); ?>" style="    margin-top: 5px;"><a href="<?php echo trailingslashit( esc_url( $url ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>" class="<?php echo esc_attr( $linkaclass ); ?>" style="padding:8px;background: #3897f0;border-color: #3897f0;color: #fff;border-radius: 5px;"><?php echo wp_kses_post( $link ); ?></a></p><?php
		}

		do_action( 'ronby_after_widget', $instance );

		echo $args['after_widget'];
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' => __( 'Instagram Photos', 'ronby' ),
			'username' => '',
			'width' => '85px',
			'height' => '85px',
			'link' => __( 'Follow Me!', 'ronby' ),
			'number' => 9,
			'target' => '_self',
		) );
		$title = $instance['title'];
		$username = $instance['username'];
		$number = absint( $instance['number'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$target = $instance['target'];
		$link = $instance['link'];
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'ronby' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( '@username or #tag', 'ronby' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'ronby' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e( 'Custom Width', 'ronby' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" /></label><small><?php echo esc_html__('Enter here image width in pixel. Example: 85px','');?></small></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Custom Height', 'ronby' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" /></label><small><?php echo esc_html__('Enter here image height in pixel. Example: 85px','');?></small></p>
		
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'ronby' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ); ?>><?php esc_html_e( 'Current window (_self)', 'ronby' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ); ?>><?php esc_html_e( 'New window (_blank)', 'ronby' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'ronby' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /></label></p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		$instance['width'] = trim( strip_tags( $new_instance['width'] ) );
		$instance['height'] = trim( strip_tags( $new_instance['height'] ) );
		$instance['target'] = ( ( '_self' === $new_instance['target'] || '_blank' === $new_instance['target'] ) ? $new_instance['target'] : '_self' );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;
	}

	// based on https://gist.github.com/cosmocatalano/4544576.
	function scrape_instagram( $username ) {

		$username = trim( strtolower( $username ) );

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
				$transient_prefix = 'h';
				break;

			default:
				$url              = 'https://instagram.com/' . str_replace( '@', '', $username );
				$transient_prefix = 'u';
				break;
		}

		if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( $url );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'ronby' ) );
			}

			if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'ronby' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], true );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'ronby' ) );
			}

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
			} elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'ronby' ) );
			}

			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'ronby' ) );
			}

			$instagram = array();

			foreach ( $images as $image ) {
				if ( true === $image['node']['is_video'] ) {
					$type = 'video';
				} else {
					$type = 'image';
				}

				$caption = __( 'Instagram Image', 'ronby' );
				if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
					$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
				}

				$instagram[] = array(
					'description' => $caption,
					'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
					'time'        => $image['node']['taken_at_timestamp'],
					'comments'    => $image['node']['edge_media_to_comment']['count'],
					'likes'       => $image['node']['edge_liked_by']['count'],
					'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
					'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
					'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
					'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
					'type'        => $type,
				);
			} // End foreach().

			// do not set an empty transient - should help catch private or empty accounts.
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			return unserialize( base64_decode( $instagram ) );

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'ronby' ) );

		}
	}

	function images_only( $media_item ) {

		if ( 'image' === $media_item['type'] ) {
			return true;
		}

		return false;
	}
}
function ronby_widget() {
	register_widget( 'ronby_instagram_widget' );
}
add_action( 'widgets_init', 'ronby_widget' );

/*************************
Ronby Doctors List Widget
*************************/
class ronby_doctors_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_doctors_list', // Base ID
      esc_html__('Ronby Doctor\'s List widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays top doctors details', 'ronby'), ) // Args
    );
  }


  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
	  $d1_image= isset($instance['d1_image']) ? $instance['d1_image'] : '';
	  $d1_name= isset($instance['d1_name']) ? $instance['d1_name'] : '';
	  $d1_desg= isset($instance['d1_desg']) ? $instance['d1_desg'] : '';
	  $d1_bio_url= isset($instance['d1_bio_url']) ? $instance['d1_bio_url'] : '';
	  
	  $d2_image= isset($instance['d2_image']) ? $instance['d2_image'] : '';
	  $d2_name= isset($instance['d2_name']) ? $instance['d2_name'] : '';
	  $d2_desg= isset($instance['d2_desg']) ? $instance['d2_desg'] : '';
	  $d2_bio_url= isset($instance['d2_bio_url']) ? $instance['d2_bio_url'] : '';	  
	  $d3_image= isset($instance['d3_image']) ? $instance['d3_image'] : '';
	  $d3_name= isset($instance['d3_name']) ? $instance['d3_name'] : '';
	  $d3_desg= isset($instance['d3_desg']) ? $instance['d3_desg'] : '';
	  $d3_bio_url= isset($instance['d3_bio_url']) ? $instance['d3_bio_url'] : '';	  
	  $d4_image= isset($instance['d4_image']) ? $instance['d4_image'] : '';
	  $d4_name= isset($instance['d4_name']) ? $instance['d4_name'] : '';
	  $d4_desg= isset($instance['d4_desg']) ? $instance['d4_desg'] : '';
	  $d4_bio_url= isset($instance['d4_bio_url']) ? $instance['d4_bio_url'] : '';	  
	  $d5_image= isset($instance['d5_image']) ? $instance['d5_image'] : '';
	  $d5_name= isset($instance['d5_name']) ? $instance['d5_name'] : '';
	  $d5_desg= isset($instance['d5_desg']) ? $instance['d5_desg'] : '';
	  $d5_bio_url= isset($instance['d5_bio_url']) ? $instance['d5_bio_url'] : '';
	  $doctor_name_color = isset($instance['doctor_name_color']) ? $instance['doctor_name_color'] : '';	 
	  $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
  ?>
				<div class="widget ronby-doctors-list">
						<?php if(!empty($title)){ ?>
							<h3 class="widget-title"><?php echo esc_attr($title);?></h3>
						<?php } ?>
						<?php if(!empty($d1_name) && !empty($d1_desg)){ ?>	
								<div class="widget-post-item-2 d-flex align-items-center">
								<?php if(!empty($d1_image)){ ?>
									<div class="avatar">
										<a href="<?php echo esc_url($d1_bio_url);?>">
											<img src="<?php echo esc_url($d1_image);?>" alt="Profile-Picture">
										</a>
									</div>
								<?php } ?>	
									<div class="item-text flex-grow-1 flex-shrink-1">
										<a class="no-color" href="<?php echo esc_url($d1_bio_url);?>">
											<h3 class="item-title hover-color-secondary animate-300">
												<span class="color-secondary" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php echo esc_html__('Dr.','ronby');?> </span><span <?php if($doctor_name_color){echo"style='color:".esc_attr($doctor_name_color)."'";} ?>> <?php echo esc_attr($d1_name);?></span>
											</h3>
										</a>
										<h4 class="item-description">
											<?php echo esc_attr($d1_desg);?>
										</h4>
									</div>
								</div>
						<?php } ?>	
						<?php if(!empty($d2_name) && !empty($d2_desg)){ ?>	
								<div class="widget-post-item-2 d-flex align-items-center">
								<?php if(!empty($d2_image)){ ?>
									<div class="avatar">
										<a href="<?php echo esc_url($d2_bio_url);?>">
											<img src="<?php echo esc_url($d2_image);?>" alt="Profile-Picture">
										</a>
									</div>
								<?php } ?>	
									<div class="item-text flex-grow-1 flex-shrink-1">
										<a class="no-color" href="<?php echo esc_url($d2_bio_url);?>">
											<h3 class="item-title hover-color-secondary animate-300">
												<span class="color-secondary" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php echo esc_html__('Dr.','ronby');?> </span> <span <?php if($doctor_name_color){echo"style='color:".esc_attr($doctor_name_color)."'";} ?>> <?php echo esc_attr($d2_name);?></span>
											</h3>
										</a>
										<h4 class="item-description">
											<?php echo esc_attr($d2_desg);?>
										</h4>
									</div>
								</div>
						<?php } ?>
						<?php if(!empty($d3_name) && !empty($d3_desg)){ ?>	
								<div class="widget-post-item-2 d-flex align-items-center">
								<?php if(!empty($d3_image)){ ?>
									<div class="avatar">
										<a href="<?php echo esc_url($d3_bio_url);?>">
											<img src="<?php echo esc_url($d3_image);?>" alt="Profile-Picture">
										</a>
									</div>
								<?php } ?>	
									<div class="item-text flex-grow-1 flex-shrink-1">
										<a class="no-color" href="<?php echo esc_url($d3_bio_url);?>">
											<h3 class="item-title hover-color-secondary animate-300">
												<span class="color-secondary" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php echo esc_html__('Dr.','ronby');?> </span> <span <?php if($doctor_name_color){echo"style='color:".esc_attr($doctor_name_color)."'";} ?>> <?php echo esc_attr($d3_name);?></span>
											</h3>
										</a>
										<h4 class="item-description">
											<?php echo esc_attr($d3_desg);?>
										</h4>
									</div>
								</div>
						<?php } ?>
							<?php if(!empty($d4_name) && !empty($d4_desg)){ ?>	
								<div class="widget-post-item-2 d-flex align-items-center">
								<?php if(!empty($d4_image)){ ?>
									<div class="avatar">
										<a href="<?php echo esc_url($d4_bio_url);?>">
											<img src="<?php echo esc_url($d4_image);?>" alt="Profile-Picture">
										</a>
									</div>
								<?php } ?>	
									<div class="item-text flex-grow-1 flex-shrink-1">
										<a class="no-color" href="<?php echo esc_url($d4_bio_url);?>">
											<h3 class="item-title hover-color-secondary animate-300">
												<span class="color-secondary" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php echo esc_html__('Dr.','ronby');?> </span> <span <?php if($doctor_name_color){echo"style='color:".esc_attr($doctor_name_color)."'";} ?>> <?php echo esc_attr($d4_name);?></span>
											</h3>
										</a>
										<h4 class="item-description">
											<?php echo esc_attr($d4_desg);?>
										</h4>
									</div>
								</div>
						<?php } ?>
							<?php if(!empty($d5_name) && !empty($d5_desg)){ ?>	
								<div class="widget-post-item-2 d-flex align-items-center">
								<?php if(!empty($d5_image)){ ?>
									<div class="avatar">
										<a href="<?php echo esc_url($d5_bio_url);?>">
											<img src="<?php echo esc_url($d5_image);?>" alt="Profile-Picture">
										</a>
									</div>
								<?php } ?>	
									<div class="item-text flex-grow-1 flex-shrink-1">
										<a class="no-color" href="<?php echo esc_url($d5_bio_url);?>">
											<h3 class="item-title hover-color-secondary animate-300">
												<span class="color-secondary" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php echo esc_html__('Dr.','ronby');?> </span> <span <?php if($doctor_name_color){echo"style='color:".esc_attr($doctor_name_color)."'";} ?>> <?php echo esc_attr($d5_name);?></span>
											</h3>
										</a>
										<h4 class="item-description">
											<?php echo esc_attr($d5_desg);?>
										</h4>
									</div>
								</div>
						<?php } ?>	
						
						</div>
							
<?php	
 }

  function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['d1_image']= strip_tags( $new_instance['d1_image'] );
    $instance['d1_name']= strip_tags( $new_instance['d1_name'] );
    $instance['d1_desg']= strip_tags( $new_instance['d1_desg'] );
    $instance['d1_bio_url']= strip_tags( $new_instance['d1_bio_url'] );
    $instance['d2_image']= strip_tags( $new_instance['d2_image'] );
    $instance['d2_name']= strip_tags( $new_instance['d2_name'] );
    $instance['d2_desg']= strip_tags( $new_instance['d2_desg'] );
	$instance['d2_bio_url']= strip_tags( $new_instance['d2_bio_url'] );
    $instance['d3_image']= strip_tags( $new_instance['d3_image'] );
    $instance['d3_name']= strip_tags( $new_instance['d3_name'] );
    $instance['d3_desg']= strip_tags( $new_instance['d3_desg'] );
	$instance['d3_bio_url']= strip_tags( $new_instance['d3_bio_url'] );	
    $instance['d4_image']= strip_tags( $new_instance['d4_image'] );
    $instance['d4_name']= strip_tags( $new_instance['d4_name'] );
    $instance['d4_desg']= strip_tags( $new_instance['d4_desg'] );	
	$instance['d4_bio_url']= strip_tags( $new_instance['d4_bio_url'] );		
    $instance['d5_image']= strip_tags( $new_instance['d5_image'] );
    $instance['d5_name']= strip_tags( $new_instance['d5_name'] );
    $instance['d5_desg']= strip_tags( $new_instance['d5_desg'] );
	$instance['d5_bio_url']= strip_tags( $new_instance['d5_bio_url'] );	
	$instance['doctor_name_color']= strip_tags( $new_instance['doctor_name_color'] );
	$instance['title_color']= strip_tags( $new_instance['title_color'] );
return $instance;
  }


  function form($instance){
    $defaults = array( 
      'title'               => '',
      'd1_image'               => '',
      'd1_name'               => '',
      'd1_desg'               => '',
      'd1_bio_url'               => '',
      'd2_image'               => '',
      'd2_name'               => '',
      'd2_desg'               => '',
      'd2_bio_url'               => '',
      'd3_image'               => '',
      'd3_name'               => '',
      'd3_desg'               => '',
      'd3_bio_url'               => '',
      'd4_image'               => '',
      'd4_name'               => '',
      'd4_desg'               => '',
      'd4_bio_url'               => '',
      'd5_image'               => '',
      'd5_name'               => '',
      'd5_desg'               => '',
      'd5_bio_url'               => '',
      'doctor_name_color'               => '',
      'title_color'               => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd1_image' )); ?>"><?php esc_html_e('Doctor- 1 Image URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd1_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd1_image' )); ?>" class="widefat" value="<?php echo esc_url($instance['d1_image']); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd1_name' )); ?>"><?php esc_html_e('Doctor- 1 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd1_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd1_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d1_name']); ?>">
	  
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd1_desg' )); ?>"><?php esc_html_e('Doctor- 1 Designation', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd1_desg' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd1_desg' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d1_desg']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd1_bio_url' )); ?>"><?php esc_html_e('Doctor- 1 Profile Page URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd1_bio_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd1_bio_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['d1_bio_url']); ?>">
	  
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd2_image' )); ?>"><?php esc_html_e('Doctor- 2 Image URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd2_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd2_image' )); ?>" class="widefat" value="<?php echo esc_url($instance['d2_image']); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd2_name' )); ?>"><?php esc_html_e('Doctor- 2 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd2_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd2_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d2_name']); ?>">
	  
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd2_desg' )); ?>"><?php esc_html_e('Doctor- 2 Designation', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd2_desg' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd2_desg' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d2_desg']); ?>">  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd2_bio_url' )); ?>"><?php esc_html_e('Doctor- 2 Profile Page URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd2_bio_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd2_bio_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['d2_bio_url']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd3_image' )); ?>"><?php esc_html_e('Doctor- 3 Image URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd3_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd3_image' )); ?>" class="widefat" value="<?php echo esc_url($instance['d3_image']); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd3_name' )); ?>"><?php esc_html_e('Doctor- 3 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd3_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd3_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d3_name']); ?>">
	  
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd3_desg' )); ?>"><?php esc_html_e('Doctor- 3 Designation', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd3_desg' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd3_desg' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d3_desg']); ?>">  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd3_bio_url' )); ?>"><?php esc_html_e('Doctor- 3 Profile Page URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd3_bio_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd3_bio_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['d3_bio_url']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd4_image' )); ?>"><?php esc_html_e('Doctor- 4 Image URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd4_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd4_image' )); ?>" class="widefat" value="<?php echo esc_url($instance['d4_image']); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd4_name' )); ?>"><?php esc_html_e('Doctor- 4 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd4_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd4_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d4_name']); ?>">
	  
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd4_desg' )); ?>"><?php esc_html_e('Doctor- 4 Designation', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd4_desg' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd4_desg' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d4_desg']); ?>">  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd4_bio_url' )); ?>"><?php esc_html_e('Doctor- 4 Profile Page URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd4_bio_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd4_bio_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['d4_bio_url']); ?>">
	  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd5_image' )); ?>"><?php esc_html_e('Doctor- 5 Image URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd5_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd5_image' )); ?>" class="widefat" value="<?php echo esc_url($instance['d5_image']); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd5_name' )); ?>"><?php esc_html_e('Doctor- 5 Name', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd5_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd5_name' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d5_name']); ?>">
	  
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd5_desg' )); ?>"><?php esc_html_e('Doctor- 5 Designation', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd5_desg' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd5_desg' )); ?>" class="widefat" value="<?php echo esc_attr($instance['d5_desg']); ?>">  
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'd5_bio_url' )); ?>"><?php esc_html_e('Doctor- 5 Profile Page URL', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'd5_bio_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'd5_bio_url' )); ?>" class="widefat" value="<?php echo esc_url($instance['d5_bio_url']); ?>">
	 
    </p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'doctor_name_color ' )); ?>"><?php esc_html_e('Doctor Name Color', 'ronby'); ?></label><br/>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'doctor_name_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'doctor_name_color' )); ?>" class="widefat doctor_name_color" value="<?php echo esc_attr($instance['doctor_name_color']); ?>">
    </p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title_color ' )); ?>"><?php esc_html_e('Title Color', 'ronby'); ?></label><br/>
  <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_color' )); ?>" class="widefat title_color" value="<?php echo esc_attr($instance['title_color']); ?>">
</p>	
	<script>
		jQuery(document).ready(function($){
			jQuery('.doctor_name_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});	
			jQuery('.title_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});				
		});
	</script>	
  <?php
  }

}//end of class

 
function register_ronby_doctors_list_widget() {
  register_widget( 'ronby_doctors_list_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_doctors_list_widget' );

/*******************************
Ronby Recent Post List- 2 Widget
********************************/


class ronby_recent_post_list_two extends WP_Widget {

	protected static $text_domain = 'ronby';
	protected static $ver = '0.0.1'; //for cache busting
	protected static $transient_limit = 60;


	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'ronby_recent_post_list_two', // Base ID
			'Ronby Recent Post List Two', // Name
			array( 'description' => __( 'Displays blog most recent posts', self::$text_domain ), ) // Args
		);
	}


	/**
	 * Front-end display of widget.
	 * @see WP_Widget::widget()
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Posts' );
		$number_posts  = ( ! empty( $instance['number_posts'] ) || ! is_integer( $instance['number_posts'] ) ) ? $instance['number_posts'] : 5;
		$character  = ( ! empty( $instance['character'] ) ) ? $instance['character'] : 70;
		$sign  = ( ! empty( $instance['sign'] )  ) ? $instance['sign'] : '';
		$title         = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$post_type     = esc_attr( $instance['post-type'] );
		$taxonomy      = esc_attr( $instance['taxonomy'] );
		$term_slug     = esc_attr( $instance['term_slug'] );
		$orderby       = esc_attr( $instance['orderby'] );
		$order         = esc_attr( $instance['order'] );
		$atts          = array(
			'post_type'    => $post_type,
			'taxonomy'     => $taxonomy,
			'term_slug'    => $term_slug,
			'number_posts' => $number_posts,
			'orderby'      => $orderby,
			'order'        => $order,
		);
		$posts         = $this->get( $atts );
		?>
		<?php extract( $args ); ?>
		<?php echo $before_widget; ?>
		<?php 
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			?>
			<div>
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<div class="widget-post-item-4">
						<div class="post-date color-primary"><?php echo get_the_date() ; ?></div>
						<div class="post-excerpt"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="no-color"><?php if(!empty(get_the_excerpt())){ echo substr(get_the_excerpt(), 0,$character) ?><?php echo esc_html__($sign,'ronby');?><?php } ?></a></div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php echo $after_widget; ?>
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['title']        = esc_attr( $new_instance['title'] );
		$instance['order']        = esc_attr( $new_instance['order'] );
		$instance['orderby']      = esc_attr( $new_instance['orderby'] );
		$instance['post-type']    = esc_attr( $new_instance['post-type'] );
		$instance['taxonomy']     = esc_attr( $new_instance['taxonomy'] );
		$instance['term_slug']    = esc_attr( $new_instance['term_slug'] );
		$instance['number_posts'] = (int) $new_instance['number_posts'];
		$instance['character'] = (int) $new_instance['character'];
		$instance['sign'] = $new_instance['sign'];
		delete_transient( $this->id );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defaults = array(
			'title'        => __( 'Latest Posts', self::$text_domain ),
			'order'        => null,
			'orderby'      => null,
			'post-type'    => null,
			'taxonomy'     => null,
			'term_slug'    => null,
			'number_posts' => __( 3, self::$text_domain ),
			'character' => __( 70, self::$text_domain ),
			'sign' => __( '[...]', self::$text_domain ),
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<div class="ronby-form">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', self::$text_domain ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php _e( 'Number of Posts:', self::$text_domain ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo $instance['number_posts']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'character' ); ?>"><?php _e( 'How many character will display in post description:', self::$text_domain ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'character' ); ?>" name="<?php echo $this->get_field_name( 'character' ); ?>" type="text" value="<?php echo $instance['character']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'sign' ); ?>"><?php _e( 'Read More Sign:', self::$text_domain ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'sign' ); ?>" name="<?php echo $this->get_field_name( 'sign' ); ?>" type="text" value="<?php echo $instance['sign']; ?>" />
			</p>			
			<p class="post-types-wrap">
				<label for="<?php echo $this->get_field_id( 'post-type' ); ?>"><?php _e( 'Post Type:', self::$text_domain ); ?></label>
				<?php wp_nonce_field( 'nonce_ronby', 'nonce_ronby' ); ?>
				<select class="ronby-post-types widefat" id="<?php echo $this->get_field_id( 'post-type' ); ?>" name="<?php echo $this->get_field_name( 'post-type' ); ?>">
					<?php echo RONBY_Helper::get_post_types( $instance['post-type'] ); ?>
				</select>
				<span class="loading"></span>

			</p>

			<p class="taxonomies-wrap">
				<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Taxonomy:', self::$text_domain ); ?></label>
				<select class="ronby-taxonomies widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
					<?php if ( $instance['post-type'] ) { ?>
						<?php echo RONBY_Helper::get_taxonomies( $instance['post-type'], $instance['taxonomy'] ); ?>

					<?php } ?>
				</select>
				<span class="block"><small><?php _e( 'Tip: Leave Taxonomy as "No Specific Taxonomy" to have the widget display post types regardless of taxonomy/term.', self::$text_domain ); ?></small></span>
				<span class="loading"></span>
			</p>
			<p class="terms-wrap">
				<label for="<?php echo $this->get_field_id( 'term_slug' ); ?>"><?php _e( 'Term:', self::$text_domain ); ?></label>
				<select class="terms widefat" id="<?php echo $this->get_field_id( 'term_slug' ); ?>" name="<?php echo $this->get_field_name( 'term_slug' ); ?>">
					<?php if ( $instance['post-type'] ) { ?>
						<?php echo RONBY_Helper::get_terms( $instance['taxonomy'], $instance['term_slug'] ); ?>

					<?php } ?>
				</select>
			</p>
			<hr>
			<p class="orderby-wrap">
				<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order by: ', self::$text_domain ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
					<option> <?php echo esc_html__('-- Default orderby parameter --','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'date' ) ?> value="date"><?php echo esc_html__('Date','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'modified' ) ?> value="modified"><?php echo esc_html__('Modified','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'title' ) ?> value="title"><?php echo esc_html__('Title','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'author' ) ?> value="author"><?php echo esc_html__('Author','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'name' ) ?> value="name"><?php echo esc_html__('Name','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'id' ) ?> value="id"><?php echo esc_html__('ID','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'parent' ) ?> value="parent"><?php echo esc_html__('Parent','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'rand' ) ?> value="rand"><?php echo esc_html__('Random','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'menu_order' ) ?> value="menu_order"><?php echo esc_html__('Menu Order','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'comment_count' ) ?> value="comment_count"><?php echo esc_html__('Comment Count','ronby'); ?></option>
					<option <?php selected( $instance['orderby'], 'none' ) ?> value="none"><?php echo esc_html__('None','ronby'); ?></option>
				</select>
			</p>
			<p class="order-wrap">
				<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:', self::$text_domain ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
					<option> <?php echo esc_html__('-- Default order parameter --','ronby'); ?></option>
					<option <?php selected( $instance['order'], 'asc' ) ?> value="asc"><?php echo esc_html__('Ascending','ronby'); ?></option>
					<option <?php selected( $instance['order'], 'desc' ) ?> value="desc"><?php echo esc_html__('Descending','ronby'); ?></option>
				</select>
			<div>
				<small><?php echo esc_html__('Order and orderby are not required.','ronby'); ?></small>
			</div>
			</p>

		</div>
		<script>
			if (typeof(ronbySetupForms) == typeof(Function)) {
				ronbySetupForms();
			}
		</script>


	<?php
	}


	/**
	 * Get the posts
	 *
	 * Filter(s):
	 *
	 * @param array $atts          - list of attributes to use in the query
	 * @param array $transient_key - transient key normalized to the widget's ID
	 *
	 * @return array Updated safe values to be saved.
	 */

    public function get( $atts ) {

        $number_posts = $atts['number_posts'];
        $post_type    = $atts['post_type'];
        $term_slug    = $atts['term_slug'];
        $taxonomy     = $atts['taxonomy'];
        $order        = $atts['order'];
        $orderby      = $atts['orderby'];
        if ( $taxonomy === 'category' ) {
            $taxonomy = 'category_name';
        }
        if ( $taxonomy === 'post_tag' ) {
            $taxonomy = 'tag';
        }
        $args = array(
            'posts_per_page' => $number_posts,
            'post_type'      => $post_type,
        );
        if ( $taxonomy && $term_slug ) {
            $args = array_merge( $args, array( $taxonomy => $term_slug ) );
        }
        if ( $orderby ) {
            $args = array_merge( $args, array( 'orderby' => $orderby ) );
        }
        if ( $order ) {
            $args = array_merge( $args, array( 'order' => $order ) );
        }

        $args          = apply_filters( 'ronby_get_args', $args );
        $transient_key = md5( serialize( array( $args, $this->id ) ) );
        $posts         = get_transient( $transient_key );
        if ( ! $posts ) {
            $posts = new WP_Query( $args );
            set_transient( $transient_key, $posts, self::$transient_limit );
        }

        return $posts;
    }

	/**
	 * Enqueue CSS and JavaScripts
	 */
	public static function enqueue() {
		if ( is_admin() ) { ?>
		<script>
var ronbyForms, ronbySetupForms;
jQuery(document).ready(function($){
    ronbyForms = function(){
        $("body").on("change", ".ronby-post-types", function(){
            var $parent = $(this).closest('.ronby-form'),
                $postTypesWrap = $parent.find('.post-types-wrap'),
                $taxonomiesWrap = $parent.find('.taxonomies-wrap'),
                $termsWrap = $parent.find('.terms-wrap'),
                $loading = $postTypesWrap.find('.loading'),
                postType = $(this).val(),
                data = {
                    action: "ronby_post_type_selected",
                    postType: postType,
                    ronbyNonce: ronbyAjax.ronbyNonce
                };
            if (postType) {

                $loading.css('display', 'block');
                $.post(ajaxurl, data, function(response) {
                    $taxonomiesWrap.find(".ronby-taxonomies").empty().html(response);
                    $taxonomiesWrap.show();
                    $termsWrap.hide();
                    $loading.css('display', 'none');
                });        
            } else {
                $taxonomiesWrap.hide();
                $termsWrap.hide();
            }
        });
        $("body").on("change", ".ronby-taxonomies", function(){
            var $parent = $(this).closest('.ronby-form'),
                $termsWrap = $parent.find('.terms-wrap'),
                $taxonomiesWrap = $parent.find('.taxonomies-wrap'),
                taxonomy = $(this).val(),
                $loading = $taxonomiesWrap.find('.loading'),
                data = {
                    action: "ronby_taxonomy_selected",
                    taxonomy: taxonomy,
                    ronbyNonce: ronbyAjax.ronbyNonce
                };
            if (taxonomy) {
                $loading.css('display', 'block');
                console.log($loading.html());
                $termsWrap.hide();
                $.post(ajaxurl, data, function(response) {
                    $parent.find(".terms").empty().html(response);
                    $termsWrap.show();
                    $loading.css('display', 'none');
                    $termsWrap.show();
                });   
            } else {
                $termsWrap.hide();
            }

        });
    };
    ronbySetupForms = function(){
        $(".ronby-form").each(function(){
            var $postTypesWrap = $(this).find('.post-types-wrap'),
                $taxonomiesWrap = $(this).find('.taxonomies-wrap'),
                $termsWrap = $(this).find('.terms-wrap'),
                $postTypes = $postTypesWrap.find('.ronby-post-types'),
                $taxonomies = $taxonomiesWrap.find('.ronby-taxonomies'),
                $terms = $termsWrap.find('.terms');
            if ($postTypes.val()){
                $taxonomiesWrap.show();
            } else {
                $taxonomiesWrap.hide();
            }
            if ($taxonomies.val()){
                $termsWrap.show();
            } else {
                $termsWrap.hide();
            }            
        });
    };
    ronbyForms();
    ronbySetupForms();
});
		
			
		</script>
		<?php	wp_localize_script( 'ronby-admin', 'ronbyAjax', array(
					'ronbyNonce' => wp_create_nonce( 'nonce_ronby' ),
				)
			);
		}
	}

} 


class RONBY_Helper {

	public static function post_types() {
		$recent_post_types   = get_post_types( array( '_builtin' => false ) );
		$recent_post_types[] = 'post';
		$recent_post_types[] = 'page';
		$recent_post_types   = apply_filters( 'ronby_post_types', $recent_post_types );

		return $recent_post_types;
	}

	public static function get_taxonomies( $post_type, $selected = null ) {

		$taxonomies = get_object_taxonomies( $post_type );
		$taxonomies = apply_filters( 'ronby_taxonomies', $taxonomies );
		if ( $taxonomies ) {
			$output = '<option value=""> -- No Specific Taxonomy -- </option>';
			foreach ( $taxonomies as $taxonomy ) {
				$selected_option = '';
				if ( $selected !== null ) {
					$selected_option = selected( $taxonomy, $selected, false );
				}

				$output .= '<option value="' . $taxonomy . '" ' . $selected_option . '>' . $taxonomy . '</option>';
			}
		} else {
			$output = '<option value=""> -- No Taxonomies Available for ' . $post_type . ' -- </option>';
		}

		return $output;
	}

	public static function get_terms( $taxonomy, $selected = null ) {

		$terms = get_terms( $taxonomy );
		if ( $terms ) {
			$output = '<option value=""> -- Choose a Term -- </option>';
			foreach ( $terms as $term ) {
				$selected_option = '';
				$id              = $term->slug;
				$name            = $term->name;
				if ( $selected !== null ) {
					$selected_option = selected( $id, $selected, false );
				}
				$output .= '<option value="' . $id . '" ' . $selected_option . '>' . $name . '</option>';
			}
		} else {
			$output = '<option value=""> -- No Terms available for ' . $taxonomy . ' -- </option>';
		}

		return $output;
	}

	public static function get_post_types( $selected = null ) {
		$output = '<option value=""> -- Choose a Post Type -- </option>';
		foreach ( self::post_types() as $post_type ) {
			$selected_output = '';
			if ( $selected !== null ) {
				$selected_output = selected( $post_type, $selected, false );
			}
			$output .= '<option ' . $selected_output . 'value=' . $post_type . '>' . $post_type . '</option>';
		}

		return $output;
	}
}


class RONBY_AJAX {

	public static function init() {
		add_action( 'wp_ajax_ronby_post_type_selected', array( __CLASS__, 'select_taxonomy_callback' ) );
		add_action( 'wp_ajax_ronby_taxonomy_selected', array( __CLASS__, 'select_term_callback' ) );
	}

	public static function select_taxonomy_callback() {
		$nonce = $_POST['ronbyNonce'];
		if ( ! wp_verify_nonce( $nonce, 'nonce_ronby' ) ) {
			die;
		}
		$post_type = $_POST['postType'];
		$output    = RONBY_Helper::get_taxonomies( $post_type );
		echo $output;
		die;
	}

	public static function select_term_callback() {
		$nonce = $_POST['ronbyNonce'];
		if ( ! wp_verify_nonce( $nonce, 'nonce_ronby' ) ) {
			die;
		}
		$taxonomy = $_POST['taxonomy'];
		$output   = RONBY_Helper::get_terms( $taxonomy );
		echo $output;
		die;
	}


}

RONBY_AJAX::init();

function register_ronby_recent_post_list_two() {
  register_widget( 'ronby_recent_post_list_two' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_recent_post_list_two');

/*************************
Start subscription- 2 widget
*************************/
class ronby_subscription_two_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ronby_subscription_two', // Base ID
      esc_html__('Ronby Subscription Two Widget', 'ronby'), // Name
      array( 'description' => esc_html__( 'Displays ronby subscription area style- 2.', 'ronby'), ) // Args
    );
  }

  public function widget( $args, $instance ) {
	  extract($args);
	  $title = isset($instance['title']) ? $instance['title'] : '';
	  $desc = isset($instance['desc']) ? $instance['desc'] : '';
	  $telephone = isset($instance['telephone']) ? $instance['telephone'] : '';
	  $email = isset($instance['email']) ? $instance['email'] : '';
	  $address = isset($instance['address']) ? $instance['address'] : '';
      $current_time = isset($instance['current_time']) ? $instance['current_time'] : '';
	  $allowed_html = array(
		'span' => array(
			'class' => array(),
			'style' => array()
		),
		'br' => array(),
		'strong' => array(),
		'p' => array(),
	);		  
  ?>
  <?php
  $before_widget = $args['before_widget'];
  $after_widget = $args['after_widget'];
  echo $before_widget; 
  ?>
  <div class="subscription-widget-two">
  <?php if($title){ ?>
  <h3 class="widget-title <?php echo esc_attr($current_time); ?>" <?php if(!empty($widget_title_color)) {?>style="color:<?php echo esc_attr($widget_title_color); ?>" <?php } ?>><?php echo esc_attr($title); ?></h3>
  <?php } ?>
 							<div class="widget-text">
							<?php if(!empty($desc)){ ?>
								<p>
								<?php echo wp_kses($desc,$allowed_html); ?>
								</p>
							<?php } ?>		
							</div> 
  <?php if(ronby_get_option('ft_aweber_listid') != '') { ?>
	<div class="widget-subscribe mb-4">
	<div class="form-group">
  <form method="post" action="https://www.aweber.com/scripts/addlead.pl">
	<div class="form-group-with-button">
		<input type="hidden" name="redirect" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage') ); ?>" />
		<input type="hidden" name="meta_redirect_onlist" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage_old') ); ?>" />
		<input type="hidden" name="meta_message" value="<?php esc_html_e('1', 'ronby');?>" /> 
		<input type="hidden" name="meta_required" value="<?php esc_html_e('email', 'ronby');?>" />
		<input name="email" class="form-element-styled form-group-input" id="samplees" placeholder="<?php esc_html_e('Your email address', 'ronby');?>" type="text" required />
		<button type="submit" class="form-group-button background-primary color-inverse animate-300 hover-background-secondary"> <i class="fas fa-angle-right"></i></button>
	</div>	
  </form>
	</div>
	</div>
  <?php } elseif ((ronby_get_option('mailchimp_apikey') != '') && (ronby_get_option('mailchimp_listid') != '')){ ?>
	<div class="widget-subscribe mb-4">
	<div class="form-group">
	<form   method="post" class="newsletter">
		<input name="email" class="email-input input-styled" id="newsletter-email" placeholder="<?php esc_html_e('Enter your Email', 'ronby');?>" type="email" required />
		<button type="submit" class="button button-primary submit-button"><i class="fas fa-angle-right"></i></button>
	  <div class="output"></div>
	  <div class="newsletter-loader"><img src="<?php echo plugin_dir_url(__FILE__);?>/images/newsletter_loader.gif" alt="newsletter-loader"/></div>	  
	</form>
	</div>
	</div>
<?php if(function_exists('ronby_newsletter_without_loading')){ echo ronby_newsletter_without_loading();} ?>	
  <?php } else { ?>
	<div class="widget-subscribe mb-4">
	<div class="form-group">
 <form method="post" action="#">
		<input type="hidden" name="redirect" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage') ); ?>" />
		<input type="hidden" name="meta_redirect_onlist" value="<?php echo esc_url( ronby_get_option('aweber_redirectpage_old') ); ?>" />
		<input type="hidden" name="meta_message" value="<?php esc_html_e('1', 'ronby');?>" /> 
		<input type="hidden" name="meta_required" value="<?php esc_html_e('email', 'ronby');?>" />
		<input name="email" class="email-input input-styled" id="newsletter-email" placeholder="<?php esc_html_e('Enter your Email', 'ronby');?>" type="email" required />
		<button type="submit" class="button button-primary submit-button"><i class="fas fa-angle-right"></i></button>
  </form>
	</div>
	</div>
  <?php } ?>
 								<ul class="list-unstyled" style="font-size: 16px;">
								<?php if(!empty($telephone)){ ?>
									<li class="mb-3">
										<i class="fas fa-phone color-primary mr-2" ></i> <?php echo esc_attr($telephone);?>
									</li>
								<?php } ?>	
								<?php if(!empty($email)){ ?>
									<li class="mb-3">
										<i class="fas  fa-envelope color-primary  mr-2"></i> <?php echo esc_attr($email);?>
									</li>
								<?php } ?>	
								<?php if(!empty($address)){ ?>								
									<li>
										<i class="fas fa-map-marker color-primary  mr-2"></i> <?php echo esc_attr($address);?>
									</li>
								<?php } ?>	
								</ul> 
  </div> 
  <?php echo $after_widget; ?>
	<?php
  }
  
  

  function update( $new_instance, $old_instance ){

    $instance = $old_instance;
    $instance['title']= strip_tags( $new_instance['title'] );
    $instance['desc']= strip_tags( $new_instance['desc'] );
    $instance['telephone']= strip_tags( $new_instance['telephone'] );
    $instance['email']= strip_tags( $new_instance['email'] );
    $instance['address']= strip_tags( $new_instance['address'] );
    $instance['current_time']= strip_tags( $new_instance['current_time'] );
    return $instance;

  }

  function form($instance){
    $defaults = array( 
      'title'               => '',
      'desc'               => '',
      'telephone'               => '',
      'email'               => '',
      'address'               => '',
      'current_time'           => time()
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
	  $allowed_html = array(
		'span' => array(
			'class' => array(),
			'style' => array()
		),
		'br' => array(),
		'strong' => array(),
		'p' => array(),
	);		
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'title ' )); ?>"><?php esc_html_e('Title', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>">
    </p>
	
   <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>"><?php esc_html_e('Description', 'ronby'); ?></label>
      <textarea type="text" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>" class="widefat" ><?php echo wp_kses($instance['desc'],$allowed_html); ?></textarea>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>"><?php esc_html_e('Telephone', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'telephone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telephone' )); ?>" class="widefat" value="<?php echo esc_attr($instance['telephone']); ?>">
	  <small><?php echo esc_html__('Enter here your telephone number. Example: +1-234-5689','ronby'); ?></small>
    </p>	
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php esc_html_e('Email', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" class="widefat" value="<?php echo esc_attr($instance['email']); ?>">
	  <small><?php echo esc_html__('Enter here your email address. Example: xyz@example.com','ronby'); ?></small>
    </p>	
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e('Address', 'ronby'); ?></label>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" class="widefat" value="<?php echo esc_attr($instance['address']); ?>">
	  <small><?php echo esc_html__('Enter here your company address.','ronby'); ?></small>
    </p>

	
	<input type="hidden" id="<?php echo esc_attr($this->get_field_id( 'current_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'current_time' )); ?>" class="widefat" value="<?php echo time(); ?>">
	
  <?php
  }

}//end of class

// register ronby_subscription_widget widget
function register_ronby_subscription_two_widget() {
  register_widget( 'ronby_subscription_two_widget' );  // Class Name
}
add_action( 'widgets_init', 'register_ronby_subscription_two_widget' );

/**************************************************************
Ronby Category List widget
**************************************************************/
class ronby_categories_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ronby_categories_widget', // Base ID
			__( 'Ronby Category List Widget', 'ronby' ), // Name
			array( 'description' => esc_html__( 'Display categories list of all taxonomy post type', 'ronby' ), ) // Args
		);
		if(!is_admin())

		add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), array(&$this,'ronby_add_settings_link') );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$va_category_HTML ='<div class="widget-menu-1">';
		if ( ! empty( $instance['ronby_title'] ) && !$instance['ronby_hide_title']) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['ronby_title'] ) . $args['after_title'];
		}
		$list_color = isset($instance['list_color']) ? $instance['list_color'] : '';	

		/** return category list */
		if($instance['ronby_taxonomy_type']){
			$va_category_HTML .='<ul class="no-style">';
				$args_val = array( 'hide_empty=0' );				
				$excludeCat= $instance['ronby_selected_categories'] ? $instance['ronby_selected_categories'] : '';
				$ronby_action_on_cat= $instance['ronby_action_on_cat'] ? $instance['ronby_action_on_cat'] : '';
				if($excludeCat && $ronby_action_on_cat!='')
				$args_val[$ronby_action_on_cat] = $excludeCat;
				
				$terms = get_terms( $instance['ronby_taxonomy_type'], $args_val );
				if ( $terms ) {	

					foreach ( $terms as $term ) {
						
						$term_link = get_term_link( $term );
						
						if ( is_wp_error( $term_link ) ) {
						continue;
						}
						
					$carrentActiveClass='';	
					
					if($term->taxonomy=='category' && is_category())
					{
					  $thisCat = get_category(get_query_var('cat'),false);
					  if($thisCat->term_id == $term->term_id)
						$carrentActiveClass='active';
				    }
					 
					if(is_tax())
					{
					    $currentTermType = get_query_var( 'taxonomy' );
					    $termId= get_queried_object()->term_id;
						 if(is_tax($currentTermType) && $termId==$term->term_id)
						  $carrentActiveClass='active';
					}
						
						$va_category_HTML .='<li class="d-flex justify-content-between animate-300 hover-color-primary '.$carrentActiveClass.'" ><a href="' . esc_url( $term_link ) . '" class="no-color" ';if($list_color){$va_category_HTML.='style="color:'.esc_attr($list_color).'"';}$va_category_HTML.='><span ';if($list_color){$va_category_HTML.='style="color:'.esc_attr($list_color).'"';}$va_category_HTML.='>' . $term->name . '</span></a>';
						if (empty( $instance['ronby_hide_count'] )) {
						$va_category_HTML .='<span class="post-count">'.$term->count.'</span>';
						}
						$va_category_HTML .='</li>';
					}
				}
			$va_category_HTML .='</ul>';
			
			}	
			$va_category_HTML .='</div>';
		echo $va_category_HTML;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$ronby_title 					= ! empty( $instance['ronby_title'] ) ? $instance['ronby_title'] : esc_html__( 'Our Categories', 'ronby' );
		$ronby_hide_title 			= ! empty( $instance['ronby_hide_title'] ) ? $instance['ronby_hide_title'] : esc_html__( '', 'ronby' );
		$ronby_taxonomy_type 			= ! empty( $instance['ronby_taxonomy_type'] ) ? $instance['ronby_taxonomy_type'] : esc_html__( 'category', 'ronby' );
		$ronby_selected_categories 	= (! empty( $instance['ronby_selected_categories'] ) && ! empty( $instance['ronby_action_on_cat'] ) ) ? $instance['ronby_selected_categories'] : esc_html__( '', 'ronby' );
		$ronby_action_on_cat 			= ! empty( $instance['ronby_action_on_cat'] ) ? $instance['ronby_action_on_cat'] : esc_html__( '', 'ronby' );
		$ronby_hide_count 			= ! empty( $instance['ronby_hide_count'] ) ? $instance['ronby_hide_count'] : esc_html__( '', 'ronby' );
		$list_color= ! empty( $instance['list_color'] ) ? $instance['list_color'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_title' ) ); ?>" type="text" value="<?php echo esc_attr( $ronby_title ); ?>">
		</p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_hide_title' ) ); ?>" type="checkbox" value="1" <?php checked( $ronby_hide_title, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_title' ) ); ?>"><?php _e( esc_attr( 'Hide Title' ) ); ?> </label> 
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_taxonomy_type' ) ); ?>"><?php _e( esc_attr( 'Taxonomy Type:' ) ); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_taxonomy_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_taxonomy_type' ) ); ?>">
					<?php 
					$args = array(
					  'public'   => true,
					  '_builtin' => false
					  
					); 
					$output = 'names'; // or objects
					$operator = 'and'; // 'and' or 'or'
					$taxonomies = get_taxonomies( $args, $output, $operator ); 
					array_push($taxonomies,'category');
					if ( $taxonomies ) {
					foreach ( $taxonomies as $taxonomy ) {

						echo '<option value="'.$taxonomy.'" '.selected($taxonomy,$ronby_taxonomy_type).'>'.$taxonomy.'</option>';
					}
					}

				?>    
		</select>
		</p>
		<p>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_action_on_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_action_on_cat' ) ); ?>">
           <option value="" <?php selected($ronby_action_on_cat,'' )?> >Show All Category:</option>       
           <option value="include" <?php selected($ronby_action_on_cat,'include' )?> >Include Selected Category:</option>       
           <option value="exclude" <?php selected($ronby_action_on_cat,'exclude' )?> >Exclude Selected Category:</option>
		</select> 
		</p>
		<p>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_selected_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_selected_categories' ) ); ?>[]" multiple>
					<?php 			
					if($ronby_taxonomy_type){
					$args = array( 'hide_empty=0' );
					$terms = get_terms( $ronby_taxonomy_type, $args );
			        echo '<option value="" '.selected(true, in_array('',$ronby_selected_categories), false).'>None</option>';
					if ( $terms ) {
					foreach ( $terms as $term ) {
						echo '<option value="'.$term->term_id.'" '.selected(true, in_array($term->term_id,$ronby_selected_categories), false).'>'.$term->name.'</option>';
					}
				    	
					}
				}

				?>    
		</select>
		</p>
		<p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_hide_count' ) ); ?>" type="checkbox" value="1" <?php checked( $ronby_hide_count, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_count' ) ); ?>"><?php _e( esc_attr( 'Hide Count' ) ); ?> </label> 
		</p>
	<p>
      <label for="<?php echo esc_attr($this->get_field_id( 'list_color ' )); ?>"><?php esc_html_e('List Color', 'ronby'); ?></label><br/>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'list_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'list_color' )); ?>" class="widefat list_color" value="<?php echo esc_attr($instance['list_color']); ?>">
    </p>
	<script>
		jQuery(document).ready(function($){
			jQuery('.list_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});		
		});
	</script>	
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ronby_title'] 					= ( ! empty( $new_instance['ronby_title'] ) ) ? strip_tags( $new_instance['ronby_title'] ) : '';
		$instance['ronby_hide_title'] 			= ( ! empty( $new_instance['ronby_hide_title'] ) ) ? strip_tags( $new_instance['ronby_hide_title'] ) : '';
		$instance['ronby_taxonomy_type'] 			= ( ! empty( $new_instance['ronby_taxonomy_type'] ) ) ? strip_tags( $new_instance['ronby_taxonomy_type'] ) : '';
		$instance['ronby_selected_categories'] 	= ( ! empty( $new_instance['ronby_selected_categories'] ) ) ? $new_instance['ronby_selected_categories'] : '';
		$instance['ronby_action_on_cat'] 			= ( ! empty( $new_instance['ronby_action_on_cat'] ) ) ? $new_instance['ronby_action_on_cat'] : '';
		$instance['ronby_hide_count'] 			= ( ! empty( $new_instance['ronby_hide_count'] ) ) ? strip_tags( $new_instance['ronby_hide_count'] ) : '';
		$instance['list_color']= strip_tags( $new_instance['list_color'] );
		return $instance;
	}


}

// register widget
function register_ronby_categories_widget() {
    register_widget( 'ronby_categories_widget' );
}
add_action( 'widgets_init', 'register_ronby_categories_widget');



/**************************************************************
Ronby Category List widget- 2
**************************************************************/
class ronby_categories_widget_2 extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ronby_categories_widget_2', // Base ID
			esc_html__( 'Ronby Category List Widget- 2', 'ronby' ), // Name
			array( 'description' => esc_html__( 'Display categories list of all taxonomy post type with Style- 2', 'ronby' ), ) // Args
		);
		if(!is_admin())

		add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), array(&$this,'ronby_add_settings_link') );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$va_category_HTML ='<div class="widget-menu-8">';
		if ( ! empty( $instance['ronby_title'] ) && !$instance['ronby_hide_title']) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['ronby_title'] ) . $args['after_title'];
		}
	

		/** return category list */
		if($instance['ronby_taxonomy_type']){
			$va_category_HTML .='<ul class="no-style">';
				$args_val = array( 'hide_empty=0' );				
				$excludeCat= $instance['ronby_selected_categories'] ? $instance['ronby_selected_categories'] : '';
				$ronby_action_on_cat= $instance['ronby_action_on_cat'] ? $instance['ronby_action_on_cat'] : '';
				if($excludeCat && $ronby_action_on_cat!='')
				$args_val[$ronby_action_on_cat] = $excludeCat;
				
				$terms = get_terms( $instance['ronby_taxonomy_type'], $args_val );
				if ( $terms ) {	

					foreach ( $terms as $term ) {
						
						$term_link = get_term_link( $term );
						
						if ( is_wp_error( $term_link ) ) {
						continue;
						}
						
					$carrentActiveClass='';	
					
					if($term->taxonomy=='category' && is_category())
					{
					  $thisCat = get_category(get_query_var('cat'),false);
					  if($thisCat->term_id == $term->term_id)
						$carrentActiveClass='active';
				    }
					 
					if(is_tax())
					{
					    $currentTermType = get_query_var( 'taxonomy' );
					    $termId= get_queried_object()->term_id;
						 if(is_tax($currentTermType) && $termId==$term->term_id)
						  $carrentActiveClass='active';
					}
						
						$va_category_HTML .='<li class="hover-color-secondary '.$carrentActiveClass.'"><a href="' . esc_url( $term_link ) . '" class="no-color d-flex justify-content-between"><span class="category-name">' . $term->name . '</span>';
						if (empty( $instance['ronby_hide_count'] )) {
						$va_category_HTML .='<span class="count">'.$term->count.'</span></a>';
						}
						$va_category_HTML .='</li>';
					}
				}
			$va_category_HTML .='</ul>';
			
			}	
			$va_category_HTML .='</div>';
		echo $va_category_HTML;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$ronby_title 					= ! empty( $instance['ronby_title'] ) ? $instance['ronby_title'] : esc_html__( 'Our Categories', 'ronby' );
		$ronby_hide_title 			= ! empty( $instance['ronby_hide_title'] ) ? $instance['ronby_hide_title'] : esc_html__( '', 'ronby' );
		$ronby_taxonomy_type 			= ! empty( $instance['ronby_taxonomy_type'] ) ? $instance['ronby_taxonomy_type'] : esc_html__( 'category', 'ronby' );
		$ronby_selected_categories 	= (! empty( $instance['ronby_selected_categories'] ) && ! empty( $instance['ronby_action_on_cat'] ) ) ? $instance['ronby_selected_categories'] : esc_html__( '', 'ronby' );
		$ronby_action_on_cat 			= ! empty( $instance['ronby_action_on_cat'] ) ? $instance['ronby_action_on_cat'] : esc_html__( '', 'ronby' );
		$ronby_hide_count 			= ! empty( $instance['ronby_hide_count'] ) ? $instance['ronby_hide_count'] : esc_html__( '', 'ronby' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_title' ) ); ?>" type="text" value="<?php echo esc_attr( $ronby_title ); ?>">
		</p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_hide_title' ) ); ?>" type="checkbox" value="1" <?php checked( $ronby_hide_title, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_title' ) ); ?>"><?php _e( esc_attr( 'Hide Title' ) ); ?> </label> 
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_taxonomy_type' ) ); ?>"><?php _e( esc_attr( 'Taxonomy Type:' ) ); ?></label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_taxonomy_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_taxonomy_type' ) ); ?>">
					<?php 
					$args = array(
					  'public'   => true,
					  '_builtin' => false
					  
					); 
					$output = 'names'; // or objects
					$operator = 'and'; // 'and' or 'or'
					$taxonomies = get_taxonomies( $args, $output, $operator ); 
					array_push($taxonomies,'category');
					if ( $taxonomies ) {
					foreach ( $taxonomies as $taxonomy ) {

						echo '<option value="'.$taxonomy.'" '.selected($taxonomy,$ronby_taxonomy_type).'>'.$taxonomy.'</option>';
					}
					}

				?>    
		</select>
		</p>
		<p>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_action_on_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_action_on_cat' ) ); ?>">
           <option value="" <?php selected($ronby_action_on_cat,'' )?> >Show All Category:</option>       
           <option value="include" <?php selected($ronby_action_on_cat,'include' )?> >Include Selected Category:</option>       
           <option value="exclude" <?php selected($ronby_action_on_cat,'exclude' )?> >Exclude Selected Category:</option>
		</select> 
		</p>
		<p>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_selected_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_selected_categories' ) ); ?>[]" multiple>
					<?php 			
					if($ronby_taxonomy_type){
					$args = array( 'hide_empty=0' );
					$terms = get_terms( $ronby_taxonomy_type, $args );
			        echo '<option value="" '.selected(true, in_array('',$ronby_selected_categories), false).'>None</option>';
					if ( $terms ) {
					foreach ( $terms as $term ) {
						echo '<option value="'.$term->term_id.'" '.selected(true, in_array($term->term_id,$ronby_selected_categories), false).'>'.$term->name.'</option>';
					}
				    	
					}
				}

				?>    
		</select>
		</p>
		<p>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ronby_hide_count' ) ); ?>" type="checkbox" value="1" <?php checked( $ronby_hide_count, 1 ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ronby_hide_count' ) ); ?>"><?php _e( esc_attr( 'Hide Count' ) ); ?> </label> 
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ronby_title'] 					= ( ! empty( $new_instance['ronby_title'] ) ) ? strip_tags( $new_instance['ronby_title'] ) : '';
		$instance['ronby_hide_title'] 			= ( ! empty( $new_instance['ronby_hide_title'] ) ) ? strip_tags( $new_instance['ronby_hide_title'] ) : '';
		$instance['ronby_taxonomy_type'] 			= ( ! empty( $new_instance['ronby_taxonomy_type'] ) ) ? strip_tags( $new_instance['ronby_taxonomy_type'] ) : '';
		$instance['ronby_selected_categories'] 	= ( ! empty( $new_instance['ronby_selected_categories'] ) ) ? $new_instance['ronby_selected_categories'] : '';
		$instance['ronby_action_on_cat'] 			= ( ! empty( $new_instance['ronby_action_on_cat'] ) ) ? $new_instance['ronby_action_on_cat'] : '';
		$instance['ronby_hide_count'] 			= ( ! empty( $new_instance['ronby_hide_count'] ) ) ? strip_tags( $new_instance['ronby_hide_count'] ) : '';
		return $instance;
	}


}

// register widget
function register_ronby_categories_widget_2() {
    register_widget( 'ronby_categories_widget_2' );
}
add_action( 'widgets_init', 'register_ronby_categories_widget_2');

// **********************************************************************// 
// ! Ronby Recent Post Widget- 1
// **********************************************************************//
class ronby_recent_posts_widget_one extends WP_Widget {

	var $defaults;		// default values
	var $bools_false;	// key names of bool variables of value 'false'
	var $bools_true;	// key names of bool variables of value 'true'
	var $ints;			// key names of integer variables of any value
	var $customs;		// user defined values
	var $use_inline_css;// class wide setting, bool type
	var $use_no_css;	// class wide setting, bool type

	function __construct() {
		$language_codes = explode( '_', get_locale() );
		switch ( $language_codes[ 0 ] ) {
			default:
				$widget_name = 'Ronby Recent Post List One';
				$widget_desc = 'List of your blogs most recent posts with  thumbnails.';
		}
		$this->defaults[ 'category_ids' ]		= array( 0 ); // selected categories
		$this->defaults[ 'category_label' ]		= _x( 'In', 'In {categories}', 'ronby' ); // label for category list
		$this->defaults[ 'css_file_path' ]		= dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'public.css'; // path of the public css file
		$this->defaults[ 'excerpt_length' ]		= absint( apply_filters( 'ronby_excerpt_length', 55 ) ); // default length: 55 characters
		$this->defaults[ 'excerpt_more' ]		= apply_filters( 'ronby_excerpt_more', ' ' . '[&hellip;]' ); // set ellipses as default 'more'
		$this->defaults[ 'number_posts' ]		= 5; // number of posts to show in the widget
		$this->defaults[ 'plugin_slug' ]		= 'ronby'; // identifier of this plugin for WP
		$this->defaults[ 'plugin_version' ]		= '6.4.0'; // number of current plugin version
		$this->defaults[ 'post_title_length' ] 	= 1000; // default length: 1000 characters
		$this->defaults[ 'thumb_dimensions' ]	= 'custom'; // dimensions of the thumbnail
		$this->defaults[ 'thumb_height' ] 		= absint( round( get_option( 'thumbnail_size_h', 110 ) / 2 ) ); // custom height of the thumbnail
		$this->defaults[ 'thumb_url' ]			= plugins_url( 'default_thumb.gif', __FILE__ ); // URL of the default thumbnail
		$this->defaults[ 'thumb_width' ]		= absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ); // custom width of the thumbnail
		$this->defaults[ 'widget_title' ]		= ''; // title of the widget
		// Domain name and protocol of WP site
		$parsed_url = parse_url( home_url() );
		$this->defaults[ 'site_protocol' ]		= $parsed_url[ 'host' ];
		$this->defaults[ 'site_url' ]			= $parsed_url[ 'scheme' ];
		unset( $parsed_url );
		// other vars
		$this->bools_false						= array( 'hide_current_post', 'only_sticky_posts', 'hide_sticky_posts', 'hide_title', 'keep_aspect_ratio', 'keep_sticky', 'only_1st_img', 'random_order', 'show_author', 'show_categories', 'show_comments_number', 'show_date', 'show_excerpt', 'ignore_excerpt', 'set_more_as_link', 'try_1st_img', 'use_default', 'open_new_window', 'print_post_categories', 'set_cats_as_links', 'use_inline_css', 'use_no_css' );
		$this->bools_true						= array( 'show_thumb' );
		$this->ints 							= array( 'excerpt_length', 'number_posts', 'post_title_length', 'thumb_height', 'thumb_width' );
		$this->valid_excerpt_sources			= array( 'post_content', 'excerpt_field' );
		$widget_ops 							= array( 'classname' => $this->defaults[ 'plugin_slug' ], 'description' => $widget_desc );
		parent::__construct( $this->defaults[ 'plugin_slug' ], $widget_name, $widget_ops );

		add_action( 'save_post',				array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post',				array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme',				array( $this, 'flush_widget_cache' ) );
		add_action( 'wp_enqueue_scripts',		array( $this, 'enqueue_public_style' ) );


		// not in use, just for the po-editor to display the translation on the plugins overview list
		$widget_name = __( 'Ronby Recent Post List', 'ronby' );
		$widget_desc = __( 'Displays post with thumbnail', 'ronby' );

	}

	function widget( $args, $instance ) {
		global $post;

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		// get and sanitize values
		$title					= ( ! empty( $instance[ 'title' ] ) )				? $instance[ 'title' ]									: $this->defaults[ 'widget_title' ];
		$title					= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category_ids 			= ( ! empty( $instance[ 'category_ids' ] ) )		? array_map( 'absint', $instance[ 'category_ids' ] )	: $this->defaults[ 'category_ids' ];
		$default_url 			= ( ! empty( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]							: $this->defaults[ 'thumb_url' ];
		$thumb_dimensions		= ( ! empty( $instance[ 'thumb_dimensions' ] ) )	? $instance[ 'thumb_dimensions' ]						: $this->defaults[ 'thumb_dimensions' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( ! empty( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		// special case: class wide setting
		$this->use_inline_css = $bools[ 'use_inline_css' ];
		$this->use_no_css = $bools[ 'use_no_css' ];
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// standard params
		$query_args = array(
			'posts_per_page'      => $ints[ 'number_posts' ],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
		);
		
		// set order of posts in widget
		$query_args[ 'orderby' ] = ( $bools[ 'random_order' ] ) ? 'rand' : 'date';
		$query_args[ 'order' ] = 'DESC';
		
		// add categories param only if 'all categories' was not selected
		if ( ! in_array( 0, $category_ids ) ) {
			$query_args[ 'category__in' ] = $category_ids;
		}
		
		// exclude current displayed post
		if ( $bools[ 'hide_current_post' ] ) {
			if ( isset( $post->ID ) and is_singular() ) {
				$query_args[ 'post__not_in' ] = array( $post->ID );
			}
		}

		// ignore sticky posts if desired, else show them on top
		$query_args[ 'ignore_sticky_posts' ] = ( $bools[ 'keep_sticky' ] ) ? false : true;
		
		// exclude sticky posts
		if ( $bools[ 'only_sticky_posts' ] ) {
			// set the filter with IDs of sticky posts
	        $query_args[ 'post__in' ] = get_option( 'sticky_posts', array() );
			// The next line appears illogical in comparison with the 
			// previous line, but is necessary to display the correct 
			// number of posts if the number of sticky posts is greater 
			// than the number of posts to be displayed.
			$query_args[ 'ignore_sticky_posts' ] = true;
		} elseif ( $bools[ 'hide_sticky_posts' ] ) {
			// get IDs of sticky posts
			$post_ids = get_option( 'sticky_posts', array() );
			// if there are sticky posts
			if ( $post_ids ) {
				// if argument 'post__not_in' is defined
				if ( isset( $query_args[ 'post__not_in' ] ) ) {
					// merge argument arrays
					$tmp1 = array_merge( $query_args[ 'post__not_in' ], $post_ids );
					// make post IDs in array unique by using a faster way than array_unique()
					$tmp2 = array(); 
					foreach( $tmp1 as $key => $val ) {    
						$tmp2[ $val ] = true; 
					}
					// set argument with cleaned array
					$query_args[ 'post__not_in' ] = array_keys( $tmp2 );
					// delete temporary variables
					unset( $tmp1, $tmp2 );
				} else {
					// set argument with array of post IDs
					$query_args[ 'post__not_in' ] = $post_ids;
				}
			}
			// delete temporary variable
			unset( $post_ids );
		}

		// apply correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			add_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		// run the query: get the latest posts
		$r = new WP_Query( apply_filters( 'ronby_widget_posts_args', $query_args ) );

		// remove correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			remove_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		if ( $r->have_posts()) :
		
			// take custom size if desired
			if ( $thumb_dimensions != 'custom' ) {
				// overwrite thumb_width and thumb_height with closest size
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
				// set dimensions with specified size name
				$this->customs[ 'thumb_dimensions' ] = $thumb_dimensions;
			} else {
				// set dimensions with specified size array
				$this->customs[ 'thumb_dimensions' ] = array( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
			}

			// let there be an empty 'more' label if desired
			if ( isset( $instance[ 'excerpt_more' ] ) ) {
				if ( '' === $instance[ 'excerpt_more' ] ) {
					$this->customs[ 'excerpt_more' ] = '';
				} else {
					$this->customs[ 'excerpt_more' ] = $instance[ 'excerpt_more' ];
				}
			} else {
				$this->customs[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
			}
			// let there be an empty category label if desired
			if ( isset( $instance[ 'category_label' ] ) ) {
				if ( '' === $instance[ 'category_label' ] ) {
					$this->customs[ 'category_label' ] = '';
				} else {
					$this->customs[ 'category_label' ] = $instance[ 'category_label' ];
				}
			} else {
				$this->customs[ 'category_label' ] = $this->defaults[ 'category_label' ];
			}

			// set other global vars
			$this->customs[ 'ignore_excerpt' ]		= $bools[ 'ignore_excerpt' ]; // whether to ignore post excerpt field or not
			$this->customs[ 'set_more_as_link' ]	= $bools[ 'set_more_as_link' ]; // whether to set 'more' signs as link or not
			$this->customs[ 'set_cats_as_links' ]	= $bools[ 'set_cats_as_links' ]; // whether to set category names as links or not
			$this->customs[ 'excerpt_length' ]		= $ints[ 'excerpt_length' ]; // number of characters of excerpt
			$this->customs[ 'post_title_length' ]	= $ints[ 'post_title_length' ]; // maximum number of characters of post title

			// set default image code
			$default_attr = array(
				'src'	=> $default_url,
				'class'	=> sprintf( "attachment-%dx%d", $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ),
				'alt'	=> '',
			);
			$default_img = '<img ';
			$default_img .= rtrim( image_hwstring( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) );
			foreach ( $default_attr as $name => $value ) {
				$default_img .= ' ' . $name . '="' . $value . '"';
			}
			$default_img .= ' />';
			
			// set link target
			if ( $bools[ 'open_new_window' ] ) {
				$this->customs[ 'link_target' ] = ' target="_blank"';
			} else {
				$this->customs[ 'link_target' ] = '';
			}
			
			// translate repeately used texts once (for more performance)
			$text = ', ';
			$this->defaults[ 'comma' ] = __( $text );
			$text = '&hellip;';
			$this->defaults[ 'ellipses' ] = __( $text );
			$text = 'By %s';
			$this->defaults[ 'author_label' ] = _x( $text, 'theme author' );

			// print list
?>
<?php echo $args[ 'before_widget' ]; ?>
<div id="ronby-<?php echo $args[ 'widget_id' ];?>" class="ronby-recent-post-widget">
	<?php if ( $title ) echo $args[ 'before_title' ] . $title . $args[ 'after_title' ]; ?>
	<div class="widget">
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<div<?php 
			$classes = array();
			if ( is_sticky() ) { 
				$classes[] = 'ronby-sticky widget-post-item-5 d-flex align-items-center';
			}else{
				$classes[] = 'widget-post-item-5 d-flex align-items-center';
			}
			if ( $bools[ 'print_post_categories' ] ) {
				$cats = get_the_category();
				if ( is_array( $cats ) and $cats ) {
					foreach ( $cats as $cat ) {
						$classes[] = $cat->slug;
					}
				}
			}
			if ( $classes ) {
				echo ' class="', join( ' ', $classes ), '"';
			}
			?>><div class="flex-auto"><div class="flex-auto-thumbnail"><a href="<?php the_permalink(); ?>"<?php echo $this->customs[ 'link_target' ]; ?>><?php 
			if ( $bools[ 'show_thumb' ] ) : 
				$is_thumb = false;
				// if only first image
				if ( $bools[ 'only_1st_img' ] ) :
					// try to find and to display the first post image and to return success
					$is_thumb = $this->the_first_post_image();
				else :
					// look for featured image
					if ( has_post_thumbnail() ) : 
						// if there is featured image then show it
						the_post_thumbnail( $this->customs[ 'thumb_dimensions' ] );
						$is_thumb = true;
					else :
						// if user wishes first image trial
						if ( $bools[ 'try_1st_img' ] ) :
							// try to find and to display the first post image and to return success
							$is_thumb = $this->the_first_post_image();
						endif; // try_1st_img 
					endif; // has_post_thumbnail
				endif; // only_1st_img
				// if there is no image 
				if ( ! $is_thumb ) :
					// if user allows default image then
					if ( $bools[ 'use_default' ] ) :
						echo $default_img;
					endif; // use_default
				endif; // not is_thumb
				// (else do nothing)
			endif; // show_thumb
			// show title if wished

			?></a></div></div>
			<div class="flex-fill">
			<?php
			if ( ! $bools[ 'hide_title' ] ) {?>
			<a class="no-color" href="<?php the_permalink(); ?>">
			<h3 class=" post-title animate-300 hover-color-primary"><?php if ( $post_title = $this->get_the_trimmed_post_title() ) { echo $post_title; } else { the_ID(); } ?></h3></a>
			<?php 
			if ( $bools[ 'show_date' ] ) : 
				?><div class="post-date"><i class="fas fa-calendar"></i> <?php echo get_the_date(); ?></div><?php 
			endif;
			if ( $bools[ 'show_author' ] ) : 
				?><div class="post-date ronby-post-author"><i class="far fa-user"></i> <?php echo esc_html( $this->get_the_author() ); ?></div><?php 
			endif;
			if ( $bools[ 'show_categories' ] ) : 
				?><div class="post-date ronby-post-categories"><i class="fas fa-tag"></i> <?php echo $this->get_the_categories( $r->post->ID ); ?></div><?php 
			endif;
			if ( $bools[ 'show_comments_number' ] ) : 
				?><div class="post-date ronby-post-comments-number"><i class="far fa-comment-dots"></i> <?php echo get_comments_number_text(); ?></div><?php 
			endif;
			if ( $bools[ 'show_excerpt' ] ) : 
				?><div class="post-date ronby-post-excerpt"><i class="fas fa-pen-alt"></i> <?php echo $this->get_the_trimmed_excerpt(); ?></div><?php 
			endif;
			
			?>
			<?php } ?>
			</div><?php 
 
		?></div>
	<?php endwhile; ?>
	</div>
</div><!-- .ronby-widget -->
<?php echo $args[ 'after_widget' ]; ?>

<?php

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	function update( $new_widget_settings, $old_widget_settings ) {
		$instance = $old_widget_settings;
		// sanitize user input before update
		$instance[ 'title' ] 				= ( isset( $new_widget_settings[ 'title' ] ) )					? strip_tags( $new_widget_settings[ 'title' ] )						: $this->defaults[ 'widget_title' ];
		$instance[ 'default_url' ] 			= ( isset( $new_widget_settings[ 'default_url' ] ) )			? esc_url_raw( $new_widget_settings[ 'default_url' ] )				: $this->defaults[ 'thumb_url' ];
		$instance[ 'thumb_dimensions' ] 	= ( isset( $new_widget_settings[ 'thumb_dimensions' ] ) )		? strip_tags( $new_widget_settings[ 'thumb_dimensions' ] )			: $this->defaults[ 'thumb_dimensions' ];
		$instance[ 'category_ids' ]   		= ( isset( $new_widget_settings[ 'category_ids' ] ) )			? array_map( 'absint', $new_widget_settings[ 'category_ids' ] )		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		foreach ( $this->ints as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? absint( $new_widget_settings[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		foreach ( $this->bools_false as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $new_widget_settings[ 'excerpt_more' ] ) ) {
			if ( '' == $new_widget_settings[ 'excerpt_more' ] ) {
				$instance[ 'excerpt_more' ] = '';
			} else {
				$instance[ 'excerpt_more' ] = $new_widget_settings[ 'excerpt_more' ];
			}
		} else {
			$instance[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $new_widget_settings[ 'category_label' ] ) ) {
			if ( '' == $new_widget_settings[ 'category_label' ] ) {
				$instance[ 'category_label' ] = '';
			} else {
				$instance[ 'category_label' ] = $new_widget_settings[ 'category_label' ];
			}
		} else {
			$instance[ 'category_label' ] = $this->defaults[ 'category_label' ];
		}

		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $instance[ 'category_ids' ] ) ) {
			$instance[ 'category_ids' ] = $this->defaults[ 'category_ids' ];
		}
		
		// empty widget cache
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ $this->defaults[ 'plugin_slug' ] ] ) ) {
			delete_option( $this->defaults[ 'plugin_slug' ] );
		}

		// delete current css file to let make new one via $this->enqueue_public_style()
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			// remove the file
			unlink( $this->defaults[ 'css_file_path' ] );
		}

		// return sanitized current widget settings
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( $this->defaults[ 'plugin_slug' ], 'widget' );
	}

	function form( $instance ) {
		// get and sanitize values
		$title					= ( isset( $instance[ 'title' ] ) ) 				? $instance[ 'title' ]				: $this->defaults[ 'widget_title' ];
		$thumb_dimensions		= ( isset( $instance[ 'thumb_dimensions' ] ) )		? $instance[ 'thumb_dimensions' ]	: $this->defaults[ 'thumb_dimensions' ];
		$default_url			= ( isset( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]		: $this->defaults[ 'thumb_url' ];
		$category_ids			= ( isset( $instance[ 'category_ids' ] ) )			? $instance[ 'category_ids' ]		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( isset( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : true;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $instance[ 'excerpt_more' ] ) ) {
			if ( '' == $instance[ 'excerpt_more' ] ) {
				$excerpt_more = '';
			} else {
				$excerpt_more = $instance[ 'excerpt_more' ];
			}
		} else {
			$excerpt_more = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $instance[ 'category_label' ] ) ) {
			if ( '' == $instance[ 'category_label' ] ) {
				$category_label = '';
			} else {
				$category_label = $instance[ 'category_label' ];
			}
		} else {
			$category_label = $this->defaults[ 'category_label' ];
		}
		
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// compute ids only once to improve performance
		$field_ids = array();
		$field_ids[ 'category_ids' ]	= $this->get_field_id( 'category_ids' );
		$field_ids[ 'category_label' ]	= $this->get_field_id( 'category_label' );
		$field_ids[ 'default_url' ]		= $this->get_field_id( 'default_url' );
		$field_ids[ 'excerpt_more' ]	= $this->get_field_id( 'excerpt_more' );
		$field_ids[ 'title' ]			= $this->get_field_id( 'title' );
		$field_ids[ 'thumb_dimensions' ]= $this->get_field_id( 'thumb_dimensions' );
		foreach ( array_merge( $this->ints, $this->bools_false, $this->bools_true ) as $key ) {
			$field_ids[ $key ] = $this->get_field_id( $key );
		}
		
		// get texts and values for image sizes dropdown
		global $_wp_additional_image_sizes;
		$wp_standard_image_size_labels = array();
		$label = 'Full Size';	$wp_standard_image_size_labels[ 'full' ]		= __( $label );
		$label = 'Large';		$wp_standard_image_size_labels[ 'large' ]		= __( $label );
		$label = 'Medium';		$wp_standard_image_size_labels[ 'medium' ]		= __( $label );
		$label = 'Thumbnail';	$wp_standard_image_size_labels[ 'thumbnail' ]	= __( $label );
		
		$wp_standard_image_size_names = array_keys( $wp_standard_image_size_labels );
		$size_options = array();
		foreach ( get_intermediate_image_sizes() as $size_name ) {
			// Don't take numeric sizes that appear
			if( is_integer( $size_name ) ) {
				continue;
			}
			$option_values = array();
			// Set technical name
			$option_values[ 'size_name' ] = $size_name;
			// Set name
			$option_values[ 'name' ] = in_array( $size_name, $wp_standard_image_size_names ) ? $wp_standard_image_size_labels[$size_name] : $size_name;
			// Set width
			$option_values[ 'width' ] = isset( $_wp_additional_image_sizes[$size_name]['width'] ) ? $_wp_additional_image_sizes[$size_name]['width'] : get_option( "{$size_name}_size_w" );
			// Set height
			$option_values[ 'height' ] = isset( $_wp_additional_image_sizes[$size_name]['height'] ) ? $_wp_additional_image_sizes[$size_name]['height'] : get_option( "{$size_name}_size_h" );
			// add option to options list
			$size_options[] = $option_values;
		}
		
		// create text to Media Settings page
		$text = 'Settings';	$label_settings	= __( $text );
		$text = 'Media';	$label_media	= _x( $text, 'post type general name' );
		$label = sprintf( '%s &rsaquo; %s', $label_settings, $label_media );
		$media_trail = ( current_user_can( 'manage_options' ) ) ? sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( admin_url( 'options-media.php' ) ), esc_html( $label ) ) : sprintf( '<em>%s</em>', esc_html( $label ) );

		// get texts and values for categories dropdown
		#$none_text = 'All Categories';
		$all_text = 'All Categories';
		$label_all_cats = __( $all_text );

		// get categories
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 1 ) );
		$number_of_cats = count( $categories );
		
		// get size (number of rows to display) of selection box: not more than 10
		$number_of_rows = ( 10 > $number_of_cats ) ? $number_of_cats + 1 : 10;

		// start selection box
		$selection_element = sprintf(
			'<select name="%s[]" id="%s" class="ronby-cat-select" multiple size="%d">',
			$this->get_field_name( 'category_ids' ),
			$field_ids[ 'category_ids' ],
			$number_of_rows
		);
		$selection_element .= "\n";

		// make selection box entries
		$cat_list = array();
		if ( 0 < $number_of_cats ) {

			// make a hierarchical list of categories
			while ( $categories ) {
				// go on with the first element in the categories list:
				// if there is no parent
				if ( '0' == $categories[ 0 ]->parent ) {
					// get and remove it from the categories list
					$current_entry = array_shift( $categories );
					// append the current entry to the new list
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> 0
					);
					// go on looping
					continue;
				}
				// if there is a parent:
				// try to find parent in new list and get its array index
				$parent_index = $this->get_cat_parent_index( $cat_list, $categories[ 0 ]->parent );
				// if parent is not yet in the new list: try to find the parent later in the loop
				if ( false === $parent_index ) {
					// get and remove current entry from the categories list
					$current_entry = array_shift( $categories );
					// append it at the end of the categories list
					$categories[] = $current_entry;
					// go on looping
					continue;
				}
				// if there is a parent and parent is in new list:
				// set depth of current item: +1 of parent's depth
				$depth = $cat_list[ $parent_index ][ 'depth' ] + 1;
				// set new index as next to parent index
				$new_index = $parent_index + 1;
				// find the correct index where to insert the current item
				foreach( $cat_list as $entry ) {
					// if there are items with same or higher depth than current item
					if ( $depth <= $entry[ 'depth' ] ) {
						// increase new index
						$new_index = $new_index + 1;
						// go on looping in foreach()
						continue;
					}
					// if the correct index is found:
					// get current entry and remove it from the categories list
					$current_entry = array_shift( $categories );
					// insert current item into the new list at correct index
					$end_array = array_splice( $cat_list, $new_index ); // $cat_list is changed, too
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> $depth
					);
					$cat_list = array_merge( $cat_list, $end_array );
					// quit foreach(), go on while-looping
					break;
				} // foreach( cat_list )
			} // while( categories )

			// make HTML of selection box
			$selected = ( in_array( 0, $category_ids ) ) ? ' selected="selected"' : '';
			$selection_element .= "\t";
			$selection_element .= '<option value="0"' . $selected . '>' . $label_all_cats . '</option>';
			$selection_element .= "\n";

			foreach ( $cat_list as $category ) {
				$cat_name = apply_filters( 'ronby_list_cats', $category[ 'name' ], $category );
				$pad = ( 0 < $category[ 'depth' ] ) ? str_repeat('&ndash;&nbsp;', $category[ 'depth' ] ) : '';
				$selection_element .= "\t";
				$selection_element .= '<option value="' . $category[ 'id' ] . '"';
				$selection_element .= ( in_array( $category[ 'id' ], $category_ids ) ) ? ' selected="selected"' : '';
				$selection_element .= '>' . $pad . $cat_name . '</option>';
				$selection_element .= "\n";
			}
			
		}

		// close selection box
		$selection_element .= "</select>\n";
		
		// print form in widgets page
?>


<p><label for="<?php echo $field_ids[ 'title' ]; ?>"><?php $text = 'Title'; esc_html_e( $text ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'title' ]; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

<p><label for="<?php echo $field_ids[ 'number_posts' ]; ?>"><?php $text = 'Number of posts to show:'; esc_html_e( $text ); ?></label>
<input id="<?php echo $field_ids[ 'number_posts' ]; ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo $ints[ 'number_posts' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'open_new_window' ] ); ?> id="<?php echo $field_ids[ 'open_new_window' ]; ?>" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>" />
<label for="<?php echo $field_ids[ 'open_new_window' ]; ?>"><?php esc_html_e( 'Open post links in new windows?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'random_order' ] ); ?> id="<?php echo $field_ids[ 'random_order' ]; ?>" name="<?php echo $this->get_field_name( 'random_order' ); ?>" />
<label for="<?php echo $field_ids[ 'random_order' ]; ?>"><?php esc_html_e( 'Show posts in random order?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_current_post' ] ); ?> id="<?php echo $field_ids[ 'hide_current_post' ]; ?>" name="<?php echo $this->get_field_name( 'hide_current_post' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_current_post' ]; ?>"><?php esc_html_e( 'Do not show the current post?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Sticky'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'only_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>"><?php esc_html_e( 'Show only sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the options to hide sticky posts and to keep them on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'hide_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>"><?php esc_html_e( 'Do not show sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the option to keep sticky posts on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_sticky' ] ); ?> id="<?php echo $field_ids[ 'keep_sticky' ]; ?>" name="<?php echo $this->get_field_name( 'keep_sticky' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_sticky' ]; ?>"><?php esc_html_e( 'Keep sticky posts on top of the list?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Title'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_title' ] ); ?> id="<?php echo $field_ids[ 'hide_title' ]; ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_title' ]; ?>"><?php esc_html_e( 'Do not show post title?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'Make sure you set a default thumbnail for posts without a thumbnail, otherwise there will be no link.', 'ronby' ); ?></em></label></p>

<p><label for="<?php echo $field_ids[ 'post_title_length' ]; ?>"><?php esc_html_e( 'Maximum length of post title', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'post_title_length' ]; ?>" name="<?php echo $this->get_field_name( 'post_title_length' ); ?>" type="text" value="<?php echo $ints[ 'post_title_length' ]; ?>" size="3" /></p>

<h4><?php $text = 'Author'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_author' ] ); ?> id="<?php echo $field_ids[ 'show_author' ]; ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
<label for="<?php echo $field_ids[ 'show_author' ]; ?>"><?php esc_html_e( 'Show post author?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Categories'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_categories' ] ); ?> id="<?php echo $field_ids[ 'show_categories' ]; ?>" name="<?php echo $this->get_field_name( 'show_categories' ); ?>" />
<label for="<?php echo $field_ids[ 'show_categories' ]; ?>"><?php esc_html_e( 'Show post categories?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_cats_as_links' ] ); ?> id="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>" name="<?php echo $this->get_field_name( 'set_cats_as_links' ); ?>" />
<label for="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>"><?php esc_html_e( 'Set post category names as links, pointing to their archives?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'category_label' ]; ?>"><?php esc_html_e( 'Label for categories:', 'ronby' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'category_label' ]; ?>" name="<?php echo $this->get_field_name( 'category_label' ); ?>" type="text" value="<?php echo esc_attr( $category_label ); ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'ronby' );?></em></p>

<h4><?php $text = 'Date'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_date' ] ); ?> id="<?php echo $field_ids[ 'show_date' ]; ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $field_ids[ 'show_date' ]; ?>"><?php esc_html_e( 'Show post date?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Excerpt'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_excerpt' ] ); ?> id="<?php echo $field_ids[ 'show_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'show_excerpt' ]; ?>"><?php esc_html_e( 'Show excerpt?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'excerpt_length' ]; ?>"><?php esc_html_e( 'Maximum length of excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_length' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo $ints[ 'excerpt_length' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'excerpt_more' ]; ?>"><?php esc_html_e( 'Signs after excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_more' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_more' ); ?>" type="text" value="<?php echo esc_attr( $excerpt_more ); ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_more_as_link' ] ); ?> id="<?php echo $field_ids[ 'set_more_as_link' ]; ?>" name="<?php echo $this->get_field_name( 'set_more_as_link' ); ?>" />
<label for="<?php echo $field_ids[ 'set_more_as_link' ]; ?>"><?php esc_html_e( 'Set signs after excerpt as a link to the post?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'ignore_excerpt' ] ); ?> id="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'ignore_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>"><?php esc_html_e( 'Ignore post excerpt field as excerpt source?', 'ronby' ); ?></label><br />
<em><?php esc_html_e( 'Normally the widget takes the excerpt from the text of the excerpt field unchanged and if there is no text it creates the excerpt from the post content automatically. If this option is activated the excerpt is created from the post content only.', 'ronby' );?></em></p>

<h4><?php $text = 'Comments'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_comments_number' ] ); ?> id="<?php echo $field_ids[ 'show_comments_number' ]; ?>" name="<?php echo $this->get_field_name( 'show_comments_number' ); ?>" />
<label for="<?php echo $field_ids[ 'show_comments_number' ]; ?>"><?php esc_html_e( 'Show number of comments?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Filter by category'; esc_html_e( $text ); ?></h4>

<p><label for="<?php echo $field_ids[ 'category_ids' ];?>"><?php esc_html_e( 'Show posts of selected categories only?', 'ronby' ); ?></label><br />
<?php echo $selection_element; ?><br />
<em><?php printf( esc_html__( 'Click on the categories with pressed CTRL key to select multiple categories. If &#8220;%s&#8221; was selected then other selections will be ignored.', 'ronby' ), $label_all_cats ); ?></em></p>

<h4><?php $text = 'Thumbnail Settings'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_thumb' ] ); ?> id="<?php echo $field_ids[ 'show_thumb' ]; ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
<label for="<?php echo $field_ids[ 'show_thumb' ]; ?>"><?php esc_html_e( 'Show thumbnail?', 'ronby' ); ?></label><br>
<em><?php esc_html_e( 'By default, the featured image of the post is used as long as the next checkboxes do not specify anything different.', 'ronby' ); ?></em></p>

<p><label for="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>"><?php esc_html_e( 'Size of thumbnail', 'ronby' ); ?>:</label>
	<select id="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_dimensions' ); ?>">
		<option value="<?php echo $this->defaults[ 'thumb_dimensions' ]; ?>" <?php selected( $thumb_dimensions, $this->defaults[ 'thumb_dimensions' ] ); ?>><?php esc_html_e( 'Specified width and height', 'ronby' ); ?></option>
<?php
// Display the sizes in the array
foreach ( $size_options as $option ) {
?>
		<option value="<?php echo esc_attr( $option[ 'size_name' ] ); ?>"<?php selected( $thumb_dimensions, $option[ 'size_name' ] ); ?>><?php echo esc_html( $option[ 'name' ] ); ?> (<?php echo absint( $option[ 'width' ] ); ?> &times; <?php echo absint( $option[ 'height' ] ); ?>)</option>
<?php
} // end foreach(option)
?>
	</select><br />
	<em><?php printf( esc_html__( 'If you use a specified size the following sizes will be taken, otherwise they will be ignored and the selected dimension as stored in %s will be used:', 'ronby' ), $media_trail ); ?></em>
</p>

<p><label for="<?php echo $field_ids[ 'thumb_width' ]; ?>"><?php esc_html_e( 'Width of thumbnail', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_width' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" type="text" value="<?php echo $ints[ 'thumb_width' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'thumb_height' ]; ?>"><?php esc_html_e( 'Height of thumbnail', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_height' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" type="text" value="<?php echo $ints[ 'thumb_height' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_aspect_ratio' ] ); ?> id="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>" name="<?php echo $this->get_field_name( 'keep_aspect_ratio' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>"><?php esc_html_e( 'Use aspect ratios of original images?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the given width is used to determine the height of the thumbnail automatically. This option also supports responsive web design.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'try_1st_img' ] ); ?> id="<?php echo $field_ids[ 'try_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'try_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'try_1st_img' ]; ?>"><?php esc_html_e( "Try to use the post's first image if post has no featured image?", 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_1st_img' ] ); ?> id="<?php echo $field_ids[ 'only_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'only_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'only_1st_img' ]; ?>"><?php esc_html_e( 'Use first image only, ignore featured image?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_default' ] ); ?> id="<?php echo $field_ids[ 'use_default' ]; ?>" name="<?php echo $this->get_field_name( 'use_default' ); ?>" />
<label for="<?php echo $field_ids[ 'use_default' ]; ?>"><?php esc_html_e( 'Use default thumbnail if no image could be determined?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'default_url' ]; ?>"><?php esc_html_e( 'URL of default thumbnail (start with http://)', 'ronby' ); ?>:</label>
<input class="widefat" id="<?php echo $field_ids[ 'default_url' ]; ?>" name="<?php echo $this->get_field_name( 'default_url' ); ?>" type="text" value="<?php echo esc_url( $default_url ); ?>" /></p>

<?php

	}
	
	/**
	 * Return the array index of a given ID
	 *
	 * @since 4.1
	 */
	private function get_cat_parent_index( $arr, $id ) {
		$len = count( $arr );
		if ( 0 == $len ) {
			return false;
		}
		$id = absint( $id );
		for ( $i = 0; $i < $len; $i++ ) {
			if ( $id == $arr[ $i ][ 'id' ] ) {
				return $i;
			}
		}
		return false; 
	}
	
	/**
	 * Load the widget's CSS in the HEAD section of the frontend
	 *
	 * @since 2.3
	 */
	public function enqueue_public_style () {
		
		$is_file = false;
		$css_code = '';
		// make sure the CSS file exists; if not available: generate it
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			$is_file = true;
		} else {
			// get stored settings
			$all_settings = $this->get_settings();
			// quit if at least 1 widget was set for no CSS at all
			foreach ( $all_settings as $id => $settings ) {
				if ( isset( $settings[ 'use_no_css' ] ) and $settings[ 'use_no_css' ] ) {
					return;
				}
			} // foreach ( $all_settings as $id => $settings )

			// get the CSS code
			list( $css_code, $use_inline_css ) = $this->generate_css_code( $all_settings );
			// if not to print the CSS as inline code in the HTML document
			if ( ! $use_inline_css ) {
				// write file safely
				if ( @file_put_contents( $this->defaults[ 'css_file_path' ], $css_code ) ) {
					// file writing was successfull, so change file permissions
					chmod( $this->defaults[ 'css_file_path' ], 0644 );
					$is_file = true;
				} // if CSS file successfully created
			} // if no inline CSS
		} // if CSS file exists
			
		// if there is a CSS file
		if ( $is_file ) {
			// enqueue the CSS file
			wp_enqueue_style(
				$this->defaults[ 'plugin_slug' ] . '-public-style',
				plugin_dir_url( __FILE__ ) . 'public.css',
				array(),
				$this->defaults[ 'plugin_version' ],
				'all' 
			);
		} else {
			// print inline CSS
			print "\n<!-- Ronby Recent Post List Widget: inline CSS -->\n";
			printf( "<style type='text/css'>\n%s</style>\n", $css_code );
		} // if $is_file
	}





	/**
	 * Returns the id of the first image in the content, else 0
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    integer    the post id of the first content image
	 */
	private function get_first_content_image_id () {
		// set variables
		global $wpdb;
		$post = get_post();
		if ( $post and isset( $post->post_content ) ) {
			// look for images in HTML code
			preg_match_all( '/<img[^>]+>/i', $post->post_content, $all_img_tags );
			if ( $all_img_tags ) {
				foreach ( $all_img_tags[ 0 ] as $img_tag ) {
					// find class attribute and catch its value
					preg_match( '/<img.*?class\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_class );
					if ( $img_class ) {
						// Look for the WP image id
						preg_match( '/wp-image-([\d]+)/i', $img_class[ 1 ], $thumb_id );
						// if first image id found: check whether is image
						if ( $thumb_id ) {
							$img_id = absint( $thumb_id[ 1 ] );
							// if is image: return its id
							if ( wp_attachment_is_image( $img_id ) ) {
								return $img_id;
							}
						} // if(thumb_id)
					} // if(img_class)
					
					// else: try to catch image id by its url as stored in the database
					// find src attribute and catch its value
					preg_match( '/<img.*?src\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_src );
					if ( $img_src ) {
						// delete optional query string in img src
						$url = preg_replace( '/([^?]+).*/', '\1', $img_src[ 1 ] );
						// delete image dimensions data in img file name, just take base name and extension
						$url = preg_replace( '/(.+)-\d+x\d+\.(\w+)/', '\1.\2', $url );
						// if path is protocol relative then set it absolute
						if ( 0 === strpos( $url, '//' ) ) {
							$url = $this->defaults[ 'site_protocol' ] . ':' . $url;
						// if path is domain relative then set it absolute
						} elseif ( 0 === strpos( $url, '/' ) ) {
							$url = $this->defaults[ 'site_url' ] . $url;
						}
						// look up its id in the db
						$thumb_id = $wpdb->get_var( $wpdb->prepare( "SELECT `ID` FROM $wpdb->posts WHERE `guid` = '%s'", $url ) );
						// if id is available: return it
						if ( $thumb_id ) {
							return absint( $thumb_id );
						} // if(thumb_id)
					} // if(img_src)
				} // foreach(img_tag)
			} // if(all_img_tags)
		} // if (post content)
		
		// if nothing found: return 0
		return 0;
	}

	/**
	 * Echoes the thumbnail of first post's image and returns success
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    bool    success on finding an image
	 */
	private function the_first_post_image () {
		// look for first image
		$thumb_id = $this->get_first_content_image_id();
		// if there is first image then show first image
		if ( $thumb_id ) :
			echo wp_get_attachment_image( $thumb_id, $this->customs[ 'thumb_dimensions' ] );
			return true;
		else :
			return false;
		endif; // thumb_id
	}

	/**
	 * Returns the assigned categories of a post in a string
	 *
	 * @access   private
	 * @since     4.6
	 *
	 */
	private function get_the_categories ( $id ) {
		$terms = get_the_terms( $id, 'category' );

		if ( is_wp_error( $terms ) ) {
			return __( 'Error on listing categories', 'ronby' );
		}

		if ( empty( $terms ) ) {
			$text = 'No categories';
			return __( $text );
		}

		$categories = array();

		if ( $this->customs[ 'set_cats_as_links' ] ) {
			foreach ( $terms as $term ) {
				// get link to category
				$categories[] = sprintf(
					'<a href="%s">%s</a>',
					get_category_link( $term->term_id ),
					esc_html( $term->name )
				);
			}
		} else {
			foreach ( $terms as $term ) {
				// get sanitized category name
				$categories[] = esc_html( $term->name );
			}
		}
		/*foreach ( $terms as $term ) {
			$categories[] = $term->name;
		}*/

		$string = '';
		if ( $this->customs[ 'category_label' ] ) {
			$string = $this->customs[ 'category_label' ] . ' ';
		}
		$string .= join( $this->defaults[ 'comma' ], $categories );
		
		return $string;
	}

	/**
	 * Returns the assigned author of a post in a string
	 *
	 * @access   private
	 * @since     4.8
	 *
	 */
	private function get_the_author () {
		$author = get_the_author();

		if ( empty( $author ) ) {
			return '';
		} else {
			return sprintf( $this->defaults[ 'author_label' ], $author );
		}

	}

	/**
	 * Generate the css code with stored settings
	 *
	 * @since 2.3
	 */
	private function generate_css_code ( $all_instances ) {

		$set_default = true;
		$ints = array();
		$use_inline_css = false;

		// generate CSS
		$css_code  = ".ronby-widget ul { list-style: outside none none; margin-left: 0; margin-right: 0; padding-left: 0; padding-right: 0; }\n"; 
		$css_code .= ".ronby-widget ul li { overflow: hidden; margin: 0 0 1.5em; }\n"; 
		$css_code .= ".ronby-widget ul li:last-child { margin: 0; }\n"; 
		if ( is_rtl() ) {
			$css_code .= ".ronby-widget ul li img { display: inline; float: right; margin: .3em 0 .75em .75em; }\n";
		} else {
			$css_code .= ".ronby-widget ul li img { display: inline; float: left; margin: .3em .75em .75em 0; }\n";
		}

		foreach ( $all_instances as $number => $settings ) {
			// set width and height
			$ints[ 'thumb_width' ] = $this->defaults[ 'thumb_width' ];
			$ints[ 'thumb_height' ] = $this->defaults[ 'thumb_height' ];
			$thumb_dimensions = isset( $settings[ 'thumb_dimensions' ] ) ? $settings[ 'thumb_dimensions' ] : $this->defaults[ 'thumb_dimensions' ];
			if ( $thumb_dimensions == 'custom' ) {
				if ( isset( $settings[ 'thumb_width' ] ) ) {
					$ints[ 'thumb_width' ]  = absint( $settings[ 'thumb_width' ]  );
				}
				if ( isset( $settings[ 'thumb_height' ] ) ) {
					$ints[ 'thumb_height' ] = absint( $settings[ 'thumb_height' ] );
				}
			} else {
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
			} // $settings[ 'thumb_dimensions' ]
			// get aspect ratio option
			$bools[ 'keep_aspect_ratio' ] = false;
			if ( isset( $settings[ 'keep_aspect_ratio' ] ) ) {
				$bools[ 'keep_aspect_ratio' ] = (bool) $settings[ 'keep_aspect_ratio' ];
				// set CSS code
				if ( $bools[ 'keep_aspect_ratio' ] ) {
					$css_code .= sprintf( '#ronby-%s-%d img { max-width: %dpx; width: 100%%; height: auto; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ] );
					$css_code .= "\n"; 
				} else {
					$css_code .= sprintf( '#ronby-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
					$css_code .= "\n"; 
				}
			} else {
				$css_code .= sprintf( '#ronby-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
				$css_code .= "\n"; 
			}
			// override default code
			$set_default = false;
			// inline CSS if at least 1 widget was set for that
			if ( isset( $settings[ 'use_inline_css' ] ) ) {
				$bools[ 'use_inline_css' ] = (bool) $settings[ 'use_inline_css' ];
				if ( $bools[ 'use_inline_css' ] ) {
					$use_inline_css = true;
				}
			}

		} // foreach ( $all_instances as $number => $settings )
		// set at least this statement if no settings are stored
		if ( $set_default ) {
			$css_code .= sprintf( '.ronby-widget ul li img { width: %dpx; height: %dpx; }', $this->defaults[ 'thumb_width' ], $this->defaults[ 'thumb_height' ] );
			$css_code .= "\n"; 
		}
		
		return array( $css_code, $use_inline_css );
	}

	/**
	 * Returns the shortened excerpt, must use in a loop.
	 *
	 * @since 3.0
	 */
	private function get_the_trimmed_excerpt () {
		
		$post = get_post();
								
		if ( empty( $post ) ) {
			return '';
		}

		$excerpt = '';
		
		if ( post_password_required( $post ) ) {
			$excerpt = 'There is no excerpt because this is a protected post.';
			return esc_html__( $excerpt );
		}

		// get excerpt from text field if desired
		if ( ! $this->customs[ 'ignore_excerpt' ] ) {
			$excerpt = apply_filters( 'ronby_the_excerpt', $post->post_excerpt, $post );
		}
		
		// text processings if no manual excerpt is available
		if ( empty( $excerpt ) ) {

			// get excerpt from post content
			$excerpt = strip_shortcodes( get_the_content( '' ) );
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			$excerpt = wp_trim_words( $excerpt, $this->customs[ 'excerpt_length' ], $this->customs[ 'excerpt_more' ] );
			
			// if excerpt is longer than desired
			if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] ) {
				// get excerpt in desired length
				$sub_excerpt = mb_substr( $excerpt, 0, $this->customs[ 'excerpt_length' ] );
				// get array of shortened excerpt words
				$excerpt_words = explode( ' ', $sub_excerpt );
				// get the length of the last word in the shortened excerpt
				$excerpt_cut = - ( mb_strlen( $excerpt_words[ count( $excerpt_words ) - 1 ] ) );
				// if there is no empty string
				if ( $excerpt_cut < 0 ) {
					// get the shorter excerpt until the last word
					$excerpt = mb_substr( $sub_excerpt, 0, $excerpt_cut );
				} else {
					// get the shortened excerpt
					$excerpt = $sub_excerpt;
				} // if ( $excerpt_cut < 0 )
			} // if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] )
		} // if ( empty( $excerpt ) )
		
		// append 'more' text, set 'more' signs as link if desired
		if ( $this->customs[ 'set_more_as_link' ] ) {
			$excerpt .= sprintf( '<a href="%s"%s>%s</a>', get_the_permalink( $post ), $this->customs[ 'link_target' ], $this->customs[ 'excerpt_more' ] );
		} else {
			$excerpt .= $this->customs[ 'excerpt_more' ];
		}
		
		// return text
		return $excerpt;
	}

	/**
	 * Returns the shortened post title, must use in a loop.
	 *
	 * @since 4.5
	 */
	private function get_the_trimmed_post_title () {
		
		// get current post's post_title
		$post_title = get_the_title();

		// if post_title is longer than desired
		if ( mb_strlen( $post_title ) > $this->customs[ 'post_title_length' ] ) {
			// get post_title in desired length
			$post_title = mb_substr( $post_title, 0, $this->customs[ 'post_title_length' ] );
			// append ellipses
			$post_title .= $this->defaults[ 'ellipses' ];
		}
		// return text
		return $post_title;
	}

	/**
	 * Returns width and height of a image size name, else default sizes
	 *
	 * @since 4.0
	 */
	private function get_image_dimensions ( $size = 'thumbnail' ) {

		$width  = 0;
		$height = 0;
		// check if selected size is in registered images sizes
		if ( in_array( $size, get_intermediate_image_sizes() ) ) {
			// if in WordPress standard image sizes
			if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$width  = get_option( $size . '_size_w' );
				$height = get_option( $size . '_size_h' );
			} else {
				// custom image sizes, formerly added via add_image_size()
				global $_wp_additional_image_sizes;
				$width  = $_wp_additional_image_sizes[ $size ][ 'width' ];
				$height = $_wp_additional_image_sizes[ $size ][ 'height' ];
			}
		}
		// check if vars have true values, else use default size
		if ( ! $width )  $width  = $this->defaults[ 'thumb_width' ];
		if ( ! $height ) $height = $this->defaults[ 'thumb_height' ];
		
		// return sizes
		return array( $width, $height );
	}
	
	/**
	 * Shows sticky posts on top of categories list
	 *
	 * @since 6.2.1
	 */
	public function get_stickies_on_top( $posts ) {
		// get sticky post IDs
		$sticky_posts = get_option( 'sticky_posts' );
		// initialize variables for the correct number of posts in the result list
		$num_posts = count( $posts );
		$sticky_offset = 0;
		// loop over posts and relocate stickies to the front
		for( $i = 0; $i < $num_posts; $i++ ) {
			// if sticky post
			if ( in_array( $posts[ $i ]->ID, $sticky_posts ) ) {
				$sticky_post = $posts[ $i ];
				// remove sticky post from current position
				array_splice( $posts, $i, 1 );
				// move to front, after other stickies
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				// increment the sticky offset. the next sticky will be placed at this offset.
				$sticky_offset++;
				// remove post from sticky posts array
				//$offset = array_search( $sticky_post->ID, $sticky_posts );
				//unset( $sticky_posts[ $offset ] );
			} // if ( in_array( $posts[ $i ]->ID, $sticky_posts ) )
		} // for()
		// return new list
		return $posts;
	}
	
}

/**
 * Register widget on init
 *
 * @since 1.0
 */
function register_ronby_recent_posts_widget_one () {
	register_widget( 'ronby_recent_posts_widget_one' );
}
add_action( 'widgets_init', 'register_ronby_recent_posts_widget_one');

/*******************************
Ronby Recent Post List- 3 Widget
********************************/
class ronby_recent_posts_widget_three extends WP_Widget {

	var $defaults;		// default values
	var $bools_false;	// key names of bool variables of value 'false'
	var $bools_true;	// key names of bool variables of value 'true'
	var $ints;			// key names of integer variables of any value
	var $customs;		// user defined values
	var $use_inline_css;// class wide setting, bool type
	var $use_no_css;	// class wide setting, bool type

	function __construct() {
		$language_codes = explode( '_', get_locale() );
		switch ( $language_codes[ 0 ] ) {
			default:
				$widget_name = 'Ronby Recent Post List Three';
				$widget_desc = 'List of your blogs most recent posts with  thumbnails.';
		}
		$this->defaults[ 'category_ids' ]		= array( 0 ); // selected categories
		$this->defaults[ 'category_label' ]		= _x( 'In', 'In {categories}', 'ronby' ); // label for category list
		$this->defaults[ 'css_file_path' ]		= dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'custom.css'; // path of the public css file
		$this->defaults[ 'excerpt_length' ]		= absint( apply_filters( 'ronby_excerpt_length', 55 ) ); // default length: 55 characters
		$this->defaults[ 'excerpt_more' ]		= apply_filters( 'ronby_excerpt_more', ' ' . '[&hellip;]' ); // set ellipses as default 'more'
		$this->defaults[ 'number_posts' ]		= 5; // number of posts to show in the widget
		$this->defaults[ 'plugin_slug' ]		= 'ronby-recent-post3'; // identifier of this plugin for WP
		$this->defaults[ 'plugin_version' ]		= '0.1'; // number of current plugin version
		$this->defaults[ 'post_title_length' ] 	= 1000; // default length: 1000 characters
		$this->defaults[ 'thumb_dimensions' ]	= 'custom'; // dimensions of the thumbnail
		$this->defaults[ 'thumb_height' ] 		= absint( round( get_option( 'thumbnail_size_h', 110 ) / 2 ) ); // custom height of the thumbnail
		$this->defaults[ 'thumb_url' ]			= plugins_url( 'default_thumb.gif', __FILE__ ); // URL of the default thumbnail
		$this->defaults[ 'thumb_width' ]		= absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ); // custom width of the thumbnail
		$this->defaults[ 'widget_title' ]		= ''; // title of the widget
		// Domain name and protocol of WP site
		$parsed_url = parse_url( home_url() );
		$this->defaults[ 'site_protocol' ]		= $parsed_url[ 'host' ];
		$this->defaults[ 'site_url' ]			= $parsed_url[ 'scheme' ];
		unset( $parsed_url );
		// other vars
		$this->bools_false						= array( 'hide_current_post', 'only_sticky_posts', 'hide_sticky_posts', 'hide_title', 'keep_aspect_ratio', 'keep_sticky', 'only_1st_img', 'random_order', 'show_author', 'show_categories', 'show_comments_number', 'show_date', 'show_excerpt', 'ignore_excerpt', 'set_more_as_link', 'try_1st_img', 'use_default', 'open_new_window', 'print_post_categories', 'set_cats_as_links', 'use_inline_css', 'use_no_css' );
		$this->bools_true						= array( 'show_thumb' );
		$this->ints 							= array( 'excerpt_length', 'number_posts', 'post_title_length', 'thumb_height', 'thumb_width' );
		$this->valid_excerpt_sources			= array( 'post_content', 'excerpt_field' );
		$widget_ops 							= array( 'classname' => $this->defaults[ 'plugin_slug' ], 'description' => $widget_desc );
		parent::__construct( $this->defaults[ 'plugin_slug' ], $widget_name, $widget_ops );

		add_action( 'save_post',				array( $this, 'flush_widget_cache3' ) );
		add_action( 'deleted_post',				array( $this, 'flush_widget_cache3' ) );
		add_action( 'switch_theme',				array( $this, 'flush_widget_cache3' ) );
		add_action( 'wp_enqueue_scripts',		array( $this, 'enqueue_public_style' ) );


		// not in use, just for the po-editor to display the translation on the plugins overview list
		$widget_name = __( 'Ronby Recent Post List Three', 'ronby' );
		$widget_desc = __( 'Displays post with thumbnail', 'ronby' );

	}

	function widget( $args, $instance ) {
		global $post;

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		// get and sanitize values
		$title					= ( ! empty( $instance[ 'title' ] ) )				? $instance[ 'title' ]									: $this->defaults[ 'widget_title' ];
		$title					= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category_ids 			= ( ! empty( $instance[ 'category_ids' ] ) )		? array_map( 'absint', $instance[ 'category_ids' ] )	: $this->defaults[ 'category_ids' ];
		$default_url 			= ( ! empty( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]							: $this->defaults[ 'thumb_url' ];
		$thumb_dimensions		= ( ! empty( $instance[ 'thumb_dimensions' ] ) )	? $instance[ 'thumb_dimensions' ]						: $this->defaults[ 'thumb_dimensions' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( ! empty( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		// special case: class wide setting
		$this->use_inline_css = $bools[ 'use_inline_css' ];
		$this->use_no_css = $bools[ 'use_no_css' ];
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// standard params
		$query_args = array(
			'posts_per_page'      => $ints[ 'number_posts' ],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
		);
		
		// set order of posts in widget
		$query_args[ 'orderby' ] = ( $bools[ 'random_order' ] ) ? 'rand' : 'date';
		$query_args[ 'order' ] = 'DESC';
		
		// add categories param only if 'all categories' was not selected
		if ( ! in_array( 0, $category_ids ) ) {
			$query_args[ 'category__in' ] = $category_ids;
		}
		
		// exclude current displayed post
		if ( $bools[ 'hide_current_post' ] ) {
			if ( isset( $post->ID ) and is_singular() ) {
				$query_args[ 'post__not_in' ] = array( $post->ID );
			}
		}

		// ignore sticky posts if desired, else show them on top
		$query_args[ 'ignore_sticky_posts' ] = ( $bools[ 'keep_sticky' ] ) ? false : true;
		
		// exclude sticky posts
		if ( $bools[ 'only_sticky_posts' ] ) {
			// set the filter with IDs of sticky posts
	        $query_args[ 'post__in' ] = get_option( 'sticky_posts', array() );
			// The next line appears illogical in comparison with the 
			// previous line, but is necessary to display the correct 
			// number of posts if the number of sticky posts is greater 
			// than the number of posts to be displayed.
			$query_args[ 'ignore_sticky_posts' ] = true;
		} elseif ( $bools[ 'hide_sticky_posts' ] ) {
			// get IDs of sticky posts
			$post_ids = get_option( 'sticky_posts', array() );
			// if there are sticky posts
			if ( $post_ids ) {
				// if argument 'post__not_in' is defined
				if ( isset( $query_args[ 'post__not_in' ] ) ) {
					// merge argument arrays
					$tmp1 = array_merge( $query_args[ 'post__not_in' ], $post_ids );
					// make post IDs in array unique by using a faster way than array_unique()
					$tmp2 = array(); 
					foreach( $tmp1 as $key => $val ) {    
						$tmp2[ $val ] = true; 
					}
					// set argument with cleaned array
					$query_args[ 'post__not_in' ] = array_keys( $tmp2 );
					// delete temporary variables
					unset( $tmp1, $tmp2 );
				} else {
					// set argument with array of post IDs
					$query_args[ 'post__not_in' ] = $post_ids;
				}
			}
			// delete temporary variable
			unset( $post_ids );
		}

		// apply correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			add_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		// run the query: get the latest posts
		$r = new WP_Query( apply_filters( 'ronby_widget_posts_args', $query_args ) );

		// remove correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			remove_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		if ( $r->have_posts()) :
		
			// take custom size if desired
			if ( $thumb_dimensions != 'custom' ) {
				// overwrite thumb_width and thumb_height with closest size
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
				// set dimensions with specified size name
				$this->customs[ 'thumb_dimensions' ] = $thumb_dimensions;
			} else {
				// set dimensions with specified size array
				$this->customs[ 'thumb_dimensions' ] = array( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
			}

			// let there be an empty 'more' label if desired
			if ( isset( $instance[ 'excerpt_more' ] ) ) {
				if ( '' === $instance[ 'excerpt_more' ] ) {
					$this->customs[ 'excerpt_more' ] = '';
				} else {
					$this->customs[ 'excerpt_more' ] = $instance[ 'excerpt_more' ];
				}
			} else {
				$this->customs[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
			}
			// let there be an empty category label if desired
			if ( isset( $instance[ 'category_label' ] ) ) {
				if ( '' === $instance[ 'category_label' ] ) {
					$this->customs[ 'category_label' ] = '';
				} else {
					$this->customs[ 'category_label' ] = $instance[ 'category_label' ];
				}
			} else {
				$this->customs[ 'category_label' ] = $this->defaults[ 'category_label' ];
			}

			// set other global vars
			$this->customs[ 'ignore_excerpt' ]		= $bools[ 'ignore_excerpt' ]; // whether to ignore post excerpt field or not
			$this->customs[ 'set_more_as_link' ]	= $bools[ 'set_more_as_link' ]; // whether to set 'more' signs as link or not
			$this->customs[ 'set_cats_as_links' ]	= $bools[ 'set_cats_as_links' ]; // whether to set category names as links or not
			$this->customs[ 'excerpt_length' ]		= $ints[ 'excerpt_length' ]; // number of characters of excerpt
			$this->customs[ 'post_title_length' ]	= $ints[ 'post_title_length' ]; // maximum number of characters of post title

			// set default image code
			$default_attr = array(
				'src'	=> $default_url,
				'class'	=> sprintf( "attachment-%dx%d", $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ),
				'alt'	=> '',
			);
			$default_img = '<img ';
			$default_img .= rtrim( image_hwstring( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) );
			foreach ( $default_attr as $name => $value ) {
				$default_img .= ' ' . $name . '="' . $value . '"';
			}
			$default_img .= ' />';
			
			// set link target
			if ( $bools[ 'open_new_window' ] ) {
				$this->customs[ 'link_target' ] = ' target="_blank"';
			} else {
				$this->customs[ 'link_target' ] = '';
			}
			
			// translate repeately used texts once (for more performance)
			$text = ', ';
			$this->defaults[ 'comma' ] = __( $text );
			$text = '&hellip;';
			$this->defaults[ 'ellipses' ] = __( $text );
			$text = 'By %s';
			$this->defaults[ 'author_label' ] = _x( $text, 'theme author' );
			$date_color = isset($instance['date_color']) ? $instance['date_color'] : '';	
			$title_color = isset($instance['title_color']) ? $instance['title_color'] : '';	
			// print list
?>
<?php echo $args[ 'before_widget' ]; ?>
<div id="ronby-<?php echo $args[ 'widget_id' ];?>" class="ronby-recent-post-widget">
	<?php if ( $title ) echo $args[ 'before_title' ] . $title . $args[ 'after_title' ]; ?>
	<div class="widget ronby_recent_post3">
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<div<?php 
			$classes = array();
			if ( is_sticky() ) { 
				$classes[] = 'ronby-sticky widget-post-item-1 d-flex align-items-center';
			}else{
				$classes[] = 'widget-post-item-1 d-flex align-items-center';
			}
			if ( $bools[ 'print_post_categories' ] ) {
				$cats = get_the_category();
				if ( is_array( $cats ) and $cats ) {
					foreach ( $cats as $cat ) {
						$classes[] = $cat->slug;
					}
				}
			}
			if ( $classes ) {
				echo ' class="', join( ' ', $classes ), '"';
			}
			?>><div class="thumbnail animate-zoom"><a href="<?php the_permalink(); ?>"<?php echo $this->customs[ 'link_target' ]; ?>><?php 
			if ( $bools[ 'show_thumb' ] ) : 
				$is_thumb = false;
				// if only first image
				if ( $bools[ 'only_1st_img' ] ) :
					// try to find and to display the first post image and to return success
					$is_thumb = $this->the_first_post_image();
				else :
					// look for featured image
					if ( has_post_thumbnail() ) : 
						// if there is featured image then show it
						the_post_thumbnail( $this->customs[ 'thumb_dimensions' ] );
						$is_thumb = true;
					else :
						// if user wishes first image trial
						if ( $bools[ 'try_1st_img' ] ) :
							// try to find and to display the first post image and to return success
							$is_thumb = $this->the_first_post_image();
						endif; // try_1st_img 
					endif; // has_post_thumbnail
				endif; // only_1st_img
				// if there is no image 
				if ( ! $is_thumb ) :
					// if user allows default image then
					if ( $bools[ 'use_default' ] ) :
						echo $default_img;
					endif; // use_default
				endif; // not is_thumb
				// (else do nothing)
			endif; // show_thumb
			// show title if wished

			?></a></div>
			<div class="flex-fill">
			<?php
			if ( $bools[ 'show_date' ] ) : 
				?><div class="post-date color-secondary" <?php if($date_color){echo "style='color:".esc_attr($date_color)."'";} ?>><i class="fas fa-calendar"></i> <?php echo get_the_date(); ?></div><?php 
			endif;
			if ( ! $bools[ 'hide_title' ] ) {?>
			<a class="no-color" href="<?php the_permalink(); ?>">
			<h3 class="post-title hover-color-primary animate-300" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php if ( $post_title = $this->get_the_trimmed_post_title() ) { echo $post_title; } else { the_ID(); } ?></h3></a>
			<?php 

			if ( $bools[ 'show_author' ] ) : 
				?><div class="post-date ronby-post-author"><i class="far fa-user"></i> <?php echo esc_html( $this->get_the_author() ); ?></div><?php 
			endif;
			if ( $bools[ 'show_categories' ] ) : 
				?><div class="post-date ronby-post-categories"><i class="fas fa-tag"></i> <?php echo $this->get_the_categories( $r->post->ID ); ?></div><?php 
			endif;
			if ( $bools[ 'show_comments_number' ] ) : 
				?><div class="post-date ronby-post-comments-number"><i class="far fa-comment-dots"></i> <?php echo get_comments_number_text(); ?></div><?php 
			endif;

			
			?>
			<?php } ?>
			</div><?php 
 
		?></div>
	<?php endwhile; ?>
	</div>
</div><!-- .ronby-widget -->
<?php echo $args[ 'after_widget' ]; ?>

<?php

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	function update( $new_widget_settings, $old_widget_settings ) {
		$instance = $old_widget_settings;
		// sanitize user input before update
		$instance['date_color']= strip_tags( $new_widget_settings['date_color'] );
		$instance['title_color']= strip_tags( $new_widget_settings['title_color'] );
		$instance[ 'title' ] 				= ( isset( $new_widget_settings[ 'title' ] ) )					? strip_tags( $new_widget_settings[ 'title' ] )						: $this->defaults[ 'widget_title' ];
		$instance[ 'default_url' ] 			= ( isset( $new_widget_settings[ 'default_url' ] ) )			? esc_url_raw( $new_widget_settings[ 'default_url' ] )				: $this->defaults[ 'thumb_url' ];
		$instance[ 'thumb_dimensions' ] 	= ( isset( $new_widget_settings[ 'thumb_dimensions' ] ) )		? strip_tags( $new_widget_settings[ 'thumb_dimensions' ] )			: $this->defaults[ 'thumb_dimensions' ];
		$instance[ 'category_ids' ]   		= ( isset( $new_widget_settings[ 'category_ids' ] ) )			? array_map( 'absint', $new_widget_settings[ 'category_ids' ] )		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		foreach ( $this->ints as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? absint( $new_widget_settings[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		foreach ( $this->bools_false as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $new_widget_settings[ 'excerpt_more' ] ) ) {
			if ( '' == $new_widget_settings[ 'excerpt_more' ] ) {
				$instance[ 'excerpt_more' ] = '';
			} else {
				$instance[ 'excerpt_more' ] = $new_widget_settings[ 'excerpt_more' ];
			}
		} else {
			$instance[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $new_widget_settings[ 'category_label' ] ) ) {
			if ( '' == $new_widget_settings[ 'category_label' ] ) {
				$instance[ 'category_label' ] = '';
			} else {
				$instance[ 'category_label' ] = $new_widget_settings[ 'category_label' ];
			}
		} else {
			$instance[ 'category_label' ] = $this->defaults[ 'category_label' ];
		}

		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $instance[ 'category_ids' ] ) ) {
			$instance[ 'category_ids' ] = $this->defaults[ 'category_ids' ];
		}
		
		// empty widget cache
		$this->flush_widget_cache3();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ $this->defaults[ 'plugin_slug' ] ] ) ) {
			delete_option( $this->defaults[ 'plugin_slug' ] );
		}

		// delete current css file to let make new one via $this->enqueue_public_style()
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			// remove the file
			unlink( $this->defaults[ 'css_file_path' ] );
		}

		// return sanitized current widget settings
		return $instance;
	}

	function flush_widget_cache3() {
		wp_cache_delete( $this->defaults[ 'plugin_slug' ], 'widget' );
	}

	function form( $instance ) {
		// get and sanitize values
		$title					= ( isset( $instance[ 'title' ] ) ) 				? $instance[ 'title' ]				: $this->defaults[ 'widget_title' ];
		$thumb_dimensions		= ( isset( $instance[ 'thumb_dimensions' ] ) )		? $instance[ 'thumb_dimensions' ]	: $this->defaults[ 'thumb_dimensions' ];
		$date_color		= ( isset( $instance[ 'date_color' ] ) ) ? $instance[ 'date_color' ]	: '';
		$title_color		= ( isset( $instance[ 'title_color' ] ) ) ? $instance[ 'title_color' ]	: '';
		$default_url			= ( isset( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]		: $this->defaults[ 'thumb_url' ];
		$category_ids			= ( isset( $instance[ 'category_ids' ] ) )			? $instance[ 'category_ids' ]		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( isset( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : true;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $instance[ 'excerpt_more' ] ) ) {
			if ( '' == $instance[ 'excerpt_more' ] ) {
				$excerpt_more = '';
			} else {
				$excerpt_more = $instance[ 'excerpt_more' ];
			}
		} else {
			$excerpt_more = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $instance[ 'category_label' ] ) ) {
			if ( '' == $instance[ 'category_label' ] ) {
				$category_label = '';
			} else {
				$category_label = $instance[ 'category_label' ];
			}
		} else {
			$category_label = $this->defaults[ 'category_label' ];
		}
		
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// compute ids only once to improve performance
		$field_ids = array();
		$field_ids[ 'category_ids' ]	= $this->get_field_id( 'category_ids' );
		$field_ids[ 'category_label' ]	= $this->get_field_id( 'category_label' );
		$field_ids[ 'default_url' ]		= $this->get_field_id( 'default_url' );
		$field_ids[ 'excerpt_more' ]	= $this->get_field_id( 'excerpt_more' );
		$field_ids[ 'title' ]			= $this->get_field_id( 'title' );
		$field_ids[ 'thumb_dimensions' ]= $this->get_field_id( 'thumb_dimensions' );
		foreach ( array_merge( $this->ints, $this->bools_false, $this->bools_true ) as $key ) {
			$field_ids[ $key ] = $this->get_field_id( $key );
		}
		
		// get texts and values for image sizes dropdown
		global $_wp_additional_image_sizes;
		$wp_standard_image_size_labels = array();
		$label = 'Full Size';	$wp_standard_image_size_labels[ 'full' ]		= __( $label );
		$label = 'Large';		$wp_standard_image_size_labels[ 'large' ]		= __( $label );
		$label = 'Medium';		$wp_standard_image_size_labels[ 'medium' ]		= __( $label );
		$label = 'Thumbnail';	$wp_standard_image_size_labels[ 'thumbnail' ]	= __( $label );
		
		$wp_standard_image_size_names = array_keys( $wp_standard_image_size_labels );
		$size_options = array();
		foreach ( get_intermediate_image_sizes() as $size_name ) {
			// Don't take numeric sizes that appear
			if( is_integer( $size_name ) ) {
				continue;
			}
			$option_values = array();
			// Set technical name
			$option_values[ 'size_name' ] = $size_name;
			// Set name
			$option_values[ 'name' ] = in_array( $size_name, $wp_standard_image_size_names ) ? $wp_standard_image_size_labels[$size_name] : $size_name;
			// Set width
			$option_values[ 'width' ] = isset( $_wp_additional_image_sizes[$size_name]['width'] ) ? $_wp_additional_image_sizes[$size_name]['width'] : get_option( "{$size_name}_size_w" );
			// Set height
			$option_values[ 'height' ] = isset( $_wp_additional_image_sizes[$size_name]['height'] ) ? $_wp_additional_image_sizes[$size_name]['height'] : get_option( "{$size_name}_size_h" );
			// add option to options list
			$size_options[] = $option_values;
		}
		
		// create text to Media Settings page
		$text = 'Settings';	$label_settings	= __( $text );
		$text = 'Media';	$label_media	= _x( $text, 'post type general name' );
		$label = sprintf( '%s &rsaquo; %s', $label_settings, $label_media );
		$media_trail = ( current_user_can( 'manage_options' ) ) ? sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( admin_url( 'options-media.php' ) ), esc_html( $label ) ) : sprintf( '<em>%s</em>', esc_html( $label ) );

		// get texts and values for categories dropdown
		#$none_text = 'All Categories';
		$all_text = 'All Categories';
		$label_all_cats = __( $all_text );

		// get categories
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 1 ) );
		$number_of_cats = count( $categories );
		
		// get size (number of rows to display) of selection box: not more than 10
		$number_of_rows = ( 10 > $number_of_cats ) ? $number_of_cats + 1 : 10;

		// start selection box
		$selection_element = sprintf(
			'<select name="%s[]" id="%s" class="ronby-cat-select" multiple size="%d">',
			$this->get_field_name( 'category_ids' ),
			$field_ids[ 'category_ids' ],
			$number_of_rows
		);
		$selection_element .= "\n";

		// make selection box entries
		$cat_list = array();
		if ( 0 < $number_of_cats ) {

			// make a hierarchical list of categories
			while ( $categories ) {
				// go on with the first element in the categories list:
				// if there is no parent
				if ( '0' == $categories[ 0 ]->parent ) {
					// get and remove it from the categories list
					$current_entry = array_shift( $categories );
					// append the current entry to the new list
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> 0
					);
					// go on looping
					continue;
				}
				// if there is a parent:
				// try to find parent in new list and get its array index
				$parent_index = $this->get_cat_parent_index( $cat_list, $categories[ 0 ]->parent );
				// if parent is not yet in the new list: try to find the parent later in the loop
				if ( false === $parent_index ) {
					// get and remove current entry from the categories list
					$current_entry = array_shift( $categories );
					// append it at the end of the categories list
					$categories[] = $current_entry;
					// go on looping
					continue;
				}
				// if there is a parent and parent is in new list:
				// set depth of current item: +1 of parent's depth
				$depth = $cat_list[ $parent_index ][ 'depth' ] + 1;
				// set new index as next to parent index
				$new_index = $parent_index + 1;
				// find the correct index where to insert the current item
				foreach( $cat_list as $entry ) {
					// if there are items with same or higher depth than current item
					if ( $depth <= $entry[ 'depth' ] ) {
						// increase new index
						$new_index = $new_index + 1;
						// go on looping in foreach()
						continue;
					}
					// if the correct index is found:
					// get current entry and remove it from the categories list
					$current_entry = array_shift( $categories );
					// insert current item into the new list at correct index
					$end_array = array_splice( $cat_list, $new_index ); // $cat_list is changed, too
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> $depth
					);
					$cat_list = array_merge( $cat_list, $end_array );
					// quit foreach(), go on while-looping
					break;
				} // foreach( cat_list )
			} // while( categories )

			// make HTML of selection box
			$selected = ( in_array( 0, $category_ids ) ) ? ' selected="selected"' : '';
			$selection_element .= "\t";
			$selection_element .= '<option value="0"' . $selected . '>' . $label_all_cats . '</option>';
			$selection_element .= "\n";

			foreach ( $cat_list as $category ) {
				$cat_name = apply_filters( 'ronby_list_cats', $category[ 'name' ], $category );
				$pad = ( 0 < $category[ 'depth' ] ) ? str_repeat('&ndash;&nbsp;', $category[ 'depth' ] ) : '';
				$selection_element .= "\t";
				$selection_element .= '<option value="' . $category[ 'id' ] . '"';
				$selection_element .= ( in_array( $category[ 'id' ], $category_ids ) ) ? ' selected="selected"' : '';
				$selection_element .= '>' . $pad . $cat_name . '</option>';
				$selection_element .= "\n";
			}
			
		}

		// close selection box
		$selection_element .= "</select>\n";
		
		// print form in widgets page
?>


<p><label for="<?php echo $field_ids[ 'title' ]; ?>"><?php $text = 'Title'; esc_html_e( $text ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'title' ]; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

<p><label for="<?php echo $field_ids[ 'number_posts' ]; ?>"><?php $text = 'Number of posts to show:'; esc_html_e( $text ); ?></label>
<input id="<?php echo $field_ids[ 'number_posts' ]; ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo $ints[ 'number_posts' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'open_new_window' ] ); ?> id="<?php echo $field_ids[ 'open_new_window' ]; ?>" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>" />
<label for="<?php echo $field_ids[ 'open_new_window' ]; ?>"><?php esc_html_e( 'Open post links in new windows?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'random_order' ] ); ?> id="<?php echo $field_ids[ 'random_order' ]; ?>" name="<?php echo $this->get_field_name( 'random_order' ); ?>" />
<label for="<?php echo $field_ids[ 'random_order' ]; ?>"><?php esc_html_e( 'Show posts in random order?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_current_post' ] ); ?> id="<?php echo $field_ids[ 'hide_current_post' ]; ?>" name="<?php echo $this->get_field_name( 'hide_current_post' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_current_post' ]; ?>"><?php esc_html_e( 'Do not show the current post?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Sticky'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'only_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>"><?php esc_html_e( 'Show only sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the options to hide sticky posts and to keep them on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'hide_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>"><?php esc_html_e( 'Do not show sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the option to keep sticky posts on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_sticky' ] ); ?> id="<?php echo $field_ids[ 'keep_sticky' ]; ?>" name="<?php echo $this->get_field_name( 'keep_sticky' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_sticky' ]; ?>"><?php esc_html_e( 'Keep sticky posts on top of the list?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Title'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_title' ] ); ?> id="<?php echo $field_ids[ 'hide_title' ]; ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_title' ]; ?>"><?php esc_html_e( 'Do not show post title?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'Make sure you set a default thumbnail for posts without a thumbnail, otherwise there will be no link.', 'ronby' ); ?></em></label></p>

<p><label for="<?php echo $field_ids[ 'post_title_length' ]; ?>"><?php esc_html_e( 'Maximum length of post title', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'post_title_length' ]; ?>" name="<?php echo $this->get_field_name( 'post_title_length' ); ?>" type="text" value="<?php echo $ints[ 'post_title_length' ]; ?>" size="3" /></p>

<h4><?php $text = 'Author'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_author' ] ); ?> id="<?php echo $field_ids[ 'show_author' ]; ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
<label for="<?php echo $field_ids[ 'show_author' ]; ?>"><?php esc_html_e( 'Show post author?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Categories'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_categories' ] ); ?> id="<?php echo $field_ids[ 'show_categories' ]; ?>" name="<?php echo $this->get_field_name( 'show_categories' ); ?>" />
<label for="<?php echo $field_ids[ 'show_categories' ]; ?>"><?php esc_html_e( 'Show post categories?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_cats_as_links' ] ); ?> id="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>" name="<?php echo $this->get_field_name( 'set_cats_as_links' ); ?>" />
<label for="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>"><?php esc_html_e( 'Set post category names as links, pointing to their archives?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'category_label' ]; ?>"><?php esc_html_e( 'Label for categories:', 'ronby' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'category_label' ]; ?>" name="<?php echo $this->get_field_name( 'category_label' ); ?>" type="text" value="<?php echo esc_attr( $category_label ); ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'ronby' );?></em></p>

<h4><?php $text = 'Date'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_date' ] ); ?> id="<?php echo $field_ids[ 'show_date' ]; ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $field_ids[ 'show_date' ]; ?>"><?php esc_html_e( 'Show post date?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Excerpt'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_excerpt' ] ); ?> id="<?php echo $field_ids[ 'show_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'show_excerpt' ]; ?>"><?php esc_html_e( 'Show excerpt?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'excerpt_length' ]; ?>"><?php esc_html_e( 'Maximum length of excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_length' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo $ints[ 'excerpt_length' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'excerpt_more' ]; ?>"><?php esc_html_e( 'Signs after excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_more' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_more' ); ?>" type="text" value="<?php echo esc_attr( $excerpt_more ); ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_more_as_link' ] ); ?> id="<?php echo $field_ids[ 'set_more_as_link' ]; ?>" name="<?php echo $this->get_field_name( 'set_more_as_link' ); ?>" />
<label for="<?php echo $field_ids[ 'set_more_as_link' ]; ?>"><?php esc_html_e( 'Set signs after excerpt as a link to the post?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'ignore_excerpt' ] ); ?> id="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'ignore_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>"><?php esc_html_e( 'Ignore post excerpt field as excerpt source?', 'ronby' ); ?></label><br />
<em><?php esc_html_e( 'Normally the widget takes the excerpt from the text of the excerpt field unchanged and if there is no text it creates the excerpt from the post content automatically. If this option is activated the excerpt is created from the post content only.', 'ronby' );?></em></p>

<h4><?php $text = 'Comments'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_comments_number' ] ); ?> id="<?php echo $field_ids[ 'show_comments_number' ]; ?>" name="<?php echo $this->get_field_name( 'show_comments_number' ); ?>" />
<label for="<?php echo $field_ids[ 'show_comments_number' ]; ?>"><?php esc_html_e( 'Show number of comments?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Filter by category'; esc_html_e( $text ); ?></h4>

<p><label for="<?php echo $field_ids[ 'category_ids' ];?>"><?php esc_html_e( 'Show posts of selected categories only?', 'ronby' ); ?></label><br />
<?php echo $selection_element; ?><br />
<em><?php printf( esc_html__( 'Click on the categories with pressed CTRL key to select multiple categories. If &#8220;%s&#8221; was selected then other selections will be ignored.', 'ronby' ), $label_all_cats ); ?></em></p>

<h4><?php $text = 'Thumbnail Settings'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_thumb' ] ); ?> id="<?php echo $field_ids[ 'show_thumb' ]; ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
<label for="<?php echo $field_ids[ 'show_thumb' ]; ?>"><?php esc_html_e( 'Show thumbnail?', 'ronby' ); ?></label><br>
<em><?php esc_html_e( 'By default, the featured image of the post is used as long as the next checkboxes do not specify anything different.', 'ronby' ); ?></em></p>

<p><label for="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>"><?php esc_html_e( 'Size of thumbnail', 'ronby' ); ?>:</label>
	<select id="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_dimensions' ); ?>">
		<option value="<?php echo $this->defaults[ 'thumb_dimensions' ]; ?>" <?php selected( $thumb_dimensions, $this->defaults[ 'thumb_dimensions' ] ); ?>><?php esc_html_e( 'Specified width and height', 'ronby' ); ?></option>
<?php
// Display the sizes in the array
foreach ( $size_options as $option ) {
?>
		<option value="<?php echo esc_attr( $option[ 'size_name' ] ); ?>"<?php selected( $thumb_dimensions, $option[ 'size_name' ] ); ?>><?php echo esc_html( $option[ 'name' ] ); ?> (<?php echo absint( $option[ 'width' ] ); ?> &times; <?php echo absint( $option[ 'height' ] ); ?>)</option>
<?php
} // end foreach(option)
?>
	</select><br />
	<em><?php printf( esc_html__( 'If you use a specified size the following sizes will be taken, otherwise they will be ignored and the selected dimension as stored in %s will be used:', 'ronby' ), $media_trail ); ?></em>
</p>

<p><label for="<?php echo $field_ids[ 'thumb_width' ]; ?>"><?php esc_html_e( 'Width of thumbnail', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_width' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" type="text" value="<?php echo $ints[ 'thumb_width' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'thumb_height' ]; ?>"><?php esc_html_e( 'Height of thumbnail', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_height' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" type="text" value="<?php echo $ints[ 'thumb_height' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_aspect_ratio' ] ); ?> id="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>" name="<?php echo $this->get_field_name( 'keep_aspect_ratio' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>"><?php esc_html_e( 'Use aspect ratios of original images?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the given width is used to determine the height of the thumbnail automatically. This option also supports responsive web design.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'try_1st_img' ] ); ?> id="<?php echo $field_ids[ 'try_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'try_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'try_1st_img' ]; ?>"><?php esc_html_e( "Try to use the post's first image if post has no featured image?", 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_1st_img' ] ); ?> id="<?php echo $field_ids[ 'only_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'only_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'only_1st_img' ]; ?>"><?php esc_html_e( 'Use first image only, ignore featured image?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_default' ] ); ?> id="<?php echo $field_ids[ 'use_default' ]; ?>" name="<?php echo $this->get_field_name( 'use_default' ); ?>" />
<label for="<?php echo $field_ids[ 'use_default' ]; ?>"><?php esc_html_e( 'Use default thumbnail if no image could be determined?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'default_url' ]; ?>"><?php esc_html_e( 'URL of default thumbnail (start with http://)', 'ronby' ); ?>:</label>
<input class="widefat" id="<?php echo $field_ids[ 'default_url' ]; ?>" name="<?php echo $this->get_field_name( 'default_url' ); ?>" type="text" value="<?php echo esc_url( $default_url ); ?>" /></p>

<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'date_color ' )); ?>"><?php esc_html_e('Date Color', 'ronby'); ?></label><br/>
  <input type="text" id="<?php echo esc_attr($this->get_field_id( 'date_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'date_color' )); ?>" class="widefat date_color" value="<?php echo esc_attr($instance['date_color']); ?>">
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title_color ' )); ?>"><?php esc_html_e('Title Color', 'ronby'); ?></label><br/>
  <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_color' )); ?>" class="widefat title_color" value="<?php echo esc_attr($instance['title_color']); ?>">
</p>
	<script>
		jQuery(document).ready(function($){
			jQuery('.date_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});	
			jQuery('.title_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});			
		});
	</script>
<?php

	}
	
	/**
	 * Return the array index of a given ID
	 *
	 * @since 4.1
	 */
	private function get_cat_parent_index( $arr, $id ) {
		$len = count( $arr );
		if ( 0 == $len ) {
			return false;
		}
		$id = absint( $id );
		for ( $i = 0; $i < $len; $i++ ) {
			if ( $id == $arr[ $i ][ 'id' ] ) {
				return $i;
			}
		}
		return false; 
	}
	
	/**
	 * Load the widget's CSS in the HEAD section of the frontend
	 *
	 * @since 2.3
	 */
	public function enqueue_public_style () {
		
		$is_file = false;
		$css_code = '';
		// make sure the CSS file exists; if not available: generate it
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			$is_file = true;
		} else {
			// get stored settings
			$all_settings = $this->get_settings();
			// quit if at least 1 widget was set for no CSS at all
			foreach ( $all_settings as $id => $settings ) {
				if ( isset( $settings[ 'use_no_css' ] ) and $settings[ 'use_no_css' ] ) {
					return;
				}
			} // foreach ( $all_settings as $id => $settings )

			// get the CSS code
			list( $css_code, $use_inline_css ) = $this->generate_css_code( $all_settings );
			// if not to print the CSS as inline code in the HTML document
			if ( ! $use_inline_css ) {
				// write file safely
				if ( @file_put_contents( $this->defaults[ 'css_file_path' ], $css_code ) ) {
					// file writing was successfull, so change file permissions
					chmod( $this->defaults[ 'css_file_path' ], 0644 );
					$is_file = true;
				} // if CSS file successfully created
			} // if no inline CSS
		} // if CSS file exists
			
		// if there is a CSS file
		if ( $is_file ) {
			// enqueue the CSS file
			wp_enqueue_style(
				$this->defaults[ 'plugin_slug' ] . '-public-style-3',
				plugin_dir_url( __FILE__ ) . 'custom.css',
				array(),
				$this->defaults[ 'plugin_version' ],
				'all' 
			);
		} else {
			// print inline CSS
			print "\n<!-- Ronby Recent Post List- 3 Widget: inline CSS -->\n";
			printf( "<style type='text/css'>\n%s</style>\n", $css_code );
		} // if $is_file
	}





	/**
	 * Returns the id of the first image in the content, else 0
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    integer    the post id of the first content image
	 */
	private function get_first_content_image_id () {
		// set variables
		global $wpdb;
		$post = get_post();
		if ( $post and isset( $post->post_content ) ) {
			// look for images in HTML code
			preg_match_all( '/<img[^>]+>/i', $post->post_content, $all_img_tags );
			if ( $all_img_tags ) {
				foreach ( $all_img_tags[ 0 ] as $img_tag ) {
					// find class attribute and catch its value
					preg_match( '/<img.*?class\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_class );
					if ( $img_class ) {
						// Look for the WP image id
						preg_match( '/wp-image-([\d]+)/i', $img_class[ 1 ], $thumb_id );
						// if first image id found: check whether is image
						if ( $thumb_id ) {
							$img_id = absint( $thumb_id[ 1 ] );
							// if is image: return its id
							if ( wp_attachment_is_image( $img_id ) ) {
								return $img_id;
							}
						} // if(thumb_id)
					} // if(img_class)
					
					// else: try to catch image id by its url as stored in the database
					// find src attribute and catch its value
					preg_match( '/<img.*?src\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_src );
					if ( $img_src ) {
						// delete optional query string in img src
						$url = preg_replace( '/([^?]+).*/', '\1', $img_src[ 1 ] );
						// delete image dimensions data in img file name, just take base name and extension
						$url = preg_replace( '/(.+)-\d+x\d+\.(\w+)/', '\1.\2', $url );
						// if path is protocol relative then set it absolute
						if ( 0 === strpos( $url, '//' ) ) {
							$url = $this->defaults[ 'site_protocol' ] . ':' . $url;
						// if path is domain relative then set it absolute
						} elseif ( 0 === strpos( $url, '/' ) ) {
							$url = $this->defaults[ 'site_url' ] . $url;
						}
						// look up its id in the db
						$thumb_id = $wpdb->get_var( $wpdb->prepare( "SELECT `ID` FROM $wpdb->posts WHERE `guid` = '%s'", $url ) );
						// if id is available: return it
						if ( $thumb_id ) {
							return absint( $thumb_id );
						} // if(thumb_id)
					} // if(img_src)
				} // foreach(img_tag)
			} // if(all_img_tags)
		} // if (post content)
		
		// if nothing found: return 0
		return 0;
	}

	/**
	 * Echoes the thumbnail of first post's image and returns success
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    bool    success on finding an image
	 */
	private function the_first_post_image () {
		// look for first image
		$thumb_id = $this->get_first_content_image_id();
		// if there is first image then show first image
		if ( $thumb_id ) :
			echo wp_get_attachment_image( $thumb_id, $this->customs[ 'thumb_dimensions' ] );
			return true;
		else :
			return false;
		endif; // thumb_id
	}

	/**
	 * Returns the assigned categories of a post in a string
	 *
	 * @access   private
	 * @since     4.6
	 *
	 */
	private function get_the_categories ( $id ) {
		$terms = get_the_terms( $id, 'category' );

		if ( is_wp_error( $terms ) ) {
			return __( 'Error on listing categories', 'ronby' );
		}

		if ( empty( $terms ) ) {
			$text = 'No categories';
			return __( $text );
		}

		$categories = array();

		if ( $this->customs[ 'set_cats_as_links' ] ) {
			foreach ( $terms as $term ) {
				// get link to category
				$categories[] = sprintf(
					'<a href="%s">%s</a>',
					get_category_link( $term->term_id ),
					esc_html( $term->name )
				);
			}
		} else {
			foreach ( $terms as $term ) {
				// get sanitized category name
				$categories[] = esc_html( $term->name );
			}
		}
		/*foreach ( $terms as $term ) {
			$categories[] = $term->name;
		}*/

		$string = '';
		if ( $this->customs[ 'category_label' ] ) {
			$string = $this->customs[ 'category_label' ] . ' ';
		}
		$string .= join( $this->defaults[ 'comma' ], $categories );
		
		return $string;
	}

	/**
	 * Returns the assigned author of a post in a string
	 *
	 * @access   private
	 * @since     4.8
	 *
	 */
	private function get_the_author () {
		$author = get_the_author();

		if ( empty( $author ) ) {
			return '';
		} else {
			return sprintf( $this->defaults[ 'author_label' ], $author );
		}

	}

	/**
	 * Generate the css code with stored settings
	 *
	 * @since 2.3
	 */
	private function generate_css_code ( $all_instances ) {

		$set_default = true;
		$ints = array();
		$use_inline_css = false;

		// generate CSS
		$css_code  = ".ronby_recent_post3 ul { list-style: outside none none; margin-left: 0; margin-right: 0; padding-left: 0; padding-right: 0; }\n"; 
		$css_code .= ".ronby_recent_post3 ul li { overflow: hidden; margin: 0 0 1.5em; }\n"; 
		$css_code .= ".ronby_recent_post3 ul li:last-child { margin: 0; }\n"; 
		if ( is_rtl() ) {
			$css_code .= ".ronby_recent_post3 ul li img { display: inline; float: right; margin: .3em 0 .75em .75em; }\n";
		} else {
			$css_code .= ".ronby_recent_post3 ul li img { display: inline; float: left; margin: .3em .75em .75em 0; }\n";
		}

		foreach ( $all_instances as $number => $settings ) {
			// set width and height
			$ints[ 'thumb_width' ] = $this->defaults[ 'thumb_width' ];
			$ints[ 'thumb_height' ] = $this->defaults[ 'thumb_height' ];
			$thumb_dimensions = isset( $settings[ 'thumb_dimensions' ] ) ? $settings[ 'thumb_dimensions' ] : $this->defaults[ 'thumb_dimensions' ];
			if ( $thumb_dimensions == 'custom' ) {
				if ( isset( $settings[ 'thumb_width' ] ) ) {
					$ints[ 'thumb_width' ]  = absint( $settings[ 'thumb_width' ]  );
				}
				if ( isset( $settings[ 'thumb_height' ] ) ) {
					$ints[ 'thumb_height' ] = absint( $settings[ 'thumb_height' ] );
				}
			} else {
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
			} // $settings[ 'thumb_dimensions' ]
			// get aspect ratio option
			$bools[ 'keep_aspect_ratio' ] = false;
			if ( isset( $settings[ 'keep_aspect_ratio' ] ) ) {
				$bools[ 'keep_aspect_ratio' ] = (bool) $settings[ 'keep_aspect_ratio' ];
				// set CSS code
				if ( $bools[ 'keep_aspect_ratio' ] ) {
					$css_code .= sprintf( '#ronby-%s-%d img { max-width: %dpx; width: 100%%; height: auto; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ] );
					$css_code .= "\n"; 
				} else {
					$css_code .= sprintf( '#ronby-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
					$css_code .= "\n"; 
				}
			} else {
				$css_code .= sprintf( '#ronby-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
				$css_code .= "\n"; 
			}
			// override default code
			$set_default = false;
			// inline CSS if at least 1 widget was set for that
			if ( isset( $settings[ 'use_inline_css' ] ) ) {
				$bools[ 'use_inline_css' ] = (bool) $settings[ 'use_inline_css' ];
				if ( $bools[ 'use_inline_css' ] ) {
					$use_inline_css = true;
				}
			}

		} // foreach ( $all_instances as $number => $settings )
		// set at least this statement if no settings are stored
		if ( $set_default ) {
			$css_code .= sprintf( '.ronby_recent_post3 ul li img { width: %dpx; height: %dpx; }', $this->defaults[ 'thumb_width' ], $this->defaults[ 'thumb_height' ] );
			$css_code .= "\n"; 
		}
		
		return array( $css_code, $use_inline_css );
	}

	/**
	 * Returns the shortened excerpt, must use in a loop.
	 *
	 * @since 3.0
	 */
	private function get_the_trimmed_excerpt () {
		
		$post = get_post();
								
		if ( empty( $post ) ) {
			return '';
		}

		$excerpt = '';
		
		if ( post_password_required( $post ) ) {
			$excerpt = 'There is no excerpt because this is a protected post.';
			return esc_html__( $excerpt );
		}

		// get excerpt from text field if desired
		if ( ! $this->customs[ 'ignore_excerpt' ] ) {
			$excerpt = apply_filters( 'ronby_the_excerpt', $post->post_excerpt, $post );
		}
		
		// text processings if no manual excerpt is available
		if ( empty( $excerpt ) ) {

			// get excerpt from post content
			$excerpt = strip_shortcodes( get_the_content( '' ) );
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			$excerpt = wp_trim_words( $excerpt, $this->customs[ 'excerpt_length' ], $this->customs[ 'excerpt_more' ] );
			
			// if excerpt is longer than desired
			if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] ) {
				// get excerpt in desired length
				$sub_excerpt = mb_substr( $excerpt, 0, $this->customs[ 'excerpt_length' ] );
				// get array of shortened excerpt words
				$excerpt_words = explode( ' ', $sub_excerpt );
				// get the length of the last word in the shortened excerpt
				$excerpt_cut = - ( mb_strlen( $excerpt_words[ count( $excerpt_words ) - 1 ] ) );
				// if there is no empty string
				if ( $excerpt_cut < 0 ) {
					// get the shorter excerpt until the last word
					$excerpt = mb_substr( $sub_excerpt, 0, $excerpt_cut );
				} else {
					// get the shortened excerpt
					$excerpt = $sub_excerpt;
				} // if ( $excerpt_cut < 0 )
			} // if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] )
		} // if ( empty( $excerpt ) )
		
		// append 'more' text, set 'more' signs as link if desired
		if ( $this->customs[ 'set_more_as_link' ] ) {
			$excerpt .= sprintf( '<a href="%s"%s>%s</a>', get_the_permalink( $post ), $this->customs[ 'link_target' ], $this->customs[ 'excerpt_more' ] );
		} else {
			$excerpt .= $this->customs[ 'excerpt_more' ];
		}
		
		// return text
		return $excerpt;
	}

	/**
	 * Returns the shortened post title, must use in a loop.
	 *
	 * @since 4.5
	 */
	private function get_the_trimmed_post_title () {
		
		// get current post's post_title
		$post_title = get_the_title();

		// if post_title is longer than desired
		if ( mb_strlen( $post_title ) > $this->customs[ 'post_title_length' ] ) {
			// get post_title in desired length
			$post_title = mb_substr( $post_title, 0, $this->customs[ 'post_title_length' ] );
			// append ellipses
			$post_title .= $this->defaults[ 'ellipses' ];
		}
		// return text
		return $post_title;
	}

	/**
	 * Returns width and height of a image size name, else default sizes
	 *
	 * @since 4.0
	 */
	private function get_image_dimensions ( $size = 'thumbnail' ) {

		$width  = 0;
		$height = 0;
		// check if selected size is in registered images sizes
		if ( in_array( $size, get_intermediate_image_sizes() ) ) {
			// if in WordPress standard image sizes
			if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$width  = get_option( $size . '_size_w' );
				$height = get_option( $size . '_size_h' );
			} else {
				// custom image sizes, formerly added via add_image_size()
				global $_wp_additional_image_sizes;
				$width  = $_wp_additional_image_sizes[ $size ][ 'width' ];
				$height = $_wp_additional_image_sizes[ $size ][ 'height' ];
			}
		}
		// check if vars have true values, else use default size
		if ( ! $width )  $width  = $this->defaults[ 'thumb_width' ];
		if ( ! $height ) $height = $this->defaults[ 'thumb_height' ];
		
		// return sizes
		return array( $width, $height );
	}
	
	/**
	 * Shows sticky posts on top of categories list
	 *
	 * @since 6.2.1
	 */
	public function get_stickies_on_top( $posts ) {
		// get sticky post IDs
		$sticky_posts = get_option( 'sticky_posts' );
		// initialize variables for the correct number of posts in the result list
		$num_posts = count( $posts );
		$sticky_offset = 0;
		// loop over posts and relocate stickies to the front
		for( $i = 0; $i < $num_posts; $i++ ) {
			// if sticky post
			if ( in_array( $posts[ $i ]->ID, $sticky_posts ) ) {
				$sticky_post = $posts[ $i ];
				// remove sticky post from current position
				array_splice( $posts, $i, 1 );
				// move to front, after other stickies
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				// increment the sticky offset. the next sticky will be placed at this offset.
				$sticky_offset++;
				// remove post from sticky posts array
				//$offset = array_search( $sticky_post->ID, $sticky_posts );
				//unset( $sticky_posts[ $offset ] );
			} // if ( in_array( $posts[ $i ]->ID, $sticky_posts ) )
		} // for()
		// return new list
		return $posts;
	}
	
}

/**
 * Register widget on init
 *
 * @since 1.0
 */
function register_ronby_recent_posts_widget_three () {
	register_widget( 'ronby_recent_posts_widget_three');
}
add_action( 'widgets_init', 'register_ronby_recent_posts_widget_three');

/*******************************
Ronby Recent Post List- 4 Widget
********************************/
class ronby_recent_posts_widget_four extends WP_Widget {

	var $defaults;		// default values
	var $bools_false;	// key names of bool variables of value 'false'
	var $bools_true;	// key names of bool variables of value 'true'
	var $ints;			// key names of integer variables of any value
	var $customs;		// user defined values
	var $use_inline_css;// class wide setting, bool type
	var $use_no_css;	// class wide setting, bool type

	function __construct() {
		$language_codes = explode( '_', get_locale() );
		switch ( $language_codes[ 0 ] ) {
			default:
				$widget_name = 'Ronby Recent Post List Four';
				$widget_desc = 'List of your blogs most recent posts with  thumbnails.';
		}
		$this->defaults[ 'category_ids' ]		= array( 0 ); // selected categories
		$this->defaults[ 'category_label' ]		= _x( 'In', 'In {categories}', 'ronby' ); // label for category list
		$this->defaults[ 'css_file_path' ]		= dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'custom4.css'; // path of the public css file
		$this->defaults[ 'excerpt_length' ]		= absint( apply_filters( 'ronby_excerpt_length', 55 ) ); // default length: 55 characters
		$this->defaults[ 'excerpt_more' ]		= apply_filters( 'ronby_excerpt_more', ' ' . '[&hellip;]' ); // set ellipses as default 'more'
		$this->defaults[ 'number_posts' ]		= 5; // number of posts to show in the widget
		$this->defaults[ 'plugin_slug' ]		= 'ronby-recent-post4'; // identifier of this plugin for WP
		$this->defaults[ 'plugin_version' ]		= '0.2'; // number of current plugin version
		$this->defaults[ 'post_title_length' ] 	= 1000; // default length: 1000 characters
		$this->defaults[ 'thumb_dimensions' ]	= 'custom'; // dimensions of the thumbnail
		$this->defaults[ 'thumb_height' ] 		= absint( round( get_option( 'thumbnail_size_h', 110 ) / 2 ) ); // custom height of the thumbnail
		$this->defaults[ 'thumb_url' ]			= plugins_url( 'default_thumb.gif', __FILE__ ); // URL of the default thumbnail
		$this->defaults[ 'thumb_width' ]		= absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ); // custom width of the thumbnail
		$this->defaults[ 'widget_title' ]		= ''; // title of the widget
		// Domain name and protocol of WP site
		$parsed_url = parse_url( home_url() );
		$this->defaults[ 'site_protocol' ]		= $parsed_url[ 'host' ];
		$this->defaults[ 'site_url' ]			= $parsed_url[ 'scheme' ];
		unset( $parsed_url );
		// other vars
		$this->bools_false						= array( 'hide_current_post', 'only_sticky_posts', 'hide_sticky_posts', 'hide_title', 'keep_aspect_ratio', 'keep_sticky', 'only_1st_img', 'random_order', 'show_author', 'show_categories', 'show_comments_number', 'show_date', 'show_excerpt', 'ignore_excerpt', 'set_more_as_link', 'try_1st_img', 'use_default', 'open_new_window', 'print_post_categories', 'set_cats_as_links', 'use_inline_css', 'use_no_css' );
		$this->bools_true						= array( 'show_thumb' );
		$this->ints 							= array( 'excerpt_length', 'number_posts', 'post_title_length', 'thumb_height', 'thumb_width' );
		$this->valid_excerpt_sources			= array( 'post_content', 'excerpt_field' );
		$widget_ops 							= array( 'classname' => $this->defaults[ 'plugin_slug' ], 'description' => $widget_desc );
		parent::__construct( $this->defaults[ 'plugin_slug' ], $widget_name, $widget_ops );

		add_action( 'save_post',				array( $this, 'flush_widget_cache4' ) );
		add_action( 'deleted_post',				array( $this, 'flush_widget_cache4' ) );
		add_action( 'switch_theme',				array( $this, 'flush_widget_cache4' ) );
		add_action( 'wp_enqueue_scripts',		array( $this, 'enqueue_public_style' ) );


		// not in use, just for the po-editor to display the translation on the plugins overview list
		$widget_name = __( 'Ronby Recent Post List Three', 'ronby' );
		$widget_desc = __( 'Displays post with thumbnail', 'ronby' );

	}

	function widget( $args, $instance ) {
		global $post;

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		// get and sanitize values
		$title					= ( ! empty( $instance[ 'title' ] ) )				? $instance[ 'title' ]									: $this->defaults[ 'widget_title' ];
		$title					= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category_ids 			= ( ! empty( $instance[ 'category_ids' ] ) )		? array_map( 'absint', $instance[ 'category_ids' ] )	: $this->defaults[ 'category_ids' ];
		$default_url 			= ( ! empty( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]							: $this->defaults[ 'thumb_url' ];
		$thumb_dimensions		= ( ! empty( $instance[ 'thumb_dimensions' ] ) )	? $instance[ 'thumb_dimensions' ]						: $this->defaults[ 'thumb_dimensions' ];
		$title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( ! empty( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		// special case: class wide setting
		$this->use_inline_css = $bools[ 'use_inline_css' ];
		$this->use_no_css = $bools[ 'use_no_css' ];
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// standard params
		$query_args = array(
			'posts_per_page'      => $ints[ 'number_posts' ],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
		);
		
		// set order of posts in widget
		$query_args[ 'orderby' ] = ( $bools[ 'random_order' ] ) ? 'rand' : 'date';
		$query_args[ 'order' ] = 'DESC';
		
		// add categories param only if 'all categories' was not selected
		if ( ! in_array( 0, $category_ids ) ) {
			$query_args[ 'category__in' ] = $category_ids;
		}
		
		// exclude current displayed post
		if ( $bools[ 'hide_current_post' ] ) {
			if ( isset( $post->ID ) and is_singular() ) {
				$query_args[ 'post__not_in' ] = array( $post->ID );
			}
		}

		// ignore sticky posts if desired, else show them on top
		$query_args[ 'ignore_sticky_posts' ] = ( $bools[ 'keep_sticky' ] ) ? false : true;
		
		// exclude sticky posts
		if ( $bools[ 'only_sticky_posts' ] ) {
			// set the filter with IDs of sticky posts
	        $query_args[ 'post__in' ] = get_option( 'sticky_posts', array() );
			// The next line appears illogical in comparison with the 
			// previous line, but is necessary to display the correct 
			// number of posts if the number of sticky posts is greater 
			// than the number of posts to be displayed.
			$query_args[ 'ignore_sticky_posts' ] = true;
		} elseif ( $bools[ 'hide_sticky_posts' ] ) {
			// get IDs of sticky posts
			$post_ids = get_option( 'sticky_posts', array() );
			// if there are sticky posts
			if ( $post_ids ) {
				// if argument 'post__not_in' is defined
				if ( isset( $query_args[ 'post__not_in' ] ) ) {
					// merge argument arrays
					$tmp1 = array_merge( $query_args[ 'post__not_in' ], $post_ids );
					// make post IDs in array unique by using a faster way than array_unique()
					$tmp2 = array(); 
					foreach( $tmp1 as $key => $val ) {    
						$tmp2[ $val ] = true; 
					}
					// set argument with cleaned array
					$query_args[ 'post__not_in' ] = array_keys( $tmp2 );
					// delete temporary variables
					unset( $tmp1, $tmp2 );
				} else {
					// set argument with array of post IDs
					$query_args[ 'post__not_in' ] = $post_ids;
				}
			}
			// delete temporary variable
			unset( $post_ids );
		}

		// apply correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			add_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		// run the query: get the latest posts
		$r = new WP_Query( apply_filters( 'ronby_widget_posts_args', $query_args ) );

		// remove correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			remove_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		if ( $r->have_posts()) :
		
			// take custom size if desired
			if ( $thumb_dimensions != 'custom' ) {
				// overwrite thumb_width and thumb_height with closest size
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
				// set dimensions with specified size name
				$this->customs[ 'thumb_dimensions' ] = $thumb_dimensions;
			} else {
				// set dimensions with specified size array
				$this->customs[ 'thumb_dimensions' ] = array( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
			}

			// let there be an empty 'more' label if desired
			if ( isset( $instance[ 'excerpt_more' ] ) ) {
				if ( '' === $instance[ 'excerpt_more' ] ) {
					$this->customs[ 'excerpt_more' ] = '';
				} else {
					$this->customs[ 'excerpt_more' ] = $instance[ 'excerpt_more' ];
				}
			} else {
				$this->customs[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
			}
			// let there be an empty category label if desired
			if ( isset( $instance[ 'category_label' ] ) ) {
				if ( '' === $instance[ 'category_label' ] ) {
					$this->customs[ 'category_label' ] = '';
				} else {
					$this->customs[ 'category_label' ] = $instance[ 'category_label' ];
				}
			} else {
				$this->customs[ 'category_label' ] = $this->defaults[ 'category_label' ];
			}

			// set other global vars
			$this->customs[ 'ignore_excerpt' ]		= $bools[ 'ignore_excerpt' ]; // whether to ignore post excerpt field or not
			$this->customs[ 'set_more_as_link' ]	= $bools[ 'set_more_as_link' ]; // whether to set 'more' signs as link or not
			$this->customs[ 'set_cats_as_links' ]	= $bools[ 'set_cats_as_links' ]; // whether to set category names as links or not
			$this->customs[ 'excerpt_length' ]		= $ints[ 'excerpt_length' ]; // number of characters of excerpt
			$this->customs[ 'post_title_length' ]	= $ints[ 'post_title_length' ]; // maximum number of characters of post title

			// set default image code
			$default_attr = array(
				'src'	=> $default_url,
				'class'	=> sprintf( "attachment-%dx%d", $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ),
				'alt'	=> '',
			);
			$default_img = '<img ';
			$default_img .= rtrim( image_hwstring( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) );
			foreach ( $default_attr as $name => $value ) {
				$default_img .= ' ' . $name . '="' . $value . '"';
			}
			$default_img .= ' />';
			
			// set link target
			if ( $bools[ 'open_new_window' ] ) {
				$this->customs[ 'link_target' ] = ' target="_blank"';
			} else {
				$this->customs[ 'link_target' ] = '';
			}
			
			// translate repeately used texts once (for more performance)
			$text = ', ';
			$this->defaults[ 'comma' ] = __( $text );
			$text = '&hellip;';
			$this->defaults[ 'ellipses' ] = __( $text );
			$text = 'By %s';
			$this->defaults[ 'author_label' ] = _x( $text, 'theme author' );
//use inside the loop
$now = time();
$post_date = get_post_time();
if ( $now - $post_date > 3600 * 24 ) {
  $date_format = get_option('date_format');
} else {      
  $date_format = get_option('time_format');
}
$date = date($date_format, $post_date);
			// print list
?>
<?php echo $args[ 'before_widget' ]; ?>
<div id="ronby-<?php echo $args[ 'widget_id' ];?>" class="ronby-recent-post-widget">
	<?php if ( $title ) echo $args[ 'before_title' ] . $title . $args[ 'after_title' ]; ?>
	<div class="widget ronby-recent-post-4">

	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<div <?php 
			$classes = array();
			if ( is_sticky() ) { 
				$classes[] = 'widget-post-item-3 d-flex align-items-center';
			}else{
				$classes[] = 'widget-post-item-3 d-flex align-items-center';
			}
			if ( $bools[ 'print_post_categories' ] ) {
				$cats = get_the_category();
				if ( is_array( $cats ) and $cats ) {
					foreach ( $cats as $cat ) {
						$classes[] = $cat->slug;
					}
				}
			}
			if ( $classes ) {
				echo ' class="', join( ' ', $classes ), '"';
			}
			?>><div class="thumbnail"><a href="<?php the_permalink(); ?>"<?php echo $this->customs[ 'link_target' ]; ?>><?php 
			if ( $bools[ 'show_thumb' ] ) : 
				$is_thumb = false;
				// if only first image
				if ( $bools[ 'only_1st_img' ] ) :
					// try to find and to display the first post image and to return success
					$is_thumb = $this->the_first_post_image();
				else :
					// look for featured image
					if ( has_post_thumbnail() ) : 
						// if there is featured image then show it
						the_post_thumbnail( $this->customs[ 'thumb_dimensions' ] );
						$is_thumb = true;
					else :
						// if user wishes first image trial
						if ( $bools[ 'try_1st_img' ] ) :
							// try to find and to display the first post image and to return success
							$is_thumb = $this->the_first_post_image();
						endif; // try_1st_img 
					endif; // has_post_thumbnail
				endif; // only_1st_img
				// if there is no image 
				if ( ! $is_thumb ) :
					// if user allows default image then
					if ( $bools[ 'use_default' ] ) :
						echo $default_img;
					endif; // use_default
				endif; // not is_thumb
				// (else do nothing)
			endif; // show_thumb
			// show title if wished

			?></a></div>
			<div class="item-text flex-grow-1 flex-shrink-1">
			<?php
			if ( ! $bools[ 'hide_title' ] ) {?>
			<a class="no-color" href="<?php the_permalink(); ?>">
			<h3 class="post-title hover-color-primary animate-300" <?php if($title_color){echo "style='color:".esc_attr($title_color)."'";} ?>><?php if ( $post_title = $this->get_the_trimmed_post_title() ) { echo $post_title; } else { the_ID(); } ?></h3></a>
			<?php 
			if ( $bools[ 'show_date' ] ) : 
				?><div class="post-time"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></div><?php 
			endif;
			if ( $bools[ 'show_author' ] ) : 
				?><div class="post-date ronby-post-author"><i class="far fa-user"></i> <?php echo esc_html( $this->get_the_author() ); ?></div><?php 
			endif;
			if ( $bools[ 'show_categories' ] ) : 
				?><div class="post-date ronby-post-categories"><i class="fas fa-tag"></i> <?php echo $this->get_the_categories( $r->post->ID ); ?></div><?php 
			endif;
			if ( $bools[ 'show_comments_number' ] ) : 
				?><div class="post-date ronby-post-comments-number"><i class="far fa-comment-dots"></i> <?php echo get_comments_number_text(); ?></div><?php 
			endif;

			
			?>
			<?php } ?>
			</div><?php 
 
		?></div>
	<?php endwhile; ?>
	</div>
</div><!-- .ronby-widget -->
<?php echo $args[ 'after_widget' ]; ?>

<?php

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	function update( $new_widget_settings, $old_widget_settings ) {
		$instance = $old_widget_settings;
		// sanitize user input before update
		$instance[ 'title' ] 				= ( isset( $new_widget_settings[ 'title' ] ) )					? strip_tags( $new_widget_settings[ 'title' ] )						: $this->defaults[ 'widget_title' ];
		$instance[ 'default_url' ] 			= ( isset( $new_widget_settings[ 'default_url' ] ) )			? esc_url_raw( $new_widget_settings[ 'default_url' ] )				: $this->defaults[ 'thumb_url' ];
		$instance[ 'thumb_dimensions' ] 	= ( isset( $new_widget_settings[ 'thumb_dimensions' ] ) )		? strip_tags( $new_widget_settings[ 'thumb_dimensions' ] )			: $this->defaults[ 'thumb_dimensions' ];
		$instance[ 'category_ids' ]   		= ( isset( $new_widget_settings[ 'category_ids' ] ) )			? array_map( 'absint', $new_widget_settings[ 'category_ids' ] )		: $this->defaults[ 'category_ids' ];
		$instance['title_color']= strip_tags( $new_widget_settings['title_color'] );
		// initialize integer variables
		foreach ( $this->ints as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? absint( $new_widget_settings[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		foreach ( $this->bools_false as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $new_widget_settings[ 'excerpt_more' ] ) ) {
			if ( '' == $new_widget_settings[ 'excerpt_more' ] ) {
				$instance[ 'excerpt_more' ] = '';
			} else {
				$instance[ 'excerpt_more' ] = $new_widget_settings[ 'excerpt_more' ];
			}
		} else {
			$instance[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $new_widget_settings[ 'category_label' ] ) ) {
			if ( '' == $new_widget_settings[ 'category_label' ] ) {
				$instance[ 'category_label' ] = '';
			} else {
				$instance[ 'category_label' ] = $new_widget_settings[ 'category_label' ];
			}
		} else {
			$instance[ 'category_label' ] = $this->defaults[ 'category_label' ];
		}

		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $instance[ 'category_ids' ] ) ) {
			$instance[ 'category_ids' ] = $this->defaults[ 'category_ids' ];
		}
		
		// empty widget cache
		$this->flush_widget_cache4();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ $this->defaults[ 'plugin_slug' ] ] ) ) {
			delete_option( $this->defaults[ 'plugin_slug' ] );
		}

		// delete current css file to let make new one via $this->enqueue_public_style()
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			// remove the file
			unlink( $this->defaults[ 'css_file_path' ] );
		}

		// return sanitized current widget settings
		return $instance;
	}

	function flush_widget_cache4() {
		wp_cache_delete( $this->defaults[ 'plugin_slug' ], 'widget' );
	}

	function form( $instance ) {
		// get and sanitize values
		$title					= ( isset( $instance[ 'title' ] ) ) 				? $instance[ 'title' ]				: $this->defaults[ 'widget_title' ];
		$thumb_dimensions		= ( isset( $instance[ 'thumb_dimensions' ] ) )		? $instance[ 'thumb_dimensions' ]	: $this->defaults[ 'thumb_dimensions' ];
		$default_url			= ( isset( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]		: $this->defaults[ 'thumb_url' ];
		$category_ids			= ( isset( $instance[ 'category_ids' ] ) )			? $instance[ 'category_ids' ]		: $this->defaults[ 'category_ids' ];
		$title_color		= ( isset( $instance[ 'title_color' ] ) ) ? $instance[ 'title_color' ]	: '';
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( isset( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : true;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $instance[ 'excerpt_more' ] ) ) {
			if ( '' == $instance[ 'excerpt_more' ] ) {
				$excerpt_more = '';
			} else {
				$excerpt_more = $instance[ 'excerpt_more' ];
			}
		} else {
			$excerpt_more = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $instance[ 'category_label' ] ) ) {
			if ( '' == $instance[ 'category_label' ] ) {
				$category_label = '';
			} else {
				$category_label = $instance[ 'category_label' ];
			}
		} else {
			$category_label = $this->defaults[ 'category_label' ];
		}
		
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// compute ids only once to improve performance
		$field_ids = array();
		$field_ids[ 'category_ids' ]	= $this->get_field_id( 'category_ids' );
		$field_ids[ 'category_label' ]	= $this->get_field_id( 'category_label' );
		$field_ids[ 'default_url' ]		= $this->get_field_id( 'default_url' );
		$field_ids[ 'excerpt_more' ]	= $this->get_field_id( 'excerpt_more' );
		$field_ids[ 'title' ]			= $this->get_field_id( 'title' );
		$field_ids[ 'thumb_dimensions' ]= $this->get_field_id( 'thumb_dimensions' );
		foreach ( array_merge( $this->ints, $this->bools_false, $this->bools_true ) as $key ) {
			$field_ids[ $key ] = $this->get_field_id( $key );
		}
		
		// get texts and values for image sizes dropdown
		global $_wp_additional_image_sizes;
		$wp_standard_image_size_labels = array();
		$label = 'Full Size';	$wp_standard_image_size_labels[ 'full' ]		= __( $label );
		$label = 'Large';		$wp_standard_image_size_labels[ 'large' ]		= __( $label );
		$label = 'Medium';		$wp_standard_image_size_labels[ 'medium' ]		= __( $label );
		$label = 'Thumbnail';	$wp_standard_image_size_labels[ 'thumbnail' ]	= __( $label );
		
		$wp_standard_image_size_names = array_keys( $wp_standard_image_size_labels );
		$size_options = array();
		foreach ( get_intermediate_image_sizes() as $size_name ) {
			// Don't take numeric sizes that appear
			if( is_integer( $size_name ) ) {
				continue;
			}
			$option_values = array();
			// Set technical name
			$option_values[ 'size_name' ] = $size_name;
			// Set name
			$option_values[ 'name' ] = in_array( $size_name, $wp_standard_image_size_names ) ? $wp_standard_image_size_labels[$size_name] : $size_name;
			// Set width
			$option_values[ 'width' ] = isset( $_wp_additional_image_sizes[$size_name]['width'] ) ? $_wp_additional_image_sizes[$size_name]['width'] : get_option( "{$size_name}_size_w" );
			// Set height
			$option_values[ 'height' ] = isset( $_wp_additional_image_sizes[$size_name]['height'] ) ? $_wp_additional_image_sizes[$size_name]['height'] : get_option( "{$size_name}_size_h" );
			// add option to options list
			$size_options[] = $option_values;
		}
		
		// create text to Media Settings page
		$text = 'Settings';	$label_settings	= __( $text );
		$text = 'Media';	$label_media	= _x( $text, 'post type general name' );
		$label = sprintf( '%s &rsaquo; %s', $label_settings, $label_media );
		$media_trail = ( current_user_can( 'manage_options' ) ) ? sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( admin_url( 'options-media.php' ) ), esc_html( $label ) ) : sprintf( '<em>%s</em>', esc_html( $label ) );

		// get texts and values for categories dropdown
		#$none_text = 'All Categories';
		$all_text = 'All Categories';
		$label_all_cats = __( $all_text );

		// get categories
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 1 ) );
		$number_of_cats = count( $categories );
		
		// get size (number of rows to display) of selection box: not more than 10
		$number_of_rows = ( 10 > $number_of_cats ) ? $number_of_cats + 1 : 10;

		// start selection box
		$selection_element = sprintf(
			'<select name="%s[]" id="%s" class="ronby-cat-select" multiple size="%d">',
			$this->get_field_name( 'category_ids' ),
			$field_ids[ 'category_ids' ],
			$number_of_rows
		);
		$selection_element .= "\n";

		// make selection box entries
		$cat_list = array();
		if ( 0 < $number_of_cats ) {

			// make a hierarchical list of categories
			while ( $categories ) {
				// go on with the first element in the categories list:
				// if there is no parent
				if ( '0' == $categories[ 0 ]->parent ) {
					// get and remove it from the categories list
					$current_entry = array_shift( $categories );
					// append the current entry to the new list
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> 0
					);
					// go on looping
					continue;
				}
				// if there is a parent:
				// try to find parent in new list and get its array index
				$parent_index = $this->get_cat_parent_index( $cat_list, $categories[ 0 ]->parent );
				// if parent is not yet in the new list: try to find the parent later in the loop
				if ( false === $parent_index ) {
					// get and remove current entry from the categories list
					$current_entry = array_shift( $categories );
					// append it at the end of the categories list
					$categories[] = $current_entry;
					// go on looping
					continue;
				}
				// if there is a parent and parent is in new list:
				// set depth of current item: +1 of parent's depth
				$depth = $cat_list[ $parent_index ][ 'depth' ] + 1;
				// set new index as next to parent index
				$new_index = $parent_index + 1;
				// find the correct index where to insert the current item
				foreach( $cat_list as $entry ) {
					// if there are items with same or higher depth than current item
					if ( $depth <= $entry[ 'depth' ] ) {
						// increase new index
						$new_index = $new_index + 1;
						// go on looping in foreach()
						continue;
					}
					// if the correct index is found:
					// get current entry and remove it from the categories list
					$current_entry = array_shift( $categories );
					// insert current item into the new list at correct index
					$end_array = array_splice( $cat_list, $new_index ); // $cat_list is changed, too
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> $depth
					);
					$cat_list = array_merge( $cat_list, $end_array );
					// quit foreach(), go on while-looping
					break;
				} // foreach( cat_list )
			} // while( categories )

			// make HTML of selection box
			$selected = ( in_array( 0, $category_ids ) ) ? ' selected="selected"' : '';
			$selection_element .= "\t";
			$selection_element .= '<option value="0"' . $selected . '>' . $label_all_cats . '</option>';
			$selection_element .= "\n";

			foreach ( $cat_list as $category ) {
				$cat_name = apply_filters( 'ronby_list_cats', $category[ 'name' ], $category );
				$pad = ( 0 < $category[ 'depth' ] ) ? str_repeat('&ndash;&nbsp;', $category[ 'depth' ] ) : '';
				$selection_element .= "\t";
				$selection_element .= '<option value="' . $category[ 'id' ] . '"';
				$selection_element .= ( in_array( $category[ 'id' ], $category_ids ) ) ? ' selected="selected"' : '';
				$selection_element .= '>' . $pad . $cat_name . '</option>';
				$selection_element .= "\n";
			}
			
		}

		// close selection box
		$selection_element .= "</select>\n";
		
		// print form in widgets page
?>


<p><label for="<?php echo $field_ids[ 'title' ]; ?>"><?php $text = 'Title'; esc_html_e( $text ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'title' ]; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

<p><label for="<?php echo $field_ids[ 'number_posts' ]; ?>"><?php $text = 'Number of posts to show:'; esc_html_e( $text ); ?></label>
<input id="<?php echo $field_ids[ 'number_posts' ]; ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo $ints[ 'number_posts' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'open_new_window' ] ); ?> id="<?php echo $field_ids[ 'open_new_window' ]; ?>" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>" />
<label for="<?php echo $field_ids[ 'open_new_window' ]; ?>"><?php esc_html_e( 'Open post links in new windows?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'random_order' ] ); ?> id="<?php echo $field_ids[ 'random_order' ]; ?>" name="<?php echo $this->get_field_name( 'random_order' ); ?>" />
<label for="<?php echo $field_ids[ 'random_order' ]; ?>"><?php esc_html_e( 'Show posts in random order?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_current_post' ] ); ?> id="<?php echo $field_ids[ 'hide_current_post' ]; ?>" name="<?php echo $this->get_field_name( 'hide_current_post' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_current_post' ]; ?>"><?php esc_html_e( 'Do not show the current post?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Sticky'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'only_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>"><?php esc_html_e( 'Show only sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the options to hide sticky posts and to keep them on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'hide_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>"><?php esc_html_e( 'Do not show sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the option to keep sticky posts on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_sticky' ] ); ?> id="<?php echo $field_ids[ 'keep_sticky' ]; ?>" name="<?php echo $this->get_field_name( 'keep_sticky' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_sticky' ]; ?>"><?php esc_html_e( 'Keep sticky posts on top of the list?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Title'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_title' ] ); ?> id="<?php echo $field_ids[ 'hide_title' ]; ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_title' ]; ?>"><?php esc_html_e( 'Do not show post title?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'Make sure you set a default thumbnail for posts without a thumbnail, otherwise there will be no link.', 'ronby' ); ?></em></label></p>

<p><label for="<?php echo $field_ids[ 'post_title_length' ]; ?>"><?php esc_html_e( 'Maximum length of post title', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'post_title_length' ]; ?>" name="<?php echo $this->get_field_name( 'post_title_length' ); ?>" type="text" value="<?php echo $ints[ 'post_title_length' ]; ?>" size="3" /></p>

<h4><?php $text = 'Author'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_author' ] ); ?> id="<?php echo $field_ids[ 'show_author' ]; ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
<label for="<?php echo $field_ids[ 'show_author' ]; ?>"><?php esc_html_e( 'Show post author?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Categories'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_categories' ] ); ?> id="<?php echo $field_ids[ 'show_categories' ]; ?>" name="<?php echo $this->get_field_name( 'show_categories' ); ?>" />
<label for="<?php echo $field_ids[ 'show_categories' ]; ?>"><?php esc_html_e( 'Show post categories?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_cats_as_links' ] ); ?> id="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>" name="<?php echo $this->get_field_name( 'set_cats_as_links' ); ?>" />
<label for="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>"><?php esc_html_e( 'Set post category names as links, pointing to their archives?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'category_label' ]; ?>"><?php esc_html_e( 'Label for categories:', 'ronby' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'category_label' ]; ?>" name="<?php echo $this->get_field_name( 'category_label' ); ?>" type="text" value="<?php echo esc_attr( $category_label ); ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'ronby' );?></em></p>

<h4><?php $text = 'Date'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_date' ] ); ?> id="<?php echo $field_ids[ 'show_date' ]; ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $field_ids[ 'show_date' ]; ?>"><?php esc_html_e( 'Show post date?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Excerpt'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_excerpt' ] ); ?> id="<?php echo $field_ids[ 'show_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'show_excerpt' ]; ?>"><?php esc_html_e( 'Show excerpt?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'excerpt_length' ]; ?>"><?php esc_html_e( 'Maximum length of excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_length' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo $ints[ 'excerpt_length' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'excerpt_more' ]; ?>"><?php esc_html_e( 'Signs after excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_more' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_more' ); ?>" type="text" value="<?php echo esc_attr( $excerpt_more ); ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_more_as_link' ] ); ?> id="<?php echo $field_ids[ 'set_more_as_link' ]; ?>" name="<?php echo $this->get_field_name( 'set_more_as_link' ); ?>" />
<label for="<?php echo $field_ids[ 'set_more_as_link' ]; ?>"><?php esc_html_e( 'Set signs after excerpt as a link to the post?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'ignore_excerpt' ] ); ?> id="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'ignore_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>"><?php esc_html_e( 'Ignore post excerpt field as excerpt source?', 'ronby' ); ?></label><br />
<em><?php esc_html_e( 'Normally the widget takes the excerpt from the text of the excerpt field unchanged and if there is no text it creates the excerpt from the post content automatically. If this option is activated the excerpt is created from the post content only.', 'ronby' );?></em></p>

<h4><?php $text = 'Comments'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_comments_number' ] ); ?> id="<?php echo $field_ids[ 'show_comments_number' ]; ?>" name="<?php echo $this->get_field_name( 'show_comments_number' ); ?>" />
<label for="<?php echo $field_ids[ 'show_comments_number' ]; ?>"><?php esc_html_e( 'Show number of comments?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Filter by category'; esc_html_e( $text ); ?></h4>

<p><label for="<?php echo $field_ids[ 'category_ids' ];?>"><?php esc_html_e( 'Show posts of selected categories only?', 'ronby' ); ?></label><br />
<?php echo $selection_element; ?><br />
<em><?php printf( esc_html__( 'Click on the categories with pressed CTRL key to select multiple categories. If &#8220;%s&#8221; was selected then other selections will be ignored.', 'ronby' ), $label_all_cats ); ?></em></p>

<h4><?php $text = 'Thumbnail Settings'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_thumb' ] ); ?> id="<?php echo $field_ids[ 'show_thumb' ]; ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
<label for="<?php echo $field_ids[ 'show_thumb' ]; ?>"><?php esc_html_e( 'Show thumbnail?', 'ronby' ); ?></label><br>
<em><?php esc_html_e( 'By default, the featured image of the post is used as long as the next checkboxes do not specify anything different.', 'ronby' ); ?></em></p>

<p><label for="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>"><?php esc_html_e( 'Size of thumbnail', 'ronby' ); ?>:</label>
	<select id="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_dimensions' ); ?>">
		<option value="<?php echo $this->defaults[ 'thumb_dimensions' ]; ?>" <?php selected( $thumb_dimensions, $this->defaults[ 'thumb_dimensions' ] ); ?>><?php esc_html_e( 'Specified width and height', 'ronby' ); ?></option>
<?php
// Display the sizes in the array
foreach ( $size_options as $option ) {
?>
		<option value="<?php echo esc_attr( $option[ 'size_name' ] ); ?>"<?php selected( $thumb_dimensions, $option[ 'size_name' ] ); ?>><?php echo esc_html( $option[ 'name' ] ); ?> (<?php echo absint( $option[ 'width' ] ); ?> &times; <?php echo absint( $option[ 'height' ] ); ?>)</option>
<?php
} // end foreach(option)
?>
	</select><br />
	<em><?php printf( esc_html__( 'If you use a specified size the following sizes will be taken, otherwise they will be ignored and the selected dimension as stored in %s will be used:', 'ronby' ), $media_trail ); ?></em>
</p>

<p><label for="<?php echo $field_ids[ 'thumb_width' ]; ?>"><?php esc_html_e( 'Width of thumbnail', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_width' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" type="text" value="<?php echo $ints[ 'thumb_width' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'thumb_height' ]; ?>"><?php esc_html_e( 'Height of thumbnail', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_height' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" type="text" value="<?php echo $ints[ 'thumb_height' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_aspect_ratio' ] ); ?> id="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>" name="<?php echo $this->get_field_name( 'keep_aspect_ratio' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>"><?php esc_html_e( 'Use aspect ratios of original images?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the given width is used to determine the height of the thumbnail automatically. This option also supports responsive web design.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'try_1st_img' ] ); ?> id="<?php echo $field_ids[ 'try_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'try_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'try_1st_img' ]; ?>"><?php esc_html_e( "Try to use the post's first image if post has no featured image?", 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_1st_img' ] ); ?> id="<?php echo $field_ids[ 'only_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'only_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'only_1st_img' ]; ?>"><?php esc_html_e( 'Use first image only, ignore featured image?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_default' ] ); ?> id="<?php echo $field_ids[ 'use_default' ]; ?>" name="<?php echo $this->get_field_name( 'use_default' ); ?>" />
<label for="<?php echo $field_ids[ 'use_default' ]; ?>"><?php esc_html_e( 'Use default thumbnail if no image could be determined?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'default_url' ]; ?>"><?php esc_html_e( 'URL of default thumbnail (start with http://)', 'ronby' ); ?>:</label>
<input class="widefat" id="<?php echo $field_ids[ 'default_url' ]; ?>" name="<?php echo $this->get_field_name( 'default_url' ); ?>" type="text" value="<?php echo esc_url( $default_url ); ?>" /></p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title_color ' )); ?>"><?php esc_html_e('Title Color', 'ronby'); ?></label><br/>
  <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_color' )); ?>" class="widefat title_color" value="<?php echo esc_attr($instance['title_color']); ?>">
</p>
	<script>
		jQuery(document).ready(function($){	
			jQuery('.title_color').each(function(){
        		jQuery(this).wpColorPicker();
    		});			
		});
	</script>
<?php

	}
	
	/**
	 * Return the array index of a given ID
	 *
	 * @since 4.1
	 */
	private function get_cat_parent_index( $arr, $id ) {
		$len = count( $arr );
		if ( 0 == $len ) {
			return false;
		}
		$id = absint( $id );
		for ( $i = 0; $i < $len; $i++ ) {
			if ( $id == $arr[ $i ][ 'id' ] ) {
				return $i;
			}
		}
		return false; 
	}
	
	/**
	 * Load the widget's CSS in the HEAD section of the frontend
	 *
	 * @since 2.3
	 */
	public function enqueue_public_style () {
		
		$is_file = false;
		$css_code = '';
		// make sure the CSS file exists; if not available: generate it
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			$is_file = true;
		} else {
			// get stored settings
			$all_settings = $this->get_settings();
			// quit if at least 1 widget was set for no CSS at all
			foreach ( $all_settings as $id => $settings ) {
				if ( isset( $settings[ 'use_no_css' ] ) and $settings[ 'use_no_css' ] ) {
					return;
				}
			} // foreach ( $all_settings as $id => $settings )

			// get the CSS code
			list( $css_code, $use_inline_css ) = $this->generate_css_code( $all_settings );
			// if not to print the CSS as inline code in the HTML document
			if ( ! $use_inline_css ) {
				// write file safely
				if ( @file_put_contents( $this->defaults[ 'css_file_path' ], $css_code ) ) {
					// file writing was successfull, so change file permissions
					chmod( $this->defaults[ 'css_file_path' ], 0644 );
					$is_file = true;
				} // if CSS file successfully created
			} // if no inline CSS
		} // if CSS file exists
			
		// if there is a CSS file
		if ( $is_file ) {
			// enqueue the CSS file
			wp_enqueue_style(
				$this->defaults[ 'plugin_slug' ] . '-public-style-4',
				plugin_dir_url( __FILE__ ) . 'custom4.css',
				array(),
				$this->defaults[ 'plugin_version' ],
				'all' 
			);
		} else {
			// print inline CSS
			print "\n<!-- Ronby Recent Post List Widget Four: inline CSS -->\n";
			printf( "<style type='text/css'>\n%s</style>\n", $css_code );
		} // if $is_file
	}





	/**
	 * Returns the id of the first image in the content, else 0
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    integer    the post id of the first content image
	 */
	private function get_first_content_image_id () {
		// set variables
		global $wpdb;
		$post = get_post();
		if ( $post and isset( $post->post_content ) ) {
			// look for images in HTML code
			preg_match_all( '/<img[^>]+>/i', $post->post_content, $all_img_tags );
			if ( $all_img_tags ) {
				foreach ( $all_img_tags[ 0 ] as $img_tag ) {
					// find class attribute and catch its value
					preg_match( '/<img.*?class\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_class );
					if ( $img_class ) {
						// Look for the WP image id
						preg_match( '/wp-image-([\d]+)/i', $img_class[ 1 ], $thumb_id );
						// if first image id found: check whether is image
						if ( $thumb_id ) {
							$img_id = absint( $thumb_id[ 1 ] );
							// if is image: return its id
							if ( wp_attachment_is_image( $img_id ) ) {
								return $img_id;
							}
						} // if(thumb_id)
					} // if(img_class)
					
					// else: try to catch image id by its url as stored in the database
					// find src attribute and catch its value
					preg_match( '/<img.*?src\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_src );
					if ( $img_src ) {
						// delete optional query string in img src
						$url = preg_replace( '/([^?]+).*/', '\1', $img_src[ 1 ] );
						// delete image dimensions data in img file name, just take base name and extension
						$url = preg_replace( '/(.+)-\d+x\d+\.(\w+)/', '\1.\2', $url );
						// if path is protocol relative then set it absolute
						if ( 0 === strpos( $url, '//' ) ) {
							$url = $this->defaults[ 'site_protocol' ] . ':' . $url;
						// if path is domain relative then set it absolute
						} elseif ( 0 === strpos( $url, '/' ) ) {
							$url = $this->defaults[ 'site_url' ] . $url;
						}
						// look up its id in the db
						$thumb_id = $wpdb->get_var( $wpdb->prepare( "SELECT `ID` FROM $wpdb->posts WHERE `guid` = '%s'", $url ) );
						// if id is available: return it
						if ( $thumb_id ) {
							return absint( $thumb_id );
						} // if(thumb_id)
					} // if(img_src)
				} // foreach(img_tag)
			} // if(all_img_tags)
		} // if (post content)
		
		// if nothing found: return 0
		return 0;
	}

	/**
	 * Echoes the thumbnail of first post's image and returns success
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    bool    success on finding an image
	 */
	private function the_first_post_image () {
		// look for first image
		$thumb_id = $this->get_first_content_image_id();
		// if there is first image then show first image
		if ( $thumb_id ) :
			echo wp_get_attachment_image( $thumb_id, $this->customs[ 'thumb_dimensions' ] );
			return true;
		else :
			return false;
		endif; // thumb_id
	}

	/**
	 * Returns the assigned categories of a post in a string
	 *
	 * @access   private
	 * @since     4.6
	 *
	 */
	private function get_the_categories ( $id ) {
		$terms = get_the_terms( $id, 'category' );

		if ( is_wp_error( $terms ) ) {
			return __( 'Error on listing categories', 'ronby' );
		}

		if ( empty( $terms ) ) {
			$text = 'No categories';
			return __( $text );
		}

		$categories = array();

		if ( $this->customs[ 'set_cats_as_links' ] ) {
			foreach ( $terms as $term ) {
				// get link to category
				$categories[] = sprintf(
					'<a href="%s">%s</a>',
					get_category_link( $term->term_id ),
					esc_html( $term->name )
				);
			}
		} else {
			foreach ( $terms as $term ) {
				// get sanitized category name
				$categories[] = esc_html( $term->name );
			}
		}
		/*foreach ( $terms as $term ) {
			$categories[] = $term->name;
		}*/

		$string = '';
		if ( $this->customs[ 'category_label' ] ) {
			$string = $this->customs[ 'category_label' ] . ' ';
		}
		$string .= join( $this->defaults[ 'comma' ], $categories );
		
		return $string;
	}

	/**
	 * Returns the assigned author of a post in a string
	 *
	 * @access   private
	 * @since     4.8
	 *
	 */
	private function get_the_author () {
		$author = get_the_author();

		if ( empty( $author ) ) {
			return '';
		} else {
			return sprintf( $this->defaults[ 'author_label' ], $author );
		}

	}

	/**
	 * Generate the css code with stored settings
	 *
	 * @since 2.3
	 */
	private function generate_css_code ( $all_instances ) {

		$set_default = true;
		$ints = array();
		$use_inline_css = false;

		// generate CSS
		$css_code  = ".ronby-recent-post-4 ul { list-style: outside none none; margin-left: 0; margin-right: 0; padding-left: 0; padding-right: 0; }\n"; 
		$css_code .= ".ronby-recent-post-4 ul li { overflow: hidden; margin: 0 0 1.5em; }\n"; 
		$css_code .= ".ronby-recent-post-4 ul li:last-child { margin: 0; }\n"; 
		if ( is_rtl() ) {
			$css_code .= ".ronby-recent-post-4 ul li img { display: inline; float: right; margin: .3em 0 .75em .75em; }\n";
		} else {
			$css_code .= ".ronby-recent-post-4 ul li img { display: inline; float: left; margin: .3em .75em .75em 0; }\n";
		}

		foreach ( $all_instances as $number => $settings ) {
			// set width and height
			$ints[ 'thumb_width' ] = $this->defaults[ 'thumb_width' ];
			$ints[ 'thumb_height' ] = $this->defaults[ 'thumb_height' ];
			$thumb_dimensions = isset( $settings[ 'thumb_dimensions' ] ) ? $settings[ 'thumb_dimensions' ] : $this->defaults[ 'thumb_dimensions' ];
			if ( $thumb_dimensions == 'custom' ) {
				if ( isset( $settings[ 'thumb_width' ] ) ) {
					$ints[ 'thumb_width' ]  = absint( $settings[ 'thumb_width' ]  );
				}
				if ( isset( $settings[ 'thumb_height' ] ) ) {
					$ints[ 'thumb_height' ] = absint( $settings[ 'thumb_height' ] );
				}
			} else {
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
			} // $settings[ 'thumb_dimensions' ]
			// get aspect ratio option
			$bools[ 'keep_aspect_ratio' ] = false;
			if ( isset( $settings[ 'keep_aspect_ratio' ] ) ) {
				$bools[ 'keep_aspect_ratio' ] = (bool) $settings[ 'keep_aspect_ratio' ];
				// set CSS code
				if ( $bools[ 'keep_aspect_ratio' ] ) {
					$css_code .= sprintf( '#ronby-%s-%d img { max-width: %dpx; width: 100%%; height: auto; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ] );
					$css_code .= "\n"; 
				} else {
					$css_code .= sprintf( '#ronby-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
					$css_code .= "\n"; 
				}
			} else {
				$css_code .= sprintf( '#ronby-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
				$css_code .= "\n"; 
			}
			// override default code
			$set_default = false;
			// inline CSS if at least 1 widget was set for that
			if ( isset( $settings[ 'use_inline_css' ] ) ) {
				$bools[ 'use_inline_css' ] = (bool) $settings[ 'use_inline_css' ];
				if ( $bools[ 'use_inline_css' ] ) {
					$use_inline_css = true;
				}
			}

		} // foreach ( $all_instances as $number => $settings )
		// set at least this statement if no settings are stored
		if ( $set_default ) {
			$css_code .= sprintf( '.ronby-widget ul li img { width: %dpx; height: %dpx; }', $this->defaults[ 'thumb_width' ], $this->defaults[ 'thumb_height' ] );
			$css_code .= "\n"; 
		}
		
		return array( $css_code, $use_inline_css );
	}

	/**
	 * Returns the shortened excerpt, must use in a loop.
	 *
	 * @since 3.0
	 */
	private function get_the_trimmed_excerpt () {
		
		$post = get_post();
								
		if ( empty( $post ) ) {
			return '';
		}

		$excerpt = '';
		
		if ( post_password_required( $post ) ) {
			$excerpt = 'There is no excerpt because this is a protected post.';
			return esc_html__( $excerpt );
		}

		// get excerpt from text field if desired
		if ( ! $this->customs[ 'ignore_excerpt' ] ) {
			$excerpt = apply_filters( 'ronby_the_excerpt', $post->post_excerpt, $post );
		}
		
		// text processings if no manual excerpt is available
		if ( empty( $excerpt ) ) {

			// get excerpt from post content
			$excerpt = strip_shortcodes( get_the_content( '' ) );
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			$excerpt = wp_trim_words( $excerpt, $this->customs[ 'excerpt_length' ], $this->customs[ 'excerpt_more' ] );
			
			// if excerpt is longer than desired
			if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] ) {
				// get excerpt in desired length
				$sub_excerpt = mb_substr( $excerpt, 0, $this->customs[ 'excerpt_length' ] );
				// get array of shortened excerpt words
				$excerpt_words = explode( ' ', $sub_excerpt );
				// get the length of the last word in the shortened excerpt
				$excerpt_cut = - ( mb_strlen( $excerpt_words[ count( $excerpt_words ) - 1 ] ) );
				// if there is no empty string
				if ( $excerpt_cut < 0 ) {
					// get the shorter excerpt until the last word
					$excerpt = mb_substr( $sub_excerpt, 0, $excerpt_cut );
				} else {
					// get the shortened excerpt
					$excerpt = $sub_excerpt;
				} // if ( $excerpt_cut < 0 )
			} // if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] )
		} // if ( empty( $excerpt ) )
		
		// append 'more' text, set 'more' signs as link if desired
		if ( $this->customs[ 'set_more_as_link' ] ) {
			$excerpt .= sprintf( '<a href="%s"%s>%s</a>', get_the_permalink( $post ), $this->customs[ 'link_target' ], $this->customs[ 'excerpt_more' ] );
		} else {
			$excerpt .= $this->customs[ 'excerpt_more' ];
		}
		
		// return text
		return $excerpt;
	}

	/**
	 * Returns the shortened post title, must use in a loop.
	 *
	 * @since 4.5
	 */
	private function get_the_trimmed_post_title () {
		
		// get current post's post_title
		$post_title = get_the_title();

		// if post_title is longer than desired
		if ( mb_strlen( $post_title ) > $this->customs[ 'post_title_length' ] ) {
			// get post_title in desired length
			$post_title = mb_substr( $post_title, 0, $this->customs[ 'post_title_length' ] );
			// append ellipses
			$post_title .= $this->defaults[ 'ellipses' ];
		}
		// return text
		return $post_title;
	}

	/**
	 * Returns width and height of a image size name, else default sizes
	 *
	 * @since 4.0
	 */
	private function get_image_dimensions ( $size = 'thumbnail' ) {

		$width  = 0;
		$height = 0;
		// check if selected size is in registered images sizes
		if ( in_array( $size, get_intermediate_image_sizes() ) ) {
			// if in WordPress standard image sizes
			if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$width  = get_option( $size . '_size_w' );
				$height = get_option( $size . '_size_h' );
			} else {
				// custom image sizes, formerly added via add_image_size()
				global $_wp_additional_image_sizes;
				$width  = $_wp_additional_image_sizes[ $size ][ 'width' ];
				$height = $_wp_additional_image_sizes[ $size ][ 'height' ];
			}
		}
		// check if vars have true values, else use default size
		if ( ! $width )  $width  = $this->defaults[ 'thumb_width' ];
		if ( ! $height ) $height = $this->defaults[ 'thumb_height' ];
		
		// return sizes
		return array( $width, $height );
	}
	
	/**
	 * Shows sticky posts on top of categories list
	 *
	 * @since 6.2.1
	 */
	public function get_stickies_on_top( $posts ) {
		// get sticky post IDs
		$sticky_posts = get_option( 'sticky_posts' );
		// initialize variables for the correct number of posts in the result list
		$num_posts = count( $posts );
		$sticky_offset = 0;
		// loop over posts and relocate stickies to the front
		for( $i = 0; $i < $num_posts; $i++ ) {
			// if sticky post
			if ( in_array( $posts[ $i ]->ID, $sticky_posts ) ) {
				$sticky_post = $posts[ $i ];
				// remove sticky post from current position
				array_splice( $posts, $i, 1 );
				// move to front, after other stickies
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				// increment the sticky offset. the next sticky will be placed at this offset.
				$sticky_offset++;
				// remove post from sticky posts array
				//$offset = array_search( $sticky_post->ID, $sticky_posts );
				//unset( $sticky_posts[ $offset ] );
			} // if ( in_array( $posts[ $i ]->ID, $sticky_posts ) )
		} // for()
		// return new list
		return $posts;
	}
	
}

/**
 * Register widget on init
 *
 * @since 1.0
 */
function register_ronby_recent_posts_widget_four () {
	register_widget( 'ronby_recent_posts_widget_four' );
}
add_action( 'widgets_init', 'register_ronby_recent_posts_widget_four');


// **********************************************************************// 
// ! Ronby Recent Post List- 5
// **********************************************************************//
class ronby_recent_posts_list_five extends WP_Widget {

	var $defaults;		// default values
	var $bools_false;	// key names of bool variables of value 'false'
	var $bools_true;	// key names of bool variables of value 'true'
	var $ints;			// key names of integer variables of any value
	var $customs;		// user defined values
	var $use_inline_css;// class wide setting, bool type
	var $use_no_css;	// class wide setting, bool type

	function __construct() {
		$language_codes = explode( '_', get_locale() );
		switch ( $language_codes[ 0 ] ) {
			default:
				$widget_name = 'Ronby Recent Post List Five';
				$widget_desc = 'List of your blogs most recent posts with  thumbnails.';
		}
		$this->defaults[ 'category_ids' ]		= array( 0 ); // selected categories
		$this->defaults[ 'category_label' ]		= _x( 'In', 'In {categories}', 'ronby' ); // label for category list
		$this->defaults[ 'css_file_path' ]		= dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'public5.css'; // path of the public css file
		$this->defaults[ 'excerpt_length' ]		= absint( apply_filters( 'ronby_excerpt_length', 55 ) ); // default length: 55 characters
		$this->defaults[ 'excerpt_more' ]		= apply_filters( 'ronby_excerpt_more', ' ' . '[&hellip;]' ); // set ellipses as default 'more'
		$this->defaults[ 'number_posts' ]		= 5; // number of posts to show in the widget
		$this->defaults[ 'plugin_slug' ]		= 'ronby-recent-post-five'; // identifier of this plugin for WP
		$this->defaults[ 'plugin_version' ]		= '6.4.0'; // number of current plugin version
		$this->defaults[ 'post_title_length' ] 	= 1000; // default length: 1000 characters

		$this->defaults[ 'widget_title' ]		= ''; // title of the widget
		// Domain name and protocol of WP site
		$parsed_url = parse_url( home_url() );
		$this->defaults[ 'site_protocol' ]		= $parsed_url[ 'host' ];
		$this->defaults[ 'site_url' ]			= $parsed_url[ 'scheme' ];
		unset( $parsed_url );
		// other vars
		$this->bools_false						= array( 'hide_current_post', 'only_sticky_posts', 'hide_sticky_posts', 'hide_title', 'keep_aspect_ratio', 'keep_sticky', 'only_1st_img', 'random_order', 'show_author', 'show_categories', 'show_comments_number', 'show_date', 'show_excerpt', 'ignore_excerpt', 'set_more_as_link', 'try_1st_img', 'use_default', 'open_new_window', 'print_post_categories', 'set_cats_as_links', 'use_inline_css', 'use_no_css' );
		$this->bools_true						= array( 'show_thumb' );
		$this->ints 							= array( 'excerpt_length', 'number_posts', 'post_title_length' );
		$this->valid_excerpt_sources			= array( 'post_content', 'excerpt_field' );
		$widget_ops 							= array( 'classname' => $this->defaults[ 'plugin_slug' ], 'description' => $widget_desc );
		parent::__construct( $this->defaults[ 'plugin_slug' ], $widget_name, $widget_ops );

		add_action( 'save_post',				array( $this, 'flush_widget_cache5' ) );
		add_action( 'deleted_post',				array( $this, 'flush_widget_cache5' ) );
		add_action( 'switch_theme',				array( $this, 'flush_widget_cache5' ) );



		// not in use, just for the po-editor to display the translation on the plugins overview list
		$widget_name = __( 'Ronby Recent Post List - Five', 'ronby' );
		$widget_desc = __( 'Displays recent post', 'ronby' );

	}

	function widget( $args, $instance ) {
		global $post;

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		// get and sanitize values
		$title					= ( ! empty( $instance[ 'title' ] ) )				? $instance[ 'title' ]									: $this->defaults[ 'widget_title' ];
		$title					= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category_ids 			= ( ! empty( $instance[ 'category_ids' ] ) )		? array_map( 'absint', $instance[ 'category_ids' ] )	: $this->defaults[ 'category_ids' ];
	

		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( ! empty( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		// special case: class wide setting
		$this->use_inline_css = $bools[ 'use_inline_css' ];
		$this->use_no_css = $bools[ 'use_no_css' ];
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}


		// standard params
		$query_args = array(
			'posts_per_page'      => $ints[ 'number_posts' ],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
		);
		
		// set order of posts in widget
		$query_args[ 'orderby' ] = ( $bools[ 'random_order' ] ) ? 'rand' : 'date';
		$query_args[ 'order' ] = 'DESC';
		
		// add categories param only if 'all categories' was not selected
		if ( ! in_array( 0, $category_ids ) ) {
			$query_args[ 'category__in' ] = $category_ids;
		}
		
		// exclude current displayed post
		if ( $bools[ 'hide_current_post' ] ) {
			if ( isset( $post->ID ) and is_singular() ) {
				$query_args[ 'post__not_in' ] = array( $post->ID );
			}
		}

		// ignore sticky posts if desired, else show them on top
		$query_args[ 'ignore_sticky_posts' ] = ( $bools[ 'keep_sticky' ] ) ? false : true;
		
		// exclude sticky posts
		if ( $bools[ 'only_sticky_posts' ] ) {
			// set the filter with IDs of sticky posts
	        $query_args[ 'post__in' ] = get_option( 'sticky_posts', array() );
			// The next line appears illogical in comparison with the 
			// previous line, but is necessary to display the correct 
			// number of posts if the number of sticky posts is greater 
			// than the number of posts to be displayed.
			$query_args[ 'ignore_sticky_posts' ] = true;
		} elseif ( $bools[ 'hide_sticky_posts' ] ) {
			// get IDs of sticky posts
			$post_ids = get_option( 'sticky_posts', array() );
			// if there are sticky posts
			if ( $post_ids ) {
				// if argument 'post__not_in' is defined
				if ( isset( $query_args[ 'post__not_in' ] ) ) {
					// merge argument arrays
					$tmp1 = array_merge( $query_args[ 'post__not_in' ], $post_ids );
					// make post IDs in array unique by using a faster way than array_unique()
					$tmp2 = array(); 
					foreach( $tmp1 as $key => $val ) {    
						$tmp2[ $val ] = true; 
					}
					// set argument with cleaned array
					$query_args[ 'post__not_in' ] = array_keys( $tmp2 );
					// delete temporary variables
					unset( $tmp1, $tmp2 );
				} else {
					// set argument with array of post IDs
					$query_args[ 'post__not_in' ] = $post_ids;
				}
			}
			// delete temporary variable
			unset( $post_ids );
		}

		// apply correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			add_filter( 'the_posts', array( $this, 'get_stickies_on_top5' ) );
		}
		
		// run the query: get the latest posts
		$r = new WP_Query( apply_filters( 'ronby_widget_posts_args', $query_args ) );

		// remove correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			remove_filter( 'the_posts', array( $this, 'get_stickies_on_top5' ) );
		}
		
		if ( $r->have_posts()) :
		

			// let there be an empty 'more' label if desired
			if ( isset( $instance[ 'excerpt_more' ] ) ) {
				if ( '' === $instance[ 'excerpt_more' ] ) {
					$this->customs[ 'excerpt_more' ] = '';
				} else {
					$this->customs[ 'excerpt_more' ] = $instance[ 'excerpt_more' ];
				}
			} else {
				$this->customs[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
			}
			// let there be an empty category label if desired
			if ( isset( $instance[ 'category_label' ] ) ) {
				if ( '' === $instance[ 'category_label' ] ) {
					$this->customs[ 'category_label' ] = '';
				} else {
					$this->customs[ 'category_label' ] = $instance[ 'category_label' ];
				}
			} else {
				$this->customs[ 'category_label' ] = $this->defaults[ 'category_label' ];
			}

			// set other global vars
			$this->customs[ 'ignore_excerpt' ]		= $bools[ 'ignore_excerpt' ]; // whether to ignore post excerpt field or not
			$this->customs[ 'set_more_as_link' ]	= $bools[ 'set_more_as_link' ]; // whether to set 'more' signs as link or not
			$this->customs[ 'set_cats_as_links' ]	= $bools[ 'set_cats_as_links' ]; // whether to set category names as links or not
			$this->customs[ 'excerpt_length' ]		= $ints[ 'excerpt_length' ]; // number of characters of excerpt
			$this->customs[ 'post_title_length' ]	= $ints[ 'post_title_length' ]; // maximum number of characters of post title



			
			// set link target
			if ( $bools[ 'open_new_window' ] ) {
				$this->customs[ 'link_target' ] = ' target="_blank"';
			} else {
				$this->customs[ 'link_target' ] = '';
			}
			
			// translate repeately used texts once (for more performance)
			$text = ', ';
			$this->defaults[ 'comma' ] = __( $text );
			$text = '&hellip;';
			$this->defaults[ 'ellipses' ] = __( $text );
			$text = 'By %s';
			$this->defaults[ 'author_label' ] = _x( $text, 'theme author' );

			// print list
?>
<?php echo $args[ 'before_widget' ]; ?>
<div id="ronby-<?php echo $args[ 'widget_id' ];?>" class="ronby-recent-post-widget">
	<?php if ( $title ) echo $args[ 'before_title' ] . $title . $args[ 'after_title' ]; ?>
	<div class="widget">
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<div<?php 
			$classes = array();
			if ( is_sticky() ) { 
				$classes[] = 'ronby-sticky widget-post-item-5 d-flex align-items-center';
			}else{
				$classes[] = 'widget-post-item-5 d-flex align-items-center';
			}
			if ( $bools[ 'print_post_categories' ] ) {
				$cats = get_the_category();
				if ( is_array( $cats ) and $cats ) {
					foreach ( $cats as $cat ) {
						$classes[] = $cat->slug;
					}
				}
			}
			if ( $classes ) {
				echo ' class="', join( ' ', $classes ), '"';
			}
			?>>
			<div class="flex-fill">
			<?php
			if ( ! $bools[ 'hide_title' ] ) {?>
			<a class="no-color" href="<?php the_permalink(); ?>">
			<h3 class=" post-title animate-300 hover-color-primary"><?php if ( $post_title = $this->get_the_trimmed_post_title() ) { echo $post_title; } else { the_ID(); } ?></h3></a>
			<?php 
			if ( $bools[ 'show_date' ] ) : 
				?><div class="post-date"> <?php echo get_the_date(); ?></div><?php 
			endif;
			if ( $bools[ 'show_author' ] ) : 
				?><div class="post-date ronby-post-author"> <?php echo esc_html( $this->get_the_author() ); ?></div><?php 
			endif;
			if ( $bools[ 'show_categories' ] ) : 
				?><div class="post-date ronby-post-categories"> <?php echo $this->get_the_categories( $r->post->ID ); ?></div><?php 
			endif;
			if ( $bools[ 'show_comments_number' ] ) : 
				?><div class="post-date ronby-post-comments-number"> <?php echo get_comments_number_text(); ?></div><?php 
			endif;
			if ( $bools[ 'show_excerpt' ] ) : 
				?><div class="post-date ronby-post-excerpt"> <?php echo $this->get_the_trimmed_excerpt(); ?></div><?php 
			endif;
			
			?>
			<?php } ?>
			</div><?php 
 
		?></div>
	<?php endwhile; ?>
	</div>
</div><!-- .ronby-widget -->
<?php echo $args[ 'after_widget' ]; ?>

<?php

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	function update( $new_widget_settings, $old_widget_settings ) {
		$instance = $old_widget_settings;
		// sanitize user input before update
		$instance[ 'title' ] 				= ( isset( $new_widget_settings[ 'title' ] ) )					? strip_tags( $new_widget_settings[ 'title' ] )						: $this->defaults[ 'widget_title' ];
		$instance[ 'default_url' ] 			= ( isset( $new_widget_settings[ 'default_url' ] ) )			? esc_url_raw( $new_widget_settings[ 'default_url' ] )				: $this->defaults[ 'thumb_url' ];
		$instance[ 'thumb_dimensions' ] 	= ( isset( $new_widget_settings[ 'thumb_dimensions' ] ) )		? strip_tags( $new_widget_settings[ 'thumb_dimensions' ] )			: $this->defaults[ 'thumb_dimensions' ];
		$instance[ 'category_ids' ]   		= ( isset( $new_widget_settings[ 'category_ids' ] ) )			? array_map( 'absint', $new_widget_settings[ 'category_ids' ] )		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		foreach ( $this->ints as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? absint( $new_widget_settings[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		foreach ( $this->bools_false as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $new_widget_settings[ 'excerpt_more' ] ) ) {
			if ( '' == $new_widget_settings[ 'excerpt_more' ] ) {
				$instance[ 'excerpt_more' ] = '';
			} else {
				$instance[ 'excerpt_more' ] = $new_widget_settings[ 'excerpt_more' ];
			}
		} else {
			$instance[ 'excerpt_more' ] = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $new_widget_settings[ 'category_label' ] ) ) {
			if ( '' == $new_widget_settings[ 'category_label' ] ) {
				$instance[ 'category_label' ] = '';
			} else {
				$instance[ 'category_label' ] = $new_widget_settings[ 'category_label' ];
			}
		} else {
			$instance[ 'category_label' ] = $this->defaults[ 'category_label' ];
		}

		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $instance[ 'category_ids' ] ) ) {
			$instance[ 'category_ids' ] = $this->defaults[ 'category_ids' ];
		}
		
		// empty widget cache
		$this->flush_widget_cache5();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ $this->defaults[ 'plugin_slug' ] ] ) ) {
			delete_option( $this->defaults[ 'plugin_slug' ] );
		}

		// delete current css file to let make new one via $this->enqueue_public_style()
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			// remove the file
			unlink( $this->defaults[ 'css_file_path' ] );
		}

		// return sanitized current widget settings
		return $instance;
	}

	function flush_widget_cache5() {
		wp_cache_delete( $this->defaults[ 'plugin_slug' ], 'widget' );
	}

	function form( $instance ) {
		// get and sanitize values
		$title					= ( isset( $instance[ 'title' ] ) ) 				? $instance[ 'title' ]				: $this->defaults[ 'widget_title' ];

		$category_ids			= ( isset( $instance[ 'category_ids' ] ) )			? $instance[ 'category_ids' ]		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( isset( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : true;
		}

		// let there be an empty 'more' label if desired
		if ( isset( $instance[ 'excerpt_more' ] ) ) {
			if ( '' == $instance[ 'excerpt_more' ] ) {
				$excerpt_more = '';
			} else {
				$excerpt_more = $instance[ 'excerpt_more' ];
			}
		} else {
			$excerpt_more = $this->defaults[ 'excerpt_more' ];
		}
		// let there be an empty category label if desired
		if ( isset( $instance[ 'category_label' ] ) ) {
			if ( '' == $instance[ 'category_label' ] ) {
				$category_label = '';
			} else {
				$category_label = $instance[ 'category_label' ];
			}
		} else {
			$category_label = $this->defaults[ 'category_label' ];
		}
		
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}


		// compute ids only once to improve performance
		$field_ids = array();
		$field_ids[ 'category_ids' ]	= $this->get_field_id( 'category_ids' );
		$field_ids[ 'category_label' ]	= $this->get_field_id( 'category_label' );
		$field_ids[ 'default_url' ]		= $this->get_field_id( 'default_url' );
		$field_ids[ 'excerpt_more' ]	= $this->get_field_id( 'excerpt_more' );
		$field_ids[ 'title' ]			= $this->get_field_id( 'title' );
		$field_ids[ 'thumb_dimensions' ]= $this->get_field_id( 'thumb_dimensions' );
		foreach ( array_merge( $this->ints, $this->bools_false, $this->bools_true ) as $key ) {
			$field_ids[ $key ] = $this->get_field_id( $key );
		}
		
		// get texts and values for image sizes dropdown
		global $_wp_additional_image_sizes;
		$wp_standard_image_size_labels = array();
		$label = 'Full Size';	$wp_standard_image_size_labels[ 'full' ]		= __( $label );
		$label = 'Large';		$wp_standard_image_size_labels[ 'large' ]		= __( $label );
		$label = 'Medium';		$wp_standard_image_size_labels[ 'medium' ]		= __( $label );
		$label = 'Thumbnail';	$wp_standard_image_size_labels[ 'thumbnail' ]	= __( $label );
		
		$wp_standard_image_size_names = array_keys( $wp_standard_image_size_labels );
		$size_options = array();
		foreach ( get_intermediate_image_sizes() as $size_name ) {
			// Don't take numeric sizes that appear
			if( is_integer( $size_name ) ) {
				continue;
			}
			$option_values = array();
			// Set technical name
			$option_values[ 'size_name' ] = $size_name;
			// Set name
			$option_values[ 'name' ] = in_array( $size_name, $wp_standard_image_size_names ) ? $wp_standard_image_size_labels[$size_name] : $size_name;
			// Set width
			$option_values[ 'width' ] = isset( $_wp_additional_image_sizes[$size_name]['width'] ) ? $_wp_additional_image_sizes[$size_name]['width'] : get_option( "{$size_name}_size_w" );
			// Set height
			$option_values[ 'height' ] = isset( $_wp_additional_image_sizes[$size_name]['height'] ) ? $_wp_additional_image_sizes[$size_name]['height'] : get_option( "{$size_name}_size_h" );
			// add option to options list
			$size_options[] = $option_values;
		}
		
		// create text to Media Settings page
		$text = 'Settings';	$label_settings	= __( $text );
		$text = 'Media';	$label_media	= _x( $text, 'post type general name' );
		$label = sprintf( '%s &rsaquo; %s', $label_settings, $label_media );
		$media_trail = ( current_user_can( 'manage_options' ) ) ? sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( admin_url( 'options-media.php' ) ), esc_html( $label ) ) : sprintf( '<em>%s</em>', esc_html( $label ) );

		// get texts and values for categories dropdown
		#$none_text = 'All Categories';
		$all_text = 'All Categories';
		$label_all_cats = __( $all_text );

		// get categories
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 1 ) );
		$number_of_cats = count( $categories );
		
		// get size (number of rows to display) of selection box: not more than 10
		$number_of_rows = ( 10 > $number_of_cats ) ? $number_of_cats + 1 : 10;

		// start selection box
		$selection_element = sprintf(
			'<select name="%s[]" id="%s" class="ronby-cat-select" multiple size="%d">',
			$this->get_field_name( 'category_ids' ),
			$field_ids[ 'category_ids' ],
			$number_of_rows
		);
		$selection_element .= "\n";

		// make selection box entries
		$cat_list = array();
		if ( 0 < $number_of_cats ) {

			// make a hierarchical list of categories
			while ( $categories ) {
				// go on with the first element in the categories list:
				// if there is no parent
				if ( '0' == $categories[ 0 ]->parent ) {
					// get and remove it from the categories list
					$current_entry = array_shift( $categories );
					// append the current entry to the new list
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> 0
					);
					// go on looping
					continue;
				}
				// if there is a parent:
				// try to find parent in new list and get its array index
				$parent_index = $this->get_cat_parent_index( $cat_list, $categories[ 0 ]->parent );
				// if parent is not yet in the new list: try to find the parent later in the loop
				if ( false === $parent_index ) {
					// get and remove current entry from the categories list
					$current_entry = array_shift( $categories );
					// append it at the end of the categories list
					$categories[] = $current_entry;
					// go on looping
					continue;
				}
				// if there is a parent and parent is in new list:
				// set depth of current item: +1 of parent's depth
				$depth = $cat_list[ $parent_index ][ 'depth' ] + 1;
				// set new index as next to parent index
				$new_index = $parent_index + 1;
				// find the correct index where to insert the current item
				foreach( $cat_list as $entry ) {
					// if there are items with same or higher depth than current item
					if ( $depth <= $entry[ 'depth' ] ) {
						// increase new index
						$new_index = $new_index + 1;
						// go on looping in foreach()
						continue;
					}
					// if the correct index is found:
					// get current entry and remove it from the categories list
					$current_entry = array_shift( $categories );
					// insert current item into the new list at correct index
					$end_array = array_splice( $cat_list, $new_index ); // $cat_list is changed, too
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> $depth
					);
					$cat_list = array_merge( $cat_list, $end_array );
					// quit foreach(), go on while-looping
					break;
				} // foreach( cat_list )
			} // while( categories )

			// make HTML of selection box
			$selected = ( in_array( 0, $category_ids ) ) ? ' selected="selected"' : '';
			$selection_element .= "\t";
			$selection_element .= '<option value="0"' . $selected . '>' . $label_all_cats . '</option>';
			$selection_element .= "\n";

			foreach ( $cat_list as $category ) {
				$cat_name = apply_filters( 'ronby_list_cats', $category[ 'name' ], $category );
				$pad = ( 0 < $category[ 'depth' ] ) ? str_repeat('&ndash;&nbsp;', $category[ 'depth' ] ) : '';
				$selection_element .= "\t";
				$selection_element .= '<option value="' . $category[ 'id' ] . '"';
				$selection_element .= ( in_array( $category[ 'id' ], $category_ids ) ) ? ' selected="selected"' : '';
				$selection_element .= '>' . $pad . $cat_name . '</option>';
				$selection_element .= "\n";
			}
			
		}

		// close selection box
		$selection_element .= "</select>\n";
		
		// print form in widgets page
?>


<p><label for="<?php echo $field_ids[ 'title' ]; ?>"><?php $text = 'Title'; esc_html_e( $text ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'title' ]; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

<p><label for="<?php echo $field_ids[ 'number_posts' ]; ?>"><?php $text = 'Number of posts to show:'; esc_html_e( $text ); ?></label>
<input id="<?php echo $field_ids[ 'number_posts' ]; ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo $ints[ 'number_posts' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'open_new_window' ] ); ?> id="<?php echo $field_ids[ 'open_new_window' ]; ?>" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>" />
<label for="<?php echo $field_ids[ 'open_new_window' ]; ?>"><?php esc_html_e( 'Open post links in new windows?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'random_order' ] ); ?> id="<?php echo $field_ids[ 'random_order' ]; ?>" name="<?php echo $this->get_field_name( 'random_order' ); ?>" />
<label for="<?php echo $field_ids[ 'random_order' ]; ?>"><?php esc_html_e( 'Show posts in random order?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_current_post' ] ); ?> id="<?php echo $field_ids[ 'hide_current_post' ]; ?>" name="<?php echo $this->get_field_name( 'hide_current_post' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_current_post' ]; ?>"><?php esc_html_e( 'Do not show the current post?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Sticky'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'only_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>"><?php esc_html_e( 'Show only sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the options to hide sticky posts and to keep them on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'hide_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>"><?php esc_html_e( 'Do not show sticky posts?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'If activated the option to keep sticky posts on top will be ignored.', 'ronby' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_sticky' ] ); ?> id="<?php echo $field_ids[ 'keep_sticky' ]; ?>" name="<?php echo $this->get_field_name( 'keep_sticky' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_sticky' ]; ?>"><?php esc_html_e( 'Keep sticky posts on top of the list?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Title'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_title' ] ); ?> id="<?php echo $field_ids[ 'hide_title' ]; ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_title' ]; ?>"><?php esc_html_e( 'Do not show post title?', 'ronby' ); ?><br />
<em><?php esc_html_e( 'Make sure you set a default thumbnail for posts without a thumbnail, otherwise there will be no link.', 'ronby' ); ?></em></label></p>

<p><label for="<?php echo $field_ids[ 'post_title_length' ]; ?>"><?php esc_html_e( 'Maximum length of post title', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'post_title_length' ]; ?>" name="<?php echo $this->get_field_name( 'post_title_length' ); ?>" type="text" value="<?php echo $ints[ 'post_title_length' ]; ?>" size="3" /></p>

<h4><?php $text = 'Author'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_author' ] ); ?> id="<?php echo $field_ids[ 'show_author' ]; ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
<label for="<?php echo $field_ids[ 'show_author' ]; ?>"><?php esc_html_e( 'Show post author?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Categories'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_categories' ] ); ?> id="<?php echo $field_ids[ 'show_categories' ]; ?>" name="<?php echo $this->get_field_name( 'show_categories' ); ?>" />
<label for="<?php echo $field_ids[ 'show_categories' ]; ?>"><?php esc_html_e( 'Show post categories?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_cats_as_links' ] ); ?> id="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>" name="<?php echo $this->get_field_name( 'set_cats_as_links' ); ?>" />
<label for="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>"><?php esc_html_e( 'Set post category names as links, pointing to their archives?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'category_label' ]; ?>"><?php esc_html_e( 'Label for categories:', 'ronby' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'category_label' ]; ?>" name="<?php echo $this->get_field_name( 'category_label' ); ?>" type="text" value="<?php echo esc_attr( $category_label ); ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'ronby' );?></em></p>

<h4><?php $text = 'Date'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_date' ] ); ?> id="<?php echo $field_ids[ 'show_date' ]; ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $field_ids[ 'show_date' ]; ?>"><?php esc_html_e( 'Show post date?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Excerpt'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_excerpt' ] ); ?> id="<?php echo $field_ids[ 'show_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'show_excerpt' ]; ?>"><?php esc_html_e( 'Show excerpt?', 'ronby' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'excerpt_length' ]; ?>"><?php esc_html_e( 'Maximum length of excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_length' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo $ints[ 'excerpt_length' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'excerpt_more' ]; ?>"><?php esc_html_e( 'Signs after excerpt', 'ronby' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_more' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_more' ); ?>" type="text" value="<?php echo esc_attr( $excerpt_more ); ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_more_as_link' ] ); ?> id="<?php echo $field_ids[ 'set_more_as_link' ]; ?>" name="<?php echo $this->get_field_name( 'set_more_as_link' ); ?>" />
<label for="<?php echo $field_ids[ 'set_more_as_link' ]; ?>"><?php esc_html_e( 'Set signs after excerpt as a link to the post?', 'ronby' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'ignore_excerpt' ] ); ?> id="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'ignore_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>"><?php esc_html_e( 'Ignore post excerpt field as excerpt source?', 'ronby' ); ?></label><br />
<em><?php esc_html_e( 'Normally the widget takes the excerpt from the text of the excerpt field unchanged and if there is no text it creates the excerpt from the post content automatically. If this option is activated the excerpt is created from the post content only.', 'ronby' );?></em></p>

<h4><?php $text = 'Comments'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_comments_number' ] ); ?> id="<?php echo $field_ids[ 'show_comments_number' ]; ?>" name="<?php echo $this->get_field_name( 'show_comments_number' ); ?>" />
<label for="<?php echo $field_ids[ 'show_comments_number' ]; ?>"><?php esc_html_e( 'Show number of comments?', 'ronby' ); ?></label></p>

<h4><?php $text = 'Filter by category'; esc_html_e( $text ); ?></h4>

<p><label for="<?php echo $field_ids[ 'category_ids' ];?>"><?php esc_html_e( 'Show posts of selected categories only?', 'ronby' ); ?></label><br />
<?php echo $selection_element; ?><br />
<em><?php printf( esc_html__( 'Click on the categories with pressed CTRL key to select multiple categories. If &#8220;%s&#8221; was selected then other selections will be ignored.', 'ronby' ), $label_all_cats ); ?></em></p>



<?php

	}
	
	/**
	 * Return the array index of a given ID
	 *
	 * @since 4.1
	 */
	private function get_cat_parent_index( $arr, $id ) {
		$len = count( $arr );
		if ( 0 == $len ) {
			return false;
		}
		$id = absint( $id );
		for ( $i = 0; $i < $len; $i++ ) {
			if ( $id == $arr[ $i ][ 'id' ] ) {
				return $i;
			}
		}
		return false; 
	}
	
	/**
	 * Load the widget's CSS in the HEAD section of the frontend
	 *
	 * @since 2.3
	 */






	/**
	 * Returns the id of the first image in the content, else 0
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    integer    the post id of the first content image
	 */
	private function get_first_content_image_id () {
		// set variables
		global $wpdb;
		$post = get_post();
		if ( $post and isset( $post->post_content ) ) {
			// look for images in HTML code
			preg_match_all( '/<img[^>]+>/i', $post->post_content, $all_img_tags );
			if ( $all_img_tags ) {
				foreach ( $all_img_tags[ 0 ] as $img_tag ) {
					// find class attribute and catch its value
					preg_match( '/<img.*?class\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_class );
					if ( $img_class ) {
						// Look for the WP image id
						preg_match( '/wp-image-([\d]+)/i', $img_class[ 1 ], $thumb_id );
						// if first image id found: check whether is image
						if ( $thumb_id ) {
							$img_id = absint( $thumb_id[ 1 ] );
							// if is image: return its id
							if ( wp_attachment_is_image( $img_id ) ) {
								return $img_id;
							}
						} // if(thumb_id)
					} // if(img_class)
					
					// else: try to catch image id by its url as stored in the database
					// find src attribute and catch its value
					preg_match( '/<img.*?src\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_src );
					if ( $img_src ) {
						// delete optional query string in img src
						$url = preg_replace( '/([^?]+).*/', '\1', $img_src[ 1 ] );
						// delete image dimensions data in img file name, just take base name and extension
						$url = preg_replace( '/(.+)-\d+x\d+\.(\w+)/', '\1.\2', $url );
						// if path is protocol relative then set it absolute
						if ( 0 === strpos( $url, '//' ) ) {
							$url = $this->defaults[ 'site_protocol' ] . ':' . $url;
						// if path is domain relative then set it absolute
						} elseif ( 0 === strpos( $url, '/' ) ) {
							$url = $this->defaults[ 'site_url' ] . $url;
						}
						// look up its id in the db
						$thumb_id = $wpdb->get_var( $wpdb->prepare( "SELECT `ID` FROM $wpdb->posts WHERE `guid` = '%s'", $url ) );
						// if id is available: return it
						if ( $thumb_id ) {
							return absint( $thumb_id );
						} // if(thumb_id)
					} // if(img_src)
				} // foreach(img_tag)
			} // if(all_img_tags)
		} // if (post content)
		
		// if nothing found: return 0
		return 0;
	}

	/**
	 * Echoes the thumbnail of first post's image and returns success
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    bool    success on finding an image
	 */
	private function the_first_post_image () {
		// look for first image
		$thumb_id = $this->get_first_content_image_id();
		// if there is first image then show first image
		if ( $thumb_id ) :
			echo wp_get_attachment_image( $thumb_id, $this->customs[ 'thumb_dimensions' ] );
			return true;
		else :
			return false;
		endif; // thumb_id
	}

	/**
	 * Returns the assigned categories of a post in a string
	 *
	 * @access   private
	 * @since     4.6
	 *
	 */
	private function get_the_categories ( $id ) {
		$terms = get_the_terms( $id, 'category' );

		if ( is_wp_error( $terms ) ) {
			return __( 'Error on listing categories', 'ronby' );
		}

		if ( empty( $terms ) ) {
			$text = 'No categories';
			return __( $text );
		}

		$categories = array();

		if ( $this->customs[ 'set_cats_as_links' ] ) {
			foreach ( $terms as $term ) {
				// get link to category
				$categories[] = sprintf(
					'<a href="%s">%s</a>',
					get_category_link( $term->term_id ),
					esc_html( $term->name )
				);
			}
		} else {
			foreach ( $terms as $term ) {
				// get sanitized category name
				$categories[] = esc_html( $term->name );
			}
		}
		/*foreach ( $terms as $term ) {
			$categories[] = $term->name;
		}*/

		$string = '';
		if ( $this->customs[ 'category_label' ] ) {
			$string = $this->customs[ 'category_label' ] . ' ';
		}
		$string .= join( $this->defaults[ 'comma' ], $categories );
		
		return $string;
	}

	/**
	 * Returns the assigned author of a post in a string
	 *
	 * @access   private
	 * @since     4.8
	 *
	 */
	private function get_the_author () {
		$author = get_the_author();

		if ( empty( $author ) ) {
			return '';
		} else {
			return sprintf( $this->defaults[ 'author_label' ], $author );
		}

	}

	/**
	 * Generate the css code with stored settings
	 *
	 * @since 2.3
	 */


	/**
	 * Returns the shortened excerpt, must use in a loop.
	 *
	 * @since 3.0
	 */
	private function get_the_trimmed_excerpt () {
		
		$post = get_post();
								
		if ( empty( $post ) ) {
			return '';
		}

		$excerpt = '';
		
		if ( post_password_required( $post ) ) {
			$excerpt = 'There is no excerpt because this is a protected post.';
			return esc_html__( $excerpt );
		}

		// get excerpt from text field if desired
		if ( ! $this->customs[ 'ignore_excerpt' ] ) {
			$excerpt = apply_filters( 'ronby_the_excerpt', $post->post_excerpt, $post );
		}
		
		// text processings if no manual excerpt is available
		if ( empty( $excerpt ) ) {

			// get excerpt from post content
			$excerpt = strip_shortcodes( get_the_content( '' ) );
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			$excerpt = wp_trim_words( $excerpt, $this->customs[ 'excerpt_length' ], $this->customs[ 'excerpt_more' ] );
			
			// if excerpt is longer than desired
			if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] ) {
				// get excerpt in desired length
				$sub_excerpt = mb_substr( $excerpt, 0, $this->customs[ 'excerpt_length' ] );
				// get array of shortened excerpt words
				$excerpt_words = explode( ' ', $sub_excerpt );
				// get the length of the last word in the shortened excerpt
				$excerpt_cut = - ( mb_strlen( $excerpt_words[ count( $excerpt_words ) - 1 ] ) );
				// if there is no empty string
				if ( $excerpt_cut < 0 ) {
					// get the shorter excerpt until the last word
					$excerpt = mb_substr( $sub_excerpt, 0, $excerpt_cut );
				} else {
					// get the shortened excerpt
					$excerpt = $sub_excerpt;
				} // if ( $excerpt_cut < 0 )
			} // if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] )
		} // if ( empty( $excerpt ) )
		
		// append 'more' text, set 'more' signs as link if desired
		if ( $this->customs[ 'set_more_as_link' ] ) {
			$excerpt .= sprintf( '<a href="%s"%s>%s</a>', get_the_permalink( $post ), $this->customs[ 'link_target' ], $this->customs[ 'excerpt_more' ] );
		} else {
			$excerpt .= $this->customs[ 'excerpt_more' ];
		}
		
		// return text
		return $excerpt;
	}

	/**
	 * Returns the shortened post title, must use in a loop.
	 *
	 * @since 4.5
	 */
	private function get_the_trimmed_post_title () {
		
		// get current post's post_title
		$post_title = get_the_title();

		// if post_title is longer than desired
		if ( mb_strlen( $post_title ) > $this->customs[ 'post_title_length' ] ) {
			// get post_title in desired length
			$post_title = mb_substr( $post_title, 0, $this->customs[ 'post_title_length' ] );
			// append ellipses
			$post_title .= $this->defaults[ 'ellipses' ];
		}
		// return text
		return $post_title;
	}

	/**
	 * Returns width and height of a image size name, else default sizes
	 *
	 * @since 4.0
	 */
	private function get_image_dimensions ( $size = 'thumbnail' ) {

		$width  = 0;
		$height = 0;
		
		// return sizes
		return array( $width, $height );
	}
	
	/**
	 * Shows sticky posts on top of categories list
	 *
	 * @since 6.2.1
	 */
	public function get_stickies_on_top5( $posts ) {
		// get sticky post IDs
		$sticky_posts = get_option( 'sticky_posts' );
		// initialize variables for the correct number of posts in the result list
		$num_posts = count( $posts );
		$sticky_offset = 0;
		// loop over posts and relocate stickies to the front
		for( $i = 0; $i < $num_posts; $i++ ) {
			// if sticky post
			if ( in_array( $posts[ $i ]->ID, $sticky_posts ) ) {
				$sticky_post = $posts[ $i ];
				// remove sticky post from current position
				array_splice( $posts, $i, 1 );
				// move to front, after other stickies
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				// increment the sticky offset. the next sticky will be placed at this offset.
				$sticky_offset++;
				// remove post from sticky posts array
				//$offset = array_search( $sticky_post->ID, $sticky_posts );
				//unset( $sticky_posts[ $offset ] );
			} // if ( in_array( $posts[ $i ]->ID, $sticky_posts ) )
		} // for()
		// return new list
		return $posts;
	}
	
}

/**
 * Register widget on init
 *
 * @since 1.0
 */
function register_ronby_recent_posts_list_five () {
	register_widget( 'ronby_recent_posts_list_five' );
}
add_action( 'widgets_init', 'register_ronby_recent_posts_list_five');

/***********************
Ronby Image Widget
***********************/
define("RONBY_IMAGE_WIDGET_URL", 		plugin_dir_url( __FILE__ ) );
define("RONBY_IMAGE_WIDGET_PATH", 		plugin_dir_path( __FILE__ ) );
define("RONBY_IMAGE_WIDGET_FILE", 		__FILE__ );
class RBImageWidget extends WP_Widget {

  function __construct(){
  	
	    parent::__construct(
	      'RBImageWidget',
	      __('Ronby Image Gallery', 'ronby' ),
	      array( 'description' => __( "Shows image gallery.", 'ronby' ), )
	    );
  }

  public function widget( $args, $instance ) {
  	if( !isset( $instance['galleries_id'] ) ) return ;

  	if( !isset($instance['title']) ) $instance['title'] = '';
  	if( !isset($instance['columns']) ) $instance['columns'] = 4;

  	if( !isset($args['before_title']) ) $args['before_title'] = '';
  	if( !isset($args['after_title']) ) $args['after_title'] = '';
  	if( !isset($args['before_widget']) ) $args['before_widget'] = '';
  	if( !isset($args['after_widget']) ) $args['after_widget'] = '';

	wp_enqueue_script( 'ronby-image-widget-lightbox-js',	RONBY_IMAGE_WIDGET_URL.'assets/js/swipebox.lightbox.js', 	array( 'jquery' ), 						'1.0.0', false );
	wp_enqueue_script( 'ronby-image-widget-script-js', 	RONBY_IMAGE_WIDGET_URL.'assets/js/script.js', 				array( 'ronby-image-widget-lightbox-js' ), '1.0.0', false );
	wp_enqueue_style(  'ronby-image-widget-style-css',		RONBY_IMAGE_WIDGET_URL.'assets/css/swipebox.style.css', 	array(), 								'1.0.0', 'all' );

    $title = apply_filters( 'widget_title', $instance['title'] );

    $galleries_id = $instance['galleries_id'];
	$columns = $instance['columns'];
	if(!$columns) $columns = 4;
	$lightbox = isset($instance['lightbox']) && $instance['lightbox'] ? $instance['lightbox'] : 0;

    echo $args['before_widget'];
    if( ! empty( $title ) )     echo $args['before_title'] . $title . $args['after_title'];

    echo '<div id="'.uniqid('ronby_image_widget_block_id_').'" class="ronby-image-widget-block" '.($lightbox?' data-hidecaption="1" ':'').'>';
   		echo do_shortcode('[gallery ids="'.$galleries_id.'" link="file"  columns="'.$columns.'" ]');
   	echo '</div>';

    echo $args['after_widget'];
  }


  public function form( $instance ) {
	
	wp_enqueue_media();
	wp_enqueue_style('wp-jquery-ui-dialog');

	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('ronby-image-widget-script-js', 	RONBY_IMAGE_WIDGET_URL.'assets/js/admin.script.js', array( 'jquery' ), '1.0.0', false );


	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	} else {
		$title = __( 'Image Gallery', 'ronby-image-widget' );
	}

    if ( isset( $instance[ 'galleries_id' ] ) ) {
      	$galleries_id = $instance[ 'galleries_id' ];
    } else {
      	$galleries_id = ' ';
    }

     if ( isset( $instance[ 'columns' ] ) ) {
      	$columns = $instance[ 'columns' ];
    } else {
      	$columns = 4;
    }

    if ( isset( $instance[ 'lightbox' ] ) ) {
      	$lightbox = $instance[ 'lightbox' ];
    } else {$lightbox = '';}

    ?>
    <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
	 		<?php _e( 'Title' ); ?>:
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	
	<p>
		<?php _e( 'Use manage images button to select pictures for your photo gallery', 'ronby' ); ?>:
	</p>

	<p>

    	<button data-valuefield="<?php echo $this->get_field_id( 'galleries_id' ); ?>" class="button ronby-image-widget-edit-button"><?php _e( 'Manage Images', 'ronby' ); ?></button>
   		<input type='hidden' id="<?php echo $this->get_field_id( 'galleries_id' ); ?>" name="<?php echo $this->get_field_name( 'galleries_id' ); ?>" value="<?php echo esc_attr( $galleries_id ); ?>" />
	<p>

	<p>
		<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Columns', 'ronby' ); ?>:</label>
		<input id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" class="tiny-text" step="1" min="1" size="3" type="number"  value="<?php echo $columns; ?>" />
	</p>

	<p>
		<input <?php checked( $lightbox , 1 ); ?> value='1' id="<?php echo $this->get_field_id( 'lightbox' ); ?>" name="<?php echo $this->get_field_name( 'lightbox' ); ?>" type="checkbox" >
		<label for="<?php echo $this->get_field_id( 'lightbox' ); ?>"><?php _e( 'Disable Caption', 'ronby' ); ?></label>
	</p>
<?php
	

    
  }

  public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = 		( ! empty( $new_instance['title'] ) ) 		? strip_tags( $new_instance['title'] ) : '';
	$instance['columns'] = 		( ! empty( $new_instance['columns'] ) ) 	? (int) $new_instance['columns'] : 3;
	$instance['lightbox'] = 	( ! empty($new_instance['lightbox'] ) ) 	? (int)  $new_instance['lightbox'] : 0;
	$instance['galleries_id'] = ( ! empty( $new_instance['galleries_id'] ) )? strip_tags($new_instance['galleries_id']) :  ' ';
	return $instance;
  }
}


function widget_init_function_rb_image_widget() {
  	register_widget( 'RBImageWidget' );
}

add_action( 'widgets_init', 'widget_init_function_rb_image_widget' );
