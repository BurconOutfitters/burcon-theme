<?php
/**
 * Footer HTML and content output.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

do_action( 'burcon_before_footer_content' );

    echo '<div class="footer-content global-wrapper footer-wrapper">', "\r";

        $site_name      = esc_attr( get_bloginfo( 'name' ) );
        $copyright_text = sprintf( '<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>', esc_html__( 'Copyright ', 'burcon-theme' ), get_the_time( 'Y' ), $site_name, esc_html__( 'All rights reserved', 'burcon-theme' ) );

        $copyright = apply_filters( 'burcon_copyright_text', $copyright_text );
        echo $copyright, "\r";
    
    echo '</div><!-- footer-content -->', "\r";

do_action( 'burcon_after_footer_content' );