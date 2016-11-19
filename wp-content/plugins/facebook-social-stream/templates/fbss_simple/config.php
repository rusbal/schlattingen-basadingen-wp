<?php
/**
 * Do not change this default template-configuration!
 *
 * 	You can create your own template in
 * 	templates/{your-template-name}/config.php
 */

require_once(plugin_dir_path(__FILE__).'../../lib/FBSS_Registry.php');

$template_config = array(
	'api_version'	=> '1.0.0',
	'template_id'	=> 'default', //same as folder name
	'template_name'	=> 'FBSS Default',
	'css'			=> array(
		array(
			'name'		=> __('Message-box', 'wp-fb-social-stream'),
			'desc'		=> __('The main message box', 'wp-fb-social-stream'),
			'config'	=> array(
				'index'		=> 'message_box',
				'configs'	=> array(
					array(
						'config_id'		=> 1,
						'desc'			=> __('Maximum width', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message',
						'property'		=> 'max-width',
						'type'			=> 'size'
					),
					array(
						'config_id'		=> 2,
						'desc'			=> __('Width', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message',
						'property'		=> 'width',
						'type'			=> 'size'
					),
					array(
						'config_id'		=> 3,
						'desc'			=> __('Background color', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message',
						'property'		=> 'background-color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 4,
						'desc'			=> __('Text color message date', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-info .fb-message-data .fb-message-date',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 5,
						'desc'			=> __('Text color message text', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message .fb-message-text',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					),
				)
			)
		),
		array(
			'name'		=> __('Meta-box', 'wp-fb-social-stream'),
			'desc'		=> __('The meta-box contains the like and comment count', 'wp-fb-social-stream'),
			'config'	=> array(
				'index'			=> 'meta_box',
				'configs'		=> array(
					array(
						'config_id'		=> 1,
						'desc'			=> __('Background color', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-metadata',
						'property'		=> 'background-color',
						'type'			=> 'hexcode'
					)
				)
			)
		),
		array(
			'name'		=> __('Link-box', 'wp-fb-social-stream'),
			'desc'		=> __('Links inside the message-box are wrapped by the link-box', 'wp-fb-social-stream'),
			'config'	=> array(
				'index'		=> 'link_box',
				'configs'	=> array(
					array(
						'config_id'		=> 1,
						'desc'			=> __('Background color', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-linkbox',
						'property'		=> 'background-color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 2,
						'desc'			=> __('Text color link name', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-linkbox .fb-message-linkbox-name',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 3,
						'desc'			=> __('Text color link description', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-linkbox .fb-message-linkbox-desc',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 4,
						'desc'			=> __('Text color link caption', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-linkbox .fb-message-linkbox-caption',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					)
				)
			)
		),
		array(
			'name'		=> __('Video-box', 'wp-fb-social-stream'),
			'desc'		=> __('The video-box contains the video itself and optional name and description', 'wp-fb-social-stream'),
			'config'	=> array(
				'index'		=> 'video_box',
				'configs'	=> array(
					array(
							'config_id'		=> 3,
							'desc'			=> __('Background color', 'wp-fb-social-stream'),
							'selector' 		=> '.wp-fb-social-stream .fb-message-video-linkbox',
							'property'		=> 'background-color',
							'type'			=> 'hexcode'
					),
					array(
							'config_id'		=> 1,
							'desc'			=> __('Text color name', 'wp-fb-social-stream'),
							'selector' 		=> '.wp-fb-social-stream .fb-message-video-name',
							'property'		=> 'color',
							'type'			=> 'hexcode'
					),
					array(
							'config_id'		=> 2,
							'desc'			=> __('Text color description', 'wp-fb-social-stream'),
							'selector' 		=> '.wp-fb-social-stream .fb-message-video-desc',
							'property'		=> 'color',
							'type'			=> 'hexcode'
					)
				)
			)
		),
		array(
			'name'		=> __('Event-box', 'wp-fb-social-stream'),
			'desc'		=> __('Events are wrapped by the event-box', 'wp-fb-social-stream'),
			'config'	=> array(
				'index'		=> 'event_box',
				'configs'	=> array(
					array(
						'config_id'		=> 1,
						'desc'			=> __('Background color', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-eventbox',
						'property'		=> 'background-color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 2,
						'desc'			=> __('Text color event name', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-eventbox .fb-message-eventbox-name',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 3,
						'desc'			=> __('Text color event description', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-eventbox .fb-message-eventbox-desc',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					),
					array(
						'config_id'		=> 4,
						'desc'			=> __('Text color event date', 'wp-fb-social-stream'),
						'selector' 		=> '.wp-fb-social-stream .fb-message-eventbox .fb-message-eventbox-date',
						'property'		=> 'color',
						'type'			=> 'hexcode'
					)
				)
			)
		)
	)
);

// register configuration
FBSS_Registry::set('template_config', $template_config);

