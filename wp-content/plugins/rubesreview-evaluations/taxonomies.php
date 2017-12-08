<?php
function cptui_register_my_taxes_orgtype() {
	
		/**
		 * Taxonomy: Organization Type.
		 */
	
		$labels = array(
			"name" => __( "Organization Type", "rubesreview" ),
			"singular_name" => __( "Organization Type", "rubesreview" ),
		);
	
		$args = array(
			"labels" => $labels,
			"public" => true,     
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'org-type', 'with_front' => true, ),
			"show_admin_column" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => false,
			"choose_from_most_used" =>  __( "Choose from the available types.", "rubesreview"  ),
			"not_found" => __( "No types found.", "rubesreview"  ),
		);
		register_taxonomy( "orgtype", array( "organization", "evaluation" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_orgtype' );