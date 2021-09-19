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
	$now = new DateTime( "now", wp_timezone() );
	?>

	<main id="primary" class="site-main no-top-margin">

		<?php
		while ( have_posts() ):
			the_post();
			get_template_part( 'template-parts/content', 'live_event', array( 'banner' => $banner ? true : false ) );
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php if ( function_exists( 'rhd_related_posts' ) ) : ?>
		<div class="related related-live_events">
			<?php rhd_related_posts(
				get_the_id(),
				'film_event_category',
				'rand',
				null,
				4,
				__( 'Related Events', 'rhd' ),
				DAY_IN_SECONDS,
				array(
					'meta_query' => array(
						array(
							'key'     => 'last_showing_start',
							'value'   => $now->format( 'c' ),
							'compare' => '>',
						),
					),
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'meta_key' => 'start_date',
					'meta_type' => 'DATETIME',
				)
			);
			?>
		</div>
	<?php endif; ?>

<?php
get_sidebar();
get_footer();
