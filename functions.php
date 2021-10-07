<?php
/**
 * RHD functions and definitions
 *
 * @package RHD
 */

if ( ! defined( 'RHD_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'RHD_VERSION', '1.0.1' );
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
 * Google Fonts preconnects.
 *
 * @return void
 */
function rhd_google_fonts_preload() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'rhd_google_fonts_preload' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rhd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Film/Event Sidebar', 'rhd' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Sidebar widgets for single film and event items.', 'rhd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Left/Bottom', 'rhd' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'On large screens, the left diagonal area; Mobile, stacks on top. ', 'rhd' ),
			'before_widget' => '<section id="%1$s" class="widget widget__footer %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Right/Top', 'rhd' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'On large screens, the right diagonal area; Mobile, stacks on bottom.', 'rhd' ),
			'before_widget' => '<section id="%1$s" class="widget widget__footer %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Off-Canvas Navigation', 'rhd' ),
			'id'            => 'sidebar-4',
			'description'   => esc_html__( 'The main navigation area.', 'rhd' ),
			'before_widget' => '<div id="%1$s" class="widget widget__nav %2$s">',
			'after_widget'  => '</div>',
		)
	);
}

add_action( 'widgets_init', 'rhd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rhd_scripts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;0,700;0,900;1,400&display=swap', array(), RHD_VERSION, false );

	wp_enqueue_style( 'rhd-style', get_stylesheet_uri(), array(), RHD_VERSION );
	wp_style_add_data( 'rhd-style', 'rtl', 'replace' );

	wp_enqueue_script( 'rhd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), RHD_VERSION, true );
	wp_enqueue_script( 'rhd-frontend', get_template_directory_uri() . '/js/frontend.js', array(), RHD_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * WooCommerce styles
	 */

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script( 'rhd-woocommerce', get_template_directory_uri() . '/woocommerce.css', array(), RHD_VERSION, true );
	}

}

add_action( 'wp_enqueue_scripts', 'rhd_scripts' );

/**
 * Theme Settings page
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Required plugins
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

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
 * TGM Required plugins.
 *
 * @return void
 */
function rhd_register_required_plugins() {
	$plugins = array(
		array(
			'name'             => 'Advanced Custom Fields',
			'slug'             => 'advanced-custom-fields',
			'is_callable'      => 'get_field',
			'required'         => true,
			'force_activation' => true,
		),
		array(
			'name'             => 'State Theatre',
			'slug'             => 'state-theatre',
			'required'         => true,
			'force_activation' => true,
			'source'           => get_stylesheet_directory() . '/lib/state-theatre.zip',
		),
		array(
			'name'     => 'Yoast SEO',
			'slug'     => 'wordpress-seo',
			'required' => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'rhd-theme', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '', // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php', // Parent menu slug.
		'capability'   => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true, // Show admin notices or not.
		'dismissable'  => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message'      => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'rhd_register_required_plugins' );

/**
 * Development mode: Livereload enabler
 */
function rhd_dev_livereload() {
	$options = get_option( 'rhdwp_general_settings' );

	if ( isset( $options['_theme_dev_mode'] ) && 'yes' === $options['_theme_dev_mode'] ) {
		// $addr = 'localhost';
		$addr = home_url();
		$port = '35729';
		$url  = sprintf( '%s:%s/livereload.js?snipver=1', $addr, $port );
		$msg  = __( sprintf( 'Livereload is listening on %s', $url ), 'rhdwp' );

		printf( '<!-- LIVERELOAD --><script src="%s"></script><script>console.info( "RHDWP:", "%s" );</script>', $url, $msg );
	}

}
add_action( 'wp_head', 'rhd_dev_livereload', 999 );

/**
 * Allow additional upload file types
 */
function rhd_upload_allow_types( $mimes ) {
	// allow new types
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'rhd_upload_allow_types' );

/**
 * Registers thumbnail sizes
 */
function rhd_add_image_sizes() {
	add_image_size( 'poster', 370, 555, true );
	add_image_size( 'small', 300, null, false );
}

add_action( 'init', 'rhd_add_image_sizes' );
