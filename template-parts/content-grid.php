<?php
	/**
	 * Template part for displaying grid items.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 * @package RHD
	 */
?>

<div id="post-<?php the_ID();?>"<?php post_class( 'grid-item' );?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php the_post_thumbnail( 'card' ); ?>
		<?php the_title( '<h2 class="entry-title">', '</h2>' );?>
	</a>
</div><!-- #post-<?php the_ID();?> -->
