<?php
/**
 * @Theme: louis
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	<!--[if lt IE 9]>
	<script type="text/javascript">
		document.createElement("header");
		document.createElement("nav");
		document.createElement("section");
		document.createElement("article");
		document.createElement("aside");
		document.createElement("footer");
	</script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>
<header class="clearfix">
  
  <div class="wrapper">
  
    <div id="site-branding">

      
        <a href="<?php echo esc_url( home_url() ); ?>" rel="home">
					<?php
					$louis_display_header_logo = get_theme_mod( 'louis_header_logo_show', 'text' );
					if ( $louis_display_header_logo === 'logo' ) {
						echo '<img src="' . esc_url( get_theme_mod( 'louis_header_logo_image' ) ) . '" alt="logo">';
						echo '<h1 class="site-title" style="display: none;">' . esc_html( get_theme_mod( 'louis_header_logo_text' ) ) . '</h1>';
					} else {
						$louis_site_title = esc_html( get_theme_mod( 'blogname', get_bloginfo( 'name' ) ) );
						$louis_tagline = esc_html( get_theme_mod( 'blogdescription', get_bloginfo( 'description' ) ) );
						echo '<img style="display: none;" src="' . esc_url( get_theme_mod( 'louis_header_logo_image' ) ) . '" />';
						echo '<h1 class="site-title">' . $louis_site_title . '' . ( $louis_tagline ? '</h1> ' . '<span class="site-description">' . $louis_tagline . '</span>' : '' ) . '</h1>';
					}
					?>

				</a>
        
  
    </div>
    
<nav>
				<div id="cssmenu">
					<?php
					global $wp_customize;
					if ( !empty( $wp_customize ) && $wp_customize->is_preview() && !get_theme_mod( 'louis_content_set', false ) ) {
						?>
						<ul>
							<li id="menu-item-16"
								class="menu-item">
								<a href="#">Главная</a></li>
							<li id="menu-item-17"
								class="menu-item">
								<a href="#">Pricing</a></li>
							<li id="menu-item-21"
								class="menu-item">
								<a href="#">Blog</a></li>
							<li id="menu-item-22"
								class="menu-item">
								<a href="#">Contact</a></li>
							<li id="menu-item-23"
								class="menu-item">
								<a href="#">Members</a></li>
							<li id="menu-item-24"
								class="menu-item">
								<a href="#">Signup</a></li>
						</ul>
					<?php
					} else {
						wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'      => false,
								'items_wrap'     => '<ul>%3$s</ul>',
								'depth'          => 0,
								'fallback_cb'    => 'louis_fallback_menu',
							)
						);
					}
					?>
				</div>
			</nav>
    
   </div><!-- End Wrapper --> 

</header>





<div id="hero">
	<div class="hero-bg"></div>
	<?php
	$louis_hero_overlay_enabled = get_theme_mod( 'louis_hero_overlay_enabled', 'no' );
	$hidden = '';
	if ( $louis_hero_overlay_enabled === 'no' ) {
		$hidden = 'hidden';
	}
	echo '<div class="hero-overlay ' . $hidden . '"></div>';
	?>

	<div class="wrapper">

			<h2><?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'louis' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'louis' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'louis' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'louis' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'louis' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'louis' ) ) . '</span>' );
						else :
							_e( 'Archives', 'louis' );

						endif;
						?></h2>
	<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( !empty( $term_description ) ) :
						printf( '<p class="herotext"%s</p>', $term_description );
					endif;
					?>
  </div><!-- End Wrapper --> 
</div><!-- End Hero --> 