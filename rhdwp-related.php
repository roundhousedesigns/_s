<?php
/**
 * Template part for RHDWP Related Posts
 *
 * @package RHD
 */
?>

<li id="post-<?php the_ID();?>" <?php post_class( 'grid-item rhdwp-related-post' );?>>
	<a href="<?php the_permalink();?>" rel="bookmark" class="grid-content">
		<?php the_post_thumbnail( 'grid' ); ?>
		<?php the_title( '<h4 class="entry-title">', '</h4>' );?>
	</a>
</li><!-- #post-<?php the_ID();?> -->
