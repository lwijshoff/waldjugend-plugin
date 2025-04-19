<?php

function waldjugend_generate_footer_html() {
    /**
     * Generates HTML footer content.
     */
    $type = get_option('waldjugend_type', 'ortsgruppe');
    $horst = get_option('waldjugend_horst', 'Horst Musterstadt');
    $lvb = get_option('waldjugend_lvb', 'Landesverband Musterland e.V.');
    $lvb_url = get_option('waldjugend_lvb_url', 'www.waldjugend-musterland.de');
    $year = date('Y');

    // Fetching the options for "Cookie-Richtlinien", "Impressum", and "Datenschutz"
    $cookie_url = get_option('cookie_url', false);
    $imprint_url = get_option('imprint_url', false);
    $privacy_url = get_option('privacy_url', false);

    // Building the footer text with options if set
    $footer_text = '';

    if ($type === 'ortsgruppe') {
        $footer_text .= sprintf(
            'Die Waldjugend %s ist eine Ortsgruppe der <a href="//%s">%s</a>',
            esc_html($horst),
            esc_attr($lvb_url),
            esc_html($lvb)
        );
    } else {
        $footer_text .= sprintf(
            '&copy; %s Deutsche Waldjugend %s',
            esc_html($year),
            esc_html($lvb)
        );
    }

    // Add links to the footer text with hyphens if the options are set
    $links = [];
    if ($imprint_url) {
        $links[] = '<a href="' . esc_url($imprint_url) . '">Impressum</a>';
    }
    if ($cookie_url) {
        $links[] = '<a href="' . esc_url($cookie_url) . '">Cookie-Richtlinien</a>';
    }
    if ($privacy_url) {
        $links[] = '<a href="' . esc_url($privacy_url) . '">Datenschutz</a>';
    }

    if (!empty($links)) {
        $footer_text .= ' - ' . implode(' - ', $links);
    }

    return $footer_text;
}
