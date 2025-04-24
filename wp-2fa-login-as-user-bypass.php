<?php
/**
 * Plugin Name: WP 2FA Login As User Bypass
 * Description: Temporarily disables WP 2FA enforcement when using the "Login as User" plugin for seamless user switching.
 * Version: 1.0.0
 * Author: abdelrawaf
 * Author URI: https://www.upwork.com/freelancers/~01e0ebea64e80eb1de
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-2fa-loginasuser-bypass
 * Requires at least: 5.6
 * Requires PHP: 7.4
 * Tested up to: 6.5
 *
 * @package WP_2FA_LoginAsUser_Bypass
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
class WP_2FA_LoginAsUser_Bypass {

	/**
	 * Initialize the plugin.
	 */
	public static function init() {
		add_filter( 'get_user_metadata', array( __CLASS__, 'maybe_disable_2fa_enforcement' ), 10, 4 );
	}

	/**
	 * Disable WP 2FA enforcement when using the "Login as User" plugin.
	 *
	 * @param mixed  $value The current meta value.
	 * @param int    $object_id The user ID.
	 * @param string $meta_key The meta key being fetched.
	 * @param bool   $single Whether to return a single value.
	 * @return mixed The modified meta value if conditions are met, original value otherwise.
	 */
	public static function maybe_disable_2fa_enforcement( $value, $object_id, $meta_key, $single ) {
		// Only proceed if we're checking the 2FA enforcement meta key.
		if ( 'wp_2fa_user_enforced_instantly' !== $meta_key ) {
			return $value;
		}

		// Check if the Login as User plugin is active.
		if ( ! self::is_login_as_user_active() ) {
			return $value;
		}

		// Check if it's a "Login as User" session.
		if ( self::is_login_as_user_session() ) {
			return false; // Prevent 2FA enforcement.
		}

		return $value;
	}

	/**
	 * Check if the Login as User plugin is active.
	 *
	 * @return bool True if the plugin is active, false otherwise.
	 */
	private static function is_login_as_user_active() {
		return defined( 'LOGINASUSER_VER' ) || function_exists( 'loginasuser_init' );
	}

	/**
	 * Check if the current session is a "Login as User" session.
	 *
	 * @return bool True if it's a Login as User session, false otherwise.
	 */
	private static function is_login_as_user_session() {
		if ( ! defined( 'COOKIEHASH' ) ) {
			return false;
		}

		$cookie_name = 'wp_loginasuser_olduser_' . COOKIEHASH;
		return isset( $_COOKIE[ $cookie_name ] ) && ! empty( $_COOKIE[ $cookie_name ] );
	}
}

// Initialize the plugin.
WP_2FA_LoginAsUser_Bypass::init();