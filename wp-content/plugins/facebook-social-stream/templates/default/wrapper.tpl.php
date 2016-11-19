<?php
/**
 * Do not change this default template!
 *
 * 	You can create your own template in
 * 	templates/{your-template-name}/wrapper.tpl.php
 */
?>

<!-- .wp-fb-social-stream -->
<div class="wp-fb-social-stream">
	<?php if ( isset($view_data['extensions']['fbss-extension-pagination']) ) : ?>
		<?php echo FBSS_Extension_Pagination::getPaginationHTML('top'); ?>
	<?php endif; ?>

	<?php echo $view_data['social_stream_html']; // output of message.tpl.php ?>
	
	<?php if ( isset($view_data['extensions']['fbss-extension-pagination']) ) : ?>
		<?php echo FBSS_Extension_Pagination::getPaginationHTML('bottom'); ?>
	<?php endif; ?>
</div>
<!-- /.wp-fb-social-stream -->
