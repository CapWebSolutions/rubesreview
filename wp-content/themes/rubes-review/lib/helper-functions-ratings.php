<?php 
/**
 * Print Average Ratins Line - Displays a single organzation and start rating indicator on the Ratings page. 
 *
 * @param [array] $args - Query arguments to get all the posts of the associated evaluation type. ie. Agency evals, Hospita evals. 
 * @param [array] $orgvalue - array of values holding variety of strings assocaited with a specific organization type. One line of this array:  
 *		array('slug' => 'agency', 'pref' => 'agnt_', 'evaltype' => 'agency', 'posttype'=>'agnt_eval'),
 *		array('slug' => 'hospital', 'pref' => 'hosp_', 'evaltype' => 'hospital', 'posttype'=>'hosp_eval'), 
 *		array('slug' => 'continuing-education', 'pref' => 'cont_', 'evaltype' => 'continuing ed', 'posttype'=>'cont_eval'), 
 *		array('slug' => 'malpractice','pref' => 'malp_', 'evaltype' => 'malpractice company', 'posttype'=>'malp_eval' ),
 * @param [string] $prefix - organization specific prefix that identifies Rating Average field from metabox
 * @return void
 */
function print_average_ratings_line( $args, $orgvalue, $prefix ) {
	
    $wp_query = new WP_Query( $args );

    // What type of organization are we processing 
    // $org_name_title = ucwords( $args['tax_query'][0]['terms'] );
	$org_name_title = ucwords( $orgvalue['evaltype'] );
	
    printf('<div class="ratings-heading-grouping">');
    printf('<div class="ratings-heading">%s</div>', $org_name_title);
    printf('<div class="ratings-top5-grouping">');
    if ( $wp_query -> have_posts() ) {
        while ( $wp_query -> have_posts() ) {
            $wp_query -> the_post();
			$post_id = get_the_ID(); 
            $org_name = get_the_title( $post_id );

            //* get the value of the tax here... Some flavor of orgtype. 
            //* Need slug later for archive link
			$my_term = $orgvalue['evaltype'];
			$my_term_slug = $orgvalue['slug'];

            // Pull off the overall rating. This was the calculated average value based on entered 1-5 ratings
            $rating_average = substr( get_post_meta( $post_id,  $prefix . 'rating_average', true ), 0, 1);  // this field name is questionable from form 11

            /* expecting Agency name string from an evaluation: agency name_city_state_{user} */

            // Break out all parts of post title
			$my_eval_values = explode('_', $org_name );
			// var_dump($my_eval_values);
            $eval_org_name_front = $my_eval_values[0];  // org name
            $eval_org_name_city = $my_eval_values[1];  // location city
            $eval_org_name_state = $my_eval_values[2];  // location state
            $eval_org_name_email = $my_eval_values[3];  // author_email
            $eval_org_name_location = $eval_org_name_city . ', ' . $eval_org_name_state;

            $rating_content = sprintf('<div class="evaluation-org-stars-%s"><a href="%s">%s &mdash; %s</a></div>', $rating_average, get_permalink( $post_id ), $eval_org_name_front, $eval_org_name_location  );
			printf( '<div class="ratings-line">%s</div>', $rating_content  );
        }
        if ( $wp_query->found_posts > 1 ) printf('<a class="ratings-archive-link" href="' . '/%s' . '">All %s Evaluations</a>', $my_term_slug, ucwords($my_term) );
    
    } else {
        $rating_content = sprintf('No evaluations found.', $org_name_title );	
        printf( '<div class="ratings-line">%s</div>', $rating_content  );
    
    };
        
    printf('</div></div>');
    return;
}