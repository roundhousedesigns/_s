<?php
/**
 * Template Name: Full Width
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main no-padding">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
