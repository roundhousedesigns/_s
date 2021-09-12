<?php
/**
 * Default template for Related Post items.
 *
 * @package RHD
 */

?>

<div class="related-post post-item">
	<header class="post-item__header">
		<?php RHD_Base::post_main_image(); ?>

		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title( '<h3 class="post-item-title">', '</h3>' ); ?></a>
	</header>
	<div class="post-item__content">
		<div class="post-item-date">
			<?php
			if ( in_array( get_post_type(), array( 'film', 'live_event' ) ) ) {
				RHD_Base::film_event_item_date();
			}
			?>
		</div>
	</div>
</div>