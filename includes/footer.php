<?php
/**
 * The footer for Waldjugend theme.
 *
 * Built based on input from the users input in the admin panel.
 *
 * @package waldjugend-theme
 * @since 2.0.0
 * @author Leonard Wijshoff
 */

// --- Generate contact & links columns for the main footer ---
function waldjugend_generate_main_footer_html() {
    $html = '';

    // Wrap both columns in a flex container
    $html .= '<div class="footer-columns">';

    // Collect contact details
    $contact = [];
    $street  = get_option('waldjugend_address_street', '');
    $place   = get_option('waldjugend_address_place', '');
    $email   = get_option('waldjugend_contact_email', '');
    $phone   = get_option('waldjugend_contact_number', '');

    if ($street) $contact[] = esc_html($street);
    if ($place)  $contact[] = esc_html($place);
    if ($email)  $contact[] = '<a class="main-footer-link" href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
    if ($phone)  $contact[] = 'tel: ' . esc_html($phone);

    if (!empty($contact)) {
        $html .= '<div class="column">';
        $html .= '<h3 class="menu-line">Kontakt</h3><ul>';
        foreach ($contact as $item) {
            $html .= '<p>' . $item . '</p>';
        }
        $html .= '</ul></div>';
    }

    // Collect links
    $links = [];
    $imprint_url = get_option('waldjugend_imprint_url', '');
    $cookie_url  = get_option('waldjugend_cookie_url', '');
    $privacy_url = get_option('waldjugend_privacy_url', '');
    $gtc_url     = get_option('waldjugend_gtc_url', '');

    if ($imprint_url) $links[] = '<a class="main-footer-link" href="' . esc_url($imprint_url) . '">Impressum</a>';
    if ($cookie_url)  $links[] = '<a class="main-footer-link" href="' . esc_url($cookie_url) . '">Cookie-Richtlinien</a>';
    if ($privacy_url) $links[] = '<a class="main-footer-link" href="' . esc_url($privacy_url) . '">Datenschutz</a>';
    if ($gtc_url)     $links[] = '<a class="main-footer-link" href="' . esc_url($gtc_url) . '">AGB</a>';

    if (!empty($links)) {
        $html .= '<div class="column">';
        $html .= '<h3 class="menu-line">Links</h3><ul>';
        foreach ($links as $link) {
            $html .= '<p>' . $link . '</p>';
        }
        $html .= '</ul></div>';
    }

    $html .= '</div>'; // close footer-columns wrapper

    return $html;
}

// --- Generate footer HTML with all links and contact info ---
function waldjugend_generate_bottom_footer_html() {
    $year = date('Y');

    // Get options with sane defaults
    $type             = get_option('waldjugend_type', false);
    $group            = get_option('waldjugend_group', 'Horst Musterstadt');
    $association      = get_option('waldjugend_association', 'Bundesverband e.V.');
    $association_url  = get_option('waldjugend_association_url', 'www.waldjugend.de');

    // --- Build bottom footer ---
    $footer_text = '';

    if ($type === 'group' && $group && $association) {
        $footer_text = sprintf(
            '&copy; %s Deutsche Waldjugend %s - Teil vom <a href="%s">%s</a>',
            esc_html($year),
            esc_html($group),
            esc_url($association_url),
            esc_html($association)
        );
    } elseif ($type === 'association' && $association) {
        $footer_text = sprintf(
            '&copy; %s Deutsche Waldjugend %s',
            esc_html($year),
            esc_html($association)
        );
    } else {
        $footer_text = sprintf(
            '&copy; %s <a href="%s">%s</a>',
            esc_html($year),
            esc_url(WJ_GITHUB_URL),
            esc_html(WJ_AUTHOR_NAME)
        );
    }

    return $footer_text;
}