<?php
/**
 * Post Types
 *
 * This file contains any custom post type definitions
 *
 * @package      Core_Functionality
 * @since        1.1.0
 * @link         https://github.com/capwebsolutions/starter-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2018, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function cptui_register_my_cpts() {

	/**
	 * Post Type: Organizations.
	 */

	$labels = array(
		"name" => __( "Organizations", "rubes-review" ),
		"singular_name" => __( "Organization", "rubes-review" ),
	);

	$args = array(
		"label" => __( "Organizations", "rubes-review" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "organization", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "title", "thumbnail", "genesis-cpt-archives-settings" ),
		"taxonomies" => array( "org_type" ),
	);

	register_post_type( "organization", $args );

	/**
	 * Post Type: Malpractice Evals.
	 */

	$labels = array(
		"name" => __( "Malpractice Evals", "rubes-review" ),
		"singular_name" => __( "Malpractice Eval", "rubes-review" ),
	);

	$args = array(
		"label" => __( "Malpractice Evals", "rubes-review" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "malpractice", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "title", "thumbnail", "author", "genesis-cpt-archives-settings" ),
	);

	register_post_type( "malp_eval", $args );

	/**
	 * Post Type: Hospital Evals.
	 */

	$labels = array(
		"name" => __( "Hospital Evals", "rubes-review" ),
		"singular_name" => __( "Hospital Eval", "rubes-review" ),
	);

	$args = array(
		"label" => __( "Hospital Evals", "rubes-review" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "hospital", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "title", "thumbnail", "author", "genesis-cpt-archives-settings" ),
	);

	register_post_type( "hosp_eval", $args );

	/**
	 * Post Type: Agency Evals.
	 */

	$labels = array(
		"name" => __( "Agency Evals", "rubes-review" ),
		"singular_name" => __( "Agency Eval", "rubes-review" ),
	);

	$args = array(
		"label" => __( "Agency Evals", "rubes-review" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "agency", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "title", "thumbnail", "author", "genesis-cpt-archives-settings" ),
	);

	register_post_type( "agnt_eval", $args );

	/**
	 * Post Type: Continuing Ed Evals.
	 */

	$labels = array(
		"name" => __( "Continuing Ed Evals", "rubes-review" ),
		"singular_name" => __( "Continuing Ed Eval", "rubes-review" ),
	);

	$args = array(
		"label" => __( "Continuing Ed Evals", "rubes-review" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "continuing-ed", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-testimonial",
		"supports" => array( "title", "thumbnail", "author", "genesis-cpt-archives-settings" ),
	);

	register_post_type( "cont_eval", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

/**
 * Flsuh rewrite rules on activation of core functionality
 */


function rubes_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    cptui_register_my_cpts();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
// register_activation_hook( __FILE__, 'rubes_rewrite_flush' );