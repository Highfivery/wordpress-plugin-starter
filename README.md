# WordPress Plugin Starter

> This is the official WordPress plugin starter framework for Highfivery. The purpose behind it is to improve the quality of the experiences we build as well as to standardize in order to facilitate more effective collaboration.

[![Support Level](https://img.shields.io/badge/support-active-green.svg)](#support-level) [![MIT License](https://img.shields.io/github/license/Highfivery/wordpress-plugin-starter.svg)](https://github.com/Highfivery/wordpress-plugin-starter/blob/main/LICENSE)

## Contributions

We don't know everything! We welcome pull requests and spirited debates :)

## Creating a New Plugin

```
./setup.sh
```

### Adding a Setting

```
add_filter( 'FUNCTION_PREFIX_settings', array( $this, 'add_setting' ), 10, 1 );
function add_setting( $settings ) {
  $sections['reference_key'] = array(
    'option_group' => 'option_group_name',
    'option_name'  => 'db_key',
  );

  return $settings;
}
```

### Adding a Setting Sections

```
add_filter( 'FUNCTION_PREFIX_setting_sections', 'add_section', 10, 1 );
function add_section( $sections ) {
  $sections['new_section'] = array(
    'title' => __( 'Section Name', 'PLUGIN_TEXT_DOMAIN' ),
    'page'  => 'page_slug',
  );

  return $sections;
}
```

## Support Level

**Active:** Highfivery is actively working on this, and we expect to continue work for the foreseeable future including keeping tested up to the most recent WordPress versions. Bug reports, feature requests, questions, and pull requests are welcome.
