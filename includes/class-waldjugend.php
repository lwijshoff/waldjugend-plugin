<?php

class Waldjugend {

    public function run() {
        if (is_admin()) {
            require_once plugin_dir_path(__DIR__) . 'admin/class-waldjugend-admin.php';
            $admin = new Waldjugend_Admin();
            $admin->init();
        }
        if (!is_admin()) {
            require_once plugin_dir_path(__DIR__) . 'public/class-waldjugend-public.php';
            require_once plugin_dir_path(__DIR__) . 'public/partials/footer.php';

            $public = new Waldjugend_Public();
            $public->init();
        }
    }    
}