<?php
/**
 * Burcon Outfitters Theme functions.
 *
 * @package    WordPress
 * @subpackage Burcon_Theme
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 * @copyright  Copyright (c) 2017 - 2018, Greg Sweet
 *
 * @link       https://github.com/ControlledChaos/burcon-theme-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Burcon_Theme\Functions;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Burcon Outfitters functions class.
 *
 * @since  1.0.0
 * @access public
 */
final class Functions {

	/**
	 * Return the instance of the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {

			$instance = new self;

			// Class hook functions.
			$instance->hooks();

			// Class filter functions.
			$instance->filters();

			// Theme dependencies.
			$instance->dependencies();

		}

		return $instance;
	}

	/**
	 * Constructor magic method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {}

	/**
	 * Hooks and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function hooks() {

		// Swap html 'no-js' class with 'js'.
		add_action( 'wp_head', [ $this, 'js_detect' ], 0 );

		// Burcon Outfitters theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Remove unpopular meta tags.
		add_action( 'init', [ $this, 'head_cleanup' ] );

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		/**
		 * Admin styles.
		 *
		 * Call late to override plugin styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 99 );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

	}

	/**
	 * Hooks and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function filters() {

		// jQuery UI fallback for HTML5 Contact Form 7 form fields.
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

		// Remove WooCommerce styles.
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	}

	/**
	 * Replace 'no-js' class with 'js' in the <html> element when JavaScript is detected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function js_detect() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Theme setup.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		/**
		 * Load domain for translation.
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'burcon-theme' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// Background color & image support.
		add_theme_support( 'custom-background' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		 ] );

		// Register post formats.
		add_theme_support( 'post-formats', [
			'aside',
			'gscreenery',
			'video',
			'image',
			'audio',
			'link',
			'quote',
			'status',
			'chat'
		 ] );

		/**
		 * Add Gutenberg support.
		 *
		 * @since 1.0.0
		 */

		// Default color choices.
		$gutenberg_colors = apply_filters( 'burcon_gutenberg_colors', [
			'#444',
			'#eee',
			'#23282d',
			'#32373c',
			'#0073aa',
			'#00a0d2'
		] );

		add_theme_support( 'gutenberg', [
			'wide-images' => true,
			'colors'      => $gutenberg_colors,
		] );
		add_theme_support( 'editor-color-palette', '#444', '#eee', '#23282d', '#32373c', '#0073aa', '#00a0d2' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Customizer widget refresh support.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		// TODO: add Fancybox to WC products.
		// add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Beaver Builder support.
		add_theme_support( 'fl-theme-builder-headers' );
		add_theme_support( 'fl-theme-builder-footers' );
		add_theme_support( 'fl-theme-builder-parts' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image sizes.
		 *
		 * Three sizes per aspect ratio so that WordPress
		 * will use srcset for responsive images.
		 *
		 * @since 1.0.0
		 */

		// 16:9 HD Video.
		add_image_size( __( 'video', 'burcon-theme' ), 1280, 720, true );
		add_image_size( __( 'video-md', 'burcon-theme' ), 960, 540, true );
		add_image_size( __( 'video-sm', 'burcon-theme' ), 640, 360, true );

		// 21:9 Cinemascope.
		add_image_size( __( 'banner', 'burcon-theme' ), 1280, 549, true );
		add_image_size( __( 'banner-md', 'burcon-theme' ), 960, 411, true );
		add_image_size( __( 'banner-sm', 'burcon-theme' ), 640, 274, true );

		// Add image size for meta tags if companion plugin is not activated.
		if ( ! is_plugin_active( 'burcon-theme-plugin/burcon-theme-plugin.php' ) ) {
			add_image_size( __( 'Meta Image', 'burcon-theme' ), 1200, 630, true );
		}

		// Header support.
		$header = [
			'default-image'          => '',
			'width'                  => 1280,
			'height'                 => 549,
			'flex-height'            => true,
			'flex-width'             => true,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		];
		add_theme_support( 'custom-header', $header );

		// Customizer logo upload support.
		add_theme_support( 'custom-logo', [
			'width'       => apply_filters( 'burcon_logo_width', 240 ),
			'height'      => apply_filters( 'burcon_logo_height', 240 ),
			'flex-width'  => apply_filters( 'burcon_logo_flex_width', false ),
			'flex-height' => apply_filters( 'burcon_logo_flex_height', false )
		 ] );

		 /**
		 * Set content width.
		 *
		 * @since 1.0.0
		 */

		if ( ! isset( $content_width ) ) {
			$content_width = 1280;
		}

		/**
		 * Register theme menus.
		 *
		 * @since  1.0.0
		 */
		register_nav_menus( [
				'main'   => apply_filters( 'burcon_main_menu_name', esc_html__( 'Main Menu', 'burcon-theme' ) ),
				'footer' => apply_filters( 'burcon_footer_menu_name', esc_html__( 'Footer Menu', 'burcon-theme' ) ),
				'social' => apply_filters( 'burcon_social_menu_name', esc_html__( 'Social Menu', 'burcon-theme' ) )
		] );

		/**
		 * Add stylesheet for the content editor.
		 *
		 * @since 1.0.0
		 */
		add_editor_style( '/assets/css/editor-style.css', [ 'burcon-admin' ], '', 'screen' );

		/**
		 * Disable Jetpack open graph. We have the open graph tags in the theme.
		 *
		 * @since 1.0.0
		 */
		if ( class_exists( 'Jetpack' ) ) {
			add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );
		}

	}

	/**
	 * Clean up meta tags from the <head>.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function head_cleanup() {

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}

	/**
	 * Frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		wp_enqueue_script( 'jquery' );

		// HTML 5 support.
		wp_enqueue_script( 'burcon-html5',  get_theme_file_uri( '/assets/js/html5.min.js' ), [], '' );
		wp_script_add_data( 'burcon-html5', 'conditional', 'lt IE 9' );

		// Comments scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Admin scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {



	}

	/**
	 * Frontend styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Theme sylesheet.
		wp_enqueue_style( 'burcon-style',      get_stylesheet_uri(), [], '', 'screen' );

		// Internet Explorer styles.
		wp_enqueue_style( 'burcon-ie8',        get_theme_file_uri( '/assets/css/ie8.css' ), [], '', 'screen' );
		wp_style_add_data( 'burcon-ie8', 'conditional', 'lt IE 9' );

		/**
		 * Check if we and/or Google are online. If so, get Google fonts
		 * from their servers. Otherwise, get them from the theme directory.
		 */
		$google = checkdnsrr( 'google.com' );

		if ( $google ) {
			wp_enqueue_style( 'burcon-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Source+Code+Pro:200,300,400,500,600,700,900', [], '', 'screen' );
		} else {
			wp_enqueue_style( 'burcon-sans',  get_theme_file_uri( '/assets/fonts/open-sans/open-sans.min.css' ), [], '', 'screen' );
			wp_enqueue_style( 'burcon-serif', get_theme_file_uri( '/assets/fonts/merriweather/merriweather.min.css' ), [], '', 'screen' );
			wp_enqueue_style( 'burcon-code',  get_theme_file_uri( '/assets/fonts/source-code-pro/source-code-pro.min.css' ), [], '', 'screen' );
		}

		// Media and supports queries.
		wp_enqueue_style( 'burcon-queries',   get_theme_file_uri( '/queries.css' ), [], '', 'screen' );

		// Print styles.
		wp_enqueue_style( 'burcon-print',     get_theme_file_uri( '/assets/css/print.css' ), [], '', 'print' );

	}

	/**
	 * Admin styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 *
	 * @todo   Move the .css file and change the directory.
	 */
	public function admin_styles() {

		// Enqueue the global styles for this and child themes.
		wp_enqueue_style( 'burcon-admin',   get_theme_file_uri( '/assets/scss/admin/admin.css' ), [], '', 'screen' );

		// Enqueue styles specific to the parent theme.
		if ( ! is_child_theme() ) {
			wp_enqueue_style( 'burcon-colors',   get_parent_theme_file_uri( '/assets/scss/admin/colors.css' ), [], '', 'screen' );
		}

		// Enqueue styles specific to the active child theme.
		if ( is_child_theme() ) {
			wp_enqueue_style( 'burcon-child-colors',   get_theme_file_uri( '/assets/scss/admin/colors.css' ), [], '', 'screen' );
		}

	}

	/**
	 * Login styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {

		wp_enqueue_style( 'custom-login', get_theme_file_uri( '/assets/css/login.css' ), [], '', 'screen' );

	}

	/**
	 * Theme dependencies.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Theme customizer.
		require_once get_theme_file_path( '/includes/customizer/class-customizer.php' );

		// Set up the <head> element.
		require_once get_theme_file_path( '/includes/head/class-head.php' );

		// Set up Scema attributes for the <body> element.
		require_once get_theme_file_path( '/includes/template-tags/class-body-schema.php' );

		// Get template tags.
		require_once get_theme_file_path( '/includes/template-tags/template-tags.php' );

		// Get template filters.
		include get_theme_file_path( '/includes/filters/class-template-filters.php' );

		// Register sidebars.
		require get_theme_file_path( '/includes/widgets/register-sidebars.php' );

		// Blog navigation.
		if ( ! is_singular() ) {
			require get_theme_file_path( '/template-parts/navigation/class-blog-nav.php' );
		}

	}

}

/**
 * Gets the instance of the Functions class.
 *
 * This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function cctheme() {

	$cctheme = Functions::get_instance();

	return $cctheme;

}

// Run the Functions class.
cctheme();