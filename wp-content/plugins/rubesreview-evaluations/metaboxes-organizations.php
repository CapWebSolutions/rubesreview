<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}


add_action( 'cmb2_init', 'cws_register_organization_metabox' );
function cws_register_organization_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_rubesreview_organization_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_organization = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Organization Details:', 'rubesreview-organizations' ),
		'object_types' => array( 'organization', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		'taxonomies'	=> array('orgtype'),
	) );
	
	$cmb_organization->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-organizations' ),
		'id'   => $prefix . 'organizationname',
		'type' => 'text',
	) );

	$cmb_organization->add_field( array(
		'name' => __( 'Orgaanization Location City', 'rubesreview-organizations' ),
		'id'   => $prefix . 'org_city',
		'desc' => __( 'City associated with evaluated location/facility.', 'rubesreview-organizations' ),
		'type' => 'text',
	) );
	$cmb_organization->add_field( array(
		'name' => __( 'Orgaanization Location State', 'rubesreview-organizations' ),
		'id'   => $prefix . 'org_state',
		'desc' => __( 'State associated with evaluated location/facility.', 'rubesreview-organizations' ),
		'type' => 'text',
	) );
	$cmb_organization->add_field( array(
		'name' => __( 'Website URL', 'rubesreview-organizations' ),
		'id'   => $prefix . 'org_web',
		'type' => 'text_url',
	) );
	$cmb_organization->add_field( array(
		'name' => __( 'Organization Phone', 'rubesreview-organizations' ),
		'id'   => $prefix . 'org_phone',
		'type' => 'text_small',
	) );
}