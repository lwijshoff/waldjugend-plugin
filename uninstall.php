<?php
// If uninstall not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Define all plugin options to be deleted (class-waldjugend-admin.php)
$options = [
    'waldjugend_type',
    'waldjugend_group',
    'waldjugend_association',
    'waldjugend_association_url',
    'waldjugend_imprint_url',
    'waldjugend_cookie_url',
    'waldjugend_privacy_url',
    'waldjugend_gtc_url',
    'waldjugend_address_street',
    'waldjugend_address_place',
    'waldjugend_contact_email',
    'waldjugend_contact_number',
];

foreach ( $options as $option ) {
    delete_option( $option );
}