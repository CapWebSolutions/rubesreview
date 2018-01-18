<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_action( 'cmb2_init', 'cws_register_organization_metabox' );
function cws_register_organization_metabox() {

	$prefix = 'rr_organz_';

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
		'taxonomies'	=> array('org_type'),
	) );
	
	$cmb_organization->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-organizations' ),
		'id'   => $prefix . 'organization_name',
		'type' => 'text',
	) );

	$cmb_organization->add_field( array(
		'name' => __( 'Organization Location City', 'rubesreview-organizations' ),
		'id'   => $prefix . 'organization_city',
		'desc' => __( 'City associated with evaluated location/facility.', 'rubesreview-organizations' ),
		'type' => 'text',
	) );
	$cmb_organization->add_field( array(
		'name' => __( 'Organization Location State', 'rubesreview-organizations' ),
		'id'   => $prefix . 'organization_state',
		'desc' => __( 'State associated with evaluated location/facility.', 'rubesreview-organizations' ),
		'type' => 'text',
	) );
	$cmb_organization->add_field( array(
		'name' => __( 'Website URL', 'rubesreview-organizations' ),
		'id'   => $prefix . 'organization_web',
		'type' => 'text_url',
	) );
	$cmb_organization->add_field( array(
		'name' => __( 'Organization Phone', 'rubesreview-organizations' ),
		'id'   => $prefix . 'organization_phone',
		'type' => 'text_small',
	) );
}