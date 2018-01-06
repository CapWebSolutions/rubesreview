<?php
/**
 * Rube's Review wChild Theme
 *
 * This file adds the Spotlight page template to the Rube's Review Theme.
 *
 * Template Name: Spotlight
 *
 * @package rubesreview
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/rubesreview/
 */

// Add spotlight page body class to the head.
add_filter( 'body_class', 'rubesreview_add_body_class' );
function rubesreview_add_body_class( $classes ) {

	$classes[] = 'spotlight-page';

	return $classes;

}

// Remove Skip Links.
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script.
add_action( 'wp_enqueue_scripts', 'rubesreview_dequeue_skip_links' );
function rubesreview_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force Content/Sidebar layout.
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );


// Run the Genesis loop.
genesis();
