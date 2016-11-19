<?php
/**
 * Do not change this template!
 *
 * 	You can create your own template in
 * 	templates/{your-template-name}/message.tpl.php
 */

require_once(plugin_dir_path(__FILE__).'/../../lib/FBSS_TemplateStringUtils.php');

?>

	<!-- .fb-message -->
	<div class="fb-message" itemscope itemtype="http://schema.org/Article">
		
		<!-- .fb-info -->
		<div class="fb-info">
			<div class="fb-user-img">
				<?php if ($view_data['fb_share_link']) : ?>
				<a href="<?php echo esc_html($view_data['fb_share_link']); ?>" class="fb-share-link" rel="nofollow" target="_blank" itemprop="discussionUrl">
				<?php endif; ?>
					<img src="http://graph.facebook.com/<?php echo esc_html($view_data['page_name']); ?>/picture" alt="<?php _e('profile picture', 'wp-fb-social-stream'); ?>" />
				<?php if ($view_data['fb_share_link']) : ?>
				</a>
				<?php endif; ?>
			</div>
			<div class="fb-message-data">
				<?php if ($view_data['fb_share_link']) : ?>
				<a href="<?php echo esc_html($view_data['fb_share_link']); ?>" class="fb-share-link" rel="nofollow" target="_blank" itemprop="discussionUrl">
				<?php endif; ?>
				<div class="fb-message-data-page-name"><?php echo esc_html($view_data['page_name']); ?></div>
				<?php if ($view_data['fb_share_link']) : ?>
				</a>
				<?php endif; ?>

				<div class="fb-message-date"><?php echo esc_html($view_data['msg_date_string']); ?></div>
				<meta itemprop="datePublished" content="<?php echo esc_html($view_data['msg_date_iso_8601']); ?>" />
			</div>
			<div class="clearer"></div>
		</div>
		<!-- /.fb-info -->
		
		<div class="clearer"></div>
		
		<!-- .fb-message-wrap -->
		<div class="fb-message-wrap">

		<?php if ($view_data['msg_text']) : ?>
			<div class="fb-message-text" itemprop="articleBody">
				<?php
					// escape external data first...
					$view_data['msg_text'] = esc_html($view_data['msg_text']);
					
					// ...then create html output of JSON data
					echo FBSS_TemplateStringUtils::createMessageHTML($view_data['msg_text']);
				?>
			</div>
			<?php endif; ?>

			<?php if ( $view_data['type'] == 'photo' && isset($view_data['img_src']) ) : ?>
			<!-- .fb-message-image -->
			<div class="fb-message-image">
				<img src="<?php echo esc_html($view_data['img_src']); ?>" alt="<?php _e('Message image', 'wp-fb-social-stream'); ?>" itemprop="image" />
			</div>
			<!-- /.fb-message-image -->
			<?php endif; ?>

			<?php if ($view_data['type'] == 'link') : ?>
			<!-- .fb-message-linkbox -->
			<div class="fb-message-linkbox" onclick="window.open('<?php echo esc_html($view_data['link_src']); ?>', '_blank'); return false;">
				<?php if ( isset($view_data['link_img_src']) ) : ?>
				<div class="fb-message-linkbox-img">
					<img src="<?php echo esc_html($view_data['link_img_src']); ?>" alt="<?php _e('Link', 'wp-fb-social-stream'); ?> <?php echo esc_html($view_data['link_img_src']); ?>" />
				</div>
				<?php endif; ?>
				<div class="fb-message-linkbox-txt">
				<?php if ( isset($view_data['link_name']) ) : ?>
					<div class="fb-message-linkbox-name">
						<?php echo esc_html($view_data['link_name']); ?>
					</div>
				<?php endif; ?>
				<?php if ( isset($view_data['link_description']) ) : ?>
					<div class="fb-message-linkbox-desc">
						<?php echo esc_html($view_data['link_description']); ?>
					</div>
				<?php endif; ?>
				<?php if ( isset($view_data['link_caption']) ) : ?>
					<div class="fb-message-linkbox-caption">
						<?php echo esc_html($view_data['link_caption']); ?>
					</div>
				<?php endif; ?>
				</div>
				
				<div class="clearer"></div>
			</div>
			<!-- /.fb-message-linkbox -->
			<?php endif; ?>
			
			<?php if ($view_data['type'] == 'event') : ?>
			<!-- .fb-message-eventbox -->
			<div class="fb-message-eventbox" onclick="window.open('<?php echo esc_html($view_data['event_src']); ?>', '_blank'); return false;">
				<?php if ( isset($view_data['event_img_src']) ) : ?>
				<div class="fb-message-eventbox-img">
					<img src="<?php echo esc_html($view_data['event_img_src']); ?>" alt="<?php _e('Event', 'wp-fb-social-stream'); ?> <?php echo esc_html($view_data['event_src']); ?>" />
				</div>
				<?php endif; ?>
				<div class="fb-message-eventbox-txt">
				<?php if ( isset($view_data['event_name']) ) : ?>
					<div class="fb-message-eventbox-name">
						<?php echo esc_html($view_data['event_name']); ?>
					</div>
				<?php endif; ?>
				<?php if ( isset($view_data['event_description']) ) : ?>
					<div class="fb-message-eventbox-desc">
						<?php echo esc_html($view_data['event_description']); ?>
					</div>
				<?php endif; ?>
				<?php if ( isset($view_data['event_start_date_string']) ) : ?>
					<div class="fb-message-eventbox-date">
						<i class="fa fa-calendar"></i> <?php echo esc_html($view_data['event_start_date_string']); ?>
					</div>
				<?php endif; ?>
				</div>
				
				<div class="clearer"></div>
			</div>
			<!-- /.fb-message-eventbox -->
			<?php endif; ?>
			
			<?php if ( $view_data['type'] == 'video' && isset($view_data['video_src']) ) : ?>
			<!-- .fb-message-video -->
			<div class="fb-message-video">
				<?php if ($view_data['status_type'] == 'added_video') : ?>
				<video controls>
  					<source src="<?php echo esc_html($view_data['video_src']); ?>" type="video/mp4">
					<?php _e('Your browser does not support the video tag.', 'wp-fb-social-stream'); ?>
				</video>
				<div class="fb-message-video-metadata">
					<?php if ( isset($view_data['video_name']) ) : ?>
					<div class="fb-message-video-name"><?php echo esc_html($view_data['video_name']); ?></div>
					<?php endif; ?>
					
					<?php if ( isset($view_data['video_description']) ) : ?>
					<div class="fb-message-video-desc">
						<?php
							$view_data['video_description'] = esc_html($view_data['video_description']);
							echo FBSS_TemplateStringUtils::createMessageHTML($view_data['video_description']);
						?>
					</div>
					<?php endif; ?>
				</div>
				<?php else : ?>
				<div class="fb-message-video-linkbox">
					<div class="fb-message-video-img-wrapper" onclick="window.open('<?php echo esc_html($view_data['fb_share_link']); ?>', '_blank'); return false;">
						<div class="fb-message-video-img">
							<img src="<?php echo esc_html($view_data['video_img_src']); ?>" alt="" />
							<i class="fa fa-play-circle"></i>
						</div>
					</div>
					<div class="fb-message-video-txt">
						<?php if ( isset($view_data['video_name']) ) : ?>
						<div class="fb-message-video-name"><?php echo esc_html($view_data['video_name']); ?></div>
						<?php endif; ?>
						
						<?php if ( isset($view_data['video_description']) ) : ?>
						<div class="fb-message-video-desc">
							<?php
								$view_data['video_description'] = esc_html($view_data['video_description']);
								echo FBSS_TemplateStringUtils::createMessageHTML($view_data['video_description']);
							?>
						</div>
					</div>
					<div class="clearer"></div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<!-- /.fb-message-video -->
			<?php endif; ?>
			
			<!-- .fb-metadata -->
			<div class="fb-metadata">
					<?php if ( isset($view_data['extensions']['fbss-extension-facebook-comments']) ) : ?>
					<script>
					jQuery( document ).ready(function() {
						fbss_comment_<?php esc_attr_e($view_data['i']); ?> = new FBSS_Comments('fbss-comment-link-<?php esc_attr_e($view_data['i']); ?>', 'fbss-extension-comment-<?php esc_attr_e($view_data['i']); ?>', '<?php esc_attr_e($view_data['obj_id']); ?>', '<?php esc_attr_e($view_data['i']); ?>')
					});
					</script>
					<a href="" onclick="fbss_comment_<?php esc_attr_e($view_data['i']); ?>.show(); return false;" id="fbss-comment-link-<?php esc_attr_e($view_data['i']); ?>" class="fb-share-link" rel="nofollow">
					<?php else : ?>
					<a href="<?php echo esc_html($view_data['fb_share_link']); ?>" class="fb-share-link" rel="nofollow" target="_blank">
					<?php endif; ?>
						<span class="fb-likes"><i class="fa fa-thumbs-o-up"></i> <?php echo esc_html($view_data['fb_num_likes']); ?></span>&nbsp;
						<span class="fb-comments"><i class="fa fa-comment"></i> <?php echo esc_html($view_data['fb_num_comments']); ?></span>
						
						<meta itemprop="interactionCount" content="UserLikes:<?php echo esc_html($view_data['fb_num_likes']); ?>" />
						<meta itemprop="interactionCount" content="UserComments:<?php echo esc_html($view_data['fb_num_comments']); ?>" />
					</a>
			</div>
			<!-- /.fb-metadata -->
			
			<?php if ( isset($view_data['extensions']['fbss-extension-facebook-comments']) ) : ?>
			<div style="display:none" class="fbss-extension-facebook-comments" id="fbss-extension-comment-<?php esc_attr_e($view_data['i']); ?>"></div>
			<?php endif; ?>
		</div>
		<!-- /.fb-message-wrap -->
		
		<div class="clearer"></div>
		
	</div>
	<!-- /.fb-message -->
	
	<?php if (! $view_data['is_last_msg']) : ?>
	<div class="fb-message-spacer"></div>
	<?php endif; ?>
	
