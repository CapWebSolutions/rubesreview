<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_action( 'cmb2_admin_init', 'cws_register_agency_evaluation_metabox' );
function cws_register_agency_evaluation_metabox() {

	$prefix = 'rr_eval_agnt_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_evaluation = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Evaluations Details:', 'rubesreview-evaluations' ),
		'object_types' => array( 'agnt_eval', ), 
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
	) );
	
	// This field name is common to all org types
	$cmb_evaluation->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'organization_name',
		'type' => 'text',
		'default' => ! empty( $_POST['submitted_post_title'] ) 
			? $_POST['submitted_post_title']
			: __( 'New Post', 'rubesreview-evaluations' ),
	) );

	$cmb_evaluation->add_field( array(
		'name' => __( 'Overall satisfaction with agency', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'overall_satisfaction',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
	) );

	$cmb_evaluation->add_field( array(
		'name' => __( 'Hourly Rate', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'hourly_rate',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
	) );
	
	$cmb_evaluation->add_field( array(
		'name' => __( 'Paid in a Timely Manner', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'paid_timely',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Hours Worked', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'hours_worked',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Arranged Flight', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'arranged_flight',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Arranged Car', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'arranged_car',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Hotel Apartment Accommodations', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'hotel_appt_accommodations',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Per Diem', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'per_diem',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Professionalism of contact person', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'professionalism_rating',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),		
		),
	) );

	// This field name is common to all org types
	$cmb_evaluation->add_field( array(
		'name' => __( 'Calculated Rating Average', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'rating_average',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	$cmb_evaluation->add_field( array(
		'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'addl_comments',
		'type' => 'textarea',
	) );

	$cmb_evaluation->add_field( array(
		'name' => __( 'Evaluation Title', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'evaluation_title',
		'type' => 'text',
		'type' => 'hidden',
		'default' => 'rubes_set_eval_title', 
	) );
}

