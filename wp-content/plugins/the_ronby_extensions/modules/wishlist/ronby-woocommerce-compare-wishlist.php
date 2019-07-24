<?php
if ( ! defined( 'ABSPATH' ) ) {

	header( 'HTTP/1.0 404 Not Found', true, 404 );

	exit;
}

class RONBY_WC_Compare_Wishlist {

	/**
	 * The single instance of the class.
	 *
	 * @var RONBY_Woocommerce
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Trigger checks is woocoomerce active or not
	 *
	 * @since 1.0.0
	 * @var   bool
	 */
	public $has_woocommerce = null;

	/**
	 * Holder for plugin folder path
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	public $plugin_dir = null;

	/**
	 * Holder for plugin loader
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	public $loader;

	/**
	 * Holder for plugin scripts suffix
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	public $suffix;

	/**
	 * Main RONBY_WC_Compare_Wishlist Instance.
	 *
	 * Ensures only one instance of RONBY_Woocommerce is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see tm_wc_compare_wishlist()
	 * @return RONBY_WC_Compare_Wishlist - Main instance.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {

			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Sets up needed actions/filters for the theme to initialize.
	 *
	 * @since 1.0.0
	*/
	public function __construct() {

		$page_found = 83;

		if ( ! $this->has_woocommerce() || defined( 'RONBY_WC_COMPARE_WISHLIST_VERISON' ) ) {



			return false;
		}

		define( 'RONBY_WC_COMPARE_WISHLIST_VERISON', '1.1.6' );
		define( 'RONBY_WC_COMPARE_WISHLIST_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Load public assets.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 10 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'lang' ), 1 );

		add_action( 'plugins_loaded', array( $this, 'init' ), 0 );

		register_activation_hook( __FILE__, array( $this, 'tm_wc_compare_wishlist_install' ) );


		$this->set_suffix();
	}




	public function set_suffix() {

		if ( is_null( $this->suffix ) ) {

			$this->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		}
	}

	/**
	 * Loads the translation files.
	 *
	 * @since 1.0.0
	 */
	function lang() {

		load_plugin_textdomain( 'ronby', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function init() {

		include_once 'includes/templater.php';
		include_once 'includes/wishlist/wishlist.php';		
		include_once 'includes/compare/compare.php';

	}

	/**
	 * Check if WooCommerce is active
	 *
	 * @since  1.0.0
	 * @return bool
	 */
	public function has_woocommerce() {

		if ( null == $this->has_woocommerce ) {

			$this->has_woocommerce = in_array(
				'woocommerce/woocommerce.php',
				apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
			);
		}
		return $this->has_woocommerce;
	}

	/**
	 * Enqueue assets.
	 *
	 * @since 1.0.0
	 * @return void
	*/
	public function register_assets() {

		// RONBY Bootstrap Grid
		/*if( ! wp_style_is( 'bootstrap-grid', 'registered' ) ) {

			wp_register_style( 'bootstrap-grid', tm_wc_compare_wishlist()->plugin_url() . '/assets/css/grid.css', array() );
		}*/

		// RONBY WooCompare
		wp_register_style( 'tm-woocompare', tm_wc_compare_wishlist()->plugin_url() . '/assets/css/tm-woocompare.css', array( 'dashicons' ) );
		wp_register_script( 'tm-woocompare', tm_wc_compare_wishlist()->plugin_url() . '/assets/js/tm-woocompare' . $this->suffix . '.js', array( 'jquery' ), RONBY_WC_COMPARE_WISHLIST_VERISON, true );

		wp_register_style( 'tablesaw', tm_wc_compare_wishlist()->plugin_url() . '/assets/css/tablesaw.css', array() );
		wp_register_script( 'tablesaw', tm_wc_compare_wishlist()->plugin_url() . '/assets/js/tablesaw' . $this->suffix . '.js', array( 'jquery' ), RONBY_WC_COMPARE_WISHLIST_VERISON, true );

		wp_register_script( 'tablesaw-init', tm_wc_compare_wishlist()->plugin_url() . '/assets/js/tablesaw-init' . $this->suffix . '.js', array( 'tablesaw' ), RONBY_WC_COMPARE_WISHLIST_VERISON, true );

		wp_localize_script( 'tm-woocompare', 'tmWoocompare', array(
			'ajaxurl'     => admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ),
			'compareText' => get_option( 'tm_woocompare_compare_text', '' ),
			'removeText'  => get_option( 'tm_woocompare_remove_text', ''),
			'countFormat' => apply_filters( 'tm_compare_count_format', '<span class="compare-count">(%count%)</span>' )
		) );

		// RONBY WooWishlist
		wp_register_style( 'tm-woowishlist', tm_wc_compare_wishlist()->plugin_url() . '/assets/css/tm-woowishlist.css', array( 'dashicons' ) );
		wp_register_script( 'tm-woowishlist', tm_wc_compare_wishlist()->plugin_url() . '/assets/js/tm-woowishlist' . $this->suffix . '.js', array( 'jquery' ), RONBY_WC_COMPARE_WISHLIST_VERISON, true );

		wp_localize_script( 'tm-woowishlist', 'tmWoowishlist', array(
			'ajaxurl'   => admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ),
			'addText'   => get_option( 'ronby_woowishlist_wishlist_text', __( 'Add to Wishlist', 'ronby' ) ),
			'addedText' => get_option( 'ronby_woowishlist_added_text', __( 'Added to Wishlist', 'ronby' ) )
		) );
	}

	public function plugin_url() {

		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_dir( $path = null ) {

		if ( ! $this->plugin_dir ) {

			$this->plugin_dir = trailingslashit( plugin_dir_path( __FILE__ ) );
		}
		return $this->plugin_dir . $path;
	}

	public function tm_wc_compare_wishlist_install() {

		require_once 'includes/install.php';

		RONBY_WC_Compare_Wishlist_Install()->init();
	}

	public function get_loader() {

		if ( is_null( $this->loader ) ) {

			$loader = '<img src="'.esc_url(plugin_dir_url('').'the_ronby_extensions/modules/images/compare-list-loader.gif').'" class="text-center" style="width:50px;height:50px"/>';

			$this->loader = '<div class="tm-wc-compare-wishlist-loader">' . apply_filters( 'tm_wc_compare_wishlist_loader', $loader ) . '</div>';
		}
		return $this->loader;
	}

	public function build_html_dataattributes( $atts ) {

		$data_atts = '';

		if( is_array( $atts ) && ! empty( $atts ) ) {

			foreach ( $atts as $key => $attribute ) {

				$data_atts .= ' data-' . $key . '="' . $attribute . '"';
			}
		}
		return $data_atts;
	}

	public function get_original_product_id( $id ) {

		global $sitepress;

		if( isset( $sitepress ) ) {

			$id = icl_object_id($id, 'product', true, $sitepress->get_default_language());
		}
		return $id;
	}
}

function tm_wc_compare_wishlist() {

	return RONBY_WC_Compare_Wishlist::instance();
}

tm_wc_compare_wishlist();

?>