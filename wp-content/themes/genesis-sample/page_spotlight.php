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

// Hook lead capture widget area.
// add_action( 'genesis_loop', 'rubesreview_lead_capture' );
function rubesreview_lead_capture() {

	genesis_widget_area( 'lead-capture', array(
		'before' => '<div class="lead-capture">',
		'after'  => '</div>',
	) );

}


// Remove site header elements.
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation.
// remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove site footer widgets.
// remove_theme_support( 'genesis-footer-widgets' );

// Remove site footer elements.
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
