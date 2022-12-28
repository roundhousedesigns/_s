<?php
/**
 * Template part for displaying page content in single.php
 *
 * @package RHD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php rhd_posted_on( '' ); ?>
			<?php rhd_posted_by( '/about'); ?>
			<?php rhd_updated_on(); ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php rhd_post_disclaimer(); ?>
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

	<?php rhd_post_branding_thumbnail(); ?>

	<?php get_template_part( 'template-parts/content', 'author' ); ?>

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
