<?php
/**
 * Custom single post template.
 *
 * @package Genesis\Templates
 * @author  Cap Web Solutions <info@capwebsolutions.com>
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

 // Add spotlight posts class to the head.
add_filter('genesis_attr_structural-wrap', 'rubes_my_custom_class');  
function rubes_my_custom_class( $attributes ) 
{
    if (is_single() ) {
        $attributes['class'] = $attributes['class'] . ' spotlight-content';
    }
    return $attributes;
}
add_filter('body_class', 'wpsites_blog_page_body_class');
function wpsites_blog_page_body_class( $classes ) 
{
    $classes[] = 'custom-blog';
    return $classes;
}

// Force Content/Sidebar layout.
add_filter('genesis_site_layout', '__genesis_return_content_sidebar');

// Add the BB template header to single post pages
add_action('genesis_after_header', 'add_bb_image');
function add_bb_image()
{
    echo do_shortcode('[fl_builder_insert_layout id="1969"]');
}

genesis();
