<?php
/**
 * RubesReview Child Init File
 *
 * This file calls the Child and Genesis init.php files.
 *
 * @category     RubesReview
 * @package      Admin
 * @author       Cap Web Solutions
 * @copyright    Copyright (c) 2018, Cap Web Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 */

/**
 * This function defines the Genesis Child theme constants
 * and calls necessary theme files
 *
 */

function rubesreview_init() {
	// // Child theme
	// define( 'CHILD_THEME_URL', 'https://github.com/CapWebSolutions/rubesreview/' );
	// // define( 'CHILD_THEME_VERSION', '1.0.1' );	 
	// define( 'CHILD_THEME_NAME', __( 'Spoken Royalty', 'spoken-royalty' ) );
	// define( 'CHILD_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
	define( 'RUBESREVIEW_SETTINGS_FIELD', 'rubesreview' );

	// Developer Information
	// define( 'CHILD_DEVELOPER', 'Cap Web Solutions' );
	// define( 'CHILD_DEVELOPER_URL', 'https://capwebsolutions.com/'  );

	// /** Define Directory Location Constants */
	if ( ! defined( 'CHILD_DIR' ) )
		define( 'CHILD_DIR', get_stylesheet_directory() );

	/** Define URL Location Constants */
	if ( ! defined( 'CHILD_URL' ) )
		define( 'CHILD_URL', get_stylesheet_directory_uri() );
	// define( 'RUBESREVIEW_LIB', CHILD_URL . '/lib' );
	// define( 'RUBESREVIEW_IMAGES', CHILD_URL . '/images' );
	// define( 'RUBESREVIEW_ADMIN', RUBESREVIEW_LIB . '/admin' );
	// define( 'RUBESREVIEW_ADMIN_IMAGES', RUBESREVIEW_LIB . '/images' );
	// define( 'RUBESREVIEW_JS' , CHILD_URL .'/lib/js' );
	// define( 'RUBESREVIEW_CSS' , CHILD_URL .'/css' );

	// Load admin files when necessary
	if ( is_admin() ) {
		// Theme Settings
		require_once( CHILD_DIR . '/lib/admin/theme-settings.php' );

	}
	
	// Add HTML5 markup structure
	// add_theme_support( 'html5', array(
	// 		'comment-list',
	// 		'comment-form',
	// 		'search-form',
	// 		'gallery',
	// 		'caption',
	// 	) );

	// Add Mobile Responsive Viewport meta tag for mobile browsers
	// add_theme_support( 'genesis-responsive-viewport' );

	// Add structural wraps
	// add_theme_support( 'genesis-structural-wraps', array(
	// 	'menu-secondary',
	// 	'footer',
	// 	'site-inner',
	// ) );
	

	//include extras
	include_once( CHILD_DIR . '/lib/functions/metaboxes.php');

	// Remove Edit link
	add_filter( 'edit_post_link', '__return_false' );

}
