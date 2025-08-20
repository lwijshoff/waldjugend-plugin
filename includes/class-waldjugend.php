<?php

class Waldjugend {

    public function run() {
        if (is_admin()) {
            require_once plugin_dir_path(__DIR__) . 'admin/class-waldjugend-admin.php';
            require_once plugin_dir_path(__DIR__) . 'admin/class-waldjugend-admin-notices.php';

            $admin = new Waldjugend_Admin();
            $admin->init();

            Admin_Notices::init();
        }
        require_once plugin_dir_path(__DIR__) . 'includes/footer.php';
        require_once plugin_dir_path(__DIR__) . 'includes/header.php';
    }    
}