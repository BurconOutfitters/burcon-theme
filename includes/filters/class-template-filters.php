<?php
/**
 * Template filters.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

namespace Burcon_Theme;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template filters.
 */
class Template_Filters {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

        add_filter( 'image_size_names_choose', [ $this, 'image_size_choose' ] );

    }

    /**
     * Image sizes to insert into posts.
     */
    public function image_size_choose( $size_names ) {

        global $_wp_additional_image_sizes;

		$sizes = [
			'thumbnail' => esc_html__( 'Thumbnail', 'burcon-theme' ),
			'medium'    => esc_html__( 'Medium', 'burcon-theme' ),
            'large'     => esc_html__( 'Large', 'burcon-theme' ),
            'banner'    => esc_html__( 'Banner', 'burcon-theme' ),
            'video'     => esc_html__( 'HD Video', 'burcon-theme' )
		];

		$insert_sizes = apply_filters( 'burcon_insert_image_sizes', $sizes );
		return $insert_sizes;

    }

}

new Template_Filters;