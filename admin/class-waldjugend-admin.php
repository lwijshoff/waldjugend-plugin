<?php

class Waldjugend_Admin {

    public function init() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('update_option_waldjugend_type', [$this, 'maybe_sync_group_with_association'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

        $theme_to_check = WJ_THEME_SLUG;
        $installed_themes = wp_get_themes();
        if ( ! isset( $installed_themes[ $theme_to_check ] ) ) {
            Admin_Notices::notice(
                sprintf(
                    __('Please install the %s to use the %ss features.', WJ_PLUGIN_TEXTDOMAIN),
                    '<a href="' . WJ_THEME_GITHUB_URL . '" target="_blank">' . WJ_THEME_NAME . '</a>',
                    WJ_PLUGIN_NAME,
                ),
                'error',
                false
            );
        } elseif ( wp_get_theme()->get_stylesheet() !== $theme_to_check ) {
            Admin_Notices::notice(
                sprintf(
                    __('Please activate the %s to use the %ss features.', WJ_PLUGIN_TEXTDOMAIN),
                    '<a href="' . admin_url('themes.php') . '">' . WJ_THEME_NAME . '</a>',
                    WJ_PLUGIN_NAME
                ),
                'warning',
                false
            );
        }
    }

    public function add_admin_menu() {
        add_theme_page(
            'Waldjugend',
            'Waldjugend Theme Settings',
            'manage_options',
            WJ_PLUGIN_SLUG,
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

        register_setting(
            'waldjugend_config_group',
            'nirvana_settings',
            [
                'sanitize_callback' => [ $this, 'sanitize_nirvana_settings' ]
            ]
        );
    }

    public function maybe_sync_group_with_association($old_value, $new_value) {
        if ($new_value === 'association') {
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
        $expected_hook = 'appearance_page_' . WJ_PLUGIN_SLUG;

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

    /**
     * Sanitizes new Nirvana social settings before saving to the database.
     *
     * This function retrieves the existing 'nirvana_settings' from the database,
     * keeps all existing values as they are, and only sanitizes the keys present
     * in the new input. Sanitization is applied based on the key names:
     *
     * - Keys containing 'link' are treated as URLs and sanitized with `esc_url_raw`.
     * - Keys containing 'target' are expected to be '1' (open in new tab) or empty; any other value is discarded.
     * - All other keys (like network names or titles) are sanitized with `sanitize_text_field`.
     *
     * Existing settings not present in the new input remain unchanged. Only new or updated
     * values from `$input` overwrite the old ones after sanitization.
     *
     * Example input:
     * [
     *     'nirvana_social1' => 'Instagram',
     *     'nirvana_social2' => 'https://www.instagram.com/waldjugend',
     *     'nirvana_social_title1' => 'Deutsche Waldjugend',
     *     'nirvana_social_target1' => '1',
     *     ...
     * ]
     *
     * @param array $input The raw $_POST['nirvana_settings'] array.
     * @return array The sanitized array ready to be stored with update_option().
     */
    function sanitize_nirvana_settings($input) {
        $old_settings = get_option('nirvana_settings', []);
        $clean = $old_settings; // start with existing values

        foreach ($input as $key => $value) {
            if (str_contains($key, 'link')) {
                $clean[$key] = esc_url_raw($value);
            } elseif (str_contains($key, 'target')) {
                // normalize checkbox: if it's "1" keep it, else force "0"
                $clean[$key] = ($value === '1') ? '1' : '0';
            } else {
                $clean[$key] = sanitize_text_field($value);
            }
        }

        // Now also make sure that *any* target key in $old_settings that didn’t
        // come through the POST is set to "0"
        foreach ($old_settings as $key => $value) {
            if (str_contains($key, 'target') && !isset($input[$key])) {
                $clean[$key] = '0';
            }
        }

        return $clean;
    }

    /**
     * Render a social network field.
     * This function is used to render each social network input field in the admin settings page.
     *
     * @param int $i The index of the social network field (0-4).
     */
    public function render_social_field($i) {
        // Load saved settings
        $options = get_option('nirvana_settings', []);

        // Use Nirvana's array if it exists, if it doesn't, well fuck.
        global $nirvana_socialNetworks;

        $networks = $nirvana_socialNetworks;

        // Map $i to Nirvana's key pattern
        $network_key = 'nirvana_social' . ($i * 2 - 1);
        $link_key    = 'nirvana_social' . ($i * 2);
        $title_key   = 'nirvana_social_title' . ($i * 2 - 1);
        $target_key  = 'nirvana_social_target' . ($i * 2 - 1);

        $current_network = $options[$network_key] ?? 'none';
        $current_link    = $options[$link_key] ?? '';
        $current_target  = $options[$target_key] ?? '0';
        $current_title   = $options[$title_key] ?? '';
        ?>
        
        <select name="nirvana_settings[<?php echo esc_attr($network_key); ?>]">
            <?php foreach ($networks as $network): ?>
                <option value="<?php echo esc_attr($network); ?>" <?php selected($current_network, $network); ?>>
                    <?php echo esc_html($network); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text"
            name="nirvana_settings[<?php echo esc_attr($link_key); ?>]"
            value="<?php echo esc_attr($current_link); ?>"
            placeholder="<?php esc_attr_e('Link zum Netzwerk', 'your-textdomain'); ?>" />

        <label>
            <input type="checkbox"
                name="nirvana_settings[<?php echo esc_attr($target_key); ?>]"
                value="1"
                <?php checked($current_target, '1'); ?> />
            <?php esc_html_e('In neuem Tab öffnen', 'your-textdomain'); ?>
        </label>

        <input type="text"
            name="nirvana_settings[<?php echo esc_attr($title_key); ?>]"
            value="<?php echo esc_attr($current_title); ?>"
            placeholder="<?php esc_attr_e('Titel (Tooltip)', 'your-textdomain'); ?>" />
        <?php
    }
}
?>