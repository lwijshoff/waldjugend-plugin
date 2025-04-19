<?php
// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clean up individual options
delete_option('waldjugend_type');
delete_option('waldjugend_horst');
delete_option('waldjugend_lvb');
delete_option('waldjugend_lvb_url');
delete_option('imprint_url');
delete_option('cookie_url');
delete_option('privacy_url');
?>