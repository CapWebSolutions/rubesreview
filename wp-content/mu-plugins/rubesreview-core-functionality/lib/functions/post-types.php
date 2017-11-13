<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {

	$labels = array(
		"name"                  => __( 'Evaluations', '' ),
		"singular_name"         => __( 'Evaluation', '' ),
		"menu_name"             => __( 'Evaluations', '' ),
		"description"           => "Organization evaluation",
		"name_admin_bar"        => _x( 'Evaluation', '' ),
		"all_items"             => __( 'All Evaluations', '' ),
		"add_new"               => __( 'Add New Evaluation', '' ),
		"add_new_item"          => __( 'Add New Evaluation', '' ),
		"edit_item"             => __( 'Edit Evaluation', '' ),
		"new_item"              => __( 'Add New Evaluation', '' ),
		"view_item"             => __( 'View Evaluation', '' ),
		"search_items"          => __( 'Seach Evaluations', '' ),
		"not_found"             => __( 'No Evaluations Found', '' ),
		"not_found_in_trash"    => __( 'No Evaluations Found In trash', '' ),
		"parent_item_colon"     => __( 'Evaluation Parent Item', '' ),
		"featured_image"        => __( 'Evaluation Featured Image', '' ),
		"set_featured_image"    => __( 'Set Evaluation Featured Image', '' ),
		"remove_featured_image" => __( 'Remove Evaluation Featured Image', '' ),
		"use_featured_image"    => __( 'Use Evaluation Featured Image', '' ),
		"archives"              => __( 'Evaluation Archives', '' ),
		"insert_into_item"      => __( 'Insert into Evaluation', '' ),
		"uploaded_to_this_item" => __( 'Uploaded to Evaluation', '' ),
		"filter_items_list"     => __( 'Filter Evaluation List', '' ),
		"items_list_navigation" => __( 'Evaluations Navigation', '' ),
		"items_list"            => __( 'Evaluations List', '' ),
		"parent_item_colon"     => __( 'Evaluation Parent Item:', '' ),
		);

	$supports = array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'author',
		'custom-fields',
		'revisions',
	);

	$args = array(
		"labels"              => $labels,
		"supports"            => $supports,
		"public"              => true,
		"publicly_queryable"  => true,
		"show_ui"             => true,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"has_archive"         => true,
		"show_in_menu"        => true,
		"exclude_from_search" => false,
		"capability_type"     => "post",
		"map_meta_cap"        => true,
		"hierarchical"        => false,
		"rewrite"             => array( "slug" => "Evaluation", ),
		"query_var"           => true,
		'menu_icon'           => 'dashicons-welcome-write-blog',

	);
	register_post_type( 'Evaluation', $args );

	// End of cptui_register_my_cpts()
}
