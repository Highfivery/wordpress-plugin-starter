# WordPress Plugin Starter

> This is the official WordPress plugin starter framework for Highfivery. The purpose behind it is to improve the quality of the experiences we build as well as to standardize in order to facilitate more effective collaboration.

[![Support Level](https://img.shields.io/badge/support-active-green.svg)](#support-level) [![MIT License](https://img.shields.io/github/license/Highfivery/wordpress-plugin-starter.svg)](https://github.com/Highfivery/wordpress-plugin-starter/blob/main/LICENSE)

## Contributions

We don't know everything! We welcome pull requests and spirited debates :)

## Creating a New Plugin

```
./setup.sh
```

### Register Plugin Settings

```
/**
 * Register settings
 *
 * @param array $settings Registered settings.
 */
function register_sections( $settings ) {
  $sections['reference_key'] = array(
    'option_group' => 'option_group_name',
    'option_name'  => 'db_key',
  );

  return $settings;
}

add_filter( 'FUNCTION_PREFIX_settings', 'register_sections', 10, 1 );
```

### Adding a Setting Sections

```
/**
 * Register sections
 *
 * @param array $sections Registered sections.
 */
function register_sections( $sections ) {
  $sections['new_section'] = array(
    'title' => __( 'Section Name', 'PLUGIN_TEXT_DOMAIN' ),
    'page'  => 'page_slug',
  );

  return $sections;
}

add_filter( 'FUNCTION_PREFIX_setting_sections', 'register_sections', 10, 1 );
```

### Adding a Setting Field

```
function register_setting_fields( $settings_fields ) {
  $settings_fields['setting_key'] = array(
    'title'       => __( 'Setting Title', 'PLUGIN_TEXT_DOMAIN' ),
    'desc'        => sprintf(
      wp_kses(
        __( 'Setting description', 'PLUGIN_TEXT_DOMAIN' ),
        array()
      )
    ),
    'page'        => 'page_slude',
    'section'     => 'new_section',
    'option_name' => 'db_key',
    'type'        => 'text', // text, url, number, textarea.
    'field_class' => 'large-text', // large-text, medium-text, small-text, regular-text, code.
    'placeholder' => __( 'Placeholder text', 'PLUGIN_TEXT_DOMAIN' ),
    'value'       => ! empty( $options['setting_key'] ) ? $options['setting_key'] : false,
  );

  return $settings_fields;
}

add_filter( 'FUNCTION_PREFIX_settings_fields', 'register_setting_fields', 10, 1 );
```

## Support Level

**Active:** Highfivery is actively working on this, and we expect to continue work for the foreseeable future including keeping tested up to the most recent WordPress versions. Bug reports, feature requests, questions, and pull requests are welcome.
