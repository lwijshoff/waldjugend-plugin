<div class="wrap">
    <h1>Waldjugend Settings</h1>
    <form method="post" action="options.php">
        <?php
            settings_fields('waldjugend_config_group');
            do_settings_sections('waldjugend_config_group');
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">Typ</th>
                <td>
                    <select id="waldjugend_type" name="waldjugend_type">
                        <option value="ortsgruppe" <?php selected(get_option('waldjugend_type'), 'ortsgruppe'); ?>>Ortsgruppe</option>
                        <option value="landesverband" <?php selected(get_option('waldjugend_type'), 'landesverband'); ?>>Landesverband</option>
                    </select>
                    <p class="description">Wähle, ob diese Seite eine Ortsgruppe oder ein Landesverband ist.</p>
                </td>
            </tr>
            <tr class="row-horst">
                <th scope="row">Horst / Ortsgruppe</th>
                <td>
                    <input type="text" name="waldjugend_horst" value="<?php echo esc_attr(get_option('waldjugend_horst')); ?>" />
                    <p class="description">
                        Name der Ortsgruppe (z.&nbsp;B. „Horst Musterstadt“).<br>
                        Wenn der Typ <strong>„Landesverband“</strong> ausgewählt ist, wird dieses Feld automatisch mit dem Namen des Landesverbands ausgefüllt und beim Speichern übernommen.
                    </p>
                </td>
            </tr>
            <tr class="row-lvb-name">
                <th scope="row">LvB Name</th>
                <td>
                    <input type="text" name="waldjugend_lvb" value="<?php echo esc_attr(get_option('waldjugend_lvb')); ?>" />
                    <p class="description">Name des Landesverbands (z.B. "Landesverband Musterland e.V.")</p>
                </td>
            </tr>
            <tr class="row-lvb-url">
                <th scope="row">LvB Website URL</th>
                <td>
                    <input type="text" name="waldjugend_lvb_url" value="<?php echo esc_attr(get_option('waldjugend_lvb_url')); ?>" />
                    <p class="description">Website-Adresse ohne https:// (z.B. "www.waldjugend-musterland.de")</p>
                </td>
            </tr>
            <tr class="row-imprint-url">
                <th scope="row">Impressum URL</th>
                <td>
                    <input type="text" name="imprint_url" value="<?php echo esc_attr(get_option('imprint_url')); ?>" />
                    <p class="description">URL für die Impressum-Seite, kann auch eine relative URL sein (z.B. "/impressum")</p>
                </td>
            </tr>
            <tr class="row-cookies-url">
                <th scope="row">Cookie-Richtlinien URL</th>
                <td>
                    <input type="text" name="cookie_url" value="<?php echo esc_attr(get_option('cookie_url')); ?>" />
                    <p class="description">URL für die Cookie-Richtlinien-Seite, kann auch eine relative URL sein (z.B. "/cookie-richtlinien-eu")</p>
                </td>
            </tr>
            <tr class="row-privacy-url">
                <th scope="row">Datenschutz URL</th>
                <td>
                    <input type="text" name="privacy_url" value="<?php echo esc_attr(get_option('privacy_url')); ?>" />
                    <p class="description">URL für die Impressum-Seite, kann auch eine relative URL sein (z.B. "/datenschutz")</p>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>