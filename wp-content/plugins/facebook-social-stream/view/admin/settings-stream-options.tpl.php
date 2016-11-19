					<h3><?php _e('Stream options', 'wp-fb-social-stream'); ?></h3>
					<table class="form-table wp-fb-social-stream-options">
						<tbody>
		        			<tr>
								<th scope="row">
									<label for="fbss_setting_update_interval"><?php _e('Update interval', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<input type="text" name="fbss_setting_update_interval" id="fbss_setting_update_interval" value="<?php esc_attr_e( get_option('fbss_setting_update_interval', 30) ); ?>" class="regular-text" /> (<?php _e('minutes', 'wp-fb-social-stream'); ?>)
						        	<p class="description"><?php _e('Default value is 30 minutes', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
		        			<tr>
								<th scope="row">
									<label for="fbss_setting_msg_limit"><?php _e('Max messages', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<input type="text" name="fbss_setting_msg_limit" id="fbss_setting_msg_limit" value="<?php esc_attr_e( get_option('fbss_setting_msg_limit', 20) ); ?>" class="regular-text" />
				        			<p class="description"><?php _e('Default value is 20 messages', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="fbss_setting_output_template"><?php _e('Ouput theme', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<select name="fbss_setting_output_template" id="fbss_setting_output_template">
						        		<?php foreach ($view_data['output_templates'] as $template ) : ?>
										<option value="<?php echo $template; ?>" <?php selected(get_option('fbss_setting_output_template', 'default'), $template); ?>><?php echo $template; ?></option>
										<?php endforeach; ?>
									</select>
						        	<p class="description"><?php _e('Defines the look&feel and styling settings of your social stream', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
						<tbody>
					</table>
					
					<hr />
					
					<h3><?php _e('Display', 'wp-fb-social-stream'); ?></h3>
					<table class="form-table wp-fb-social-stream-options">
						<tbody>
							<tr>
								<th scope="row">
									<label for="fbss_setting_shortcode"><?php _e('Shortcode', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<input type="text" id="fbss_setting_shortcode" value="[fb_social_stream]" onclick="jQuery(this).select();" readonly />
						        	<p class="description"><?php _e('Copy & paste this shortcode into your page, post or widget where you want to display your social stream', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
						<tbody>
					</table>