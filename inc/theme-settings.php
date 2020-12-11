<?php
/**
 * RHDWP Theme Settings
 *
 * Creates the main RHDWP Theme Settings page. RHD modules and theme functions use this page to set options.
 */

/**
 * Add options submenu page.
 */
function rhdwp_admin_menu() {
	add_submenu_page( 'themes.php', 'Roundhouse Designs Site Settings', 'Roundhouse Settings', 'manage_options', 'rhdwp_settings', 'rhdwp_create_admin_page' );
}
add_action( 'admin_menu', 'rhdwp_admin_menu' );

/**
 * Submenu page callback.
 */
function rhdwp_create_admin_page() {
	?>
	<div class="wrap">
		<h2><?php sprintf( '$s Theme Settings', get_bloginfo( 'name' ) ); ?></h2>

		<form method="post" action="options.php">
			<?php
			// This prints out all hidden setting fields
			settings_fields( 'rhdwp_site_settings' );
			do_settings_sections( 'rhdwp-settings-admin' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Register and add settings.
 */
function rhdwp_theme_options_init() {
	register_setting( 'rhdwp_site_settings', 'rhdwp_general_settings', 'rhdwp_general_settings_sanitize' );

	add_settings_section(
		'rhdwp_general_settings',
		'Theme Settings',
		'rhdwp_theme_admin_print_section_info',
		'rhdwp-settings-admin'
	);
	
	 add_settings_field(
		'rhdwp_theme_dev_mode',
		'Development Mode',
		'rhdwp_theme_dev_mode_cb',
		'rhdwp-settings-admin',
		'rhdwp_general_settings'
	);
}
add_action( 'admin_init', 'rhdwp_theme_options_init' );

/**
 * Sanitize each Administration setting field as needed.
 * 
 * @param array $input Contains all settings fields as array keys
 */
function rhdwp_general_settings_sanitize( $input ) {
	$new_input = array();
	
	$new_input['_theme_dev_mode'] = ( isset( $input['_theme_dev_mode'] ) ) ? esc_attr( $input['_theme_dev_mode'] ) : '';
	
	return $new_input;
}

/**
 * Print section info (optional).
 */
function rhdwp_theme_admin_print_section_info() {
	?>
	<p style="font-style: italic;">Please don't touch this section or you'll make Nicky sad.</p>
	<?php
}

/**
 * Development Mode checkbox callback.
 * 
 * @param mixed $args
 */
function rhdwp_theme_dev_mode_cb( $args ) {
	$options = get_option( 'rhdwp_general_settings' );

	$checked = isset( $options['_theme_dev_mode'] ) ? $options['_theme_dev_mode'] : 'no';
	?>
	<input type="checkbox" id="devmode" name="rhdwp_general_settings[_theme_dev_mode]" value="yes" <?php checked( 'yes', $checked, true ); ?>>
	<label for="devmode"><small style="font-style: italic;"><?php _e( 'Allows .htaccess restrictions in RHDWP\'s dev environment and enables livereload.', 'rhdwp' ); ?></small></label>
	<?php
}

/**
 * Move Wordpress SEO metaboxes to bottom
 */
add_filter( 'wpseo_metabox_prio', 'wfm_move_wpseo' );
function wfm_move_wpseo() {
	return 'low';
}
