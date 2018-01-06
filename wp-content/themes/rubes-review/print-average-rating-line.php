<?php
function print_average_ratings_line( $args, $orgvalue ) {
    
    $prefix = 'rr_eval_' . $orgvalue['pref'];
    $wp_query = new WP_Query( $args );

    // What type of organization are we processing 
    $org_name_title = ucwords( $args['tax_query'][0]['terms'] );

    printf('<div class="ratings-heading-grouping">');
    printf('<div class="ratings-heading">%s</div>', $org_name_title);
    printf('<div class="ratings-top5-grouping">');
    if ( $wp_query -> have_posts() ) {
        while ( $wp_query -> have_posts() ) {
            $wp_query -> the_post();
            $post_id = get_the_ID( $post->ID ); 
            $org_name = get_the_title( $post_id );

            //* get the value of the tax here... Some flavor of orgtype. 
            //* Need slug later for archive link
            $my_term = get_the_terms( $post_id, 'org_type' );

            // Pull off the overall rating. This was the calculated average value based on entered 1-5 ratings
            $rating_average = substr( get_post_meta( $post_id,  $prefix . 'rating_average', true ), 0, 1);  // this field name is questionable from form 11

            /* expecting org name string from an evaluation to look like this:  test-organization_test-city_st  */
            /* expecting Agency name string from an evaluation: agency name_city-name_state_{user:user_email}_{date_mdy}  
            TODO: verify post title format being created from FORM xx */

            // Break out all parts of post title
            $my_eval_values = explode('_', $org_name );
            $eval_org_name_front = $my_eval_values[0];  // org name
            $eval_org_name_city = $my_eval_values[1];  // location city
            $eval_org_name_state = $my_eval_values[2];  // location state
            $eval_org_name_email = $my_eval_values[3];  // author_email
            $eval_org_name_create = $my_eval_values[4];  // create date
            $eval_org_name_location = $eval_org_name_city . ',' . $eval_org_name_state;
            // TODO: need to check for empty values and not write to output
            $eval_author_name = get_the_author( $post_id );

            $rating_content = sprintf('<div class="evaluation-org-stars-' . $rating_average . '">' . '<a href="' . get_permalink( $post_id ) . '">' . $eval_org_name_front . ' | ' . $eval_org_name_location . '</a></div>' );
            printf( '<div class="ratings-line">%s</div>', $rating_content  );
        }
        if ( $wp_query->found_posts > 1 ) printf('<a class="ratings-archive-link" href="' . '/eval_org_type/%s' . '">More %s Evaluations</a>', $my_term[0]->slug, $my_term[0]->name );
    
    } else {
        $rating_content = sprintf('No evaluations found.', $org_name_title );	
        printf( '<div class="ratings-line">%s</div>', $rating_content  );
    
    };
        
    printf('</div></div>');
    return;
}