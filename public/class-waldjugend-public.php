<?php

class Waldjugend_Public {

    public function generate_footer_html() {
        $type = get_option('waldjugend_type', 'ortsgruppe');
        $horst = get_option('waldjugend_horst', 'Horst Musterstadt');
        $lvb = get_option('waldjugend_lvb', 'Landesverband Musterland e.V.');
        $lvb_url = get_option('waldjugend_lvb_url', 'www.waldjugend-musterland.de');
        $year = date('Y');

        // Fetching the options for "Cookie-Richtlinien", "Impressum", and "Datenschutz"
        $cookie_richtlinien = get_option('waldjugend_cookie_richtlinien', false);
        $impressum = get_option('waldjugend_impressum', false);
        $datenschutz = get_option('waldjugend_datenschutz', false);

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
        if ($impressum) {
            $links[] = '<a href="' . esc_url($impressum) . '">Impressum</a>';
        }
        if ($cookie_richtlinien) {
            $links[] = '<a href="' . esc_url($cookie_richtlinien) . '">Cookie-Richtlinien</a>';
        }
        if ($datenschutz) {
            $links[] = '<a href="' . esc_url($datenschutz) . '">Datenschutz</a>';
        }

        if (!empty($links)) {
            $footer_text .= ' - ' . implode(' - ', $links);
        }

        return $footer_text;
    }
}
