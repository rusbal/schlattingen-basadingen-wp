<?php

require_once('FBSS_Registry.php');
require_once('FBSS_Logger.php');


class FBSS_JS {
	
	private static $logger;
	private static $plugin_dir_url;
	
	public static function register() {
		self::$logger = new FBSS_Logger(__CLASS__);
		self::$plugin_dir_url = FBSS_Registry::get('plugin_base_dir_url');
		
		self::$logger->log("Registered action for JS.", __LINE__);
		
		if (get_option('fbss_setting_disable_js')) {
			self::$logger->log("JS disabled by settings.", __LINE__);
		} else {
			add_action('wp_enqueue_scripts', array(__CLASS__, 'add_js_library'));
		}
	}
	
	public static function add_js_library() {
		self::$logger->log("Add JS library.", __LINE__);
		$plugin_version = FBSS_Registry::get('plugin_version');
		
		wp_enqueue_script( 'wp-fb-social-stream-js', self::$plugin_dir_url.
			'js/wp-fb-social-stream.min.js', array('jquery'), $plugin_version,
			true);
		wp_localize_script('wp-fb-social-stream-js',
			'wp_fb_social_stream_js_vars',
			array( 'ajaxurl' => admin_url('admin-ajax.php') ));
	}
}
