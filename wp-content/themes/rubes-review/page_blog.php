<?php
/**
 * Template Name: Custom Blog
 *
 */

 // Add spotlight posts class to the head.
add_filter( 'genesis_attr_structural-wrap', 'rubes_my_custom_class' );  
function rubes_my_custom_class( $attributes ) {
	if ( is_single( ) )
		$attributes['class'] = $attributes['class'] . ' spotlight-content';
		return $attributes;
}

// Force Content/Sidebar layout.
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );

add_filter( 'body_class', 'wpsites_blog_page_body_class' );
function wpsites_blog_page_body_class( $classes ) {
   $classes[] = 'custom-blog';
   return $classes;
}

// Add the BB template header to single post pages
add_action('genesis_after_header', 'add_bb_image');
function add_bb_image(){
	echo do_shortcode('[fl_builder_insert_layout id="1969"]');
}

// add_action('genesis_loop', 'genesis_standard_loop', 5);

genesis();
