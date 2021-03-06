<?php
/**
 * Main functions and definitions
 *
 * Setup the main functions
 *
 * @package      responsive_mobile
 * @license      license.txt
 * @copyright    2014 CyberChimps Inc
 * @since        0.0.1
 *
 * Please do not edit this file. This file is part of the responsive_mobile Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function responsive_mobile_setup() {

	global $content_width;

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 750;
	}

	/**
	 * Responsive is available for translations.
	 * The translation files are in the /languages/ directory.
	 * Translations are pulled from the WordPress default lanaguge folder
	 * then from the child theme and then lastly from the parent theme.
	 * @link http://codex.wordpress.org/Function_Reference/load_theme_textdomain
	 */
	$domain = 'responsive-mobile';

	load_theme_textdomain( $domain, WP_LANG_DIR . '/responsive/' );
	load_theme_textdomain( $domain, get_stylesheet_directory() . '/languages/' );
	load_theme_textdomain( $domain, get_template_directory() . '/languages/' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This feature enables woocommerce support for a theme.
	 * @link http://docs.woothemes.com/document/third-party-custom-theme-compatibility/#section-2
	 */
	add_theme_support( 'woocommerce' );

	/**
	 * This feature enables custom-menus support for a theme.
	 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	register_nav_menus( array(
		'top-menu'        => __( 'Top Menu', 'responsive-mobile' ),
		'header-menu'     => __( 'Header Menu', 'responsive-mobile' ),
		'sub-header-menu' => __( 'Sub-Header Menu', 'responsive-mobile' ),
		'footer-menu'     => __( 'Footer Menu', 'responsive-mobile' )
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters( 'responsive_mobile_custom_background_args', array(
			// Background default color
			'default-color' => '#efefef',
		) )
	);

}

add_action( 'after_setup_theme', 'responsive_mobile_setup' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 */
function responsive_mobile_content_width() {
	global $content_width;
	$full_width = is_page_template( 'full-width-page.php' ) || is_404() || 'full-width-page' == responsive_mobile_get_layout();
	if ( $full_width ) {
		$content_width = 1140;
	}
	$half_width = is_page_template( 'sidebar-content-half-page.php' ) || is_page_template( 'content-sidebar-half-page.php' ) || 'sidebar-content-half-page' == responsive_mobile_get_layout() || 'content-sidebar-half-page' == responsive_mobile_get_layout();
	if ( $half_width ) {
		$content_width = 570;
	}
}
add_action( 'template_redirect', 'responsive_mobile_content_width' );

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
function responsive_mobile_js() {

	global $is_IE;
	$suffix                 = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$template_directory_uri = get_template_directory_uri();

	// JS at the bottom for fast page loading.
	wp_enqueue_script( 'responsive-scripts', $template_directory_uri . '/js/responsive-scripts' . $suffix . '.js', array( 'jquery' ), '1.2.5', true );

	if ( $is_IE && ! wp_script_is( 'tribe-placeholder' ) ) {
		wp_enqueue_script( 'jquery-placeholder', $template_directory_uri . '/core/js/jquery-placeholder' . $suffix . '.js', array( 'jquery' ), '2.0.7', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register Scripts so that it can be easily enqueued
	wp_register_script( 'bootstrap', $template_directory_uri . '/core/bootstrap/javascripts/bootstrap' . $suffix . '.js', array( 'jquery' ), '3.1.1' );
	wp_register_script( 'responsive-mobile-menu', get_template_directory_uri() . '/core/js/mobile-menu' . $suffix . '.js', array( 'jquery' ), '20120206', true );
	wp_register_script( 'responsive-skip-link-focus-fix', get_template_directory_uri() . '/core/js/skip-link-focus-fix' . $suffix . '.js', array(), '20130115', true );

}
add_action( 'wp_enqueue_scripts', 'responsive_mobile_js' );

/**
 * A safe way of adding stylesheets to a WordPress generated page.
 */
function responsive_mobile_css() {

	$responsive_mobile = wp_get_theme( 'responsive-mobile' );
	$responsive_mobile_options = responsive_mobile_get_options();
	$suffix = ( "1" === $responsive_mobile_options['minified_css'] ) ? '.min' : '';

	if ( is_child_theme() ) {
		$theme = wp_get_theme();
		wp_enqueue_style( 'responsive-mobile-style', get_template_directory_uri() . '/css/style' . $suffix . '.css', false, $responsive_mobile['Version'] );
		wp_enqueue_style( 'responsive-mobile-child-style', get_stylesheet_uri(), false, $theme['Version'] );
	} else {
		wp_enqueue_style( 'responsive-mobile-style', get_stylesheet_uri(), false, $responsive_mobile['Version'] );
	}

}
add_action( 'wp_enqueue_scripts', 'responsive_mobile_css' );

/**
 * Change the location of the default stylesheet
 */
function responsive_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	$responsive_mobile_options = responsive_mobile_get_options();
	$suffix = ( "1" === $responsive_mobile_options['minified_css'] ) ? '.min' : '';
	$rtl    = ( is_rtl() ) ? '-rtl' : '';

	if ( ! is_child_theme() ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/css/style' . $rtl . $suffix . '.css';
	}

	return $stylesheet_uri;
}
add_action( 'stylesheet_uri', 'responsive_stylesheet_uri', 10, 2 );
