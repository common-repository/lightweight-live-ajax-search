<?php
/**
 * Helper
 *
 * @package live-search
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper.
 *
 * @since 1.0
 */
class Wpls_Helper {

	/**
	 * Settings data.
	 *
	 * @var settings variable
	 */
	public static $settings = null;

	/**
	 * Get Settings.
	 */
	public static function get_settings() {

		if ( null === self::$settings ) {

			self::$settings = array(
				'wpls_replace_theme_search' => get_option( 'wpls_replace_theme_search', 'no' ),
				'wpls_search_post_types'    => get_option( 'wpls_search_post_types', array( 'post', 'page' ) ),
			);
		}

		return self::$settings;
	}

	/**
	 * Get Setting.
	 *
	 * @param string $key     Option key.
	 * @param mix    $default Default value.
	 *
	 * @return string.
	 */
	public static function get_setting( $key = '', $default = false ) {

		$settings = self::get_settings();

		if ( isset( $settings[ $key ] ) ) {

			$value = $settings[ $key ];
		} else {

			$value = $default;
		}

		return $value;
	}
}
