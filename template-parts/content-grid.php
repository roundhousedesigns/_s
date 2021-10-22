<?php
/**
 * Template part for displaying post grid items.
 *
 * @package RHD
 */

?>

<div class="post-<?php the_ID(); ?> post-grid__item">
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<figure class="post-thumbnail">
			<div class="image">
				<?php the_post_thumbnail( 'grid', array( 'alt' => get_the_title() ) ); ?>
			</div>
			<figcaption>
				<?php the_title( '<h2 class="entry-title project-title">', '</h2>' ); ?>
				<?php the_excerpt(); ?>
			</figcaption>
		</figure>
	</a>
</div>
