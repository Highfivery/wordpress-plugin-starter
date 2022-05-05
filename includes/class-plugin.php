<?php
/**
 * Main plugin class
 *
 * @package PLUGIN_PACKAGE
 */

namespace PLUGIN_PACKAGE;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Main plugin class
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->register_autoloader();
		$this->init_modules();
	}

	/**
	 * Register autoloader
	 */
	private function register_autoloader() {
		require_once PLUGIN_CONSTANT_PATH . 'includes/class-autoloader.php';

		Autoloader::run();
	}

	/**
	 * Instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initializes modules
	 */
	private function init_modules() {
		if ( is_admin() ) {
			// Plugin admin module.
			new \PLUGIN_PACKAGE\Admin\Admin();
		}
	}
}

Plugin::instance();
