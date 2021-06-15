<?php
/**
 * Template part for RHDWP Related Posts
 *
 * @package RHD
 */
?>

<?php
$thumb = has_post_thumbnail( get_the_id() ) ? get_the_post_thumbnail_url( get_the_id(), 'medium-large' ) : RHDWP_REL_DIR_URL . 'img/default-thumbnail.png'; ?>

<div id="post-<?php the_ID();?>"<?php post_class( 'grid-item' );?> style="background-image: url(<?php echo $thumb; ?>);">
	<div class="overlay"></div>
	<div href="<?php the_permalink();?>" rel="bookmark" class="grid-content">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );?>
		<a href="<?php the_permalink();?>" rel="bookmark" class="button readmore"><?php _e( 'Read More', 'rhd' );?></a>
	</div>
</div><!-- #post-<?php the_ID();?> -->
