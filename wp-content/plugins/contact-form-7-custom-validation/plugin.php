<?php
/**
   Plugin Name: Contact Form 7 Custom Validation
   Version: 1.0.0
   Author: Raymond Usbal
   Description: Custom Validations for Contact Form 7
        * Require at least one from a group of entry fields.
 */

require_once 'vendor/autoload.php';

function wpdocs_theme_name_scripts() {
    wp_register_style('contact-form-7-custom-validation', plugins_url('assets/styles/style.css',__FILE__ ));
    wp_enqueue_style('contact-form-7-custom-validation');

    wp_register_script('contact-form-7-custom-validation', plugins_url('assets/scripts/plugin.js',__FILE__ ), ['jquery'], false, true);
    wp_enqueue_script('contact-form-7-custom-validation');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
