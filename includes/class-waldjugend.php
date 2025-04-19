<?php

class Waldjugend {

    public function run() {
        if (is_admin()) {
            require_once plugin_dir_path(__DIR__) . 'admin/class-waldjugend-admin.php';
            $admin = new Waldjugend_Admin();
            $admin->init();
        }
        require_once plugin_dir_path(__DIR__) . 'includes/footer.php';
    }    
}