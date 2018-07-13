<?php
/**
 * Blog pages navigation.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Blog pages navigation.
 */
class Blog_Nav {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {
		
		add_action( 'burcon_before_footer', [ $this, 'nav' ], 20 );

	}
	
	/**
	 * Get navigation style.
	 */
	public function nav() {

		if ( 'numeric' == burcon_sanitize_blog_navigation_format( get_theme_mod( 'burcon_blog_navigation_format' ) ) ) {
			get_template_part( 'template-parts/navigation/partials/numeric-nav' );
		} else {
			get_template_part( 'template-parts/navigation/partials/posts-nav' );
		}

	}

}

new Blog_Nav;