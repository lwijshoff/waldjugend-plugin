<?php
function waldjugend_header_text() {
    // Get the group from options
    $group = get_option('waldjugend_group');

    // Return the group if set, otherwise default to 'Horst Musterstadt'
    return !empty($group) ? esc_html($group) : esc_html('Horst Musterstadt');
}