<div class="wrap">
    <h1>Waldjugend Settings</h1>
    <p class="header-description"> 
        <strong>Das Waldjugend Plugin</strong> ist ein Utility-Plugin, das speziell entwickelt wurde, um die Anpassung der Theme-Einstellungen über verschiedene WordPress-Installationen zu erleichtern.<br>
        Speziell für das <a href="https://github.com/lwijshoff/waldjugend-theme" target="_blank" rel="noopener noreferrer"><strong>waldjugend-theme</strong></a> entwickelt, ermöglicht es Nutzer,
        wichtige Theme-Elemente einfach zu verändern und so ein einheitliches Erscheinungsbild auf verschiedenen Websites sicherzustellen.<br>
        <br>
        Viel Erfolg!
    </p>
    <form method="post" action="options.php">
        <?php
            settings_fields('waldjugend_config_group');
            do_settings_sections('waldjugend_config_group');
        ?>
        <table class="form-table">
            <!-- Association overview Section -->
            <tr class="section-header">
                <th colspan="2">
                    <div class="header-flex">
                        <h2>Vereinsübersicht</h2>
                    </div>
                </th>
            </tr>
            <tr class="row-type">
                <th scope="row">Typ</th>
                <td>
                    <select id="waldjugend_type" name="waldjugend_type">
                        <option value="group" <?php selected(get_option('waldjugend_type'), 'group'); ?>>Ortsgruppe</option>
                        <option value="association" <?php selected(get_option('waldjugend_type'), 'association'); ?>>Verein</option>
                    </select>
                    <p class="description">Wähle, ob diese Seite eine Ortsgruppe oder ein eingetragener Verein (e.V.) ist.</p>
                </td>
            </tr>
            <tr class="row-group">
                <th scope="row">Horst / Ortsgruppe</th>
                <td>
                    <input type="text" name="waldjugend_group" value="<?php echo esc_attr(get_option('waldjugend_group')); ?>" />
                    <p class="description">
                        Name der Ortsgruppe (z.&nbsp;B. "Horst Musterstadt").<br>
                        Wenn der Typ <strong>„Verein“</strong> ausgewählt ist, wird dieses Feld automatisch mit dem Namen des Vereins ausgefüllt und beim Speichern übernommen.
                    </p>
                </td>
            </tr>
            <tr class="row-association-name">
                <th scope="row">Vereinsname / Verbandsname</th>
                <td>
                    <input type="text" name="waldjugend_association" value="<?php echo esc_attr(get_option('waldjugend_association')); ?>" />
                    <p class="description">Name des Vereins (z.&nbsp;B. "Landesverband Musterland e.V.")</p>
                </td>
            </tr>
            <tr class="row-association-url">
                <th scope="row">Verein Website URL</th>
                <td>
                    <input type="text" name="waldjugend_association_url" value="<?php echo esc_attr(get_option('waldjugend_association_url')); ?>" />
                    <p class="description">Website-Adresse des Vereins ohne https:// (z.&nbsp;B. "www.waldjugend-musterland.de")</p>
                </td>
            </tr>
            <!-- Links and Legal Section -->
            <tr class="section-header">
                <th colspan="2">
                    <div class="header-flex">
                        <h2>Links & Rechtliches</h2>
                    </div>
                </th>
            </tr>
            <tr class="row-imprint-url">
                <th scope="row">Impressum URL</th>
                <td>
                    <input type="text" name="waldjugend_imprint_url" value="<?php echo esc_attr(get_option('waldjugend_imprint_url')); ?>" />
                    <p class="description">URL für die Impressum-Seite, kann auch eine relative URL sein (z.&nbsp;B. "/impressum")</p>
                </td>
            </tr>
            <tr class="row-cookie-url">
                <th scope="row">Cookie-Richtlinien URL</th>
                <td>
                    <input type="text" name="waldjugend_cookie_url" value="<?php echo esc_attr(get_option('waldjugend_cookie_url')); ?>" />
                    <p class="description">URL für die Cookie-Richtlinien-Seite, kann auch eine relative URL sein (z.&nbsp;B. "/cookie-richtlinien-eu")</p>
                </td>
            </tr>
            <tr class="row-privacy-url">
                <th scope="row">Datenschutz URL</th>
                <td>
                    <input type="text" name="waldjugend_privacy_url" value="<?php echo esc_attr(get_option('waldjugend_privacy_url')); ?>" />
                    <p class="description">URL für die Datenschutz-Seite, kann auch eine relative URL sein (z.&nbsp;B. "/datenschutz")</p>
                </td>
            </tr>
            <tr class="row-gtc-url">
                <th scope="row">AGB URL</th>
                <td>
                    <input type="text" name="waldjugend_gtc_url" value="<?php echo esc_attr(get_option('waldjugend_gtc_url')); ?>" />
                    <p class="description">URL für die AGB-Seite, kann auch eine relative URL sein (z.&nbsp;B. "/agb")</p>
                </td>
            </tr>
            <!-- Contact Section -->
            <tr class="section-header">
                <th colspan="2">
                    <div class="header-flex">
                        <h2>Kontakt</h2>
                    </div>
                </th>
            </tr>
            <tr class="row-address-street">
                <th scope="row">Adresse Straße</th>
                <td>
                    <input type="text" name="waldjugend_address_street" value="<?php echo esc_attr(get_option('waldjugend_address_street')); ?>" />
                    <p class="description">Straße und Hausnummer (z.&nbsp;B. "Musterstraße 123")</p>
                </td>
            </tr>
            <tr class="row-address-place">
                <th scope="row">Adresse Ort</th>
                <td>
                    <input type="text" name="waldjugend_address_place" value="<?php echo esc_attr(get_option('waldjugend_address_place')); ?>" />
                    <p class="description">Postleitzahl (PLZ) und Ort (z.&nbsp;B. "12345 Musterstadt")</p>
                </td>
            </tr>
            <tr class="row-contact-email">
                <th scope="row">Email</th>
                <td>
                    <input type="text" name="waldjugend_contact_email" value="<?php echo esc_attr(get_option('waldjugend_contact_email')); ?>" />
                    <p class="description">
                        Kontakt Email (z.&nbsp;B. "kontakt@waldjugend-musterland.de")<br>
                        Diese Email-Adresse sollte getarnt sein, um Spam zu vermeiden.
                    </p>
                </td>
            </tr>
            <tr class="row-contact-number">
                <th scope="row">Telefon</th>
                <td>
                    <input type="text" name="waldjugend_contact_number" value="<?php echo esc_attr(get_option('waldjugend_contact_number')); ?>" />
                    <p class="description">
                        Telefonnummer (z.&nbsp;B. "+49 1512 3456789")<br>
                        Diese Telefonnummer sollte getarnt sein, um Spam zu vermeiden.
                    </p>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>