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
			"supports" => array( "title", "editor", "thumbnail", "revisions", "genesis-cpt-archives-settings" ),
			"taxonomies" => array( "orgtype", "post_tag" ),
		);
	
		register_post_type( "evaluation", $args );
	}
	
	add_action( 'init', 'cptui_register_my_cpts_evaluation' );
	
	
	function rubesreview_evaluation_title( $input ) {
	
		global $post_type;
	
		if( is_admin() && 'Enter title here' == $input && 'Evaluation' == $post_type )
			return 'Organization Name';
		return $input;
	}
	add_filter('gettext','rubesreview_evaluation_title');

// Take care of rewrite rules any time this is activated 	
function rubesreview_rewrite_flush() {
	cptui_register_my_cpts_evaluation();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rubesreview_rewrite_flush' );