<?php
/**
 * Content index class.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */
namespace Burcon_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

class Index {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

		// Begin HTML and get <head> section.
		get_header();

		// Extensibility hook.
		do_action( 'burcon_before_post' );

		/**
		 * Run class for sidebars and widget areas.
		 * 
		 * Needs to run before the loop.
		 */
		get_sidebar();

		// Content templates.
		require get_theme_file_path( '/template-parts/content/content.php' );

		// Extensibility hook.
		do_action( 'burcon_after_post' );

		// Load scripts and close HTML.
		get_footer();

	}

}

// Run the Index class.
new Index;