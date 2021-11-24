<?php
/**
 * The template for displaying all single posts
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( '&larr; Previous Post', 'rhd' ) . '</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Post &rarr;', 'rhd' ) . '</span>',
				)
			);

			if (function_exists( 'rhdwp_related_posts' ) ) {
				rhdwp_related_posts( 'rand', null, 4, 'Suggested Articles', WEEK_IN_SECONDS, 'thumbnail' );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
