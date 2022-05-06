<?php
/**
 * Settings
 *
 * @package PLUGIN_PACKAGE
 */

?>

<form action="options.php" method="post">
<?php
// Output security fields for the registered setting "FUNCTION_PREFIX".
settings_fields( \PLUGIN_PACKAGE\Admin\Settings::$settings_key );

// Output setting sections and their fields.
do_settings_sections( \PLUGIN_PACKAGE\Admin\Settings::$settings_key );

// Output save settings button.
submit_button( __( 'Save Settings', 'PLUGIN_TEXT_DOMAIN' ) );
?>
</form>
