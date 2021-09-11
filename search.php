<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main archive-grid">

		<?php if ( have_posts() ) : ?>

			<header class="page-header default-max-width">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'rhd' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="rhd-post-items-container grid">
				<div class="rhd-post-items">

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						echo wp_kses_post( RHD_Base::item_template__default() );
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
