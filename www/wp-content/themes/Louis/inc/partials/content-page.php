<?php
/**
 * @package louis
 */
?>
<div class="row">
		<div class="col-2-3"><div class="wrap-col test postcontent">
        
       <?php the_post_thumbnail( 'louis-frontpage-blog' ); ?>
        <div id="content">


<h1 class="postcontenttitle"><?php the_title() ?></h1>
        
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

</div>

	


</div>

