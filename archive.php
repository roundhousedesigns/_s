<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main archive-grid">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="rhd-post-items-container grid">
				<div class="rhd-post-items">

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						$taxonomy = in_array( get_post_type(), array( 'film', 'live_event' ), true ) ? 'film_event_category' : null;

						echo wp_kses_post( RHD_Base::item_template__post( get_post_type(), $taxonomy, false ) );
					endwhile;
					?>
				</div>

				<?php
				the_posts_navigation(array(
					'next_text' => sprintf(
						'&laquo; %1$s',
						esc_html__( 'Show Earlier', 'rhd' ),
						get_post_type_object( get_post_type() )->labels->name,
					),
					'prev_text' => sprintf(
						'%1$s &raquo;',
						esc_html__( 'Show More', 'rhd' ),
					)
				));
				?>
			</div>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
