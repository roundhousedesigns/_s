<?php
/**
 * Template to list all posts without featured images.
 */

get_header();
?>

	<main id="primary" class="site-main">
		<h2>Development Only: Posts and Mentions/Links with no thumbnails</h2>
		<?php

		$q = new WP_Query(array(
			'post_type' => ['post','mention'],
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => 'NOT EXISTS'
				),
			),
		));
		?>

		<ul>
			<?php
			while ( $q->have_posts() ) :
				$q->the_post();
				printf( '<li><a href="%s" target="_blank">%s</a></li>', get_edit_post_link( get_the_id() ), get_the_title() );
			endwhile; // End of the loop.
			wp_reset_postdata();
			?>
		</ul>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
