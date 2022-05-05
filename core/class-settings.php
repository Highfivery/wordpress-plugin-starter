<?php
/**
 * Settings class
 *
 * @package PLUGIN_PACKAGE
 */

namespace PLUGIN_PACKAGE\Core;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Settings
 */
class Settings {

	/**
	 * Settings
	 *
	 * @var Settings
	 */
	public static $settings = array();

	/**
	 * Sections
	 *
	 * @var Sections
	 */
	public static $sections = array();

	/**
	 * Returns the plugin setting sections
	 */
	public static function get_sections() {
		/*
		Example Setting Section

		self::$sections['general'] = array(
			'title' => __( 'General Settings', 'PLUGIN_TEXT_DOMAIN' ),
		);
		*/

		return apply_filters( 'FUNCTION_PREFIX_setting_sections', self::$sections );
	}

	/**
	 * Returns the plugin settings.
	 *
	 * @param string $key Setting key to retrieve.
	 */
	public static function get_settings( $key = false ) {
		$options = get_option( 'FUNCTION_PREFIX' );

		/*
		HTML Setting Example

		self::$settings['setting_key'] = array(
			'title'   => __( 'Setting Title', 'PLUGIN_TEXT_DOMAIN' ),
			'desc'    => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'section' => 'general',
			'type'    => 'html',
			'html'    => sprintf(
				wp_kses(
					__( 'HTML', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
		);
		*/

		/*
		Checkbox Setting Example

		self::$settings['setting_key'] = array(
			'title'       => __( 'Setting Title', 'PLUGIN_TEXT_DOMAIN' ),
			'section'     => 'general',
			'type'        => 'checkbox',
			'options'     => array(
				'key1' => sprintf(
					wp_kses(
						__( 'Value 1', 'PLUGIN_TEXT_DOMAIN' ),
						array()
					)
				),
				'key2' => sprintf(
					wp_kses(
						__( 'Value 2', 'PLUGIN_TEXT_DOMAIN' ),
						array()
					)
				),
			),
			'value'       => ! empty( $options['setting_key'] ) ? $options['setting_key'] : false,
		);
		*/

		/*
		Example Select Settong

		self::$settings['setting_key'] = array(
			'title'       => __( 'Setting Title', 'PLUGIN_TEXT_DOMAIN' ),
			'section'     => 'general',
			'type'        => 'select',
			'desc'        => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'options'     => array(
				'key1' => sprintf(
					wp_kses(
						__( 'Value 1', 'PLUGIN_TEXT_DOMAIN' ),
						array()
					)
				),
				'key2' => sprintf(
					wp_kses(
						__( 'Value 2', 'PLUGIN_TEXT_DOMAIN' ),
						array()
					)
				),
			),
			'value'       => ! empty( $options['setting_key'] ) ? $options['setting_key'] : false,
			'multiple'    => true,
		);
		*/

		/*
		Example Radio Setting

		self::$settings['setting_key'] = array(
			'title'       => __( 'Setting Title', 'PLUGIN_TEXT_DOMAIN' ),
			'desc'        => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'section'     => 'general',
			'type'        => 'radio',
			'options'     => array(
				'key1' => sprintf(
					wp_kses(
						__( 'Value 1', 'PLUGIN_TEXT_DOMAIN' ),
						array()
					)
				),
				'key2' => sprintf(
					wp_kses(
						__( 'Value 2', 'PLUGIN_TEXT_DOMAIN' ),
						array()
					)
				),
			),
			'value'       => ! empty( $options['setting_key'] ) ? $options['setting_key'] : false,
		);
		*/

		/*
		Example Text/URL/Number/Textarea Setting

		self::$settings['setting_key'] = array(
			'title'       => __( 'Setting Title', 'PLUGIN_TEXT_DOMAIN' ),
			'desc'        => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'section'     => 'general',
			'type'        => 'text', // text, url, number, textarea
			'field_class' => 'large-text', // large-text, small-text, regular-text, code
			'placeholder' => __( 'Placeholder text', 'PLUGIN_TEXT_DOMAIN' ),
			'value'       => ! empty( $options['setting_key'] ) ? $options['setting_key'] : false,
		);
		*/

		$settings = apply_filters( 'FUNCTION_PREFIX_settings', self::$settings, $options );

		if ( $key ) {
			if ( ! empty( $settings[ $key ]['value'] ) ) {
				return $settings[ $key ]['value'];
			}

			return false;
		}

		return $settings;
	}
}
