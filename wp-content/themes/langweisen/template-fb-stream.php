<?php
/**
 * Template Name: FB Stream
 */

get_header('fb-stream');
the_post();

?>
<div class="post-inner">
    <div class="post-content"><?php the_content(); ?></div>
</div>
<?php get_footer('fb-stream');
