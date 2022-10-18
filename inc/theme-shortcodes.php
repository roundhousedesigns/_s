<?php
/**
 * Theme shortcodes.
 *
 * @package RHD
 */

function rhd_zeitgeist_current_news_shortcode( $atts, $children ) {
	$atts = shortcode_atts( [
		'expire_in_days' => null,
		'number'         => 4,
		'title'          => '',
	], $atts, 'zeitgeist-current-news' );

	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'meta_query' => [
			[
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS'
			]
		],
		'posts_per_page' => $atts['number'],
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

	$posts = new WP_Query( $args );

	ob_start();

	if ( $posts->have_posts() ) : ?>
		<div class="current-news-container">
			<h2 class="current-news__title alignfull has-text-align-center has-x-large-font-size"><?php echo wp_kses_post( $atts['title'] ); ?></h2>
			<div class="current-news">
				<?php
				while ( $posts->have_posts() ) : $posts->the_post();
					get_template_part( 'template-parts/item', 'current-news' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div> <?php
	endif;

	return ob_get_clean();
}
add_shortcode( 'zeitgeist-current-news', 'rhd_zeitgeist_current_news_shortcode' );
