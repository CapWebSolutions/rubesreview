<?php
/**
 * Include and setup custom metaboxes and fields for Continuing Ed evals.
 *
 */

add_action( 'cmb2_admin_init', 'cws_register_conted_evaluation_metabox' );
function cws_register_conted_evaluation_metabox() {

	$prefix = 'rr_eval_cont_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_eval_cont = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Evaluation Details:', 'rubesreview-evaluations' ),
		'object_types' => array( 'cont_eval', ), 
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
	) );
	
	// This field name is common to all org types
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'organization_name',
		'type' => 'text',
		'default' => ! empty( $_POST['submitted_post_title'] ) 
		? $_POST['submitted_post_title']
		: __( 'New Post', 'rubesreview-evaluations' ),
	) );

	$cmb_eval_cont->add_field( array(
		'name' => __( 'How Many Days Scheduled For', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'days_scheduled',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );
	$cmb_eval_cont->add_field( array(
		'name' => __( 'How Many Days Attended', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'days_attended',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Overall satisfaction with continuning ed', 'rubesreview-evaluations' ),
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

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Registration Staff Polite', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'reg_staff_polite',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Registration Staff Professional and Knowledgeable', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'reg_staff_prof_know',
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
		$cmb_eval_cont->add_field( array(
		'name' => __( 'Registration Process', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'reg_process',
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

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Refreshments', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'refreshments',
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

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Class Time', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'class_time',
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

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Break Time', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'break_time',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Speakers Knowledgeable', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'speaker_knowledge',
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

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Overall Exhibitor Rating', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'exhibitor_rating',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Evening Social Events', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'social_events',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Rate Location', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'location_rating',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Adequate CE Points', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'ce_points',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Was It Worth It', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'worth_it',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Do It Again', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'do_again',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Recommend CE to Colleague', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'recommend',
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
	$cmb_eval_cont->add_field( array(
		'name' => __( 'Calculated Rating Average', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'rating_average',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'addl_comments',
		'type' => 'textarea',
	) );

	$cmb_eval_cont->add_field( array(
		'name' => __( 'Evaluation Title', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'evaluation_title',
		'type' => 'text',
		'type' => 'hidden',
		'default' => 'rubes_set_eval_title', 
	) );
}

