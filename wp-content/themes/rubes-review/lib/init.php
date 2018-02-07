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
	define( 'RUBESREVIEW_SETTINGS_FIELD', 'rubesreview' );

	// /** Define Directory Location Constants */
	if ( ! defined( 'CHILD_DIR' ) )
		define( 'CHILD_DIR', get_stylesheet_directory() );

	/** Define URL Location Constants */
	if ( ! defined( 'CHILD_URL' ) )
		define( 'CHILD_URL', get_stylesheet_directory_uri() );

	// Load admin files when necessary
	if ( is_admin() ) {
		// Theme Settings
		require_once( CHILD_DIR . '/lib/admin/theme-settings.php' );
	}

	// include extras.
	include_once( CHILD_DIR . '/lib/functions/metaboxes.php');

	// Remove Edit link.
	add_filter( 'edit_post_link', '__return_false' );

}
