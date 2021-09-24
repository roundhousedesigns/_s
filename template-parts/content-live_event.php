<?php
/**
 * Template part for displaying page content in page.php
 *
 * @uses $args[]
 *
 * @package RHD
 */

$video     = rhd_film_event_video();
$additional = rhd_film_event_meta(
	get_the_id(),
	array(
		'release_year'       => esc_html__( 'Release Year', 'rhd' ),
		'duration'           => esc_html__( 'Run Time', 'rhd' ),
		'rating'             => esc_html__( 'Rating', 'rhd' ),
		'language'           => esc_html__( 'Language', 'rhd' ),
		'production_country' => esc_html__( 'Country', 'rhd' ),
	)
);
$social = rhd_film_event_meta_link(
	get_the_id(),
	array(
		'website'  => esc_html__( 'Website', 'rhd' ),
		'facebook' => esc_html__( 'Facebook', 'rhd' ),
		'twitter'  => esc_html__( 'Twitter', 'rhd' ),
	)
);
$sponsors = rhd_film_event_sponsor();
?>

<article id="post-<?php the_ID();?>"<?php post_class();?>>
	<header class="entry-header">
		<h1 class="entry-title" itemprop="name"><?php the_title();?></h1>
	</header><!-- .entry-header -->

	<!-- structured data -->
	<span itemprop="dateCreated" content="<?php echo get_the_date( 'c' ); ?>"></span>
	<span itemprop="image" content="<?php echo esc_url( RHD_Base::post_main_image_url() ); ?>"></span>

	<div class="entry-content">
		<section class="synopsis">
			<h3 class="single-item-heading"><?php esc_html_e( 'Synopsis', 'rhd' );?></h3>
			<span itemprop="about"><?php the_content();?></span>
		</section>

		<?php if ( $video ): ?>
			<div class="trailer">
				<h3 class="single-item-heading"><?php esc_html_e( 'Trailer', 'rhd' );?></h3>
				<?php echo $video; ?>
			</div>
		<?php endif;?>

		<?php if ( $additional ): ?>
			<div class="additional-info">
				<h3 class="single-item-heading"><?php esc_html_e( 'Additional Information', 'rhd' );?></h3>
				<?php echo $additional; ?>
			</div>
		<?php endif;?>

		<?php if ( $social ): ?>
			<div class="social">
				<h3 class="single-item-heading"><?php esc_html_e( 'Connect', 'rhd' );?></h3>
				<?php echo $social; ?>
			</div>
		<?php endif;?>

		<?php if ( $sponsors ): ?>
			<div class="sponsors">
				<h3 class="single-item-heading"><?php esc_html_e( 'Sponsor', 'rhd' );?></h3>
				<?php echo $sponsors; ?>
			</div>
		<?php endif;?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ): ?>
		<footer class="entry-footer default-max-width">

			<?php rhd_taxonomy_badges();?>

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
	<?php endif;?>
</article><!-- #post-<?php the_ID();?> -->
