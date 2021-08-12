<?php
/**
 * RHD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RHD
 */

if ( ! defined( 'RHD_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'RHD_VERSION', '1.0.0' );
}

if ( ! function_exists( 'rhd_setup' ) ):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rhd_setup() {
		/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on RHD, use a find and replace
			 * to change 'rhd' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'rhd', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'rhd' ),
				'menu-2' => esc_html__( 'Footer', 'rhd' ),
			)
		);

		/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rhd_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Opinionated block default styling + alignments
		 */
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'align-full' );

		/**
		 * Post formats
		 */
		add_theme_support( 'post-formats', array( 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'rhd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rhd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rhd_content_width', 640 );
}
add_action( 'after_setup_theme', 'rhd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rhd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rhd' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rhd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rhd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rhd_scripts() {
	wp_enqueue_style( 'rhd-style', get_stylesheet_uri(), [], RHD_VERSION );
	wp_style_add_data( 'rhd-style', 'rtl', 'replace' );

	wp_enqueue_script( 'rhd-navigation', get_template_directory_uri() . '/js/navigation.js', [], RHD_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * WooCommerce styles
	 */
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script( 'rhd-woocommerce', get_template_directory_uri() . '/woocommerce.css', [], RHD_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'rhd_scripts' );

/**
 * Theme Settings page
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Agile Sales WebFeed 
 */
require get_template_directory() . '/inc/class-agile.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Development mode: Livereload enabler
 */
if ( ! function_exists( 'rhd_dev_livereload' ) ) {
	function rhd_dev_livereload() {
		$options = get_option( 'rhdwp_general_settings' );

		if ( isset( $options['_theme_dev_mode'] ) && $options['_theme_dev_mode'] === 'yes' ) {
			// $addr = 'localhost';
			$addr = home_url();
			$port = '35729';
			$url  = sprintf( '%s:%s/livereload.js?snipver=1', $addr, $port );
			$msg  = __( sprintf( 'Livereload is listening on %s', $url ), 'rhdwp' );

			printf( '<!-- LIVERELOAD --><script src="%s"></script><script>console.info( "RHDWP:", "%s" );</script>', $url, $msg );
		}
	}
	add_action( 'wp_head', 'rhd_dev_livereload', 999 );
}

/**
 * Allow additional upload file types
 */
if( !function_exists( 'rhd_upload_allow_tyles' ) ) {
	function rhd_upload_allow_types( $mimes ) {
		// allow new types
		$mimes['svg']  = 'image/svg+xml';
		
		return $mimes;
	}
	add_filter( 'upload_mimes', 'rhd_upload_allow_types' );
}