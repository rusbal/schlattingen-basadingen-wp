<?php

require_once('FBSS_Logger.php');
require_once('FBSS_Registry.php');


class FBSS_Template {
	
	private $logger;
	
	private $template_id;
	private $template_name;
	private $template_config;
	
	
	public function __construct() {
		$this->logger = new FBSS_Logger(__CLASS__);
		
		$template_id = get_option('fbss_setting_output_template', 'default');
		$this->template_id = $template_id;
		
		$this->logger->log("Init configuration for template '$template_id'.",
				__LINE__);
		
		// register configuration in registry by use of include_once
		$template_config_path = plugin_dir_path(__FILE__).'../templates/'.
					$template_id.'/config.php';
		
		if (! @include_once($template_config_path) ) {
			$this->logger->log("Template with id '$template_id' does not exist!".
						" Switching back to default template.", __LINE__);
			
			$this->template_id = 'default';
			
			include_once(plugin_dir_path(__FILE__).'../templates/default'.
					'/config.php');
		}
		
		$this->template_config = FBSS_Registry::get('template_config');
		$this->template_name = $this->template_config['template_name'];
	}
	
	public function getId() {
		return $this->template_id;
	}
	
	public function getName() {
		return $this->template_name;
	}
	
	public function getConfiguration() {
		return $this->template_config;
	}
	
	public function getConfigurationAPIVersion() {
		$template_config = $this->template_config;
		$api_version = $template_config['api_version'];
		
		$this->logger->log("Configuration API version is '$api_version'.",
				__LINE__);
		
		return $api_version;
	}
	
	public function getConfigurationCSS() {
		return $this->template_config['css'];
	}
	
	public function getConfigurationCSSKeydata($with_hidden = true) {
		$this->logger->log("getConfigurationCSSKeydata.", __LINE__);
		
		$template_config = $this->template_config;
		$css_configs = $template_config['css'];
		$config_keys = array();
		
		foreach ($css_configs as $config) {
			$config_index = $config['config']['index'];
				
			foreach ($config['config']['configs'] as $sub_config) {
				if (!$with_hidden) {
					if (isset($sub_config['actions'])) {
						if (isset($sub_config['actions']['hide'])) {
							if ($sub_config['actions']['hide']) {
								continue;
							}
						}
					}
				}
				
				$template_config_key = 'fbss_tplt_cfg_'.$this->template_id.'_'.
					$config_index.'_'.$sub_config['config_id'];
		
				$this->logger->log("Generated css config key ".
						"'$template_config_key.", __LINE__);
		
				array_push($config_keys, array(
					'template_config_key' 	=> $template_config_key,
					'config_index'			=> $config_index,
					'config_id'				=> $sub_config['config_id'],
					'type'					=> $sub_config['type'],
				));
			}
		}
		
		return $config_keys;
	}
	
	public function getDBOptionsConfigurationCSSKeys($with_hidden = true) {
		$this->logger->log("getDBOptionsConfigurationCSSKeys.", __LINE__);
		
		$option_keys = array();
		$config_keydata = $this->getConfigurationCSSKeydata($with_hidden);
		
		foreach ($config_keydata as $key_data) {
			
			array_push($option_keys, $key_data['template_config_key']);
			
			# register unit configuration key for size-type configs
			if ($key_data['type'] == 'size') {
				array_push($option_keys, $key_data['template_config_key'].'_u');
			}
		}
		
		return $option_keys;
	}
	
	public function getDBOptionsKey($config_index, $config_id) {
		return 'fbss_tplt_cfg_'.$this->template_id.'_'.$config_index.'_'.$config_id;
	}
	
	public function getDBOptionsValue($db_options_key) {
		return get_option($db_options_key);
	}
}
