<?php
	/**
	 * Template part for displaying grid items.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 * @package RHD
	 */
?>

<?php
	/**
	 * For the `mention` post type, use the post content as the permalink. (Used like a post with the 'link' post format)
	 */
	$permalink = get_post_type() === 'mention' ? get_the_content() : get_the_permalink();
?>

<div id="post-<?php the_ID();?>"<?php post_class( 'grid-item' );?> style="background-image: url(<?php echo the_post_thumbnail_url( 'grid' ); ?>">
	<div class="overlay"></div>
	<div href="<?php the_permalink();?>" rel="bookmark" class="grid-content">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );?>
		<a href="<?php echo $permalink; ?>" rel="bookmark" class="button readmore" target="<?php echo get_post_type() === 'method' ? '_blank' : '_self'; ?>"><?php _e( 'Read More', 'rhd' );?></a>
	</div>
</div><!-- #post-<?php the_ID();?> -->
