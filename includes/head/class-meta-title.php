<?php
/**
 * Title meta tag.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

class Burcon_Theme_Meta_Title {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

		add_action( 'controlled_chaos_meta_title', [ $this, 'title' ] );

	}

	/**
	 * Title meta tag.
	 * 
	 * @since  1.0.0
	 */
	public function title() {

		if ( is_front_page() ) {
			$title = bloginfo( 'name' );
		} else {
			$title = the_title();
		}

		echo $title;

	}

}

// Run the Burcon_Theme_Meta_Title class.
$controlled_chaos_meta_title = new Burcon_Theme_Meta_Title;