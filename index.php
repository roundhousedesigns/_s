<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHD
 */

get_header();
use RHD\StateTheatre\AgileFeed;
?>

	<main id="primary" class="site-main">
		
		<?php
		$url = 'https://prod5.agileticketing.net/websales/feed.ashx?guid=95803ce7-2f6a-453a-907a-38e1e556264d&showslist=true&withmedia=true&format=xml&v=latest&';
		$feed = new AgileFeed('test', $url, true );
		$data = $feed->get_json_data();
		printf( '<pre style="color: black;">%s</pre>', print_r( $data, true ) );
		?>


		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
