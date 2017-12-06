<?php
/**
 * Rube's Review Child Theme
 *
 * This file adds the Get Evaluation page template to the Rube's Review Theme.
 *
 * Template Name: Get Evaluation
 * Template Post Type: page
 *
 * @package rubesreview
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/rubesreview/
 */

// Add leaderboard page body class to the head.
add_filter( 'body_class', 'rubesreview_add_body_class' );
function rubesreview_add_body_class( $classes ) {
	$classes[] = 'leaderboard-page';
	return $classes;
}

// Remove Skip Links.
// remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script.
// add_action( 'wp_enqueue_scripts', 'rubesreview_dequeue_skip_links' );
function rubesreview_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force Content/Sidebar layout.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
// add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

/**
 * Remove the standard loop
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop',  __NAMESPACE__ . '\rubes_get_evaluations_loop' );

function rubes_get_evaluations_loop() {

	global $wp_query;
d('inside rubes_get_evaluations_loop');

	
//* Restore original query
wp_reset_query();
}
// Run the Genesis loop.
genesis();

