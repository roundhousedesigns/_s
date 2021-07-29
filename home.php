<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'card' );
		endwhile; // End of the loop.

		the_posts_pagination([
			'prev_text' => __( 'Older', 'rhd' ),
			'next_text' => __( 'Newer', 'rhd' ),
		]);
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
