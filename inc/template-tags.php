<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RHD
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function rhd_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'rhd' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	printf( '<span class="posted-on">%1$s</span>', $posted_on ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the current author.
 */
function rhd_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'rhd' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	printf( '<span class="byline">%1$s</span>', $byline ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rhd_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rhd' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rhd' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'rhd' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rhd' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rhd' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}

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
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @param string $size The image size (default: post-thumbnail).
 * @return void
 */
function rhd_post_thumbnail( $size = 'post-thumbnail' ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) {
		printf( '<div class="post-thumbnail">%s</div>', get_the_post_thumbnail() );
	} else {
		sprintf(
			'<a class="post-thumbnail" href="%1$s" aria-hidden="true" tabindex="-1">%2$s</a>',
			get_the_permalink(),
			get_the_post_thumbnail( get_the_id(), $size, array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) )
		);
	}
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Prints the hamburger icon's HTML.
 *
 * @param string $style Button animation style (rot, htx, htla, htra)
 * @return void
 **/
function rhd_menu_toggle( $style ) {
	$allowed_styles = array( 'rot', 'htx', 'htla', 'htra' );
	$style          = $style && in_array( $style, $allowed_styles ) ? $style : 'rot';

	printf(
		'<button id="hamburger" class="menu-toggle c-hamburger c-hamburger--%s" aria-controls="primary-menu" aria-expanded="false"><span>%s</span></button>',
		$style,
		esc_html( 'Main Menu', 'rhd' )
	);
}

/**
 * Renders the custom logo, if set, or falls back to the site title and description.
 *
 * @param boolean $show_description Show description (default: true).
 * @return void
 */
function rhd_custom_logo( $show_description = true ) {
	if ( has_custom_logo() ) {
		$title = get_custom_logo();
	} else {
		$title       = '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
		$description = $show_description ? get_bloginfo( 'description' ) : '';
		if ( $description || is_customize_preview() ) {
			$title .= '<p class="site-description">' . $description . '</p>';
		}
	}

	echo $title;
}

/**
 * Renders footer byline/links.
 *
 * Adds the Roundhouse Designs "site by" line if %rhd% placeholder isn't present.
 *
 * @return void
 */
function rhd_footer_site_info() {
	$placeholders = array(
		'year'            => date( 'Y' ),
		'sitename'        => get_bloginfo( 'name' ),
		'sitedescription' => get_bloginfo( 'description' ),
		'rhd'             => sprintf(
			'<a class="site-info-link" href="%1$s" target="_blank">Site by %2$s</a>',
			esc_url( 'https://roundhouse-designs.com' ),
			esc_html__( 'Roundhouse Designs', 'rhd' )
		),
	);

	$bylines = array(
		get_theme_mod( 'rhd_footer_byline_text' ),
		get_theme_mod( 'rhd_footer_byline_text-2' ),
	);

	// Check for `rhd` placeholder, and if not found, append to second line.
	$found = false;
	foreach ( $bylines as $line ) {
		if ( stripos( $line, '%rhd%' ) !== false ) {
			$found = true;
		}
	}
	$bylines[1] .= false === $found ? $placeholders['rhd'] : '';

	foreach ( $placeholders as $placeholder => $replacement ) {
		$pattern = "/%${placeholder}%/";
		$bylines = preg_replace( $pattern, $replacement, $bylines );
	}

	$filtered = sprintf( '<p>%s</p>', implode( '</p><p>', $bylines ) );

	echo wp_kses_post( $filtered );
}