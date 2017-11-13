<?php
function cptui_register_my_cpts_evaluation() {

	/**
	 * Post Type: evaluations.
	 */

	$labels = array(
		"name" => __( "evaluations", "genesis-sample" ),
		"singular_name" => __( "evaluation", "genesis-sample" ),
		"menu_name" => __( "Rube's Evaluations", "genesis-sample" ),
		"all_items" => __( "All Evaluations", "genesis-sample" ),
		"add_new" => __( "Add Evaluation", "genesis-sample" ),
		"add_new_item" => __( "Add New Evaluation", "genesis-sample" ),
		"edit_item" => __( "Edit Evaluation", "genesis-sample" ),
		"new_item" => __( "New Evaluation", "genesis-sample" ),
		"view_item" => __( "View Evaluation", "genesis-sample" ),
		"view_items" => __( "View Evaluations", "genesis-sample" ),
		"search_items" => __( "Search Evaluations", "genesis-sample" ),
		"not_found" => __( "No Evaluations Found", "genesis-sample" ),
		"not_found_in_trash" => __( "No Evaluations Found in Trash", "genesis-sample" ),
		"archives" => __( "Evaluation Archives", "genesis-sample" ),
		"insert_into_item" => __( "Insert into Evaluation", "genesis-sample" ),
		"uploaded_to_this_item" => __( "Uploaded to this Evaluation", "genesis-sample" ),
		"filter_items_list" => __( "Filter Evaluation List", "genesis-sample" ),
		"items_list_navigation" => __( "Evaluations List Navigation", "genesis-sample" ),
		"items_list" => __( "Evaluations List", "genesis-sample" ),
		"attributes" => __( "Evaluation Attributes", "genesis-sample" ),
	);

	$args = array(
		"label" => __( "evaluations", "genesis-sample" ),
		"labels" => $labels,
		"description" => "",
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
		"supports" => array( "title", "editor", "thumbnail", "custom-fields", "author", "genesis-cpt-archives-settings" ),
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "evaluation", $args );
}

add_action( 'init', 'cptui_register_my_cpts_evaluation' );
