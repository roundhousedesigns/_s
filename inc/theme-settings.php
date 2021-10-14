<?php
/**
 * RHD Theme Settings
 *
 * Creates the main RHD Theme Settings page. RHD modules and theme functions use this page to set options.
 */

/**
 * Add options submenu page.
 */
function rhd_admin_menu() {
	add_submenu_page( 'options-general.php', 'Roundhouse Site Settings', 'Roundhouse Settings', 'manage_options', 'rhdwp_settings', 'rhd_create_admin_page' );
}
add_action( 'admin_menu', 'rhd_admin_menu' );

/**
 * Submenu page callback.
 */
function rhd_create_admin_page() {
	?>
	<div class="wrap">
		<h2><?php esc_html_e( 'Roundhouse Designs Settings', 'rhd' ); ?></h2>

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
function rhd_theme_options_init() {
	register_setting( 'rhdwp_site_settings', 'rhdwp_general_settings', 'rhd_general_settings_sanitize' );

	add_settings_section(
		'rhdwp_general_settings',
		'Theme Settings',
		'rhd_theme_admin_print_section_info',
		'rhdwp-settings-admin'
	);
	
	 add_settings_field(
		'rhdwp_theme_dev_mode',
		'Development Mode',
		'rhd_theme_dev_mode_cb',
		'rhdwp-settings-admin',
		'rhdwp_general_settings'
	);
}
add_action( 'admin_init', 'rhd_theme_options_init' );

/**
 * Sanitize each Administration setting field as needed.
 * 
 * @param array $input Contains all settings fields as array keys
 */
function rhd_general_settings_sanitize( $input ) {
	$new_input = array();
	
	$new_input['_theme_dev_mode'] = ( isset( $input['_theme_dev_mode'] ) ) ? esc_attr( $input['_theme_dev_mode'] ) : '';
	
	return $new_input;
}

/**
 * Print section info (optional).
 */
function rhd_theme_admin_print_section_info() {
	echo '<p style="font-style: italic; font-size: 1.1em;">Please don\'t touch. Love, Roundhouse Designs.</p>';
}

/**
 * Development Mode checkbox callback.
 *
 * @return void
 */
function rhd_theme_dev_mode_cb() {
	$options = get_option( 'rhdwp_general_settings' );

	$checked = isset( $options['_theme_dev_mode'] ) ? $options['_theme_dev_mode'] : 'no';
	?>
	<input type="checkbox" id="devmode" name="rhdwp_general_settings[_theme_dev_mode]" value="yes" <?php checked( 'yes', $checked, true ); ?>>
	<label for="devmode"><small style="font-style: italic;"><?php _e( 'Allows .htaccess restrictions in RHDWP\'s dev environment and enables livereload.', 'rhdwp' ); ?></small></label>
	<?php
}
