<?php
/**
 * @package           waldjugend-plugin
 * @author            Leonard Wijshoff
 * @copyright         2025-present Leonard Wijshoff
 * @license           GPLv3
 * 
 * @wordpress-plugin
 * Plugin Name:       Waldjugend
 * Plugin URI:        https://github.com/lwijshoff/waldjugend-plugin
 * Description:       The Waldjugend Plugin is a utility plugin designed to enhance the customization of theme settings across WordPress installations.
 * Author:            Leonard Wijshoff
 * Author URI:        https://github.com/lwijshoff
 * License:           GPLv3
 * License URI:       https://opensource.org/licenses/GPL-3.0
 * Update URI:        https://github.com/lwijshoff/waldjugend-plugin
 * Text Domain:       waldjugend-plugin
 * Domain Path:       /languages
 * Version:           2.0.0-gamma
 * Requires at least: 5.2
 * Requires PHP:      8.3
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/*--------------------------------------------------------------
# Constants
--------------------------------------------------------------*/
define('WJ_PLUGIN_DIR', plugin_dir_path(__FILE__));

/*--------------------------------------------------------------
# Includes
--------------------------------------------------------------*/
require_once WJ_PLUGIN_DIR . 'includes/metadata.php';
require_once WJ_PLUGIN_DIR . 'includes/class-waldjugend.php';
require 'includes/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

/*--------------------------------------------------------------
# Plugin Update Checker
--------------------------------------------------------------*/
$UpdateChecker = PucFactory::buildUpdateChecker(
    WJ_PLUGIN_GITHUB_URL,
    __FILE__,
    WJ_PLUGIN_SLUG
);
$UpdateChecker->setBranch('main');

/*--------------------------------------------------------------
# Global Variables
--------------------------------------------------------------*/
global $nirvanas;
if (!isset($nirvanas)) {
    $nirvanas = [];
}

/*--------------------------------------------------------------
# Load Plugin Textdomain (Translations)
--------------------------------------------------------------*/
function waldjugend_load_textdomain() {
    load_plugin_textdomain(
        WJ_PLUGIN_SLUG,
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
}
add_action('plugins_loaded', 'waldjugend_load_textdomain');

/*--------------------------------------------------------------
# Plugin Settings Link
--------------------------------------------------------------*/
function waldjugend_settings_link($links) {
    $settings_link = '<a href="themes.php?page=' . WJ_PLUGIN_SLUG . '">' . __( 'Settings', WJ_PLUGIN_SLUG ) . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'waldjugend_settings_link');

/*--------------------------------------------------------------
# Import Waldjugend Customized Nirvana Settings on Activation
# This is a one-time import to set up the plugin with default settings.
--------------------------------------------------------------*/
function nirvana_import_file_on_activation() {
    global $nirvanas;

    // Only run if the option does not already exist
    if (get_option('nirvana_settings') !== false) {
        return;
    }

    $file = WJ_PLUGIN_DIR . 'includes/nirvana-settings.json';

    if (!file_exists($file)) {
        error_log('Nirvana import file not found.');
        return;
    }

    $data = file_get_contents($file);
    if (!$data) {
        error_log('Nirvana import file could not be read.');
        return;
    }

    $settings = json_decode($data, true);
    if (!isset($settings['nirvana_db'])) {
        error_log('Invalid Nirvana settings file.');
        return;
    }

    // Merge with defaults
    $settings = array_merge($nirvanas, $settings);
    add_option('nirvana_settings', $settings);
}
register_activation_hook(__FILE__, 'nirvana_import_file_on_activation');

/*--------------------------------------------------------------
# Initialize Plugin
--------------------------------------------------------------*/
function run_waldjugend_plugin() {
    $plugin = new Waldjugend();
    $plugin->run();
}
run_waldjugend_plugin();