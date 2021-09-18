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
	$today = new DateTime( "now", wp_timezone() );
	$today->setTime( 23, 59, 59 );
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
				DAY_IN_SECONDS,
				array(
					'meta_query' => array(
						array(
							'key'     => 'end_date',
							'value'   => $today->format( 'Y-m-d' ),
							'compare' => '>=',
						),
					)
				)
			);
			?>
		</div>
	<?php endif; ?>

<?php
get_sidebar();
get_footer();
