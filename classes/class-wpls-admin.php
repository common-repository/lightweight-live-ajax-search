<?php
/**
 * Admin
 *
 * @package live-search
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin.
 *
 * @since 1.0
 */
class Wpls_Admin {

	/**
	 * The unique instance of the plugin.
	 *
	 * @var instance variable
	 */
	private static $instance;

	/**
	 * Settings hook.
	 *
	 * @var settings_hook variable
	 */
	public $settings_hook;

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

		add_action( 'admin_init', array( $this, 'register_settings_options' ) );
		add_action( 'admin_menu', array( $this, 'register_options_menu' ), 99 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 10 );
	}

	/**
	 * Register setting option variables.
	 */
	public function register_settings_options() {
		register_setting( 'wpls-settings-group', 'wpls_replace_theme_search' );
		register_setting( 'wpls-settings-group', 'wpls_search_post_types' );
	}

	/**
	 * Regsiter option menu
	 *
	 * @category Filter
	 */
	public function register_options_menu() {

		$this->settings_hook = add_submenu_page(
			'options-general.php',
			__( 'Live Search', 'lightweight-live-ajax-search' ),
			__( 'Live Search', 'lightweight-live-ajax-search' ),
			'manage_options',
			WPLS_SETTINGS,
			array( $this, 'render_options_page' )
		);
	}

	/**
	 * Includes options page
	 */
	public function render_options_page() {
		require_once WPLS_DIR . 'includes/settings-page.php';
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @param string $hook Current screen hook.
	 * @since 1.0
	 */
	public function enqueue_admin_scripts( $hook ) {

		if ( $this->settings_hook === $hook ) {

			wp_enqueue_style( 'wpls-admin', WPLS_URL . 'assets/css/admin.css', array(), WPLS_VER );
		}
	}
}

Wpls_Admin::get_instance();


