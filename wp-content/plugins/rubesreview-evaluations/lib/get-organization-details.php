<?php 
/***	
 * 
 */
function get_organization_details( $organization ){
global $post;

// Get the post holding the current organization name
	$args = array(
		'post_type' => 'organization', 
		'name' => $organization, 
	);

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
	endforeach;

	$post_id = $post->ID; 

	$prefix = 'rr_organz_';
	// $orgdata = array();
	$orgdata['organization_city'] = get_post_meta( $post_id,  $prefix . 'organization_city', true );
	$orgdata['organization_state'] = get_post_meta( $post_id,  $prefix . 'organization_state', true );
	$orgdata['organization_web'] = get_post_meta( $post_id,  $prefix . 'organization_web', true ); 
	$orgdata['organization_phone'] = get_post_meta( $post_id,  $prefix . 'organization_phone', true ); 
	// var_dump($orgdata);
	/* Restore original Post Data */
	wp_reset_postdata();
	return $orgdata;
}