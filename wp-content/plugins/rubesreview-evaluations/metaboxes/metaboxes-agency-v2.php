<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_action( 'cmb2_init', 'cws_register_agency_evaluation_metabox' );
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
		'name' => __( 'NAME:Overall satisfaction with Recruiter who placed you', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'placement_recruiter',
		'type' => 'radio_inline_stars',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
		'label_cb' => 'LABEL:Overall satisfaction with Recruiter who placed you',
		) );

	$cmb_evaluation->add_field( array(
		'name' => __( 'Recruiter polite and courteous', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_polite',
		'type' => 'radio_inline_stars',
		// 'render_row_cb' => 'override_render_field_callback',
		'label_cb' => 'Recruiter polite and courteous',
		// 'before_field' => '<div class="evaluation-org-stars-#"',
		// 'after_field' => '</div>',
		// 'before_row' => '<div class="evaluation-org-stars-wrap>',
		// 'after_row' => '</div>',
		// 'attributes'  => array(
		// 	'readonly' => 'readonly',
		// 	'disabled' => 'disabled',
		// ),
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Recruiter effective and professional', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_effect_prof',
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
		'name' => __( 'Recruiter accurate describe', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_accurate',
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
		'name' => __( 'Recruiter made effort', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_made_effort',
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
		'name' => __( 'Recruiter knowledgeable', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_knowledgeable',
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
		'name' => __( 'Recruiter helpful credentialing', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_helpful_creds',
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
		'name' => __( 'Recruiter helpful travel', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recruiter_helpful_travel',
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
		'name' => __( 'Work itinerary, hospital details', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'work_itinerary',
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
		'name' => __( 'Orientation by hospital', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'orientation_by_hosp',
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
		'name' => __( 'Adequate work hours', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'adequate_work_hours',
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
		'name' => __( 'Adequate work shifts', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'adequate_work_shifts',
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
		'name' => __( 'Hourly rate paid timely', 'rubesreview-evaluations' ),
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
		'name' => __( 'Overtime hours offered', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'overtime_hours_offered',
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
		'name' => __( 'Overtime pay offered', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'overtime_pay_offered',
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
		'name' => __( 'Per diem offered', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'per_diem_offered',
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
		'name' => __( 'Pleased with payment method', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'pleased_payment_method',
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
		'name' => __( 'Direct deposit or by mail', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'direct_deposit_by_mail',
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
		'name' => __( 'Asssitance paying state licenses', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'assistance_paying_state_lic',
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
		'name' => __( 'Malpractice coverage provided', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'malpractice_coverage_provided',
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
		'name' => __( 'Any health insurance provided', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'health_insurance_provided',
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
		'name' => __( 'Agency provide holiday gifts', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'holiday_gifts',
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
		'name' => __( 'Recommend to someone else', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recommend_2_someone',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
		),
	) );

	// This field name suffix is common to all org types
	$cmb_evaluation->add_field( array(
		'name' => __( 'Calculated Rating Average', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'rating_average',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	// This field name suffix is common to all org types
	$cmb_evaluation->add_field( array(
		'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'addl_comments',
		'type' => 'textarea',
	) );

	// This field name suffix is common to all org types
	$cmb_evaluation->add_field( array(
		'name' => __( 'Evaluation Title', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'evaluation_title',
		'type' => 'text',
		'type' => 'hidden',
		'default' => 'rubes_set_eval_title', 
	) );
}