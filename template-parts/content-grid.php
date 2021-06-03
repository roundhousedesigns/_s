<?php
	/**
	 * Template part for displaying posts
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package RHD
	 */

?>

<div id="post-<?php the_ID();?>"<?php post_class( 'grid-item' );?> style="background-image: url(<?php echo the_post_thumbnail_url( 'medium-large' ); ?>">
	<div class="overlay"></div>
	<div href="<?php the_permalink();?>" rel="bookmark" class="grid-content">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );?>
		<a href="<?php the_permalink();?>" rel="bookmark" class="button readmore"><?php _e( 'Read More', 'rhd' );?></a>
	</div>
</div><!-- #post-<?php the_ID();?> -->
