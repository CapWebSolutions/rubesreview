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


add_action( 'cmb2_init', 'cws_register_evaluation_metabox' );
function cws_register_evaluation_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_rubesreview_evaluation_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_evaluation = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'evaluation Details:', 'rubesreview-evaluations' ),
		'object_types' => array( 'evaluation', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		'taxonomies'	=> array('type'),
	) );
	
	$cmb_evaluation->add_field( array(
		'name' => __( 'Organization', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'organization',
		'type' => 'text',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Address', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_address',
		'type' => 'text',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Website URL', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_web',
		'type' => 'text_url',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Organization Phone', 'cmb2' ),
		'id'   => $prefix . 'org_phone',
		'type' => 'text_small',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Overall satisfaction with agency', 'cmb2' ),
		'id'   => $prefix . 'org_overall_satisfaction',
		'desc' => __( '1 to 5 (5 highest)', 'cmb2' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Hourly Rate', 'cmb2' ),
		'id'   => $prefix . 'org_hourly_rate',
		'desc' => __( '1 to 5 (5 highest)', 'cmb2' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Professionalism of contact person', 'cmb2' ),
		'id'   => $prefix . 'org_professionalism_rating',
		'desc' => __( '1 to 5 (5 highest)', 'cmb2' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Overall Rating', 'cmb2' ),
		'id'   => $prefix . 'org_overall_rating',
		'desc' => __( '1 to 5 (5 highest)', 'cmb2' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',	
		)
	) );
}

function cws_cmb2_sanitize_text_callback( $value, $field_args, $field ) {
	$value = strip_tags( $value, '<p><a><br><br/>' );
    return $value;
}
// add_filter( 'cmb2_sanitize_text', 'cws_cmb2_sanitize_text_callback', 10, 2 );