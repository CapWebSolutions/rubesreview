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
		'title'        => __( 'Evaluation Details:', 'rubesreview-evaluations' ),
		'object_types' => array( 'evaluation', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		'taxonomies'	=> array('orgtype'),
	) );
	
	$cmb_evaluation->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'organization',
		'type' => 'text',
	) );

	// $cmb_evaluation->add_field( array(
	// 	'name'             => __( 'Organization Type', 'rubesreview-evaluations' ),
	// 	'desc'			=> 'Select type of organization being added.', 
	// 	'id'               => $prefix . 'org_type',
	// 	'type'             => 'select',
	// 	'show_option_none' => true,
	// 	'options'          => array(
	// 		'agency' => __( 'Agency', 'rubesreview-evaluations' ),
	// 		'hospital'   => __( 'Hospital', 'rubesreview-evaluations' ),
	// 		'malpractice'     => __( 'Malpractice Company', 'rubesreview-evaluations' ),
	// 		'continuinged'     => __( 'Continuing Ed Company', 'rubesreview-evaluations' ),
			
	// 	),
	// ) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Orgaanization Address', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_address',
		'desc' => __( 'Address associated with evaluated location/facility.', 'rubesreview-evaluations' ),
		'type' => 'text',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Website URL', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_web',
		'type' => 'text_url',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Organization Phone', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_phone',
		'type' => 'text_small',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Overall satisfaction with agency', 'rubesreview-evaluations' ),
		'id'   => 'org_overall_satisfaction',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Hourly Rate', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_hourly_rate',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Paid in a Timely Manner', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_paid_timely',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Hours Worked', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_hours_worked',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Arranged Flight', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_arranged_flight',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Arranged Car', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_arranged_car',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Hotel Apartment Accommodations', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_hotel_appt_accommodations',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Per Diem', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_per_diem',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Professionalism of contact person', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_professionalism_rating',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',			
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Overall Rating', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_overall_rating',
		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'max' => '5',
			'min' => '1',	
		)
	) );

	$cmb_evaluation->add_field( array(
		'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
		'desc' => __( 'Add any additional comments to your evaluation', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_additional_comments',
		'type' => 'textarea',
	) );
}

function cws_rubesreview_evaluations_sanitize_text_callback( $value, $field_args, $field ) {
	$value = strip_tags( $value, '<p><a><br><br/>' );
    return $value;
}
// add_filter( 'rubesreview-evaluations_sanitize_text', 'cws_rubesreview-evaluations_sanitize_text_callback', 10, 2 );