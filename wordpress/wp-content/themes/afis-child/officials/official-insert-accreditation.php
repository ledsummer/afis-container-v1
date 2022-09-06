<?php
$p = $_GET['post_id'];
global $participant;
$loop = new WP_Query(array(
	        'numberposts' => -1,
	        'post_type'		=> array('accreditations'),
	        'post_status'   => array('publish'),
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
		    array(
			'key'	  	=> 'post_id',
			'value'	  	=> $p,
			'compare' 	=> '=',
		))));
if ($loop->have_posts()):
    while ($loop->have_posts()):
        $loop->the_post();
        
        $cpost                  =  get_field('post_id');
        $ca                     =  get_field('ca_no');
        $status_ses             =  get_field('status_ses'); 
        $status_sed             =  get_field('status_sed'); 
        $participant            =  get_field('requestor'); 
        $accreditation_id       =  get_the_ID();
        
        $post_information = array(
            'post_type'     => 'recommendations',
            'post_status'   => 'publish',
        );

        $postID = wp_insert_post($post_information);

        update_field('ca_no',$ca, $postID);
        update_field('is_officer',1, $postID);
        update_field('post_id',$cpost, $postID);
        update_field('for',$participant, $postID);
        update_field('user',$user_id, $postID);
        update_field('accreditation_id',$accreditation_id, $postID);
        
        
         if($status_ses == "Approved"){
             
            update_field('remarks',"Approved and Recommended", $postID);
            
       
         }else{
             if($status_ses == "Pending"){
         
             }else{
            update_field('remarks',"Deferred and not recommended for Accreditation", $postID);
             }
         
         }
         
         if($status_sed == "Approved"){
             
            update_field('remarks',"Approved and Recommended", $postID);
            
       
         }else{
             if($status_sed == "Pending"){
       
             }else{
            update_field('remarks',"Deferred and not recommended for Accreditation", $postID);
             }
         
         }
         
         
    endwhile;
endif;

?>
