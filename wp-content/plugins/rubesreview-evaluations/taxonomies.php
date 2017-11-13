<?php
function cptui_register_my_taxes_agencytype() {
	
		/**
		 * Taxonomy: Agency-Type.
		 */
	
		$labels = array(
			"name" => __( "Agency Types", "CapWebWP/Developers" ),
			"singular_name" => __( "Agency Type", "CapWebWP/Developers" ),
		);
	
		$args = array(
			"label" => __( "Agency Type", "CapWebWP/Developers" ),
			"labels" => $labels,
			"public" => true,
			"hierarchical" => false,
			"label" => "Agency Type",
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'testimonials-by', 'with_front' => true, ),
			"show_admin_column" => false,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => false,
		);
		register_taxonomy( "source", array( "agencytype" ), $args );
	}
	
	add_action( 'init', 'cptui_register_my_taxes_agencytype' );
	