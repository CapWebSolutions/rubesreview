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

// This file handles single entries, but only exists for the sake of child theme forward compatibility.

// Add the BB template header to single post pages
echo do_shortcode('[fl_builder_insert_layout id="616"]');

// Move image above post title in Genesis Framework 2.0
// remove_action( 'genesis_entry_content', 'genesis_do_post_title', 8 );
// add_action( 'genesis_entry_header', 'genesis_do_post_title', 8 );
genesis();