<?php
function cptui_register_my_taxes_orgtype() {
	
		/**
		 * Taxonomy: Organization Type.
		 */
	
		$labels = array(
			"name" => __( "Organization Types", "CapWebWP/Developers" ),
			"singular_name" => __( "Organization Type", "CapWebWP/Developers" ),
		);
	
		$args = array(
			"label" => __( "Organization Type", "CapWebWP/Developers" ),
			"labels" => $labels,
			"public" => true,     
			"hierarchical" => false,
			"label" => "Organization Type",
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'org-type', 'with_front' => true, ),
			"show_admin_column" => false,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => false,
		);
		register_taxonomy( "source", array( "orgtype" ), $args );
	}
	
	add_action( 'init', 'cptui_register_my_taxes_orgtype' );
	