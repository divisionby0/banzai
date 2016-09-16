<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package louis
 */

get_header('archives');
?>
<div id="blogposts">

<div class="wrapper">

<div class="row">
<?php
while ( have_posts() ) :
the_post();
?>

<?php get_template_part( 'inc/partials/content', '' ); ?>

<?php endwhile; ?>
</div><!-- end row -->

 
 
<?php louis_pagination(); ?>

</div><!-- End Wrapper -->
</div><!-- End Wrapper -->


</div><!-- End blogposts -->



<?php get_footer();