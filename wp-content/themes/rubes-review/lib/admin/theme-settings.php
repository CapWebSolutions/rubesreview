<?php
/**
 * Rube's Review Settings
 *
 * This file registers all of Rube's Review's specific Theme Settings, accessible from
 * Genesis --> Rube's Review Settings.
 */ 
 
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @since 1.0.0
 *
 * @package rubesreview
 * @subpackage Subesreview_Settings
 */
class rubesreview_settings extends Genesis_Admin_Boxes {
	
	/**
	 * Create an admin menu item and settings page.
	 * @since 1.0.0
	 */
	function __construct() {
		
		// Specify a unique page ID. 
		$page_id = 'rubesreviewadmin';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Rubes Review Settings', 'rubesreview' ),
				'menu_title'  => __( 'Rubes Review Settings', 'rubesreview' ),
				'capability' => 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', 'rubesreview-settings' );
		$settings_field = 'rubesreview-settings';
		
		// Set the default values
		$default_settings = array(
			'rr_copyright' => 'My Name, All Rights Reserved',
			'rr_credit' => 'Website by Cap Web Solutions',
			'rr_resubmit_eval' => '6', 
			);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
	}

	/**
	 * Upload the Javascripts for the media uploader
	 */
	public function upload_scripts() {
	}
	
	/** 
	 * Set up Sanitization Filters
	 * @since 1.0.0
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 */	
	function sanitization_filters() {
					
		genesis_add_option_filter( 'safe_html', $this->settings_field,
			array(
				'rr_copyright',
				'rr_credit',
			) );
	}
	
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 * @since 1.0.0
	 */
	function metaboxes() {
		// add_meta_box('sr_scripture_text_metabox', 'Scripture Text', array($this, 'sr_scripture_text_metabox' ), $this->pagehook, 'main', 'high');
		// add_meta_box('sr_poet_diary_bg_image_metabox', 'Poet Diary Background Image', array( $this, 'sr_poet_diary_bg_image_metabox' ), $this->pagehook, 'main', 'high');
		// add_meta_box('sr_my_works_len_metabox', '"My Works" Minimum Lengths', array( $this, 'sr_my_works_len_metabox' ), $this->pagehook, 'main', 'high');
		// add_meta_box('sr_submit_details', 'POTM Submission Defaults', array( $this, 'sr_submit_details_metabox' ), $this->pagehook, 'main', 'default');
		// add_meta_box('sr_potm_details', 'POTM Selection', array( $this, 'sr_potm_selection_metabox' ), $this->pagehook, 'main', 'default');
		add_meta_box('rr_resubmit_eval_metabox', 'Resubmit Interval', array( $this, 'rr_resubmit_eval_metabox' ), $this->pagehook, 'main', 'default');
	}

	/**
	 * Scripture Text Metabox
	 * @since 1.0.0
	 */
	// function rr_scripture_text_metabox() {
	
	// 	echo '<p><input type="text" name="' . $this->get_field_name( 'rr_scripture_text' ) . '" id="' . $this->get_field_id( 'rr_scripture_text' ) . '" value="' . esc_attr( $this->get_field_value( 'rr_scripture_text' ) ) . '" size="150" /></p>';
	// }

	/**
	 * Resubmit Eval Period Settings Metabox
	 * @since 1.0.0
	 */
	function rr_resubmit_eval_metabox() {
		echo '<p><strong>Eval Resubmit Interval</strong> (Default is 6 months)</p>';
		echo '<p><input type="number" min="1" name="' . $this->get_field_name( 'rr_resubmit_eval' ) . '" id="' . $this->get_field_id( 'rr_resubmit_eval' ) . '" value="' . esc_attr( $this->get_field_value( 'rr_resubmit_eval' ) ) . '" size="2" /></p>';
	}
	/*
	 * Submit Details Metabox
	 * @since 1.0.0
	 */
	// function rr_submit_details_metabox() {
	// 	echo '<p><strong>Start Day of Month ( 1 - 27 )</p>';
	// 	echo '<p><input type="number" value="23" min="1" max="27" name="' . $this->get_field_name( 'rr_submit_start_day_of_month' ) . '" id="' . $this->get_field_id( 'rr_submit_start_day_of_month' ) . '" value="' . esc_attr( $this->get_field_value( 'rr_submit_start_day_of_month' ) ) . '" size="2" /></p>';
	// 	echo '<p><strong>Start Hour ( 0 - 23 )</p>';
	// 	echo '<p><input type="number" value="0" min="0" max="23" name="'  . $this->get_field_name( 'rr_submit_start_time_of_day' ) . '" id="' . $this->get_field_id( 'rr_submit_start_time_of_day' ) . '" value="' . esc_attr( $this->get_field_value( 'rr_submit_start_time_of_day' ) ) . '" size="2" /></p>';
	// 	echo '<p><strong>Duration in minutes ( 1-59 )</p>';
	// 	echo '<p><input type="number" value="30" min="1" max="59" name="' . $this->get_field_name( 'rr_submit_duration' ) . '" id="' . $this->get_field_id( 'rr_submit_duration' ) . '" value="' . esc_attr( $this->get_field_value( 'rr_submit_duration' ) ) . '" size="2" /></p>';
	// }	
	/*
	 * POTM Selection Metabox
	 * @since 1.0.0
	 */
	// function rr_potm_selection_metabox() {
	// 	echo '<p><strong>Video URL from media library.</p>';
	// 	echo '<p><input type="video" name="' . $this->get_field_name( '_potm_video_url' ) . '" id="' . $this->get_field_id( '_potm_video_url' ) . '" value="' . esc_attr( $this->get_field_value( '_potm_video_url' ) ) . '" size="150" /></p>';
	// 	echo '<p><strong>Video Cover Poster from media library.</p>';
	// 	echo '<p><input type="url" name="' . $this->get_field_name( '_potm_video_poster' ) . '" id="' . $this->get_field_id( '_potm_video_poster' ) . '" value="' . esc_attr( $this->get_field_value( '_potm_video_poster' ) ) . '" size="150" /></p>';
	// 	echo '<p><strong>Poet name</p>';
	// 	echo '<p><input type="text" name="'  . $this->get_field_name( '_potm_name' ) . '" id="' . $this->get_field_id( '_potm_name' ) . '" value="' . esc_attr( $this->get_field_value( '_potm_name' ) ) . '" size="50" /></p>';
	// 	echo '<p><strong>Poet location</p>';
	// 	echo '<p><input type="text" name="' . $this->get_field_name( '_potm_location' ) . '" id="' . $this->get_field_id( '_potm_location' ) . '" value="' . esc_attr( $this->get_field_value( '_potm_location' ) ) . '" size="50" /></p>';
	// }
}

/**
 * Add the Theme Settings Page
 * @since 1.0.0
 */
function rubesreview_add_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new rubesreview_settings;	 	
}
add_action( 'genesis_admin_menu', 'rubesreview_add_settings' );
