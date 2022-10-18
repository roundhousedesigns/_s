<?php
/**
 * Template part for current News (post) items.
 *
 * @package RHD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'current-news__item' ); ?>>
	<div class="entry-header default-max-width">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="post-thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'news-item' ); ?>')"></div>
			<?php the_title( '<h2 class="entry-title screen-reader-text">', '</h2>' ); ?>
		</a>
	</div>
</article>
