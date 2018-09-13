<?php

add_action( 'customize_register', 'rubes_register_theme_customizer' );
/*
 * Register Our Customizer Stuff Here
 */
function rubes_register_theme_customizer( $wp_customize ) {
	// Create custom panel.
	$wp_customize->add_panel( 'text_blocks', array(
		'priority'       => 500,
		'theme_supports' => '',
		'title'          => __( 'Text Blocks', 'rubes' ),
		'description'    => __( 'Set editable text for certain content.', 'rubes' ),
	) );
	// Add Footer Text
	// Add section.
	$wp_customize->add_section( 'custom_registration_intro' , array(
		'title'    => __('Change registration page intro.','rubes'),
		'panel'    => 'text_blocks',
		'priority' => 10
	) );
	// Add setting
	$wp_customize->add_setting( 'registration_intro_text_block', array(
		 'default'           => __( 'Register for Rube\'s Review', 'rubes' ),
		 'sanitize_callback' => 'sanitize_text'
	) );
	// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_registration_intro',
		    array(
		        'label'    => __( 'Registration Intro Text', 'rubes' ),
		        'section'  => 'custom_registration_intro',
		        'settings' => 'registration_intro_text_block',
		        'type'     => 'text'
		    )
	    )
	);


 	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}
}