<?php

require_once('FBSS_Logger.php');
require_once('FBSS_Registry.php');


class FBSS_ExtensionManager {

	const EXTENSION_SERVICE = 'http://fbss-api.angileri.de/rest/fbss-extensions';
	const CACHING = false;
	
	private $logger;
	private $plugin_base_dir;
	private $extensions_base_dir;
	private $wpurl;
	private $wpversion;
	
	
	public function __construct() {
		$this->logger = new FBSS_Logger(__CLASS__);
		$this->plugin_base_dir = FBSS_Registry::get('plugin_base_dir');
		$this->extensions_base_dir = $this->plugin_base_dir.'/extensions';
		$this->wpurl = get_bloginfo('wpurl');
		$this->wpversion = get_bloginfo('version');
	}
	
	public function getAvailable() {
		$this->logger->log("getAvailable extensions.", __LINE__);
		
		$available = array();
		$json = false;
		
		if (self::CACHING) {
			$json = get_transient('fbss_extension_overview');
		}
		
		if ($json === false) {
			$this->logger->log("Run service call.", __LINE__);
			$extension_service = self::getExtensionService();
			$json = @file_get_contents($extension_service.'/overview'.
					'?wpurl='.$this->wpurl.'&wpversion='.$this->wpversion);
			
			if (!$json) {
				throw new Exception("Extension service did not respond with ".
						"valid HTTP response! Please try again later.");
			}
			
			if ( json_decode($json) && self::CACHING) {
				// cache 5 mins
				set_transient('fbss_extension_overview', $json, 300);
			}
		}
		
		$obj = json_decode($json);
		if (!$obj) {
			throw new Exception("Extension service did not respond with valid ".
					"JSON! Please try again later.");
		}
		
		foreach ($obj->products as $extension) {
			$name = $extension->info->title;
			$status = $extension->info->status;
			
			$this->logger->log("Found extension '$name'.", __LINE__);
			
			if ($status == 'publish') {
				$this->logger->log("Added to extension list.", __LINE__);
				
				array_push($available, array(
					'id'		=> $extension->info->slug,
					'name'		=> $extension->info->title,
					'desc'		=> $extension->info->excerpt,
					'img'		=> $extension->info->thumbnail,
					'version'	=> $extension->licensing->version,
					'download'	=> $extension->info->link,
				));
			} else {
				$this->logger->log("Extension status '$status'. Ignoring it."
						, __LINE__);
			}
		}
		
		return $available;
	}
	
	private function getExtensionService() {
		return (isset($_SERVER['FBSS_EXTENSION_SERVICE'])) ?
			$_SERVER['FBSS_EXTENSION_SERVICE'] : self::EXTENSION_SERVICE;
	}
}