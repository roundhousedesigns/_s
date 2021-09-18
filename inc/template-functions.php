<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package RHD
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rhd_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'rhd_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rhd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'rhd_pingback_header' );

/**
 * Customizes the Archive title string.
 *
 * @param string  $title The pre-filtered archive title.
 * @return string The filtered archive title.
 */
function rhd_customize_archive_titles( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tax( 'film_event_category' ) ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tax( 'venue' ) ) {
		$title = single_cat_title( esc_html__( 'Now Playing: ', 'rhd' ), false );
	} elseif ( is_post_type_archive( array( 'film', 'live_event' ) ) ) {
		$post_type = get_post_type_object( get_post_type() );
		$title     = sprintf( esc_html__( 'All %s', 'rhd' ), $post_type->labels->name );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'rhd_customize_archive_titles' );

/**
 * @param $query
 * @return mixed
 */
function rhd_alter_archive_query( $query ) {
	if (
		! is_admin() &&
		$query->is_main_query() &&
		(
			$query->is_tax( array( 'film_event_category', 'film_genre', 'venue' ) ) ||
			is_post_type_archive( array( 'film', 'live_event' ) )
		)
	) {
		$today = new DateTime( "now", wp_timezone() );
		$today->setTime( 23, 59, 59 );

		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'meta_type', 'DATETIME' );
		$query->set( 'meta_query', array(
			array(
				'key'     => 'end_date',
				'value'   => $today->format( 'Y-m-d' ),
				'compare' => '>=',
			),
		) );
	}

	return $query;
}
add_action( 'pre_get_posts', 'rhd_alter_archive_query' );