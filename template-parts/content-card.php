<?php
/**
 * Template part for displaying card-style posts with excerpts
 *
 * @package RHD
 */
?>

<article id="post-<?php the_ID();?>"<?php post_class( 'card' );?>>
	<header class="entry-header default-max-width">
		<a href="<?php the_permalink();?>" rel="bookmark">
			<?php the_title( '<h2 class="entry-title">', '</h2>' );?>
		</a>

		<div class="entry-summary">
			<?php the_excerpt();?>
		</div><!-- .entry-content -->
	</header><!-- .entry-header -->

	<a class="post-thumbnail" href="<?php the_permalink();?>">
		<?php the_post_thumbnail( 'card' );?>
	</a>
</article><!-- #post-<?php the_ID();?> -->
