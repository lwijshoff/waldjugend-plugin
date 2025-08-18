<?php
/**
 * Plugin Name:       Waldjugend
 * 
 * @package           waldjugend-plugin
 * @author            Leonard Wijshoff
 * @copyright         2025-present Leonard Wijshoff
 * @license           MIT
 * 
 * @wordpress-plugin
 * Plugin Name:       Waldjugend
 * Plugin URI:        https://github.com/lwijshoff/waldjugend-plugin
 * Description:       The Waldjugend Plugin is a utility plugin designed to enhance the customization of theme settings across WordPress installations.
 * Author:            Leonard Wijshoff
 * Author URI:        https://github.com/lwijshoff
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Update URI:        https://github.com/lwijshoff/waldjugend-plugin
 * Text Domain:       waldjugend-plugin
 * Domain Path:       /languages
 * Version:           2.0.0-alpha
 * Requires at least: 5.2
 * Requires PHP:      8.3
 */

if (!defined('ABSPATH')) { // Exit if accessed directly.
    exit;
}

define('WALDJUGEND_PLUGIN_VERSION', '2.0.0-alpha');
define('WALDJUGEND_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WALDJUGEND_PLUGIN_SLUG', 'waldjugend-plugin');

// TODO: Add translations
// Load plugin textdomain for translations
function waldjugend_load_textdomain() {
    load_plugin_textdomain(
        WALDJUGEND_PLUGIN_SLUG,
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
}
add_action('plugins_loaded', 'waldjugend_load_textdomain');

// Core plugin class
require_once WALDJUGEND_PLUGIN_DIR . 'includes/class-waldjugend.php';

function waldjugend_get_config($key) {
    $defaults = [
        'waldjugend_group' => 'Horst Musterstadt',
        'waldjugend_association' => 'Landesverband Musterland e.V.',
        'waldjugend_association_url' => 'www.waldjugend-musterland.de',
    ];

    $options = [
        'waldjugend_group' => get_option('waldjugend_group', $defaults['waldjugend_group']),
        'waldjugend_association' => get_option('waldjugend_association', $defaults['waldjugend_association']),
        'waldjugend_association_url' => get_option('waldjugend_association_url', $defaults['waldjugend_association_url']),
    ];

    return $options[$key] ?? null;
}

function run_waldjugend_plugin() {
    $plugin = new Waldjugend();
    $plugin->run();
}
run_waldjugend_plugin();

// Updating functionality
require 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/lwijshoff/waldjugend-plugin/',
	__FILE__,
	'waldjugend-plugin'
);

// Set the branch that contains the stable release.
$UpdateChecker->setBranch('main');
?>
