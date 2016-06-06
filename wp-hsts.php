<?php
/*
Plugin Name: WP HSTS
Plugin URI: https://www.github.com/thomaslhotta/hsts
Description: Simple plugin that adds HTTP Strict Transport Security headers to WordPress.
Author: Thomas Lhotta
Version: 1.0
*/

class WP_HSTS {
	/**
	 * @var WP_HSTS
	 */
	protected static $instance;

	/**
	 * Returns plugin instance
	 *
	 * @return WP_HSTS
	 */
	public static function get_instance() {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'wp_headers', array( $this, 'add_header' ) );
	}

	public function add_header( $headers ) {
		$headers['Strict-Transport-Security'] = sprintf(
			'max-age=%d;',
			apply_filters( 'hsts_max_age', 15984000 )
		);

		return $headers;
	}
}

WP_HSTS::get_instance();