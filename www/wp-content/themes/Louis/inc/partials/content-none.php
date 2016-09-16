<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package louis
 */
?>

<div class="row">
		<div class="col-1-1"><div class="wrap-col test postcontent">
        
     
        <div id="content">

        
<p><?php esc_html_e( 'Nothing Found', 'louis' ); ?></p>
		<hr>
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'louis' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'louis' ); ?></p>
			<?php get_search_form(); ?>

		<?php
		else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'louis' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?></div>

</div>

	


</div>