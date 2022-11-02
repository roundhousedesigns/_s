<?php
/**
 * Theme shortcodes.
 *
 * @package RHD
 */

function rhd_zeitgeist_current_news_shortcode( $atts ) {
	$atts = shortcode_atts( [
		'expire_in_days' => null,
		'link_to_url'   => '',
	], $atts, 'zeitgeist-news-headline' );

	// Set up WP_Query arguments.
	$sticky = get_option( 'sticky_posts' );
	
	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'post__in' => $sticky,
		'posts_per_page' => 1,
		'ignore_sticky_posts' => 1
	];

	// Add a date query if an expiration is set.
	if ( $atts['expire_in_days'] ) {
		$args['date_query'] = [
			[
				'column' => 'post_date_gmt',
				'after'  => $atts['expire_in_days'] . ' days ago',
			],
		];
	}

	$q = new WP_Query( $args );

	ob_start();

	if ( $sticky[0] && $q->have_posts() ) : ?>
		<div class="current-news-container">
			<div class="current-news">
				<?php while( $q->have_posts() ) : $q->the_post();
					if ( ! $atts['link_to_url'] ) {
						$link = get_the_permalink();
					} else {
						$link = $atts['link_to_url'];
					}
					?>
					<a class="current-news__item" href="<?php echo esc_url( $link ); ?>" rel="bookmark"><?php the_title( '<h2 class="entry-title">' . __( 'NEWS: ', 'rhd' ), ' &rarr;</h2>' ); ?></a>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		</div> <?php
	endif;

	return ob_get_clean();
}
add_shortcode( 'zeitgeist-news-headline', 'rhd_zeitgeist_current_news_shortcode' );
