<?php
/**
 * Frontend
 *
 * @package live-search
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Frontend.
 *
 * @since 1.0
 */
class Wpls_Frontend {

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

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_scripts' ), 10 );
	}

	/**
	 * Enqueue frontend scripts
	 *
	 * @since 1.0
	 */
	public function enqueue_front_scripts() {

		wp_register_style( 'wpls-frontend', WPLS_URL . 'assets/css/frontend.css', array(), WPLS_VER );
		wp_register_script( 'wpls-frontend', WPLS_URL . 'assets/js/frontend.js', array( 'jquery' ), WPLS_VER, true );

		wp_localize_script(
			'wpls-frontend',
			'wpls',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}

Wpls_Frontend::get_instance();


