<?php
/**
 * Organization Post Type: Archive Organization View
 *
 * @package    rubesreview organizations
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove entry title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//Removes Title and Description on CPT Archive
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

FLBuilder::render_query( array(
	'post_type' => 'fl-builder-template',
	'p'         => 966 // Breaver Header Template ID
) );

add_action( 'genesis_entry_header', 'rubesreview_organization_info', 10 );
function rubesreview_organization_info() {

	global $post;

	$prefix = 'rr_organz_';
	$post_id = get_the_ID( $post->ID ); 
	$organization_content = '<div class="organization-wrap">';

	$organization_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$organization_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'organization-image' ) ) );
		$organization_content .= sprintf('<span class="alignright organization-image">%s</span>', $organization_featured_img ); 
	}

	$my_term = get_the_term_list( $post_id, 'org_type', 'Type: ', ', ', '' );
	
	$my_term = get_the_terms( $post_id, 'org_type' );
	$organization_content .= sprintf('<div class="organization-org-type">Organization Type: %s</div>', $my_term[0]->name ); 

	$organization_content .= sprintf('<div class="organization-org-name">Name: %s</div>', get_post_meta( $post_id,  $prefix . 'organization_name', true ) ); 
	$organization_content .= sprintf('<div class="organization-org-address">Location: %s, %s</div>', get_post_meta( $post_id,  $prefix . 'organization_city', true ), get_post_meta( $post_id,  $prefix . 'organization_state', true ) ); 
	$organization_content .= sprintf('<div class="organization-org-address">Website: <a href="#">%s</a></div>', get_post_meta( $post_id,  $prefix . 'organization_web', true ) ); 
	$organization_content .= sprintf('<div class="organization-org-address">Phone: <a href="#">%s</a></div>', get_post_meta( $post_id,  $prefix . 'organization_phone', true ) ); 
	$organization_content .= '</div>';  // close organization-wrap
	printf( '<article class="organization-entry">%s</article>', $organization_content  );

	//* Remove the post content if anything could be in there
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
}

genesis();
