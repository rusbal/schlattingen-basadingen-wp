					<h3><?php _e('Advanced options', 'wp-fb-social-stream'); ?></h3>
					<table class="form-table wp-fb-social-stream-options">
						<tbody>
							<tr>
								<th scope="row">
									<label for="fbss_setting_fb_access_token"><?php _e('Facebook Access Token', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<input type="text" name="fbss_setting_fb_access_token" id="fbss_setting_fb_access_token" value="<?php esc_attr_e( get_option('fbss_setting_fb_access_token') ); ?>" class="regular-text" /> (<?php _e('optional', 'wp-fb-social-stream'); ?>)
						        	<p class="description"><?php _e('Either use your own one with specific rights or leave it empty to use the plugin-default', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="fbss_setting_disable_css"><?php _e('Disable CSS', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<input type="checkbox" name="fbss_setting_disable_css" id="fbss_setting_disable_css" value="1" <?php checked(get_option('fbss_setting_disable_css'), 1, true); ?> />
						        	<p class="description"><?php _e('Disable all CSS settings and CSS includes beside "Custom inline CSS" options down below', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="fbss_setting_disable_js"><?php _e('Disable JS', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<input type="checkbox" name="fbss_setting_disable_js" id="fbss_setting_disable_js" value="1" <?php checked(get_option('fbss_setting_disable_js'), 1, true); ?> />
						        	<p class="description"><?php _e('Disable all Javascript settings and Javascript includes (caution! this also deactivates the automatic stream update)', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="fbss_setting_output_type"><?php _e('Ouput type', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<select name="fbss_setting_output_type" id="fbss_setting_output_type">
										<option value="html" <?php selected(get_option('fbss_setting_output_type'), 'html'); ?>>HTML</option>
										<option value="json" <?php selected(get_option('fbss_setting_output_type'), 'json'); ?>>JSON</option>
									</select>
						        	<p class="description"><?php _e('Defines the output data type of the shortcode', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="fbss_setting_cust_inline_css"><?php _e('Custom inline CSS', 'wp-fb-social-stream'); ?></label>
								</th>
						        <td>
						        	<textarea name="fbss_setting_cust_inline_css" id="fbss_setting_cust_inline_css" class="large-text code" rows="10"><?php esc_attr_e( get_option('fbss_setting_cust_inline_css') ); ?></textarea>
						        	<p class="description"><?php _e('Add your own custom CSS to your social stream', 'wp-fb-social-stream'); ?></p>
					        	</td>
							</tr>
						<tbody>
					</table>