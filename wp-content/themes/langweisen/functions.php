<?php

/**
 * Created by PhpStorm.
 * User: mizhgun
 * Date: 18.01.2016
 * Time: 14:39
 */

function langweisen_scripts() {
    $template_dir = get_template_directory_uri();
    wp_enqueue_style('style', $template_dir . '/css/style.css', array(), '5.6', 'screen');
    wp_enqueue_style('print', $template_dir . '/css/print.css', array(), false, 'print');
    wp_enqueue_style('flexslider', $template_dir . '/js/flexSlider/flexslider.css');
    wp_enqueue_style('fancybox', $template_dir . '/js/fancybox/jquery.fancybox-1.3.1.css');
    wp_enqueue_script('jquery-js', $template_dir . '/js/jquery-1.8.3.min.js');
    wp_enqueue_script('flexislider', $template_dir . '/js/flexSlider/jquery.flexslider-min.js');
    wp_enqueue_script('jqueryui', $template_dir . '/js/jquery-ui-1.10.3.custom.min.js');
    wp_enqueue_script('smoothscroll', $template_dir . '/js/smoothscroll.js');
    wp_enqueue_script('jquery-rwdimmap', $template_dir . '/js/jquery.rwdImageMaps.min.js');
    wp_enqueue_script('jquery-fancybox', $template_dir . '/js/fancybox/jquery.fancybox-1.3.1.pack.js');
    //wp_enqueue_script('facebook-stream-fix', $template_dir . '/js/facebook-stream-fix.js', array(), '1', true);
}

add_action( 'wp_enqueue_scripts', 'langweisen_scripts' );

function langweisen_shortcode_article($attrs, $content=null) {
    return '<article class="zweispalten">' . $content . '</article>';
}

function langweisen_shortcode_sections($attrs, $content=null) {
    $c = do_shortcode($content);
    return <<<LAYOUT
<script type='text/javascript'>
$(document).ready(function(){

	// Accordion
	$('.accordion').accordion({
		active: true,		header: ".newsHeader",
		collapsible: true,
		heightStyle: "content",
		navigation: true,
		activate: function( event, ui ) {
			// Responsive Imagemaps
			$('img[usemap]').rwdImageMaps();
			// zum Header scrollen
			var topAnchor = $(this).offset().top;
			$('html,body').animate({scrollTop: topAnchor}, 250);
						return false;
		}
	});

            function open_cf() {
                if (location.hash.slice(1) == 'kontakt') {
                    $('.accordion').accordion('option', 'active', 5);
                }
            }

            $(window).on('hashchange', open_cf);

            open_cf();


});
</script>
<section class="content accordion projektaccordion mehrRight">{$c}</section>
LAYOUT;



}

function langweisen_shortcode_section($attrs, $content=null) {
    extract(shortcode_atts(array(
        'title' => '',
        'more_label' => 'mehr erfahren',
        'class' => ''
    ), $attrs));
    if ($class) $class = ' class="' . $class . '""';
    $c = do_shortcode($content);
    return <<<LAYOUT
    <article>
			<div class="newsHeader">
				<h1$class>{$title}</h1>
				<div class="erfahren">{$more_label}</div>
			</div>
			<div class="newsContent">
			{$c}
			<p style="clear:both;">&nbsp;</p>
			</div>
	</article>
LAYOUT;

}

function langweisen_remove_br($content) {
    return preg_replace('/\[\/article\]\s*<br\s*\/>/', '[/article]', $content);
}

function langweisen_iframe($attrs, $content=null) {
    extract(shortcode_atts(array(
            'src' => '',
            'width' => '600',
            'height' => '450'
        ), $attrs));
    return <<<LAYOUT
<iframe src="{$src}" width="{$width}" height="{$height}" frameborder="0" style="border:0" allowfullscreen></iframe>
LAYOUT;

}

add_shortcode('article', 'langweisen_shortcode_article');
add_shortcode('section', 'langweisen_shortcode_section');
add_shortcode('sections', 'langweisen_shortcode_sections');
add_shortcode('iframe', 'langweisen_iframe');
add_filter('the_content', 'langweisen_remove_br');


register_nav_menus(
        array(
            'header-nav' => __('Header Menu'),
            'main-nav' => __('Main Menu')
        )
);
