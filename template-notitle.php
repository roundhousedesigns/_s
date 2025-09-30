<?php
/**
 * Template Name: No Title
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-notitle' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
