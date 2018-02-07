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
		add_meta_box('rr_resubmit_eval_metabox', 'Resubmit Interval', array( $this, 'rr_resubmit_eval_metabox' ), $this->pagehook, 'main', 'default');
	}

	/**
	 * Resubmit Eval Period Settings Metabox
	 * @since 1.0.0
	 */
	function rr_resubmit_eval_metabox() {
		echo '<p><strong>Eval Resubmit Interval</strong> (Default is 6 months)</p>';
		echo '<p><input type="number" min="1" name="' . $this->get_field_name( 'rr_resubmit_eval' ) . '" id="' . $this->get_field_id( 'rr_resubmit_eval' ) . '" value="' . esc_attr( $this->get_field_value( 'rr_resubmit_eval' ) ) . '" size="2" /></p>';
	}

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
