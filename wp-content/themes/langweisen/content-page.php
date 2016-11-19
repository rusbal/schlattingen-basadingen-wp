<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
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
