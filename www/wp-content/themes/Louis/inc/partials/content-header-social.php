<?php
/**
 * The template part for displaying social links on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package louis
 */

$louis_display_social_links = get_theme_mod( 'louis_header_social_show', 'yes' );

if ( $louis_display_social_links === 'yes' ) :
	$louis_facebook_url = get_theme_mod( 'louis_header_social_facebook' );
	$louis_twitter_url = get_theme_mod( 'louis_header_social_twitter' );
	$louis_pinterest_url = get_theme_mod( 'louis_header_social_pinterest' );
	$louis_linkedin_url = get_theme_mod( 'louis_header_social_linkedin' );
	$louis_gplus_url = get_theme_mod( 'louis_header_social_gplus' );
	$louis_behance_url = get_theme_mod( 'louis_header_social_behance' );
	$louis_dribbble_url = get_theme_mod( 'louis_header_social_dribbble' );
	$louis_flickr_url = get_theme_mod( 'louis_header_social_flickr' );
	$louis_500px_url = get_theme_mod( 'louis_header_social_500px' );
	$louis_reddit_url = get_theme_mod( 'louis_header_social_reddit' );
	$louis_wordpress_url = get_theme_mod( 'louis_header_social_wordpress' );
	$louis_youtube_url = get_theme_mod( 'louis_header_social_youtube' );
	$louis_soundcloud_url = get_theme_mod( 'louis_header_social_soundcloud' );
	$louis_medium_url = get_theme_mod( 'louis_header_social_medium' );

	?>

		<ul class="socialmediamenu">
		<?php
		if ( !empty( $louis_facebook_url ) ) {
			echo '<li class="facebook"><a href="' . esc_url( $louis_facebook_url ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( !empty( $louis_twitter_url ) ) {
			echo '<li class="twitter"><a href="' . esc_url( $louis_twitter_url ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( !empty( $louis_pinterest_url ) ) {
			echo '<li class="pinterest"><a href="' . esc_url( $louis_pinterest_url ) . '"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( !empty( $louis_linkedin_url ) ) {
			echo '<li class="linkedin"><a href="' . esc_url( $louis_linkedin_url ) . '"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( !empty( $louis_gplus_url ) ) {
			echo '<li class="gplus"><a href="' . esc_url( $louis_gplus_url ) . '"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( !empty( $louis_behance_url ) ) {
			echo '<li class="behance"><a href="' . esc_url( $louis_behance_url ) . '"><i class="fa fa-behance"></i></a></li>';
		}
		if ( !empty( $louis_dribbble_url ) ) {
			echo '<li class="dribbble"><a href="' . esc_url( $louis_dribbble_url ) . '"><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( !empty( $louis_flickr_url ) ) {
			echo '<li class="flickr"><a href="' . esc_url( $louis_flickr_url ) . '"><i class="fa fa-flickr"></i></a></li>';
		}
		if ( !empty( $louis_500px_url ) ) {
			echo '<li class="social500px"><a href="' . esc_url( $louis_500px_url ) . '"><i class="fa fa-500px"></i></a></li>';
		}
		if ( !empty( $louis_reddit_url ) ) {
			echo '<li class="reddit"><a href="' . esc_url( $louis_reddit_url ) . '"><i class="fa fa-reddit"></i></a></li>';
		}
		if ( !empty( $louis_wordpress_url ) ) {
			echo '<li class="wordpress"><a href="' . esc_url( $louis_wordpress_url ) . '"><i class="fa fa-wordpress"></i></a></li>';
		}
		if ( !empty( $louis_youtube_url ) ) {
			echo '<li class="youtube"><a href="' . esc_url( $louis_youtube_url ) . '"><i class="fa fa-youtube"></i></a></li>';
		}
		if ( !empty( $louis_soundcloud_url ) ) {
			echo '<li class="soundcloud"><a href="' . esc_url( $louis_soundcloud_url ) . '"><i class="fa fa-soundcloud"></i></a></li>';
		}
		if ( !empty( $louis_medium_url ) ) {
			echo '<li class="medium"><a href="' . esc_url( $louis_medium_url ) . '"><i class="fa fa-medium"></i></a></li>';
		}
		?>
	</ul>

<?php endif;