<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 714,
	'height'          => 384,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_page-widget_widget_area', 'genesis_do_nav', 12 );

add_action('get_header', 'child_add_nav_to_interior_pages');
function child_add_nav_to_interior_pages() {
	if ( !is_Page('20') ) {
		add_action( 'genesis_header', 'genesis_do_nav', 12 );
	}
}

// Remove the secondary navigation menu.
// remove_action( 'genesis_after_header', 'genesis_do_subnav' );
// add_action( 'genesis_footer', 'genesis_do_subnav', 5 );


// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Set up widget areas for front page. 
genesis_register_widget_area(
	array(
		'id'		=> 'page-widget',
		'name'		=> __( 'Page Widget', 'rubesreview' ),
		'description'	=> __( 'This is the widget area for a specific page.', 'rubesreview' ),
	) 
);

genesis_register_widget_area(
	array(
		'id'		=> 'spotlight-widget',
		'name'		=> __( 'Spotlight Widget', 'rubesreview' ),
		'description'	=> __( 'This is the widget area for a specific page.', 'rubesreview' ),
	) 
);

genesis_register_widget_area(
	array(
		'id'		=> 'spotlight-cta-widget',
		'name'		=> __( 'Spotlight CTA Widget', 'rubesreview' ),
		'description'	=> __( 'This is the CTA widget area for the front page.', 'rubesreview' ),
	) 
);

//* Register widget areas

genesis_register_sidebar( array(
	'id'          => 'logged-in-sidebar',
	'name'        => __( 'Logged-in sidebar', 'rubesreview' ),
	'description' => __( 'This is the right sidebar displayed for logged in users.', 'rubesreview' ),
) );
genesis_register_sidebar( array(
	'id'          => 'logged-out-sidebar',
	'name'        => __( 'Logged-out Sidebar', 'rubesreview' ),
	'description' => __( 'This is the right sidebar displayed for logged out users.', 'rubesreview' ),
) );

	/**
 * Setup widget counts.
 *
 * @param string $id The widget area ID.
 * @return int Number of widgets in the widget area.
 */
function custom_count_widgets( $id ) {
    global $sidebars_widgets;

    if ( isset( $sidebars_widgets[ $id ] ) ) {
        return count( $sidebars_widgets[ $id ] );
    }
}

/**
 * Set the widget class for flexible widgets.
 *
 * @param string $id The widget area ID.
 * @return Name of column class.
 */
function custom_widget_area_class( $id ) {
    $count = custom_count_widgets( $id );

    $class = '';

    if ( 1 === $count ) {
        $class .= ' widget-full';
    } elseif ( 0 === $count % 3 ) {
        $class .= ' widget-thirds';
    } elseif ( 0 === $count % 4 ) {
        $class .= ' widget-fourths';
    } elseif ( 1 === $count % 2 ) {
        $class .= ' widget-halves uneven';
    } else {
        $class .= ' widget-halves';
    }

    return $class;
}

/**********************************
 *
 * Replace Header Site Title as background image with Inline Logo
 *
 * @author AlphaBlossom / Tony Eppright, Neil Gee
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 * @link https://wpbeaches.com/adding-in-a-responsive-html-logoimage-header-via-the-customizer-for-genesis/
 *
 * @edited by Sridhar Katakam
 * @link https://sridharkatakam.com/
 *
************************************/
// add_filter( 'genesis_seo_title', __NAMESPACE__ . '\custom_header_inline_logo', 10, 3 );
function custom_header_inline_logo( $title, $inside, $wrap ) {

	if ( get_header_image() ) {
		$logo = '<img  src="' . get_header_image() . '" width="' . esc_attr( get_custom_header()->width ) . '" height="' . esc_attr( get_custom_header()->height ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . ' Homepage">';
	} else {
		$logo = get_bloginfo( 'name' );
	}

	$inside = sprintf( '<a href="%s">%s<span class="screen-reader-text">%s</span></a>', trailingslashit( home_url() ), $logo, get_bloginfo( 'name' ) );

	// Determine which wrapping tags to use
	$wrap = genesis_is_root_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	// A little fallback, in case an SEO plugin is active
	$wrap = genesis_is_root_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	// And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );

}

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {
	// unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );

//* Customize the entry meta in the entry footer (requires HTML5 theme support)
// add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
// function sp_post_meta_filter($post_meta) {
// 	$post_meta = '[post_categories] [post_tags]';
// 	return $post_meta;
// }

// Customize entry meta header
// ref: https://wpbeaches.com/change-genesis-post-entry-footer-meta-output/
add_filter( 'genesis_post_info', 'themeprefix_post_info_filter' );
function themeprefix_post_info_filter( $post_info ) {
 $post_info = '[post_date]';
 return $post_info;
}
// Customize  entry meta footer
add_filter( 'genesis_post_meta', 'themeprefix_post_meta_filter' );
function themeprefix_post_meta_filter( $post_meta ) {
 $post_meta = '[post_categories before="Filed Under: "]<br>[post_tags before="Tags: "]';
 return $post_meta;
}


 
//* Reposition the footer
if ( is_page( 578 ) ) {
	remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
	add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
	add_action( 'genesis_after', 'genesis_do_footer', 12 );
	add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );
}


/**
	 * @link http://webdevstudios.com/2015/03/30/use-cmb2-to-create-a-new-post-submission-form/ Original tutorial
	 */
	
	
	/**
	 * Register the form and fields for our front-end submission form
	 */
	function rubesreview_frontend_form_register() {
		$cmb = new_cmb2_box( array(
			'id'           => 'front-end-evaluation-form',
			'object_types' => array( 'evaluation' ),
			'hookup'       => false,
			'save_fields'  => false,
			'taxonomies'	=> array('orgtype'),
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Organization Name', 'rubesreview-evaluations' ),
			'id'      => 'submitted_organization_name',
			'desc' => __( 'Name of organization you are evaluating.', 'rubesreview-evaluations' ),
			// 'name' => __( 'Organization Title', 'rubesreview-evaluations' ),
			// 'id'   => '_rubesreview_evaluation_organization',
			'type'    => 'text',
			'default' => ! empty( $_POST['_rubesreview_evaluation_organization'] )
				? $_POST['_rubesreview_evaluation_organization']
				: __( 'New Evaluation', 'rubesreview-evaluations' ),
		) );

		$cmb->add_field( array(
			'default_cb' => 'rubesreview_maybe_set_default_from_posted_values',
			'name'       => __( 'Organization Type', 'rubesreview-evaluations' ),
			'id'         => 'org_type',
			'type'       => 'taxonomy_select',
			'taxonomy'   => 'orgtype', // Taxonomy Slug
			'options' => array(
				'Agency' => __( 'Agency', 'rubesreview-evaluations' ),
				'Hospital' => __( 'Hospital', 'rubesreview-evaluations' ),
				'Malpractice Company' => __( 'Malpractice Company', 'rubesreview-evaluations' ),
				'Continuing Education' => __( 'Continuing Educaiton', 'rubesreview-evaluations' ),	),
		) );

		$cmb->add_field( array(
			'name' => __( 'Address', 'rubesreview-evaluations' ),
			'id'   => '_rubesreview_evaluation_org_address',
			'desc' => __( 'Address of location you are evaluating.', 'rubesreview-evaluations' ),
			'type' => 'text',
		) );
		// $cmb->add_field( array(
		// 	'name' => __( 'Website URL', 'rubesreview-evaluations' ),
		// 	'id'   => '_rubesreview_evaluation_org_web',
		// 	'type' => 'text_url',
		// ) );
		$cmb->add_field( array(
			'name' => __( 'Organization Phone', 'rubesreview-evaluations' ),
			'id'   => '_rubesreview_evaluation_org_phone',
			'type' => 'text_small',
		) );
		$cmb->add_field( array(
			'name' => __( 'Overall satisfaction with agency', 'rubesreview-evaluations' ),
			'id'   => '_rubesreview_evaluation_org_overall_satisfaction',
			'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
			'type' => 'text',
			'attributes' => array(
				'type' => 'number',
				'max' => '5',
				'min' => '1',			
			),
		) );

	// $cmb->add_field( array(
	// 		'name' => __( 'Hourly Rate', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_hourly_rate',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Paid in a Timely Manner', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_paid_timely',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Hours Worked', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_hours_worked',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Arranged Flight', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_arranged_flight',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Arranged Car', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_arranged_car',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Hotel Apartment Accommodations', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_hotel_appt_accommodations',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );

	// $cmb->add_field( array(
	// 		'name' => __( 'Per Diem', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_per_diem',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Professionalism of contact person', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_professionalism_rating',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',			
	// 		),
	// 	) );
	// $cmb->add_field( array(
	// 		'name' => __( 'Overall Rating', 'rubesreview-evaluations' ),
	// 		'id'   => '_rubesreview_evaluation_org_overall_rating',
	// 		'desc' => __( '1 to 5 (5 highest)', 'rubesreview-evaluations' ),
	// 		'type' => 'text',
	// 		'attributes' => array(
	// 			'type' => 'number',
	// 			'max' => '5',
	// 			'min' => '1',	
	// 		)
	// 	) );
		// $cmb->add_field( array(
		// 	'default_cb' => 'rubesreview_maybe_set_default_from_posted_values',
		// 	'name'       => __( 'Featured Image for New Evaluation', 'rubesreview-evaluations' ),
		// 	'id'         => 'submitted_post_thumbnail',
		// 	'type'       => 'text',
		// 	'attributes' => array(
		// 		'type' => 'file', // Let's use a standard file upload field
		// 	),
		// ) );
	

			$cmb->add_field( array(
			'default_cb' => 'rubesreview_maybe_set_default_from_posted_values',
			// 'name'       => __( 'New Post Content', 'rubesreview-evaluations' ),
			'name' => __( 'Additional Comments', 'rubesreview-evaluations' ),
			'id'         => '_rubesreview_evaluation_org_additional_comments',
			'desc' => __( 'Add any additional comments to your evaluation.', 'rubesreview-evaluations' ),
			'type'       => 'wysiwyg',
			'options'    => array(
				'textarea_rows' => 12,
				'media_buttons' => false,
			),
		) );
		$cmb->add_field( array(
			'default_cb' => 'rubesreview_maybe_set_default_from_posted_values',
			'name'       => __( 'Your Name', 'rubesreview-evaluations' ),
			'id'         => 'submitted_author_name',
			'type'       => 'text',
		) );
	
		$cmb->add_field( array(
			'default_cb' => 'rubesreview_maybe_set_default_from_posted_values',
			'name'       => __( 'Your Email', 'rubesreview-evaluations' ),
			'id'         => 'submitted_author_email',
			'type'       => 'text_email',
		) );
	
	}
	add_action( 'cmb2_init', 'rubesreview_frontend_form_register' );
	
	/**
	 * Sets the front-end-evaluation-form field values if form has already been submitted.
	 *
	 * @return string
	 */
	function rubesreview_maybe_set_default_from_posted_values( $args, $field ) {
		if ( ! empty( $_POST[ $field->id() ] ) ) {
			return $_POST[ $field->id() ];
		}
	
		return '';
	}
	
	/**
	 * Gets the front-end-evaluation-form cmb instance
	 *
	 * @return CMB2 object
	 */
	function rubesreview_frontend_cmb2_get() {

		// Use ID of metabox in rubesreview_frontend_form_register
		$metabox_id = 'front-end-evaluation-form';
	
		// Post/object ID is not applicable since we're using this form for submission
		$object_id  = 'fake-object-id';
	
		// Get CMB2 metabox object
		return cmb2_get_metabox( $metabox_id, $object_id );
	}
	
	/**
	 * Handle the get_rubes_evaluation shortcode
	 *
	 * @param  array  $atts Array of shortcode attributes
	 * @return string       Form html
	 */
	function rubesreview_do_frontend_form_submission_shortcode( $atts = array() ) {
	
		// Get CMB2 metabox object
		$cmb = rubesreview_frontend_cmb2_get();
	
		// Get $cmb object_types
		$post_types = $cmb->prop( 'object_types' );
	
		// Current user
		$user_id = get_current_user_id();

	
		// Parse attributes
		$atts = shortcode_atts( array(
			'post_author' => $user_id ? $user_id : 1, // Current user, or admin
			'post_status' => 'publish',
			'post_type'   => 'evaluation',
			'org_type'	=> 'agency',
		), $atts, 'get_rubes_evaluation' );

		/*
		 * Let's add these attributes as hidden fields to our cmb form
		 * so that they will be passed through to our form submission
		 */
		foreach ( $atts as $key => $value ) {
			$cmb->add_hidden_field( array(
				'field_args'  => array(
					'id'    => "atts[$key]",
					'type'  => 'hidden',
					'default' => $value,
				),
			) );
		}
	
		// Initiate our output variable
		$output = '';
	
		// Get any submission errors

		if ( ( $error = $cmb->prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
			// If there was an error with the submission, add it to our ouput.
			$output .= '<h3>' . sprintf( __( 'There was an error in the submission: %s', 'rubesreview-evaluations' ), '<strong>'. $error->get_error_message() .'</strong>' ) . '</h3>';
		}
	
		// If the post was submitted successfully, notify the user.
		if ( isset( $_GET['post_submitted'] ) && ( $post = get_post( absint( $_GET['post_submitted'] ) ) ) ) {
	
			// Get submitter's name
			$name = get_post_meta( $post->ID, 'submitted_author_name', 1 );
			$name = $name ? ' '. $name : '';
	
			// Add notice of submission to our output
			$output .= '<h3>' . sprintf( __( 'Thank you%s. The new evaluation has been published. View it on the <a href="/ratings/">Ratings</a> page.', 'rubesreview-evaluations' ), esc_html( $name ) ) . '</h3>';
		}
	
		// Get our form from the front end
		$output .= cmb2_get_metabox_form( $cmb, 'fake-object-id', array( 'save_button' => __( 'Submit Evaluation', 'rubesreview-evaluations' ) ) );
	var_dump($output);
		return $output;
	}
	add_shortcode( 'get_rubes_evaluation', 'rubesreview_do_frontend_form_submission_shortcode' );
	
	/**
	 * Handles form submission on save. Redirects if save is successful, otherwise sets an error message as a cmb property
	 *
	 * @return void
	 */
	function rubesreview_handle_frontend_new_post_form_submission() {
	
		// If no form submission, bail
		if ( empty( $_POST ) || ! isset( $_POST['submit-cmb'], $_POST['object_id'] ) ) {
			return false;
		}
	
		// Get CMB2 metabox object
		$cmb = rubesreview_frontend_cmb2_get();
	
		$post_data = array();
		// Get our shortcode attributes and set them as our initial post_data args
		if ( isset( $_POST['atts'] ) ) {
			foreach ( (array) $_POST['atts'] as $key => $value ) {
				$post_data[ $key ] = sanitize_text_field( $value );
			}
			unset( $_POST['atts'] );
		}
	
		// Check security nonce
		if ( ! isset( $_POST[ $cmb->nonce() ] ) || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() ) ) {
			return $cmb->prop( 'submission_error', new WP_Error( 'security_fail', __( 'Security check failed.' ) ) );
		}
	
		// Check title submitted - only required field right now 
		if ( empty( $_POST['submitted_organization_name'] ) ) {
			return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'Please enter an Organization Name.' ) ) );
		}
	
		// And that the title is not the default title
		if ( $cmb->get_field( 'submitted_organization_name' )->default() == $_POST['submitted_organization_name'] ) {
			return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'Please enter an Organization Name.' ) ) );
		}
	
		/**
		 * Fetch sanitized values - to sanitize the array of fields data submitted, We’ll pass it the $_POSTvariable. Once the values have been properly sanitized, let’s set our new post’s title and content from those fields and insert it!
		 */
		$sanitized_values = $cmb->get_sanitized_values( $_POST );
	
		// Set our post data arguments
		$post_data['post_title']   = $sanitized_values['submitted_organization_name'];
		unset( $sanitized_values['submitted_organization_name'] );
		$post_data['post_content'] = $sanitized_values['_rubesreview_evaluation_org_additional_comments'];
		unset( $sanitized_values['_rubesreview_evaluation_org_additional_comments'] );

		$post_data['_rubesreview_evaluation_org_address'] = $sanitized_values['_rubesreview_evaluation_org_address'];
		unset( $sanitized_values['_rubesreview_evaluation_org_address'] );

		$post_data['post_category'] = $cmb->get_field( 'org_type');

		// Create the new post 
		// var_dump($post_data);
		$new_submission_id = wp_insert_post( $post_data, true );
	
		// If we hit a snag, update the user
		if ( is_wp_error( $new_submission_id ) ) {
			return $cmb->prop( 'submission_error', $new_submission_id );
		}
	
		$cmb->save_fields( $new_submission_id, 'evaluation', $sanitized_values );
	
		/**
		 * Other than post_type and post_status, we want
		 * our uploaded attachment post to have the same post-data
		 */
		unset( $post_data['post_type'] );
		unset( $post_data['post_status'] );
	
		// Try to upload the featured image
		$img_id = rubesreview_frontend_form_photo_upload( $new_submission_id, $post_data );
	
		// If our photo upload was successful, set the featured image
		if ( $img_id && ! is_wp_error( $img_id ) ) {
			set_post_thumbnail( $new_submission_id, $img_id );
		}
	
		/*
		 * Redirect back to the form page with a query variable with the new post ID.
		 * This will help double-submissions with browser refreshes
		 */
		wp_redirect( esc_url_raw( add_query_arg( 'post_submitted', $new_submission_id ) ) );
		exit;
	}
	add_action( 'cmb2_after_init', 'rubesreview_handle_frontend_new_post_form_submission' );
	
	/**
	 * Handles uploading a file to a WordPress post
	 *
	 * @param  int   $post_id              Post ID to upload the photo to
	 * @param  array $attachment_post_data Attachement post-data array
	 */
	function rubesreview_frontend_form_photo_upload( $post_id, $attachment_post_data = array() ) {
		// Make sure the right files were submitted
		if (
			empty( $_FILES )
			|| ! isset( $_FILES['submitted_post_thumbnail'] )
			|| isset( $_FILES['submitted_post_thumbnail']['error'] ) && 0 !== $_FILES['submitted_post_thumbnail']['error']
		) {
			return;
		}
	
		// Filter out empty array values
		$files = array_filter( $_FILES['submitted_post_thumbnail'] );
	
		// Make sure files were submitted at all
		if ( empty( $files ) ) {
			return;
		}
	
		// Make sure to include the WordPress media uploader API if it's not (front-end)
		if ( ! function_exists( 'media_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
		}
	
		// Upload the file and send back the attachment post ID
		return media_handle_upload( 'submitted_post_thumbnail', $post_id, $attachment_post_data );
	}

/**
 * Check if PODS is running
 */
function pods_is_installed () {
	
		if ( defined( 'PODS_VERSION' ) ) {
			return true;
		}
		return false;
	}