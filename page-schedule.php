<?php
/**
 * The template for displaying the Schedule page.
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main no-margin-top">

		<header class="page-header heading-special default-max-width">
			<?php the_title( '<h1 class="page-title">', '</h1>' );?>
		</header><!-- .page-header -->

		<div class="rhd-post-items-container grid">
			<div class="rhd-post-items">

				<?php
				/* Start the Loop */
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$q     = new WP_Query(
					array(
						'post_type'      => array( 'film', 'live_event' ),
						'posts_per_page' => 24,
						'paged'          => $paged,
						'post_status'    => 'publish',
						'order'          => 'ASC',
						'orderby'        => 'meta_value',
						'meta_key'       => 'start_date',
						'meta_type'      => 'DATETIME',
					)
				);

				if ( $q->have_posts() ):
					while ( $q->have_posts() ):
						$q->the_post();

						echo wp_kses_post( RHD_Base::item_template__post( get_post_type(), 'film_event_category', false ) );
					endwhile;
				endif;
			?>
			</div>

			<nav class="posts-navigation custom">
				<div class="nav-links">
					<?php
					echo paginate_links(
						array(
							'current'   => $paged,
							'total'     => $q->max_num_pages,
							'prev_text' => sprintf(
								'&laquo; %1$s',
								esc_html__( 'Show Earlier', 'rhd' ),
								get_post_type_object( get_post_type() )->labels->name,
							),
							'next_text' => sprintf(
								'%1$s &raquo;',
								esc_html__( 'Show More', 'rhd' ),
							),
						)
					);
					?>
				</div>
			</nav>

			<?php wp_reset_postdata(); ?>

		</div>

	</main><!-- #main -->

<?php
	// get_sidebar();
get_footer();
