<?php
if (!defined('ABSPATH')) exit; // prevent direct access

/**
 * Class Admin_Notices
 *
 * Handles all admin notices for the Waldjugend plugin.
 * Allows adding standard WordPress notices (success, warning, error, info)
 * and custom HTML notices that can appear anywhere in the admin.
 */
class Admin_Notices {

    /**
     * Temporarily stores notices before rendering
     *
     * @var array
     */
    private static $notices = [];

    /**
     * Initialize the admin notices system.
     * Hooks rendering and custom CSS into WordPress actions.
     *
     * @return void
     */
    public static function init() {
        add_action('admin_notices', [__CLASS__, 'render_notices']);
        add_action('admin_head', [__CLASS__, 'custom_styles']);
    }

    /**
     * Add a standard WordPress admin notice.
     *
     * @param string $message The text to display in the notice.
     * @param string $type The type of notice: 'success', 'warning', 'error', 'info'. Default 'info'.
     * @param bool $dismissible Whether the notice is dismissible. Default true.
     * @return void
     */
    public static function notice($message, $type = 'info', $dismissible = true) {
        // Validate type
        if (!in_array($type, ['success', 'warning', 'error', 'info'])) {
            $type = 'info';
        }

        self::$notices[] = [
            'message' => $message,
            'type' => $type,
            'dismissible' => $dismissible,
        ];
    }

    /**
     * Add a custom HTML notice.
     *
     * @param string $html_message The HTML content of the notice.
     * @param bool $dismissible Whether the notice is dismissible. Default true.
     * @return void
     */
    public static function custom_notice($html_message, $dismissible = true) {
        self::$notices[] = [
            'message' => $html_message,
            'type' => 'custom',
            'dismissible' => $dismissible,
        ];
    }

    /**
     * Render all stored notices in the WordPress admin.
     * Clears the notice array after rendering so notices do not repeat.
     *
     * @return void
     */
    public static function render_notices() {
        foreach (self::$notices as $notice) {
            $class = 'notice';

            if (in_array($notice['type'], ['success', 'warning', 'error', 'info'])) {
                $class .= ' notice-' . $notice['type'];
            }

            if ($notice['type'] === 'custom') {
                $class .= ' notice-custom';
            }

            if (!empty($notice['dismissible'])) {
                $class .= ' is-dismissible';
            }

            echo '<div class="' . esc_attr($class) . '">';
            if ($notice['type'] === 'custom') {
                echo $notice['message'];
            } else {
                echo '<p>' . wp_kses_post($notice['message']) . '</p>';
            }
            echo '</div>';
        }

        // Clear notices after rendering so they don’t repeat
        self::$notices = [];
    }

    /**
     * Output custom CSS styles for custom HTML notices.
     *
     * @return void
     */
    public static function custom_styles() {
        echo '<style>
            .notice-custom { background-color: #5b9bd5; color: white; border-left: 4px solid #2e75b6; }
            .notice-custom p { margin: 0; }
        </style>';
    }
}