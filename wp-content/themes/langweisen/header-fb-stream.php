<?php
/**
 * Header:
 *   header-fb-stream.php
 */

use Rsu\Settings\Option;

?><!doctype html>
<html>
<head>
  <title>Langwiesen Eigentumswohnung kaufen | 4,5 Zimmer-Eigentumswohnungen kaufen am Rhein</title>

  <?php wp_head(); ?>

  <?php include "header.meta.html"; ?>
  <?php include "html5shiv.html"; ?>
  <?php include "link.icons.html"; ?>
  <?php include "header.mailchimp-tracking.html"; ?>
<style>
.content-fb-stream {
    background: #fff;
    max-width: 960px;
    margin: 0 auto;
}
.post-inner {
    margin: 0 auto;
    /* max-width: 85%; */
    /* padding-bottom: 7.5%; */
    padding: 0;
}
.post-content {
    color: #333;
}
/** Plugin CSS override */
.fb-info {
    display: none;
}
.fb-message {
    margin: 0 !important;
}
.fb-message-spacer {
    margin: 0 0 25px auto !important;
    width: 100% !important;
}
</style>
<?php include "analyticstracking.php"; ?>
</head>
<body> 
<div class="content-fb-stream">
    <div id="banner">
        <a href="/einfamilienhaus"><?= Option::get_image('header_banner', 'head-banner') ?></a>
    </div>
