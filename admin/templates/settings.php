<?php
/**
 * Settings
 *
 * @package PLUGIN_PACKAGE
 */

?>

<form action="options.php" method="post">
<?php
// Output security fields for the registered setting "wpzerospam".
settings_fields( 'FUNCTION_PREFIX' );

// Output setting sections and their fields.
do_settings_sections( 'FUNCTION_PREFIX' );

// Output save settings button.
submit_button( 'Save Settings' );
?>
</form>
