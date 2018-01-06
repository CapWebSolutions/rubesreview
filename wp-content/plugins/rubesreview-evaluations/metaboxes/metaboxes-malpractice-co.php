<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_action( 'cmb2_init', 'cws_register_malp_evaluation_metabox' );
function cws_register_malp_evaluation_metabox() {

	$prefix = 'rr_eval_malp_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_eval_malp = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Evaluation Details:', 'rubesreview-evaluations' ),
		'object_types' => array( 'malp_eval', ), 
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		// 'taxonomies'	=> array('eval_org_type'),
		// 'show_on_cb' => 'be_taxonomy_show_on_filter', // function should return a bool value
		// 'show_on_cb' => 'cmb_only_show_for_malp',   // only show this metabox for Malpractice Company
		// 'show_on_terms' => array(
			// 'eval_org_type' => array( 'malpractice-comapny' ),
		// ),
	) );
	
	// This field name is common to all org types
	$cmb_eval_malp->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'organization_name',
		'type' => 'text',
	) );

	// This field name is common to all org types
	// $cmb_eval_malp->add_field( array(
	// 	'name'             => __( 'Organization Type', 'rubesreview-evaluations' ),
	// 	'desc'			=> 'Select type of organization being added.', 
	// 	'id'               => $prefix . 'eval_org_type',
	// 	'type'             => 'select',
	// 	'show_option_none' => true,
	// 	'options'          => array(
	// 		'agency' => __( 'Agency', 'rubesreview-evaluations' ),
	// 		'hospital'   => __( 'Hospital', 'rubesreview-evaluations' ),
	// 		'malpractice'     => __( 'Malpractice Company', 'rubesreview-evaluations' ),
	// 		'continuinged'     => __( 'Continuing Ed Company', 'rubesreview-evaluations' ),
			
	// 	),
	// ) );


	$cmb_eval_malp->add_field( array(
		'name' => __( 'Overall Satisfaction with Malpractice Company', 'rubesreview-evaluations' ),
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

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Insurance Agent Polite', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'ins_agent_polite',
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
	$cmb_eval_malp->add_field( array(
		'name' => __( 'Insurance Agent Professional', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'ins_agent_professional',
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
	$cmb_eval_malp->add_field( array(
		'name' => __( 'Insurance Agent Knowledgeable', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'ins_agent_knowledgeable',
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
		$cmb_eval_malp->add_field( array(
		'name' => __( 'Choices Presented', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'choices_presented',
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

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Follow Up Answers', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'fu_answers',
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

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Limits Easy to Understand', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'limits_easy',
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

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Payment Options', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'payment_options',
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
	$cmb_eval_malp->add_field( array(
		'name' => __( 'Claim Handling', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'speaker_knowledge',
		'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rubesreview-evaluations' ),
			'2' => __( '2', 'rubesreview-evaluations' ),
			'3' => __( '3', 'rubesreview-evaluations' ),
			'4' => __( '4', 'rubesreview-evaluations' ),
			'5' => __( '5', 'rubesreview-evaluations' ),
			'0' => __( 'NA', 'rubesreview-evaluations' ),
		),
		'default' => '0',
	) );

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Jacket Provided', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'jacket_provided',
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
	$cmb_eval_malp->add_field( array(
		'name' => __( 'Reporting Information Provided', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'rpt_info_provided',
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

	// This field name is common to all org types
	$cmb_eval_malp->add_field( array(
		'name' => __( 'Calculated Rating Average', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'rating_average',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'addl_comments',
		'type' => 'textarea',
	) );

	$cmb_eval_malp->add_field( array(
		'name' => __( 'Evaluation Title', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'evaluation_title',
		'type' => 'text',
		'type' => 'hidden',
		'default' => 'rubes_set_eval_title', 
	) );
}

