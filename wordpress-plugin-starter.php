<?php
/**
 * PLUGIN_NAME
 *
 * @package    PLUGIN_PACKAGE
 * @subpackage WordPress
 * @since      1.0.0
 * @author     PLUGIN_AUTHOR
 * @copyright  2022 PLUGIN_AUTHOR
 * @license    GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PLUGIN_NAME
 * Plugin URI:        PLUGIN_URI
 * Description:       PLUGIN_DESCRIPTION
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            PLUGIN_AUTHOR
 * Author URI:        PLUGIN_AUTHOR_URI
 * Text Domain:       PLUGIN_TEXT_DOMAIN
 * Domain Path:       /languages
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

// Define plugin constants.
define( 'PLUGIN_CONSTANT', __FILE__ );
define( 'PLUGIN_CONSTANT_PATH', plugin_dir_path( PLUGIN_CONSTANT ) );
define( 'PLUGIN_CONSTANT_PLUGIN_BASE', plugin_basename( PLUGIN_CONSTANT ) );
define( 'PLUGIN_CONSTANT_VERSION', '1.0.0' );

add_action( 'plugins_loaded', 'FUNCTION_PREFIX_load_plugin_textdomain' );

if ( ! version_compare( PHP_VERSION, '7.3', '>=' ) ) {
	add_action( 'admin_notices', 'FUNCTION_PREFIX_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '5', '>=' ) ) {
	add_action( 'admin_notices', 'FUNCTION_PREFIX_fail_wp_version' );
} else {
	require_once PLUGIN_CONSTANT_PATH . 'includes/class-plugin.php';
}

/**
 * Load plugin textdomain
 */
function FUNCTION_PREFIX_load_plugin_textdomain() {
	load_plugin_textdomain( 'PLUGIN_TEXT_DOMAIN' );
}

/**
 * Admin notice for minimum PHP version
 */
function FUNCTION_PREFIX_fail_php_version() {
	$message = sprintf(
		/* translators: %s: replaced with the PHP version number */
		esc_html__(
			'PLUGIN_NAME requires PHP version %s+, plugin is currently NOT RUNNING.',
			'PLUGIN_TEXT_DOMAIN'
		),
		'7.3'
	);
	$html_message = sprintf(
		/* translators: %s: replaced with the error message */
		'<div class="error">%s</div>',
		wpautop( $message )
	);
	echo wp_kses_post( $html_message );
}

/**
 * Admin notice for minimum WordPress version
 */
function FUNCTION_PREFIX_fail_wp_version() {
	$message = sprintf(
		/* translators: %s: replaced with the WordPress version number */
		esc_html__(
			'PLUGIN_NAME requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.',
			'PLUGIN_TEXT_DOMAIN'
		),
		'5'
	);
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}
