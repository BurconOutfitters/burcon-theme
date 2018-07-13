<?php
/**
 * Customizer blog controls.
 *
 * @package WordPress
 * @subpackage Burcon_Theme
 * @since  1.0.0
 */

// Do not namespace this class.

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Customizer blog controls.
 */
class Customizer_Blog {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        // Blog panel.
		add_action( 'customize_register', [ $this, 'blog' ] );

    }

    /**
     * Blog panel.
     */
    public function blog( $wp_customize ) {

        /**
		 * Framework settings panel.
		 */
		$wp_customize->add_section( 'burcon_customizer_blog', [
			'priority'    => 35,
			'capability'  => 'edit_theme_options',
			'title'       => __( 'Blog & Archives', 'burcon-theme' ),
			'description' => __( 'Content and navigation archives.', 'burcon-theme' )
        ] );
        
        // Blog content format.
		$wp_customize->add_setting( 'burcon_blog_content_format', [
			'default'	        => 'content',
			'sanitize_callback' => 'burcon_sanitize_blog_content_format'
		] );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'burcon_blog_content_format', [
			'section'     => 'burcon_customizer_blog',
			'settings'    => 'burcon_blog_content_format',
			'label'       => __( 'Blog Content', 'burcon-theme' ),
			'description' => __( 'Full content or excerpts', 'burcon-theme' ),
			'type'        => 'select',
			'choices'     => [
				'content' => __( 'Full Content', 'burcon-theme' ),
				'excerpt' => __( 'Excerpts', 'burcon-theme' )
				]
			]
		) );
		
		// Archive content format.
		$wp_customize->add_setting( 'burcon_archive_content_format', [
			'default'	        => 'content',
			'sanitize_callback' => 'burcon_sanitize_archive_content_format'
		] );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'burcon_archive_content_format', [
			'section'     => 'burcon_customizer_blog',
			'settings'    => 'burcon_archive_content_format',
			'label'       => __( 'Archive Content', 'burcon-theme' ),
			'description' => __( 'Full content or excerpts', 'burcon-theme' ),
			'type'        => 'select',
			'choices'     => [
				'content' => __( 'Full Content', 'burcon-theme' ),
				'excerpt' => __( 'Excerpts', 'burcon-theme' )
				]
			]
        ) );
        
        // Blog/archive navigation format.
		$wp_customize->add_setting( 'burcon_blog_navigation_format', [
			'default'	        => 'standard',
			'sanitize_callback' => 'burcon_sanitize_blog_navigation_format'
		] );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'burcon_blog_navigation_format', [
			'section'     => 'burcon_customizer_blog',
			'settings'    => 'burcon_blog_navigation_format',
			'label'       => __( 'Blog Pages Navigation', 'burcon-theme' ),
			'description' => __( 'Next/previous links or page count.', 'burcon-theme' ),
			'type'        => 'select',
			'choices'     => [
				'standard' => __( 'Next/Previous', 'burcon-theme' ),
				'numeric'  => __( 'Page Count', 'burcon-theme' )
				]
			]
		) );

    }
    
}

new Customizer_Blog;