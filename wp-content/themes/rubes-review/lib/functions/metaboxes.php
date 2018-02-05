<?php
add_action( 'cmb2_init', 'cws_register_theme_settings_page_metabox' );
/**
 * Single Post Meta
 */
function cws_register_theme_settings_page_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_rubesreview_';

	$rubes_selection_metabox = new_cmb2_box( array(
		'id'           => $prefix  . 'metabox',
		'title'        => __( 'Rubes Settings', 'rubesreview' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$rubes_selection_metabox->add_field( array(
		'name'	=> __( 'Resubmit Eval Interval', 'rubesreview' ),
		'desc' => __( 'Interval between evaluation submissions', 'rubesreview'),
		'id'	=> $prefix . 'rr_resubmit_eval',
		'type'	=> 'text',
	) );
}
