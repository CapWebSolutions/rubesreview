<?php
// BuddyPress hacks and mods will go here


 /*
 * Remove BuddyPress header and cover photo.
 */
add_filter('bp_is_profile_cover_image_active', '__return_false');
add_filter('bp_is_groups_cover_image_active', '__return_false');

//* These two DO make changes to the target URL of the bp profile page menu .
define('BP_SETTINGS_SLUG', 'settings');
define('BP_XPROFILE_SLUG', 'profile');  

// to enable make the url 'bp_loggedin_user_domain' in the button module settings
function fl_button_bp_loggedin_user_link($settings, $node) {

    if (function_exists('bp_loggedin_user_domain') ) {
        if(isset($settings->type) && $settings->type == 'button') {
            if (isset($settings->link) && $settings->link == 'bp_loggedin_user_domain') {
                $settings->link = bp_loggedin_user_domain();
            }
        }
    }
    return $settings;
}
add_action('fl_builder_node_settings', 'fl_button_bp_loggedin_user_link', 10, 2);

// Dynamically set name of page in header module on Buddypress pages. 
function fl_text_edit_page_heading( $settings, $node) {
    
    if (bp_current_component() ) {
        if (isset($settings->type) && $settings->type == 'heading'  && $settings->heading == 'fl_text_edit_page_heading' ) {
            $settings->heading = 'My Rube\'s ' . ucfirst(bp_current_component());
        }
    } elseif (is_page('credential-sharing') ) {
        $settings->heading = 'My Rube\'s Credential Sharing';
    }
    return $settings;
}
add_action('fl_builder_node_settings', 'fl_text_edit_page_heading', 9, 2);


// Add some customization to the registration form
// Ref this help doc: https://buddypress.org/support/topic/buddypress-registration-shortcode/
function add_top_customization_and_welcome_msg() {
    FLBuilder::render_query(
        array(
        'post_type' => 'fl-builder-template',
        'p'         => 1515 // Beaver Header Template ID
        ) 
    );
}
add_action('bp_before_register_page', 'add_top_customization_and_welcome_msg');


/**
 * Redirect buddypress and non-public pages to registration page
 */
function rubes_page_template_redirect() {
    global $post;
    //If on the front page, or if the user is logged in.
    if ( is_front_page() || is_user_logged_in() ) { return; }
    
    //Set list of okay pages for non-members to visit.
    $ok_pages = array( 'about', 'careers', 'contact', 'sponsors', 'sponsors-2', 'login-to-rubes-review', 'spotlight-for-non-members' );

    //If on one of the good pages, return.
    if ( is_page($ok_pages) ) { return; }

    // If on the Buddypress activation or registration page, return.
    if ( bp_is_activation_page() || bp_is_register_page() ) { return; }

    // If we are on a public page, get outta here. All good.
    if (in_category( 'public' ) ) { return;
    }

    //Oops. Not supposed to be on this page. Redirect to registration page.
    wp_redirect(home_url( '/join/' ));
    exit();
}
add_action( 'template_redirect', 'rubes_page_template_redirect' );

add_action( 'bp_before_register_page', 'rubes_add_registration_intro' );
/**
 * Add Registration Intro
 *
 * Add introductory text to Buddypress registration page.
.
 *
 * @link https://capwebsolutions.com
 *
 * @package WordPress
 * @since 1.0.0
 * @license GNU General Public License 2.0+
 */
function rubes_add_registration_intro() {

    $intro_content = "";
    $intro_content = rubes_get_registration_intro_text( $intro );
    echo sprintf( '<p>%s</p>', $intro_content);

    return;
}

/**
 * Get intro text from customizer
 *
 * Retreive any text from customizer text block to use for registration intro text.
 *
 * @link https://capwebsolutions.com
 *
 * @package WordPress
 * @since 1.0.0
 * @license GNU General Public License 2.0+
 */

function rubes_get_registration_intro_text( $intro ) {
	if( get_theme_mod( 'registration_intro_text_block') != "" ) {
		return get_theme_mod( 'registration_intro_text_block');
	}
	else{
		return 'Register for Rube\'s Review'; // Default text if nothing entered.
	}
}