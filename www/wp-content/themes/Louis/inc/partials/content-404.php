<?php
/**
 * @package louis
 */
?>
<div class="row">
		<div class="col-2-3"><div id="content" class="wrap-col test postcontent">
       <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'louis-frontpage-blog' ); ?></a>
        


<h1 class="postcontenttitle"><?php esc_html_e( 'Page Not Found', 'louis' ); ?></h1>
        
<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'louis' ); ?></p>
	<br/>
		<?php get_search_form(); ?>
		
<br/>
		<?php if ( louis_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

			<h2><?php esc_html_e( 'Most Used Categories', 'louis' ); ?></h2>
			<ul>
				<?php
				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );
				?>
			</ul>

		<?php endif; ?>

		<?php
		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'louis' ), convert_smilies( ':)' ) ) . '</p>';
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
		?>
        <br />

		<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

</div></div>


