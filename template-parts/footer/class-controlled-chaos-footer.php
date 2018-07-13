<?php
/**
 * Footer HTML template.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Footer HTML template.
 */
class Burcon_Theme_Footer {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        $this->partials();

        wp_footer();

    }

    /**
	 * Footer partials.
     * 
     * @since  1.0.0
	 */
    public function partials() {

        // Footer opening tags and before footer actions.
        get_template_part( 'template-parts/footer/partials/open-footer' );

        // Site branding and before/after footer content actions.
        get_template_part( 'template-parts/footer/partials/content' );

        // Footer closing tags and after footer actions.
        get_template_part( 'template-parts/footer/partials/close-footer' );

    }

}

$burcon_footer = new Burcon_Theme_Footer;