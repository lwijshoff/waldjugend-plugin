<?php

function waldjugend_generate_footer_html() {
    /**
     * Generates HTML footer content.
     */
    if (isset($GLOBALS['waldjugend_public']) && method_exists($GLOBALS['waldjugend_public'], 'generate_footer_html')) {
        return $GLOBALS['waldjugend_public']->generate_footer_html();
    }
    return 'test'; // Return empty if the object is not available
}
