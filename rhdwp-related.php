<?php
/**
 * Template part for RHDWP Related Posts
 *
 * @package RHD
 */
?>

<div id="post-<?php the_ID();?>" <?php post_class( 'grid-item rhdwp-related-post' );?>>
	<a href="<?php the_permalink();?>" rel="bookmark" class="grid-content">
		<?php the_post_thumbnail( 'grid' ); ?>
		<?php the_title( '<h4 class="entry-title">', '</h4>' );?>
	</a>
</div><!-- #post-<?php the_ID();?> -->
