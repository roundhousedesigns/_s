<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RHD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header default-max-width">
		<div class="entry-thumbnail small-screen">
			<?php rhd_post_thumbnail( 'medium' ); ?>
		</div>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<?php
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'rhd' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</header><!-- .entry-header -->

	<div class="entry-thumbnail large-screen">
		<?php rhd_post_thumbnail( 'medium' ); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
