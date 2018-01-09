<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

 // Add spotlight posts class to the head.

// add_filter( 'genesis_attr_content', 'rubesreview_add_spotlight_post_class' );
function rubesreview_add_spotlight_post_class( $classes ) {
	$classes[] = 'spotlight-content';
	return $classes;
}
// add_filter( 'genesis_attr_sidebar-primary', 'rubesreview_add_css_class' );
function rubesreview_add_css_class( $attributes ) {
	$attributes['class'] = "spotlight-content";
	return $classes;
}

// Force Content/Sidebar layout.
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );

// Add the BB template header to single post pages
echo do_shortcode('[fl_builder_insert_layout id="616"]');

genesis();
