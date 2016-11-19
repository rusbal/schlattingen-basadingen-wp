					<h3><?php _e('Facebook options', 'wp-fb-social-stream'); ?></h3>
					<table class="form-table wp-fb-social-stream-customization-fb-options">
						<tbody>
				        	<tr>
				        		<th scope="row">
				        			<label for="fbss_setting_fb_page_name"><?php _e('Facebook Page ID', 'wp-fb-social-stream'); ?></label>
				        		</th>
				        		<td>
				        			<input type="text" name="fbss_setting_fb_page_name" id="fbss_setting_fb_page_name" value="<?php esc_attr_e( get_option('fbss_setting_fb_page_name') ); ?>" class="regular-text" />
				        			<p class="description"><?php _e('You can idintify the page-id as follows: https://www.facebook.com/{<strong>page-name</strong>}', 'wp-fb-social-stream'); ?>
				        				<a href="#" onclick="jQuery('#fbss-settings-options-fb-id').toggle('slow'); return false;"><?php _e('more', 'wp-fb-social-stream'); ?></a></p>
				        			<div id="fbss-settings-options-fb-id" style="display: none;">
				        				<p class="description"><?php printf( __('If you still have problems to identify your Facebook page-id have a look at the external online-service %s', 'wp-fb-social-stream'), '<a href="http://findmyfbid.com" target="_blank">findmyfbid.com</a>')?></p>
				        			</div>
				        		</td>
				        	</tr>
						<tbody>
					</table>