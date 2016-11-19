<?php
/**
 * Author: mizhgun@gmail.com
 * Date: 19.01.16
 * Time: 14:11
 */

get_header();
// Start the loop.
while ( have_posts() ) : the_post();

	// Include the page content template.
	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

// End the loop.
endwhile;
get_footer();

?>
