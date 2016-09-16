<?php
/**
 * The template part for displaying a hero banner on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package louis
 */

$louis_display_hero_banner = get_theme_mod( 'louis_hero_show', 'yes' );
$louis_display_hero_button1 = get_theme_mod( 'louis_hero_button1_show', 'yes' );
$louis_display_hero_button2 = get_theme_mod( 'louis_hero_button2_show', 'yes' );

if ( $louis_display_hero_banner === 'yes' ) :
	?>

	<h2><?php echo esc_html( get_theme_mod( 'louis_hero_title' ) ); ?></h2>

	<?php

	echo '<p class="herotext">' . louis_esc_html( get_theme_mod( 'louis_hero_text' ) ) . '</p>';

	echo '<div class="herobuttons">';

	if ( $louis_display_hero_button1 === 'yes' ) {
		echo '<a href="' . esc_url( get_theme_mod( 'louis_hero_button1_link', '#' ) ) . '" class="button green large">' . esc_html( get_theme_mod( 'louis_hero_button1_text' ) ) . '</a>';
	}
	if ( $louis_display_hero_button2 === 'yes' ) {
		echo '<a href="' . esc_url( get_theme_mod( 'louis_hero_button2_link', '#' ) ) . '" class="button seethrough large">' . esc_html( get_theme_mod( 'louis_hero_button2_text' ) ) . '</a>';
	}
echo '</div>';
	?>

<?php endif;