<!doctype html>
<html lang="de">
<head>
<!--    <title>--><?php //bloginfo('name'); ?><!-- | --><?php //is_front_page() ? bloginfo('description') : wp_title('|', true, 'right'); ?><!--</title>-->
    <title>Langwiesen, Feuerthalen, Kanton Zürich: Wohneigentum direkt am Rhein in Stadtnähe vonSchaffhausen: Rhytreat. Lebensqualität und Panorama an privilegierter Lage</title>
    <meta charset="UTF-8">
    <meta name="description" content="Leben wie im Paradies in Langwiesen ZH: Rhytreat am Rhein." />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes,maximum-scale=2"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="keywords" content="immobilien, eigentumswohnung, eigentumswohnungen, haus kaufen, feuerthalen, schaffhausen, flurlingen, uhwiesen, dachsen, paradies, diessenhofen, wohnen am rhein, wohnung kaufen, leben am rhein, immobilienangebote, wohnungen, wohnimmobilien" />
    <meta name="revisit-after" content="7 days"/>
    <meta name="author" content="Rhytreat Langwiesen Feuerthalen c/o Maker GmbH, Neuhausen am Rheinfall" />
    <meta name="publisher" content="Maker GmbH, Neuhausen am Rheinfall" />
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
    <script type='text/javascript'>

        $(document).ready(function () {
            if (window.navigator.standalone == false) {
                window.scrollTo(0, 1);
            }

            // Responsive Imagemaps
            $('img[usemap]').rwdImageMaps();

            // Rollover Objekt-Box
            $('.objectSmall, .objectLarge, .objectXLarge, .objectTeam').mouseenter(function () {
                $(this).toggleClass('objectAktiv');
                // Bildgrösse Auslesen
                var width = $(this).find('.objectImage img').width();
                var height = $(this).find('.objectImage img').height();
                // Overlay resizen
                $(this).find('.objectText').css('width', width);
                // ein-/ausblenden
                if ($(this).find('.objectTextContent').text() != '') {
                    $(this).find('.objectText').stop().animate({
                            "height": height,
                            "width": width
                        },
                        450,
                        "swing"
                    );
                }
                ;

                // Textbox Höhe auslesen, einmitten
                var heightContent = $(this).find('.objectTextContent').height();
                var heightPadding = ((height - heightContent) / 2) - 15;
                $(this).find('.objectTextContent').css('margin-top', heightPadding);
            });

            $('.objectSmall, .objectLarge, .objectXLarge, .objectTeam').mouseleave(function () {
                $(this).toggleClass('objectAktiv');
                // Bildgrösse Auslesen
                var width = $(this).find('.objectImage img').width();
                var height = $(this).find('.objectImage img').height();
                // Overlay resizen
                $(this).find('.objectText').css('width', width);
                // ein-/ausblenden
                $(this).find('.objectText').stop().animate({
                        "height": 0,
                        "width": width
                    },
                    450,
                    "swing"
                );
            });
            // Link auf ganze Objekt-Box anwenden
            $('.objectSmall, .objectLarge, .objectXLarge, .objectTeam').click(function () {
                var url = $(this).find("a").attr('href');
                var textHeight = $(this).find('.objectText').height();
                if ($(this).find('.objectTextContent').text() != '') {
                    if (textHeight > 1) {
                        if ($(this).find("a").attr('target') == '_blank') {
                            window.open(url, '_blank');
                            return false;
                        } else {
                            window.open(url, '_self');
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    if ($(this).find("a").attr('target') == '_blank') {
                        window.open(url, '_blank');
                        return false;
                    } else {
                        window.open(url, '_self');
                        return false;
                    }
                }
            });
            // Preislisten Link auf tr anwenden
            $('.preisliste tr, .preislisteMobile tr').click(function () {
                var url = $(this).find("a").attr('href');
                if (url) {
                    window.open(url + '#view=fit', '_blank');
                    return false;
                }
            });

            // externe Links in _blank öffnen
            $('a').filter(function () {
                //Compare the anchor tag's host name with location's host name
                return this.hostname && this.hostname !== location.hostname;
            }).attr("target", "_blank");

            // externe Links in _blank öffnen
            $('a').filter(function () {
                //Compare the anchor tag's host name with location's host name
                return this.hostname && this.hostname !== location.hostname;
            }).attr("target", "_blank");

            // pdf in _blank öffnen
            $("a[href$='.pdf']").attr("target", "_blank");

            // flex Slider
            $('.flexslider').flexslider({
                animation: "slide",
                prevText: "Previous",
                nextText: "Next",
                pauseOnHover: true,
                touch: true,
                controlNav: false,
                directionNav: true
            });

            $("ul.galerie li:nth-child(5n)").addClass('element5');

            $("a.lightbox").fancybox({
                'titleShow': false,
                'scrolling': 'no',
                'overlayOpacity': 0.8,
                'overlayColor': '#000'
            });

            $("a.movie").fancybox({
                'titleShow': false,
                'scrolling': 'no',
                'overlayOpacity': 0.8,
                'overlayColor': '#000',
                'type': 'iframe',
                'width': 660,
                'height': 420,
                'margin': 0,
                'padding': 0
            });
        });


        $(window).resize(function () {

            // Overlay-Text Objektboxen in der Grösse anpassen an das Bild
            $(".objectSmall").each(function () {
                var widthSmall = $(this).find('.objectImage img').width();
                var heightSmall = $(this).find('.objectImage img').height();
                if ($(this).find('.objectText').height() > 1) {
                    $(this).find('.objectText').css('width', widthSmall).css('height', heightSmall);
                } else {
                    $(this).find('.objectText').css('width', widthSmall);
                }
            });

            $(".objectLarge").each(function () {
                var widthLarge = $(this).find('.objectImage img').width();
                var heightLarge = $(this).find('.objectImage img').height();
                if ($(this).find('.objectText').height() > 1) {
                    $(this).find('.objectText').css('width', widthLarge).css('height', heightLarge);
                } else {
                    $(this).find('.objectText').css('width', widthLarge);
                }
            });

            $(".objectXLarge").each(function () {
                var widthXLarge = $(this).find('.objectImage img').width();
                var heightXLarge = $(this).find('.objectImage img').height();
                if ($(this).find('.objectText').height() > 1) {
                    $(this).find('.objectText').css('width', widthXLarge).css('height', heightXLarge);
                } else {
                    $(this).find('.objectText').css('width', widthXLarge);
                }
            });

            $(".objectTeam").each(function () {
                var widthTeam = $(this).find('.objectImage img').width();
                var heightTeam = $(this).find('.objectImage img').height();
                if ($(this).find('.objectText').height() > 1) {
                    $(this).find('.objectText').css('width', widthTeam).css('height', heightTeam);
                } else {
                    $(this).find('.objectText').css('width', widthTeam);
                }
            });
        });
    </script>
</head>
<body>
<div id="outWrap">
    <div id="wrap">
        <section id="header">
            <div id="logo"><a href="/rhytreat">Rhytreat</a></div>
            <nav id="headerNav">
                <ul>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header-nav',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'menu_class' => false,
                    ));
                    ?>
                </ul>
            </nav><!-- #headerNav -->


            <!-- <nav id="mainNav">
                <ul>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-nav',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'menu_class' => false,
                    ));
                    ?>
                </ul>
            </nav> --><!-- #mainNav -->

            <div class="clear"></div>
        </section><!-- #header -->
        <div id="logoPrint"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/rhytreat_logo.png" width="107" height="84"
                                 alt="Rhytreat"></div>
        <?php
        while ( have_posts() ) : the_post();
        ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php //edit_post_link(__('Edit', 'twentyfifteen'), '<div><span class="edit-link">', '</span></div><!-- .entry-footer -->'); ?>
    <?php
    if (class_exists('Dynamic_Featured_Image')) {
        global $dynamic_featured_image;
        $featured_images = $dynamic_featured_image->get_featured_images();
        if ($featured_images) {
            ?>
            <section class="content slider">

                <div class="cycle">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach ($featured_images as $image) {
                                echo '<li><img src="' . $image['full'] . '" alt="" width="980" height="490"/></li>';
                            }
                            ?>
                        </ul>
                    </div><!-- .flexslider -->
                </div><!-- .cycle -->
            </section><!-- .content -->
            <?php
        }
    }
    ?>
    <section class="content noline">
            <?php the_title('<h1>', '</h1>'); ?>
    </section>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfifteen') . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '<span class="screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>%',
            'separator' => '<span class="screen-reader-text">, </span>',
        ));
        ?>
    </div><!-- .entry-content -->

        </div><!-- #post-## -->
<?php
endwhile;

get_footer();
