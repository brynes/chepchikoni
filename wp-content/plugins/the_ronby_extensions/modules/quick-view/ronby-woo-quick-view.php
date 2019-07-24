<?php
register_activation_hook(__FILE__, 'wcqv_quick_view_activate');

function wcqv_quick_view_activate()
	{
	add_option('wpcqv_view_install_date', date('Y-m-d G:i:s') , '', 'yes');
	$data = array(
		'enable_quick_view' => '1',
		'enable_mobile' => '1',
	);
	add_option('wcqv_options', $data, '', 'yes');
	$data = array(
		'modal_bg' => '#fff',
		'close_btn' => '#95979c',
		'close_btn_bg' => '#4C6298',
		'navigation_bg' => 'rgba(255, 255, 255, 0.2)',
		'navigation_txt' => '#fff'
	);
	add_option('wcqv_style', $data, '', 'yes');
	}
	
$redux=get_option( 'theme_option_data' );  
if($redux['ronby_shop_page_quick_view_switch']==1){
add_action('plugins_loaded', 'wqv_load_class_files');	
}

function wqv_load_class_files()
	{
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
		{
		require_once 'classes/class.frontend.php';

		require_once 'classes/class.backend.php';

		load_plugin_textdomain('woocommerce-quick-view', false, plugin_basename(dirname(__FILE__)) . '/lang');
		$wcqv_plugin_dir_url = plugin_dir_url(__FILE__);
		$data = get_option('wcqv_options');
		$load_backend = new wcqv_backend($wcqv_plugin_dir_url);
		$enable_mobile = ($data['enable_mobile'] === '1') ? true : false;
		if ($load_backend->mobile_detect())
			{
			$load_frontend = new wcqv_frontend($wcqv_plugin_dir_url);
			}
		  else
			{
			$load_frontend = new wcqv_frontend($wcqv_plugin_dir_url);
			}
		}
	}