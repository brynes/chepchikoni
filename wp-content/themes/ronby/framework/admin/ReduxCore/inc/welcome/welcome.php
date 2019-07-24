<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }


    class Redux_Welcome {

        /**
         * @var string The capability users should have to view the page
         */
        public $minimum_capability = 'manage_options';
        public $display_version = "";
        public $redux_loaded = false;

        /**
         * Get things started
         *
         * @since 1.4
         */
        public function __construct() {

            add_action( 'redux/loaded', array( $this, 'init' ) );

            add_action( 'wp_ajax_redux_support_hash', array( $this, 'support_hash' ) );

        }

        public function init() {

            if ( $this->redux_loaded ) {
                return;
            }
            $this->redux_loaded = true;
            add_action( 'admin_menu', array( $this, 'admin_menus' ) );

            if ( isset( $_GET['page'] ) ) {
                if ( substr( $_GET['page'], 0, 6 ) == "redux-" ) {
                    $version               = explode( '.', ReduxFramework::$_version );
                    $this->display_version = $version[0] . '.' . $version[1];
                    add_filter( 'admin_footer_text', array( $this, 'change_wp_footer' ) );
                    add_action( 'admin_head', array( $this, 'admin_head' ) );
                } else {
                    $this->check_version();
                }
            } else {
                $this->check_version();
            }
            update_option( 'redux_version_upgraded_from', ReduxFramework::$_version );
        }


        public function check_version() {
            global $pagenow;

            if ( $pagenow == "admin-ajax.php" || ( $GLOBALS['pagenow'] == "customize" && isset( $_GET['theme'] ) && ! empty( $_GET['theme'] ) ) ) {
                return;
            }

            $saveVer = Redux_Helpers::major_version( get_option( 'redux_version_upgraded_from' ) );
            $curVer  = Redux_Helpers::major_version( ReduxFramework::$_version );
            $compare = false;

            if ( Redux_Helpers::isLocalHost() ) {
                $compare = true;
            } else if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                $compare = true;
            } else {
                $redux = ReduxFrameworkInstances::get_all_instances();

                if ( is_array( $redux ) ) {
                    foreach ( $redux as $panel ) {
                        if ( $panel->args['dev_mode'] == 1 ) {
                            $compare = true;
                            break;
                        }
                    }
                }
            }

            if ( $compare ) {
                $redirect = false;
                if ( empty( $saveVer ) ) {
                    $redirect = true; // First time
                }

                if ( $redirect && ! defined( 'WP_TESTS_DOMAIN' ) && ReduxFramework::$_as_plugin ) {
                    add_action( 'init', array( $this, 'do_redirect' ) );
                }
            }
        }

        public function do_redirect() {
            if ( ! defined( 'WP_CLI' ) ) {
                wp_redirect( admin_url( 'tools.php?page=redux-about' ) );
                exit();
            }
        }

        public function change_wp_footer() {
            echo __( 'Thank You!', 'ronby' );
        }

        public function support_hash() {

            if ( ! wp_verify_nonce( $_POST['nonce'], 'redux-support-hash' ) ) {
                die();
            }

            $data          = get_option( 'redux_support_hash' );
            $data          = wp_parse_args( $data, array( 'check' => '', 'identifier' => '' ) );
            $generate_hash = true;
            $system_info   = Redux_Helpers::compileSystemStatus();
            $newHash       = md5( json_encode( $system_info ) );
            $return        = array();
            if ( $newHash == $data['check'] ) {
                unset( $generate_hash );
            }

            $post_data = array(
                'hash'          => '',
                'site'          => esc_url( home_url( '/' ) ),
                'tracking'      => Redux_Helpers::getTrackingObject(),
                'system_status' => $system_info,
            );
            //$post_data = json_encode( $post_data );
            $post_data = serialize( $post_data );

            if ( isset( $generate_hash ) && $generate_hash ) {
                
                $data['check']      = $newHash;
                $data['identifier'] = "";
                $response           = wp_remote_post( 'http://support.redux.io/v1/', array(
                        'method'      => 'POST',
                        'timeout'     => 65,
                        'redirection' => 5,
                        'httpversion' => '1.0',
                        'blocking'    => true,
                        'compress'    => true,
                        'headers'     => array(),
                        'body'        => array(
                            'data'      => $post_data,
                            'serialize' => 1
                        )
                    )
                );

                if ( is_wp_error( $response ) ) {
                    echo json_encode( array(
                        'status'  => 'error',
                        'message' => $response->get_error_message()
                    ) );
                    die( 1 );
                } else {
                    $response_code = wp_remote_retrieve_response_code( $response );
                    if ( $response_code == 200 ) {
                        $response = wp_remote_retrieve_body( $response );
                        $return   = json_decode( $response, true );
                        if ( isset( $return['identifier'] ) ) {
                            $data['identifier'] = $return['identifier'];
                            update_option( 'redux_support_hash', $data );
                        }
                    } else {
                        $response = wp_remote_retrieve_body( $response );
                        echo json_encode( array(
                            'status'  => 'error',
                            'message' => $response
                        ) );
                    }
                }
            }

            if ( ! empty( $data['identifier'] ) ) {
                $return['status']     = "success";
                $return['identifier'] = $data['identifier'];
            } else {
                $return['status']  = "error";
                $return['message'] = esc_html__( "Support hash could not be generated. Please try again later.", 'ronby' );
            }

            echo json_encode( $return );

            die( 1 );
        }

        /**
         * Register the Dashboard Pages which are later hidden but these pages
         * are used to render the Welcome and Credits pages.
         *
         * @access public
         * @since  1.4
         * @return void
         */
        public function admin_menus() {

            $page = 'add_management_page';

            // About Page
            $page(
                esc_html__( 'Welcome to Redux Framework', 'ronby' ), esc_html__( 'Redux Framework', 'ronby' ), $this->minimum_capability, 'redux-about', array(
                    $this,
                    'about_screen'
                )
            );

            // Status Page
            $page(
                esc_html__( 'Redux Framework Status', 'ronby' ), esc_html__( 'Redux Framework Status', 'ronby' ), $this->minimum_capability, 'redux-status', array(
                    $this,
                    'status_screen'
                )
            );

            //remove_submenu_page( 'tools.php', 'redux-about' );
            remove_submenu_page( 'tools.php', 'redux-status' );
            remove_submenu_page( 'tools.php', 'redux-getting-started' );


        }

        /**
         * Hide Individual Dashboard Pages
         *
         * @access public
         * @since  1.4
         * @return void
         */
        public function admin_head() {

            // Badge for welcome page
            //$badge_url = ReduxFramework::$_url . 'assets/images/redux-badge.png';
            ?>

            <script
                id="redux-qtip-js"
                src='<?php echo esc_url( ReduxFramework::$_url ); ?>assets/js/vendor/qtip/jquery.qtip.js'>
            </script>

            <script
                id="redux-welcome-admin-js"
                src='<?php echo esc_url( ReduxFramework::$_url ) ?>inc/welcome/js/redux-welcome-admin.js'>
            </script>

            <?php
            if ( isset ( $_GET['page'] ) && $_GET['page'] == "redux-support" ) :
                ?>
                <script
                    id="jquery-easing"
                    src='<?php echo esc_url( ReduxFramework::$_url ); ?>inc/welcome/js/jquery.easing.min.js'>
                </script>
            <?php endif; ?>

            <link rel='stylesheet' id='redux-qtip-css'
                href='<?php echo esc_url( ReduxFramework::$_url ); ?>assets/css/vendor/qtip/jquery.qtip.css'
                type='text/css' media='all'/>

            <link rel='stylesheet' id='elusive-icons'
                href='<?php echo esc_url( ReduxFramework::$_url ); ?>assets/css/vendor/elusive-icons/elusive-icons.css'
                type='text/css' media='all'/>

            <link rel='stylesheet' id='redux-welcome-css'
                href='<?php echo esc_url( ReduxFramework::$_url ); ?>inc/welcome/css/redux-welcome.css'
                type='text/css' media='all'/>
            <style type="text/css">
                .redux-badge:before {
                <?php echo is_rtl() ? 'right' : 'left'; ?> : 0;
                }

                .about-wrap .redux-badge {
                <?php echo is_rtl() ? 'left' : 'right'; ?> : 0;
                }

                .about-wrap .feature-rest div {
                    padding- <?php echo is_rtl() ? 'left' : 'right'; ?>: 100px;
                }

                .about-wrap .feature-rest div.last-feature {
                    padding- <?php echo is_rtl() ? 'right' : 'left'; ?>: 100px;
                    padding- <?php echo is_rtl() ? 'left' : 'right'; ?>: 0;
                }

                .about-wrap .feature-rest div.icon:before {
                    margin: <?php echo is_rtl() ? '0 -100px 0 0' : '0 0 0 -100px'; ?>;
                }
            </style>
            <?php
        }

        /**
         * Navigation tabs
         *
         * @access public
         * @since  1.9
         * @return void
         */
        public function tabs() {
            $selected = isset ( $_GET['page'] ) ? esc_attr( $_GET['page'] ) : 'redux-about';
            $nonce    = wp_create_nonce( 'redux-support-hash' );
            ?>
            <input type="hidden" id="redux_support_nonce" value="<?php echo esc_attr( $nonce ); ?>"/>
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab <?php echo esc_attr($selected) == 'redux-about' ? 'nav-tab-active' : ''; ?>"
                    href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'redux-about' ), 'tools.php' ) ) ); ?>">
                    <?php esc_attr_e( "What's New", 'ronby' ); ?>
                </a> <a class="nav-tab <?php echo esc_attr($selected) == 'redux-extensions' ? 'nav-tab-active' : ''; ?>"
                    href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'redux-extensions' ), 'tools.php' ) ) ); ?>">
                    <?php esc_attr_e( 'Extensions', 'ronby' ); ?>
                </a> <a class="nav-tab <?php echo esc_attr($selected) == 'redux-changelog' ? 'nav-tab-active' : ''; ?>"
                    href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'redux-changelog' ), 'tools.php' ) ) ); ?>">
                    <?php esc_attr_e( 'Changelog', 'ronby' ); ?>
                </a> <a class="nav-tab <?php echo esc_attr($selected) == 'redux-credits' ? 'nav-tab-active' : ''; ?>"
                    href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'redux-credits' ), 'tools.php' ) ) ); ?>">
                    <?php _e( 'Credits', 'ronby' ); ?>
                </a> <a class="nav-tab <?php echo esc_attr($selected) == 'redux-support' ? 'nav-tab-active' : ''; ?>"
                    href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'redux-support' ), 'tools.php' ) ) ); ?>">
                    <?php esc_attr_e( 'Support', 'ronby' ); ?>
                </a> <a class="nav-tab <?php echo esc_attr($selected) == 'redux-status' ? 'nav-tab-active' : ''; ?>"
                    href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'redux-status' ), 'tools.php' ) ) ); ?>">
                    <?php esc_attr_e( 'Status', 'ronby' ); ?>
                </a>
            </h2>
            <?php
        }

        /**
         * Render About Screen
         *
         * @access public
         * @since  1.4
         * @return void
         */
        public function about_screen() {
            // Stupid hack for Wordpress alerts and warnings
            echo '<div class="wrap" style="height:0;overflow:hidden;"><h2></h2></div>';

            require_once 'views/about.php';

        }

        /**
         * Render Status Report Screen
         *
         * @access public
         * @since  1.4
         * @return void
         */
        public function status_screen() {
            // Stupid hack for Wordpress alerts and warnings
            echo '<div class="wrap" style="height:0;overflow:hidden;"><h2></h2></div>';

            require_once 'views/status_report.php';

        }

        public function actions() {
            ?>
            <p class="redux-actions">
                <a href="http://docs.reduxframework.com/" class="docs button button-primary"><?php esc_html_e( 'Docs', 'ronby' ); ?></a>
            </p>
            <?php
        }
    }

    new Redux_Welcome();

