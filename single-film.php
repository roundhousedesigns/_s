<?php
/**
 * The template for displaying all single `film` posts
 *
 * @package RHD
 */

get_header();
?>

	
	<?php
	echo $banner = rhd_single_banner_image();
	?>

	<main id="primary" class="site-main no-top-margin">

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'film', array( 'banner' => $banner ? true : false ) );
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
