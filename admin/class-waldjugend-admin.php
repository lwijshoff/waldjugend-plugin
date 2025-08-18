<?php

class Waldjugend_Admin {

    public function init() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('update_option_waldjugend_type', [$this, 'maybe_sync_horst_with_association'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    public function add_admin_menu() {
        add_theme_page(
            'Waldjugend',
            'Waldjugend Theme Settings',
            'manage_options',
            WALDJUGEND_PLUGIN_SLUG,
            [$this, 'display_admin_page']
        );
    }

    public function register_settings() {
        register_setting('waldjugend_config_group', 'waldjugend_type');
        register_setting('waldjugend_config_group', 'waldjugend_group');
        register_setting('waldjugend_config_group', 'waldjugend_association');
        register_setting('waldjugend_config_group', 'waldjugend_association_url');
        register_setting('waldjugend_config_group', 'waldjugend_imprint_url');
        register_setting('waldjugend_config_group', 'waldjugend_cookie_url');
        register_setting('waldjugend_config_group', 'waldjugend_privacy_url');
        register_setting('waldjugend_config_group', 'waldjugend_gtc_url');
        register_setting('waldjugend_config_group', 'waldjugend_address_street');
        register_setting('waldjugend_config_group', 'waldjugend_address_place');
        register_setting('waldjugend_config_group', 'waldjugend_contact_email');
        register_setting('waldjugend_config_group', 'waldjugend_contact_number');
    }

    public function maybe_sync_group_with_association($old_value, $new_value) {
        if ($new_value === 'verein') {
            $association = get_option('waldjugend_association');
            if (!empty($association)) {
                update_option('waldjugend_group', $association); // Sync association name with group
            }
        }
    }    

    public function display_admin_page() {
        include plugin_dir_path(__DIR__) . 'admin/partials/waldjugend-admin-display.php';
    }

    public function enqueue_admin_scripts($hook) {
        // Use theme_page_ prefix because of add_theme_page()
        $expected_hook = 'appearance_page_' . WALDJUGEND_PLUGIN_SLUG;

        if ($hook !== $expected_hook) {
            return;
        }

        // Enqueue JS
        wp_enqueue_script(
            'waldjugend-admin-partials',
            plugin_dir_url(__FILE__) . 'partials/js/partials.js',
            array(),
        );

        // Enqueue CSS
        wp_enqueue_style(
            'waldjugend-admin-styles',
            plugin_dir_url(__FILE__) . 'partials/css/partials.css',
            array(),
        );
    }
}
?>