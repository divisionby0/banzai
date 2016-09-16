<?php
/**
 * @package louis
 */
?>

<div class="row">
		<div class="col-2-3"><div class="wrap-col test postcontent">
        
    <?php the_post_thumbnail( 'louis-full' ); ?>
        <div id="content">


<h1 class="postcontenttitle"><?php the_title() ?></h1>
<div class="authormeta">От:  <?php the_author_posts_link(); ?> </div>
        
<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'louis' ),
			'after'  => '</div>',
		) );
		
		edit_post_link( __( 'Edit', 'louis' ), '<span class="edit-link">', '</span>' );
		?>
        <br>
</div>
<?php comments_template(); ?>
</div>

</div>

