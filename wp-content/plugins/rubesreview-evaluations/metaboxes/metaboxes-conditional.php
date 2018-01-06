<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_action( 'cmb2_admin_init', 'cws_register_conditional_evaluation_metabox' );
function cws_register_conditional_evaluation_metabox() {

	$cmb_conditional = new_cmb2_box( array(
		'id'           => 'eval_org_type_metabox',
		'title'        => __( 'Evaluation Organization Conditional Metabox', 'rubesreview-evaluations' ),
		'object_types' => array( 'evaluation' ), // Post types
	) );
	

	$cmb_conditional->add_field( array(
		'name' => __( 'Organization Name', 'rubesreview-evaluations' ),
		'id'   => 'rr_organization_name',
		'type' => 'text',
	) );

	$cmb_conditional->add_field( array(
		'name'		=> __( 'Organization Type', 'rubesreview-evaluations' ),
		'id'		=> 'rr_org_type',
		'type'		=> 'select',
		'default'	=> 'agency',
		'options'	=> array(
			'agency'				=> __( 'Agency', 'rubesreview-evaluations' ),
			'hospital'				=> __( 'Hospital', 'rubesreview-evaluations' ),
			'malpractice-company'	=> __( 'Malpractice Company', 'rubesreview-evaluations' ),
			'continuing-education'	=> __( 'Continuing Education', 'rubesreview-evaluations' ),
		),
	) );
}

/**
 * Only display a metabox if the approprite org type is selected
 * @param  object $cmb_conditional CMB2 object
 * @return bool        True/false whether to show the metabox
 */
function cmb_only_show_for_hosp( $cmb ) {
	$status = get_post_meta( $cmb->object_id(), 'rr_org_type', 1 );
	return 'hospital' === $status;
}
function cmb_only_show_for_agnt( $cmb ) {
	$status = get_post_meta( $cmb->object_id(), 'rr_org_type', 1 );
	return 'agency' === $status;
}
function cmb_only_show_for_malp( $cmb ) {
	$status = get_post_meta( $cmb->object_id(), 'rr_org_type', 1 );
	return 'malpractice-company' === $status;
}
function cmb_only_show_for_cont( $cmb ) {
	$status = get_post_meta( $cmb->object_id(), 'rr_org_type', 1 );
	return 'continuing-education' === $status;
}