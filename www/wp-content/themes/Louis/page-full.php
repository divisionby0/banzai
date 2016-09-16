<?php
/**
 * Template Name: Full Page template
 *
 * @package louis
 */
 

get_header('');
?>
<div class="insideposts">

<div class="wrapper">
<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'inc/partials/content', 'page-full' );
				endwhile;
			?>

</div>
<?php get_footer();