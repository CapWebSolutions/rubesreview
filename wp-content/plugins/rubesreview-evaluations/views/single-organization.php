<?php
/**
 * Organization Post Type: Single Post View
 *
 * @package    rubesreview organizations
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'genesis_entry_header', 'rubesreview_organization_info', 10 );
function rubesreview_organization_info( $organization_meta ) {

	global $post;

	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 966 // Breaver Header Template ID
	) );
	
	$prefix = '_rubesreview_organization_';
	$post_id = get_the_ID( $post->ID ); 
	$organization_content = '<div class="organization-wrap">';

	$organization_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$organization_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-organization-image', 'attr' => array( 'class' => 'organization-image' ) ) );
		$organization_content .= sprintf('<span class="alignright organization-image">%s</span>', $organization_featured_img ); 
	}

	$organization_content .= sprintf('<div class="organization-org-type">Organization Type: %s</div>', get_the_term_list( get_the_ID(), 'orgtype', '', ', ', '' ) ); 	
	$organization_content .= sprintf('<div class="organization-org-name">Name: %s</div>', get_post_meta( $post_id,  $prefix . 'organizationname', true ) ); 
	$organization_content .= sprintf('<div class="organization-org-address">Location: %s, %s</div>', get_post_meta( $post_id,  $prefix . 'org_city', true ), get_post_meta( $post_id,  $prefix . 'org_state', true ) ); 
	$organization_content .= sprintf('<div class="organization-org-address">Website: <a href="#">%s</a></div>', get_post_meta( $post_id,  $prefix . 'org_web', true ) ); 
	$organization_content .= sprintf('<div class="organization-org-address">Phone: <a href="#">%s</a></div>', get_post_meta( $post_id,  $prefix . 'org_phone', true ) ); 
	$organization_content .= '</div>';  // close organization-wrap

	printf( '<article class="organization-entry">%s</article>', $organization_content  );
	return ( $organization_meta );

}

genesis();

//* dump out the BB footer. 
FLBuilder::render_query( array(
	'post_type' => 'fl-builder-template',
	'p'         => 619 // Breaver Header Template ID
) );