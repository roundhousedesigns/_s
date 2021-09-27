<?php
/**
 * Template part for displaying post content in single.php.
 *
 * @package RHD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header default-max-width">
		<?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-meta">
		<?php echo get_the_date(); ?>
	</div>

	<?php rhd_post_thumbnail( 'medium-large' ); ?>

	<div class="entry-content">

		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rhd' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">
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
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
