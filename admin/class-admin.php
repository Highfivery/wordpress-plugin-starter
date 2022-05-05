<?php
/**
 * Admin class
 *
 * @package PLUGIN_PACKAGE
 */

namespace PLUGIN_PACKAGE\Admin;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Admin
 */
class Admin {
	/**
	 * Constructor
	 */
	public function __construct() {
		new \PLUGIN_PACKAGE\Admin\Settings();
	}
}
