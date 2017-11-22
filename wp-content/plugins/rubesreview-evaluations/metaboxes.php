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


add_action( 'rubesreview-evaluations_init', 'cws_register_evaluation_metabox' );
function cws_register_evaluation_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_rubesreview_evaluation_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_evaluation = new_rubesreview-evaluations_box( array(
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
		'name' => __( 'Organization Phone', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_phone',
		'type' => 'text_small',
	) );
	$cmb_evaluation->add_field( array(
		'name' => __( 'Overall satisfaction with agency', 'rubesreview-evaluations' ),
		'id'   => $prefix . 'org_overall_satisfaction',
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