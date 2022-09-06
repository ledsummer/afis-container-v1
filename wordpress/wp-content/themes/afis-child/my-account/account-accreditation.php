<?php
$_returnedID; $_returnedApplication; $returnedToken;
$args = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish'
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email',
            'value' => $email,
            'compare' => '=',
        )
    )
);

$variable = new WP_Query($args);
if ($variable->have_posts()): the_post(); ?>
    <?php while( $variable->have_posts() ): $variable->the_post(); ?>
        <?php $_returnedID = get_the_id(); ?>
        <?php $_returnedApplication = get_field('application', $_returnedID); ?>
        <?php $returnedToken = get_field('token'); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>





<?php
global $wp_query;
$current_user = wp_get_current_user();
$email = $current_user->user_email;
$page_id = get_queried_object_id();
$args1 = array(
    'posts_per_page' => 1,
    'post_type' => array(
        'cea',
        'ctpro'
    ),
    'post_status' => array(
        'publish'
    ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'email',
            'value' => $email,
            'compare' => '=',
        )
    )
);

$variable1 = new WP_Query($args1);
if ($variable1->have_posts()): the_post(); ?>
    <?php while( $variable1->have_posts() ): $variable1->the_post(); ?>
        <?php
            $cpost = get_the_ID();
            $token = get_field('token');
            $name = get_field('first_name') . " " . get_field('middle_name') . " " . get_field('last_name');
    
            //CheckIfExist
            $checkifExist = array(
                'numberposts' => 1,
                'post_type' => array(
                    'accreditations'
                ) ,
                'post_status' => array(
                    'publish'
                ) ,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'ca_no',
                        'value' => get_field('ca-no', $cpost),
                        'compare' => '=',
                    )
                ),
                's' => $token
            );
            
          
            $num_rows = count($checkifExist); //PHP count()
            if ($num_rows > 0) {
                $the_query = new WP_Query($checkifExist);
                if ($the_query->have_posts()) {
                        while ($the_query->have_posts()):
                        $the_query->the_post();
                        $status_ses = get_field('status_ses');
                        $status_sed = get_field('status_sed');
                        $status_dlC = get_field('download_certificate');
                        
                        if($_returnedApplication == 1){
                            // if($page_id=="231"){
                            //     if ($status_ses == "Pending" || $status_ses == "Deferred"){
                            //         $url="../review-ses-division/?token=".$returnedToken;
                            //         wp_redirect( $url );
                            //         exit; 
                            //      } else {
                            //          if($status_sed == "Approved" && $status_ses == "Approved" && $status_dlC == ""){
                            //             $url="../approved-accreditation/?token=".$returnedToken;
                            //             wp_redirect( $url );
                            //             exit; 
                            //          } else if($status_sed == "Approved" && $status_ses == "Approved" && $status_dlC == "1"){
                            //             $url="../approved-accreditation/?token=".$returnedToken."&success=y";
                            //             wp_redirect( $url );
                            //             exit; 
                            //          } else {
                            //             // Do Nothing
                            //          }
                            //      }
                                
                            // }
                            
                            // if($page_id=="229"){
                            //     if ($status_ses == "Approved"){
                            //         $url="../review-sed-division//?token=".$returnedToken;
                            //         wp_redirect( $url );
                            //         exit; 
                            //     } else {
                            //         // Do Nothing
                            //     } 
                            // }
                                
                            // if($page_id=="132" || $page_id=="206" ){
                                    
                            //     $url="../review-ses-division//?token=".$returnedToken;
                            //     wp_redirect( $url );
                            //     exit; 
           
                            // }
                        } else if($_returnedApplication == 2) {
                            // if($page_id=="229"){
                            //     if ($status_ses == "Approved"){
                            //         $url="../review-sed-division//?token=".$returnedToken;
                            //         wp_redirect( $url );
                            //         exit; 
                            //     } else {
                            //         // Do Nothing
                            //     } 
                            // }
                            // if($page_id=="231"){
                            //     if ($status_ses == "Pending" || $status_ses == "Deferred"){
                            //         $url="../review-ses-division/?token=".$returnedToken;
                            //         wp_redirect( $url );
                            //         exit; 
                            //      } else {
                            //          if($status_sed == "Approved" && $status_ses == "Approved" && $status_dlC == ""){
                            //             $url="../approved-accreditation/?token=".$returnedToken;
                            //             wp_redirect( $url );
                            //             exit; 
                            //          } else if($status_sed == "Approved" && $status_ses == "Approved" && $status_dlC == "1"){
                            //             $url="../approved-accreditation/?token=".$returnedToken."&success=y";
                            //             wp_redirect( $url );
                            //             exit; 
                            //          } else {
                            //             // Do Nothing
                            //          }
                            //      }
                            // }
                            // if($page_id=="132" || $page_id=="206" ){
                            //     $url="../review-ses-division//?token=".$returnedToken;
                            //     wp_redirect( $url );
                            //     exit; 
                            // }
                            
                        }
                        
                        
                    endwhile;
                    wp_reset_postdata();
                }
                else
                {
    
                }
            }
            
            
            
        ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
