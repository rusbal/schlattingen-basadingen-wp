<!doctype html>
<html lang="de">
<head>
  <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title('|', true, 'right'); ?></title>

  <?php wp_head(); ?>

  <?php include "header.meta.html"; ?>
  <?php include "html5shiv.html"; ?>
  <?php include "link.icons.html"; ?>
  <?php include "header.mailchimp-tracking.html"; ?>
<?php include "analyticstracking.php"; ?>
</head>
<body>
<div id="outWrap">
    <div id="wrap">
        <section id="header">
            <div id="logo"><a href="/einfamilienhaus">Rhytreat</a></div>
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
        <div id="logoPrint">
            <!--<img src="<?php bloginfo('stylesheet_directory'); ?>/img/rhytreat_logo.png" width="107" height="84" alt="Rhytreat">-->
        </div>
