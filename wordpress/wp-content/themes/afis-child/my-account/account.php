<?php 
/* Template Name: Profile */ 
get_header(); 
acf_form_head();
?>

<?php include("account-header.php"); ?>
<div class="container">

<div class="col-mid-15" id="mySidebar">
    
        <?php include("account-sidebar.php"); ?>
 </div>
 <div class="col-mid-85" id="leftContainer">
  <div class="announcement">
                <h4 style="margin:5px 0px 10px; 0px"><i class="fas fa-bullhorn"></i> Announcement</h4>
                
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
                Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, 
                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
 </div>
  </div>           
<div class="col-mid-70"  id="main-content">
    <div class="standardCenter-account">
   
        
        <?php
         $current_user = wp_get_current_user();
         $email= $current_user->user_email;
         
        $user_id = get_current_user_id();
        $user = new WP_User( $user_id );
        global $groupRole; $thisRole;
        if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
            foreach ( $user->roles as $role ){
                if(($role=="ctpro")){
                    $groupRole='ctpro';
                }else{
                    $groupRole='cea';    
                }
            }
        }
         
       
         $posts = get_posts(array(
	        'numberposts'	=> 1,
	        'post_type'		=> array('cea','ctpro'),
	        'post_status'   => array('publish', 'pending'),
        	'meta_query'	=> array(
		    'relation'		=> 'AND',
		    array(
			'key'	  	=> 'email',
			'value'	  	=> $email,
			'compare' 	=> '=',
		))));
       if ( have_posts() ) : while ( have_posts() ) : the_post();
       $cpost=get_the_ID();
       $profile=get_field('profile_image');
       if(empty($profile)){
           $profilepicture= site_url()."/wp-content/uploads/2022/03/no-image.png";
       }else{
           $profilepicture=get_field('profile_image');
       }
       ?>
       
             <div class="profile-name flex">
             <div class="col-mid-20">
                 <img src="<?php echo $profilepicture; ?>" class="profileImage">
             </div>   
             <div class="col-mid-80">
                 <h3>
                     <?php 
                     if(get_field('type_of_cea') == "Firm"){
                         echo get_field('firm_name' );
                     } else {
                     echo get_field('first_name' ); ?> <?php echo  get_field('middle_name'); ?> <?php echo  get_field('last_name');
                     }
                     ?>
                </h3>
            </div>
             <div class="clear"></div>
             </div>
             
           <div class="account-information">
           <div class="headerAccount"><i class="fas fa-file-alt"></i> AFIS Account Information</div>
          
            <?php if(get_post_type($cpost) == "cea"){ ?>
            <div class="label-information">Application No:</div> <div class="data-information"><?php echo get_field('application_no'); ?></div>
            <div class="clear"></div>
            
            <div class="label-information">CDA CEA No:</div> <div class="data-information"><?php echo get_field('cea-no'); ?></div>
            <div class="clear"></div>
            <?php } else { ?>
            <div class="label-information">CA No:</div> <div class="data-information"><?php echo get_field('ca-no'); ?></div>
            <div class="clear"></div>
            <?php } ?>
            
                  
                 
            <!--<div class="headerAccount"><i class="fas fa-file-alt"></i> Payment Status</div>-->
            <!--<div class="label-information">Status:</div>-->
            <!--<div class="data-information">-->
                <?php 
                    // global $payment;
                    // $payment= get_field('payment_status'); 
                    // if($payment=="Pending" || empty($payment)){
                    //     echo "<span style='color:red;'>Pending</span>";
                    // }else{
                    //     echo "<span style='color:green;'>Paid</span>";
                    //     echo "<style>#submit_paynamics_payment_form{ display:none; }</style>";
                    // }
                ?>
            <!--</div>-->
                
          
           
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Account Type</div>
            <div class="label-information">Type:</div> <div class="data-information"><?php echo get_field('type_of_cea'); ?></div>
            <div class="clear"></div>
            
            <?php if($groupRole == "cea"){ ?>
                <div class="label-information">SEC Registration ID No.:</div> <div class="data-information"><?php echo  get_field('prc_id_no' ); ?></div>
                <div class="clear"></div>
                    
                <div class="label-information">SEC Registration Validity:</div> <div class="data-information"><?php echo date_format(date_create(get_field('prc_id_validity' )),"F d, Y"); ?></div>
                <div class="clear"></div>
                
                <div class="label-information">PRC BOA Accreditation No.:</div> <div class="data-information"><?php echo  get_field('prc_boa_accreditation_no_' ); ?></div>
                <div class="clear"></div>
                    
                <div class="label-information">PRC BOA Accreditation Validity:</div> <div class="data-information"><?php echo date_format(date_create(get_field('prc_boa_accreditation_validity' )),"F d, Y"); ?></div>
                <div class="clear"></div>
            <?php } else { ?>
                <div class="label-information">Name of Organization:</div> <div class="data-information"><?php echo  get_field('organization' ); ?></div>
                <div class="clear"></div>
                
                <div class="label-information">Organization Email:</div> <div class="data-information"><?php echo  get_field('organization_email' ); ?></div>
                <div class="clear"></div>
            <?php } ?>
            
            <?php if($groupRole == "cea"){ ?>
                <?php if(get_field('type_of_cea') == "Firm") { ?>
                    <div class="headerAccount"><i class="fas fa-file-alt"></i> Firm Information</div>
                    <div class="label-information">Firm Name:</div> <div class="data-information"><?php echo get_field('firm_name'); ?></div>
                    <div class="clear"></div>
                    
                    <?php if( have_rows('signing_partner') ): ?>
                        <div class="label-information">Signing Partner Name:</div>
                        <div class="data-information">
                            <ul style="margin:0; clear:both;">
                			    <?php while( have_rows('signing_partner') ): the_row(); ?>
                    			    <?php if(get_sub_field('partner_middle_name')){ ?>
                                        <li><?php echo get_sub_field('partner_first_name').' '.get_sub_field('partner_middle_name').' '.get_sub_field('partner_last_name'); ?></li>
                                    <?php } else { ?>
                                        <li><?php echo get_sub_field('partner_first_name').' '.get_sub_field('partner_last_name'); ?></li>
                                    <?php } ?>
                    			<?php endwhile; ?>
            			    </ul>
            			</div>
            			<div class="clear"></div>
                    <?php endif; ?>
                <?php } ?>
            <?php } ?>
                
            
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Application Information</div>
            <?php 
             if(get_field('type_of_cea') == "Firm"){} else { ?>
             
            <div class="label-information">First Name:</div> <div class="data-information"><?php echo  get_field('first_name' ); ?></div>
            <div class="clear"></div>
            
            <div class="label-information">Middle Name:</div> <div class="data-information"><?php echo  get_field('middle_name'); ?></div>
            <div class="clear"></div>
            
            <div class="label-information">Last Name:</div> <div class="data-information"><?php echo  get_field('last_name'); ?></div>
            <div class="clear"></div>
            <?php } ?>
					
			<?php if(get_field('type_of_cea') == "Individual") { ?>
			<div class="label-information">Birthday:</div>
			<div class="data-information"><?php echo date_format(date_create(get_field('birthdate' )),"F d, Y"); ?></div>
			<div class="clear"></div>
			<?php } ?>
            
            <?php if($groupRole == "ctpro"){ ?>
                <div class="label-information">Designation:</div> <div class="data-information"><?php echo  get_field('designation' ); ?></div>
                <div class="clear"></div>
                
                <div class="label-information">Proof of Identity:</div> <div class="data-information"><a href="<?php echo  get_field('proof_of_identity' )['url']; ?>" target="_blank">Click here to view</a></div>
                <div class="clear"></div>
            <?php } ?>
            
            <?php if(get_field('address')) { ?>
            <div class="label-information">Home Address:</div> <div class="data-information"><?php echo  get_field('address'); ?>, <?php echo  get_field('zip_code'); ?></div>
            <div class="clear"></div>
            <?php } ?>
            
            <?php if(get_field('office_address')) { ?>
            <div class="label-information">Office Address:</div> <div class="data-information"><?php echo  get_field('office_address'); ?>, <?php echo  get_field('office_zip'); ?></div>
            <div class="clear"></div>
            <?php } ?>
            
            
            <div class="label-information">City/Municipality :</div> <div class="data-information"><?php echo  get_field('city'); ?></div>
            <div class="clear"></div>
            
            
            <div class="label-information">Province:</div> <div class="data-information"><?php echo  get_field('province'); ?></div>
            <div class="clear"></div>
            
            <div class="headerAccount"><i class="fas fa-file-alt"></i> Contact Information</div>
            
             <div class="label-information">Email:</div> <div class="data-information"><?php echo  get_field('email'); ?></div>
            <div class="clear"></div>  
            
             <div class="label-information">Telephone:</div> <div class="data-information"><?php echo  get_field('telephone'); ?></div>
            <div class="clear"></div>  
            
             <div class="label-information">Mobile:</div> <div class="data-information"><?php echo  get_field('cellphone'); ?></div>
            <div class="clear"></div>  
            
            
            <?php $getToken = get_field('token', $cpost); ?>
            <?php $getAccID; ?>
            
            <?php
            $args = array(
                'post_type' => array(
                    'accreditations'
                ),
                'post_status' => array(
                    'publish'
                ),
                's'   => $getToken
            )
            ?>
            
            <?php $variable = new WP_Query($args);
            if ($variable->have_posts()): the_post(); ?>
                <?php while( $variable->have_posts() ): $variable->the_post(); ?>
                    <?php $getAccID = get_the_id(); ?> <br>
                <?php endwhile; ?>
            <?php else : ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            
            <?php if((get_field('status_ses', $getAccID) == "Approved") && (get_field('status_sed', $getAccID) == "Approved") && (get_field('download_certificate', $getAccID) == 0)){ ?>
                <a id="announceStat" href="#fancyboxID" class="fancybox-inline"  style="display:none"></a>   
                <div style="display:none" class="fancybox-hidden">
                    <div id="fancyboxID" class="hentry" style="line-height: 1.3; font-size: 16px; margin: 0 auto; width: 95%; max-width: 100%;">
                        <h4 style="margin: 0; margin-bottom: 25px; color: #10911a"><i class="fas fa-bullhorn"></i> Announcement</h4>
                        <div style="font-weight:bold;">Your Application for Accreditation has been approved. You may now download your certificate</div>
                        <br>
                        Please click <a href="../profile/accreditation/review-information" target="_blank">here</a> to download your e-certificate
                    </div>
                </div>
                
                <script>
                    window.onload=function(){
                        if(document.getElementById('announceStat')!=null||document.getElementById('announceStat')!=""){ 
                            document.getElementById('announceStat').click();
                        }
                    }
                </script>
            <?php } ?>
            
    <?php
    endwhile;
    endif;

    ?>
        </div>
    </div>
</div>
<div class="col-mid-15 rightManage" id="rightContainer">
    <div class="rightaccountWrapper">
        <div class="rightWrapper">
          
        </div>
        <?php 
        // include("account-payment.php"); 
        ?>
        
        <?php if(get_field('application', $cpost) == "2"){ ?>
            <?php if((get_field('payment_status', $cpost) == "Pending") || (get_field('payment_status', $cpost) == "")){ ?>
                <a href="../transactions/settle-payment" style="color:inherit"><div class="renew-account renew-account-blue"><i class="fas fa-hands-helping"></i> Settle Payment</div></a>
            <?php } ?>
            <!--<a href="#" style="color:inherit"><div class="renew-account"><i class="fas fa-hands-helping"></i> Apply For renewal</div></a>-->
        <?php } else { ?>
            <?php if((get_field('payment_status', $cpost) == "Pending") || (get_field('payment_status', $cpost) == "")){ ?>
                <a href="../transactions/settle-payment" style="color:inherit"><div class="renew-account renew-account-blue"><i class="fas fa-hands-helping"></i> Settle Payment</div></a>
            <?php } ?>
        <?php } ?>
        
        <a href="../transactions/settle-payment" style="color:inherit"><div class="renew-account renew-account-blue"><i class="fas fa-hands-helping"></i> Settle Payment</div></a>
        
        <a href="../profile/edit-information" style="color:inherit"><div class="renew-account-red"><i class="fas fa-user-edit"></i> Edit Information</div></a>
        <style>
            input[type="submit"]:hover {
                width: 100%!important;
            }
            .renew-account-blue {
                background: #3b9abf !important;
                border: 3px solid #0989bb !important;
            }
        </style>
    </div>     
</div>
</div>
<div class="clear"></div>
</div>


<script>
document.getElementById("dropdown-content").style.display = "none";
jQuery('#dropdown').click(function() {
document.getElementById("dropdown-content").style.display = "block";
});
</script>

<?php get_footer(); ?>

