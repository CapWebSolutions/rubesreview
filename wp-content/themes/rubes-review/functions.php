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

//* Start the Child Theme engine
require_once( 'lib/init.php' );

// //* Initialize the Child Theme
rubesreview_init();

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'rubes_review_localization_setup' );
function rubes_review_localization_setup(){
	load_child_theme_textdomain( 'rubes-review', get_stylesheet_directory() . '/languages' );
	load_child_theme_textdomain( 'rubes-review', content_url() . '/languages/plugins' );
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
define( 'CHILD_THEME_VERSION', '1.7.1' );

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'genesis_meta', 'cws_load_stylesheet' );
/**
 * Loads versioned stylesheet.
 *
 * @author Matt Ryan
 * @since 1.0.0
 */
function cws_load_stylesheet() {
	wp_enqueue_style('rubes-review', get_bloginfo('stylesheet_url'), array(), filemtime( get_stylesheet_directory() . '/style.css'), 'screen' );
}

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



// Pull in all supporting functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions-gravityforms.php' );
include_once( get_stylesheet_directory() . '/lib/helper-functions-ratings.php' );

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

// Try split header with center logo
add_theme_support( 'custom-header', array(
	'width'           => 300,  /*600*/
	'height'          => 97,  /*197*/
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
    'header',
    'menu-primary',
    'menu-secondary',
    'site-inner',
    'footer-widgets',
    'footer'
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

add_theme_support( 'genesis-menus', array(
	'primary'   => __( 'Primary Navigation Menu', 'rubes-review' ),
	'secondary' => __( 'Secondary Navigation Menu', 'rubes-review' ),
	'footer'    => __( 'Footer Navigation Menu', 'rubes-review' ),
) );


// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_page-widget_widget_area', 'genesis_do_nav', 12 );

// Add typical attributes for footer navigation elements.
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );

// Remove CPT Archive desxcription
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

// Display Footer Navigation Menu above footer content
add_action( 'genesis_footer', 'genesis_sample_do_footernav', 5 );
/**
 * Echo the "Footer Navigation" menu.
 *
 * @uses genesis_nav_menu() Display a navigation menu.
 * @uses genesis_nav_menu_supported() Checks for support of specific nav menu.
 */
function genesis_sample_do_footernav() {

	// Do nothing if menu not supported.
	if ( ! genesis_nav_menu_supported( 'footer' ) ) {
		return;
	}

	$class = 'menu genesis-nav-menu menu-footer';
	if ( genesis_superfish_enabled() ) {
		$class .= ' js-superfish';
	}

	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'menu_class'     => $class,
	) );

}

// Show primary nav on all pages except front page
add_action('get_header', 'child_add_nav_to_interior_pages');
function child_add_nav_to_interior_pages() {
	if ( !is_page('front-page') ) {
		add_action( 'genesis_header', 'genesis_do_nav', 12 );
	}
}

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
	// unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
// add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );

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
function rubes_login_redirect( $redirect_to, $request, $user  ) {
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
add_filter( 'login_redirect', 'rubes_login_redirect', 10, 3 );

/**
 * Redirect users to the branded login page after logout.
 *
 * @since 	1.0
 * @author  Matt Ryan
 */
function rubes_logout_redirect( $redirect_to, $request, $user  ) {
	if ( $user->has_cap( 'administrator' ) ) {
		return admin_url();
	} else {
        return '/login-to-rubes-review/';
    }
}
add_filter( 'logout_redirect', 'rubes_logout_redirect', 10, 3 );

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

// This for split header
// Ref: https://sridharkatakam.com/split-navigation-menu-items-logos-left-right-genesis/
// If header image is set, remove Header Right widget area
//   inject CSS to apply the header image as background image for home menu item and more
add_action( 'wp_head', 'sk_home_menu_item_background_image' );
function sk_home_menu_item_background_image() {

    if ( get_header_image() ) {
        // Remove the header right widget area
		unregister_sidebar( 'header-right' ); ?>
		<style type="text/css">
            .nav-primary li.menu-item-home a {
				background-image: url(<?php echo get_header_image(); ?>);
                text-indent: -9999em;
                width: 300px;
                height: 96px;
            }

            @media only screen and (min-width: 1200px) {
                .site-header > .wrap {
                    padding: 0;
                }

                .title-area {
                    display: none;
                }

                .nav-primary {
                    padding: 20px 0;
                }

                .menu-primary {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-pack: center;
                    -webkit-justify-content: center;
                        -ms-flex-pack: center;
                            justify-content: center; /* center flex items horizontally */
                    -webkit-box-align: center;
                    -webkit-align-items: center;
                        -ms-flex-align: center;
                            align-items: center; /* center flex items vertically */
                }
            }
        </style>
    <?php }

}