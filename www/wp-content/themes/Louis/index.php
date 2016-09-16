<?php
/**
 * Template name: Homepage
 *
 * The main template file.
 *
 * @package Louis
 */

get_header();

		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'inc/partials/content', 'home-posts' );

			endwhile;
			louis_pagination();

		else :
			get_template_part( 'inc/partials/content', 'none' );
		endif;
	
get_footer();