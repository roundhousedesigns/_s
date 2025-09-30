<?php
/**
 * Theme shortcodes.
 *
 * @package RHD
 */

function rhd_zeitgeist_current_news_shortcode( $atts ) {
	$atts = shortcode_atts( [
		'expire_in_days' => null,
		'link_to_news'   => '',
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
					$target = '_self';

					if ( $atts['link_to_news'] ) {
						$link = get_permalink( get_option( 'page_for_posts' ) );
					} else {
						$external = get_post_meta( get_the_id(), 'rhd_zeitgeist_external_link_field', true );
						if ( $external ) {
							$link = $external;
							$target = "_blank";
						} else {
							$link = get_the_permalink();
						}
					}
					?>
					<a class="current-news__item" href="<?php echo esc_url( $link ); ?>" rel="bookmark" target="<?php echo esc_attr( $target ); ?>"><?php the_title( '<h2 class="entry-title">', ' &rarr;</h2>' ); ?></a>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		</div> <?php
	endif;

	return ob_get_clean();
}
add_shortcode( 'zeitgeist-news-headline', 'rhd_zeitgeist_current_news_shortcode' );
