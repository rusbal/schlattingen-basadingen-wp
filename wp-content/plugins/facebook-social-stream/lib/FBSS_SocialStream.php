<?php

require_once('FBSS_DB.php');
require_once('FBSS_ExtensionFactory.php');
require_once('FBSS_Facebook.php');
require_once('FBSS_Logger.php');
require_once('FBSS_Registry.php');
require_once('FBSS_Template.php');
require_once('FBSS_TemplateStringUtils.php');
require_once('FBSS_View.php');


class FBSS_SocialStream {
	
	private $db;
	private $facebook;
	private $logger;
	private $template;
	private $template_id;
	private $extension_factory;
	private $view;
	
	private $page_id;
	private $page_name;
	private $access_token;
	
	
	public function __construct() {
		$this->page_name = FBSS_Registry::get('fb_page_name');
		$this->access_token = FBSS_Registry::get('fb_access_token');
		
		$this->db = new FBSS_DB;
		$this->facebook = new FBSS_Facebook;
		$this->logger = new FBSS_Logger(__CLASS__);
		$this->template = new FBSS_Template;
		$this->template_id = $this->template->getId();
		$this->extension_factory = new FBSS_ExtensionFactory;
		$this->view = new FBSS_View;
		
		$this->setTemplateViewDir();
		
		try {
			// do not die here if extension-check does not work!
			$this->extensions = $this->extension_factory->getInstalledExtensions(true);
		} catch (Exception $e) {
			$this->logger->log("Could not recieve installed extensions with ".
					"license check. Maybe license service is down or internet ".
					"connection is blocked!", __LINE__);
		}
	}
	
	public function get($limit=20, $posts_filter=array()) {
		$page_name = $this->page_name;
		
		$this->logger->log("Get '$limit' social stream posts from page ".
				"'$page_name'.", __LINE__);
		
		$extensions = $this->extensions;
		$messages = $this->db->getByType('message', $limit, $posts_filter);

		$social_stream_data = array();
		$social_stream_msg_html = array();
		$i = 1;
		
		$view_data = array(
			'page_name'		=> $page_name,
			'extensions'	=> $extensions,
			'msg_limit'		=> $limit
		);
		
		foreach ($messages as $msg) {
			$msg_id = $msg->id;
			$msg_obj_id = $msg->object_id;
			$msg_data_json = $msg->data;
			$msg_data_obj = json_decode($msg_data_json);
			
			$view_data['i'] = $i;
			$view_data['obj_id'] = $msg_obj_id;
			
			if ($i == $limit) {
				$view_data['is_last_msg'] = true;
			} else {
				$view_data['is_last_msg'] = false;
			}
			
			$this->logger->log("Processing message '$i' with id '$msg_id' and ".
					"object_id '$msg_obj_id'.", __LINE__);
			
			#$this->logger->log("Message: ".print_r($messages, true), __LINE__);
			
			$msg_type = $msg_data_obj->type;
			$view_data['type'] = $msg_type;
			$view_data['status_type'] = $msg_data_obj->status_type;
			
			$view_data['fb_share_link'] = $this->getShareLinkFromJSON($msg_obj_id, $msg_data_obj, $msg_type);
			
			if (property_exists($msg_data_obj, 'message')) {
				$view_data['msg_text'] = $msg_data_obj->message;
			} else {
				$view_data['msg_text'] = '';
			}
			
			$msg_date_timestamp = strtotime($msg_data_obj->created_time);
			$msg_date_timestamp_local = FBSS_TemplateStringUtils::getLocalTimestamp($msg_date_timestamp);
			
			$view_data['msg_date_iso_8601'] = date('Y-m-d', $msg_date_timestamp_local);
			
			$msg_date_month = date('F', $msg_date_timestamp_local);
			$msg_date_month_translated = __($msg_date_month);
			
			/* translators: date format, see http://php.net/date */
			$date_format = __('jS \of %\s Y h:i A', 'wp-fb-social-stream');
			$view_data['msg_date_string'] = sprintf(
					date($date_format, $msg_date_timestamp_local),
					$msg_date_month_translated );
			
			# read likes and comments
			$view_data['fb_num_likes'] = 0;
			$view_data['fb_num_comments'] = 0;
			
			if (property_exists($msg_data_obj, 'likes')) {
				$view_data['fb_num_likes'] = $msg_data_obj->likes->summary->total_count;
			}
			if (property_exists($msg_data_obj, 'comments')) {
				$view_data['fb_num_comments'] = $msg_data_obj->comments->summary->total_count;
			}
			
			if ($msg_type == 'photo') {
				if (property_exists($msg_data_obj, 'object_id')) {
					$img_id = $msg_data_obj->object_id;
					$image = $this->db->get($img_id, 'image');
					
					$this->logger->log("Processing image with id '$img_id'.",
						__LINE__);
					#$this->logger->log("Image: ".print_r($image, true), __LINE__);
					
					if ($image && property_exists($image, 'data')) {
						$img_data_obj = json_decode($image->data);
						
						$img_src = htmlspecialchars($img_data_obj->source);
						$img_src_thumb = htmlspecialchars($img_data_obj->picture);
						$img_widht = $img_data_obj->width;
						$img_height = $img_data_obj->height;
						
						$msg_data_obj->fbss_picture_src = $img_src;
						$msg_data_obj->fbss_picture_width = $img_widht;
						$msg_data_obj->fbss_picture_height = $img_height;
						
						$view_data['img_src'] = $img_src;
					}
				}
			} else if ($msg_type == 'link') {
				if (property_exists($msg_data_obj, 'link')) {
					$view_data['link_src'] = $msg_data_obj->link;
				}
				if (property_exists($msg_data_obj, 'picture')) {
					$view_data['link_img_src'] = $msg_data_obj->picture;
				}
				if (property_exists($msg_data_obj, 'name')) {
					$view_data['link_name'] = $msg_data_obj->name;
				}
				if (property_exists($msg_data_obj, 'caption')) {
					$view_data['link_caption'] = $msg_data_obj->caption;
				}
				if (property_exists($msg_data_obj, 'description')) {
					$view_data['link_description'] = $msg_data_obj->description;
					if (strlen($view_data['link_description']) > 120) {
						$view_data['link_description'] = substr($view_data['link_description'],0, 120) . "...";
					}
				}
			} else if ($msg_type == 'event') {
				if (property_exists($msg_data_obj, 'link')) {
					$view_data['event_src'] = $msg_data_obj->link;
				}
				if (property_exists($msg_data_obj, 'picture')) {
					$view_data['event_img_src'] = $msg_data_obj->picture;
				}
				if (property_exists($msg_data_obj, 'name')) {
					$view_data['event_name'] = $msg_data_obj->name;
				}
				if (property_exists($msg_data_obj, 'description')) {
					$view_data['event_description'] = $msg_data_obj->description;
					if (strlen($view_data['event_description']) > 120) {
						$view_data['event_description'] = substr($view_data['event_description'],0, 120) . "...";
					}
				}
				
				if (property_exists($msg_data_obj, 'object_id')) {
					$event_id = $msg_data_obj->object_id;
					$event = $this->db->get($event_id, 'event');
						
					$this->logger->log("Processing event with id '$event_id'.",
							__LINE__);
					
					if ($event && property_exists($event, 'data')) {
						$event_data_obj = json_decode($event->data);
						
						$event_start_timestamp = strtotime($event_data_obj->start_time);
						$event_start_timestamp_local = FBSS_TemplateStringUtils::getLocalTimestamp($event_start_timestamp);
							
						$event_start_month = date('F', $event_start_timestamp_local);
						$event_start_month_translated = __($event_start_month);
							
						$view_data['event_start_date_string'] = sprintf(
								date($date_format, $event_start_timestamp_local),
								$event_start_month_translated );
							
					}
				}
			} else if ($msg_type == 'video') {
				$view_data['video_src'] = $msg_data_obj->source;
				$view_data['video_img_src'] = $msg_data_obj->picture;
				
				if (property_exists($msg_data_obj, 'name')) {
					$view_data['video_name'] = $msg_data_obj->name;
				}
				if (property_exists($msg_data_obj, 'description')) {
					$view_data['video_description'] = $msg_data_obj->description;
				}
			}
			
			$msg_html = $this->view->render('message', $view_data);
			
			array_push($social_stream_msg_html, $msg_html);
			array_push($social_stream_data, $msg_data_obj);
			
			$i++;
		}
		
		$html = $this->view->render('wrapper', array(
			'social_stream_html'	=> join('', $social_stream_msg_html),
			'extensions'			=> $extensions
		));
		
		if (get_option('fbss_setting_output_type', 'html') == 'json') {
			$json_view = new FBSS_View; // new object: use default view dir
			$json = $json_view->render('stream_json_wrapper',
				array('json' => json_encode($social_stream_data)) );
			
			return array('html' => $json, 'num_messages' => count($messages));
		}
		
		return array('html' => $html, 'num_messages' => count($messages));
	}
	
	public function store($limit=20, $posts_filter=array(), $cleanup=false) {
		$page_name = $this->page_name;
		
		$this->logger->log("Store social stream for page '$page_name' in DB.",
				 __LINE__);
		
		$page_id = $this->getPageID();
		if ($page_id === false) {
			return false;
		}
		
		$posts_json = $this->getPosts($limit, $posts_filter);
		if ($posts_json === false) {
			return false;
		}
		
		$objPosts = json_decode($posts_json);
		
		$this->db->startTransaction();
		if ($cleanup === true) {
			$this->db->deleteAllEntries();
		}
		
		foreach ($objPosts->data as $objPost) {
			$message_id = $objPost->id;
		
			$message_json = $this->getMessage($message_id);
			if ($message_json === false) {
				continue;
			}

			$objMessage = json_decode($message_json);
			
			$message_type = $objMessage->type;

			$this->logger->log("Retrieved message with id '$message_id' of ".
					"type '$message_type'.", __LINE__);
			
			if (property_exists($objMessage, 'message')) {
				$message_text = $objMessage->message;
				$this->logger->log("Message text '".
						substr ( $message_text , 0 , 100 )."'.", __LINE__);
			}
		
			// save message to MySQL DB
			$this->db->insert($message_id, 'message', $message_json,
				$objMessage->created_time, $objMessage->updated_time);

			if ($message_type == 'photo') {
				$object_id = $objMessage->object_id;
				
				$image_json = $this->getImage($object_id);
				if ($image_json === FALSE) {
					# facebook bug?
					continue;
				}
				
				$this->logger->log("Retrieved image with id '$object_id'.",
						__LINE__);

				$objImage = json_decode($image_json);
				
				if (property_exists($objImage, 'images')) {
					$images = $objImage->images;
		
					// save image to MySQL DB
					$this->db->insert($object_id, 'image', $image_json,
						$objImage->created_time, $objImage->updated_time);
		
					foreach ($images as $image) {
						$img_height = $image->height;
						$img_width = $image->width;
						$img_src = $image->source;
		
						$this->logger->log("Image width '$img_width', height ".
								"'$img_height' and src '$img_src'.", __LINE__);
					}
				} else {
					print "\t no images found for message '$message_id' with object_id '$object_id'.\n";
					$this->logger->log("No images found for message ".
							"'$message_id' with object_id '$object_id'.",
							__LINE__);
				}
			} else if ($message_type == 'event') {
				$object_id = $objMessage->object_id;
				
				$event_json = $this->getEvent($object_id);
				if ($event_json === FALSE) {
					continue;
				}
				
				$this->logger->log("Retrieved event with id '$object_id'.",
						__LINE__);
				
				$this->db->insert($object_id, 'event', $event_json,
						$objMessage->created_time, $objMessage->updated_time);
			}
		}
		
		$this->db->commit();
		
		return true;
	}
	
	public function drop() {
		$this->logger->log("Drop social stream data.", __LINE__);
		
		$this->db->truncate();
		
		return true;
	}
	
	public function getPaginationTimestamp($page, $limit=20) {
		$this->logger->log("Get pagination timestamp.", __LINE__);
		
		if ($page == 1) {
			$offset = 0;
		} else {
			$offset = ($page - 1) * $limit;
			if ($offset > 0) {
				$offset -= 1;
			}
		}
		
		$messages = $this->db->getByType('message', 1, array(), $offset);
		$last_message = end($messages);
		
		$id = $last_message->id;
		$created_time = $last_message->created_time;
		$timestamp = strtotime($created_time);
		
		$this->logger->log("Timestamp of message with id '$id': ".
				"'$created_time' -> '$timestamp' (page '$page')", __LINE__);
		
		return $timestamp;
	}
	
	private function setTemplateViewDir() {
		$tpl_base_dir = FBSS_Registry::get('plugin_base_dir').'/templates';
		$template_dir = $this->template_id;
		
		$this->view->setViewDir($tpl_base_dir.'/'.$template_dir);
	}
	
	private function getPageID() {
		$page_name = $this->page_name;

		$this->logger->log("Get page-id by page-name '$page_name'.", __LINE__);
		
		$page_id = $this->facebook->getFBPageID($page_name);
		if ($page_id === false) {
			$this->logger->log("Could not retrieve page_id for page ".
					"'$page_name'!", __LINE__, true);
			return false;
		}
		
		$this->page_id = $page_id;
		
		return $page_id;
	}
	
	private function getPosts($limit=20, $posts_filter=array()) {
		$page_name = $this->page_name;
		$page_id = $this->page_id;
		
		$this->logger->log("Get posts for page '$page_name' with id '$page_id'.",
				 __LINE__);
		
		if (!$page_id) {
			$this->logger->log("Could not get posts without page_id for page ".
					"'$page_name'!", __LINE__, true);
			return false;
		}
		
		$posts_json = $this->facebook->getFBPosts($page_id, $limit, $posts_filter);
		if ($posts_json === false) {
			$this->logger->log("Could not retrieve posts for page ".
					"'$page_name' with id '$page_id'!", __LINE__, true);
			return false;
		}
		
		return $posts_json;
	}
	
	private function getMessage($message_id) {
		$this->logger->log("Get message with id '$message_id'.", __LINE__);
		$message_json = $this->facebook->getFBMessage($message_id);
		if ($message_json === false) {
			$this->logger->log("Could not retrieve message with id ".
					"'$message_id'!", __LINE__, true);
			return false;
		}
		
		return $message_json;
	}
	
	private function getImage($image_id) {
		$this->logger->log("Get image with id '$image_id'.", __LINE__);
		$image_json = $this->facebook->getFBImage($image_id);
		if ($image_json === false) {
			$this->logger->log("Could not retrieve image with id ".
					"'$image_id'!", __LINE__, true);
			return false;
		}
		
		return $image_json;
	}
	
	private function getEvent($event_id) {
		$this->logger->log("Get event with id '$event_id'.", __LINE__);
		$event_json = $this->facebook->getFBEvent($event_id);
		if ($event_json === false) {
			$this->logger->log("Could not retrieve event with id ".
					"'$event_id'!", __LINE__, true);
			return false;
		}
	
		return $event_json;
	}
	
	private function getShareLinkFromJSON($msg_obj_id, $objMessage, $msg_type) {
		if (property_exists($objMessage, 'actions')) {
			$actions = $objMessage->actions;
			if (is_array($actions)) {
				foreach ($actions as $action) {
					if ($action->name == 'Share'
							&& property_exists($action, 'link')) {
						return $action->link;
					}
				}
			}
		} else {
			// fallback
			if ($msg_type == 'photo') {
				// if there is no action, then link to gallery itself
				if (preg_match('/(.+)_(.+)/i', $msg_obj_id, $match)) {
					return 'https://www.facebook.com/'.$this->page_name.'/posts/'.
							$match[2];
				}
			}
			
			if (property_exists($objMessage, 'link')) {
				return $objMessage->link;
			}
		}
		
		return '';
	}
}
