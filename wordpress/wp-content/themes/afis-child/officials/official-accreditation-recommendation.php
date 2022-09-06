	<div class="accreditations-container">
	    <div class="structures-list">
 <?php
       $presscount = 0;
       $p=$_GET['post_id'];
       $accrID=$_GET['acc_id'];
       $checkifExist = array(
	        'posts_per_page' => '-1',
	        'post_type'		=> array('recommendations'),
	        'post_status'   => array('publish'),
	        'paged'         => $paged,
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
    		    array(
        			'key'	  	=> 'post_id',
        			'value'	  	=> $p,
        			'compare' 	=> '=',
        		),
        		array(
        			'key'	  	=> 'accreditation_id',
        			'value'	  	=> $accrID,
        			'compare' 	=> '=',
        		)
    		)
		);
		$the_query = new WP_Query($checkifExist);
        if ($the_query->have_posts()){
        while ($the_query->have_posts()):
        $the_query->the_post();
        $presscount++;  
                $cpost              =   get_the_ID();
                $remarks            =   get_field('remarks',$cpost);
                $postedby           =   get_field('user',$cpost);
                $author             =   get_display_name($postedby);
                $new_user           =   get_userdata( $user_id );
                $first_name         =   $new_user->first_name;
                $last_name          =   $new_user->last_name;
                $date               =   get_the_date();
                $is_officer         =   get_field('is_officer',$cpost);
                $post_id            =   get_field('post_id', $cpost);
                $accreditation_id   =   get_field('accreditation_id', $cpost);
                
                global $myrole;
                $user = new WP_User($postedby);
                if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
                foreach ( $user->roles as $role ){
                //CRITD
                if ( $role=="critd_cd-2" ) {
                    $position ="CRITD CDS II";
                } elseif ($role=="critd_chief_of_division" ) {
                    $position ="CRITD Chief of Division";
                } elseif ($role=="critd_senior_cds" ) {
                    $position ="CRITD Senior CDS";
                } elseif ($role=="critd_supervising_cds" ) {
                    $position ="CRITD Supervising CDS";    
                //CRITS
                } elseif ($role=="crits-cds_1" ) {
                    $position ="CRITS CDS II";  
                } elseif ($role=="crits-senior_cds" ) {
                    $position ="CRITS Senior CDS";  
                } elseif ($role=="crits_regional_director" ) {
                    $position ="CRITS Regional Director"; 
                } elseif ($role=="ses_cds-2" ) {
                    $position ="SES - CDS-2";     
                } elseif ($role=="ses_senior_cds" ) {
                    $position ="SES - Senior CDS"; 
                } elseif ($role=="ses_regional_director" ) {
                    $position ="SES - Regional Director"; 
                } elseif ($role=="ho_cds_1" ) {
                    $position ="Head Office - CDS-1"; 
                } elseif ($role=="ho_cds_2" ) {
                    $position ="Head Office - CDS-2"; 
                } elseif ($role=="ho_senior_cds" ) {
                    $position ="Head Office Senior CDS"; 
                } elseif ($role=="ho_chief_cds" ) {
                    $position ="Head Office Chief CDS"; 
                } else {
                    
                }
                }
                }
                $date=get_the_date();
              
               if($is_officer=="1"){
                    $bgcolor="#e5f9f1";
                    
               }else{
                    $bgcolor="#fdfdfd";
               }
               $status_ses  = get_field('status_ses',$accreditation_id);
               $status_sed  = get_field('status_sed',$accreditation_id);
               $getremarkses = get_field('remarks_ses',$accreditation_id);
               $getremarksed = get_field('remarks_sed',$accreditation_id);
               
               $file        = get_field('recomm_upload_file',$cpost);
               
             
                // if($status_sed=="Approved"){
                //     echo '<div class="each-list" style="background:'.$bgcolor.'; font-size:13px;  padding: 10px; border-radius: 3px; margin-bottom: 10px; margin-top: 4px; border: 0px solid #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
                //     '.$remarks.'
                //     <span style="font-size: 13px; font-family:Roboto; color: #564023; font-weight: 600;"> 
                //     <i class="fas fa-pencil-alt"></i> Author:  '.$author.', '.$position.' -- '.$date.' </span>
                //     <br>
                //     </div>';
                // }
                // if($status_ses=="Approved"){
                //     echo '<div class="each-list" style="background:'.$bgcolor.'; font-size:13px;  padding: 10px; border-radius: 3px; margin-bottom: 10px; margin-top: 4px; border: 0px solid #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
                //     '.$remarks.'
                //     <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
                //     <i class="fas fa-pencil-alt"></i> Author:  '.$author.', '.$position.' -- '.$date.' </span>
                //     <br>
                //     </div>';
                // }
                // if($status_ses=="Deferred"){
                //     echo '<div class="each-list" style="background:'.$bgcolor.'; font-size:13px;  padding: 10px; border-radius: 3px; margin-bottom: 10px; margin-top: 4px; border: 0px solid #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
                //     '.$remarks.'
                //     '.$getremarkses.'
                //     <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
                //     <i class="fas fa-pencil-alt"></i> Author:  '.$author.', '.$position.' -- '.$date.' </span>
                //     <br>
                //     </div>';
                // }
                // if($status_sed=="Deferred"){
                //     echo '<div class="each-list" style="background:'.$bgcolor.'; font-size:13px;  padding: 10px; border-radius: 3px; margin-bottom: 10px; margin-top: 4px; border: 0px solid #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
                //     '.$remarks.'
                //     '.$getremarksed.'
                //     <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
                //     <i class="fas fa-pencil-alt"></i> Author:  '.$author.', '.$position.' -- '.$date.' </span>
                //     <br>
                //     </div>';
                // }else{
                
                if( $file ):
                    
                    echo '<div class="each-list" style="background:'.$bgcolor.'; font-size:13px;  padding: 10px; border-radius: 3px; margin-bottom: 10px; margin-top: 4px; border: 0px solid #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
                    '.$remarks.'
                    <br><br>
                    <a href="'.$file['url'].'" target="_new"><i class="fas fa-eye"></i> '.$file['filename'].'</a>
                    <br>
                    <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
                    <i class="fas fa-pencil-alt"></i> Author:  '.$author.', '.$position.' -- '.$date.' </span>
                    </div>';    
                
                else:
                    
                    echo '<div class="each-list" style="background:'.$bgcolor.'; font-size:13px;  padding: 10px; border-radius: 3px; margin-bottom: 10px; margin-top: 4px; border: 0px solid #625c5c; font-family: \'Open Sans\', sans-serif; font-weight: normal;">
                    '.$remarks.'
                    <br>
                    <span style="font-size: 12px; font-family:Roboto; color: #564023; font-weight: 600;"> 
                    <i class="fas fa-pencil-alt"></i> Author:  '.$author.', '.$position.' -- '.$date.' </span>
                    </div>';  
                    
                endif;
                
                // }
            
                endwhile;
                wp_reset_query();
            
            ?>
        	<?php if($presscount > 3) { ?>
        	 
			                <div class="readMore-btn">
			                    <button class="display-block link-btn for-whitebg" id="loadmoreNews">Load more</button>
			                </div>
			<?php } } ?>
			</div>
        </div>
   
