<?php

class Waldjugend {

    public function run() {
        if (is_admin()) {
            require_once plugin_dir_path(__DIR__) . 'admin/class-waldjugend-admin.php';
            $admin = new Waldjugend_Admin();
            $admin->init();
        }
        if (!is_admin() && is_front_page()) {
            require_once plugin_dir_path(__DIR__) . 'public/class-waldjugend-public.php';
            require_once plugin_dir_path(__DIR__) . 'public/partials/helpers.php'; // Include helper functions here

            $public = new Waldjugend_Public();
            $public->init();

            // Store globally so your theme can access it
            $GLOBALS['waldjugend_public'] = $public;
        }
    }    
}