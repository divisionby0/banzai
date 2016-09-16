<?php
/**
 * louis Theme Customizer
 *
 * @package louis
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function louis_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	function louis_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function louis_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'louis_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function louis_customize_preview_js()
{
	wp_enqueue_script( 'louis_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130515', true );
}

add_action( 'customize_preview_init', 'louis_customize_preview_js' );

function louis_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function louis_sanitize_int( $value )
{
	return (int)$value;
}

function louis_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'louis_homepage', array(
		'title'    => __( 'Homepage Setup', 'louis' ),
		'priority' => 10,
	) );

	$wp_customize->add_panel( 'louis_site_identity', array(
		'title'    => __( 'Site Identity', 'louis' ),
		'priority' => 10,
	) );

	// move "site identity" to a panel first
	$wp_customize->add_section( 'title_tagline', array(
		'title'    => __( 'Title and Tagline', 'louis' ),
		'priority' => 50,
		'panel'    => 'louis_site_identity',
	) );

	// header logo
	$wp_customize->add_section( 'louis_header_logo', array(
		'title'    => __( 'Header logo', 'louis' ),
		'priority' => 50,
		'panel'    => 'louis_site_identity',
	) );

	$wp_customize->add_setting( 'louis_header_logo_show', array(
		'default'           => 'logo',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_header_logo_show', array(
		'label'    => __( 'Show header logo or text', 'louis' ),
		'section'  => 'louis_header_logo',
		'settings' => 'louis_header_logo_show',
		'type'     => 'select',
		'choices'  => array( 'logo' => __( 'Logo', 'louis' ), 'text' => __( 'Text', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_header_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'louis_header_logo_image', array(
		'label'    => __( 'Header logo image', 'louis' ),
		'section'  => 'louis_header_logo',
		'settings' => 'louis_header_logo_image',
	) ) );
	// end header logo

	// hero banner
	$wp_customize->add_section( 'louis_hero', array(
		'title'       => __( 'Hero Banner', 'louis' ),
		'priority'    => 50,
		'description' => __( 'Big banner section on the front page - background image', 'louis' ),
		'panel'       => 'louis_homepage',
	) );



	$wp_customize->add_setting( 'louis_hero_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/header.jpg',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'louis_hero_bg_image', array(
		'label'    => __( 'Background image', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_bg_image',
	) ) );

	$wp_customize->add_setting( 'louis_hero_title', array(
		'default'           => __( 'LOUIS WORDPRESS THEME', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_hero_title', array(
		'label'   => __( 'Title', 'louis' ),
		'section' => 'louis_hero',
	) );

	$wp_customize->add_setting( 'louis_hero_text', array(
		'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor leo eu magna varius accumsan. Aliquam in dapibus massa, eget vestibulum turpis. <a href="#">Aliquam erat volutpat</a>. Pellentesque rhoncus pretium turpis faucibus placerat. Suspendisse eu sem quis enim posuere tristique.
<a href="#" class="button green large">About us</a>
<a href="#" class="button seethrough large">Contact us</a>',
		'sanitize_callback' => 'louis_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_text', array(
		'label'    => __( 'Main text', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_text',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'louis_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_hero_button1_show', array(
		'label'    => __( 'Show button 1', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'louis' ), 'no' => __( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_hero_button1_text', array(
		'default'           => __( 'About us', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button1_text', array(
		'label'    => __( 'Button 1 text', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button1_link', array(
		'label'    => __( 'Button 1 link', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_hero_button2_show', array(
		'label'    => __( 'Show button 2', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'louis' ), 'no' => __( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_hero_button2_text', array(
		'default'           => __( 'Contact', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button2_text', array(
		'label'    => __( 'Button 2 text', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button2_link', array(
		'label'    => __( 'Button 2 link', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button2_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_blur_enabled', array(
		'default'           => 0,
		'sanitize_callback' => 'louis_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_blur_enabled', array(
		'label'    => __( 'Blur amount (pixels)', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_blur_enabled',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_overlay_enabled', array(
		'default'           => 'no',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_hero_overlay_enabled', array(
		'label'    => __( 'Overlay the image with color', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_overlay_enabled',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'louis' ), 'no' => __( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_hero_overlay_color', array(
		'default'           => '#1f242d',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'louis_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_overlay', array(
		'label'    => __( 'Hero image overlay color', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_overlay_color',
	) ) );


	$wp_customize->add_setting( 'louis_hero_overlay_opacity', array(
		'default'           => '90',
		'sanitize_callback' => 'louis_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_overlay_opacity', array(
		'label'    => __( 'Overlay opacity (between 0 and 100)', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_overlay_opacity',
		'type'     => 'text',
	) );

	// end hero banner

	// social
	$wp_customize->add_section( 'louis_header_social', array(
		'title'    => __( 'Social', 'louis' ),
		'priority' => 50,
		'panel'    => 'louis_homepage',
	) );
	$wp_customize->add_setting( 'louis_header_social_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_header_social_show', array(
		'label'    => __( 'Show social icons below the hero banner text', 'louis' ),
		'section'  => 'louis_header_social',
		'settings' => 'louis_header_social_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'louis' ), 'no' => __( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_header_social_twitter', array(
		'default'           => __( 'http://twitter.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_twitter', array(
		'label'   => __( 'Twitter URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_facebook', array(
		'default'           => __( 'http://facebook.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_facebook', array(
		'label'   => __( 'Facebook URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_pinterest', array(
		'default'           => __( 'http://pinterest.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_pinterest', array(
		'label'   => __( 'Pinterest URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_linkedin', array(
		'default'           => __( 'http://linkedin.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_linkedin', array(
		'label'   => __( 'LinkedIn URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_gplus', array(
		'default'           => __( 'http://plus.google.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_gplus', array(
		'label'   => __( 'Google+ URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_behance', array(
		'default'           => __( 'http://behance.net', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_behance', array(
		'label'   => __( 'Behance URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_dribbble', array(
		'default'           => __( 'http://dribbble.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_dribbble', array(
		'default'           => __( 'http://dribbble.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_flickr', array(
		'default'           => __( 'http://flickr.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_flickr', array(
		'label'   => __( 'Flickr URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_500px', array(
		'default'           => __( 'http://500px.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_500px', array(
		'label'   => __( '500px URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_reddit', array(
		'default'           => __( 'http://reddit.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_reddit', array(
		'label'   => __( 'Reddit URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_wordpress', array(
		'default'           => __( 'http://wordpress.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_wordpress', array(
		'label'   => __( 'Wordpress URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_youtube', array(
		'default'           => __( 'http://youtube.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_youtube', array(
		'label'   => __( 'Youtube URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_soundcloud', array(
		'default'           => __( 'http://soundcloud.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_soundcloud', array(
		'label'   => __( 'Soundcloud URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_medium', array(
		'default'           => __( 'http://medium.com', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_medium', array(
		'label'   => __( 'Medium URL', 'louis' ),
		'section' => 'louis_header_social',
	) );
	// end social

	// footer logo
	$wp_customize->add_section( 'louis_footer_logo', array(
		'title'    => __( 'Footer logo', 'louis' ),
		'priority' => 50,
		'panel'    => 'louis_site_identity',
	) );

	$wp_customize->add_setting( 'louis_footer_logo_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_footer_logo_show', array(
		'label'    => __( 'Show footer logo', 'louis' ),
		'section'  => 'louis_footer_logo',
		'settings' => 'louis_footer_logo_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'louis' ), 'no' => __( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_footer_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo-footer.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'louis_footer_logo_image', array(
		'label'    => __( 'Footer logo image', 'louis' ),
		'section'  => 'louis_footer_logo',
		'settings' => 'louis_footer_logo_image',
	) ) );
	// end footer logo

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'louis_google_fonts', array(
		'title'    => __( 'Fonts', 'louis' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'louis_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'louis' ),
		'section'  => 'louis_google_fonts',
		'settings' => 'louis_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'louis_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'louis' ),
		'section'  => 'louis_google_fonts',
		'settings' => 'louis_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors

	$wp_customize->add_setting( 'louis_accent_color', array(
		'default'           => '#0ea6f2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'louis_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => __( 'Accent color', 'louis' ),
		'section'  => 'colors',
		'settings' => 'louis_accent_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'louis_customizer', 11 );