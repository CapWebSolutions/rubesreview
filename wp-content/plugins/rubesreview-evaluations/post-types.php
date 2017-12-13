<?php
function cptui_register_my_cpts_evaluation() {

	/**
	 * Post Type: Evaluations.
	 */

	$labels = array(
		"name" => __( "Evaluations", "rubesreview" ),
		"singular_name" => __( "Evaluation", "rubesreview" ),
		"menu_name" => __( "My Evaluations", "rubesreview" ),
		"all_items" => __( "All Evaluations", "rubesreview" ),
		"add_new" => __( "Add New Evaluation", "rubesreview" ),
		"add_new_item" => __( "Add New Evaluation", "rubesreview" ),
		"edit_item" => __( "Edit Evaluation", "rubesreview" ),
		"new_item" => __( "New Evaluation", "rubesreview" ),
		"view_item" => __( "View Evaluation", "rubesreview" ),
		"view_items" => __( "View Evaluations", "rubesreview" ),
		"search_items" => __( "Search Evaluations", "rubesreview" ),
		"not_found" => __( "No Evaluations Found", "rubesreview" ),
		"not_found_in_trash" => __( "No Evaluations found in trash", "rubesreview" ),
		"featured_image" => __( "Featured Image", "rubesreview" ),
		"set_featured_image" => __( "Set Featured Image for this Evaluation", "rubesreview" ),
		"remove_featured_image" => __( "Remove Featured Image", "rubesreview" ),
		"use_featured_image" => __( "Use as Featured Image for this Evaluation", "rubesreview" ),
		"archives" => __( "Evaluation Archives", "rubesreview" ),
		"insert_into_item" => __( "Insert into Evaluation", "rubesreview" ),
		"uploaded_to_this_item" => __( "Uploaded to this Evaluation", "rubesreview" ),
		"filter_items_list" => __( "Filter Evaluation List", "rubesreview" ),
		"items_list" => __( "Evaluation List", "rubesreview" ),
		"attributes" => __( "Evaluation Attributes", "rubesreview" ),
	);

	$args = array(
		"label" => __( "evaluations", "rubesreview" ),
		"labels" => $labels,
		"description" => "Manages Evaluations for website",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "evaluations", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "title", "thumbnail", "revisions", "genesis-cpt-archives-settings" ),
		"taxonomies" => array( "orgtype" ),
	);

	register_post_type( "evaluation", $args );
}
	
function cptui_register_my_cpts_organization() {
/**
 * Post Type: Organization.
 */

	$labels = array(
		"name" => __( "Organizations", "rubesreview" ),
		"singular_name" => __( "Organization", "rubesreview" ),
		"menu_name" => __( "My Organizations", "rubesreview" ),
		"all_items" => __( "All Organizations", "rubesreview" ),
		"add_new" => __( "Add New Organization", "rubesreview" ),
		"add_new_item" => __( "Add New Organization", "rubesreview" ),
		"edit_item" => __( "Edit Organization", "rubesreview" ),
		"new_item" => __( "New Organization", "rubesreview" ),
		"view_item" => __( "View Organization", "rubesreview" ),
		"view_items" => __( "View Organizations", "rubesreview" ),
		"search_items" => __( "Search Organizations", "rubesreview" ),
		"not_found" => __( "No Organizations Found", "rubesreview" ),
		"not_found_in_trash" => __( "No Organizations found in trash", "rubesreview" ),
		"featured_image" => __( "Featured Image", "rubesreview" ),
		"set_featured_image" => __( "Set Featured Image for this Organization", "rubesreview" ),
		"remove_featured_image" => __( "Remove Featured Image", "rubesreview" ),
		"use_featured_image" => __( "Use as Featured Image for this Organization", "rubesreview" ),
		"archives" => __( "Organization Archives", "rubesreview" ),
		"insert_into_item" => __( "Insert into Organization", "rubesreview" ),
		"uploaded_to_this_item" => __( "Uploaded to this Organization", "rubesreview" ),
		"filter_items_list" => __( "Filter Organization List", "rubesreview" ),
		"items_list" => __( "Organization List", "rubesreview" ),
		"attributes" => __( "Organization Attributes", "rubesreview" ),
	);

	$args = array(
		"label" => __( "Organizations", "rubesreview" ),
		"labels" => $labels,
		"description" => "Manages Organizations for website",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "organizations", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "thumbnail", "revisions", "genesis-cpt-archives-settings" ),
		"taxonomies" => array( "orgtype" ),
	);
	register_post_type( "Organization", $args );
}


function cptui_register_my_cpts_emarecpt() {
	/**
	 * Post Type: Emare.
	 */
	
		$labels = array(
			"name" => __( "Emares", "rubesreview" ),
			"singular_name" => __( "Emare", "rubesreview" ),
			"menu_name" => __( "My Emares", "rubesreview" ),
			"all_items" => __( "All Emares", "rubesreview" ),
			"add_new" => __( "Add New Emare", "rubesreview" ),
			"add_new_item" => __( "Add New Emare", "rubesreview" ),
			"edit_item" => __( "Edit Emare", "rubesreview" ),
			"new_item" => __( "New Emare", "rubesreview" ),
			"view_item" => __( "View Emare", "rubesreview" ),
			"view_items" => __( "View Emares", "rubesreview" ),
			"search_items" => __( "Search Emares", "rubesreview" ),
			"not_found" => __( "No Emares Found", "rubesreview" ),
			"not_found_in_trash" => __( "No Emares found in trash", "rubesreview" ),
			"featured_image" => __( "Featured Image", "rubesreview" ),
			"set_featured_image" => __( "Set Featured Image for this Emare", "rubesreview" ),
			"remove_featured_image" => __( "Remove Featured Image", "rubesreview" ),
			"use_featured_image" => __( "Use as Featured Image for this Emare", "rubesreview" ),
			"archives" => __( "Emare Archives", "rubesreview" ),
			"insert_into_item" => __( "Insert into Emare", "rubesreview" ),
			"uploaded_to_this_item" => __( "Uploaded to this Emare", "rubesreview" ),
			"filter_items_list" => __( "Filter Emare List", "rubesreview" ),
			"items_list" => __( "Emare List", "rubesreview" ),
			"attributes" => __( "Emare Attributes", "rubesreview" ),
		);
	
		$args = array(
			"label" => __( "Emares", "rubesreview" ),
			"labels" => $labels,
			"description" => "Manages Emares for website",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => true,
			"show_in_menu" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => "organizations", "with_front" => true ),
			"query_var" => true,
			"menu_icon" => "dashicons-testimonial",
			"supports" => array( "thumbnail", "revisions", "genesis-cpt-archives-settings" ),
			"taxonomies" => array( "orgtype" ),
		);
		register_post_type( "Emare", $args );
	}
	
add_action( 'init', 'cptui_register_my_cpts_evaluation' );
add_action( 'init', 'cptui_register_my_cpts_organization' );
// add_action( 'init', 'cptui_register_my_cpts_emarecpt' );
	
function rubesreview_evaluation_title( $input ) {

	global $post_type;

	if( is_admin() && 'Enter title here' == $input && 'Evaluation' == $post_type )
		return 'Organization Name';
	return $input;
}
// add_filter('gettext','rubesreview_evaluation_title');

// Take care of rewrite rules any time this is activated 	
function rubesreview_rewrite_flush() {
	cptui_register_my_cpts_evaluation();
	cptui_register_my_cpts_organization();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rubesreview_rewrite_flush' );