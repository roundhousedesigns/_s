<?php
/**
 * Template part for displaying posts
 *
 * @package RHD
 */

$thumb = get_the_post_thumbnail_url( get_the_id(), 'portrait' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</header><!-- .entry-header -->

	<?php if ( $thumb ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'portrait' ); ?>
		</div>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
