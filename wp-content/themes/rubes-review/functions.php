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
add_action( 'after_setup_theme', 'rubes_review_localization_setup' );
function rubes_review_localization_setup(){
	load_child_theme_textdomain( 'rubes-review', get_stylesheet_directory() . '/languages' );
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
define( 'CHILD_THEME_NAME', 'Rubes Review' );
define( 'CHILD_THEME_URL', 'https://capwebsolutions.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'rubes_review_enqueue_scripts_styles' );
function rubes_review_enqueue_scripts_styles() {

	wp_enqueue_style( 'rubes-review-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'rubes-review-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'rubes-review-responsive-menu',
		'genesis_responsive_menu',
		rubes_review_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function rubes_review_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'rubes-review' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'rubes-review' ),
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
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'rubes-review' ), 'secondary' => __( 'Footer Menu', 'rubes-review' ) ) );

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
add_filter( 'genesis_author_box_gravatar_size', 'rubes_review_author_box_gravatar' );
function rubes_review_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'rubes_review_comments_gravatar' );
function rubes_review_comments_gravatar( $args ) {

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

// Display the archive description with a shortcode

function rubes_public_archive_description() { 
	$catlist = get_terms( 'category' );
	if ( ! empty( $catlist ) ) {
		foreach ( $catlist as $key => $item ) {
			if ( $item->slug == 'public' ) return $item->description;
		}
	}
	return;
}
add_shortcode('show_public_description', 'rubes_public_archive_description');



/**
 * Redirect non-admins to the homepage after logging into the site.
 *
 * @since 	1.0
 * @author  Tom McFarlin
 * Author URI: https://tommcfarlin.com/redirect-non-admin/#code
 */
function capweb_login_redirect( $redirect_to, $request, $user  ) {
	if ( ! is_wp_error( $user ) ) {
	// do redirects on successful login
		if ( $user->has_cap( 'administrator' ) || $user->has_cap( 'shop_manager' ) ) {
			return admin_url();
		} else {
			return site_url();
		}
    } else {
        // display errors, basically
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'capweb_login_redirect', 10, 3 );


/**
 * Display Featured Image floated to the right in single Posts.
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/how-to-display-featured-image-in-single-posts-in-genesis/
 */
function sk_show_featured_image_single_posts() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$image_args = array(
		'size' => 'featured-imaage',
		'attr' => array(
			'class' => 'aligncenter',
		),
	);

	genesis_image( $image_args );
}
add_action( 'genesis_entry_header', 'sk_show_featured_image_single_posts', 9 );

// Display the low rating hold notice by shortcode
function rubes_show_low_rating_hold_notice() { 
	$low_rating_notice = "<hr><strong>REMINDER:</strong> All evaluations with an average overall rating less than 3 will be placed on a 7 day administrative hold for review by Rube's Review management. Once approved,	 the evaluation will be published on Rube's Review.<hr>";
	return $low_rating_notice;
}
add_shortcode('lowratingnotice', 'rubes_show_low_rating_hold_notice');


// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}


	/**
 * Display Posts Shortcode - Move image after title
 * @see https://www.billerickson.net/code/using-display-posts-shortcode-output-filter
 *
 */
function be_dps_move_image_after_title( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class ) {
	$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $title . $image . $excerpt . '</' . $inner_wrapper . '>';
	return $output;
  }
  add_filter( 'display_posts_shortcode_output', 'be_dps_move_image_after_title', 10, 9 );

  
/* ref: https://docs.gravityforms.com/dynamically-populating-drop-down-fields/ */
add_filter( 'gform_pre_render_12', 'rubes_populate_posts' );
add_filter( 'gform_pre_validation_12', 'rubes_populate_posts' );
add_filter( 'gform_pre_submission_filter_12', 'rubes_populate_posts' );
add_filter( 'gform_admin_pre_render_12', 'rubes_populate_posts' );

function rubes_populate_posts( $form ) {

$thiscss = 'populate-organization';
$thistype = 'organization'; 
$thisplace = 'Select the Type of Organization to Evaluate'; 

$mytype = 'agency';
// Change query args based on type of org being populated
switch ( $mytype ){
	case 'agency' :
		$thiscss = 'populate-agency';
		$thistype = 'agency';
		$thisplace = 'Select the Agency to Evaluate'; 
	break;
	case 'hospital' :
		$thiscss = 'populate-hospital';
		$thistype = 'hospital';
		$thisplace = 'Select the Hospital to Evaluate'; 
	break;
	case 'malpractice':
		$thiscss = 'populate-malpractice';
		$thistype = 'malpractice-company'; 
		$thisplace = 'Select the Malpractice Company to Evaluate'; 
	break;
	case 'continuinged':
		$thiscss = 'populate-continuing-education';
		$thistype = 'continuing-education'; 
		$thisplace = 'Select the Continuing Ed Program to Evaluate'; 
	break;
}
// var_dump($thiscss, $thisplace, $thistype);
    foreach ( $form['fields'] as &$field ) {

        if ( $field->type != 'select' || strpos( $field->cssClass, $thiscss ) === false ) {
            continue;
		}
		$args = array(
			'numberposts' => -1,
			'post_status' => 'publish',
			'post_type' => 'organization',
			'org_type' => $thistype, 
		);

		$posts = get_posts( $args );


		$choices = array();

		foreach ( $posts as $post ) {
			// var_dump($post);
			$choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
		}

		$field->choices = $choices;
		$field->placeholder = $thisplace;
	}
    return $form;
}
