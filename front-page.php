<?php
/**
 * The template for displaying the home page.
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main no-top-margin">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page__notitle' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
