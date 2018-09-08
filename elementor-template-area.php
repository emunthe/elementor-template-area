<?php
/**
 * Plugin Name: Elementor Template Area
 * Description: Elementor Template Area.  This plugin is a method of using elementor
 * Plugin URI:  http://espenmunthe.com
 * Version:     0.1.0
 * Author:      Espen Munthe
 * Author URI:  http://espenmunthe.com
 * Text Domain: template-area
 */

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

define('__ELEMENTOR_TEMPLATE_AREA_FILE__', __FILE__);
define('__ELEMENTOR_TEMPLATE_AREA_VERSION', 0.1);



function elementor_template_area_fail_load()
{
    $class = 'notice notice-error';
    $message = __('Load failed', 'template-area');

    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}

function elementor_template_area_fail_load_out_of_date()
{
    $class = 'notice notice-error';
    $message = __('Out of date.', 'f');

    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}

/**
 * Load Simple Switcher
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function elementor_template_area_load()
{
    // Load localization file
    load_plugin_textdomain('template-area');

    // Notice if the Elementor is not active
    if (! did_action('elementor/loaded')) {
        add_action('admin_notices', 'elementor_template_area_fail_load');
        return;
    }

    // Check required version
    $elementor_version_required = '1.7.0';
    if (! version_compare(ELEMENTOR_VERSION, $elementor_version_required, '>=')) {
        add_action('admin_notices', 'elementor_template_area_fail_load_out_of_date');
        return;
    }

    // Require the main plugin file
    require(__DIR__ . '/plugin.php');
}
add_action('plugins_loaded', 'elementor_template_area_load');
