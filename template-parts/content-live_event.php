<?php
/**
 * Template part for displaying page content in page.php
 *
 * @uses $args[]
 *
 * @package RHD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$title_classes = array( 'entry-title' );
		if ( isset( $args['banner'] ) && true === $args['banner'] ) {
			$title_classes[] = 'screen-reader-text'; // Visually hide the title if a banner image is present (contains title).
		}
		the_title( '<h1 class="' . implode( ' ', $title_classes ) . '">', '</h1>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<section class="synopsis">
			<h3 class="single-item-heading"><?php esc_html_e( 'Synopsis', 'rhd' ); ?></h3>
			<?php the_content(); ?>
		</section>

		<div class="additional-info">
			<h3 class="single-item-heading"><?php esc_html_e( 'Additional Information', 'rhd' ); ?></h3>
			<?php
			rhd_film_event_meta(
				get_the_id(),
				array(
					'release_year'       => esc_html__( 'Release Year', 'rhd' ),
					'duration'           => esc_html__( 'Run Time', 'rhd' ),
					'rating'             => esc_html__( 'Rating', 'rhd' ),
					'language'           => esc_html__( 'Language', 'rhd' ),
					'production_country' => esc_html__( 'Country', 'rhd' ),
				)
			);
			?>
		</div>

		<div class="social">
			<h3 class="single-item-heading"><?php esc_html_e( 'Connect', 'rhd' ); ?></h3>
			<?php
			rhd_film_event_meta_link(
				get_the_id(),
				array(
					'website'  => esc_html__( 'Website', 'rhd' ),
					'facebook' => esc_html__( 'Facebook', 'rhd' ),
					'twitter'  => esc_html__( 'Twitter', 'rhd' ),
				)
			);
			?>
		</div>

		<div class="sponsors">
			<h3 class="single-item-heading"><?php esc_html_e( 'Sponsor', 'rhd' ); ?></h3>
			<?php rhd_film_event_sponsor(); ?>
		</div>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">

			<?php rhd_taxonomy_badges(); ?>

			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'rhd' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
