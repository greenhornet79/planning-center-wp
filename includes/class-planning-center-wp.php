<?php 

/**
* Load the main class
*/
class Planning_Center_WP {
	
	/**
	 * Kick it off
	 * 
	 */
	public function run() {

		self::setup_constants();
		
		require_once PLANNING_CENTER_WP_PLUGIN_DIR . 'admin/class-settings.php';
		$oauth = new Planning_Center_WP_Settings;

		require_once PLANNING_CENTER_WP_PLUGIN_DIR . 'class-shortcodes.php';
		$shortcodes = new Planning_Center_WP_Shortcodes;

		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

	}

	public function load_scripts() {

		// wp_enqueue_script( 'bpopup', PLANNING_CENTER_WP_PLUGIN_URL . 'js/bpopup.js' );

	}

	/**
	 * Setup plugin constants.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'PLANNING_CENTER_WP_VERSION' ) ) {
			define( 'PLANNING_CENTER_WP_VERSION', '1.0.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'PLANNING_CENTER_WP_PLUGIN_DIR' ) ) {
			define( 'PLANNING_CENTER_WP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'PLANNING_CENTER_WP_PLUGIN_URL' ) ) {
			define( 'PLANNING_CENTER_WP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'PLANNING_CENTER_WP_PLUGIN_FILE' ) ) {
			define( 'PLANNING_CENTER_WP_PLUGIN_FILE', __FILE__ );
		}

	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function includes() {
		global $planning_center_wp_options;

		require_once PLANNING_CENTER_WP_PLUGIN_DIR . 'includes/admin/settings/register-settings.php';
		$this_plugins_options = this_plugin_get_settings();

	}

}