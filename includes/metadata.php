<?php
/**
 * Define a constant only if it hasn't been defined yet.
 * Or if it needs to be updated.
 *
 * @param string $name  The name of the constant.
 * @param mixed  $value The value of the constant.
 */
function wj_plugin_define( $name, $value ) {
    if ( ! defined( $name ) ) {
        define( $name, $value );
    }
}

// GitHub info
wj_plugin_define( 'WJ_AUTHOR_NAME', 'Leonard Wijshoff' );
wj_plugin_define( 'WJ_GITHUB_USER', 'lwijshoff' );
wj_plugin_define( 'WJ_GITHUB_URL', 'https://github.com/' . WJ_GITHUB_USER );

// Theme info
wj_plugin_define( 'WJ_THEME_NAME', 'Waldjugend Theme' );
wj_plugin_define( 'WJ_THEME_SLUG', 'waldjugend-theme' );
wj_plugin_define( 'WJ_THEME_GITHUB_REPO', WJ_THEME_SLUG );
wj_plugin_define( 'WJ_THEME_GITHUB_URL', WJ_GITHUB_URL . '/' . WJ_THEME_GITHUB_REPO );

// Other plugin metadata
wj_plugin_define( 'WJ_PLUGIN_NAME', 'Waldjugend Plugin' );
wj_plugin_define( 'WJ_PLUGIN_SLUG', 'waldjugend-plugin' );
wj_plugin_define( 'WJ_PLUGIN_GITHUB_REPO', WJ_PLUGIN_SLUG );
wj_plugin_define( 'WJ_PLUGIN_GITHUB_URL', WJ_GITHUB_URL . '/' . WJ_PLUGIN_GITHUB_REPO );
wj_plugin_define( 'WJ_PLUGIN_TEXTDOMAIN', WJ_PLUGIN_SLUG );