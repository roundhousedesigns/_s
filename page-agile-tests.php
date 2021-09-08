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
		<div class="entry-content">

			<?php
				while ( have_posts() ):
					the_post();
				endwhile; // End of the loop.

				$films = new Agile_Sync( 'films_test', 'film', 'https://prod5.agileticketing.net/websales/feed.ashx?guid=2b760ca4-a6e6-4217-ac05-0149aa8294f5&showslist=true&withmedia=true&format=json&v=latest&', true );
				// $films->print_items();

				// $events = new Agile_Sync( 'events_test', 'event', 'https://prod5.agileticketing.net/websales/feed.ashx?guid=95803ce7-2f6a-453a-907a-38e1e556264d&showslist=true&withmedia=true&format=xml&v=latest&', false );
				// $events->print_items();
			?>

		</div>
	</main><!-- #main -->

<?php
	get_sidebar();
get_footer();
