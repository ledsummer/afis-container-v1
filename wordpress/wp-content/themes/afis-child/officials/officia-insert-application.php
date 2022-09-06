<?php
$p = $_GET['post_id'];
global $participant;
$loop = new WP_Query(array(
	        'numberposts' => -1,
	        'post_type'		=> array('ctpro','cea'),
	        'post_status'   => array('publish'),
        	'p'		        => "$p"));
if ($loop->have_posts()):
    while ($loop->have_posts()):
        $loop->the_post();
        
        $cpost                  =  get_the_ID();
        $ca                     =  get_field('ca-no');
        $status_ses             =  get_field('status'); 
        $participant            =  get_field('first_name')." ".get_field('last_name'); 
        global $accreditation_id;
        $loops = new WP_Query(array(
	        'numberposts' => -1,
	        'post_type'		=> array('accreditations'),
	        'post_status'   => array('publish'),
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
		    array(
			'key'	  	=> 'post_id',
			'value'	  	=>  "$p",
			'compare' 	=> '=',
		))));
        if ($loops->have_posts()):
        while ($loops->have_posts()):
        $loops->the_post();
        $accreditation_id       =  get_the_ID();
        endwhile;
        endif;
        
        
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
        
        if($status_ses=="Approved"){
        update_field('remarks',"Update Status Approved and Delegation by $current_user->user_firstname", $postID);
        }elseif($status_ses=="Dissapproved"){
        update_field('remarks',"Update Status to Dissapproved by $current_user->user_firstname", $postID);
        }else{
        update_field('remarks',"Reviewed by $current_user->user_firstname", $postID);   
        }
        
         
    endwhile;
endif;

?>
