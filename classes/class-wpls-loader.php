<?php
/**
 * Setting up constants, classes.
 *
 * @package live-search
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

if ( ! class_exists( 'Wpls_Loader' ) ) {

	/**
	 * Setting up constants, classes.
	 *
	 * @since 1.0
	 */
	final class Wpls_Loader {

		/**
		 * The unique instance of the plugin.
		 *
		 * @var instance variable
		 */
		private static $instance;

		/**
		 * Gets an instance of our plugin.
		 */
		public static function get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {

			$this->define_constants();
			$this->load_files();
		}

		/**
		 * Define constants.
		 *
		 * @since 1.0
		 * @return void
		 */
		private function define_constants() {
			define( 'WPLS_VER', '1.0.0' );
			define( 'WPLS_BASE', plugin_basename( WPLS_FILE ) );
			define( 'WPLS_DIR', plugin_dir_path( WPLS_FILE ) );
			define( 'WPLS_URL', plugins_url( '/', WPLS_FILE ) );
			define( 'WPLS_SLUG', 'wpls' );
			define( 'WPLS_SETTINGS', 'wpls_settings' );
		}

		/**
		 * Loads classes and includes.
		 *
		 * @since 1.0
		 * @return void
		 */
		private function load_files() {

			require_once WPLS_DIR . 'classes/class-wpls-helper.php';
			require_once WPLS_DIR . 'classes/class-wpls-admin.php';
			require_once WPLS_DIR . 'classes/class-wpls-frontend.php';
			require_once WPLS_DIR . 'classes/class-wpls-search-shortcode.php';
		}
	}

	$wpls_loader = Wpls_Loader::get_instance();
}
