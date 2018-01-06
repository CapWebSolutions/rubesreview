<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_action( 'cmb2_admin_init', 'cws_register_hospital_evaluation_metabox' );
function cws_register_hospital_evaluation_metabox() {

	$prefix = 'rr_eval_hosp_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_eval_hosp = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Evaluations Details:', 'rubesreview-evaluations' ),
		'object_types' => array( 'hosp_eval', ), 
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
	) );

	
	// This field name is common to all org types
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'organization_name',
		'type' => 'text',
	) );

	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Overall satisfaction with hospital', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'overall_satisfaction',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );

	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recruiting contact person rating', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiting_contact',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recruiting contact polite', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiting_contact_polite',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recruiting contact professional', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiting_contact_professional',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),		
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recruiting contact knowledgeable', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiting_contact_knowledgeable',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recruiting contact hospital representation', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiting_contact_hospital_rep',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Adequate orientation', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'hospital_orientation',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Adequate orientation speakers', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'hospital_orientation_speakers',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',	
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Happy Work hours scheduled', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'work_hours_schedule',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Happy shifts scheduled', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'happy_shift_schedule',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Happy pay offered', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'happy_pay_offered',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Happy change schedule', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'happy_change_schedule',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Happy overtime work', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'happy_overtime_work',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Expectation to work OT', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'expect_work_ot',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Adequate nurse patient ratio', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'adequate_nurse_patient_ratio',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Training adequate', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'training_adequate',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Communicate with superiors', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'communicate_w_superiors',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Able to go up chain of command', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'go_up_chain',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Work appreciated', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'work_appreciated',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Feel fulfilled', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'feel_fulfilled',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Feel at home', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'feel_at_home',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recommend to colleague', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recommend_2_colleague',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Recommend to patient', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recommend_2_patient',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'default' => '3',
	) );

	// This field name suffix is common to all org types
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Calculated Rating Average', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'rating_average',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	// This field name suffix is common to all org types
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'addl_comments',
		'type' => 'textarea',
	) );

	// This field name suffix is common to all org types
	$cmb_eval_hosp->add_field( array(
		'name' => __( 'Evaluation Title', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'evaluation_title',
		'type' => 'text',
		'type' => 'hidden',
		'default' => 'rubes_set_eval_title', 
	) );
}