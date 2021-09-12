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

	<?php if ( function_exists( 'rhd_related_posts' ) ) : ?>
		<div class="related related-films">
			<?php rhd_related_posts(
				get_the_id(),
				'film_genre',
				'rand',
				null,
				4,
				__( 'Related Films', 'rhd' ),
				DAY_IN_SECONDS
			);
			?>
		</div>
	<?php endif; ?>

<?php
get_sidebar();
get_footer();
