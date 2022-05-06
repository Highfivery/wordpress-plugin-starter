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
	 * @var array $settings Registered plugin settings.
	 */
	public static $settings = array();

	/**
	 * Settings fields
	 *
	 * @var array $settings Settings fields.
	 */
	public static $settings_fields = array();

	/**
	 * Sections
	 *
	 * @var array $sections Registered plugin setting sections.
	 */
	public static $sections = array();

	/**
	 * Returns the plugin setting sections
	 */
	public static function get_sections() {
		self::$sections['GENERAL'] = array(
			'title' => __( 'General Settings', 'PLUGIN_TEXT_DOMAIN' ),
			'page'  => 'SETTINGS',
		);

		return apply_filters( 'FUNCTION_PREFIX_setting_sections', self::$sections );
	}

	/**
	 * Returns the plugin's registered settings
	 */
	public static function get_settings() {
		self::$settings['REFERENCE_KEY'] = array(
			'option_group' => 'FUNCTION_PREFIX',
			'option_name'  => 'OPTION_NAME',
		);

		$settings = apply_filters( 'FUNCTION_PREFIX_settings', self::$settings );

		return $settings;
	}

	/**
	 * Returns the plugin settings fields
	 *
	 * @param string $key Setting key to retrieve.
	 */
	public static function get_settings_fields( $key = false ) {
		$options = array();

		self::$settings_fields['setting_key_1'] = array(
			'title'        => __( 'Setting Title 1', 'PLUGIN_TEXT_DOMAIN' ),
			'desc'         => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'page'        => 'SETTINGS',
			'section'     => 'GENERAL',
			'type'        => 'html',
			'html'        => sprintf(
				wp_kses(
					__( 'HTML', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
		);

		self::$settings_fields['setting_key_2'] = array(
			'title'       => __( 'Setting Title 2', 'PLUGIN_TEXT_DOMAIN' ),
			'page'        => 'SETTINGS',
			'section'     => 'GENERAL',
			'option_name' => 'OPTION_NAME',
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
			'value'       => ! empty( $options['setting_key_2'] ) ? $options['setting_key_2'] : false,
		);

		self::$settings_fields['setting_key_3'] = array(
			'title'       => __( 'Setting Title 3', 'PLUGIN_TEXT_DOMAIN' ),
			'page'        => 'SETTINGS',
			'section'     => 'GENERAL',
			'option_name' => 'OPTION_NAME',
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
			'value'       => ! empty( $options['setting_key_3'] ) ? $options['setting_key_3'] : false,
			'multiple'    => true,
		);

		self::$settings_fields['setting_key_4'] = array(
			'title'       => __( 'Setting Title 4', 'PLUGIN_TEXT_DOMAIN' ),
			'desc'        => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'page'        => 'SETTINGS',
			'section'     => 'GENERAL',
			'option_name' => 'OPTION_NAME',
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
			'value'       => ! empty( $options['setting_key_4'] ) ? $options['setting_key_4'] : false,
		);

		self::$settings_fields['setting_key_5'] = array(
			'title'       => __( 'Setting Title 5', 'PLUGIN_TEXT_DOMAIN' ),
			'desc'        => sprintf(
				wp_kses(
					__( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
					array()
				)
			),
			'page'        => 'SETTINGS',
			'section'     => 'GENERAL',
			'option_name' => 'OPTION_NAME',
			'type'        => 'text', // text, url, number, textarea.
			'field_class' => 'large-text', // large-text, medium-text, small-text, regular-text, code.
			'placeholder' => __( 'Placeholder text', 'PLUGIN_TEXT_DOMAIN' ),
			'value'       => ! empty( $options['setting_key_5'] ) ? $options['setting_key_5'] : false,
		);

		$settings_fields = apply_filters( 'FUNCTION_PREFIX_settings_fields', self::$settings_fields );

		if ( $key ) {
			if ( ! empty( $settings_fields[ $key ]['value'] ) ) {
				return $settings_fields[ $key ]['value'];
			}

			return false;
		}

		return $settings_fields;
	}
}
